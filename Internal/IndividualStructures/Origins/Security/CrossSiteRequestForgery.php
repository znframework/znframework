<?php namespace ZN\IndividualStructures\Security;

use Session;
use ZN\Services\Method;

class CrossSiteRequestForgery
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

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

            if( $token === false || $token !== Session::select('token') )
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
