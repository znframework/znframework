<?php namespace ZN\Authentication;

use User;

class LoginTest extends Test\Constructor
{ 
    public function testStandartLogin()
    {
        
        if( User::login('robot@znframework.com', '1234') )
        {
            $this->assertStringStartsWith('You have logged in successfully.', User::success());
        }
        else
        {
            $this->assertStringStartsWith('Login failed. The user name or password is incorrect!', User::error());
        }
    }

    public function testIsLogin()
    {
        if( User::login('robot@znframework.com', '1234') )
        {
            $this->assertTrue(User::isLogin());
        }
        else
        {
            $this->assertFalse(User::isLogin());
        }
    }

    public function testData()
    {
        if( User::login('robot@znframework.com', '1234') )
        {
            $data = User::data();

            $this->assertSame('robot@znframework.com', $data->username);
        }
        else
        {
            $this->assertFalse(User::isLogin());
        }
    }
}