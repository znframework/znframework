<?php namespace ZN\ErrorHandling;

use ZN\Helpers\Logger;
use ZN\DataTypes\Strings;
use ZN\IndividualStructures\Lang;
use ZN\IndividualStructures\Import;

class Exceptions extends \Exception implements ExceptionsInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    public static $errorCodes = 
    [
        0       => 'ERROR',
        2       => 'WARNING ',
        4       => 'PARSE',
        8       => 'NOTICE',
        16      => 'CORE_ERROR',
        32      => 'CORE_WARNING',
        64      => 'COMPILE_ERROR',
        128     => 'COMPILE_WARNING',
        256     => 'USER_ERROR',
        512     => 'USER_WARNING',
        1024    => 'USER_NOTICE',
        2048    => 'STRICT',
        4096    => 'RECOVERABLE_ERROR',
        8192    => 'DEPRECATED',
        16384   => 'USER_DEPRECATED',
        32767   => 'ALL'
    ];

    //--------------------------------------------------------------------------------------------------------
    // To String
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function __toString()
    {
        return $this->_template($this->getMessage(), $this->getFile(), $this->getLine(), $this->getTrace());
    }

    //--------------------------------------------------------------------------------------------------------
    // Throws
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $message
    // @param string $key
    // @param mixed  $send
    //
    //--------------------------------------------------------------------------------------------------------
    public static function throws(String $message = NULL, String $key = NULL, $send = NULL)
    {
        $debug = self::_throwFinder(debug_backtrace(2));

        if( $lang = Lang::select($message, $key, $send) )
        {
            $message = '['.self::_cleanClassName($debug['class']).'::'.$debug['function'].'()] '.$lang;
        }

        self::table('self', $message, $debug['file'], $debug['line']);
    }

    //--------------------------------------------------------------------------------------------------------
    // Table -> 5.4.6[edited]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed  $msg
    // @param string $file
    // @param string $line
    // @param string $no
    // @param array $trace
    //
    //--------------------------------------------------------------------------------------------------------
    public static function table($no = NULL, String $msg = NULL, String $file = NULL, String $line = NULL, Array $trace = NULL)
    {
        if( is_object($no) )
        {
            $msg   = $no->getMessage();
            $file  = $no->getFile();
            $line  = $no->getLine();
            $trace = $no->getTrace(); 
            
            $no    = NULL;
        }

        $lang    = Lang::select('Templates');
        $message = $lang['line'].':'.$line.', '.$lang['file'].':'.$file.', '.$lang['message'].':'.$msg;

        Logger::report('ExceptionError', $message, 'ExceptionError');

        $table = self::_template($msg, $file, $line, $no, $trace);

        // Error Type: TypeHint -> exit

        if( in_array($no, \Config::get('Project', 'exitErrors')) )
        {
            exit($table);
        }

        echo $table;
    }

    //--------------------------------------------------------------------------------------------------------
    // Continue
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $msg
    // @param string $file
    // @param string $line
    //
    //--------------------------------------------------------------------------------------------------------
    public static function continue($msg, $file, $line)
    {
        return self::_template($msg, $file, $line, NULL, NULL);
    }

    //--------------------------------------------------------------------------------------------------------
    // Restore
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public static function restore() : Bool
    {
        return restore_exception_handler();
    }

    //--------------------------------------------------------------------------------------------------------
    // Handler
    //--------------------------------------------------------------------------------------------------------
    //
    // @param callable $handler
    //
    //--------------------------------------------------------------------------------------------------------
    public static function handler(Callable $handler)
    {
        return set_exception_handler($handler);
    }

    //--------------------------------------------------------------------------------------------------------
    // Private Template
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $msg
    // @param string $file
    // @param string $line
    // @param string $no
    // @param array $trace
    //
    //--------------------------------------------------------------------------------------------------------
    private static function _template($msg, $file, $line, $no, $trace)
    {
        $projects = \Config::get('Project');

        if( ! $projects['errorReporting'] )
        {
            return false;
        }

        if( in_array($no, $projects['escapeErrors']) )
        {
            return false;
        }

        if( self::_returnValue($msg) === true )
        {
            return false;
        }
        
        $exceptionData =
        [
            'type'    => '['.self::$errorCodes[$no ?? 0].']',
            'message' => $msg,
            'file'    => $file,
            'line'    => '['.$line.']',
            'trace'   => $trace
        ];

        if( $passed = self::_argumentPassed($msg, $file, $line, $trace) )
        {
            if( ! is_array($passed) )
            {
                return false;
            }

            if( \Config::get('Project', 'invalidParameterErrorType') === 'external' )
            {
                $exceptionData = $passed;
            }
        }

        if( stristr($file, 'Buffer' . DS . 'Callback.php') )
        {
            $templateWizardData        = self::_templateWizard();
            $exceptionData['file']     = $templateWizardData->file;

            if( empty($exceptionData['message']) )
            {
                $exceptionData['message'] = $templateWizardData->message;
            }
        }

        $message = Import\Template::use('ExceptionTable', $exceptionData, true);

        return preg_replace('/\[(.*?)\]/', '<span style="color:#990000;">$1</span>', $message);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Clean Class Name
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $class
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _cleanClassName($class)
    {
        return str_ireplace(INTERNAL_ACCESS, '', Strings\Split::divide($class, '\\', -1));
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Trace Finder
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $trace
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _traceFinder($trace, $p1 = 2, $p2 = 0)
    {
        if
        (
            isset($trace[$p1]['class']) &&
            self::_cleanClassName($trace[$p1]['class']) === 'StaticAccess' &&
            $trace[$p1]['function'] === '__callStatic'
        )
        {
            $traceInfo = $trace[$p1];

            $traceInfo['class']    = $trace[$p2]['class']    ?? $trace[$p1]['class'];
            $traceInfo['function'] = $trace[$p2]['function'] ?? $trace[$p1]['function'];
        }
        else
        {
            $traceInfo = $trace[$p2] ?? self::_traceFinder(debug_backtrace(2), 8, 6);
        }

        if( ! isset($traceInfo['class']) )
        {
            $traceInfo['class'] = $traceInfo['function'];
        }

        return
        [
            'class'    => self::_cleanClassName($traceInfo['class']),
            'function' => $traceInfo['function'],
            'file'     => $traceInfo['file'],
            'line'     => $traceInfo['line']
        ];
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Throw Finder
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $trace
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _throwFinder($trace, $p1 = 3, $p2 = 5)
    {
        $classInfo = $trace[$p1];
        $fileInfo  = $trace[$p2];

        if( ! isset($classInfo['class']) && isset($classInfo['function']) )
        {
            $classInfo['class'] = $classInfo['function'];
            $fileInfo['file']   = $classInfo['file'];
            $fileInfo['line']   = $classInfo['line'];
        }

        return
        [
            'class'    => self::_cleanClassName($classInfo['class']),
            'function' => $classInfo['function'],
            'file'     => $fileInfo['file'],
            'line'     => $fileInfo['line']
        ];
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Return Value
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $msg
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _returnValue($msg)
    {
        if( stripos($msg, 'Return value') === 0 )
        {
            return true;
        }

        return false;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Argument Passed
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $msg
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _argumentPassed($msg, $file, $line, $trace)
    {
        $exceptionData = false;

        preg_match
        (
            '/^Argument\s(\d)+\spassed\sto\s(.*?)::(.*?)\smust\sbe\s\w+\s\w+\s\w+\s(.*?),\s(\w+)\sgiven/xi',
            $msg,
            $match
        );

        $message  = ! empty($match[0]) ? $match[0] : NULL;
        $argument = ! empty($match[1]) ? $match[1] : NULL;
        $class    = ! empty($match[2]) ? $match[2] : NULL;
        $method   = ! empty($match[3]) ? $match[3] : NULL;
        $type     = ! empty($match[4]) ? strtolower(Strings\Split::divide($match[4], '\\', -1)) : NULL;
        $data     = ! empty($match[5]) ? strtolower($match[5]) : NULL;

        if( empty($match) )
        {
            return false;
        }

        if( ! empty($trace) )
        {
            $traceInfo = self::_traceFinder($trace, 2, 3);
        }
        else
        {
            $traceInfo = self::_traceFinder(debug_backtrace(2), 7, 5);
        }

        if( $type !== $data )
        {
            $langMessage1 = '['.$class.'::'.$method.'] p'.$argument.':';
            $langMessage2 = '[`'.$type.'`]';

            $exceptionData =
            [
                'message' => Lang::select('Error', 'typeHint', ['&' => $langMessage1, '%' => $langMessage2]),
                'file'    => $traceInfo['file'],
                'line'    => '['.$traceInfo['line'].']',
            ];

            return $exceptionData;
        }

        return true;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Template Wizard
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _templateWizard()
    {
        $requiredFiles = implode('[+++]', get_required_files());

        preg_match('/\w+\.wizard\.php/', $requiredFiles, $match);

        $exceptionData['file']    = VIEWS_DIR.($match[0] ?? strtolower(CURRENT_CFUNCTION).'.wizard.php');
        $exceptionData['message'] = Lang::select('Error', 'templateWizard');

        return (object) $exceptionData;
    }
}