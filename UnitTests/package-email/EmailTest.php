<?php namespace ZN\Email;

use Email;

class EmailTest extends Test\Constructor
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
            Email::attachment('UnitTests/package-email/attachments/file.txt')
                 ->attachment('UnitTests/package-email/attachments/icon.png')
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