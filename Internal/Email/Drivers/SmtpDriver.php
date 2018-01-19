<?php namespace ZN\Email\Drivers;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Email\DriverMappingAbstract;
use ZN\Email\Exception\SMTPConnectException;
use ZN\Email\Exception\SMTPEmptyHostNameException;
use ZN\Email\Exception\SMTPEmptyUserPasswordException;
use ZN\Email\Exception\SMTPFailedLoginException;
use ZN\Email\Exception\SMTPDataFailureException;
use ZN\Email\Exception\SMTPAuthException;
use ZN\Email\Exception\SMTPAuthPasswordException;

class SmtpDriver extends DriverMappingAbstract
{
    /**
     * @var string
     */
    protected $lf = "\n";

    /**
     * Keeps connection
     * 
     * @var object
     */
    protected $connect;

    /**
     * Magic Constructor
     * 
     * @param string $to
     * @param string $subject
     * @param string $message
     * @param mixed  $headers
     * @param mixed  $settings
     */
    public function __construct($to = '', $subject = '', $body = '', $headers = '', $settings = [])
    {
        $this->to         = $to;
        $this->subject    = $subject;
        $this->body       = $body;
        $this->header     = $headers;
        $this->host       = $settings['host']      ?? '';
        $this->user       = $settings['user']      ?? '';
        $this->password   = $settings['password']  ?? '';
        $this->from       = $settings['from']      ?? '';
        $this->port       = $settings['port']      ?? 587;
        $this->encoding   = $settings['encoding']  ?? '';
        $this->timeout    = $settings['timeout']   ?? '';
        $this->cc         = $settings['cc']        ?? '';
        $this->bcc        = $settings['bcc']       ?? '';
        $this->auth       = $settings['authLogin'] ?? '';
        $this->encode     = $settings['encode']    ?? '';
        $this->keepAlive  = $settings['keepAlive'] ?? '';
        $this->dsn        = $settings['dsn']       ?? '';
        $this->tos        = $settings['tos']       ?? [];
    }

    /**
     * Send Email
     * 
     * @param string $to
     * @param string $subject
     * @param string $message
     * @param mixed  $headers
     * @param mixed  $settings
     * 
     * @return bool
     */
    public function send($to, $subject, $message, $headers, $settings)
    {
        $smtp = new self($to, $subject, $message, $headers, $settings);

        return $smtp->sendEmail();
    }

    /**
     * Send Email
     * 
     * @return void|true
     */
    public function sendEmail()
    {
        $connect = $this->connect();
        $sending = $this->sending();

        return $sending;
    }

    /**
     * Protected Connect
     */
    protected function connect()
    {
        if( is_resource($this->connect) )
        {
            return true;
        }

        $ssl = $this->encode === 'ssl' ? 'ssl://' : '';

        $this->connect = fsockopen($ssl.$this->host, $this->port, $errno, $errstr, $this->timeout);

        if( ! is_resource($this->connect) )
        {
            throw new SMTPConnectException(NULL, $errno.' '.$errstr);
        }

        stream_set_timeout($this->connect, $this->timeout);

        $this->error[] = $this->getData();

        if( $this->encode === 'tls' )
        {
            $this->setCommand('hello');
            $this->setCommand('starttls');

            $crypto = stream_socket_enable_crypto($this->connect, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);

            if( $crypto !== true )
            {
                throw new SMTPConnectException(NULL, $this->getData());
            }
        }

        return $this->setCommand('hello');
    }

