<?php namespace ZN\Email;

use Email;

class EmailTest extends Test\Constructor
{
    public function testSendMail()
    {
        $this->assertTrue(Email::to('znunittestmail@yandex.com')->send('Standart Example', 'Example Content'));
    }   

    public function testSendMailWithAttachment()
    {
        $this->assertTrue
        (
            Email::attachment('UnitTests/package-email/attachments/file.txt')
                 ->attachment('UnitTests/package-email/attachments/icon.png')
                 ->to('znunittestmail@yandex.com')
                 ->send('Attachment Example', 'Example Content')
        );
    } 

    public function testSendMailAddHeader()
    {
        $this->assertTrue
        (
            Email::to('znunittestmail@yandex.com')
                 ->addHeader('Header-Example', 'Header Example')
                 ->addHeader('Data', 'Example Data')
                 ->send('Header Example', 'Example Content')
        );
    }  
}