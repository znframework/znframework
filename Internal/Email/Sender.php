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

use ZN\IS;
use ZN\Lang;
use ZN\Config;
use ZN\Security;
use ZN\Singleton;
use ZN\Inclusion;
use ZN\Ability\Driver;
use ZN\DataTypes\Strings;
use ZN\Ability\Information;
use ZN\Email\Exception\InvalidCharsetException;
use ZN\Email\Exception\BadEmailAddressException;

class Sender implements SenderInterface
{
    use Driver, Information;

    /**
     * Driver Settings
     * 
     * @var array
     */
    const driver =
    [
        'options'   => ['smtp', 'mail', 'pipe', 'send', 'imap'],
        'namespace' => 'ZN\Email\Drivers',
        'construct' => 'settings',
        'config'    => 'Services:email',
        'default'   => 'ZN\Email\EmailDefaultConfiguration'
    ];

    /**
     * Email Settings
     * 
     * @var mixed
     */
    protected $senderMail   = '';
    protected $senderName   = '';
    protected $charset      = 'UTF-8';
    protected $contentType  = 'plain';
    protected $mailPath     = '/usr/sbin/sendmail';
    protected $lf           = "\n";
    protected $mimeVersion  = '1.0';
    protected $boundary     = '';
    protected $multiPart    = 'mixed';
    protected $priority     = 3;
    protected $encodingType = '8bit';
    protected $multiParts   = ['related', 'alternative', 'mixed'];
    protected $xMailer      = 'ZN';
    protected $headers      = [];
    protected $header       = '';

    /**
     * SMTP Settings
     * 
     * @var mixed
     */
    protected $smtpHost      = '';
    protected $smtpUser      = '';
    protected $smtpPassword  = '';
    protected $smtpEncode    = '';
    protected $smtpPort      = 587;
    protected $smtpTimeout   = 10;
    protected $smtpAuth      = true;
    protected $smtpDsn       = false;
    protected $smtpKeepAlive = false;

    /**
     * Priority Types
     * 
     * @var array
     */
    protected $priorityTypes =
    [
        1 => '1 (Highest)',
        2 => '2 (High)',
        3 => '3 (Normal)',
        4 => '4 (Low)',
        5 => '5 (Lowest)'
    ];

    /**
     * Sending Email Settings
     * 
     * @var mixed
     */
    protected $attachments = [];
    protected $to          = [];
    protected $replyTo     = [];
    protected $cc;
    protected $bcc;
    protected $from;
    protected $subject;
    protected $message;

    /**
     * Protected Lang
     */
    protected function getLang(String $type, String $changes = NULL) : String
    {
        return str_replace('%', $changes, $this->getLang[$type]);
    }

    /**
     * Settings
     * 
     * @param array $settings = NULL
     * 
     * @param return Sender
     */
    public function settings(Array $settings = NULL) : Sender
    {
        $this->getLang = Lang::default(new EmailDefaultLanguage)->select('Services');
        $config        = Config::default(new EmailDefaultConfiguration)::get('Services', 'email');
        $smtpConfig    = $config['smtp'];
        $generalConfig = $config['general'];

        foreach( $smtpConfig as $key => $val )
        {
            $nkey = 'smtp'.ucfirst($key);

            $this->$nkey = $settings[$key] ?? $val;
        }

        foreach( $generalConfig as $key => $val )
        {
            $this->$key = $settings[$key] ?? $val;
        }

        return $this;
    }

    /**
     * Content Tyep
     * 
     * @param string $type = 'plain' - options[plain|html]
     * 
     * @return Sender
     */
    public function contentType(String $type = 'plain') : Sender
    {
        $this->contentType = $type === 'plain'
                             ? 'plain'
                             : 'html';
        return $this;
    }

    /**
     * Sets charset
     * 
     * @param string $charset
     * 
     * @return Sender
     */
    public function charset(String $charset = 'UTF-8') : Sender
    {
        if( IS::charset($charset) )
        {
            $this->charset = $charset;
        }
        else
        {
            throw new InvalidCharsetException(NULL, $charset);
        }

        return $this;
    }

    /**
     * Sets priority
     * 
     * @param int count = 3
     * 
     * @return Sender
     */
    public function priority(Int $count = 3) : Sender
    {
        $this->priority = preg_match('/^[1-5]$/', $count)
                        ? (int)$count
                        : 3;

        return $this;
    }

