<?php namespace ZN\Authentication;

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
        $this->assertSame(3, User::count());
    }

    public function testUserActiveCount()
    {
        $this->assertIsInt(User::activeCount());
    }

    public function testUserBannedCount()
    {
        $this->assertSame(0, User::bannedCount());
    }

    public function testGetEncryptionPassword()
    {
        $this->assertIsString(User::getEncryptionPassword('1234'));
    }
}