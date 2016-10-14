<?php namespace ZN\IndividualStructures\User;

interface LogoutInterface
{
    //--------------------------------------------------------------------------------------------------------
    // Logout
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $redirectUrl
    // @param  numeric $time
    // @return void
    //
    //--------------------------------------------------------------------------------------------------------
    public function do(String $redirectUrl = NULL, Int $time = 0);
}
