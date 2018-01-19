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

interface SenderInterface
{
    /**
     * Settings
     * 
     * @param array $settings = NULL
     * 
     * @param return Sender
     */
    public function settings(Array $settings = NULL) : Sender;

    /**
     * Content Tyep
     * 
     * @param string $type = 'plain' - options[plain|html]
     * 
     * @return Sender
     */
    public function contentType(String $type = 'plain') : Sender;

    /**
     * Sets charset
     * 
     * @param string $charset
     * 
     * @return Sender
     */
    public function charset(String $charset = 'UTF-8') : Sender;

    /**
     * Sets priority
     * 
     * @param int count = 3
     * 
     * @return Sender
     */
    public function priority(Int $count = 3) : Sender;

    /**
     * Add Header
     * 
     * @param string $header
     * @param string $value
     * 
     * @return Sender
     */
    public function addHeader(String $header, String $value) : Sender;

   /**
     * Sets Encoding Type
     * 
     * @param string $type = '8bit' - options[7bit|8bit]
     * 
     * @return Sender
     */
    public function encodingType(String $type = '8bit') : Sender;

    /**
     * Sets multipart
     * 
     * @param string $multiPart = 'related' - options[related|alternative|mixed]
     * 
     * @return Sender
     */
    public function multiPart(String $multiPart = 'related') : Sender;

    /**
     * Sets SMTP Host
     * 
     * @param string $host
     * 
     * @return Snder
     */
    public function smtpHost(String $host) : Sender;

    /**
     * Sets SMTP User
     * 
     * @param string $user
     * 
     * @return Sender
     */
    public function smtpUser(String $user) : Sender;

    /**
     * Sets SMTP DSN
     * 
     * @param bool $dsn = true
     * 
     * @return Sender
     */
    public function smtpDsn(Bool $dsn = true) : Sender;

    /**
     * Sets SMTP Passowrd
     * 
     * @param string $pass
     * 
     * @return Sender
     */
    public function smtpPassword(String $pass) : Sender;

    /**
     * Sets SMTP Port
     * 
     * @param int port = 587
     * 
     * @param Sender
     */
    public function smtpPort(Int $port = 587) : Sender;

    /**
     * Sets SMTP Timeout
     * 
     * @param int $timeout = 10
     * 
     * @return Sender
     */
    public function smtpTimeout(Int $timeout = 10) : Sender;

    /**
     * Sets SMTP Keep Alive
     * 
     * @param bool $keepAlive = true
     * 
     * @return Sender
     */
    public function smtpKeepAlive(Bool $keepAlive = true) : Sender;

    /**
     * Sets SMTP Encode
     * 
     * @param string $encode
     * 
     * @return Sender
     */
    public function smtpEncode(String $encode) : Sender;

    /**
     * To
     * 
     * @param mixed  $to
     * @param string $name = NULL
     * 
     * @return Sender
     */
    public function to($to, String $name) : Sender;

    /**
     * To / Receiver
     * 
     * @param mixed  $to
     * @param string $name = NULL
     * 
     * @return Sender
     */
    public function receiver($to, String $name) : Sender;

    /**
     * Reply To
     * 
     * @param mixed  $to
     * @param string $name = NULL
     * 
     * @return Sender
     */
    public function replyTo($replyTo, String $name) : Sender;


    /**
     * CC
     * 
     * @param mixed  $to
     * @param string $name = NULL
     * 
     * @return Sender
     */
    public function cc($cc, String $name) : Sender;

    /**
     * BCC
     * 
     * @param mixed  $to
     * @param string $name = NULL
     * 
     * @return Sender
     */
    public function bcc($bcc, String $name) : Sender;

    /**
     * From
     * 
     * @param string $from
     * @param string $name       = NULL
     * @param string $returnPath = NULL
     * 
     * @return Sender
     */
    public function from(String $from, String $name = NULL, String $returnPath = NULL) : Sender;

    /**
     * From / Sender
     * 
     * @param string $from
     * @param string $name       = NULL
     * @param string $returnPath = NULL
     * 
     * @return Sender
     */
    public function sender(String $from, String $name = NULL, String $returnPath = NULL) : Sender;

    /**
     * Subject
     * 
     * @param string $subject
     * 
     * @return Sender
     */
    public function subject(String $subject) : Sender;

    /**
     * Template
     * 
     * @param string $table
     * @param mixed  $column
     * @param array  $data
     * 
     * @return Sender
     */
    public function template(String $table, $column, Array $data = []) : Sender;

    /**
     * Template Match
     * 
     * @param string $content
     * @param array  $data
     * 
     * @return string
     */
    public function templateMatch(String $content, Array $data) : String;

    /**
     * Message
     * 
     * @param string $message
     * 
     * @return Sender
     */
    public function message(String $message) : Sender;

    /**
     * Message / Content
     * 
     * @param string $message
     * 
     * @return Sender
     */
    public function content(String $message) : Sender;

    /**
     * Attachment
     * 
     * @param string $file
     * @param string $disposition = NULL
     * @param string $newName     = NULL
     * @param mixed  $mime        = NULL
     * 
     * @return Sender
     */
    public function attachment(String $file, String $disposition = NULL, String $newName = NULL, $mime = NULL) : Sender;

    /**
     * Attachment Content ID
     * 
     * @param string $filename
     * 
     * @return mixed
     */
    public function attachmentContentId(String $filename);

    /**
     * Send
     * 
     * @param string $subject = NULL
     * @param string $message = NULL
     * 
     * @return bool
     */
    public function send(String $subject = NULL, String $message = NULL) : Bool;
}