    /**
     * Add Header
     * 
     * @param string $header
     * @param string $value
     * 
     * @return Sender
     */
    public function addHeader(String $header, String $value) : Sender
    {
        $this->headers[$header] = str_replace(["\n", "\r"], '', $value);

        return $this;
    }

    /**
     * Sets Encoding Type
     * 
     * @param string $type = '8bit' - options[7bit|8bit]
     * 
     * @return Sender
     */
    public function encodingType(String $type = '8bit') : Sender
    {
        $this->encodingType = $type;

        return $this;
    }

    /**
     * Sets multipart
     * 
     * @param string $multiPart = 'related' - options[related|alternative|mixed]
     * 
     * @return Sender
     */
    public function multiPart(String $multiPart = 'related') : Sender
    {
        $this->multiPart = $multiPart;

        return $this;
    }

    /**
     * Sets SMTP Host
     * 
     * @param string $host
     * 
     * @return Snder
     */
    public function smtpHost(String $host) : Sender
    {
        $this->smtpHost = $host;

        return $this;
    }

    /**
     * Sets SMTP User
     * 
     * @param string $user
     * 
     * @return Sender
     */
    public function smtpUser(String $user) : Sender
    {
        $this->smtpUser = $user;

        return $this;
    }

    /**
     * Sets SMTP DSN
     * 
     * @param bool $dsn = true
     * 
     * @return Sender
     */
    public function smtpDsn(Bool $dsn = true) : Sender
    {
        $this->smtpDsn = $dsn;

        return $this;
    }

    /**
     * Sets SMTP Passowrd
     * 
     * @param string $pass
     * 
     * @return Sender
     */
    public function smtpPassword(String $pass) : Sender
    {
        $this->smtpPassword = $pass;

        return $this;
    }

    /**
     * Sets SMTP Port
     * 
     * @param int port = 587
     * 
     * @param Sender
     */
    public function smtpPort(Int $port = 587) : Sender
    {
        $this->smtpPort = $port;

        return $this;
    }

    /**
     * Sets SMTP Timeout
     * 
     * @param int $timeout = 10
     * 
     * @return Sender
     */
    public function smtpTimeout(Int $timeout = 10) : Sender
    {
        $this->smtpTimeout = $timeout;

        return $this;
    }

    /**
     * Sets SMTP Keep Alive
     * 
     * @param bool $keepAlive = true
     * 
     * @return Sender
     */
    public function smtpKeepAlive(Bool $keepAlive = true) : Sender
    {
        $this->smtpKeepAlive = $keepAlive;

        return $this;
    }

    /**
     * Sets SMTP Encode
     * 
     * @param string $encode
     * 
     * @return Sender
     */
    public function smtpEncode(String $encode) : Sender
    {
        $this->smtpEncode = $encode;

        return $this;
    }

    /**
     * To
     * 
     * @param mixed  $to
     * @param string $name = NULL
     * 
     * @return Sender
     */
    public function to($to, String $name = NULL) : Sender
    {
        $this->toEmail($to, $name, 'to');

        return $this;
    }

    /**
     * To / Receiver
     * 
     * @param mixed  $to
     * @param string $name = NULL
     * 
     * @return Sender
     */
    public function receiver($to, String $name = NULL) : Sender
    {
        $this->to($to, $name);

        return $this;
    }

   /**
     * Reply To
     * 
     * @param mixed  $to
     * @param string $name = NULL
     * 
     * @return Sender
     */
    public function replyTo($replyTo, String $name = NULL) : Sender
    {
        $this->toEmail($replyTo, $name, 'replyTo');

        return $this;
    }

    /**
     * CC
     * 
     * @param mixed  $to
     * @param string $name = NULL
     * 
     * @return Sender
     */
    public function cc($cc, String $name = NULL) : Sender
    {
        $this->toEmail($cc, $name, 'cc');

        return $this;
    }

    /**
     * BCC
     * 
     * @param mixed  $to
     * @param string $name = NULL
     * 
     * @return Sender
     */
    public function bcc($bcc, String $name = NULL) : Sender
    {
        $this->toEmail($bcc, $name, 'bcc');

        return $this;
    }

