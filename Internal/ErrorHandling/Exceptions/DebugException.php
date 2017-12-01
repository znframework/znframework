<?php 

use ZN\IndividualStructures\Lang;
use ZN\ErrorHandling\Exceptions;

class DebugException
{
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

        $debug = Debugger::next();

        echo Exceptions::continue($message, $debug->file, $debug->line);
    }
}
