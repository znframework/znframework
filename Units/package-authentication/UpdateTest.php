<?php namespace ZN\Authentication;

class UpdateTest extends \PHPUnit\Framework\TestCase
{
    public function testOldPassword()
    {
        $class = new Update;

        $class->oldPassword('1234');

        $this->assertSame('1234', Properties::$parameters['oldPassword']);
    }

    public function testNewPassword()
    {
        $class = new Update;

        $class->newPassword('1234');

        $this->assertSame('1234', Properties::$parameters['newPassword']);
    }

    public function testPasswordAgain()
    {
        $class = new Update;

        $class->passwordAgain('1234');

        $this->assertSame('1234', Properties::$parameters['passwordAgain']);
    }

    public function testDo()
    {
        $class = new Update;

        $this->assertFalse($class->do('1234', '1234', '12345'));
    }
}