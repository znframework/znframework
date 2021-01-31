<?php namespace ZN\Authentication;

use User;

class UpdateTest extends AuthenticationExtends
{
    public function testUpdateOnlyPassword()
    {
        User::login('robot@znframework.com', '1234');

        if( User::isLogin() )
        {
            $status = User::update('1234', '1234new');

            $this->assertTrue($status);  
        }
        else
        {
            $this->assertSame('Login failed. The user name or password is incorrect!', User::error());
        }
    }
}