<?php namespace ZN\Authentication;

use DB;
use User;

class RegisterTest extends AuthenticationExtends
{
    public function testStandart()
    {
        User::register
        ([
            'username' => 'robot@znframework.com',
            'password' => '1234'
        ]);

        $row = DB::where('username', 'robot@znframework.com')->users()->row();

        $this->assertEquals('robot@znframework.com', $row->username);

        DB::where('username', 'robot@znframework.com')->delete('users');
    }

    public function testStandartWithAutoLogin()
    {
        User::register
        ([
            'username' => 'robot@znframework.com',
            'password' => '1234'

        ], true);

        $this->assertEquals('robot@znframework.com', User::data()->username);

        DB::where('username', 'robot@znframework.com')->delete('users');
    }
}