    /**
     * Protected Sending
     */
    protected function sending()
    {
        if( empty($this->host) )
        {
            throw new SMTPEmptyHostNameException;
        }

        if( ! $this->connect() || ! $this->authLogin() )
        {
            return false;
        }

        $this->setCommand('from', $this->from);

        if( ! empty($this->tos) ) foreach( $this->tos as $key => $val )
        {
            $this->setCommand('to', $key);
        }

        if( ! empty($this->cc) ) foreach( $this->cc as $key => $val )
        {
            $this->setCommand('to', $key);
        }

        if( ! empty($this->bcc) ) foreach( $this->bcc as $key => $val )
        {
            $this->setCommand('to', $key);
        }

        $this->setCommand('data');

        $this->setData($this->header.preg_replace('/^\./m', '..$1', $this->body));

        $this->setData('.');

        $this->error[] = $reply = $this->getData();

        if( strpos($reply, '250') !== 0 )
        {
            throw new SMTPConnectException(NULL, $reply);
        }

        if( $this->keepAlive )
        {
            $this->setCommand('reset');
        }
        else
        {
            $this->setCommand('quit');
        }

        return true;
    }

    /**
     * Protected Auth Login
     */
    protected function authLogin()
    {
        if( ! $this->auth )
        {
            return true;
        }

        if( $this->user === '' && $this->password === '' )
        {
            throw new SMTPEmptyUserPasswordException;
        }

        $this->setData('AUTH LOGIN');

        $reply = $this->getData();

        if( strpos($reply, '503') === 0 )
        {
            return true;
        }
        elseif( strpos($reply, '334') !== 0 )
        {
            throw new SMTPFailedLoginException(NULL, $reply);
        }

        $this->setData(base64_encode($this->user));

        $reply = $this->getData();

        if( strpos($reply, '334') !== 0 )
        {
            throw new SMTPAuthException(NULL, $reply);
        }

        $this->setData(base64_encode($this->password));

        $reply = $this->getData();

        if( strpos($reply, '235') !== 0 )
        {
            throw new SMTPAuthPasswordException(NULL, $reply);
        }

        return true;
    }

    /**
     * Protected Set Command
     */
    protected function setCommand($cmd, $data = '')
    {
        switch( $cmd )
        {
            case 'starttls' : $this->setData('STARTTLS');              $resp = 220; break;
            case 'from'     : $this->setData('MAIL FROM:<'.$data.'>'); $resp = 250; break;
            case 'data'     : $this->setData('DATA');                  $resp = 354; break;
            case 'reset'    : $this->setData('RSET');                  $resp = 250; break;
            case 'quit'     : $this->setData('QUIT');                  $resp = 221; break;
            case 'hello'    :
                if( $this->auth || $this->encoding === '8bit' )
                {
                    $this->setData('EHLO '.$this->hostname() );
                }
                else
                {
                    $this->setData('HELO '.$this->hostname());
                }

                $resp = 250;
            break;
            case 'to' :
                if( $this->dsn )
                {
                    $this->setData('RCPT TO:<'.$data.'> NOTIFY=SUCCESS,DELAY,FAILURE ORCPT=rfc822;'.$data);
                }
                else
                {
                    $this->setData('RCPT TO:<'.$data.'>');
                }
                $resp = 250;
            break;
        }

        $reply = $this->getData();

        $this->error[] = $cmd.': '.$reply;

        if( (int) substr($reply, 0, 3) !== $resp )
        {
            throw new SMTPConnectException(NULL, $reply);
        }

        if( $cmd === 'quit' )
        {
            fclose($this->connect);
        }

        return true;
    }

    /**
     * Protected Set Data
     */
    protected function setData($data)
    {
        $data .= $this->lf;

        for( $index = 0; $index < strlen($data); $index += $result )
        {
            $result = fwrite($this->connect, substr($data, $index));

            if( $result === false )
            {
                break;
            }
        }
        if( $result === false )
        {
            throw new SMTPDataFailureException(NULL, $data);
        }

        return true;
    }

    /**
     * Protected Get Data
     */
    protected function getData()
    {
        $data = '';

        while( $str = fgets($this->connect, 512) )
        {
            $data .= $str;

            if( $str[3] === ' ' )
            {
                break;
            }
        }

        return $data;
    }

    /**
     * Prortected Host Name
     */
    protected function hostname()
    {
        return $_SERVER['SERVER_NAME'] ?? '[' . ($_SERVER['SERVER_ADDR'] ?? '127.0.0.1') . ']';
    }
}
