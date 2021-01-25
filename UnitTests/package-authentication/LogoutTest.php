<?php namespace ZN\Authentication;

use User;

class LogoutTest extends Test\Constructor
{ 
    public function testLogout()
    {
        User::logout();

        $this->assertFalse(User::isLogin());
    }
}