<?php namespace ZN\Authentication;

use User;

class LogoutTest extends AuthenticationExtends
{ 
    public function testLogout()
    {
        User::logout();

        $this->assertFalse(User::isLogin());
    }
}