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
    public function do(string $redirectUrl = NULL, int $time = 0) : void;
}