    /**
     * From
     * 
     * @param string $from
     * @param string $name       = NULL
     * @param string $returnPath = NULL
     * 
     * @return Sender
     */
    public function from(String $from, String $name = NULL, String $returnPath = NULL) : Sender
    {
        if( ! IS::email($from) )
        {
            throw new BadEmailAddressException(NULL, $from);
        }

        $this->from = $from;
        $returnPath = $returnPath ?? $from;

        $this->addHeader('From', $name.' <'.$from.'>');
        $this->addHeader('Return-Path', '<'.$returnPath.'>');

        return $this;
    }

    /**
     * From / Sender
     * 
     * @param string $from
     * @param string $name       = NULL
     * @param string $returnPath = NULL
     * 
     * @return Sender
     */
    public function sender(String $from, String $name = NULL, String $returnPath = NULL) : Sender
    {
        $this->from($from, $name, $returnPath);

        return $this;
    }

    /**
     * Subject
     * 
     * @param string $subject
     * 
     * @return Sender
     */
    public function subject(String $subject) : Sender
    {
        $this->subject = $subject;
        $this->addHeader('Subject', $this->subject);

        return $this;
    }

    /**
     * Template
     * 
     * @param string $table
     * @param mixed  $column
     * @param array  $data
     * 
     * @return Sender
     */
    public function template(String $table, $column, Array $data = []) : Sender
    {
        if( $content = Inclusion\Template::use($table, (array) $column, true) )
        {
            $this->message($content);
        }
        else
        {
            $tableEx  = explode(':', $table);
            $columnEx = explode(':', $column); 
    
            $table    = $tableEx[0];
            $column   = $tableEx[1] ?? NULL;

            if( $column === NULL )
            {
                $this->error[] = $this->getLang('email:templateColumnError', '1.($table)');
            }
        
            $whereColumn = $columnEx[0];
            $whereValue  = $columnEx[1] ?? NULL;
            
            if( $whereValue === NULL )
            {
                $this->error[] = $this->getLang('email:templateValueError', '2.($column)');
            }
            
            if( empty($this->error) )
            {
                $content = Singleton::class('ZN\Database\DB')->select($column)->where($whereColumn, $whereValue)->get($table)->value();
                
                $this->message($this->templateMatch($content, $data));
            }
        }

        return $this;
    }

    /**
     * Template Match
     * 
     * @param string $content
     * @param array  $data
     * 
     * @return string
     */
    public function templateMatch(String $content, Array $data) : String
    {
        $newData = array();
        
        foreach( $data as $key => $val )
        {
            $newData[Strings\Trim::middle('{{'.$key.'}}')] = $val;
        }

        return Security\Html::decode(str_replace(array_keys($newData), array_values($newData), $content));
    }

    /**
     * Message
     * 
     * @param string $message
     * 
     * @return Sender
     */
    public function message(String $message) : Sender
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Message / Content
     * 
     * @param string $message
     * 
     * @return Sender
     */
    public function content(String $message) : Sender
    {
        $this->message($message);

        return $this;
    }

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
    public function attachment(String $file, String $disposition = NULL, String $newName = NULL, $mime = NULL) : Sender
    {
        if( $mime !== NULL )
        {
            if( $mimes = Singleton::class('ZN\Helpers\Mime')->$mime() )
            {
                if( is_array($mimes) )
                {
                    $mime = $mimes[0];
                }
                else
                {
                    $mime = $mimes;
                } 
            }

            $fileContent =& $file;
        }

        if( empty($mime) )
        {
            if( strpos($file, '://') === false && ! file_exists($file) )
            {
                $this->error[] = $this->getLang('email:attachmentMissing', $file);
            }

            if( ! $fp = @fopen($file, 'rb') )
            {
                $this->error[] = $this->getLang('email:attachmentUnreadable', $file);
            }

            $fileContent = stream_get_contents($fp);

            fclose($fp);
        }

        $this->attachments[] =
        [
            'name'        => [$file, $newName],
            'disposition' => $disposition ?? 'attachment',
            'type'        => $mime,
            'content'     => chunk_split(base64_encode($fileContent))
        ];

        return $this;
    }

