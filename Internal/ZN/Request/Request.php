<?php namespace ZN\Request;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\DataTypes\Strings;

class Request implements RequestInterface
{
    //--------------------------------------------------------------------------------------------------------
    // Magic Call
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $method
    // @param array  $parameters
    //
    //--------------------------------------------------------------------------------------------------------
    public static function __callStatic($method, $parameters)
    {
        if( $method === 'all' )
        {
            return Method::request();
        }

        return Method::request($method, $parameters[0] ?? NULL);
    }

    /**
     * IP v4
     * 
     * @param void
     * 
     * @return string
     */
    public static function ipv4() : String
    {
        $localIP = '127.0.0.1';

        if( isset($_SERVER['HTTP_CLIENT_IP']) )
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif( isset($_SERVER['HTTP_X_FORWARDED_FOR']) )
        {
            $ip = Strings\Split::divide($_SERVER['HTTP_X_FORWARDED_FOR'], ',');
        }
        else
        {
            $ip = $_SERVER['REMOTE_ADDR'] ?? $localIP;
        }

        if( $ip === '::1')
        {
            $ip = $localIP;
        }

        return $ip;
    }

    //--------------------------------------------------------------------------------------------------------
    // Scheme -> 4.3.5
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public static function scheme() : String
    {
        return server('requestScheme');
    }

    //--------------------------------------------------------------------------------------------------------
    // Method -> 4.3.5
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $casing = 'upper'
    //
    //--------------------------------------------------------------------------------------------------------
    public static function method(String $casing = 'upper') : String
    {
        return Strings\Casing::use(server('requestMethod'), $casing);
    }

    //--------------------------------------------------------------------------------------------------------
    // Uri -> 4.3.5
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public static function uri() : String
    {
        return server('requestUri');
    }

    //--------------------------------------------------------------------------------------------------------
    // Time -> 4.3.5
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public static function time() : Int
    {
        return server('requestTime');
    }

    //--------------------------------------------------------------------------------------------------------
    // Time Float -> 4.3.5
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public static function timeFloat() : Float
    {
        return server('requestTimeFloat');
    }
}
