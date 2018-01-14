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

use ZN\Lang;
use ZN\ErrorHandling\Exceptions;

class DebugException
{
    /**
     * Magic constructor
     * 
     * @param string $file
     * @param string $message = NULL
     * @param mixed  $changed = NULL
     * 
     * @return void
     */
    public function __construct(String $file, String $message = NULL, $changed = NULL)
    {
        if( $data = Lang::select($file, $message, $changed) )
        {
            $message = $data;
        }
        else
        {
            $message = $file;
        }

        $debug = (object) debug_backtrace(2)[1];

        echo Exceptions::continue($message, $debug->file, $debug->line);
    }
}

class_alias('ZN\ErrorHandling\DebugException', 'DebugException');