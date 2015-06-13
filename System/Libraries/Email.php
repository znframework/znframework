<?php
/************************************************************/
/*                       CLASS  EMAIL                       */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* PHP MAILER SINIFI REFERANS ALINARAK OLUŞTURULMUŞTUR.                                    *
*******************************************************************************************
| Bu sınıfın oluşturulmasında PHPMailer sınıfı referans alınmıştır.                       |
|          																				  |
| Camel standartlarında yazılan PHPmailer yöntemleri PHP yazım standartına çevrilmiştir.  |
|          																				  |
| Bu nedenle bu sınıfın kullanımında yer alan bir çok yöntemin nasıl kullanıldığı ile     |
| ilgili detaylı bilgiyi PHPMailer dökümantasyonundan yararlanarak öğrenebilirsiniz.	  |
| biz temel olarak kullanılması gereken ve önemli gördüğümüz yöntemleri anlattık.     	  |
|          																				  |
******************************************************************************************/
/******************************************************************************************
* EMAIL                                                                             	  *
*******************************************************************************************
| Dahil(Import) Edilirken : Email   							                          |
| Sınıfı Kullanırken      :	email::   											          |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/
class Email {
	
	/* Mail Değişkeni
	 *  
	 * E-posta gönderilecek adresini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $mail			= '';
	
	/* From Mail Değişkeni
	 *  
	 * E-posta gönderen adresini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $from_email		= '';
	
	/* From Name Değişkeni
	 *  
	 * E-posta gönderen isim bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $from_name		= '';
	
	/* Subject Değişkeni
	 *  
	 * E-posta konu bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $subject			= '';
	
	/* Message Değişkeni
	 *  
	 * E-posta mesaj bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $message			= '';
	
	/* Error Değişkeni
	 *  
	 * E-posta işlemlerinde oluşan hata bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $error			= '';
	
	/* Detail Değişkeni
	 *  
	 * E-posta işlemleri ile ilgili detaylı bilgiyi
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $detail			= '';
	
	/* Settins Dizi Değişkeni
	 *  
	 * E-posta işlemleri ile ilgili ayarları
	 * tutması için oluşturulmuştur.
	 *
	 * Ayarlarda herhangi bir değişiklik yapılmamışsa
	 * varsayılan olarak ayarlı verileri kullanır.
	 * Bu nedenler ayarların '' işaretleri içinde olması
	 * bu ayarların yapılmadığı anlamına gelmez.
	 *
	 */
	private static $settings 		= array
	(
		'username'					=> '', // kullanici@site.xxx
		'fromname'					=> '', // Kullanici İsmi
		'password'					=> '', // Kullanıcı Şifresi
		'port'						=> '', // Port Numarası
		'host'						=> '', // mail.alanadi.xxx
		'is_html'					=> '', 
		'is_smtp'					=> '', 
		'smtp_auth'					=> '',
		'smtp_debug' 				=> '', // false
		'smtp_secure'				=> '', // 'ssl', 'tsl', ''
		'smtp_keep_alive'			=> '',
		'charset'					=> '',	
		'alt_body'					=> '',
		'priority'					=> '', // 3
		'content'					=> '', // text/plain
		'encoding'					=> '', // 8bit
		'word_wrap'					=> '',
		'send_mail'					=> '', // /usr/sbin/sendmail
		'mailer'					=> '', // mail
		'sender'					=> '',
		'return_path'				=> '',
		'use_send_mail_options' 	=> '', // true
		'lugin_dir' 				=> '',
		'confirm_reading_to' 		=> '',
		'host_name' 				=> '',
		'message_id' 				=> '',
		'message_date' 				=> '',
		'helo'	 					=> '',
		'auth_type'	 				=> '',
		'plugin_dir'				=> '',
		'realm'		 				=> '',
		'work_station'				=> '',
		'timeout'		 			=> '',
		'debug_output'				=> '',
		'single_to'					=> '',
		'single_to_array'			=> array(),
		'le'						=> '',
		'dkim_selector'				=> '',
		'dkim_identity'				=> '',
		'dkim_pass_phrase'			=> '',
		'dkim_domain'				=> '',
		'dkim_private'				=> '',
		'action_function'			=> '',
		'version'					=> '', // 5.2.4
		'xmailer'					=> ''
	);
	
	/******************************************************************************************
	* SETTINGS                                                                                *
	*******************************************************************************************
	| Genel Kullanım: E-posta gönderimi için yapılması gereken ayarları yapmak içindir.		  |
	|															                              |
	| Parametreler: Tek dizi parametresi vardır.                                              |
	| 1. array var @settings => E-posta gönderimi için yapılacak gerekli ayarlar.			  |
	|          																				  |
	| Örnek Kullanım: settings(array('username' => 'xx', 'password' => '12345'))         	  |
	| Geçerli kullanılabilir ayarlar yukarıdaki listede mevcuttur. Genel bir ayarmalama       |
	| için ise Config/Email.php dosyası kullanılabilir.					  					  |
	|          																				  |
	******************************************************************************************/
	public static function settings($settings = array())
	{
		if( is_array($settings) ) 
		{
			foreach($settings as $k => $v)
			{
				self::$settings[$k] = $v;
			}
		}
	}
	
	/******************************************************************************************
	* RECEIVER                                                                                *
	*******************************************************************************************
	| Genel Kullanım: E-posta alıcısının e-posta bilgisini belirlemek içindir.		  		  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string/array var @email => Alıcı e-posta adresidir. Çoklu e-posta gönderimi için     |
	| bu parametrenin dizi olarak ayarlanması gerekmetedir. Bu parametre dizi olarak		  |
	| ayarlanırsa 2. parametrenin kullanımına gerek yoktur.  								  |
	| 2. string var @name => Alıcının isim bilgisini tutar. 1. parametre dizi ise kullanımına |
	| gerek yoktur.         																  |
	|          																				  |
	| Örnek Kullanım: receiver('bilgi@zntr.net', 'ZNTR')        	  						  |
	| Örnek Kullanım: receiver(array('bilgi@zntr.net' => 'ZNTR', '2.eposta' => '2. isim' ...))|
	|          																				  |
	******************************************************************************************/
	public static function receiver($email = '', $name = '')
	{
		if( empty(self::$mail) )
		{
			return false;
		}
		
		if( ! is_string($name) )
		{
			$name = '';
		}
		
		if( isset($email) )
		{
			if( ! is_array($email) ) 
			{
				self::$mail->AddAddress($email, $name);
			}
			else
			{ 
				foreach($email as $e => $n)
				{ 
					self::$mail->AddAddress($e, $n);
				}
			}
		}	
	}
	
	/******************************************************************************************
	* SENDER                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: E-posta göndericisinin e-posta bilgisini belirlemek içindir.		      |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @email => Gönderici e-posta adresidir.       							  |
	| 2. string var @name => Göndericinin isim bilgisini tutar.      					      |
	|          																				  |
	| Örnek Kullanım: sender('bilgi@zntr.net', 'ZNTR')        	  						      |
	|          																				  |
	******************************************************************************************/
	public static function sender($email = '', $name = '')
	{
		if( empty(self::$mail) )
		{
			return false;
		}
		
		if( ! is_string($email) ) 
		{
			return false;
		}
		if( ! is_string($name) )
		{
			$name = '';
		}
		
		self::$from_email = $email;
		self::$from_name  = $name;	
	}
	
	/******************************************************************************************
	* ADD REPLY TO                                                                            *
	******************************************************************************************/
	public static function addReplyTo($email = '', $name = '')
	{
		if( empty(self::$mail) ) 
		{
			return false;
		}
		if( ! is_string($name) ) 
		{
			$name = '';
		}
		if( isset($email) )
		{
			if( ! is_array($email) )
			{ 
				self::$mail->AddReplyTo($email, $name);
			}
			else
			{ 
				foreach($email as $e => $n)
				{
					self::$mail->AddReplyTo($e, $n);
				}
			}
		}
	}
	
	/******************************************************************************************
	* ADD CC                                                                                  *
	******************************************************************************************/
	public static function addCc($email = '', $name = '')
	{
		if( empty(self::$mail) ) 
		{
			return false;
		}
		
		if( ! is_string($name) )
		{
			$name = '';
		}
		if( isset(self::$email) )
		{
			if( ! is_array($email) )
			{ 
				self::$mail->AddCC($email, $name);
			}
			else 
			{
				foreach($email as $e => $n)
				{
					self::$mail->AddCC($e, $n);
				}
			}
		}
	}
	
	/******************************************************************************************
	* ADD BCC                                                                                 *
	******************************************************************************************/
	public static function addBcc($email = '', $name = '')
	{
		if( empty(self::$mail) )
		{
			return false;
		}
		if( ! is_string($name) )
		{
			$name = '';
		}
		if( isset($email) )
		{
			if( ! is_array($email) )
			{ 
				self::$mail->AddBCC($email, $name);
			}
			else
			{ 
				foreach($email as $e => $n) 
				{
					self::$mail->AddBCC($e, $n);
				}
			}
		}
	}
	
	/******************************************************************************************
	* SUBJECT                                                                                 *
	******************************************************************************************/
	public static function subject($subject = '')
	{
		if( ! is_string($subject) )
		{
			return false;
		}
		self::$subject = $subject;
	}
	
	/******************************************************************************************
	* MESSAGE                                                                                 *
	******************************************************************************************/
	public static function message($message = '')
	{
		if( ! is_string($message) )
		{
			return false;
		}
		self::$message = $message;
	}
	
	/******************************************************************************************
	* ERROR                                                                                   *
	******************************************************************************************/
	public static function error()
	{
		return self::$error;
	}
	
	/******************************************************************************************
	* DETAIL                                                                                  *
	******************************************************************************************/
	public static function detail()
	{
		return self::$detail;
	}
	
	/******************************************************************************************
	* OPEN                                                                                    *
	******************************************************************************************/
	public static function open()
	{
		import::package(REFERENCES_DIR.'PHPMailer');	
		self::$mail = new PHPMailer();
	}
	
	/******************************************************************************************
	* IS MAIL                                                                                 *
	******************************************************************************************/
	public static function isMail()
	{
		if( empty(self::$mail) )
		{
			return false;
		}
		self::$mail->IsMail();
	}
	
	/******************************************************************************************
	* IS SEND MAIL                                                                            *
	******************************************************************************************/
	public static function isSendMail()
	{
		if( empty(self::$mail) ) 
		{
			return false;
		}
		self::$mail->IsSendmail();
	}
	
	/******************************************************************************************
	* IS Q MAIL                                                                               *
	******************************************************************************************/
	public static function isQMail()
	{
		if( empty(self::$mail) )
		{
			return false;
		}
		self::$mail->IsQmail();
	}
	
	/******************************************************************************************
	* VALIDATE ADDRESS                                                                        *
	******************************************************************************************/
	public static function validateAddress()
	{
		return self::$mail->ValidateAddress();
	}
	
	/******************************************************************************************
	* PRE SEND                                                                                *
	******************************************************************************************/
	public static function preSend()
	{
		if( empty(self::$mail) ) 
		{
			return false;
		}
		return self::$mail->PreSend();
	}
	
	/******************************************************************************************
	* POST SENT                                                                               *
	******************************************************************************************/
	public static function postSend()
	{
		if( empty(self::$mail) ) 
		{
			return false;
		}
		return self::$mail->PostSend();
	}
	
	/******************************************************************************************
	* SMTP CONNECT                                                                            *
	******************************************************************************************/
	public static function smtpConnect()
	{
		if( empty(self::$mail) ) 
		{
			return false;
		}
		return self::$mail->SmtpConnect();
	}
	
	/******************************************************************************************
	* SMPT CLOSE                                                                              *
	******************************************************************************************/
	public static function smptClose()
	{
		if( empty(self::$mail) ) 
		{
			return false;
		}
		self::$mail->SmtpClose();
	}
	
	/******************************************************************************************
	* ADDR APPEND                                                                             *
	******************************************************************************************/
	public static function addrAppend($type = '', $addr = '')
	{
		if( empty(self::$mail) ) 
		{
			return false;
		}
		
		if( ! is_string($type) ) 
		{
			$type = '';
		}
		
		if( ! is_string($addr) )
		{
			$addr = '';
		}
		
		return self::$mail->AddrAppend($type, $addr);
	}
	
	/******************************************************************************************
	* ADDR FORMAT                                                                             *
	******************************************************************************************/
	public static function addrFormat($addr = '')
	{
		if( empty(self::$mail) ) 
		{
			return false;
		}
		
		if( ! is_string($addr) ) 
		{
			$addr = '';
		}
		
		return self::$mail->AddrFormat($addr);
	}

	/******************************************************************************************
	* WRAP TEXT                                                                               *
	******************************************************************************************/
	public static function wrapText($message = '', $length = 0, $qp_mode = false)
	{
		if( empty(self::$mail) || ! is_string($message) ) 
		{
			return false;
		}
	
		if( ! is_numeric($length) ) 
		{
			$length = 0;
		}
		
		if( ! is_bool($qp_mode) ) 
		{
			$qp_mode = false;
		}
		
		return self::$mail->WrapText($message, $length, $qp_mode);
	}
	
	/******************************************************************************************
	* UTF8 CHAR BOUNDARY                                                                      *
	******************************************************************************************/
	public static function utf8CharBoundary($encode_text = '', $max_length = 0)
	{
		if( empty(self::$mail) || ! is_string($encode_text) ) 
		{
			return false;
		}
		
		if( ! is_numeric($max_length) ) 
		{
			$max_length = 0;
		}
		
		return self::$mail->UTF8CharBoundary($encode_text, $max_length);
	}
	
	/******************************************************************************************
	* SET WORD WRAP                                                                           *
	******************************************************************************************/
	public static function setWordWrap()
	{
		if( empty(self::$mail) ) 
		{
			return false;
		}
		return self::$mail->SetWordWrap();
	}
	
	/******************************************************************************************
	* CREATE HEADER                                                                           *
	******************************************************************************************/
	public static function createHeader()
	{
		if( empty(self::$mail) ) 
		{
			return false;
		}
		return self::$mail->CreateHeader();
	}
	
	/******************************************************************************************
	* GET MAIL MIME                                                                           *
	******************************************************************************************/
	public static function getMailMime()
	{
		if( empty(self::$mail) ) 
		{
			return false;
		}
		return self::$mail->GetMailMIME();
	}
	
	/******************************************************************************************
	* GET SENT MIME MESSAGE                                                                   *
	******************************************************************************************/
	public static function getSentMimeMessage()
	{
		if( empty(self::$mail) ) 
		{
			return false;
		}
		return self::$mail->GetSentMIMEMessage();
	}
	
	/******************************************************************************************
	* CREATE BODY                                                                             *
	******************************************************************************************/
	public static function createBody()
	{
		if( empty(self::$mail) ) 
		{
			return false;
		}
		return self::$mail->CreateBody();
	}
	
	/******************************************************************************************
	* HEADER LINE                                                                             *
	******************************************************************************************/
	public static function hederLine($name = '', $value = '')
	{
		if( empty(self::$mail) || ! is_string($name) ) 
		{
			return false;
		}
		
		if( ! is_string($value) ) 
		{
			$value = '';
		}
		
		return self::$mail->HeaderLine($name, $value);
	}
	
	/******************************************************************************************
	* TEXT LINE                                                                               *
	******************************************************************************************/
	public static function textLine($value = '')
	{
		if( empty(self::$mail) ) 
		{
			return false;
		}
		
		if( ! (is_string($value) || is_numeric($value)) ) 
		{
			return false;
		}
		
		return self::$mail->TextLine($value);
	}
	
	/******************************************************************************************
	* GET ATTACHMENTS                                                                         *
	******************************************************************************************/
	public static function getAttachments()
	{
		if( empty(self::$mail) ) 
		{
			return false;
		}
		return self::$mail->GetAttachments();
	}
	
	/******************************************************************************************
	* ENCODE STRING                                                                           *
	******************************************************************************************/
	public static function encodeString($str = '', $encoding = 'base64')
	{
		if( empty(self::$mail) || ! is_string($str) ) 
		{
			return false;
		}
	
		if( ! is_string($encoding) ) 
		{
			$encoding = 'base64';
		}
		
		return self::$mail->EncodeString($str, $encoding);
	}
	
	/******************************************************************************************
	* ENCODE HEADER                                                                           *
	******************************************************************************************/
	public static function encodeHeader($str = '', $position = 'text')
	{
		if( empty(self::$mail) || ! is_string($str) ) 
		{
			return false;
		}
	
		if( ! is_string($position) ) 
		{
			$position = 'text';
		}
		
		return self::$mail->EncodeHeader($str, $position);
	}
	
	/******************************************************************************************
	* HAS MULTI BYTES                                                                         *
	******************************************************************************************/
	public static function hasMultiBytes($str = '')
	{
		if( empty(self::$mail) || ! is_string($str) ) 
		{
			return false;
		}
		
		return self::$mail->HasMultiBytes($str);
	}
	
	/******************************************************************************************
	* BASE64 ENCODE WRAP MB                                                                   *
	******************************************************************************************/
	public static function base64EncodeWrapMb($str = '', $lf = NULL)
	{
		if( empty(self::$mail) || ! is_string($str) ) 
		{
			return false;
		}
		
		if( ! is_string($lf) ) 
		{
			$lf = NULL;
		}
		
		return self::$mail->Base64EncodeWrapMB($str, $lf);
	}
	
	/******************************************************************************************
	* ENCODE QP PHP                                                                           *
	******************************************************************************************/
	public static function encodeQpPhp($input = '', $line_max = 76, $space_conv = false)
	{
		if( empty(self::$mail) || ! is_string($input) ) 
		{
			return false;
		}
		
		if( ! is_numeric($line_max) ) 
		{
			$line_max = 76;
		}
		
		if( ! is_bool($space_conv) ) 
		{
			$space_conv = false;
		}
		
		return self::$mail->EncodeQPphp($input, $line_max, $space_conv);
	}

	/******************************************************************************************
	* ENCODE QP                                                                               *
	******************************************************************************************/
	public static function encodeQp($string = '', $line_max = 76, $space_conv = false)
	{
		if( empty(self::$mail) || ! is_string($string) ) 
		{
			return false;
		}
		
		if( ! is_numeric($line_max) ) 
		{
			$line_max = 76;
		}
		
		if( ! is_bool($space_conv) ) 
		{
			$space_conv = false;
		}
		
		return self::$mail->EncodeQP($string, $line_max, $space_conv);
	}

	/******************************************************************************************
	* ENCODE Q                                                                                *
	******************************************************************************************/
	public static function encodeQ($str = '', $position = 'text')
	{
		if( empty(self::$mail) || ! is_string($str) ) 
		{
			return false;
		}
		
		if( ! is_string($position) ) 
		{
			$position = 'text';
		}
		
		return self::$mail->EncodeQ($str, $position);
	}	

	/******************************************************************************************
	* ADD STRING ATTACHMENT                                                                   *
	******************************************************************************************/
	public static function addStringAttachment($string = '', $filename = '', $encoding = 'base64', $type = 'application/octet-stream')
	{
		if( empty(self::$mail) || ! is_string($string) ) 
		{
			return false;
		}
		
		if( ! is_string($filename) ) 
		{
			$filename = '';
		}
		
		if( ! is_string($encoding) ) 
		{
			$encoding = 'base64';
		}
		
		if( ! is_string($type) ) 
		{
			$type = 'application/octet-stream';
		}
		
		return self::$mail->AddStringAttachment($string, $filename, $encoding, $type);
	}

	/******************************************************************************************
	* ADD EMBEDDED IMAGE                                                                      *
	******************************************************************************************/
	public static function addEmbeddedImage($path = '', $cid = '', $name = '', $encoding = 'base64', $type = 'application/octet-stream')
	{
		if( empty(self::$mail) || ! is_string($path) ) 
		{
			return false;
		}
		
		if( ! (is_string($cid) || is_numeric($cid)) ) 
		{
			return false;
		}
		
		if( ! is_string($name) ) 
		{
			$name = '';
		}
		
		if( ! is_string($encoding) ) 
		{
			$encoding = 'base64';
		}
		
		if( ! is_string($type) ) 
		{
			$type = 'application/octet-stream';
		}
		
		return self::$mail->AddEmbeddedImage($path, $cid, $name, $encoding, $type);
	}

	/******************************************************************************************
	* ADD STRING EMBEDDED IMAGE                                                               *
	******************************************************************************************/
	public static function addStringEmbeddedImage($string = '', $cid = '', $name = '', $encoding = 'base64', $type = 'application/octet-stream')
	{
		if( empty(self::$mail) || ! is_string($string) ) 
		{
			return false;
		}
		
		if( ! (is_string($cid) || is_numeric($cid)) ) 
		{
			return false;
		}
		
		if( ! is_string($name) ) 
		{
			$name = '';
		}
		
		if( ! is_string($encoding) ) 
		{
			$encoding = 'base64';
		}
		
		if( ! is_string($type) ) 
		{
			$type = 'application/octet-stream';
		}
		
		return self::$mail->AddStringEmbeddedImage($string, $cid, $name, $encoding, $type);
	}
	
	/******************************************************************************************
	* INLINE IMAGE EXISTS                                                                     *
	******************************************************************************************/
	public static function inlineImageExists()
	{
		if( empty(self::$mail) ) 
		{
			return false;
		}
		return self::$mail->InlineImageExists();
	}
	
	/******************************************************************************************
	* ATTACHMENT EXISTS                                                                       *
	******************************************************************************************/
	public static function attachmentExists()
	{
		if( empty(self::$mail) ) 
		{
			return false;
		}
		return self::$mail->AttachmentExists();
	}
	
	/******************************************************************************************
	* ALTERNATIVE EXISTS                                                                      *
	******************************************************************************************/
	public static function alternativeExists()
	{
		if( empty(self::$mail) ) 
		{
			return false;
		}
		return self::$mail->AlternativeExists();
	}
	
	/******************************************************************************************
	* CLEAR ADDRESS                                                                           *
	******************************************************************************************/
	public static function clearAddress()
	{
		if( empty(self::$mail) ) 
		{
			return false;
		}
		self::$mail->ClearAddresses();
	}
	
	/******************************************************************************************
	* CLEAR CC                                                                                *
	******************************************************************************************/
	public static function clearCc()
	{
		if( empty(self::$mail) ) 
		{
			return false;
		}
		self::$mail->ClearCCs();
	}
	
	/******************************************************************************************
	* CLEAR BCC                                                                               *
	******************************************************************************************/
	public static function clearBcc()
	{
		if( empty(self::$mail) ) 
		{
			return false;
		}
		self::$mail->ClearBCCs();
	}
	
	/******************************************************************************************
	* CLEAR REPLY TO                                                                          *
	******************************************************************************************/
	public static function clearReplyTo()
	{
		if( empty(self::$mail) ) 
		{
			return false;
		}
		self::$mail->ClearReplyTos();
	}
	
	/******************************************************************************************
	* CLEAR ALL RECIPIENTS                                                                    *
	******************************************************************************************/
	public static function clearAllRecipients()
	{
		if( empty(self::$mail) ) 
		{
			return false;
		}
		self::$mail->ClearAllRecipients();
	}
	
	/******************************************************************************************
	* CLEAR ATTACHMENTS                                                                       *
	******************************************************************************************/
	public static function clearAttachments()
	{
		if( empty(self::$mail) ) 
		{
			return false;
		}
		self::$mail->ClearAttachments();
	}
	
	/******************************************************************************************
	* CLEAR CUSTOM HEADERS                                                                    *
	******************************************************************************************/
	public static function clearCustomHeaders()
	{
		if( empty(self::$mail) ) 
		{
			return false;
		}
		self::$mail->ClearCustomHeaders();
	}
	
	/******************************************************************************************
	* RFC DATE                                                                                *
	******************************************************************************************/
	public static function rfcDate()
	{
		if( empty(self::$mail) ) 
		{
			return false;
		}
		return self::$mail->RFCDate();
	}
	
	/******************************************************************************************
	* IS ERROR                                                                                *
	******************************************************************************************/
	public static function isError()
	{
		if( empty(self::$mail) ) 
		{
			return false;
		}
		return self::$mail->IsError();
	}
	
	/******************************************************************************************
	* FIX EOL                                                                                 *
	******************************************************************************************/
	public static function fixEol($str = '')
	{
		if( empty(self::$mail) || ! is_string($str) ) 
		{
			return false;
		}
		return self::$mail->FixEOL($str);
	}
	
	/******************************************************************************************
	* ADD CUSTOM HEADER                                                                       *
	******************************************************************************************/
	public static function addCustomHeader($name = '', $value = NULL)
	{
		if( empty(self::$mail) || ! is_string($name) ) 
		{
			return false;
		}
		
		if( ! is_string($value) ) 
		{
			$value = NULL;
		}
		
		return self::$mail->AddCustomHeader($name = '', $value = '');
	}
	
	/******************************************************************************************
	* MSG HTML                                                                                *
	******************************************************************************************/
	public static function msgHtml($message = '', $basedir = '')
	{
		if( empty(self::$mail) || ! is_string($message) ) 
		{
			return false;
		}
		
		if( ! is_string($basedir) ) 
		{
			$basedir = '';
		}
		
		return self::$mail->MsgHTML($message, $basedir);
	}
	
	/******************************************************************************************
	* SET                                                                                     *
	******************************************************************************************/
	public static function set($name = '', $value = '')
	{
		if( empty(self::$mail) || ! is_string($name) ) 
		{
			return false;
		}
		
		if( ! is_string($value) ) 
		{
			$value = '';
		}
		
		return self::$mail->set($name, $value);
	}
	
	/******************************************************************************************
	* SECURE HEADER                                                                           *
	******************************************************************************************/
	public static function secureHeader($str = '')
	{
		if( empty(self::$mail) || ! is_string($str) ) 
		{
			return false;
		}
		
		return self::$mail->SecureHeader($str);
	}
	
	/******************************************************************************************
	* SIGN                                                                                    *
	******************************************************************************************/
	public static function sign($cert_filename = '', $key_filename = '', $key_pass = '')
	{
		if( empty(self::$mail) || ! is_string($cert_filename) || ! is_string($key_filename) ) 
		{
			return false;
		}
		
		if( ! is_string($key_pass) ) 
		{
			$key_pass = '';
		}
		
		return self::$mail->Sign($cert_filename, $key_filename, $key_pass);
	}
	
	/******************************************************************************************
	* DKIM QP                                                                                 *
	******************************************************************************************/
	public static function dkimQp($txt = '')
	{
		if( empty(self::$mail) || ! is_string($txt) ) 
		{
			return false;
		}
		return self::$mail->DKIM_QP($txt);
	}
	
	/******************************************************************************************
	* DKIM SIGN                                                                               *
	******************************************************************************************/
	public static function dkimSign($s = '')
	{
		if( empty(self::$mail) || ! is_string($s) ) 
		{
			return false;
		}
		return self::$mail->DKIM_Sign($s);
	}
	
	/******************************************************************************************
	* DIKIM HEADER C                                                                          *
	******************************************************************************************/
	public static function dkimHeaderC($s = '')
	{
		if( empty(self::$mail) || ! is_string($s) ) 
		{
			return false;
		}
		return self::$mail->DKIM_HeaderC($s);
	}
	
	/******************************************************************************************
	* DKIM BODY C                                                                             *
	******************************************************************************************/
	public static function dkimBodyC($body = '')
	{
		if( empty(self::$mail) || ! is_string($body) ) 
		{
			return false;
		}
		return self::$mail->DKIM_BodyC($body);
	}
	
	/******************************************************************************************
	* DKIM ADD                                                                                *
	******************************************************************************************/
	public static function dkimAdd($headers_line = '', $subject = '', $body = '')
	{
		if( empty(self::$mail) || ! (is_string($headers_line) || is_numeric($headers_line)) ) 
		{
			return false;
		}
		
		if( ! is_string($subject) ) 
		{
			$subject = '';
		}
		
		if( ! is_string($body) ) 
		{
			$body = '';
		}
		
		return self::$mail->DKIM_Add($headers_line, $subject, $body);
	}
	
	/******************************************************************************************
	* ADD ATTACHMENT                                                                          *
	******************************************************************************************/
	public static function addAttachment($add_attachment = '', $add_attachment_file_name = '', $encoding = 'base64', $type = 'application/octet-stream')
	{
		if( empty(self::$mail) )
		{
			return false;
		}
		
		if( ! is_string($add_attachment_file_name) ) 
		{
			$add_attachment_file_name = '';
		}
		
		if( ! is_string($encoding) )
		{
			$encoding = 'base64';
		}
		
		if( ! is_string($type ))
		{
			$type = 'application/octet-stream';
		}
		
		if( isset($add_attachment) )
		{
			if( ! is_array($add_attachment) )
			{ 
				self::$mail->AddAttachment($add_attachment, $add_attachment_file_name, $encoding, $type);
			}
			else
			{ 
				foreach($add_attachment as $k => $v)
				{ 
					self::$mail->AddAttachment($k, $v);
				}
			}
		}
	}
	
	/******************************************************************************************
	* SEND                                                                                    *
	******************************************************************************************/
	public static function send($subject = '', $message = '')
	{	
		//------------------------------------------------------------------
		//  Parametre konrolleri
		//------------------------------------------------------------------
		if( empty(self::$mail) ) 
		{
			return false;
		}
		
		if( ! is_string($subject) ) 
		{
			$subject = '';
		}
		
		if( ! is_string($message) ) 
		{
			$message = '';
		}
		//------------------------------------------------------------------
		
		//------------------------------------------------------------------
		//  Config/Email.php dosyasında yer alan e-posta ayarları alınıyor.
		//------------------------------------------------------------------
		$genset = config::get('Email');	
		//------------------------------------------------------------------
		//------------------------------------------------------------------
		//------------------------------------------------------------------
		
		//------------------------------------------------------------------
		//  Alıcı e-posta bilgisi
		//------------------------------------------------------------------
		$from_email = ( self::$from_email ) 			
					  ? self::$from_email 			
					  : $genset['username'];
		
		//------------------------------------------------------------------
		//  Alıcı isim bilgisi
		//------------------------------------------------------------------			  
		$from_name  = ( self::$from_name )  			
					  ? self::$from_name  			
					  : $genset['fromname'];
		
		//------------------------------------------------------------------
		//  E-posta içeriğinin html içerikli olup olmayacağı bilgisi
		//------------------------------------------------------------------			  
		$is_html	= ( self::$settings['is_html'] ) 	
					  ? self::$settings['is_html'] 	
					  : $genset['is_html'];
		
		//------------------------------------------------------------------
		//  Gönderim için SMTP'nin kullanılıp kullanılmayacağı bilgisi
		//------------------------------------------------------------------			  
		$is_smtp	= ( self::$settings['is_smtp'] )  
		              ? self::$settings['is_smtp']	
					  : $genset['is_smtp'];
		
		//------------------------------------------------------------------
		//  SMTP Durumu
		//------------------------------------------------------------------		
		if( ! empty($is_smtp) ) 
		{
			self::$mail->IsSMTP();  
		}
		
		self::$mail->IsHTML($is_html);
		
		self::$mail->SetFrom($from_email, $from_name); 
		
		//------------------------------------------------------------------
		//  Parametre olarak konu bilgisin girilip girilmediği
		//------------------------------------------------------------------                      		
		self::$mail->Subject = ( $subject === '' ) 
							   ? self::$subject 
							   : $subject;
		
		//------------------------------------------------------------------
		//  Parametre olarak mesaj bilgisinin girilip girilmediği
		//------------------------------------------------------------------					   
		self::$mail->Body 	 = ( $message === '' ) 
							   ? self::$message 
							   : $message;;
		
		//------------------------------------------------------------------
		//  Smtp Auth Ayarı
		//------------------------------------------------------------------
		if( self::$settings['smtp_auth'] || $genset['smtp_auth'] ) 
		{
			self::$mail->SMTPAuth 	= ( self::$settings['smtp_auth'] ) 	
								      ? self::$settings['smtp_auth'] 		
									  : $genset['smtp_auth'];
		}
		
		//------------------------------------------------------------------
		//  Charset Ayarı
		//------------------------------------------------------------------
		if (self::$settings['charset'] || $genset['charset'] )
		{
			self::$mail->CharSet  	= ( self::$settings['charset'] ) 		
									  ? self::$settings['charset'] 		
									  : $genset['charset'];	
		}
		
		//------------------------------------------------------------------
		//  Host Ayarı
		//------------------------------------------------------------------
		if( self::$settings['host'] || $genset['host'] )
		{
			self::$mail->Host     	= ( self::$settings['host'] ) 		
									  ? self::$settings['host'] 			
									  : $genset['host'];
		}
		
		//------------------------------------------------------------------
		//  Port Ayarı
		//------------------------------------------------------------------
		if( self::$settings['port'] || $genset['port'] )
		{
			self::$mail->Port 		= ( self::$settings['port'] ) 		
			                          ? self::$settings['port'] 			
									  : $genset['port']; 
		}
		
		//------------------------------------------------------------------
		//  Username Ayarı
		//------------------------------------------------------------------
		if( self::$settings['username'] || $genset['username'] )
		{
			self::$mail->Username 	= ( self::$settings['username'] ) 	
			                          ? self::$settings['username'] 		
									  : $genset['username'];
		}
		
		//------------------------------------------------------------------
		//  Password Ayarı
		//------------------------------------------------------------------
		if( self::$settings['password'] || $genset['password'] )
		{
			self::$mail->Password 	= ( self::$settings['password'] ) 	
			                          ? self::$settings['password'] 		
									  : $genset['password'];	
		}
		
		//------------------------------------------------------------------
		//  Smtp Secure Ayarı
		//------------------------------------------------------------------
		if( self::$settings['smtp_secure'] || $genset['smtp_secure'] )
		{
			self::$mail->SMTPSecure = ( self::$settings['smtp_secure'] ) 	
			                          ? self::$settings['smtp_secure'] 	
									  : $genset['smtp_secure'];
		}
		
		//------------------------------------------------------------------
		//  Priority Ayarı
		//------------------------------------------------------------------
		if( self::$settings['priority'] || $genset['priority'] )
		{
			self::$mail->Priority	= ( self::$settings['priority'] ) 		
			                          ? self::$settings['priority']		
									  : $genset['priority'];
		}
		
		//------------------------------------------------------------------
		//  Content Ayarı
		//------------------------------------------------------------------
		if( self::$settings['content'] || $genset['content'] )
		{
			self::$mail->ContentType = ( self::$settings['content'] ) 		
			                           ? self::$settings['content'] 		
									   : $genset['content'];
		}
		
		//------------------------------------------------------------------
		//  Encoding Ayarı
		//------------------------------------------------------------------
		if( self::$settings['encoding'] || $genset['encoding'] )
		{
			self::$mail->Encoding 	= ( self::$settings['encoding'] ) 	
			                          ? self::$settings['encoding']		
									  : $genset['encoding'];
		}
		
		//------------------------------------------------------------------
		//  Sender Ayarı
		//------------------------------------------------------------------
		if( self::$settings['sender'] || $genset['sender'] )
		{
			self::$mail->Sender		= ( self::$settings['sender'] ) 		
									  ? self::$settings['sender']			
									  : $genset['sender'];
		}
		
		//------------------------------------------------------------------
		//  Return Path Ayarı
		//------------------------------------------------------------------
		if( self::$settings['return_path'] || $genset['return_path'] )
		{
			self::$mail->ReturnPath	= ( self::$settings['return_path'] )	
			                          ? self::$settings['return_path']	
									  : $genset['return_path'];
		}
		
		//------------------------------------------------------------------
		//  Alt Body Ayarı
		//------------------------------------------------------------------
		if( self::$settings['alt_body'] || $genset['alt_body'] )
		{
			self::$mail->AltBody	= ( self::$settings['alt_body'] ) 	
			                          ? self::$settings['alt_body']		
									  : $genset['alt_body'];
		}
		
		//------------------------------------------------------------------
		//  Word Wrap Ayarı
		//------------------------------------------------------------------
		if( self::$settings['word_wrap'] || $genset['word_wrap'] )
		{
			self::$mail->WordWrap 	= ( self::$settings['word_wrap'] ) 	
								      ? self::$settings['word_wrap']		
									  : $genset['word_wrap'];		
		}
		
		//------------------------------------------------------------------
		//  Mailer Ayarı
		//------------------------------------------------------------------
		if( self::$settings['mailer'] || $genset['mailer'] )
		{
			self::$mail->Mailer		= ( self::$settings['mailer'] )	 	
									  ? self::$settings['mailer']			
									  : $genset['mailer'];
		}
		
		//------------------------------------------------------------------
		//  Send Mail Ayarı
		//------------------------------------------------------------------
		if( self::$settings['send_mail'] || $genset['send_mail'] )
		{
			self::$mail->Sendmail	= ( self::$settings['send_mail'] )  	
									  ? self::$settings['send_mail']		
									  : $genset['send_mail'];
		}
		
		//------------------------------------------------------------------
		//  Use Send Mail Options Ayarı
		//------------------------------------------------------------------
		if( self::$settings['use_send_mail_options'] || $genset['use_send_mail_options'] )
		{
			self::$mail->UseSendmailOptions = ( self::$settings['use_send_mail_options'] ) 
											  ? self::$settings['use_send_mail_options'] 
											  : $genset['use_send_mail_options'];
		}
		
		//------------------------------------------------------------------
		//  Plugin Dir Ayarı
		//------------------------------------------------------------------
		if( self::$settings['plugin_dir'] || $genset['plugin_dir'] )
		{
			self::$mail->PluginDir 	= ( self::$settings['plugin_dir'] ) 	
									  ? self::$settings['plugin_dir']		
									  : $genset['plugin_dir'];
		}
		
		//------------------------------------------------------------------
		//  Confirm Reading To Ayarı
		//------------------------------------------------------------------
		if( self::$settings['confirm_reading_to'] || $genset['confirm_reading_to'] )
		{
			self::$mail->ConfirmReadingTo = ( self::$settings['confirm_reading_to'] ) 
											? self::$settings['confirm_reading_to'] 
											: $genset['confirm_reading_to'];
		}
		
		//------------------------------------------------------------------
		//  Message Id Ayarı
		//------------------------------------------------------------------
		if( self::$settings['message_id'] || $genset['message_id'] )
		{
			self::$mail->MessageID 	= ( self::$settings['message_id'] ) 	
									  ? self::$settings['message_id']		
									  : $genset['message_id'];
		}
		
		//------------------------------------------------------------------
		//  Message Date Ayarı
		//------------------------------------------------------------------
		if (self::$settings['message_date'] || $genset['message_date'] )
		{
			self::$mail->MessageDate = ( self::$settings['message_date'] ) 
									   ? self::$settings['message_date']	
									   : $genset['message_date'];
		}
		
		//------------------------------------------------------------------
		//  Helo Ayarı
		//------------------------------------------------------------------
		if( self::$settings['helo'] || $genset['helo'] )
		{
			self::$mail->Helo		= ( self::$settings['helo'] ) 		
									  ? self::$settings['helo']			
									  : $genset['helo'];
		}
		
		//------------------------------------------------------------------
		//  Realm Ayarı
		//------------------------------------------------------------------
		if( self::$settings['realm'] || $genset['realm'] )
		{
			self::$mail->Realm		= ( self::$settings['realm'] )		
			                          ? self::$settings['realm']			
									  : $genset['realm'];
		}
		
		//------------------------------------------------------------------
		//  Work Station Ayarı
		//------------------------------------------------------------------
		if( self::$settings['work_station'] || $genset['work_station'] )
		{
			self::$mail->Workstation = ( self::$settings['work_station'] ) 
									   ? self::$settings['work_station']	
									   : $genset['work_station'];
		}
		
		//------------------------------------------------------------------
		//  Timeout Ayarı
		//------------------------------------------------------------------
		if( self::$settings['timeout'] || $genset['timeout'] )
		{
			self::$mail->Timeout	= ( self::$settings['timeout'] ) 		
									  ? self::$settings['timeout']		
									  : $genset['timeout'];
		}
		
		//------------------------------------------------------------------
		//  Smtp Debug Ayarı
		//------------------------------------------------------------------
		if( self::$settings['smtp_debug'] || $genset['smtp_debug'] )
		{
			self::$mail->SMTPDebug	= ( self::$settings['smtp_debug'] ) 	
									  ? self::$settings['smtp_debug']		
									  : $genset['smtp_debug'];
		}
		
		//------------------------------------------------------------------
		//  Debug Output Ayarı
		//------------------------------------------------------------------
		if( self::$settings['debug_output'] || $genset['debug_output'] )
		{
			self::$mail->Debugoutput = ( self::$settings['debug_output'] ) 
									   ? self::$settings['debug_output'] 	
									   : $genset['debug_output'];
		}
		
		//------------------------------------------------------------------
		//  Smtp Keep Alive Ayarı
		//------------------------------------------------------------------
		if( self::$settings['smtp_keep_alive'] || $genset['smtp_keep_alive'] )
		{
			self::$mail->SMTPKeepAlive = ( self::$settings['smtp_keep_alive'] ) 
										 ? self::$settings['smtp_keep_alive'] 
										 : $genset['smtp_keep_alive'];
		}
		
		//------------------------------------------------------------------
		//  Single To Ayarı
		//------------------------------------------------------------------
		if( self::$settings['single_to'] || $genset['single_to'] )
		{
			self::$mail->SingleTo	= ( self::$settings['single_to'] ) 	
									  ? self::$settings['single_to']		
									  : $genset['single_to'];
		}
		
		//------------------------------------------------------------------
		//  Single To Array Ayarı
		//------------------------------------------------------------------
		if( ! empty(self::$settings['single_to_array']) || ! empty($genset['single_to_array']) )
		{
			self::$mail->SingleToArray = ( ! empty(self::$settings['single_to_array']) ) 
										 ? self::$settings['single_to_array'] 
										 : $genset['single_to_array'];
		}
		
		//------------------------------------------------------------------
		//  Le Ayarı
		//------------------------------------------------------------------
		if( self::$settings['le'] || $genset['le'] )
		{
			self::$mail->LE	= ( self::$settings['le'] ) 
							  ? self::$settings['le'] 	
							  : $genset['le'];
		}
		
		//------------------------------------------------------------------
		//  Dkim Selector Ayarı
		//------------------------------------------------------------------
		if( self::$settings['dkim_selector'] || $genset['dkim_selector'] )
		{
			self::$mail->DKIM_selector = ( self::$settings['dkim_selector'] ) 
									     ? self::$settings['dkim_selector']
										 : $genset['dkim_selector'];
		}
		
		//------------------------------------------------------------------
		//  Dkim Identity Ayarı
		//------------------------------------------------------------------
		if( self::$settings['dkim_identity'] || $genset['dkim_identity'] )
		{
			self::$mail->DKIM_identity = ( self::$settings['dkim_identity'] ) 
										 ? self::$settings['dkim_identity']
										 : $genset['dkim_identity'];
		}
		
		//------------------------------------------------------------------
		//  Dkim Pass Phrase Ayarı
		//------------------------------------------------------------------
		if( self::$settings['dkim_pass_phrase'] || $genset['dkim_pass_phrase'] )
		{
			self::$mail->DKIM_passphrase = ( self::$settings['dkim_pass_phrase'] ) 
										   ? self::$settings['dkim_pass_phrase'] 
										   : $genset['dkim_pass_phrase'];
		}
		
		//------------------------------------------------------------------
		//  Dkim Domain Ayarı
		//------------------------------------------------------------------
		if( self::$settings['dkim_domain'] || $genset['dkim_domain'])
		{
			self::$mail->DKIM_domain	= ( self::$settings['dkim_domain'] )	
										  ? self::$settings['dkim_domain']	
										  : $genset['dkim_domain'];
		}
		
		//------------------------------------------------------------------
		//  Dkim Private Ayarı
		//------------------------------------------------------------------
		if( self::$settings['dkim_private'] || $genset['dkim_private'] )
		{
			self::$mail->DKIM_private = ( self::$settings['dkim_private'] ) 
										? self::$settings['dkim_private']	
										: $genset['dkim_private'];
		}
		
		//------------------------------------------------------------------
		//  Action Function Ayarı
		//------------------------------------------------------------------
		if( self::$settings['action_function'] || $genset['action_function'] )
		{
			self::$mail->action_function = ( self::$settings['action_function'] ) 
									       ? self::$settings['action_function'] 
										   : $genset['action_function'];
		}
		
		//------------------------------------------------------------------
		//  Version Ayarı
		//------------------------------------------------------------------
		if( self::$settings['version'] || $genset['version'] )
		{
			self::$mail->Version		= ( self::$settings['version'] )		
									      ? self::$settings['version']		
										  : $genset['version'];
		}
		
		//------------------------------------------------------------------
		//  Xmailer Ayarı
		//------------------------------------------------------------------
		if( self::$settings['xmailer'] || $genset['xmailer'])
		{
			self::$mail->XMailer 		= ( self::$settings['xmailer'] ) 		
										  ? self::$settings['xmailer']		
										  : $genset['xmailer'];
		}
		
		self::$detail = self::$mail;
		
		//------------------------------------------------------------------
		//  Mail Gönderiliyor...
		//------------------------------------------------------------------
		if( self::$mail->Send() )
		{
			return true;
		}
		
		else
		{ 
			//------------------------------------------------------------------
			//  Gönderim Başarısız...
			//------------------------------------------------------------------
			if( self::$mail->ErrorInfo )
			{
				self::$error = lang('Email', self::$mail->ErrorInfo);
			}
			return false;
		}
	}
	
	//------------------------------------------------------------------
	//  Değişkenler Sıfırlanıyor
	//------------------------------------------------------------------
	public static function close()
	{
		if( isset(self::$mail) )  		self::$mail = NULL;
		if( isset(self::$from_mail) ) 	self::$from_mail = NULL;
		if( isset(self::$from_name) ) 	self::$from_name = NULL;
		if( isset(self::$subject) ) 	self::$subject = NULL;
		if( isset(self::$message) ) 	self::$message = NULL;
		if( isset(self::$detail) ) 		self::$detail = NULL;	
	}
	
	/******************************************************************************************
	* BASIC SEND                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Basit e-posta göndermek için kullanılır.							      |
	|															                              |
	| Parametreler: 4 parametresi vardır.                                                     |  
	| @to, @subject, @message, @extra													      |
	|          																				  |
	| Örnek Kullanım: email::basicSend('o@w.c', 'Konu', 'Mesaj')         					  |
	|          																				  |
	******************************************************************************************/
	public static function basicSend($to = '', $subject = '', $message = '', $extra = '')
	{
		if( ! is_string($to) || ! isEmail($to) ) 
		{
			return false;
		}
		
		if( ! is_string($subject) ) 
		{
			$subject = '';
		}
		
		if( ! isValue($message) ) 
		{
			$message = '';
		}
		
		if( ! is_string($extra) ) 
		{
			$extra = '';
		}
		
		$result = mb_send_mail($to, $subject, $message, $extra);
			
		if( empty($result) ) 
		{
			return false;
		}
		else
		{
			return true;
		}
	}
}