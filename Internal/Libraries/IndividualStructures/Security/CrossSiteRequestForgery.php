<?php namespace ZN\IndividualStructures\Security;

use Session, Method, Encode;

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
    // @param string $encrypt = 'token'
    // @param string $uri     = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function token(String $encrypt = 'token', String $uri = NULL)
    {
        if( ! Session::select('token') )
        {
            Session::insert('token', Encode::super($encrypt));
        }

        if( Method::post() )
        {
            if( Method::post('token') !== Session::select('token') )
            {
                redirect($uri);
            }
        }
    }
}
