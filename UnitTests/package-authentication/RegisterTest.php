<?php namespace ZN\Authentication;

use User;
use Config;

class RegisterTest extends Test\Constructor
{
    public function testStandart()
    {
        $status = User::register
        ([
            'username' => 'robot2@znframework.com',
            'password' => '1234'
        ]);

        if( $status )
        {
            $this->assertSame('Your registration was completed successfully.', User::success());
            $this->assertFalse(User::isLogin());
        }
        else
        {
            $this->assertSame('You have already registered with the system for the transaction could not be performed!', User::error());
        }
    }

    public function testStandartWithAutoLogin()
    {
        $status = User::register
        ([
            'username' => 'robot3@znframework.com',
            'password' => '1234'
        ], true);

        if( $status )
        {
            $this->assertSame('You have logged in successfully. Redirecting .. Please wait.', User::success());
            $this->assertTrue(User::isLogin());
        }
        else
        {
            $this->assertSame('You have already registered with the system for the transaction could not be performed!', User::error());
        }
    }
}