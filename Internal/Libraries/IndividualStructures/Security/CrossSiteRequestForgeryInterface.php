<?php namespace ZN\IndividualStructures\Security;

interface CrossSiteRequestForgeryInterface
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
    public function token(String $encrypt = 'token', String $uri = NULL);
}
