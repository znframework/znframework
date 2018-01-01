<?php namespace ZN\IndividualStructures\Security;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Services\Method;

class CrossSiteRequestForgery
{
    //--------------------------------------------------------------------------------------------------------
    // CSRF Token -> 5.3.15[edit]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $uri     = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public static function token(String $uri = NULL, String $type = 'post')
    {
        if( Method::$type() )
        {
            $token = Method::$type('token');

            if( $token === false || $token !== \Session::select('token') )
            {
                redirect($uri);
            }
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // CSRF Get Token
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $uri     = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public static function get(String $uri = NULL)
    {
        self::token($uri, 'get');
    }
}