    /**
     * Attachment Content ID
     * 
     * @param string $filename
     * 
     * @return mixed
     */
    public function attachmentContentId(String $filename)
    {
        if( $this->multiPart !== 'related' )
        {
            $this->multiPart = 'related';
        }

        $count = count($this->attachments);

        for( $index = 0; $index < $count; $index++ )
        {
            if( $this->attachments[$index]['name'][0] === $filename )
            {
                $this->attachments[$index]['contentId'] = uniqid(basename($this->attachments[$index]['name'][0]) . '@');

                return $this->attachments[$index]['contentId'];
            }
        }

        return false;
    }

    /**
     * Send
     * 
     * @param string $subject = NULL
     * @param string $message = NULL
     * 
     * @return bool
     */
    public function send(String $subject = NULL, String $message = NULL) : Bool
    {
        if( ! isset($this->headers['From']) )
        {
            if( ! empty($this->senderMail) )
            {
                $this->sender($this->senderMail, $this->senderName);
            }
            else
            {
                return ! $this->error[] = $this->getLang('email:noFrom');
            }
        }

        if( ! empty($subject) )
        {
            $this->subject($subject);
        }

        if( ! empty($message) )
        {
            $this->message($message);
        }

        if( ! empty($this->to) )
        {
            $this->addHeader('To', $this->toString($this->to));
        }

        if( ! empty($this->cc) )
        {
            $this->addHeader('Cc', $this->toString($this->cc));
        }

        if( ! empty($this->bcc) )
        {
            $this->addHeader('Bcc', $this->toString($this->bcc));
        }

        $this->buildContent();

        $settings =
        [
            'host'       => $this->smtpHost,
            'user'       => $this->smtpUser,
            'password'   => $this->smtpPassword,
            'from'       => $this->from,
            'port'       => $this->smtpPort,
            'encoding'   => $this->encodingType,
            'timeout'    => $this->smtpTimeout,
            'cc'         => $this->cc,
            'bcc'        => $this->bcc,
            'authLogin'  => $this->smtpAuth,
            'encode'     => $this->smtpEncode,
            'keepAlive'  => $this->smtpKeepAlive,
            'dsn'        => $this->smtpDsn,
            'tos'        => $this->to,
            'mailPath'   => $this->mailPath,
            'returnPath' => $this->headers['Return-Path']
        ];
        
        $send = $this->driver->send(key($this->to), $this->subject, $this->message, $this->header, $settings);

        if( empty($send) )
        {
            return ! $this->error[] = $this->getLang('email:noSend');
        }

        $this->defaultVariables();

        return $send;
    }

    /**
     * Protected Build Headers
     */
    protected function buildHeaders()
    {
        $this->addHeader('X-Sender',     $this->headers['From']);
        $this->addHeader('X-Mailer',     $this->xMailer);
        $this->addHeader('X-Priority',   $this->priorityTypes[$this->priority]);
        $this->addHeader('Message-ID',   $this->getMessageId());
        $this->addHeader('Mime-Version', $this->mimeVersion);
        $this->addHeader('Date',         $this->getDate());
    }

    /**
     * Protected Get Date
     */
    protected function getDate()
    {
        $timezone = date('Z');
        $operator = ( $timezone[0] === '-' ) ? '-' : '+';
        $timezone = abs($timezone);
        $timezone = floor($timezone/3600) * 100 + ($timezone % 3600) / 60;

        return sprintf('%s %s%04d', date('D, j M Y H:i:s'), $operator, $timezone);
    }

    /**
     * Protected Mime Message
     */
    protected function mimeMessage()
    {
        return $this->getLang('email:mimeMessage', $this->lf);
    }

    /**
     * Protected Write Headers
     */
    protected function writeHeaders()
    {
        foreach( $this->headers as $key => $val )
        {
            $val = trim($val);

            if( ! empty($val) )
            {
                $this->header .= $key.': '.$val.$this->lf;
            }
        }
    }

    /**
     * Protected Get Message ID
     */
    protected function getMessageId()
    {
        $from = str_replace(['>', '<'], '', $this->headers['Return-Path']);

        return '<' . uniqid('') . strstr($from, '@') . '>';
    }

    /**
     * Protected to Array
     */
    protected function toArray($email)
    {
        if( ! is_array($email) )
        {
            return ( strpos($email, ',') !== false )
                   ? preg_split('/[\s,]/', $email, -1, PREG_SPLIT_NO_EMPTY)
                   : (array)trim($email);
        }

        return $email;
    }

