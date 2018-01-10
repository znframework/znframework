<?php namespace ZN\ErrorHandling;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Helpers\Logger;
use ZN\DataTypes\Strings;
use ZN\Language\Lang;
use ZN\Inclusion;

class Exceptions extends \Exception implements ExceptionsInterface
{   
    /**
     * Error codes
     * 
     * @var array
     */
    public static $errorCodes = 
    [
        0       => 'ERROR',
        2       => 'WARNING',
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

    /**
     * Magic to string 
     * 
     * @param void
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->_template($this->getMessage(), $this->getFile(), $this->getLine(), $this->getTrace());
    }

    /**
     * Throw exception
     * 
     * @param string $message = NULL
     * @param string $key     = NULL
     * @param mixed  $send    = NULL
     * 
     * @return void
     */
    public static function throws(String $message = NULL, String $key = NULL, $send = NULL)
    {
        $debug = self::_throwFinder(debug_backtrace(2), 0, 2);

        if( $lang = Lang::select($message, $key, $send) )
        {
            $message = '['.self::_cleanClassName($debug['class']).'::'.$debug['function'].'()] '.$lang;
        }

        self::table('self', $message, $debug['file'], $debug['line']);
    }

    /**
     * Get exception table
     * 
     * @param mixed  $no    = NULL
     * @param string $msg   = NULL
     * @param string $file  = NULL
     * @param string $line  = NULL
     * @param array  $trace = NULL
     * 
     * @return void
     */
    public static function table($no = NULL, String $msg = NULL, String $file = NULL, String $line = NULL, Array $trace = NULL)
    {
        if( is_object($no) )
        {
            $msg   = $no->getMessage();
            $file  = $no->getFile();
            $line  = $no->getLine();
            $trace = $no->getTrace(); 
            
            $no    = 'NULL';
        }

        $lang    = Lang::select('Templates');
        $message = $lang['line'].':'.$line.', '.$lang['file'].':'.$file.', '.$lang['message'].':'.$msg;

        Logger::report('ExceptionError', $message, 'ExceptionError');

        $table = self::_template($msg, $file, $line, $no, $trace);

        $projectError = \Config::get('Project');

        if( in_array($no, $projectError['exitErrors'], true) || in_array(self::$errorCodes[$no] ?? NULL, $projectError['exitErrors'], true) )
        {
            exit($table);
        }

        echo $table;
    }

    /**
     * Continue exception
     * 
     * @param string $msg
     * @param string $file
     * @param string $line
     * 
     * @return string
     */
    public static function continue($msg, $file, $line)
    {
        return self::_template($msg, $file, $line, NULL, NULL);
    }

    /**
     * Restore exception
     * 
     * @param void
     * 
     * @return bool
     */
    public static function restore() : Bool
    {
        return restore_exception_handler();
    }

    /**
     * Set exception handler
     * 
     * @param void
     * 
     * @return void
     */
    public static function handler()
    {
        set_exception_handler([__CLASS__, 'table']);
    }

    /**
     * protected exception template
     * 
     * @param string $msg
     * @param string $file
     * @param string $line
     * @param string $no
     * @param array  $trace
     * 
     * @return string
     */
    private static function _template($msg, $file, $line, $no, $trace)
    {
        $projects = \Config::get('Project');

        if( ! $projects['errorReporting'] )
        {
            return false;
        }

        if( in_array($no, $projects['escapeErrors'], true) || in_array(self::$errorCodes[$no] ?? NULL, $projects['escapeErrors'], true) )
        {
            return false;
        }

        if( self::_returnValue($msg) === true )
        {
            return false;
        }
        
        $exceptionData =
        [
            'type'    => self::$errorCodes[$no] ?? 'ERROR',
            'message' => $msg,
            'file'    => $file,
            'line'    => $line,
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
        
        if( stristr($exceptionData['file'] ?? $file, 'Buffer/Callback.php') )
        {
            $templateWizardData    = self::_templateWizard();
            $exceptionData['file'] = $templateWizardData->file;

            if( empty($exceptionData['message']) )
            {
                $exceptionData['message'] = $templateWizardData->message;
            }
        }

        return Inclusion\Template::use('ExceptionTable', $exceptionData, true);
    }

    /**
     * protected clean class name
     * 
     * @param string $class
     * 
     * @return string
     */
    protected static function _cleanClassName($class)
    {
        return str_ireplace(INTERNAL_ACCESS, '', Strings\Split::divide($class, '\\', -1));
    }

    /**
     * Trace finder
     * 
     * @param array $trace
     * @param int   $p1 = 2
     * @param int   $p2 = 0
     * 
     * @return array
     */
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
            'line'     => $traceInfo['line'],
            'trace'    => $trace
        ];
    }

    /**
     * Throw finder
     * 
     * @param array $trace
     * @param int   $p1 = 2
     * @param int   $p2 = 0
     * 
     * @return array
     */
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
            'line'     => $fileInfo['line'],
            'trace'    => $trace
        ];
    }

    /**
     * protected return value
     * 
     * @param string $msg
     * 
     * @return bool
     */
    protected static function _returnValue($msg)
    {
        if( stripos($msg, 'Return value') === 0 )
        {
            return true;
        }

        return false;
    }

    /**
     * Handle argument passed
     * 
     * @param string $msg
     * @param string $file
     * @param string $line
     * @param array  $trace
     * 
     * @return mixed
     */
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
                'line'    => $traceInfo['line'],
                'trace'   => $trace
            ];

            return $exceptionData;
        }

        return true;
    }

    /**
     * Handle template wizard
     * 
     * @param void
     * 
     * @return object
     */
    protected static function _templateWizard()
    {
        $trace = debug_backtrace()[6]['args']    ?? [NULL];
        $args  = debug_backtrace()[1]['args'][4] ?? [];

        foreach( $args as $key => $value )
        {
            if( preg_match('/Views\/.*?\.\wizard\.php/', $find = ($value['args'][0] ?? NULL)) )
            {
                $file = $find;
            }
        }

        $file    = $file ?? VIEWS_DIR.($trace[0] ?? strtolower(CURRENT_CFUNCTION).'.wizard') . '.php';
        $message = $trace[0] ?? Lang::select('Error', 'templateWizard');

        $exceptionData['file']    = $file;
        $exceptionData['message'] = $message;

        return (object) $exceptionData;
    }
}