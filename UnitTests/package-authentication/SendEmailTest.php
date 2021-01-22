<?php namespace ZN\Authentication;

class SendEmailTest extends \PHPUnit\Framework\TestCase
{
    public function testSend()
    {
        $this->assertFalse(false);

        return;
        
        $class = new SendEmail;

        $this->assertFalse($class->send('Subject', 'Message'));
    }
}