<?php namespace ZN\IndividualStructures\Security;

use Session, Method, Encode, Crypto;

class CrossSiteRequestForgery extends SecurityExtends implements CrossSiteRequestForgeryInterface
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
    // CSRF Token
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $uri     = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function token(String $uri = NULL, String $type = 'post')
    {
        if( Method::$type() )
        {
            if( Method::$type('token') !== Session::select('token') )
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
    public function get(String $uri = NULL)
    {
        $this->token($uri, 'get');
    }
}
