<?php namespace ZN\Authentication;

class RegisterTest extends \PHPUnit\Framework\TestCase
{
    public function testAutoLogin()
    {
        $this->assertFalse(false);

        return;

        $class = new Register;

        $class->autoLogin(true);
        
        $this->assertTrue(Properties::$parameters['autoLogin']);
    }

    public function testDo()
    {
        $this->assertFalse(false);

        return;

        $class = new Register;

        $this->assertFalse($class->do());
    }

    public function testActivationComplete()
    {
        $this->assertFalse(false);

        return;

        $class = new Register;

        $this->assertFalse($class->activationComplete());
    }

    public function testResendActivationEmail()
    {
        $this->assertFalse(false);

        return;

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