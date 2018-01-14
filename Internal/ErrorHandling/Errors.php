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

class Errors
{
    /**
     * Get error message 
     * 
     * @param string $langFile
     * @param string $errorMsg = NULL
     * @param mixed  $ex       = NULL
     * 
     * @return string
     */
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

    /**
     * Get last error
     * 
     * @param string $type = NULL
     * 
     * @return mixed
     */
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

    /**
     * Error log
     * 
     * @param string $message
     * @param int    $type        = 0
     * @param string $destination = NULL
     * @param string $header      = NULL
     * 
     * @return bool
     */
    public static function log(String $message, Int $type = 0, String $destination = NULL, String $header = NULL) : Bool
    {
        return error_log($message, $type, $destination, $header);
    }

    /**
     * Get error report
     * 
     * @param int $level = NULL
     * 
     * @return int
     */
    public static function report(Int $level = NULL) : Int
    {
        if( ! empty($level) )
        {
            return error_reporting($level);
        }

        return error_reporting();
    }


     /**
     * Exception handler
     * 
     * @param void
     * 
     * @return void
     */
    public static function handler(Int $errorTypes = E_ALL | E_STRICT)
    {
        set_error_handler('Exceptions::table', $errorTypes);
    }

    /**
     * Trigger error
     * 
     * @param string $msg
     * @param int    $errorType = E_USER_NOTICE
     * 
     * @return bool
     */
    public static function trigger(String $msg, Int $errorType = E_USER_NOTICE) : Bool
    {
        return trigger_error($msg, $errorType);
    }

    /**
     * Restore handler
     * 
     * @param void
     * 
     * @return void
     */
    public static function restore()
    {
        restore_error_handler();
    }
}