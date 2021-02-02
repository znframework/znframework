<?php namespace ZN\Email;

use Config;

class EmailExtends extends \ZN\Test\GlobalExtends
{
    public function __construct()
    {
        parent::__construct();

        Config::services('email', 
        [
            'driver' => 'smtp',
            'smtp'   =>
            [
                'host'      => 'smtp.foo.com',
                'user'      => 'foo',
                'password'  => 'bar',
                'port'      => 465,
                'keepAlive' => false,
                'timeout'   => 10,
                'encode'    => 'ssl',  # empty, tls, ssl
                'dsn'       => false,
                'auth'      => true
            ],
            'imap' => 
            [
                'host'      => '',
                'user'      => '',
                'password'  => '',
                'port'      => 993,
                'flags'     => [],
                'mailbox'   => 'INBOX'
            ],
            'general' =>
            [
                'senderMail'    => 'robot@znframework.com',                  # Default Sender E-mail Address.
                'senderName'    => 'ZN',                  # Default Sender Name.
                'priority'      => 3,                   # 1, 2, 3, 4, 5
                'charset'       => 'UTF-8',             # Charset Type
                'contentType'   => 'html',              # plain, html
                'multiPart'     => 'mixed',             # mixed, related, alternative
                'xMailer'       => 'ZN',
                'encoding'      => '8bit',              # 8bit, 7bit
                'mimeVersion'   => '1.0',               # MIME Version
                'mailPath'      => '/usr/sbin/sendmail' # Default Mail Path
            ]
        ]);
    }
}