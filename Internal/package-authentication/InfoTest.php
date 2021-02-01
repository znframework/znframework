<?php namespace ZN\Authentication;

use DB;
use User;

class InfoTest extends AuthenticationExtends
{
    public function testUserIP()
    {
        $this->assertIsString(User::ip());
    }

    public function testUserAgent()
    {
        $this->assertIsString(User::agent());
    }

    public function testUserCount()
    {
        User::register
        ([
            'username' => 'robot@znframework.com',
            'password' => '1234'
        ]);
        
        $this->assertSame(1, User::count());

        DB::where('username', 'robot@znframework.com')->delete('users');
    }

    public function testUserActiveCount()
    {
        User::register
        ([
            'username' => 'robot@znframework.com',
            'password' => '1234'
        ]);

        User::login('robot@znframework.com', '1234');

        $this->assertEquals(1, User::activeCount());

        DB::where('username', 'robot@znframework.com')->delete('users');
    }

    public function testUserBannedCount()
    {
        User::register
        ([
            'username' => 'robot@znframework.com',
            'password' => '1234'
        ]);

        User::login('robot@znframework.com', '1234');

        User::update('1234', '1234', NULL, ['banned' => 1]);

        $this->assertSame(1, User::bannedCount());

        DB::where('username', 'robot@znframework.com')->delete('users');
    }

    public function testGetEncryptionPassword()
    {
        User::register
        ([
            'username' => 'robot@znframework.com',
            'password' => '1234'
        ]);

        User::login('robot@znframework.com', '1234');

        $data = User::data();

        $this->assertEquals($data->password, User::getEncryptionPassword('1234'));

        DB::where('username', 'robot@znframework.com')->delete('users');
    }
}