    /**
     * Protected to String
     */
    protected function toString($email)
    {
        if( is_array($email) )
        {
            $string = '';

            foreach( $email as $key => $val )
            {
                if( IS::email($key) )
                {
                    $string .= "$val <$key>, ";
                }
            }

            $email = substr(trim($string), 0, -1);
        }

        return $email;
    }

    /**
     * Protected Boundary
     */
    protected function boundary()
    {
        $this->boundary = 'BOUNDARY_'.md5(uniqid(time()));
    }

    /**
     * Protected Build Content
     */
    protected function buildContent()
    {
        $this->buildHeaders();
        $this->boundary();
        $this->writeHeaders();

        $body = ''; $header = '';

        if( in_array($this->multiPart, $this->multiParts) && ! empty($this->attachments) )
        {
            $header .= 'Content-Type: multipart/'.$this->multiPart.'; boundary="'.$this->boundary.'"';

            $body   .= $this->mimeMessage().$this->lf.$this->lf;
            $body   .= '--'.$this->boundary.$this->lf;
            $body   .= 'Content-Type: text/'.$this->contentType.'; charset='.$this->charset.$this->lf;
            $body   .= 'Content-Transfer-Encoding: '.$this->encodingType.$this->lf.$this->lf;
            $body   .= $this->message.$this->lf.$this->lf;

            $attachment = [];

            for( $i = 0, $z = 0; $i < count($this->attachments); $i++ )
            {
                $filename = $this->attachments[$i]['name'][0];
                $basename = $this->attachments[$i]['name'][1] ?? basename($filename);

                $attachment[$z++] = '--'.$this->boundary.$this->lf.
                                    'Content-Type: '.$this->attachments[$i]['type'].'; name="'.$basename.'"'.$this->lf.
                                    'Content-Disposition: '.$this->attachments[$i]['disposition'].';'.$this->lf.
                                    'Content-Transfer-Encoding: base64'.$this->lf.
                                    ( empty($this->attachments[$i]['contentId'] )
                                    ? ''
                                    : 'Content-ID: <'.$this->attachments[$i]['contentId'].'>'.$this->lf);

                $attachment[$z++] = $this->attachments[$i]['content'];
            }

            $body .= implode($this->lf, $attachment).$this->lf.'--'.$this->boundary.'--';
        }
        else
        {
            $header .= 'Content-Type: text/'.$this->contentType.'; charset='.$this->charset.$this->lf;
        }

        if( $this->selectedDriverName === 'smtp' )
        {
            $this->message = $header.$this->lf.$this->lf.$body.$this->message.$this->lf.$this->lf;
        }
        else
        {
            $this->header = $header.$body;
        }

        return true;
    }

    /**
     * Protected To
     */
    protected function toEmail($to, $name, $type = 'to')
    {
        if( is_array($to) )
        {
            if( ! empty($to) ) foreach( $to as $key => $val )
            {
                if( IS::email($key) )
                {
                    $this->{$type}[$key] = $val;
                }
            }
        }
        else
        {
            if( IS::email($to) )
            {
                $this->{$type}[$to] = $name;
            }
            else
            {
                throw new BadEmailAddressException($to);
            }
        }
    }

    /**
     * Protected Default Variables
     */
    protected function defaultVariables()
    {
        $this->subject      = '';
        $this->message      = '';
        $this->header       = '';
        $this->headers      = [];
        $this->addHeader('Date', $this->getDate());
        $this->attachments  = [];
        $this->senderMail   = '';
        $this->senderName   = '';
        $this->charset      = 'UTF-8';
        $this->contentType  = 'plain';
        $this->cc           = NULL;
        $this->bcc          = NULL;
        $this->smtpHost     = '';
        $this->smtpUser     = '';
        $this->smtpPassword = '';
        $this->smtpEncode   = '';
        $this->smtpPort     = 587;
        $this->smtpTimeout  = 10;
        $this->smtpAuth     = true;
        $this->smtpDsn      = false;
        $this->smtpKeepAlive = false;
        $this->mimeVersion  = '1.0';
        $this->boundary     = '';
        $this->multiPart    = 'mixed';
        $this->priority     = 3;
        $this->encodingType = '8bit';
        $this->to           = [];
        $this->replyTo      = [];
        $this->from         = NULL;
        $this->driver       = NULL;
    }
}
