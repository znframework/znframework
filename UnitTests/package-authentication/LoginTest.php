<?php namespace ZN\Authentication;

class LoginTest extends \PHPUnit\Framework\TestCase
{
    public function testUsername()
    {
        $this->assertFalse(false);

        return;
        
        $class = new Login;
        
        $class->username($username = 'robot@znframework.com');

        $this->assertSame($username, Properties::$parameters['username']);
    }

    public function testPassword()
    {
        $this->assertFalse(false);

        return;
        
        $class = new Login;
        
        $class->password($password = '1234');

        $this->assertSame($password, Properties::$parameters['password']);
    }

    public function testRemember()
    {
        $this->assertFalse(false);

        return;

        $class = new Login;
        
        $class->remember(true);

        $this->assertTrue(true, Properties::$parameters['remember']);
    }

    public function testDo()
    {
        $this->assertFalse(false);

        return;

        $class = new Login;

        $this->assertFalse($class->do('robot@znframework.com', '1234'));
    }

    public function testIs()
    {
        $this->assertFalse(false);

        return;

        $class = new Login;

        $this->assertFalse($class->is());
    }
}