<?php namespace ZN\Authentication;

class LoginTest extends \PHPUnit\Framework\TestCase
{
    public function testUsername()
    {
        $class = new Login;
        
        $class->username($username = 'robot@znframework.com');

        $this->assertSame($username, Properties::$parameters['username']);
    }

    public function testPassword()
    {
        $class = new Login;
        
        $class->password($password = '1234');

        $this->assertSame($password, Properties::$parameters['password']);
    }

    public function testRemember()
    {
        $class = new Login;
        
        $class->remember(true);

        $this->assertTrue(true, Properties::$parameters['remember']);
    }

    public function testDo()
    {
        $class = new Login;

        $this->assertFalse($class->do('robot@znframework.com', '1234'));
    }

    public function testIs()
    {
        $class = new Login;

        $this->assertFalse($class->is());
    }
}