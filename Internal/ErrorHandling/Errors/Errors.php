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

use ZN\IndividualStructures\Lang;

class Errors
{
    //--------------------------------------------------------------------------------------------------------
    // Message
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $langFile
    // @param string $errorMsg
    // @param mixed  $ex
    //
    //--------------------------------------------------------------------------------------------------------
    public static function message(String $langFile, String $errorMsg = NULL, $ex = NULL) : String
    {
        $style  = 'border:solid 1px #E1E4E5;';
        $style .= 'background:#FEFEFE;';
        $style .= 'padding:10px;';
        $style .= 'margin-bottom:10px;';
        $style .= 'font-family:Calibri, Ebrima, Century Gothic, Consolas, Courier New, Courier, monospace, Tahoma, Arial;';
        $style .= 'color:#666;';
        $style .= 'text-align:left;';
        $style .= 'font-size:14px;';

        $exStyle = 'color:#900;';

        if( ! is_array($ex) )
        {
            $ex = '<span style="'.$exStyle .'">'.$ex.'</span>';
        }
        else
        {
            $newArray = [];

            if( ! empty($ex) ) foreach( $ex as $k => $v )
            {
                $newArray[$k] = $v;
            }

            $ex = $newArray;
        }

        $str  = "<div style=\"$style\">";

        if( $errorMsg !== NULL )
        {
            $str .= Lang::select($langFile, $errorMsg, $ex);
        }
        else
        {
            $str .= $langFile;
        }

        $str .= '</div><br>';

        return $str;
    }

    //--------------------------------------------------------------------------------------------------------
    // Last
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $type
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    public static function last(String $type = NULL)
    {
        $result = error_get_last();

        if( $type === NULL )
        {
            return $result;
        }
        else
        {
            return $result[$type] ?? false;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Log
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $message
    // @param int    $type
    // @param string $destination
    // @param string $header
    //
    //--------------------------------------------------------------------------------------------------------
    public static function log(String $message, Int $type = 0, String $destination = NULL, String $header = NULL) : Bool
    {
        return error_log($message, $type, $destination, $header);
    }

    //--------------------------------------------------------------------------------------------------------
    // Report
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int
    //
    //--------------------------------------------------------------------------------------------------------
    public static function report(Int $level = NULL) : Int
    {
        if( ! empty($level) )
        {
            return error_reporting($level);
        }

        return error_reporting();
    }


    //--------------------------------------------------------------------------------------------------------
    // Handler
    //--------------------------------------------------------------------------------------------------------
    //
    // @param callable $handler
    // @param int      $errorTypes
    //
    //--------------------------------------------------------------------------------------------------------
    public static function handler(Callable $handler, Int $errorTypes = E_ALL | E_STRICT)
    {
        return set_error_handler($handler, $errorTypes);
    }

    //--------------------------------------------------------------------------------------------------------
    // Trigger
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $msg
    // @param int    $errorType
    //
    //--------------------------------------------------------------------------------------------------------
    public static function trigger(String $msg, Int $errorType = E_USER_NOTICE) : Bool
    {
        return trigger_error($msg, $errorType);
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
        return restore_error_handler();
    }
}