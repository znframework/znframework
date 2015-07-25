<?php
class __USE_STATIC_ACCESS__Email
{
	/***********************************************************************************/
	/* EMAIL LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Email
	/* Versiyon: 2.0
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: $this->email, zn::$use->email, uselib('email')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* Priority Değişkeni
	 *  
	 * Başlık değer bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $priority		  	= 3;
	
	/* Protocol Type Değişkeni
	 *  
	 * Hangi yöntemle gönder işlemi yapılacağı bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * 'mail' veya 'smtp'
	 */
	protected $protocolType     = 'mail'; 
	
	/* Content Type Değişkeni
	 *  
	 * E-posta içeği bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * 'html', veya 'text'
	 */
	protected $contentType		= 'html'; 
	
	/* Charset Değişkeni
	 *  
	 * E-posta içeğinin dil bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * 'utf-8'
	 */
	protected $charset			= 'UTF-8';
	
	/* Multi Part Değişkeni
	 *  
	 * Çoklu bölüm bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * 'mixed' veya 'related'
	 */
	protected $multiPart		= 'mixed';
	
	/* Send Multi Part Değişkeni
	 *  
	 * Çoklu bölümlü gönderim bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * true
	 */
	protected $sendMultiPart	= true;
	
	/* X MAILER Değişkeni
	 *  
	 * X-Mailer bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * 'ZN'
	 */
	protected $xMailer = 'ZN';
	
	/* Mail Path Değişkeni
	 *  
	 * E-posta gönderim yolu bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * '/usr/sbin/sendmail'
	 */
	protected $mailPath	      	= '/usr/sbin/sendmail';
	
	/* SMTP Connect Değişkeni
	 *  
	 * SMTP Bağlantı soketi bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $smtpConnect		= '';
	
	/* SMTP Connect Değişkeni
	 *  
	 * SMTP Bağlantı soketi bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $smtpHost		  	= ''; 
	
	/* SMTP Host Değişkeni
	 *  
	 * SMTP sunucu bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $smtpUser		  	= '';
	
	/* SMTP Password Değişkeni
	 *  
	 * SMTP kullanıcı şifre bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $smtpPassword     = '';
	
	/* SMTP Port Değişkeni
	 *  
	 * SMTP port bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * 587
	 */
	protected $smtpPort	     	= 587;
	
	/* SMTP Keep Alive Değişkeni
	 *  
	 * SMTP kalıcı bağlantı bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * false
	 */
	protected $smtpKeepAlive	= false;
	
	/* SMTP Timeout Değişkeni
	 *  
	 * SMTP bağlantısı zaman aşım bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * 10
	 */
	protected $smtpTimeout		= 10; 
	
	/* SMTP Encode Değişkeni
	 *  
	 * SMTP şifreleme bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * 'tls' veya 'ssl'
	 */
	protected $smtpEncode       = 'tls';
	
	/* SMTP Auth Değişkeni
	 *  
	 * SMTP kullanıcı bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * false
	 */ 
	protected $smtpAuth		  	= false;
	
	/* Sender Mail Değişkeni
	 *  
	 * Varsayılan gönderici bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */ 
	protected $senderMail		= '';
	
	/* Sender Name Değişkeni
	 *  
	 * Varsayılan gönderici isim bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */ 
	protected $senderName		= '';
	
	/* Word Wrap Değişkeni
	 *  
	 * Kelime kaydırma bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * true
	 */ 
	protected $wordWrap	      	= true;
	
	/* Char Wrap Değişkeni
	 *  
	 * Karakter kaydırma bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * 80
	 */ 
	protected $charWrap		  	= 80;
	
	/* Alternative Content Değişkeni
	 *  
	 * Alternatif mesaj bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * Sadece html içerikli göndrimde kullanılabilir.
	 */ 
	protected $altContent		= ''; 
	
	/* Validate Değişkeni
	 *  
	 * E-posta adresleri doğrulama bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * true
	 */ 
	protected $validate	      	= true;
	
	/* EOL Değişkeni
	 *  
	 * Satır sonu karakter bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * "\n"
	 */ 
	protected $eol				= "\n"; 
	
	/* DSN Değişkeni
	 *  
	 * Teslim durum bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * false
	 */ 
	protected $dsn				= false;
	
	/* Bcc Stack Mode Değişkeni
	 *  
	 * Gruplar halinde bcc gönderim bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * false
	 */ 
	protected $bccStackMode	  	= false;
	
	/* Bcc Stack Size Değişkeni
	 *  
	 * Gruplar halinde bcc gönderim maksimum gönderim sayısı bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * 200
	 */ 
	protected $bccStackSize	  	= 200;
	
	/* Safe Mode Değişkeni
	 *  
	 * Güvenli mod bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * false
	 */ 
	protected $safeMode    	  	= false;
	
	/* Subject Değişkeni
	 *  
	 * Konu bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */ 
	protected $subject			= '';
	
	/* Body Değişkeni
	 *  
	 * Mesaj bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */ 
	protected $body			  	= '';
	
	/* Last Body Değişkeni
	 *  
	 * Son ileti bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */ 
	protected $lastBody		  	= '';
	
	/* Alternative Limit Değişkeni
	 *  
	 * alternatif gönderim sınır bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */ 
	protected $altLimit		    = '';
	
	/* Attachment Limit Değişkeni
	 *  
	 * Ek sayısı sınır bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */ 
	protected $attachLimit      = '';
	
	/* Header String Değişkeni
	 *  
	 * Song başlıklar gönderim bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */ 
	protected $headerString	  	= '';
	
	/* Encode Değişkeni
	 *  
	 * E-posta şifreleme bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * '8bit'
	 */
	protected $encode		    = '8bit';
	
	/* Reply To Flag Değişkeni
	 *  
	 * Yanıt üst bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * false
	 */
	protected $replyToFlag		= false; 
	
	/* MB Enabled Değişkeni
	 *
	 * true
	 */
	protected $mbEnabled 		= true;
	
	/* Iconv Enabled Değişkeni
	 *
	 * true
	 */
	protected $iconvEnabled 	= true;
	
