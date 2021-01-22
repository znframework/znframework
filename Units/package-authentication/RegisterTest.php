<?php namespace ZN\Authentication;

class RegisterTest extends \PHPUnit\Framework\TestCase
{
    public function testAutoLogin()
    {
        $class = new Register;

        $class->autoLogin(true);
        
        $this->assertTrue(Properties::$parameters['autoLogin']);
    }

    public function testDo()
    {
        $class = new Register;

        $this->assertFalse($class->do());
    }

    public function testActivationComplete()
    {
        $class = new Register;

        $this->assertFalse($class->activationComplete());
    }

    public function testResendActivationEmail()
    {
        $class = new Register;

        try
        {
            $this->assertSame(false, $class->resendActivationEmail('robot@znframework.com', 'account/profile'));
        }
        catch( Exception\ActivationColumnException $e)
        {
            $this->assertSame('Activation column not set!', $e->getMessage());
        }
        
    }
}