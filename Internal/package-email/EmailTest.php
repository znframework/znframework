<?php namespace ZN\Email;

use Email;

class EmailTest extends EmailExtends
{
    public function testSendMail()
    {
        return;

        $this->assertTrue(Email::to('bar@foo.com')->send('Standart Example', 'Example Content'));
    }   

    public function testSendMailWithAttachment()
    {
        return;

        $this->assertTrue
        (
            Email::attachment(self::default . 'package-email/attachments/file.txt')
                 ->attachment(self::default . 'package-email/attachments/icon.png')
                 ->to('bar@foo.com')
                 ->send('Attachment Example', 'Example Content')
        );
    } 

    public function testSendMailAddHeader()
    {
        return;

        $this->assertTrue
        (
            Email::to('bar@foo.com')
                 ->addHeader('Header-Example', 'Header Example')
                 ->addHeader('Data', 'Example Data')
                 ->send('Header Example', 'Example Content')
        );
    }  
}