	/* Debug Message Değişkeni
	 *  
	 * E-posta gönderiminde oluşan hatalar bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $debugMessage		= array();
	
	/* Receivers Değişkeni
	 *  
	 * Alıcılar bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $receivers		= array();
	
	/* CC Receivers Değişkeni
	 *  
	 * CC Alıcılar bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $ccReceivers		= array();
	
	/* BCC Receivers Değişkeni
	 *  
	 * BCC Alıcılar bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $bccReceivers     = array();
	
	/* Header Değişkeni
	 *  
	 * Gönderilecek başlık bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $headers			= array();
	
	/* Attachmetns Değişkeni
	 *  
	 * Gönderilecek ek bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $attachments		= array();
	
	/* Protokol Types Değişkeni
	 *  
	 * Gönderim tipleri bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $protocolTypes	= array('mail', 'smtp');
	
	/* Charset Types Değişkeni
	 *  
	 * Karakter setleri bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $charsetTypes	    = array('us-ascii', 'iso-2022-');
	
	/* Encode Types Değişkeni
	 *  
	 * Şifreleme tipleri bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $encodeTypes		= array('7bit', '8bit');
	
	/* Priority Types Değişkeni
	 *  
	 * Öncelik bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $priorityTypes	= array(1 => '1 (Highest)', 2 => '2 (High)', 3 => '3 (Normal)', 4 => '4 (Low)',5 => '5 (Lowest)');
	
	/* Config Değişkeni
	 *  
	 * Config/Email.php ayar bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $config			= array();	
	
	/******************************************************************************************
	* CONSTRUCT                                                                               *
	*******************************************************************************************
	| Genel Kullanım: E-posta ayarları çalıştırılıyor.				     					  |
	|          																				  |
	******************************************************************************************/
	public function __construct($config = array())
	{		
		$this->config  = Config::get('Email');
		
		$this->charset = $this->config['charset'];
		
		if( ! empty($this->charset) )
		{
			$this->charset = strtoupper($this->charset);	
		}
		
		if( empty($config) )
		{
			$this->settings($this->config);	
		}
		else
		{
			$this->settings($config);
		}
		
		$this->safeMode = ( ! isPhpVersion('5.4') && ini_get('safe_mode') );
		
		$this->charset = strtoupper($this->charset);
	}
	
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
	public function settings($config = array())
	{
		if( ! is_array($config) )
		{
			Error::set(lang('Error', 'arrayParameter', 'config'));	
		}
		else
		{
			foreach( $config as $key => $val )
			{
				if ( isset($this->$key) )
				{
					$this->$key = $val;
				}
			}
	
			$this->smtpAuth = ! ( $this->smtpUser === '' && $this->smtpPassword === '' );
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* FROM                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Gönderici e-posta adresini ve gönderen ismini belirlemek içindir.		  |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @from => Gönderici e-posta adresi.		  								  |
	| 2. string var @name => Gönderici ismi.		  						  				  |
	| 3. string var @returnPath => İsteğe bağlı e-posta adresi ile teslim edilmemiş e-posta	  |
	| bilgisini yönlendirmek için kullanılır.		  						  				  |
	|          																				  |
	| Örnek Kullanım: from('bilgi@zntr.net', 'ZNTR', 'donus@example.com');		       		  |
	|          																				  |
	******************************************************************************************/
	public function from($from = '', $name = '', $returnPath = NULL)
	{
		$this->sender($from, $name, $returnPath);
		
		return $this;
	}
	
	/******************************************************************************************
	* SENDER / FROM                                                                           *
	*******************************************************************************************
	| Genel Kullanım: from() yöntemi ile aynı işlevi yerine getirir.						  |
	|          																				  |
	******************************************************************************************/
	public function sender($from = '', $name = '', $returnPath = NULL)
	{
		if( preg_match('/\<(.*)\>/', $from, $match) )
		{
			$from = $match[1];
		}
		
		if( $this->validate )
		{
			$this->validateEmail($this->_strToArray($from));
			
			if( ! empty($returnPath) )
			{
				$this->validateEmail($this->_strToArray($returnPath));
			}
		}
		
		if( $name !== '' )
		{
			if( ! preg_match('/[\200-\377]/', $name) )
			{
				$name = '"'.addcslashes($name, "\0..\37\177'\"\\").'"';
			}
			else
			{
				$name = $this->_prepQEncoding($name);
			}
		}
		
		$this->setHeader('From', $name.' <'.$from.'>');
		
		isset( $returnPath ) || $returnPath = $from;
		
		$this->setHeader('Return-Path', '<'.$returnPath.'>');
		
		return $this;
	}
	
	/******************************************************************************************
	* FROM                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Gelen e-postaya cevap vermek için kullanılır.							  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @replyTo => Alıcı e-posta adresi.		  								  |
	| 2. string var @name => Alıcı ismi.		  							  				  |
	|          																				  |
	| Örnek Kullanım: replyTo('bilgi@zntr.net', 'ZNTR');		       						  |
	|          																				  |
	******************************************************************************************/
	public function replyTo($replyTo = '', $name = '')
	{
		if( preg_match('/\<(.*)\>/', $replyTo, $match) )
		{
			$replyTo = $match[1];
		}
		
		if( $this->validate )
		{
			$this->validateEmail($this->_strToArray($replyTo));
		}
		
		if( $name === '' )
		{
			$name = $replyTo;
		}
		
		if (strpos($name, '"') !== 0)
		{
			$name = '"'.$name.'"';
		}
		
		$this->setHeader('Reply-To', $name.' <'.$replyTo.'>');
		
		$this->replyToFlag = true;
		
		return $this;
	}
	
	/******************************************************************************************
	* TO                                                                                      *
	*******************************************************************************************
	| Genel Kullanım: E-posta gönderilecek kişinin e-posta adresi.							  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @to => Alıcı e-posta adresi.		  								      |
	|          																				  |
	| Örnek Kullanım: to('bilgi@zntr.net');		 				      						  |
	|          																				  |
	******************************************************************************************/
	public function to($to = '')
	{
		$this->receiver($to);
		
		return $this;	
	}
	
	/******************************************************************************************
	* RECEIVER / TO                                                                           *
	*******************************************************************************************
	| Genel Kullanım: to() yönteminin kullanımı ile aynı işleve sahiptir.					  |
	|          																				  |
	******************************************************************************************/
	public function receiver($to = '')
	{
		$to = $this->_strToArray($to);
		
		$to = $this->cleanEmail($to);
		
		if( $this->validate )
		{
			$this->validateEmail($to);
		}
		
		if( $this->_getProtocolType() !== 'mail' )
		{
			$this->setHeader('To', implode(', ', $to));
		}
		
		$this->receivers = $to;
		
		return $this;
	}
	
	/******************************************************************************************
	* SUBJECT                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: E-posta adresinin konusu.					 							  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @subject => Konu.  		     		  								      |
	|          																				  |
	| Örnek Kullanım: subject('Konu');		 				      						  	  |
	|          																				  |
	******************************************************************************************/
	public function subject($subject = '')
	{
		$subject = $this->_prepQEncoding($subject);
		
		$this->setHeader('Subject', $subject);
		
		return $this;
	}
	
	/******************************************************************************************
	* MESSAGE                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: E-posta adresinin içeriği.					 						  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @body => İçerik.  		     		  								      |
	|          																				  |
	| Örnek Kullanım: message('İçerik');		 				      						  |
	|          																				  |
	******************************************************************************************/
	public function message($body = '')
	{
		$this->content($body);
		
		return $this;	
	}
	
	/******************************************************************************************
	* CONTENT                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: message() yöntemi ile aynı kullanıma sahiptir.					  	  |
	|          																				  |
	******************************************************************************************/
	public function content($body = '')
	{
		$this->body = rtrim(str_replace("\r", '', $body));
		
		if( ! isPhpVersion('5.4') && get_magic_quotes_gpc() )
		{
			$this->body = stripslashes($this->body);
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* ATTACHMENT                                                                              *
	*******************************************************************************************
	| Genel Kullanım: E-post gönderiminde gönderiye eklenecek ekler.					 	  |
	|															                              |
	| Parametreler: 4 parametresi vardır.                                                     |
	| 1. string var @file => Dosyanın yerel yolu.  		     		  						  |
	| 2. string var @disposition => Eğilim yolu.  		     		  						  |
	| 3. string var @newName => Dosyanın görünecek adı.  		     		  				  |
	| 4. string var @mime => Dosyanın içerik tipi.		  		     		  				  |
	|          																				  |
	| Örnek Kullanım: attachment('resimler/dosya.jpg', '', 'resim');		 				  |
	|          																				  |
	******************************************************************************************/
	public function attachment($file = '', $disposition = '', $newName = NULL, $mime = 'application/octet-stream')
	{
		$mimeTypes = Config::get('MimeTypes');
		
		$mime = ! empty($mimeTypes[$mime])
				? $mimeTypes[$mime]
				: 'application/octet-stream';
		
		if( is_array($mime) )
		{
			$mime = $mime[0];	
		} 
		
		if( $mime === '' )
		{
			if( strpos($file, '://') === false && ! file_exists($file) )
			{
				$this->_setErrorMessage('attachmentMissing', $file);
				return false;
			}
			
			if( ! $fp = @fopen($file, 'rb') )
			{
				$this->_setErrorMessage('attachmentUnreadable', $file);
				return false;
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
			'name'			=> array($file, $newName),
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
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @filename => Dosyanın yerel yolu.  		     		  					  |
	|          																				  |
	| Örnek Kullanım: attachattachmentContentIdment('resimler/dosya.jpg');		 			  |
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
	* CC				                                                                      *
	*******************************************************************************************
	| Genel Kullanım: CC Alıcılarını belirtmek için kullanılır.					 	  		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @cc => CC alıcısı.  		     		  					  			  |
	|          																				  |
	| Örnek Kullanım: cc('bilgi@zntr.net');		 			 							      |
	|          																				  |
	******************************************************************************************/
	public function cc($cc = '')
	{
		$cc = $this->cleanEmail($this->_strToArray($cc));
		
		if( $this->validate )
		{
			$this->validateEmail($cc);
		}
		
		$this->setHeader('Cc', implode(', ', $cc));
		
		if ($this->_getProtocolType() === 'smtp')
		{
			$this->ccReceivers = $cc;
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* BCC				                                                                      *
	*******************************************************************************************
	| Genel Kullanım: BCC Alıcılarını belirtmek için kullanılır.					 	  	  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @bcc => BCC alıcısı.  		     		  					  			  |
	| 2. numeric var @limit => BCC alıcısı limiti.  		     		  					  |
	|          																				  |
	| Örnek Kullanım: bcc('bilgi@zntr.net', 10);			 							      |
	|          																				  |
	******************************************************************************************/
	public function bcc($bcc = '', $limit = '')
	{
		if( $limit !== '' && is_numeric($limit) )
		{
			$this->bccStackMode = true;
			$this->bccStackSize = $limit;
		}
		
		$bcc = $this->cleanEmail($this->_strToArray($bcc));
		
		if( $this->validate )
		{
			$this->validateEmail($bcc);
		}
		
		if( $this->_getProtocolType() === 'smtp' || ($this->bccStackMode && count($bcc) > $this->bccStackSize) )
		{
			$this->bccReceivers = $bcc;
		}
		else
		{
			$this->setHeader('Bcc', implode(', ', $bcc));
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* SMPT HOST			                                                                      *
	*******************************************************************************************
	| Genel Kullanım: SMPT Host ayarını yapmak için kullanılır.					 	  	      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @host => SMTP Sunucu adı.	     		  					  			  |
	|          																				  |
	| Örnek Kullanım: smtpHost('mail.zntr.net');			 							      |
	|          																				  |
	******************************************************************************************/
	public function smtpHost($host = '')
	{
		if( isValue($host) )
		{
			$this->smtpHost = $host;	
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
		if( isValue($user) )
		{
			$this->smtpUser = $user;	
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
		if( isValue($pass) )
		{
			$this->smtpPassword = $pass;	
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
	public function smtpPort($port = '')
	{
		if( is_numeric($port) )
		{
			$this->smtpPort = $port;	
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
	public function smtpTimeout($timeout = '')
	{
		if( is_numeric($timeout) )
		{
			$this->smtpTimeout = $timeout;	
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
		
		return $this;
	}
	
	public function mailPath($path = 'usr/sbin/sendmail')
	{
		if( is_string($path) )
		{
			$this->mailPath = prefix($path);	
		}
		
		return $this;
	}
	
	public function validate($valid = true)
	{
		if( is_bool($valid) )
		{
			$this->validate = $valid;	
		}
		
		return $this;
	}
	
	public function dsn($dsn = true)
	{
		if( is_bool($dsn) )
		{
			$this->dsn = $dsn;	
		}
		
		return $this;
	}
	
	public function charset($charset = 'UTF-8')
	{
		if( isCharset($charset) )
		{
			$this->charset = $charset;	
		}
		
		return $this;
	}
	
	public function multiPart($multiPart = 'mixed')
	{
		if( is_string($multiPart) )
		{
			$multiPart = ( $multiPart === 'mixed' )
						 ? 'mixed'
						 : 'related';
						 
			$this->multiPart = $multiPart;	
		}
		
		return $this;
	}
	
	public function sendMultiPart($multi = true)
	{
		if( is_bool($multi) )
		{
			$this->sendMultiPart = $multi;	
		}
		
		return $this;
	}
	
	public function wrap($word = true, $char = 80)
	{
		if( is_bool($word) )
		{
			$this->wordWrap = $word;	
		}
		
		if( is_numeric($char) )
		{
			$this->charWrap = $char;	
		}
		
		return $this;
	}
	
	public function bccStack($mode = true, $size = 200)
	{
		if( is_bool($mode) )
		{
			$this->bccStackMode = $mode;	
		}
		
		if( is_numeric($size) )
		{
			$this->bccStackSize = $size;	
		}
		
		return $this;
	}
	
	public function setHeader($header = '', $value = '')
	{
		$this->headers[$header] = str_replace(array("\n", "\r"), '', $value);
	}
	
	public function altMessage($str = '')
	{
		$this->altContent($str);
		
		return $this;
	}
	
	public function altContent($str = '')
	{
		$this->altContent = (string)$str;
		
		return $this;
	}
	
	public function contentType($type = 'text')
	{
		$this->contentType = ( $type === 'html' ) 
							 ? 'html' 
							 : 'text';
		return $this;
	}
	
	public function protocolType($type = 'mail')
	{
		$this->protocolType = in_array($type, $this->protocolTypes, true) ? strtolower($type) : 'mail';
		
		return $this;
	}
	
	public function priority($count = 3)
	{
		$this->priority = preg_match('/^[1-5]$/', $count) 
						? (int)$count 
						: 3;
						
		return $this;
	}
	
	public function eol($eol = "\n")
	{
		$this->eol = in_array($eol, array("\n", "\r\n", "\r")) 
				   ? $eol 
				   : "\n";
				   
		return $this;
	}
	
	public function validateEmail($email = '')
	{
		if ( ! is_array($email))
		{
			$this->_setErrorMessage('mustBeArray');
			return false;
		}
		
		foreach( $email as $val )
		{
			if ( ! isEmail($val) )
			{
				$this->_setErrorMessage('invalidAddress', $val);
				
				return false;
			}
		}
		
		return true;
	}
	
	public function cleanEmail($email = '')
	{
		if ( ! is_array($email) )
		{
			return preg_match('/\<(.*)\>/', $email, $match) ? $match[1] : $email;
		}
		
		$cleanEmail = array();
		
		foreach( $email as $addy )
		{
			$cleanEmail[] = preg_match('/\<(.*)\>/', $addy, $match) ? $match[1] : $addy;
		}
		
		return $cleanEmail;
	}
	
	public function wordWrap($str = '', $charLimit = NULL)
	{
		if( empty($charLimit) )
		{
			$charLimit = empty($this->charWrap) 
					   ? 80 
					   : $this->charWrap;
		}
	
		if( strpos($str, "\r") !== false )
		{
			$str = str_replace(array("\r\n", "\r"), "\n", $str);
		}
		
		$str = preg_replace('| +\n|', "\n", $str);
		
		$unwrap = array();
		
		if( preg_match_all('|\{unwrap\}(.+?)\{/unwrap\}|s', $str, $matches) )
		{
			for ($i = 0, $c = count($matches[0]); $i < $c; $i++)
			{
				$unwrap[] = $matches[1][$i];
				$str = str_replace($matches[0][$i], '{{unwrapped'.$i.'}}', $str);
			}
		}
		
		$str = wordwrap($str, $charLimit, "\n", FALSE);
		
		$output = '';
		
		foreach( explode("\n", $str) as $line )
		{
			if( mb_strlen($line) <= $charLimit )
			{
				$output .= $line.$this->eol;
				continue;
			}
			
			$temp = '';
			
			do
			{
				if( preg_match('!\[url.+\]|://|www\.!', $line) )
				{
					break;
				}
				
				$temp .= mb_substr($line, 0, $charLimit - 1);
				$line  = mb_substr($line, $charLimit - 1);
			}
			
			while( mb_strlen($line) > $charLimit );

			if( $temp !== '' )
			{
				$output .= $temp.$this->eol;
			}
			$output .= $line.$this->eol;
		}
	
		if( count($unwrap) > 0 )
		{
			foreach ($unwrap as $key => $val)
			{
				$output = str_replace('{{unwrapped'.$key.'}}', $val, $output);
			}
		}
		
		return $output;
	}

	public function send()
	{
		if( ! isset($this->headers['From']) )
		{
			if( ! empty($this->senderMail) )
			{
				$this->sender($this->senderMail, $this->senderName);
			}
			else
			{
				$this->_setErrorMessage('noFrom');
			
				return false;	
			}
		}
		
		if ($this->replyToFlag === false)
		{
			$this->replyTo($this->headers['From']);
		}
		
		if( ! isset($this->receivers) && ! isset($this->headers['To']) && ! isset($this->bccReceivers) && ! isset($this->headers['Bcc']) && ! isset($this->headers['Cc']) )
		{
			$this->_setErrorMessage('noReceivers');
			
			return false;
		}
		
		$this->_buildHeaders();
		
		if( $this->bccStackMode && count($this->bccReceivers) > $this->bccStackSize )
		{
			$result = $this->stackBccSend(); 
			
			if( ! empty($result) )
			{
				$this->defaultVariables();
			}
			
			return $result;
		}
		
		if( $this->_buildContent() === false )
		{
			return false;
		}
		
		$result = $this->_spoolEmail();
		
		if( ! empty($result) )
		{
			$this->defaultVariables();
		}
		
		return $result;
	}
	
	public function stackBccSend() // batch_bcc_send
	{
		$float = $this->bccStackSize - 1;
		$set = '';
		$chunk = array();
		
		for( $i = 0, $c = count($this->bccReceivers); $i < $c; $i++ )
		{
			if( isset($this->bccReceivers[$i]) )
			{
				$set .= ', '.$this->bccReceivers[$i];
			}
			
			if( $i === $float )
			{
				$chunk[] = substr($set, 1);
				$float += $this->bccStackSize;
				$set = '';
			}
			
			if( $i === $c - 1 )
			{
				$chunk[] = substr($set, 1);
			}
		}
		
		for( $i = 0, $c = count($chunk); $i < $c; $i++ )
		{
			unset($this->headers['Bcc']);
			
			$bcc = $this->cleanEmail($this->_strToArray($chunk[$i]));
			
			if ($this->protocolType !== 'smtp')
			{
				$this->setHeader('Bcc', implode(', ', $bcc));
			}
			else
			{
				$this->bccReceivers = $bcc;
			}
			
			if ($this->_buildContent() === FALSE)
			{
				return FALSE;
			}
			$this->_spoolEmail();
		}
	}
	
	public function error($include = array('headers', 'subject', 'body'))
	{
		$msg = '';
		if( count($this->debugMessage) > 0 )
		{
			foreach( $this->debugMessage as $val )
			{
				$msg .= $val;
			}
		}
		
		$raw_data = '';
		
		is_array($include) || $include = array($include);
		
		if( in_array('headers', $include, true) )
		{
			$raw_data = htmlspecialchars($this->headerString)."\n";
		}
		if( in_array('subject', $include, true) )
		{
			$raw_data .= htmlspecialchars($this->subject)."\n";
		}
		if( in_array('body', $include, true) )
		{
			$raw_data .= htmlspecialchars($this->lastBody);
		}
		
		$errorString = $msg.( $raw_data === '' ? '' : '<pre>'.$raw_data.'</pre>' );
		
		Error::set($errorString);
		
		return $errorString;
	}
	
	public function success()
	{
		if( empty($this->debugMessage) )
		{
			return lang('Email', 'sent');
		}
		else
		{
			return false;	
		}	
	}
	
	protected function defaultVariables()
	{
		$this->subject		= '';
		$this->body			= '';
		$this->lastBody		= '';
		$this->headerString	= '';
		$this->replyToFlag	= false;
		$this->receivers	= array();
		$this->ccReceivers	= array();
		$this->bccReceivers	= array();
		$this->headers		= array();
		$this->debugMessage = array();
		$this->setHeader('User-Agent', $this->xMailer);
		$this->setHeader('Date', $this->_setDate());
		$this->attachments = array();
	}
	
	protected function _strToArray($email)
	{
		if( ! is_array($email) )
		{
			return ( strpos($email, ',') !== false )
				   ? preg_split('/[\s,]/', $email, -1, PREG_SPLIT_NO_EMPTY)
				   :(array)trim($email);
		}
		
		return $email;
	}
	
	protected function _setLimit()
	{
		$this->altLimit    = 'B_ALT_'.uniqid(''); 
		$this->attachLimit = 'B_ATC_'.uniqid('');
	}
	
	protected function _getMessageId()
	{
		$from = str_replace(array('>', '<'), '', $this->headers['Return-Path']);
		
		return '<'.uniqid('').strstr($from, '@').'>';
	}
	
	protected function _getProtocolType($return = true)
	{
		$this->protocolType = strtolower($this->protocolType);
		
		in_array($this->protocolType, $this->protocolTypes, true) || $this->protocolType = 'mail';
		
		if( $return === true )
		{
			return $this->protocolType;
		}
	}
	
	protected function _getEncode($return = true)
	{
		in_array($this->encode, $this->encodeTypes) || $this->encode = '8bit';
		
		foreach( $this->charsetTypes as $charset )
		{
			if( strpos($charset, $this->charset) === 0 )
			{
				$this->encode = '7bit';
			}
		}
		
		if( $return === true )
		{
			return $this->encode;
		}
	}
	
	protected function _getContentType()
	{
		if( $this->contentType === 'html' )
		{
			return ( count($this->attachments) === 0) 
				   ? 'html' 
				   : 'html-attach';
		}
		elseif( $this->contentType === 'text' && count($this->attachments) > 0 )
		{
			return 'plain-attach';
		}
		else
		{
			return 'plain';
		}
	}
	
	protected function _setDate()
	{
		$timezone = date('Z');
		$operator = ( $timezone[0] === '-' ) ? '-' : '+';
		$timezone = abs($timezone);
		$timezone = floor($timezone/3600) * 100 + ($timezone % 3600) / 60;
		
		return sprintf('%s %s%04d', date('D, j M Y H:i:s'), $operator, $timezone);
	}
	
	protected function _getMimeMessage()
	{
		return 'This is a multi-part message in MIME format.'.$this->eol.'Your email application may not support this format.';
	}
	
	protected function _getAltContent()
	{
		if( ! empty($this->altContent) )
		{
			return ($this->wordWrap)
				? $this->wordWrap($this->altContent, 80)
				: $this->altContent;
		}
		
		$body = preg_match('/\<body.*?\>(.*)\<\/body\>/si', $this->body, $match) 
			  ? $match[1] 
			  : $this->body;
		
		$body = str_replace("\t", '', preg_replace('#<!--(.*)--\>#', '', trim(strip_tags($body))));
		
		for( $i = 20; $i >= 3; $i-- )
		{
			$body = str_replace(str_repeat("\n", $i), "\n\n", $body);
		}
		
		$body = preg_replace('| +|', ' ', $body);
		
		return ( $this->wordWrap )
			   ? $this->wordWrap($body, 80)
			   : $body;
	}
	
	protected function _buildContent()
	{
		if( $this->wordWrap === true && $this->contentType !== 'html')
		{
			$this->body = $this->wordWrap($this->body);
		}
		
		$this->_setLimit();
		
		$this->_writeHeaders();
		
		$hdr = ($this->_getProtocolType() === 'mail') ? $this->eol : '';
		
		$body = '';
		
		switch( $this->_getContentType() )
		{
			case 'plain' :
				$hdr .= 'Content-Type: text/plain; charset='.$this->charset.$this->eol.
					    'Content-Transfer-Encoding: '.$this->_getEncode();
						
				if( $this->_getProtocolType() === 'mail' )
				{
					$this->headerString .= $hdr;
					$this->lastBody = $this->body;
				}
				else
				{
					$this->lastBody = $hdr.$this->eol.$this->eol.$this->body;
				}
				
				return;
				
			case 'html' :
				if( $this->sendMultiPart === FALSE )
				{
					$hdr .= 'Content-Type: text/html; charset='.$this->charset.$this->eol.
						    'Content-Transfer-Encoding: quoted-printable';
				}
				else
				{
					$hdr  .= 'Content-Type: multipart/alternative; boundary="'.$this->altLimit.'"';
					$body .= $this->_getMimeMessage().$this->eol.$this->eol.
						     '--'.$this->altLimit.$this->eol.
						     'Content-Type: text/plain; charset='.$this->charset.$this->eol.
						     'Content-Transfer-Encoding: '.$this->_getEncode().$this->eol.$this->eol.
						     $this->_getAltContent().$this->eol.$this->eol.'--'.$this->altLimit.$this->eol.
						     'Content-Type: text/html; charset='.$this->charset.$this->eol.
						     'Content-Transfer-Encoding: quoted-printable'.$this->eol.$this->eol;
				}
				
				$this->lastBody = $body.$this->_prepQuotedPrintable($this->body).$this->eol.$this->eol;
				
				if( $this->_getProtocolType() === 'mail' )
				{
					$this->headerString .= $hdr;
				}
				else
				{
					$this->lastBody = $hdr.$this->eol.$this->eol.$this->lastBody;
				}
				
				if( $this->sendMultiPart !== false )
				{
					$this->lastBody .= '--'.$this->altLimit.'--';
				}
				return;
				
			case 'plain-attach' :
				$hdr .= 'Content-Type: multipart/'.$this->multipart.'; boundary="'.$this->attachLimit.'"';
				
				if( $this->_getProtocolType() === 'mail' )
				{
					$this->headerString .= $hdr;
				}
				
				$body .= $this->_getMimeMessage().$this->eol.
					     $this->eol.
					     '--'.$this->attachLimit.$this->eol.
					     'Content-Type: text/plain; charset='.$this->charset.$this->eol.
					     'Content-Transfer-Encoding: '.$this->_getEncode().$this->eol.
					     $this->eol.
					     $this->body.$this->eol.$this->eol;
			break;
			
			case 'html-attach' :
				$hdr .= 'Content-Type: multipart/'.$this->multipart.'; boundary="'.$this->attachLimit.'"';
				
				if( $this->_getProtocolType() === 'mail' )
				{
					$this->headerString .= $hdr;
				}
				
				$body .= $this->_getMimeMessage().$this->eol.$this->eol.
					     '--'.$this->attachLimit.$this->eol.
					     'Content-Type: multipart/alternative; boundary="'.$this->altLimit.'"'.$this->eol.$this->eol.
					     '--'.$this->altLimit.$this->eol.
					     'Content-Type: text/plain; charset='.$this->charset.$this->eol.
					     'Content-Transfer-Encoding: '.$this->_getEncode().$this->eol.$this->eol.
					     $this->_getAltContent().$this->eol.$this->eol.'--'.$this->altLimit.$this->eol.
					     'Content-Type: text/html; charset='.$this->charset.$this->eol.
					     'Content-Transfer-Encoding: quoted-printable'.$this->eol.$this->eol.
					     $this->_prepQuotedPrintable($this->body).$this->eol.$this->eol.
					     '--'.$this->altLimit.'--'.$this->eol.$this->eol;
			break;
		}
		
		$attachment = array();
		
		for( $i = 0, $c = count($this->attachments), $z = 0; $i < $c; $i++ )
		{
			$filename = $this->attachments[$i]['name'][0];
			$basename = ( $this->attachments[$i]['name'][1] === NULL )
				        ? basename($filename) 
						: $this->attachments[$i]['name'][1];
						
			$attachment[$z++] = '--'.$this->attachLimit.$this->eol.
				                'Content-type: '.$this->attachments[$i]['type'].'; '.
				                'name="'.$basename.'"'.$this->eol.
				                'Content-Disposition: '.$this->attachments[$i]['disposition'].';'.$this->eol.
				                'Content-Transfer-Encoding: base64'.$this->eol.
				                ( empty($this->attachments[$i]['cid'] ) 
								? '' 
								: 'Content-ID: <'.$this->attachments[$i]['cid'].'>'.$this->eol);
								
			$attachment[$z++] = $this->attachments[$i]['content'];
		}
		
		$body .= implode($this->eol, $attachment).$this->eol.'--'.$this->attachLimit.'--';
		
		$this->lastBody = ( $this->_getProtocolType() === 'mail' )
			              ? $body
			              : $hdr.$this->eol.$this->eol.$body;
		return true;
	}
	
	protected function _prepQEncoding($str)
	{
		$str = str_replace(array("\r", "\n"), '', $str);
		
		if( $this->charset === 'UTF-8' )
		{
			if( $this->mbEnabled === true )
			{
				return mb_encode_mimeheader($str, $this->charset, 'Q', $this->eol);
			}
			elseif( $this->iconvEnabled === true )
			{
				$output = @iconv_mime_encode('', $str,	
					array
					(
						'scheme' => 'Q',
						'line-length' => 80,
						'input-charset' => $this->charset,
						'output-charset' => $this->charset,
						'line-break-chars' => $this->eol
					)
				);
				
				if( $output !== false )
				{
					return substr($output, 2);
				}
				
				$chars = iconv_strlen($str, 'UTF-8');
			}
		}
		
		isset($chars) || $chars = strlen($str);
		
		$output = '=?'.$this->charset.'?Q?';
		
		for( $i = 0, $length = strlen($output); $i < $chars; $i++ )
		{
			$chr = ( $this->charset === 'UTF-8' && ICONV_ENABLED === true )
				   ? '='.implode('=', str_split(strtoupper(bin2hex(iconv_substr($str, $i, 1, $this->charset))), 2))
				   : '='.strtoupper(bin2hex($str[$i]));
			
			if ($length + ($l = strlen($chr)) > 74)
			{
				$output .= '?='.$this->eol .
					       ' =?'.$this->charset.'?Q?'.$chr;
						   
				$length  = 6 + strlen($this->charset) + $l; 
			}
			else
			{
				$output .= $chr;
				$length += $l;
			}
		}
		
		return $output.'?=';
	}
	
	protected function _buildHeaders()
	{
		$this->setHeader('X-Sender', $this->cleanEmail($this->headers['From']));
		$this->setHeader('X-Mailer', $this->xMailer);
		$this->setHeader('X-Priority', $this->priorityTypes[$this->priority]);
		$this->setHeader('Message-ID', $this->_getMessageId());
		$this->setHeader('Mime-Version', '1.0');
	}
	
	protected function _writeHeaders()
	{
		if( $this->protocolType === 'mail' )
		{
			if( isset($this->headers['Subject']) )
			{
				$this->subject = $this->headers['Subject'];
				
				unset($this->headers['Subject']);
			}
		}
		
		reset($this->headers);
		
		$this->headerString = '';
		
		foreach( $this->headers as $key => $val )
		{
			$val = trim($val);
			if( $val !== '' )
			{
				$this->headerString .= $key.': '.$val.$this->eol;
			}
		}
		if( $this->_getProtocolType() === 'mail' )
		{
			$this->headerString = rtrim($this->headerString);
		}
	}
	
	protected function _unwrapSpecials()
	{
		$this->lastBody = preg_replace_callback('/\{unwrap\}(.*?)\{\/unwrap\}/si', array($this, '_removeNlCallback'), $this->lastBody);
	}
	
	protected function _removeNlCallback($matches)
	{
		if( strpos($matches[1], "\r") !== false || strpos($matches[1], "\n") !== false )
		{
			$matches[1] = str_replace(array("\r\n", "\r", "\n"), '', $matches[1]);
		}
		
		return $matches[1];
	}
	
	protected function _prepQuotedPrintable($str)
	{
		$str = str_replace(array('{unwrap}', '{/unwrap}'), '', $str);
	
		if( $this->eol === "\r\n" )
		{
			if( isPhpVersion('5.3') )
			{
				return quoted_printable_encode($str);
			}
			elseif( function_exists('imap_8bit') )
			{
				return imap_8bit($str);
			}
		}
		
		$str = preg_replace(array('| +|', '/\x00+/'), array(' ', ''), $str);
		
		if( strpos($str, "\r") !== false )
		{
			$str = str_replace(array("\r\n", "\r"), "\n", $str);
		}
		
		$escape = '=';
		$output = '';
		
		foreach( explode("\n", $str) as $line )
		{
			$length = strlen($line);
			$temp   = '';
			
			for( $i = 0; $i < $length; $i++ )
			{
				$char = $line[$i];
				$ascii = ord($char);
				
				if( $i === ($length - 1) && ($ascii === 32 || $ascii === 9) )
				{
					$char = $escape.sprintf('%02s', dechex($ascii));
				}
				elseif( $ascii === 61 ) 
				{
					$char = $escape.strtoupper(sprintf('%02s', dechex($ascii)));
				}
				
				if( (strlen($temp) + strlen($char)) >= 80 )
				{
					$output .= $temp.$escape.$this->eol;
					$temp    = '';
				}
				
				$temp .= $char;
			}
			
			$output .= $temp.$this->eol;
		}
		
		return substr($output, 0, strlen($this->eol) * -1);
	}
	
	protected function _spoolEmail()
	{
		$this->_unwrapSpecials();
		
		$method = '_sendWith'.$this->_getProtocolType();
		
		if ( ! $this->$method())
		{
			$protocolType = $this->_getProtocolType() === 'mail' 
			 			  ? 'phpmail' 
						  : $this->_getProtocolType();
		
			$this->_setErrorMessage('sendFailure'.ucfirst($protocolType));

			return false;
		}
		
		$this->_setErrorMessage('sent', $this->_getProtocolType());
		
		return true;
	}
	
	protected function _sendWithMail()
	{
		if (is_array($this->receivers))
		{
			$this->receivers = implode(', ', $this->receivers);
		}
		
		if( $this->safeMode === true )
		{
			if( function_exists('mail') )
			{
				return mail($this->receivers, $this->subject, $this->lastBody, $this->headerString);
			}
			else
			{
				return mb_send_mail($this->receivers, $this->subject, $this->lastBody, $this->headerString);
			}
		}
		else
		{
			if( function_exists('mail') )
			{
				return mail($this->receivers, $this->subject, $this->lastBody, $this->headerString, '-f '.$this->cleanEmail($this->headers['Return-Path']));
			}
			else
			{
				return mb_send_mail($this->receivers, $this->subject, $this->lastBody, $this->headerString, '-f '.$this->cleanEmail($this->headers['Return-Path']));
			}
		}
	}
	
	protected function _sendWithSendMail()
	{
		if( false === 
			(
				$fp = @popen
				(
					$this->mailPath.' -oi -f '.$this->cleanEmail($this->headers['From'])
					.' -t -r '.$this->cleanEmail($this->headers['Return-Path'])
					, 'w'
				)
			)
		)
		{
			return false;
		}
		
		@fputs($fp, $this->headerString);
		@fputs($fp, $this->lastBody);
		$status = @pclose($fp);
		
		if( $status !== 0 )
		{
			$this->_setErrorMessage('exitStatus', $status);
			$this->_setErrorMessage('noSocket');
			return false;
		}
		
		return true;
	}
	
	
	
	protected function _smtpConnect()
	{
		if( is_resource($this->smtpConnect) )
		{
			return true;
		}
		$ssl = ($this->smtpEncode === 'ssl') ? 'ssl://' : '';
		$this->smtpConnect = fsockopen
							 (
								 $ssl.$this->smtpHost,
								 $this->smtpPort,
								 $errno,
								 $errstr,
								 $this->smtpTimeout
						     );
							 
		if( ! is_resource($this->smtpConnect) )
		{
			$this->_setErrorMessage('smtpError', $errno.' '.$errstr);
			
			return false;
		}
		
		stream_set_timeout($this->smtpConnect, $this->smtpTimeout);
		
		$this->_setErrorMessage($this->_getSmtpData());
		
		if( $this->smtpEncode === 'tls' )
		{
			$this->_sendCommand('hello');
			$this->_sendCommand('starttls');
			
			$crypto = stream_socket_enable_crypto($this->smtpConnect, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
			
			if( $crypto !== true )
			{
				$this->_setErrorMessage('smtpError', $this->_getSmtpData());
				return false;
			}
		}
		
		return $this->_sendCommand('hello');
	}
	
	protected function _sendCommand($cmd, $data = '')
	{
		switch( $cmd )
		{
			case 'hello' :
						if( $this->smtpAuth || $this->_getEncode() === '8bit' )
						{
							$this->_sendData('HELO '.$this->_getHostName() );
						}
						else
						{
							$this->_sendData('HELO '.$this->_getHostName());
						}
						$resp = 250;
			break;
			case 'starttls'	:
						$this->_sendData('STARTTLS');
						$resp = 220;
			break;
			case 'from' :
						$this->_sendData('MAIL FROM:<'.$data.'>');
						$resp = 250;
			break;
			case 'to' :
						if( $this->dsn )
						{
							$this->_sendData('RCPT TO:<'.$data.'> NOTIFY=SUCCESS,DELAY,FAILURE ORCPT=rfc822;'.$data);
						}
						else
						{
							$this->_sendData('RCPT TO:<'.$data.'>');
						}
						$resp = 250;
			break;
			case 'data'	:
						$this->_sendData('DATA');
						$resp = 354;
			break;
			case 'reset':
						$this->_sendData('RSET');
						$resp = 250;
			break;
			case 'quit'	:
						$this->_sendData('QUIT');
						$resp = 221;
			break;
		}
		
		$reply 				  = $this->_getSmtpData();
		$this->debugMessage[] = '<pre>'.$cmd.': '.$reply.'</pre>';
		
		if( (int)substr($reply, 0, 3) !== $resp )
		{
			$this->_setErrorMessage('smtpError', $reply);
			
			return false;
		}
		
		if( $cmd === 'quit' )
		{
			fclose($this->smtpConnect);
		}
		
		return true;
	}
	
	protected function _sendWithSmtp()
	{
		if( $this->smtpHost === '' )
		{
			$this->_setErrorMessage('noHostName');
			
			return false;
		}
		if( ! $this->_smtpConnect() || ! $this->_smtpAuthenticate())
		{
			return false;
		}
		
		$this->_sendCommand('from', $this->cleanEmail($this->headers['From']));
		
		foreach ($this->receivers as $val)
		{
			$this->_sendCommand('to', $val);
		}
		if (count($this->ccReceivers) > 0)
		{
			foreach( $this->ccReceivers as $val )
			{
				if( $val !== '' )
				{
					$this->_sendCommand('to', $val);
				}
			}
		}
		if( count($this->bccReceivers) > 0 )
		{
			foreach( $this->bccReceivers as $val )
			{
				if( $val !== '' )
				{
					$this->_sendCommand('to', $val);
				}
			}
		}
		$this->_sendCommand('data');
		
		$this->_sendData($this->headerString.preg_replace('/^\./m', '..$1', $this->lastBody));
		$this->_sendData('.');
		$reply = $this->_getSmtpData();
		$this->_setErrorMessage($reply);
		
		if( strpos($reply, '250') !== 0 )
		{
			$this->_setErrorMessage('smtpError', $reply);
			
			return false;
		}
		if ($this->smtpKeepAlive)
		{
			$this->_sendCommand('reset');
		}
		else
		{
			$this->_sendCommand('quit');
		}
		
		return true;
	}
	
	protected function _smtpAuthenticate()
	{
		if( ! $this->smtpAuth )
		{
			return true;
		}
		
		if( $this->smtpUser === '' && $this->smtpPassword === '' )
		{
			$this->_setErrorMessage('noSmtpUnpassword');
			
			return false;
		}
		
		$this->_sendData('AUTH LOGIN');
		$reply = $this->_getSmtpData();
		
		if( strpos($reply, '503') === 0 )
		{
			return true;
		}
		elseif( strpos($reply, '334') !== 0 )
		{
			$this->_setErrorMessage('failedSmtpLogin', $reply);
			
			return false;
		}
		
		$this->_sendData(base64_encode($this->smtpUser));	
		$reply = $this->_getSmtpData();
		
		if( strpos($reply, '334') !== 0 )
		{
			$this->_setErrorMessage('smtpAuthUserName', $reply);
			
			return false;
		}
		
		$this->_sendData(base64_encode($this->smtpPassword));
		$reply = $this->_getSmtpData();
		
		if( strpos($reply, '235') !== 0 )
		{
			$this->_setErrorMessage('smtpAuthPassword', $reply);
			return false;
		}
		
		return true;
	}
	
	protected function _sendData($data)
	{
		$data .= $this->eol;
		
		for( $written = 0, $length = strlen($data); $written < $length; $written += $result )
		{
			if( ($result = fwrite($this->smtpConnect, substr($data, $written))) === false )
			{
				break;
			}
		}
		if( $result === false )
		{
			$this->_setErrorMessage('smtpDataFailure', $data);
			
			return false;
		}
		return true;
	}
	
	protected function _getSmtpData()
	{
		$data = '';
		
		while( $str = fgets($this->smtpConnect, 512) )
		{
			$data .= $str;
			
			if( $str[3] === ' ' )
			{
				break;
			}
		}
		
		return $data;
	}
	
	protected function _getHostName()
	{
		if( isset($_SERVER['SERVER_NAME']) )
		{
			return $_SERVER['SERVER_NAME'];
		}
		
		return isset($_SERVER['SERVER_ADDR']) 
			   ? '['.$_SERVER['SERVER_ADDR'].']' 
			   : '[127.0.0.1]';
	}
	
	protected function _setErrorMessage($msg, $val = '')
	{
		$this->debugMessage[] = getMessage('Email', $msg, $val).'<br />';
	}
	
	public function __destruct()
	{
		if( is_resource($this->smtpConnect) )
		{
			$this->_sendCommand('quit');
		}
	}
}