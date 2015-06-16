<?php
/************************************************************/
/*                  SEND MAIL COMPONENT                     */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
namespace SendMail;

use Email;
use Config;
/******************************************************************************************
* EMAIL                                                                                   *
*******************************************************************************************
| Sınıfı Kullanırken      :	$this->csendmail->     									      |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/
class CSendMail
{
	/* Settings Değişkeni
	 *  
	 * Yükleme ayar bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private $settings = array();
	
	/******************************************************************************************
	* CONSTRUCT                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Email kütüphanesi ve ayarları dahil ediliyor.				 			  |
	|          																				  |
	******************************************************************************************/
	public function __construct()
	{
		$this->settings = Config::get('Email');
			
		Email::open();
	}
	
	/******************************************************************************************
	* USERNAME                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Gönderici e-posta adresi bildirmek için kullanılır.					  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @username => Kullanıcı e-posta adresi.	  								  |
	|        		  																		  |
	| Örnek Kullanım: ->username('bilgi@zntr.net')                                  		  |
	|          																				  |
	|          																				  |
	******************************************************************************************/
	public function username($username = '')
	{
		if( ! empty($username) )
		{
			$this->settings['username'] = $username;	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* PASSWORD                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Gönderici e-posta şifresi bildirmek için kullanılır.					  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @password => Kullanıcı e-posta şifresi.	  								  |
	|        		  																		  |
	| Örnek Kullanım: ->password('zntr1234')                                  		  	      |
	|          																				  |
	|          																				  |
	******************************************************************************************/
	public function password($password = '')
	{
		if( ! empty($password) )
		{
			$this->settings['password'] = $password;	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* HOST                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Hangi sunucu üzeriden gönderileceğini belirtmek için kullanılır.		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @host => E-postanın gönderiminde yararlanacak sunucu adresi.	  		  |
	|        		  																		  |
	| Örnek Kullanım: ->host('mail.zntr.net')                                  		  	      |
	|          																				  |
	******************************************************************************************/
	public function host($host = '')
	{
		if( ! empty($host) )
		{
			$this->settings['host'] = $host;	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* PORT                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Gönderimin hangi port üzerinden gerçekleştirileceğidir.		  		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @port => E-postanın gönderiminde yararlanacak port bilgisi. Vs:587	  	  |
	|        		  																		  |
	| Örnek Kullanım: ->port(587)                                  		  	      			  |
	|          																				  |
	******************************************************************************************/
	public function port($port = 587)
	{
		if( ! empty($port) )
		{
			$this->settings['port'] = $port;	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* SMTP AUTH                                                                               *
	*******************************************************************************************
	| Genel Kullanım: SMPT kimlik doğrulama yapılsın mı?		  		  					  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. boolean var @auth => Kimlik doğrulansın mı?. 										  |
	|        		  																		  |
	| Örnek Kullanım: ->smtp_auth(true)                                  		  	      	  |
	|          																				  |
	******************************************************************************************/
	public function smtpAuth($smtp_auth = '')
	{
		if( ! empty($smtp_auth) )
		{
			$this->settings['smtp-auth'] = $smtp_auth;	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* SMTP DEBUG                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Test için hata ayıklama yapılsın mı?		  		  					  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @debug => Kimlik doğrulansın mı?. 										  |
	|        		  																		  |
	| Örnek Kullanım: ->smtp_debug(2)                                  		  	      	  	  |
	|          																				  |
	******************************************************************************************/
	public function smtpDebug($smtp_debug = '')
	{
		if( ! empty($smtp_debug) )
		{
			$this->settings['smtp-debug'] = $smtp_debug;	
		}
		
		return $this;
	}
		
	/******************************************************************************************
	* SETTINGS                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Genel olarak tüm ayarları yapılandırmak için kullanılır.				  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. array var @settings => Yapılacak ayarlar dizisi. 								      |
	|        		  																		  |
	| Örnek Kullanım: ->settings(array('charset' => 'utf-8'))                                 |
	|          																				  |
	******************************************************************************************/
	public function settings($settings = array())
	{
		if( ! empty($settings) )
		{
			if( is_array($settings) ) foreach($settings as $key => $val)
			{
				$this->settings[$key] = $val;	
			}
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* CONTENT                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: E-postanın içeriğini oluşturmak için kullanılır.				  		  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @message => Gönderilecek mesajın içeriği. 								  |
	| 2. string var @type => Gönderilecek mesajın içeriğinin kodlama türü. html, text		  |
	|        		  																		  |
	| Örnek Kullanım: ->content('Hoş Geldiniz', 'html')                                       |
	|          																				  |
	******************************************************************************************/
	public function content($message = '', $type = 'html')
	{
		Email::message($message);	
	
		if( $type === 'html' )
		{
			$this->settings['is-html'] = true;	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* MESSAGE / CONTENT                                                                       *
	*******************************************************************************************
	| Genel Kullanım: E-postanın içeriğini oluşturmak için kullanılır.				  		  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @message => Gönderilecek mesajın içeriği. 								  |
	| 2. string var @type => Gönderilecek mesajın içeriğinin kodlama türü. html, text		  |
	|        		  																		  |
	| Örnek Kullanım: ->content('Hoş Geldiniz', 'html')                                       |
	|          																				  |
	******************************************************************************************/
	public function message($message = '', $type = 'html')
	{
		$this->content($message, $type);
		
		return $this;
	}
	
	/******************************************************************************************
	* SUBJECT                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: E-postanın konusunu belirlemek için kullanılır.	  					  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @subject => Kimlik doğrulansın mı?. 									  |
	|        		  																		  |
	| Örnek Kullanım: ->subject('Bu Bir Denemedir')                                  		  |
	|          																				  |
	******************************************************************************************/
	public function subject($subject = '')
	{
		Email::subject($subject);
		
		return $this;
	}
	
	/******************************************************************************************
	* SENDER                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Gönderici e-posta adresi.					 	 	  					  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @email => E-posta adresi. 									  			  |
	| 2. string var @name => Gönderenin adı. 									  			  |
	|        		  																		  |
	| Örnek Kullanım: ->sender('bilgi@zntr.net', 'ZNTR')                                  	  |
	|          																				  |
	******************************************************************************************/
	public function sender($email = '', $name = '')
	{
		Email::sender($email, $name);
		
		return $this;
	}
	
	/******************************************************************************************
	* FROM / SENDER                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Gönderici e-posta adresi.					 	 	  					  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @email => E-posta adresi. 									  			  |
	| 2. string var @name => Gönderenin adı. 									  			  |
	|        		  																		  |
	| Örnek Kullanım: ->sender('bilgi@zntr.net', 'ZNTR')                                  	  |
	|          																				  |
	******************************************************************************************/
	public function from($email = '', $name = '')
	{
		$this->sender($email, $name);
		
		return $this;
	}
	
	/******************************************************************************************
	* RECIVER                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Alıcı e-posta adresi.					 	 	  					      |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @email => E-posta adresi. 									  			  |
	| 2. string var @name => Alıcının adı. 									  			      |
	|        		  																		  |
	| Örnek Kullanım: ->receiver('bilgi@zntr.net', 'ZNTR')                                    |
	|          																				  |
	******************************************************************************************/
	public function receiver($email = '', $name = '')
	{
		Email::receiver($email, $name);
		
		return $this;
	}
	
	/******************************************************************************************
	* TO / RECIVER                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Alıcı e-posta adresi.					 	 	  					      |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @email => E-posta adresi. 									  			  |
	| 2. string var @name => Alıcının adı. 									  			      |
	|        		  																		  |
	| Örnek Kullanım: ->to('bilgi@zntr.net', 'ZNTR')                                          |
	|          																				  |
	******************************************************************************************/
	public function to($email = '', $name = '')
	{
		$this->receiver($email, $name);
		
		return $this;
	}
	
	/******************************************************************************************
	* IS HTML                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Mesajda html kodları kullanılsın mı?.	  					  			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. boolean var @html => İçerikte html kullanımı. Varsayılan:true 						  |
	|        		  																		  |
	| Örnek Kullanım: ->is_html(false)                                  		  			  |
	|          																				  |
	******************************************************************************************/
	public function isHtml($html = true)
	{
		if( ! empty($html) )
		{
			$this->settings['is-html'] = $html;	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* SMTP SECURE                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Sunucu ön eki güvenlik ayarı.	  					  			          |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. boolean var @html => İçerikte html kullanımı. Varsayılan:true 						  |
	|        		  																		  |
	| Örnek Kullanım: ->smtp_secure('tsl')                                  	 			  |
	|          																				  |
	******************************************************************************************/
	public function smtpSecure($secure = 'tsl')
	{
		if( ! empty($secure) )
		{
			$this->settings['smtp-secure'] = $secure;	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* IS SMTP                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: E-posta gönderilirken smtp'den yararlanılsın mı?.	  					  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. boolean var @smpt => SMPT. Varsayılan:true 						                  |
	|        		  																		  |
	| Örnek Kullanım: ->is_smtp(true)                                  	 			  		  |
	|          																				  |
	******************************************************************************************/
	public function isSmtp($smtp = true)
	{
		if( ! empty($smtp) )
		{
			$this->settings['is-smtp'] = $smtp;	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* ERROR                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: E-posta gönderilirken smtp'den yararlanılsın mı?.	  					  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. boolean var @smpt => SMPT. Varsayılan:true 						                  |
	|        		  																		  |
	| Örnek Kullanım: ->is_smtp(true)                                  	 			  		  |
	|          																				  |
	******************************************************************************************/
	public function error()
	{
		return Email::error();
	}
	
	/******************************************************************************************
	* CHARSET                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: E-posta içeriğinin karakter kodlamasını ayarlamak için kullanılır.      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @charset => Karakter kodlaması. Varsayılan:utf-8 						  |
	|        		  																		  |
	| Örnek Kullanım: ->charset('utf-8')                                  	 			      |
	|          																				  |
	******************************************************************************************/
	public function charset($charset = 'utf-8')
	{
		if( ! empty($charset) )
		{
			$this->settings['charset'] = $charset;	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* ATTACHMENT                                                                              *
	*******************************************************************************************
	| Genel Kullanım: E-posta ile dosya göndermek için kullanılır.				  	 	      |
	|															                              |
	******************************************************************************************/
	public function attachment($attach = '', $file_name = '', $encoding = 'base64', $type = 'application/octet-stream')
	{
		Email::addAttachment($attach, $file_name, $encoding, $type);
		
		return $this;
	}

	/******************************************************************************************
	* SEND                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: E-posta içeriğinin karakter kodlamasını ayarlamak için kullanılır.      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @charset => Karakter kodlaması. Varsayılan:utf-8 						  |
	|        		  																		  |
	| Örnek Kullanım: ->charset('utf-8')                                  	 			      |
	|          																				  |
	******************************************************************************************/
	public function send($subject = '', $message = '')
	{
		if( ! empty($this->settings) )
		{
			Email::settings($this->settings);
		}
		
		$this->settings = NULL;
		
		return Email::send($subject, $message);
	}
	
	/******************************************************************************************
	* DESTRUCT                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Email gönderimi kapatılıyor.				 				 			  |
	|          																				  |
	******************************************************************************************/
	public function __destruct()
	{
		Email::close();	
	}
}