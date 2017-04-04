<?php namespace ZN\Services\Remote\Email\Drivers;

use ZN\Services\Remote\Abstracts\EmailMappingAbstract;
use ZN\Services\Remote\Email\Exception\SMTPConnectException;
use ZN\Services\Remote\Email\Exception\SMTPEmptyHostNameException;
use ZN\Services\Remote\Email\Exception\SMTPEmptyUserPasswordException;
use ZN\Services\Remote\Email\Exception\SMTPFailedLoginException;
use ZN\Services\Remote\Email\Exception\SMTPDataFailureException;
use ZN\Services\Remote\Email\Exception\SMTPAuthException;

class SMTPDriver extends EmailMappingAbstract
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // LF
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $lf = "\n";

    //--------------------------------------------------------------------------------------------------------
    // Connect
    //--------------------------------------------------------------------------------------------------------
    //
    // @var resource
    //
    //--------------------------------------------------------------------------------------------------------
    protected $connect;

    //--------------------------------------------------------------------------------------------------------
    // Construct
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $to
    // @param string $subject
    // @param string $message
    // @param mixed  $headers
    // @param mixed  $settings
    //
    //--------------------------------------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------------
    // Send
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $to
    // @param string $subject
    // @param string $message
    // @param mixed  $headers
    // @param mixed  $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function send($to, $subject, $message, $headers, $settings)
    {
        $smtp = new self($to, $subject, $message, $headers, $settings);

        return $smtp->sendEmail();
    }

    //--------------------------------------------------------------------------------------------------------
    // Send Email
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function sendEmail()
    {
        $connect = $this->_connect();
        $sending = $this->_sending();

        return $sending;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Connect
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _connect()
    {
        if( is_resource($this->connect) )
        {
            return true;
        }

        $ssl = $this->encode === 'ssl' ? 'ssl://' : '';

        $this->connect = fsockopen($ssl.$this->host, $this->port, $errno, $errstr, $this->timeout);

        if( ! is_resource($this->connect) )
        {
            throw new SMTPConnectException('Services', 'email:smtpError', $errno.' '.$errstr);
        }

        stream_set_timeout($this->connect, $this->timeout);

        $this->error[] = $this->_getData();

        if( $this->encode === 'tls' )
        {
            $this->_setCommand('hello');
            $this->_setCommand('starttls');

            $crypto = stream_socket_enable_crypto($this->connect, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);

            if( $crypto !== true )
            {
                throw new SMTPConnectException('Services', 'email:smtpError', $this->_getData());
            }
        }

        return $this->_setCommand('hello');
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Sending
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _sending()
    {
        if( empty($this->host) )
        {
            throw new SMTPEmptyHostNameException('Services', 'email:noHostName');
        }

        if( ! $this->_connect() || ! $this->_authLogin() )
        {
            return false;
        }

        $this->_setCommand('from', $this->from);

        if( ! empty($this->tos) ) foreach( $this->tos as $key => $val )
        {
            $this->_setCommand('to', $key);
        }

        if( ! empty($this->cc) ) foreach( $this->cc as $key => $val )
        {
            $this->_setCommand('to', $key);
        }

        if( ! empty($this->bcc) ) foreach( $this->bcc as $key => $val )
        {
            $this->_setCommand('to', $key);
        }

        $this->_setCommand('data');

        $this->_setData($this->header.preg_replace('/^\./m', '..$1', $this->body));

        $this->_setData('.');

        $this->error[] = $reply = $this->_getData();

        if( strpos($reply, '250') !== 0 )
        {
            throw new SMTPConnectException('Services', 'email:smtpError', $reply);
        }

        if( $this->keepAlive )
        {
            $this->_setCommand('reset');
        }
        else
        {
            $this->_setCommand('quit');
        }

        return true;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Auth Login
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _authLogin()
    {
        if( ! $this->auth )
        {
            return true;
        }

        if( $this->user === '' && $this->password === '' )
        {
            throw new SMTPEmptyUserPasswordException('Services', 'email:noSmtpUnpassword');
        }

        $this->_setData('AUTH LOGIN');

        $reply = $this->_getData();

        if( strpos($reply, '503') === 0 )
        {
            return true;
        }
        elseif( strpos($reply, '334') !== 0 )
        {
            throw new SMTPFailedLoginException('Services', 'email:failedSmtpLogin', $reply);
        }

        $this->_setData(base64_encode($this->user));

        $reply = $this->_getData();

        if( strpos($reply, '334') !== 0 )
        {
            throw new SMTPAuthException('Services', 'email:smtpAuthUserName', $reply);
        }

        $this->_setData(base64_encode($this->password));

        $reply = $this->_getData();

        if( strpos($reply, '235') !== 0 )
        {
            throw new SMTPAuthException('Services', 'email:smtpAuthPassword', $reply);
        }

        return true;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Set Command
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _setCommand($cmd, $data = '')
    {
        switch( $cmd )
        {
            case 'starttls' : $this->_setData('STARTTLS');              $resp = 220; break;
            case 'from'     : $this->_setData('MAIL FROM:<'.$data.'>'); $resp = 250; break;
            case 'data'     : $this->_setData('DATA');                  $resp = 354; break;
            case 'reset'    : $this->_setData('RSET');                  $resp = 250; break;
            case 'quit'     : $this->_setData('QUIT');                  $resp = 221; break;
            case 'hello'    :
                if( $this->auth || $this->encoding === '8bit' )
                {
                    $this->_setData('EHLO '.$this->_hostname() );
                }
                else
                {
                    $this->_setData('HELO '.$this->_hostname());
                }

                $resp = 250;
            break;
            case 'to' :
                if( $this->dsn )
                {
                    $this->_setData('RCPT TO:<'.$data.'> NOTIFY=SUCCESS,DELAY,FAILURE ORCPT=rfc822;'.$data);
                }
                else
                {
                    $this->_setData('RCPT TO:<'.$data.'>');
                }
                $resp = 250;
            break;
        }

        $reply = $this->_getData();

        $this->error[] = $cmd.': '.$reply;

        if( (int) substr($reply, 0, 3) !== $resp )
        {
            throw new SMTPConnectException('Services', 'email:smtpError', $reply);
        }

        if( $cmd === 'quit' )
        {
            fclose($this->connect);
        }

        return true;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Set Data
    //--------------------------------------------------------------------------------------------------------
    //
    // @param $data
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _setData($data)
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
            throw new SMTPDataFailureException('Services', 'email:smtpDataFailure', $data);
        }

        return true;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Get Data
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _getData()
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

    //--------------------------------------------------------------------------------------------------------
    // Protected Host Name
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _hostname()
    {
        if( isset($_SERVER['SERVER_NAME']) )
        {
            return $_SERVER['SERVER_NAME'];
        }

        return isset($_SERVER['SERVER_ADDR'])
               ? '['.$_SERVER['SERVER_ADDR'].']'
               : '[127.0.0.1]';
    }
}
