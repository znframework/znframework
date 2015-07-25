<?php
class __USE_STATIC_ACCESS__CUpload
{
	/***********************************************************************************/
	/* UPLOAD COMPONENT	     	     		                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: CUpload
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: $this->cupload, zn::$use->cupload, uselib('cupload')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* Settings Değişkeni
	 *  
	 * Yükleme ayar bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private $settings = array();
	
	public function __construct()
	{
		Config::iniSet(Config::get('Upload','settings'));	
	}

	/******************************************************************************************
	* EXTENSIONS                                                                      		  *
	*******************************************************************************************
	| Genel Kullanım: Yüklenecek dosya uzantılarını ayarlamak için kullanılır.  			  |
	|															                              |
	| Parametreler: Argüment parametresi vardır.                                              |
	| 1. argumentts var @extensions => Belirtilecek uzantılar.  			  			      |
	|          																				  |
	| Örnek Kullanım: ->extension('exe', 'jpg', 'gif')            							  |
	|          																				  |
	******************************************************************************************/
	public function extensions()
	{
		$args = func_get_args();
		
		if( ! empty($args ) )
		{
			$this->settings['extensions'] = implode('|', $args);
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* CONVERT NAME                                                                    		  *
	*******************************************************************************************
	| Genel Kullanım: Dosya isminde yer alan yabancı karaketerleri çevirsin mi?.  			  |
	|															                              |
	| Parametreler: Mantıksal parametresi vardır.                                             |
	| 1. boolean var @convert => Dçnüştürmenin uygulanıp uygulanmayacağı.   			      |
	|          																				  |
	| Örnek Kullanım: ->extension('exe', 'jpg', 'gif')            							  |
	|          																				  |
	******************************************************************************************/
	public function convertName($convert = true)
	{	
		if( is_bool($convert) )
		{
			$this->settings['convertName'] = $convert;
		}
		else
		{
			Error::set(lang('Error', 'booleanParameter', 'convert'));	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* ENCODE                                                                           		  *
	*******************************************************************************************
	| Genel Kullanım: Dosya ismi şifrelenmesi için kullanılır.	      						  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @hash => Şifreleme algoritmalarından biri. Varsayılan:md5    		  	  |
	|          																				  |
	| Örnek Kullanım: ->encode(UPLOADS_DIR.'ornek.jpg')            							  |
	|          																				  |
	******************************************************************************************/
	public function encode($hash = 'md5')
	{
		if( isHash($hash) )
		{
			$this->settings['encryption'] = $hash;	
		}
		else
		{
			$this->settings['encryption'] = 'md5';
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* PREFIX                                                                           		  *
	*******************************************************************************************
	| Genel Kullanım: Dosya isminin başına ön ek getirilmesi için kullanılır.   			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @prefix => Ön ek.									         		  	  |
	|          																				  |
	| Örnek Kullanım: ->prefix('onek_')				            							  |
	|          																				  |
	******************************************************************************************/
	public function prefix($prefix = '')
	{
		if( isChar($prefix) )
		{
			$this->settings['prefix'] = $prefix;	
		}
		else
		{
			Error::set(lang('Error', 'valueParameter', 'prefix'));		
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* MAXSIZE                                                                         		  *
	*******************************************************************************************
	| Genel Kullanım: Dosyanın yüklenebilir maksimum boyutunu ayarlamak için kullanılır.      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @maxsize => Byte cinsinden boyut değeri.			         		  	  |
	|          																				  |
	| Örnek Kullanım: ->maxsize(2048) // 2048 Bytes	            						      |    
	|          																				  |
	******************************************************************************************/
	public function maxsize($maxsize = 0)
	{
		if( is_numeric($maxsize) )
		{
			$this->settings['maxsize'] = $maxsize;	
		}
		else
		{
			Error::set(lang('Error', 'numericParameter', 'maxsize'));		
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* ENCODE LENGTH                                                               		  *
	*******************************************************************************************
	| Genel Kullanım: Şifrelenmiş ön ekin karakter uzunluğunu ayarlamak için kullanılır.      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @encodeLength => Karakter uzunluğu.			         		  	  |
	|          																				  |
	| Örnek Kullanım: ->encodeLength(20)	            						      |    
	|          																				  |
	******************************************************************************************/
	public function encodeLength($encodeLength = 8)
	{
		if( is_numeric($encodeLength) )
		{
			$this->settings['encodeLength'] = $encodeLength;	
		}
		else
		{
			Error::set(lang('Error', 'numericParameter', 'encodeLength'));		
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* TARGET                                                                         		  *
	*******************************************************************************************
	| Genel Kullanım: Dosyanın nereye yükleneceğini belirtmek için kullanılır.		          |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @target => Dosyaların yükleneceği dizin. Varsayılan:UPLOADS_DIR	  	      |
	|          																				  |
	| Örnek Kullanım: ->target('Uploads/') // 2048 Bytes	            					  |    
	|          																				  |
	******************************************************************************************/
	public function target($target = UPLOADS_DIR)
	{
		if( is_string($target) )
		{
			$this->settings['target'] = $target;	
		}
		else
		{
			Error::set(lang('Error', 'stringParameter', 'target'));		
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* SOURCE                                                                         		  *
	*******************************************************************************************
	| Genel Kullanım: Dosyaların yükleneceği input file nesnesinin ismi.      				  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @target => Dosyaların alınacağı input file nesnesinin ismi.			      |
	|          																				  |
	| Örnek Kullanım: ->source('FILEUPLOAD') // <input type="file" name="FILEUPLOAD">	      |    
	|          																				  |
	******************************************************************************************/
	public function source($source = 'upload')
	{
		if( is_string($source) )
		{
			$this->settings['source'] = $source;	
		}
		else
		{
			Error::set(lang('Error', 'stringParameter', 'source'));	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* START                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Dosya yükleme işlemini başlatmak için kullanılır.				          |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @filename => Yükleme yapılacak <input="file"> nesnesinin name değeri.	  |
	| 2. [ string var @rootdir ] => Dosyanın kaydedileceği dizin. Varsayılan:Uploads/	      |
	|          																				  |
	| Örnek Kullanım: start('fileupload', 'Aplication/Uploads');       		                  |
	|          																				  |
	******************************************************************************************/
	public  function start($fileName = 'upload', $rootDir = UPLOADS_DIR)
	{	
		if( isset($this->settings['source']) )
		{
			$fileName = $this->settings['source'];
		}

		if( isset($this->settings['target']) )
		{
			$rootDir = $this->settings['target'];
		}
	
		output($this->settings);
		
		Upload::settings($this->settings);
	
		return Upload::start($fileName, $rootDir);
	}
	
	/******************************************************************************************
	* INFO                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Dosya yükleme işlemleri hakkında bilgi almak için kullanılır.			  |
	| Object veri türünde çıktı üretir.												          |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: $info = info();       		                  						  |
	| $info->name -> dosyanın adı      														  |  
	| $info->type -> dosyanın tipi        													  |
	| $info->size -> dosyanın boyutu      													  |
	| $info->error -> dosya yükleme sırasında hata var ise 1 değeri alır.        			  |
	| $info->tmp_name -> dosyanın tmp dizinindeki ismi.        								  |
	| $info->encode_name -> şifrelenen ismi.      											  |
	|          																				  |
	******************************************************************************************/
	public function info($info = '')
	{
		return Upload::info($info);
	}
	
	/******************************************************************************************
	* ERROR                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Dosya işlemlerinde oluşan hata bilgilerini tutması için oluşturulmuştur.|
	|     														                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|     														                              |
	******************************************************************************************/
	public function error()
	{
		$error = Upload::error();
		Error::set($error);
		return $error;
	}
}