<?php
namespace ZN\FileSystem;

class InternalUpload implements UploadInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------

	/* Settings Değişkeni
	 *  
	 * Yükleme ayar bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private $settings = [];
	
	/* File Değişkeni
	 *  
	 * Yüklenecek dosyanın yol bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $file;
	
	/* Extension Control Değişkeni
	 *  
	 * Yüklenecek dosyanın uzantı bilgisini
	 * kontrol etmesi için oluşturulmuştur.
	 *
	 */
	protected $extensionControl;
	
	/* Setting Status Değişkeni
	 *  
	 * Ayarların yapılma durumunu 
	 * kontrol etmesi için oluşturulmuştur.
	 *
	 */
	protected $settingStatus = false;
	
	/* Errors Değişkeni
	 *  
	 * Yükleme işlemlerinde oluşan hata bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $errors;
	
	/* Manuel Error Değişkeni
	 *  
	 * Elle oluşturulan hata bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $manuelError;
	
	/* Encode Name Değişkeni
	 *  
	 * Şifrelenmiş dosya isim bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $encodeName;
	
	/* Path Değişkeni
	 *  
	 * Dosya Yol bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $path;
	
	public function __construct()
	{
		\Config::iniSet(\Config::get('Htaccess', 'upload')['settings']);	
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
	// Setting Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* SETTINGS                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Dosya yükleme ayarlarını yapılandırmak için kullanılır.				  |
	|															                              |
	| Parametreler: Tek dizi parametresi vardır.                                              |
	| 1. array var @settings => Yükleme ayarlarını yapmak için kullanılır.			          |
	|          																				  |
	| Örnek Kullanım: settings(array('encode' => true, prefix => '_deneme_'));       		  |
	|          																				  |
	| Ayarlar Dizisinin Alabileceği Değerler         										  |
	|          																				  |
	| 1-extension => Uzantılar ayarlanır.    												  |
	| // Kullanmak için: jpg|png|jpeg tipinde belirtilir.                                     |
	| 2-encode    => true olması durumunda yüklenecek dosyanın ismi şifrelenir.          	  |
	| // Kullanmak için: true veya false tipinde belirtilir.								  |
	| 3-prefix    => Belirtilen veriye göre yüklenecek dosyanın ismine bu veriyi ilave eder.  |
	| // Kullanmak için: Metinsel türde ek belirtilir. Örnek: onek_							  |
	| 4-maxsize   => Belirtilen miktara göre yüklenecek dosyanın maksimum boyutu belirtilir.  |
	| // Kullanmak için: Sayısal türde miktar belirtilir. Örnek: 10 * 1024 => 10 KB			  |
	|          																				  |
	******************************************************************************************/
	public function settings($set = [])
	{
		if( ! is_array($set) ) 
		{
			return \Errors::set('Error', 'arrayParameter', 'set');
		}

		$this->settingStatus = true;
		
		// 1-extensions -> Dosyanın uzantısı
		if( isset($set['extensions']) ) 	
		{
			$this->settings['extensions'] 	= $set['extensions'];
		}
		
		// 2-encode -> Dosyanın şifrelenmesi
		if( isset($set['encode']) ) 		
		{
			$this->settings['encryption'] 	= $set['encode'];
		}
		else
		{
			$this->settings['encryption']   = 'md5';	
		}
		
		// 3-prefix -> Yüklenen dosyaların önüne ön ek koymak
		if( isset($set['prefix']) ) 		
		{
			$this->settings['prefix'] 		= $set['prefix'];
		}
		
		// 4-mazsize -> Yükselenecebilecek maksimum dosya boyutu
		if( isset($set['maxsize']) ) 		
		{
			$this->settings['maxsize'] 		= $set['maxsize'];
		}
		
		// 5-encodeLength -> Şifrenin karakter uzunluğu
		if( isset($set['encodeLength']) ) 		
		{
			$this->settings['encodeLength'] = $set['encodeLength'];
		}
		else
		{
			$this->settings['encodeLength'] = 8;		
		}
		
		// 4-mazsize -> Yükselenecebilecek maksimum dosya boyutu
		if( isset($set['convertName']) ) 		
		{
			$this->settings['convertName']  = $set['convertName'];
		}
		else
		{
			$this->settings['convertName']  = true;
		}
		
		return $this;
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
	public function extensions(...$args)
	{
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
			\Errors::set('Error', 'booleanParameter', 'convert');	
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
			\Errors::set('Error', 'valueParameter', 'prefix');		
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
			\Errors::set('Error', 'numericParameter', 'maxsize');		
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
			\Errors::set('Error', 'numericParameter', 'encodeLength');		
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
			\Errors::set('Error', 'stringParameter', 'target');		
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
			\Errors::set('Error', 'stringParameter', 'source');	
		}
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Setting Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	protected function _encode()
	{
		return substr(\Encode::type(uniqid(rand()), $this->settings['encryption']), 0, $this->settings['encodeLength']).'-';	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Start Method Başlangıç
	//----------------------------------------------------------------------------------------------------

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
		
		if( ! is_string($fileName) ) 
		{
			return \Errors::set('Error', 'stringParameter', 'fileName');
		}
		
		if( ! is_string($rootDir) ) 
		{
			$rootDir = UPLOADS_DIR;
		}
		
		// Dosyanın yükleneceği dizin yoksa oluşturulur.
		if( ! is_dir($rootDir) )
		{
			\Folder::create($rootDir);	
		}
		
		// Dosya yükleme ayarları yapılmamışsa
		// Varsayılan ayarları kullanması için.
		if( $this->settingStatus === false ) 
		{
			$this->settings();
		}
		
		$this->file = $fileName;

		$root = suffix($rootDir, '/');
		
		if( ! isset($_FILES[$fileName]['name']) ) 
		{ 
			$this->manuelError = 4; 
			return false; 
		}
		
		$name = $_FILES[$fileName]['name'];		
		
		$encryption = '';
		
		if( isset($this->settings['prefix']) ) 
		{
			$encryption = $this->settings['prefix']; 
		}
		
		if( isset($this->settings['extensions']) ) 
		{
			$extensions = explode("|", $this->settings['extensions']);
		}
		
		$source = $_FILES[$fileName]['tmp_name'];
		
		// Çoklu yükleme yapılıyorsa.
		if( is_array($name) )
		{
			if( empty($name[0]) ) 
			{
				$this->manuelError = 4; 
				return false; 
			}
			
			for( $index = 0; $index < count($name); $index++ )
			{	
				$src = $source[$index];
				
				$nm = $name[$index];
				
				if( $this->settings['convertName'] === true )
				{
					 $nm = \Convert::urlWord($nm);	
				}
				
				if( $this->settings['encryption'] ) 
				{
					$encryption = $this->_encode();
				}
				else
				{
					if( is_file($root.$nm) )
					{
						$encryption = $this->_encode();
					}	
				}
				
				$target = $root.$encryption.$nm;
				
				$this->encodeName[] = $encryption.$nm;
				$this->path[] = $target;
				
				if( isset($this->settings['extensions']) && ! in_array(extension($nm), $extensions) )
				{
					$this->extensionControl = lang('Upload', 'extensionError');	
				}
				elseif( isset($this->settings['maxsize']) && $this->settings['maxsize'] < filesize($src) )
				{
					$this->manuelError = 10;
				}
				else
				{
					if( ! is_file($rootDir) ) 
					{
						move_uploaded_file($src, $target); 
					}
					else 
					{
						$this->manuelError = 9;
					}
				}
			}
		}	
		else
		{	
			if( $this->settings['convertName'] === true )
			{
				 $name = \Convert::urlWord($name);	
			}
			
			if( empty($_FILES[$fileName]['name']) ) 
			{ 
				$this->manuelError = 4; 
				return false;
			}
			
			if( isset($this->settings['maxsize']) && $this->settings['maxsize'] < filesize($source) )
			{
				$this->manuelError = 10; 
				return false;
			}
			
			if( $this->settings['encryption'] ) 
			{
				$encryption = $this->_encode();
			}
			else
			{
				if( is_file($root.$name) )
				{
					$encryption = $this->_encode();
				}	
			}
		
			$target = $root.$encryption.$name;
			
			$this->encodeName = $encryption.$name;
			
			$this->path = $target;
			
			if( isset($this->settings['extensions']) && ! in_array(extension($name),$extensions) )
			{
				$this->extensionControl = lang('Upload', 'extensionError');	
			}
			else
			{	
				if( ! is_file($rootDir) ) 
				{
					move_uploaded_file($source, $target); 
				}
				else 
				{
					$this->manuelError = 9;
				}				
			}
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Start Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Info Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

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
	| $info->tmpName -> dosyanın tmp dizinindeki ismi.        								  |
	| $info->encodeName -> şifrelenen ismi.      											  |
	|          																				  |
	******************************************************************************************/
	public function info($info = '')
	{
		if( ! empty($_FILES[$this->file]) )
		{
			$datas = array
			(
				'name' 		 => $_FILES[$this->file]['name'],
				'type' 		 => $_FILES[$this->file]['type'],
				'size' 		 => $_FILES[$this->file]['size'],
				'tmpName' 	 => $_FILES[$this->file]['tmp_name'],
				'error' 	 => $_FILES[$this->file]['error'],
				'path'		 => $this->path,
				'encodeName' => $this->encodeName
			);
		
			$values = [];
			
			if( ! is_array($_FILES[$this->file]['name']) ) foreach( $datas as $key => $val )
			{
				$values[$key] = $val;
			}
			else
			{
				foreach( $datas as $key => $val )
				{
					if( ! empty($datas[$key]) )
					{
						foreach( $datas[$key] as $v )
						{
							$values[$key][] = $v;
						}
					}
				}
			}	
		}
		else
		{
			return false;	
		}
		
		if( ! empty($values[$info]) )
		{
			return $values[$info];	
		}
		
		return (object)$values;	
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
		if( ! isset($_FILES[$this->file]['error']) ) 
		{
			return lang('Upload', 'unknownError');
		}
		
		$errorNo = $_FILES[$this->file]['error'];	
		
		if( is_array($errorNo) )
		{
			$errno = 0;
			
			foreach( $errorNo as $no )
			{
				if( ! empty($no) )
				{
					$errno = $no;
					break;
				}	
			}
			
			$errorNo = $errno;
		}
		
		$this->errors = array
		(
			'0'  => "scc", 			  // Dosya başarı ile yüklendi. 
			'1'  => lang('Upload', '1'), // Php.ini dosyasındaki maximum dosya boyutu aşıldı. 
			'2'  => lang('Upload', '2'), // Formtaki max_file_size direktifindeki dosya boyutu limiti aşıldı. 
			'3'  => lang('Upload', '3'), // Dosya yükleme işlemi tamamlanmadı. 
			'4'  => lang('Upload', '4'), // Yüklenecek dosya yok. 
			'6'  => lang('Upload', '6'), // Dosyaların geçici olarak yükleneceği dizin bulunamadı. 
			'7'  => lang('Upload', '7'), // Dosya dik üzerine yazılamadı. 
			'8'  => lang('Upload', '8'), // Dosya yükleme uzantı desteği yok. 
			'9'  => lang('Upload', '9'), // Dosya yükleme yolu geçerli değil.
			'10' => lang('Upload', '10') // Belirlenen maksimum dosya boyutu aşıldı!
		);
		// Manuel belirlenen hata oluşmuşsa
		if( ! empty($this->manuelError) )
		{
			return $this->errors[$this->manuelError];
		}
		// Uzantıdan kaynaklı hata oluşmussa
		elseif( ! empty($this->extensionControl) ) 
		{
			return $this->extensionControl;
		}
		// Hata numarasına göre hata bildir.
		elseif( ! empty($this->errors[$errorNo]) ) 
		{
			if( $this->errors[$errorNo] === "scc" ) 
			{
				return false;
			}
			// 0 Dışında herhangi bir hata numarası oluşmussa
			return $this->errors[$errorNo];
		}
		// Bu kontroller dışında hata oluşmussa bilinmeyen
		// hata uyarısı ver.	
		else 
		{
			return lang('Upload', 'unknownError');
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Info Methods Bitiş
	//----------------------------------------------------------------------------------------------------
}