<?php namespace ZN\Email;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

/**
 * Default Cookie Configuration
 * 
 * Enabled when the configuration file can not be accessed.
 */
class EmailDefaultConfiguration
{
   /*
    |--------------------------------------------------------------------------
    | Email
    |--------------------------------------------------------------------------
    |
    | Contains settings related to Email library. 
    | 
    | driver: Email send drivers. [smtp, mail, send, pipe, imap]
    | smtp: Send settings via SMTP.
    | general: General e-mail settings.
    |
    */

    public $driver = 'smtp';
    public $smtp   =
    [
        'host'      => '',
        'user'      => '',
        'password'  => '',
        'port'      => 587,
        'keepAlive' => false,
        'timeout'   => 10,
        'encode'    => '',  # empty, tls, ssl
        'dsn'       => false,
        'auth'      => true
    ];
    public $general =
    [
        'senderMail'    => '',                  # Default Sender E-mail Address.
        'senderName'    => '',                  # Default Sender Name.
        'priority'      => 3,                   # 1, 2, 3, 4, 5
        'charset'       => 'UTF-8',             # Charset Type
        'contentType'   => 'html',              # plain, html
        'multiPart'     => 'mixed',             # mixed, related, alternative
        'xMailer'       => 'ZN',
        'encoding'      => '8bit',              # 8bit, 7bit
        'mimeVersion'   => '1.0',               # MIME Version
        'mailPath'      => '/usr/sbin/sendmail' # Default Mail Path
    ];
}
