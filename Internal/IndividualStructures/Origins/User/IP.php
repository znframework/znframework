<?php namespace ZN\IndividualStructures\User;
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

class IP
{
    //--------------------------------------------------------------------------------------------------
    // ipv4()
    //--------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------
    public function v4() : String
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
}
