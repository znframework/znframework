<?php namespace ZN\ErrorHandling;

use Exception, Config, Import;

class InternalExceptions extends Exception implements InternalExceptionsInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

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
    public function throws(String $message = NULL, String $key = NULL, $send = NULL)
    {
        $debug = $this->_throwFinder(debug_backtrace(2));

        if( $lang = lang($message, $key, $send) )
        {
            $message = '['.$this->_cleanClassName($debug['class']).'::'.$debug['function'].'()] '.$lang;
        }

        $this->table('self', $message, $debug['file'], $debug['line']);
    }

    //--------------------------------------------------------------------------------------------------------
    // Table
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $msg
    // @param string $file
    // @param string $line
    // @param string $no
    // @param array $trace
    //
    //--------------------------------------------------------------------------------------------------------
    public function table(String $no = NULL, String $msg = NULL, String $file = NULL, String $line = NULL, Array $trace = NULL)
    {
        $lang    = lang('Templates');
        $message = $lang['line'].':'.$line.', '.$lang['file'].':'.$file.', '.$lang['message'].':'.$msg;

        report('ExceptionError', $message, 'ExceptionError');

        $table = $this->_template($msg, $file, $line, $no, $trace);

        // Error Type: TypeHint -> exit

        if( in_array($no, Config::get('Project', 'exitErrors')) )
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
    public function continue($msg, $file, $line)
    {
        return $this->_template($msg, $file, $line, NULL, NULL);
    }

    //--------------------------------------------------------------------------------------------------------
    // Restore
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function restore() : Bool
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
    public function handler(Callable $handler)
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
    private function _template($msg, $file, $line, $no, $trace)
    {
        $projects = Config::get('Project');

        if( ! $projects['errorReporting'] )
        {
            return false;
        }

        if( in_array($no, $projects['escapeErrors']) )
        {
            return false;
        }

        if( $this->_returnValue($msg) === true )
        {
            return false;
        }

        $exceptionData =
        [
            'message' => $msg,
            'file'    => $file,
            'line'    => '['.$line.']'
        ];

        if( $passed = $this->_argumentPassed($msg, $file, $line, $trace) )
        {
            if( ! is_array($passed) )
            {
                return false;
            }

            if( Config::get('ErrorHandling', 'exceptions')['invalidParameterErrorType'] === 'external' )
            {
                $exceptionData = $passed;
            }
        }

        if( stristr($file, 'TemplateWizard') )
        {
            $templateWizardData        = $this->_templateWizard();
            $exceptionData['file']     = $templateWizardData->file;
            $exceptionData['message'] .= '! '.$templateWizardData->message;
        }

        $message = Import::template('ExceptionTable', $exceptionData, true);

        return preg_replace('/\[(.*?)\]/', '<span style="color:#990000;">$1</span>', $message);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Clean Class Name
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $class
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _cleanClassName($class)
    {
        return str_ireplace(INTERNAL_ACCESS, '', divide($class, '\\', -1));
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Trace Finder
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $trace
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _traceFinder($trace, $p1 = 2, $p2 = 0)
    {
        if
        (
            isset($trace[$p1]['class']) &&
            $this->_cleanClassName($trace[$p1]['class']) === 'StaticAccess' &&
            $trace[$p1]['function'] === '__callStatic'
        )
        {
            $traceInfo = $trace[$p1];

            $traceInfo['class']    = $trace[$p2]['class']    ?? $trace[$p1]['class'];
            $traceInfo['function'] = $trace[$p2]['function'] ?? $trace[$p1]['function'];
        }
        else
        {
            $traceInfo = $trace[$p2] ?? $this->_traceFinder(debug_backtrace(2), 8, 6);
        }

        if( ! isset($traceInfo['class']) )
        {
            $traceInfo['class'] = $traceInfo['function'];
        }

        return
        [
            'class'    => $this->_cleanClassName($traceInfo['class']),
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
    protected function _throwFinder($trace, $p1 = 3, $p2 = 5)
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
            'class'    => $this->_cleanClassName($classInfo['class']),
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
    protected function _returnValue($msg)
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
    protected function _argumentPassed($msg, $file, $line, $trace)
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
        $type     = ! empty($match[4]) ? strtolower(divide($match[4], '\\', -1)) : NULL;
        $data     = ! empty($match[5]) ? strtolower($match[5]) : NULL;

        if( empty($match) )
        {
            return false;
        }

        if( ! empty($trace) )
        {
            $traceInfo = $this->_traceFinder($trace, 2, 3);
        }
        else
        {
            $traceInfo = $this->_traceFinder(debug_backtrace(2), 7, 5);
        }

        if( $type !== $data )
        {
            $langMessage1 = '['.$class.'::'.$method.'] p'.$argument.':';
            $langMessage2 = '[`'.$type.'`]';

            $exceptionData =
            [
                'message' => lang('Error', 'typeHint', ['&' => $langMessage1, '%' => $langMessage2]),
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
    protected function _templateWizard()
    {
        $requiredFiles = implode('[+++]', get_required_files());

        preg_match('/\w+\.wizard\.php/', $requiredFiles, $match);

        $exceptionData['file']    = VIEWS_DIR.($match[0] ?? strtolower(CURRENT_FUNCTION).'.wizard.php');
        $exceptionData['message'] = lang('Error', 'templateWizard');

        return (object) $exceptionData;
    }
}
