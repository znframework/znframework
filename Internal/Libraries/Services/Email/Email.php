<?php
namespace ZN\Services;

class InternalEmail implements EmailInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	/*  
	 * Varsayılan gönderici bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */ 
	protected $senderMail		= '';
	
	/*  
	 * Varsayılan gönderici isim bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */ 
	protected $senderName		= '';
	
	/* 
	 * Karakter seti bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * @var string UTF-8
	 */
	protected $charset = 'UTF-8';
	
	/* 
	 * İçerik bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * @var string plain, html
	 */
	protected $contentType = 'plain';
	
	/* 
	 * CC alıcıları bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * @var mixed
	 */
	protected $cc;
	
	/* 
	 * BCC alıcıları bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * @var mixed
	 */
	protected $bcc;
	
	/* 
	 * E-posta gönderim yolu bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * @var string /usr/sbin/sendmail
	 */
	protected $mailPath	= '/usr/sbin/sendmail';
	
	/* 
	 * Satır sonu karakter bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * @var string \n
	 */
	protected $lf = "\n";
	
	/*  
	 * SMTP sunucu bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * @var string localhost
	 */
	protected $smtpHost	= '';
	
	/*  
	 * SMTP kullanıcı adı bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * @var string
	 */
	protected $smtpUser	= '';
	
	/*  
	 * SMTP kullanıcı şifre bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * @var string
	 */
	protected $smtpPassword	= '';
	
		 /*
     * İçerik kodlaması türü
     * 
     * @var string empty, tls yada ssl
     */
    protected $smtpEncode = '';
	
	/*  
	 * SMTP port bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * @var numeric 587
	 */
	protected $smtpPort	= 587;
	
	/*  
	 * Zaman aşımı bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * @var numeric 10
	 */
	protected $smtpTimeout	= 10;
	
	/*  
	 * Oto giris bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * @var numeric 5
	 */
	protected $smtpAuth	= true;
	
	/*  
	 * DSN bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * @var numeric 5
	 */
	protected $smtpDsn	= false;
	
	/*  
	 * Bağlantı sürekliliği bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * @var numeric 5
	 */
	protected $smtpKeepAlive = false;
	
	/*  
	 * Mime versiyon bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * @var string 1.0
	 */
	protected $mimeVersion	= '1.0';
	
	/*  
	 * Sınır bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * @var string
	 */
	protected $boundary	= '';
	
	/*  
	 * Sınır bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * @var string related, mixed ve alternative
	 */
	protected $multiPart	= 'mixed';
	
		/*  
	 * Sınır bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * @var string related, mixed ve alternative
	 */
	protected $multiParts	= ['related', 'alternative', 'mixed'];
	
	/* 
	 * X-Mailer bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * @var string ZN
	 */
	protected $xMailer = 'ZN';
	
	/* 
	 * Başlık bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 * @var array
	 */
	protected $headers = [];
	
	/* 
	 * Başlık bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 * @var string
	 */
	protected $header = '';
	
	/* 
	 * Öncelik bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 * @var array
	 */
	protected $priorityTypes = [1 => '1 (Highest)', 2 => '2 (High)', 3 => '3 (Normal)', 4 => '4 (Low)',5 => '5 (Lowest)'];
	
	/* 
	 * Öncelik bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * @var array
	 */
	protected $priority = 3;
	
	 /*
     * İçerik kodlaması türü
     * 
     * @var string 8bit, 7bit, binary, base64 ve quoted-printable
     */
    protected $encodingType = '8bit';
	
	/* 
	 * Gönderilecek ek bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $attachments = [];
	
	/* 
	 * Alıcı bilgisi.
	 * 
	 * @var array
	 */ 
	protected $to = [];
	
	/* 
	 * Alıcı bilgisi.
	 * 
	 * @var array
	 */ 
	protected $replyTo = [];
	
	/* 
	 * Alıcı bilgisi.
	 * 
	 * @var string
	 */ 
	protected $from;
	
	/* 
	 * Konu bilgisi.
	 * 
	 * @var string
	 */ 
	protected $subject;
	
	/* 
	 * Mesaj bilgisi.
	 * 
	 * @var string
	 */ 
	protected $message;
	
	/* 
	 * Email sürücüsünü sınıf bilgisini
	 * tutmak için oluşturulmuştur.
	 * 
	 * @var object
	 */ 
	protected $email;
	
	/* 
	 * Sürücü bilgisini
	 * tutmak için oluşturulmuştur.
	 * 
	 * @var object
	 */ 
	protected $driver;
	
	/******************************************************************************************
	* CONSTRUCT                                                                               *
	*******************************************************************************************
	| Genel Kullanım: E-posta ayarları çalıştırılıyor.				     					  |
	|          																				  |
	******************************************************************************************/
	public function __construct($driver = '')
	{		
		$this->email = \Driver::run(['Services' => 'email'], $driver);
		
		$this->driver = ! empty($driver)
						? $driver
						: \Config::get('Services', 'email')['driver'];
	
		$this->settings();
	}
	
	//----------------------------------------------------------------------------------------------------
	// Call Method
	//----------------------------------------------------------------------------------------------------
	// 
	// __call()
	//
	//----------------------------------------------------------------------------------------------------
	use \CallUndefinedMethodTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Error Control 
	//----------------------------------------------------------------------------------------------------
	// 
	// error()
	//
	//----------------------------------------------------------------------------------------------------
	use \ErrorControlTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Driver Method
	//----------------------------------------------------------------------------------------------------
	// 
	// driver()
	//
	//----------------------------------------------------------------------------------------------------
	use \DriverMethodTrait;	
	
	//----------------------------------------------------------------------------------------------------
	// Settings Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* SETTINGS                                                                                *
	*******************************************************************************************
	| Genel Kullanım: E-posta ayarlarını yapılandırmak için kullanılır.						  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. array var @config => Yapılandırılacak ayarlar.		  								  |
	|          																				  |
	| Örnek Kullanım: settings(array('wordWrap' => true));       							  |
	|          																				  |
	******************************************************************************************/
	public function settings($settings = [])
	{
		if( ! is_array($settings) )
		{
			\Errors::set('Error', 'emailParameter', '1.(settings)');	
			return $this;
		}
		
		$config = \Config::get('Services', 'email');
		
		$smtpConfig    = $config['smtp'];
		$generalConfig = $config['general'];
		
		foreach( $smtpConfig as $key => $val )
		{
			$nkey = 'smtp'.ucfirst($key);
			
			$this->$nkey = ! isset($settings[$key])
					       ? $val	
						   : $settings[$key];
		}
		
		foreach( $generalConfig as $key => $val )
		{
			$this->$key = ! isset($settings[$key])
						  ? $val
						  : $settings[$key];
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* CONTENT TYPE		                                                                      *
	*******************************************************************************************
	| Genel Kullanım: E-posta içeriğinin türünü ayarlamak için kullanılır.		 	  	      |
		
	  @param string $type plain
	  retun object
	|          																				  |
	******************************************************************************************/
	public function contentType($type = 'plain')
	{
		$this->contentType = $type === 'plain'
							 ? 'plain' 
							 : 'html';
		return $this;
	}
	
	/******************************************************************************************
	* CHARSET   		                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Metnin karakter kodlama türünü ayarlamak için kullanılır. 	  	      |
		
	  @param string $charset UTF-8
	  retun object
	|          																				  |
	******************************************************************************************/
	public function charset($charset = 'UTF-8')
	{
		if( isCharset($charset) )
		{
			$this->charset = $charset;	
		}
		else
		{
			\Errors::set('Error', 'charsetParameter', '1.(charset)');	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* PRIORITY                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Gönderim öncelik derecesini ayarlamak için kullanılır.     			  |
	
	  @param  numeric $count 3
	  @return object
	|          																				  |
	******************************************************************************************/
	public function priority($count = 3)
	{
		$this->priority = preg_match('/^[1-5]$/', $count) 
						? (int)$count 
						: 3;
						
		return $this;
	}
	
	/******************************************************************************************
	* ADD HEADER			                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Başlık eklemek için kullanılır.										  |
	
	  @param  string $header
	  @param  string $value
	  @return void
	|          																				  |
	******************************************************************************************/
	public function addHeader($header = '', $value = '')
	{
		$this->headers[$header] = str_replace(["\n", "\r"], '', $value);
		
		return $this;
	}
	
	/******************************************************************************************
	* CONTENT TYPE			                                                    			  *
	*******************************************************************************************
	| Genel Kullanım: Mesajın içerğini kodlamak için kullanılılr.							  |
	
	  @param  string $type 8bit
	  @return object
	|          																				  |
	******************************************************************************************/
	public function encodingType($type = '8bit')
	{
		$this->encodingType = $type;
		
		return $this;
	}
	
	
	
	/******************************************************************************************
	* MULTIPART   			                                                    			  *
	*******************************************************************************************
	| Genel Kullanım: Mesajın içeriğinin sınır.												  |
	
	  @param  string mixed
	  @return object
	|          																				  |
	******************************************************************************************/
	public function multiPart($multiPart = 'related')
	{
		$this->multiPart = $multiPart;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Settings Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Smtp Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* SMPT HOST			                                                                      *
	*******************************************************************************************
	| Genel Kullanım: SMPT Host ayarını yapmak için kullanılır.					 	  	      |
		
	  @param string $host
	  retun object
	|          																				  |
	******************************************************************************************/
	public function smtpHost($host = '')
	{
		if( is_scalar($host) )
		{
			$this->smtpHost = $host;	
		}
		else
		{
			\Errors::set('Error', 'scalarParameter', '1.(host)');	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* SMPT USER			                                                                      *
	*******************************************************************************************
	| Genel Kullanım: SMPT kullanıcı ayarını yapmak için kullanılır.					 	  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @user => SMTP kullanıcı adı.	     		  					  		  |
	|          																				  |
	| Örnek Kullanım: smtpUser('bilgi@zntr.net');			 							      |
	|          																				  |
	******************************************************************************************/
	public function smtpUser($user = '')
	{
		if( is_scalar($user) )
		{
			$this->smtpUser = $user;	
		}
		else
		{
			\Errors::set('Error', 'scalarParameter', '1.(user)');	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* DSN       		                                                                      *
	*******************************************************************************************
	| Genel Kullanım: DSN durumunu ayarlamak için kullanılır.								  |
	
	  @param bool $dsn true
	  @return object
	|          																				  |
	******************************************************************************************/
	public function smtpDsn($dsn = true)
	{
		if( is_bool($dsn) )
		{
			$this->smtpDsn = $dsn;	
		}
		else
		{
			\Errors::set('Error', 'booleanParameter', '1.(dsn)');	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* SMPT PASSWORD		                                                                      *
	*******************************************************************************************
	| Genel Kullanım: SMPT kullanıcı şifre ayarını yapmak için kullanılır.					  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @pass => SMTP kullanıcı şifresi.	     		  					  	  |
	|          																				  |
	| Örnek Kullanım: smtpPassword('zntr1234');			 							  		  |
	|          																				  |
	******************************************************************************************/
	public function smtpPassword($pass = '')
	{
		if( is_scalar($pass) )
		{
			$this->smtpPassword = $pass;	
		}
		else
		{
			\Errors::set('Error', 'scalarParameter', '1.(pass)');	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* SMPT PORT  		                                                                      *
	*******************************************************************************************
	| Genel Kullanım: SMPT port ayarını yapmak için kullanılır.								  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @port => SMTP port numarası.		     		  					  	  |
	|          																				  |
	| Örnek Kullanım: smtpPort(587);					 							  		  |
	|          																				  |
	******************************************************************************************/
	public function smtpPort($port = 587)
	{
		if( is_numeric($port) )
		{
			$this->smtpPort = $port;	
		}
		else
		{
			\Errors::set('Error', 'numericParameter', '1.(port)');	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* SMPT TIMEOUT		                                                                      *
	*******************************************************************************************
	| Genel Kullanım: SMPT bağlantı zaman aşımı ayarını yapmak için kullanılır.				  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @timeout => SMTP zaman aşımı süresi.     		  					  	  |
	|          																				  |
	| Örnek Kullanım: smtpTimeout(10);	// 10 Saniye	 							  		  |
	|          																				  |
	******************************************************************************************/
	public function smtpTimeout($timeout = 10)
	{
		if( is_numeric($timeout) )
		{
			$this->smtpTimeout = $timeout;	
		}
		else
		{
			\Errors::set('Error', 'numericParameter', '1.(timeout)');	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* SMPT KEEP ALIVE	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: SMPT bağlantısını açık tutulup tutulmayacağını ayarlamak için kullanılır|
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @keepAlive => Bağlantı durumu.		     		  					  	  |
	|          																				  |
	| Örnek Kullanım: smtpKeepAlive(true);				 							  		  |
	|          																				  |
	******************************************************************************************/
	public function smtpKeepAlive($keepAlive = true)
	{
		if( is_bool($keepAlive) )
		{
			$this->smtpKeepAlive = $keepAlive;	
		}
		else
		{
			\Errors::set('Error', 'booleanParameter', '1.(keepAlive)');	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* SMPT ENCODE 		                                                                      *
	*******************************************************************************************
	| Genel Kullanım: SMPT tls veya ssl güvenlik ayarlarından birini kullanmak içindir.		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @encode => Şifreleme türü.		     			  					  	  |
	|          																				  |
	| Örnek Kullanım: smtpKeepAlive('tls'); // tls veya ssl							  		  |
	|          																				  |
	******************************************************************************************/
	public function smtpEncode($encode = '')
	{
		if( is_string($encode) )
		{
			$this->smtpEncode = $encode;	
		}
		else
		{
			\Errors::set('Error', 'stringParameter', '1.(encode)');	
		}
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Smtp Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Send Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

	//----------------------------------------------------------------------------------------------------
	// Protected To
	//----------------------------------------------------------------------------------------------------
	protected function _to($to = '', $name = '', $type = 'to')
	{
		if( is_array($to) )
		{
			if( ! empty($to) ) foreach( $to as $key => $val )
			{
				if( isEmail($key) )
				{
					$this->{$type}[$key] = $val;
				}
			}	
		}
		else
		{
			if( isEmail($to) )
			{
				$this->{$type}[$to] = $name;
			}
			else
			{
				\Errors::set('Error', 'emailParameter', '1.('.$type.')');	
			}
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* TO                                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Alıcı.																  |
	
	  @param  string $to
	  @param  string $name
	  @return object
	|          																				  |
	******************************************************************************************/
	public function to($to = '', $name = '')
	{
		$this->_to($to, $name, 'to');
		
		return $this;
	}
	
	/******************************************************************************************
	* RECEIVER / TO                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Alıcı.																  |
	
	  @param  string $to
	  @param  string $name
	  @return object
	|          																				  |
	******************************************************************************************/
	public function receiver($to = '', $name = '')
	{
		$this->to($to, $name);
		
		return $this;
	}
	
	/******************************************************************************************
	* REPLY TO                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Alıcı.																  |
	
	  @param  $to
	  @return object
	|          																				  |
	******************************************************************************************/
	public function replyTo($replyTo = '', $name = '')
	{
		$this->_to($replyTo, $name, 'replyTo');
		
		return $this;
	}
	
	
	/******************************************************************************************
	* CC                                                                                      *
	*******************************************************************************************
	| Genel Kullanım: CC Alıcıları.															  |
	
	  @param  $cc
	  @return object
	|          																				  |
	******************************************************************************************/
	public function cc($cc = '', $name = '')
	{
		$this->_to($cc, $name, 'cc');
		
		return $this;
	}
	
	/******************************************************************************************
	* BCC                                                                                      *
	*******************************************************************************************
	| Genel Kullanım: BCC Alıcıları.															  |
	
	  @param  $bcc
	  @return object
	|          																				  |
	******************************************************************************************/
	public function bcc($bcc = '', $name = '')
	{
		$this->_to($bcc, $name, 'bcc');
		
		return $this;
	}
	
	/******************************************************************************************
	* FROM                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Gönderici.															  |
	
	  @param  $from
	  @param  $name
	  @return void
	|          																				  |
	******************************************************************************************/
	public function from($from = '', $name = '', $returnPath = NULL)
	{
		if( ! isEmail($from) )
		{
			\Errors::set('Error', 'emailParameter', '1.(from)');
			return $this;	
		}
		
		$this->from = $from;
		
		$returnPath = $returnPath !== NULL
				    ? $returnPath
					: $from;
		
		$this->addHeader('From', $name.' <'.$from.'>');
		$this->addHeader('Return-Path', '<'.$returnPath.'>');
		
		return $this;
	}
	
	/******************************************************************************************
	* SENDER / FROM                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Gönderici.															  |
	
	  @param  $from
	  @param  $name
	  @return void
	|          																				  |
	******************************************************************************************/
	public function sender($from = '', $name = '', $returnPath = NULL)
	{
		$this->from($from, $name, $returnPath);
		
		return $this;
	}
	
	/******************************************************************************************
	* SUBJECT                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Konu.																	  |
	
	  @param  $subject
	  @return void
	|          																				  |
	******************************************************************************************/
	public function subject($subject = '')
	{
		if( is_string($subject) )
		{
			$this->subject = $subject;
			$this->addHeader('Subject', $this->subject);
		}
		else
		{
			\Errors::set('Error', 'stringParameter', '1.(subject)');	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* MESSAGE                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Mesaj																	  |
	
	  @param  $message
	  @return void
	|          																				  |
	******************************************************************************************/
	public function message($message = '')
	{
		if( is_string($message) )
		{
			$this->message = $message;
		}
		else
		{
			\Errors::set('Error', 'stringParameter', '1.(message)');	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* CONTENT / MESSAGE                                                                       *
	*******************************************************************************************
	| Genel Kullanım: Mesaj																	  |
	
	  @param  $message
	  @return void
	|          																				  |
	******************************************************************************************/
	public function content($message = '')
	{
		$this->message($message);
		
		return $this;
	}
	
	/******************************************************************************************
	* ATTACHMENT                                                                              *
	*******************************************************************************************
	| Genel Kullanım: E-post gönderiminde gönderiye eklenecek ekler.					 	  |
	  
	  @param string $file
	  @param string $disposition
	  @param string $newName
	  @param string $mime
	  @return array
	|          																				  |
	******************************************************************************************/
	public function attachment($file = '', $disposition = '', $newName = NULL, $mime = '')
	{
		$mimeTypes = \Config::get('MimeTypes');
		
		$mime = ! empty($mimeTypes[$mime])
				? $mimeTypes[$mime]
				: $mime;
		
		if( is_array($mime) )
		{
			$mime = $mime[0];	
		} 
	
		if( $mime === '' )
		{
			if( strpos($file, '://') === false && ! file_exists($file) )
			{
				return \Errors::set('Email', 'attachmentMissing', $file);
			}
			
			if( ! $fp = @fopen($file, 'rb') )
			{
				return \Errors::set('Email', 'attachmentUnreadable', $file);
			}
			
			$fileContent = stream_get_contents($fp);
	
			fclose($fp);
		}
		else
		{
			$fileContent =& $file;
		}
	
		$this->attachments[] = array
		(
			'name'			=> [$file, $newName],
			'disposition'	=> empty($disposition) ? 'attachment' : $disposition,
			'type'			=> $mime,
			'content'		=> chunk_split(base64_encode($fileContent))
		);
		
		return $this;
	}
	
	/******************************************************************************************
	* ATTACHMENT CONTENT ID                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Ekin içerik id bilgisini verir.					 	  				  |
	 
	  @param  string $filename
	  @return array
	|          																				  |
	******************************************************************************************/
	public function attachmentContentId($filename = '')
	{
		if( $this->multiPart !== 'related' )
		{
			$this->multiPart = 'related'; 
		}
		
		for( $i = 0, $c = count($this->attachments); $i < $c; $i++ )
		{
			if( $this->attachments[$i]['name'][0] === $filename )
			{
				$this->attachments[$i]['cid'] = uniqid(basename($this->attachments[$i]['name'][0]).'@');
				
				return $this->attachments[$i]['cid'];
			}
		}
		
		return false;
	}
	
	/******************************************************************************************
	* SEND		    		                                                                  *
	*******************************************************************************************
	| Genel Kullanım: E-posta gönderimini sağlayan nihai yöntemdir.							  |
	
	  @param  string $subject
	  @param  string $message
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function send($subject = '', $message = '')
	{
		if( ! isset($this->headers['From']) )
		{
			if( ! empty($this->senderMail) )
			{
				$this->sender($this->senderMail, $this->senderName);
			}
			else
			{
				return \Errors::set('Email', 'noFrom');
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
			$this->addHeader('To', $this->_toString($this->to));
		}
		
		if( ! empty($this->cc) )
		{
			$this->addHeader('Cc', $this->_toString($this->cc));
		}
		
		if( ! empty($this->bcc) )
		{
			$this->addHeader('Bcc', $this->_toString($this->bcc));
		}
		
		$this->_buildContent();
		
		$settings = array
		(
			'host' 		 => $this->smtpHost,
			'user' 		 => $this->smtpUser,
			'password' 	 => $this->smtpPassword,
			'from' 		 => $this->from,
			'port' 		 => $this->smtpPort,
			'encoding' 	 => $this->encodingType,
			'timeout' 	 => $this->smtpTimeout,
			'cc' 		 => $this->cc,
			'bcc'		 => $this->bcc,
			'authLogin'  => $this->smtpAuth,
			'encode' 	 => $this->smtpEncode,
			'keepAlive'  => $this->smtpKeepAlive,
			'dsn'		 => $this->smtpDsn,
			'tos'		 => $this->to,
			'mailPath'   => $this->mailPath,
			'returnPath' => $this->headers['Return-Path']
		);

		$send = $this->email->send(key($this->to), $this->subject, $this->message, $this->header, $settings);
		
		if( empty($send) )
		{
			return \Errors::set('Email', 'noSend');
		}
		
		$this->_defaultVariables();
		
		return $send;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Send Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Protected Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* PROTECTED BUILD HEADERS                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Mesaj																	  |
	
	  @param  void
	  @return void
	|          																				  |
	******************************************************************************************/
	protected function _buildHeaders()
	{
		$this->addHeader('X-Sender',     $this->headers['From']);
		$this->addHeader('X-Mailer',     $this->xMailer);
		$this->addHeader('X-Priority',   $this->priorityTypes[$this->priority]);
		$this->addHeader('Message-ID',   $this->_getMessageId());
		$this->addHeader('Mime-Version', $this->mimeVersion);
		$this->addHeader('Date',         $this->_getDate());
	}
	
	/******************************************************************************************
	* PROTECTED GET DATE                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Tarih																	  |
	
	  @param  void
	  @return string
	|          																				  |
	******************************************************************************************/
	protected function _getDate()
	{
		$timezone = date('Z');
		$operator = ( $timezone[0] === '-' ) ? '-' : '+';
		$timezone = abs($timezone);
		$timezone = floor($timezone/3600) * 100 + ($timezone % 3600) / 60;
		
		return sprintf('%s %s%04d', date('D, j M Y H:i:s'), $operator, $timezone);
	}
	
	/******************************************************************************************
	* PROTECTED MIME MESSAGE                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Mime ile ilgili mesaj.												  |
	
	  @param  void
	  @return void
	|          																				  |
	******************************************************************************************/
	protected function _mimeMessage()
	{
		return lang('Email', 'mimeMessage', $this->lf);
	}
	
	/******************************************************************************************
	* PROTECTED WRITE HEADERS                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Başlık bilgilerini metinsel ifadeye çevirir.							  |
	
	  @param  void
	  @return void
	|          																				  |
	******************************************************************************************/
	protected function _writeHeaders()
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
	
	/******************************************************************************************
	* GET MESSAGE ID		                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Mesaj id değeri elde edilir.											  |
	
	  @param  void
	  @return string
	|          																				  |
	******************************************************************************************/
	protected function _getMessageId()
	{
		$from = str_replace(['>', '<'], '', $this->headers['Return-Path']);
		
		return '<'.uniqid('').strstr($from, '@').'>';
	}
	
	/******************************************************************************************
	* PROTECTED TO ARRAY                                                                      *
	*******************************************************************************************
	| Genel Kullanım: String veriyi diziye çevirir.											  |
	
	  @param  string $email
	  @return array
	|          																				  |
	******************************************************************************************/
	protected function _toArray($email = '')
	{
		if( ! is_array($email) )
		{
			return ( strpos($email, ',') !== false )
				   ? preg_split('/[\s,]/', $email, -1, PREG_SPLIT_NO_EMPTY)
				   : (array)trim($email);
		}
		
		return $email;
	}
	
	/******************************************************************************************
	* PROTECTED TO STRING                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Dizi verisini metin türüne çevirir.									  |
	
	  @param  string $email
	  @return array
	|          																				  |
	******************************************************************************************/
	protected function _toString($email = '')
	{
		if( is_array($email) )
		{
			$string = '';
			
			foreach( $email as $key => $val )
			{
				if( isEmail($key) )
				{
					$string .= "$val <$key>, ";
				}
			}
			
			$email = substr(trim($string), 0, -1);
		}
		
		return $email;
	}	
	
	/******************************************************************************************
	* PROTECTED BOUNDARY     			                                           			  *
	*******************************************************************************************
	| Genel Kullanım: Mesajın içeriğinin sınır.												  |
	
	  @param  boundary
	  @return object
	|          																				  |
	******************************************************************************************/
	protected function _boundary()
	{
		$this->boundary = 'BOUNDARY_'.md5(uniqid(time()));
	}
	
	/******************************************************************************************
	* PROTECTED BUILD CONTENT                                                                 *
	*******************************************************************************************
	| Genel Kullanım: İçerik oluşturuluyor.													  |
	
	  @param  void
	  @return void
	|          																				  |
	******************************************************************************************/
	protected function _buildContent()
	{	
		$this->_buildHeaders();
		$this->_boundary();
		$this->_writeHeaders();
		
		$body = ''; $header = '';
		
		if( in_array($this->multiPart, $this->multiParts) && ! empty($this->attachments) ) 
		{
			$header .= 'Content-Type: multipart/'.$this->multiPart.'; boundary="'.$this->boundary.'"';
			
			$body 	.= $this->_mimeMessage().$this->lf.$this->lf;
			$body   .= '--'.$this->boundary.$this->lf;
			$body 	.= 'Content-Type: text/'.$this->contentType.'; charset='.$this->charset.$this->lf;
			$body 	.= 'Content-Transfer-Encoding: '.$this->encodingType.$this->lf.$this->lf;
			$body 	.= $this->message.$this->lf.$this->lf;
		
			$attachment = [];
			
			for( $i = 0, $c = count($this->attachments), $z = 0; $i < $c; $i++ )
			{
				$filename = $this->attachments[$i]['name'][0];
				$basename = ( $this->attachments[$i]['name'][1] === NULL )
							? basename($filename) 
							: $this->attachments[$i]['name'][1];
							
				$attachment[$z++] = '--'.$this->boundary.$this->lf.
									'Content-Type: '.$this->attachments[$i]['type'].'; name="'.$basename.'"'.$this->lf.
									'Content-Disposition: '.$this->attachments[$i]['disposition'].';'.$this->lf.
									'Content-Transfer-Encoding: base64'.$this->lf.
									( empty($this->attachments[$i]['cid'] ) 
									? '' 
									: 'Content-ID: <'.$this->attachments[$i]['cid'].'>'.$this->lf);
									
				$attachment[$z++] = $this->attachments[$i]['content'];
			}

			$body .= implode($this->lf, $attachment).$this->lf.'--'.$this->boundary.'--';
		}
		else
		{
			$header .= 'Content-Type: text/'.$this->contentType.'; charset='.$this->charset.$this->lf;
		}
		
		if( $this->driver === 'smtp' )
		{			
			$this->message = $header.$this->lf.$this->lf.$body.$this->message.$this->lf.$this->lf;
		}
		else
		{
			$this->header = $header.$body;
		}
		
		return true;
	}
	
	/******************************************************************************************
	* DEFAULT VARIABLES                                                                       *
	*******************************************************************************************
	| Genel Kullanım: Ayarlar varsayılana getiriliyor.						 		          |
		
	  @param  string $driver
	  @return object
	|          																				  |
	******************************************************************************************/
	protected function _defaultVariables()
	{
		$this->subject		= '';
		$this->message		= '';
		$this->header		= '';
		$this->headers		= [];
		$this->addHeader('Date', $this->_getDate());
		$this->attachments  = [];
		$this->senderMail	= '';
		$this->senderName	= '';
		$this->charset 		= 'UTF-8';
		$this->contentType  = 'plain';
		$this->cc			= NULL;
		$this->bcc			= NULL;
		$this->smtpHost		= '';
		$this->smtpUser		= '';
		$this->smtpPassword	= '';
		$this->smtpEncode   = '';
		$this->smtpPort	    = 587;
		$this->smtpTimeout	= 10;
		$this->smtpAuth		= true;
		$this->smtpDsn		= false;
		$this->smtpKeepAlive = false;
		$this->mimeVersion	= '1.0';
		$this->boundary		= '';
		$this->multiPart	= 'mixed';
		$this->priority 	= 3;
		$this->encodingType = '8bit';
		$this->to 			= [];
		$this->replyTo 		= [];
		$this->from			= NULL;
		$this->email		= NULL;
		$this->driver 		= NULL;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Methods Bitiş
	//----------------------------------------------------------------------------------------------------
}