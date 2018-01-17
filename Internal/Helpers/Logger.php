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

use ZN\Helper;

class Logger implements LoggerInterface
{
    /**
     * Notice log
     * 
     * @param string $message
     * @param string $time
     * 
     * @return bool
     */
    public static function notice(String $message, String $time = NULL)
	{
		return self::report(__FUNCTION__, $message, NULL, $time);
	}

    /**
     * Emergency log
     * 
     * @param string $message
     * @param string $time
     * 
     * @return bool
     */
    public static function emergency(String $message, String $time = NULL)
	{
		return self::report(__FUNCTION__, $message, NULL, $time);
	}

    /**
     * Alert log
     * 
     * @param string $message
     * @param string $time
     * 
     * @return bool
     */
    public static function alert(String $message, String $time = NULL)
	{
		return self::report(__FUNCTION__, $message, NULL, $time);
	}

    /**
     * Error log
     * 
     * @param string $message
     * @param string $time
     * 
     * @return bool
     */
    public static function error(String $message, String $time = NULL)
	{
		return self::report(__FUNCTION__, $message, NULL, $time);
	}

    /**
     * Warning log
     * 
     * @param string $message
     * @param string $time
     * 
     * @return bool
     */
    public static function warning(String $message, String $time = NULL)
	{
		return self::report(__FUNCTION__, $message, NULL, $time);
	}

    /**
     * Critical log
     * 
     * @param string $message
     * @param string $time
     * 
     * @return bool
     */
    public static function critical(String $message, String $time = NULL)
	{
		return self::report(__FUNCTION__, $message, NULL, $time);
	}

    /**
     * Info log
     * 
     * @param string $message
     * @param string $time
     * 
     * @return bool
     */
    public static function info(String $message, String $time = NULL)
	{
		return 	self::report(__FUNCTION__, $message, NULL, $time);
	}

    /**
     * Debug log
     * 
     * @param string $message
     * @param string $time
     * 
     * @return bool
     */
    public static function debug(String $message, String $time = NULL)
	{
		return self::report(__FUNCTION__, $message, NULL, $time);
	}

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
    public static function report(String $subject, String $message, String $destination = NULL, String $time = NULL) : Bool
    {
        return Helper::report($subject, $message, $destination, $time);
    }
}
