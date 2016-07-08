<?php
namespace ZN\Services\Drivers;

class SMTPDriver implements EmailDriverInterface
{
	/***********************************************************************************/
	/* SMPT LIBRARY							                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	/*
	/* Sınıf Adı: SmtpDriver
	/* ZN Versiyon: 2.0 Eylül Güncellemesi
	/* Tanımlanma: Mixed
	/* Dahil Edilme: Gerektirmez
	/* Erişim: Email kütüphanesi tarafından kullanılmaktadır.
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* 
	 * Satır sonu karakter bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * @var string \r\n
	 */
	protected $lf = "\n";
	
	/* 
	 * Soket bağlantı bilgisini
	 * tutmak için oluşturulmuştur.
	 * 
	 * @var object
	 */ 
	protected $connect;

	/******************************************************************************************
	* CONSTRUCT                                                                               *
	*******************************************************************************************
	| Genel Kullanım: SMTP gönderimi yapılandırılıyor.										  |
	
	  @param  $to
	  @return object
	|          																				  |
	******************************************************************************************/
	public function __construct($to = '', $subject = '', $body = '', $headers = '', $settings = [])
	{
		$this->to 		  = $to;
		$this->subject    = $subject;
		$this->body 	  = $body;
		$this->header	  = $headers;
		$this->host		  = isset($settings['host'])      ? $settings['host']   	: '';
		$this->user   	  = isset($settings['user'])      ? $settings['user'] 		: '';
		$this->password   = isset($settings['password'])  ? $settings['password'] 	: '';
		$this->from 	  = isset($settings['from'])      ? $settings['from'] 		: '';
		$this->port       = isset($settings['port'])      ? $settings['port'] 		: 587;
		$this->encoding	  = isset($settings['encoding'])  ? $settings['encoding'] 	: '';
		$this->timeout	  = isset($settings['timeout'])   ? $settings['timeout'] 	: '';
		$this->cc		  = isset($settings['cc'])        ? $settings['cc'] 		: '';
		$this->bcc		  = isset($settings['bcc'])       ? $settings['bcc'] 		: '';	
		$this->auth		  = isset($settings['authLogin']) ? $settings['authLogin'] 	: '';
		$this->encode     = isset($settings['encode'])    ? $settings['encode'] 	: '';
		$this->keepAlive  = isset($settings['keepAlive']) ? $settings['keepAlive'] 	: '';
		$this->dsn		  = isset($settings['dsn'])       ? $settings['dsn'] 		: '';
		$this->tos		  = isset($settings['tos'])       ? $settings['tos'] 		: [];
	}
	
	public function sendEmail()
	{
		$connect = $this->_connect();
		$sending = $this->_sending();
		
		return $sending;
	}
	
	protected function _connect()
	{
		if( is_resource($this->connect) )
		{
			return true;
		}
	
		$ssl = $this->encode === 'ssl' 
			 ? 'ssl://' 
			 : '';
		
		$this->connect = fsockopen($ssl.$this->host, $this->port, $errno, $errstr, $this->timeout);
		
		if( ! is_resource($this->connect) )
		{
			return \Errors::set('Email', 'smtpError', $errno.' '.$errstr);
		}
		
		stream_set_timeout($this->connect, $this->timeout);
		\Errors::set($this->_getData());
		
		if( $this->encode === 'tls' )
		{
			$this->_setCommand('hello');
			$this->_setCommand('starttls');
			
			$crypto = stream_socket_enable_crypto($this->connect, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
			
			if( $crypto !== true )
			{
				return \Errors::set('Email', 'smtpError', $this->_getData());
			}
		}
		
		return $this->_setCommand('hello');
	}
	
	protected function _sending()
	{
		if( empty($this->host) )
		{
			return \Errors::set('Error', 'noHostName');
		}
		
		if( ! $this->_connect() || ! $this->_authLogin() )
		{
			return false;
		}
		
		$this->_setCommand('from', $this->from);
		
		if( ! empty($this->tos) ) 
		{
			foreach( $this->tos as $key => $val )
			{ 
				$this->_setCommand('to', $key);
			}
		}
		
		if( ! empty($this->cc) )
		{
			foreach( $this->cc as $key => $val )
			{
				$this->_setCommand('to', $key);
			}
		}
		
		if( ! empty($this->bcc) )
		{
			foreach( $this->bcc as $key => $val )
			{
				$this->_setCommand('to', $key);
			}
		}
		
		$this->_setCommand('data');
		
		$this->_setData($this->header.preg_replace('/^\./m', '..$1', $this->body));
		
		$this->_setData('.');
		
		$reply = $this->_getData();
		
		\Errors::set($reply);
		
		if( strpos($reply, '250') !== 0 )
		{
			return \Errors::set('Email', 'smtpError', $reply);
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
	
	protected function _authLogin()
	{
		if( ! $this->auth )
		{
			return true;
		}
		
		if( $this->user === '' && $this->password === '' )
		{
			return \Errors::set('Email', 'noSmtpUnpassword');
		}
		
		$this->_setData('AUTH LOGIN');
		$reply = $this->_getData();
		
		if( strpos($reply, '503') === 0 )
		{
			return true;
		}
		elseif( strpos($reply, '334') !== 0 )
		{
			return \Errors::set('Email', 'failedSmtpLogin', $reply);
		}
		
		$this->_setData(base64_encode($this->user));	
		$reply = $this->_getData();
		
		if( strpos($reply, '334') !== 0 )
		{
			return \Errors::set('Email', 'smtpAuthUserName', $reply);
		}
		
		$this->_setData(base64_encode($this->password));
		$reply = $this->_getData();
		
		if( strpos($reply, '235') !== 0 )
		{
			return \Errors::set('Email', 'smtpAuthPassword', $reply);
		}
		
		return true;
	}
	
	protected function _setCommand($cmd, $data = '')
	{
		
		switch( $cmd )
		{
			case 'hello' :
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
			
			case 'starttls'	:
				$this->_setData('STARTTLS');
				$resp = 220;
			break;
			
			case 'from' :
				$this->_setData('MAIL FROM:<'.$data.'>');
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
			
			case 'data'	:
				$this->_setData('DATA');
				$resp = 354;
			break;
			
			case 'reset':
				$this->_setData('RSET');
				$resp = 250;
			break;
			
			case 'quit'	:
				$this->_setData('QUIT');
				$resp = 221;
			break;
		}
		
		$reply = $this->_getData();
		
		\Errors::set($cmd.': '.$reply);
		
		if( (int)substr($reply, 0, 3) !== $resp )
		{
			return \Errors::set('Email', 'smtpError', $reply);
		}
		
		if( $cmd === 'quit' )
		{
			fclose($this->connect);
		}
		
		return true;
	}
	
	protected function _setData($data)
	{
		$data .= $this->lf;
		
		for( $written = $timestamp = 0, $length = strlen($data); $written < $length; $written += $result )
		{
			$result = fwrite($this->connect, substr($data, $written));
			
			if( $result === false )
			{
				break;
			}
		}
		if( $result === false )
		{
			return \Errors::set('Email', 'smtpDataFailure', $data);
		}
		
		return true;
	}
	
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
	
	public function send($to, $subject, $message, $headers, $settings)
	{
		$smtp = new self($to, $subject, $message, $headers, $settings);
		
		return $smtp->sendEmail();
	}   
}