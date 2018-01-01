<?php 
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\IndividualStructures\Lang;
use ZN\ErrorHandling\Exceptions;

class DebugException
{
    //--------------------------------------------------------------------------------------------------------
    // Magic Construct
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    // @param string $message
    // @param mixed  $changed
    //
    //--------------------------------------------------------------------------------------------------------
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
