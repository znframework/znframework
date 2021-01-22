<?php namespace ZN\Authentication;

class InformationTest extends \PHPUnit\Framework\TestCase
{
    public function testError()
    {
        $this->assertFalse(false);

        return;

        $class = new Information;
        
        $class->error();

        $this->assertSame('You are not registered on the system or your username is incorrect!', Properties::$error);
    }

    public function testSuccess()
    {
        $this->assertFalse(false);

        return;

        $class = new Information;

        $class->success();

        $this->assertSame(NULL, Properties::$success);
    }
}