<?php
/************************************************************/
/*                       CLASS UPLOAD                       */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* Config/Upload.php dosyasından Ini ayarlarını yapılandır.                                *
******************************************************************************************/
Config::iniSet(Config::get('Upload','settings'));
/******************************************************************************************
* UPLOAD                                                                            	  *
*******************************************************************************************
| Sınıfı Kullanırken      :	upload:: , $this->upload , zn::$use->upload , uselib('upload')|
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/
class Upload
{
	/* Settings Değişkeni
	 *  
	 * Yükleme ayar bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $settings = array();
	
	/* File Değişkeni
	 *  
	 * Yüklenecek dosyanın yol bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $file;
	
	/* Extension Control Değişkeni
	 *  
	 * Yüklenecek dosyanın uzantı bilgisini
	 * kontrol etmesi için oluşturulmuştur.
	 *
	 */
	private static $extensionControl;
	
	/* Setting Status Değişkeni
	 *  
	 * Ayarların yapılma durumunu 
	 * kontrol etmesi için oluşturulmuştur.
	 *
	 */
	private static $settingStatus = false;
	
	/* Errors Değişkeni
	 *  
	 * Yükleme işlemlerinde oluşan hata bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $errors;
	
	/* Manuel Error Değişkeni
	 *  
	 * Elle oluşturulan hata bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $manuelError;
	
	/* Encode Name Değişkeni
	 *  
	 * Şifrelenmiş dosya isim bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $encodeName;
	
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
	public static function settings($set = array())
	{
		if( ! is_array($set) ) 
		{
			$set = array();
		}

		self::$settingStatus = true;
		
		// 1-extensions -> Dosyanın uzantısı
		if( isset($set['extensions']) ) 	
		{
			self::$settings['extensions'] 	= $set['extensions'];
		}
		
		// 2-encode -> Dosyanın şifrelenmesi
		if( isset($set['encode']) ) 		
		{
			self::$settings['encryption'] 	= $set['encode'];
		}
		else
		{
			self::$settings['encryption'] = 'md5';	
		}
		
		// 3-prefix -> Yüklenen dosyaların önüne ön ek koymak
		if( isset($set['prefix']) ) 		
		{
			self::$settings['prefix'] 		= $set['prefix'];
		}
		
		// 4-mazsize -> Yükselenecebilecek maksimum dosya boyutu
		if( isset($set['maxsize']) ) 		
		{
			self::$settings['maxsize'] 		= $set['maxsize'];
		}
		
		// 5-encodeLength -> Şifrenin karakter uzunluğu
		if( isset($set['encodeLength']) ) 		
		{
			self::$settings['encodeLength'] 	= $set['encodeLength'];
		}
		else
		{
			self::$settings['encodeLength'] = 8;		
		}
		
		// 4-mazsize -> Yükselenecebilecek maksimum dosya boyutu
		if( isset($set['convertName']) ) 		
		{
			self::$settings['convertName'] = $set['convertName'];
		}
		else
		{
			self::$settings['convertName'] = true;
		}
	}
	
	/******************************************************************************************
	* SETTINGS                                                                                *
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
	public static function start($fileName = 'upload', $rootDir = UPLOADS_DIR)
	{	
		if( ! is_string($fileName) ) 
		{
			return false;
		}
		
		if( ! is_string($rootDir) ) 
		{
			$rootDir = UPLOADS_DIR;
		}
		
		// Dosya yükleme ayarları yapılmamışsa
		// Varsayılan ayarları kullanması için.
		if( self::$settingStatus === false ) 
		{
			self::settings();
		}
		
		self::$file = $fileName;

		$root = $rootDir;
		
		if( ! isset($_FILES[$fileName]['name']) ) 
		{ 
			self::$manuelError = 4; 
			return false; 
		}
		
		$name = $_FILES[$fileName]['name'];		
		
		$encryption = '';
		
		if( isset(self::$settings['prefix']) ) 
		{
			$encryption = self::$settings['prefix']; 
		}
		
		if( isset(self::$settings['extensions']) ) 
		{
			$extensions = explode("|", self::$settings['extensions']);
		}
		
		$source = $_FILES[$fileName]['tmp_name'];
		
		// Çoklu yükleme yapılıyorsa.
		if( is_array($name) )
		{
			if( empty($name[0]) ) 
			{
				self::$manuelError = 4; 
				return false; 
			}
			
			for($index = 0; $index < count($name); $index++)
			{	
				$src = $source[$index];
				
				$nm = $name[$index];
				
				if( self::$settings['encryption'] ) 
				{
					if( ! isset(self::$settings['prefix']) )
					{
						$encryption = substr(Encode::type(uniqid(rand()), self::$settings['encryption']), 0, self::$settings['encodeLength']).'-';
					}
				}
				
				if( self::$settings['convertName'] === true )
				{
					 $nm = Convert::urlWord($nm);	
				}
				
				$target = $root.'/'.$encryption.$nm;

				if( isset(self::$settings['extensions']) && ! in_array(extension($nm), $extensions) )
				{
					self::$extensionControl = lang('Upload', 'extensionError');	
				}
				elseif( isset(self::$settings['maxsize']) && self::$settings['maxsize'] < filesize($src) )
				{
					self::$manuelError = 10;
				}
				else
				{
					if( ! is_file($rootDir) ) 
					{
						move_uploaded_file($src, $target); 
					}
					else 
					{
						self::$manuelError = 9;
					}
				}
			}
		}	
		else
		{	
			if( self::$settings['encryption'] ) 
			{
				if( ! isset(self::$settings['prefix']) )
				{
					$encryption = substr(Encode::type(uniqid(rand()), self::$settings['encryption']), 0, self::$settings['encodeLength']).'-';
				}
			}
			
			if( self::$settings['convertName'] === true )
			{
				 $name = Convert::urlWord($name);	
			}
			
			if( empty($_FILES[$fileName]['name']) ) 
			{ 
				self::$manuelError = 4; 
				return false;
			}
			
			if( isset(self::$settings['maxsize']) && self::$settings['maxsize'] < filesize($source) )
			{
				self::$manuelError = 10; 
				return false;
			}

			$target = $root.'/'.$encryption.$name;
			
			self::$encodeName = $encryption.$name;
			
			if( isset(self::$settings['extensions']) && ! in_array(extension($name),$extensions) )
			{
				self::$extensionControl = lang('Upload', 'extensionError');	
			}
			else
			{	
				if( ! is_file($rootDir) ) 
				{
					move_uploaded_file($source, $target); 
				}
				else 
				{
					self::$manuelError = 9;
				}				
			}
		}
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
	| $info->tmpName -> dosyanın tmp dizinindeki ismi.        								  |
	| $info->encodeName -> şifrelenen ismi.      											  |
	|          																				  |
	******************************************************************************************/
	public static function info($info = '')
	{
		if( ! empty($_FILES[self::$file]) )
		{
			$datas = array
			(
				'name' 		 => $_FILES[self::$file]['name'],
				'type' 		 => $_FILES[self::$file]['type'],
				'size' 		 => $_FILES[self::$file]['size'],
				'tmpName' 	 => $_FILES[self::$file]['tmp_name'],
				'error' 	 => $_FILES[self::$file]['error'],
				'encodeName' => self::$encodeName
			);
		
			$values = array();
			
			if( ! is_array($_FILES[self::$file]['name']) )foreach($datas as $key => $val)
			{
				$values[$key] = $val;
			}
			else
			{
				foreach($datas as $key => $val)
				{
					if( ! empty($datas[$key]) )
					{
						foreach($datas[$key] as $v)
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
	public static function error()
	{
		if( ! isset($_FILES[self::$file]['error']) ) 
		{
			return lang('Upload', 'unknownError');
		}
		
		$errorNo = $_FILES[self::$file]['error'];
		//$errorNo = self::$manuelError;
		
		self::$errors = array
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
		if( ! empty(self::$manuelError) )
		{
			return self::$errors[self::$manuelError];
		}
		// Uzantıdan kaynaklı hata oluşmussa
		elseif( ! empty(self::$extensionControl) ) 
		{
			return self::$extensionControl;
		}
		// Hata numarasına göre hata bildir.
		elseif( ! empty(self::$errors[$errorNo]) ) 
		{
			if( self::$errors[$errorNo] === "scc" ) 
			{
				return false;
			}
			// 0 Dışında herhangi bir hata numarası oluşmussa
			return self::$errors[$errorNo];
		}
		// Bu kontroller dışında hata oluşmussa bilinmeyen
		// hata uyarısı ver.	
		else 
		{
			return lang('Upload', 'unknownError');
		}
	}
	
	/******************************************************************************************
	*  SQL FILE UPLOADER                                                           			  *
	*******************************************************************************************
	| Genel Kullanım: Sunucunuzda yer alan sql dosyasını mysql servere yüklemek 			  |
	| için kullanılır.														                  |
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string var @sql_file => Sql dosyasının sunucudaki yolu.			  			      |
	|          																				  |
	| Örnek Kullanım: sqlFile('Database/file.sql');         						  		  |
	|          																				  |
	******************************************************************************************/
	public static function sqlFile($sqlFile = '')
	{
		if( ! is_string($sqlFile) || empty($sqlFile) ) 
		{
			return false;
		}

		$fileContents = File::contents(suffix($sqlFile,".sql"));
		
		$fileContents = preg_replace("/SET (.*?);/", "", $fileContents);
		$fileContents = preg_replace("/\/\*(.*?)\*\//", "", $fileContents);
		$fileContents = preg_replace("/--(.*?)\n/", "", $fileContents);
		$fileContents = preg_replace("/\/\*!40101/", "", $fileContents);
		
		$queries = explode(";\n", $fileContents);
		
		$db = uselib('DB');
		
		foreach($queries as $query)
		{
			if( $query !== '' )
			{
				$db->execQuery(trim($query));
			}
		}
    }
}