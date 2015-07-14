<?php
/************************************************************/
/*                   CLASS  AUTOLOADER                      */
/************************************************************/
/*
/* Yazar: Ozan UYKUN
/* Site: www.zntr.net
/* Lisans: The MIT License
/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
*/
/******************************************************************************************
* AUTOLOADER                                                                           	  *
*******************************************************************************************
| Dahil(Import) Edilirken : Dahil Etmeye Gerek Yoktur.   							      |
| Sınıfı Kullanırken      :	Sistem Tarafından Kullanılılır.		 			     		  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/	
class Autoloader
{	
	/* Classes Değişkeni
	 *
	 *
	 * ClassMap bilgisini tutması
	 * için oluşturulmuştur.
	 */
	private static $classes;
	
	/* Class Değişkeni
	 *
	 *
	 * Çağrılan sınıf bilgisini tutması
	 * için oluşturulmuştur.
	 */
	public static $class;
	
	/******************************************************************************************
	* RUN                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Otomatik yükleyiciği çağırmak için oluşturulmuş yöntemdir.			  |
	|          																				  |
	******************************************************************************************/
	public static function run($class)
	{
		// ----------------------------------------------------------------------------------------
		// ClassMap oluşturulmamış ise oluştur.
		// Sistemin çalışması için gerekli bir kontroldür.
		// ----------------------------------------------------------------------------------------
		$path = CONFIG_DIR.'ClassMap.php';
		
		// ClassMap daha önce oluşturulmamış ise oluturuluyor...
		if( ! file_exists($path) )
		{
			self::createClassMap();
		}

		// Sınıf bilgileri alınıyor...
		$classInfo = self::getClassFileInfo($class);
	
		// Sınıfın yolu alınıyor...
		$file = $classInfo['path'];
		
		// Böyle bir sınıf varsa dahil ediliyor...
		if( file_exists($file) )
		{	
			require_once($file);
		
			self::$class = $classInfo['class'];
			
			if( ! class_exists(self::$class) )
			{
				self::createClassMap();	
				
				$classInfo = self::getClassFileInfo($class);
	
				// Sınıfın yolu alınıyor...
				$file = $classInfo['path'];
				
				if( file_exists($file) )
				{	
					require_once($file);
					
					self::$class = $classInfo['class'];
				}
			}
		}
		else
		{
			// Böyle bir sınıf yoksa classmap yeniden oluşturuluyor...
			self::createClassMap();
			
			// Sınıfın bilgileri yeniden alınıyor...
			$classInfo = self::getClassFileInfo($class);
			
			// Sınıfın yolu yeniden isteniyor...
			$file = $classInfo['path'];
			
			// Böyle bir sınıf varsa dahil ediliyor...
			if( file_exists($file) )
			{	
				require_once($file);
				
				self::$class = $classInfo['class'];
				
				if( ! class_exists(self::$class) )
				{
					self::createClassMap();	
				}
			}
			else
			{
				// Böyle bir sınıf yoksa hata mesajı oluşturuluyor...
				die(getErrorMessage('Error', 'classError', $class));
			}
		}
	} 
	
	/******************************************************************************************
	* CREATE CLASS MAP                                                                        *
	*******************************************************************************************
	| Genel Kullanım: Config/Autoloader.php dosyasında belirtilen dizinlere ait sınıfların.   |
	| yol bilgisi oluşturulur. Böylece bir sınıf dahil edilmeden kullanılabilir.			  |
	|          																				  |
	******************************************************************************************/
	public static function createClassMap()
	{
		$classMap = Config::get('Autoloader', 'classMap');
		
		if( ! empty($classMap) ) foreach($classMap as $directory)
		{
			$classMaps = self::searchClassMap($directory, $directory);
		}
		
		self::$classes = $classMaps;
		
		$path = CONFIG_DIR.'ClassMap.php';
		
		// ----------------------------------------------------------------------------------------
		// ClassMap dosyasının metinsel bölümü oluşturuluyor.
		// ----------------------------------------------------------------------------------------
		$classMapPage  = '<?php'.eol();
		$classMapPage .= '$config[\'ClassMap\'][\'path\'] = array'.eol().'('.eol();
		
		if( ! empty($classMaps) ) foreach($classMaps as $k => $v)
		{
			$classMapPage .= "\t".'\''.$k.'\' => \''.$v.'\','.eol();
		}
		
		$classMapPage  = rtrim($classMapPage, ','.eol());	
		$classMapPage .= eol().');';
		
		// ----------------------------------------------------------------------------------------
		// ClassMap verisi yine aynı isimde bir dosya olarak oluşturuluyor.
		// ----------------------------------------------------------------------------------------
		$fileOpen  = fopen($path, 'w');		
		$fileWrite = fwrite($fileOpen, $classMapPage);
		
		fclose($fileOpen);
	}
	
	/******************************************************************************************
	* GET CLASS FILE INFO                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Çağrılan sınıfın sınıf, yol ve namespace bilgilerini almak için 		  |
	| oluşturulmuştur.								  										  |
	|          																				  |
	******************************************************************************************/
	public static function getClassFileInfo($class = '')
	{
		$classMap = ! empty(self::$classes) 
			        ? self::$classes
				    : Config::get('ClassMap', 'path');
			
		$classMapCaseLower = array_change_key_case($classMap, CASE_LOWER);	
		$classCaseLower    = strtolower($class);
		
		// ----------------------------------------------------------------------------------------
		// DOSYA bilgisi oluşturuluyor...
		// ----------------------------------------------------------------------------------------
		$file = isset($classMapCaseLower[$classCaseLower])
			  ? $classMapCaseLower[$classCaseLower]
			  : '';
		// ----------------------------------------------------------------------------------------
		
		// ----------------------------------------------------------------------------------------
		// NAMESPACE bilgisi oluşturuluyor...
		// ----------------------------------------------------------------------------------------	  
		$className  = array_keys($classMap);
		$classIndex = array_search($classCaseLower, array_keys($classMapCaseLower));	
		$namespace  = $className[$classIndex + 1];
	
		if( $classMap[$namespace] !== $file )
		{
			$namespace = $class;	
		}
		// ----------------------------------------------------------------------------------------
		
		return array
		(
			'path' 		=> $file,
			'class'	   	=> $class,
			'namespace'	=> $namespace
		);
	}
	
	/******************************************************************************************
	* TOKEN CLASS FILE INFO                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Yolu belirtilen sınıfın sınıf ve namespace bilgilerini almak için       |
	| oluşturulmuştur.								  										  |
	|          																				  |
	******************************************************************************************/
	public static function tokenClassFileInfo($fileName = '')
	{
		$tokens = token_get_all(file_get_contents($fileName));
		
		$classInfo = array();
		
		$i = 0;
		
		foreach( $tokens as $token )
		{
			if( $token[0] === T_NAMESPACE )
			{
				$classInfo['namespace'] = $tokens[$i + 2][1];
			}
			
			if( $token[0] === T_CLASS )
			{
				$classInfo['class'] = $tokens[$i + 2][1];
				
				break;
			}
			
			$i++;
		}	
		
		return $classInfo;
	}
	
	/******************************************************************************************
	* PRIVATE SEARCH CLASS MAP                                                                *
	*******************************************************************************************
	| Genel Kullanım: Config/Autoloader.php dosyasında belirtilen dizinlere ait sınıfların.   |
	| yol bilgisi oluşturulur. createClassMap() yöntemi için oluşturulmuştur.    			  |
	|          																				  |
	******************************************************************************************/
	private static function searchClassMap($directory = '', $baseDirectory = '' )
	{
		static $classes;
		
		$directory 	   = suffix($directory); 
		$baseDirectory = suffix($baseDirectory); 
		
		$files = glob($directory.'*');
	
		if( ! empty($files) ) foreach($files as $v)
		{
			if( is_file($v) && extension($v) === 'php' )
			{
				$classEx = explode('/', $v);
				
				// Sınıf isimleri ve yolları oluşturuluyor...
				$classInfo = Autoloader::tokenClassFileInfo($v);
				
				if( isset($classInfo['class']) )
				{
					$classes[$classInfo['class']] = $v;	
					
					// Statik erişim sağlanmak istenen
					// Statik olmayan sınıfların
					// sınıf adına Static ön eki getirilerek
					// bu sınıfların statik kullanımlarının oluşturulması
					// sağlanabilir.			
					if( strstr(strtolower($classInfo['class']), strtolower('Static')) &&  $classInfo['class'] !== 'StaticAccess' )
					{
						// Yeni yollar oluşturuluyor...
						$newClassName = str_ireplace('Static', '', $classInfo['class']);
						$newPath      = str_replace(array($classInfo['class'].'.php', $baseDirectory), array($newClassName.'.php', ''), $v);	
						$newDir       = str_replace($newClassName.'.php', '', $newPath);
						
						$dir    = SYSTEM_LIBRARIES_DIR.'StaticAccess/Libraries/';
						$newDir = $dir.$newDir;
						
						// Oluşturulacak dizinin var olup olmadığı
						// kontrol ediliyor...
					
						if( ! isDirExists($newDir) )
						{
							mkdir($newDir);
						}
						
						$path = $dir.$newPath;	
						
						// Oluşturulacak dosyanın var olup olmadığı
						// kontrol ediliyor...
						if( ! file_exists($path) )	
						{	
							$classContent  = '<?php'.eol();
							$classContent .= 'class '.$newClassName.' extends StaticAccess'.eol();
							$classContent .= '{'.eol();	
							$classContent .= eol();
							$classContent .= '}';
						
							$fileOpen  = fopen($path, 'w');	
							$fileWrite = fwrite($fileOpen, $classContent);
						
							fclose($fileOpen);
						}
					}
				}
				
				if( isset($classInfo['namespace']) )
				{
					$classes[$classInfo['namespace'].'\\'.$classInfo['class']] = $v;	
				}
			}
			elseif( is_dir($v) )
			{
				self::searchClassMap($v, $baseDirectory);
			}
		}	
		
		return $classes;
	}
}

/* AUTOLOADER RUN *
*
* 
* Otomatik Yükleme Çalıştırılıyor...
*/
spl_autoload_register('Autoloader::run');