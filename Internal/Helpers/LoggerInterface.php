<?php namespace ZN\Helpers;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

interface LoggerInterface
{
    /**
     * Notice log
     * 
     * @param string $message
     * @param string $time
     * 
     * @return bool
     */
    public static function notice(String $message, String $time = NULL);

    /**
     * Emergency log
     * 
     * @param string $message
     * @param string $time
     * 
     * @return bool
     */
    public static function emergency(String $message, String $time = NULL);

    /**
     * Alert log
     * 
     * @param string $message
     * @param string $time
     * 
     * @return bool
     */
    public static function alert(String $message, String $time = NULL);

    /**
     * Error log
     * 
     * @param string $message
     * @param string $time
     * 
     * @return bool
     */
    public static function error(String $message, String $time = NULL);

    /**
     * Warning log
     * 
     * @param string $message
     * @param string $time
     * 
     * @return bool
     */
    public static function warning(String $message, String $time = NULL);

    /**
     * Critical log
     * 
     * @param string $message
     * @param string $time
     * 
     * @return bool
     */
    public static function critical(String $message, String $time = NULL);

    /**
     * Info log
     * 
     * @param string $message
     * @param string $time
     * 
     * @return bool
     */
    public static function info(String $message, String $time = NULL);

    /**
     * Debug log
     * 
     * @param string $message
     * @param string $time
     * 
     * @return bool
     */
    public static function debug(String $message, String $time = NULL);

    /**
     * Report log
     * 
     * @param string $subject
     * @param string $message
     * @param string $destination
     * @param string $time
     * 
     * @return bool
     */
    public static function report(String $subject, String $message, String $destination = NULL, String $time = NULL) : Bool;
}
