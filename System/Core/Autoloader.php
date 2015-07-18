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
	
	/* Namespaces Değişkeni
	 *
	 *
	 * ClassMap bilgisini tutması
	 * için oluşturulmuştur.
	 */
	private static $namespaces;
	
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
			
			// Namespace olduğu halde class ismi bildirilirse
			// Sınıf haritasını yeniden oluşturmayı dene
			if( ! class_exists($classInfo['namespace']) )
			{
				self::tryAgainCreateClassMap($class);
			}
		}
		else
		{
			// Aranılan dosya bulunamazsa 1 kereye mahsuz
			// sınıf haritasını yeniden oluşturmayı dene
			self::tryAgainCreateClassMap($class);
		}
	} 
	
	/******************************************************************************************
	* PRIVATE TRY AGAIN CREATE CLASS MAP                                                      *
	*******************************************************************************************
	| Genel Kullanım: Yardımcı yöntemdir.    												  |
	|          																				  |
	******************************************************************************************/
	private static function tryAgainCreateClassMap($class)
	{
		self::createClassMap();
		
		// Sınıf bilgileri alınıyor...
		$classInfo = self::getClassFileInfo($class);
		
		// Böyle bir sınıf varsa dahil ediliyor...
		if( file_exists($classInfo['path']) )
		{	
			require_once($classInfo['path']);
		}
		else
		{	
			die(getErrorMessage('Error', 'classError', $class));
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
		
		$path = CONFIG_DIR.'ClassMap.php';
		
		// ----------------------------------------------------------------------------------------
		// ClassMap dosyasının metinsel bölümü oluşturuluyor.
		// ----------------------------------------------------------------------------------------
		$classMapPage  = '<?php'.eol();
		$classMapPage .= '$config[\'ClassMap\'][\'classes\'] = array'.eol().'('.eol();
		
		if( ! empty($classMaps['classes']) ) 
		{
			self::$classes    = $classMaps['classes'];
			
			foreach($classMaps['classes'] as $k => $v)
			{
				$classMapPage .= "\t".'\''.$k.'\' => \''.$v.'\','.eol();
			}
		}
		$classMapPage  = rtrim($classMapPage, ','.eol());	
		$classMapPage .= eol().');'.eol(2);
		
		$classMapPage .= '$config[\'ClassMap\'][\'namespaces\'] = array'.eol().'('.eol();
		
		if( ! empty($classMaps['namespaces']) ) 
		{
			self::$namespaces = $classMaps['namespaces'];
			
			foreach($classMaps['namespaces'] as $k => $v)
			{
				$classMapPage .= "\t".'\''.$k.'\' => \''.$v.'\','.eol();
			}
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
		$classCaseLower = strtolower($class);
		
		$classMap = Config::get('ClassMap');
		
		$classes    = count($classMap['classes']) > count(self::$classes)
					? $classMap['classes']
					: self::$classes;
		
		$namespaces = count($classMap['namespaces']) > count(self::$namespaces)
					? $classMap['namespaces']
					: self::$namespaces;
		
		$path 	   = '';
		$namespace = '';
				
		if( isset($classes[$classCaseLower]) )
		{
			// ----------------------------------------------------------------------------------------
			// PATH: bilgisi oluşturuluyor...
			// ----------------------------------------------------------------------------------------	
			$path      = $classes[$classCaseLower];	
			// ----------------------------------------------------------------------------------------

			// ----------------------------------------------------------------------------------------
			// NAMESPACE bilgisi oluşturuluyor...
			// ----------------------------------------------------------------------------------------
			$namespace = isset($namespaces[$classCaseLower])
				       ? $namespaces[$classCaseLower] 
				       : $class;
			// ----------------------------------------------------------------------------------------
		}
		elseif( ! empty($namespaces) )
		{
			$namespaceValues = array_values($namespaces);
			$namespaceKeys   = array_keys($namespaces);
			$index 		     = array_search($classCaseLower, $namespaceValues);
			
			if( $index > -1 )
			{
				$namespace = $class;		
				$class     = $namespaceKeys[$index];					   
				$path      = isset($classes[$class])
						   ? $classes[$class]
						   : '';
			}
		}
		
		return array
		(
			'path' 		=> $path,
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
		$contents = file_get_contents($fileName);
		$tokens   = token_get_all($contents);
		
		$classInfo = array();
		
		$i = 0;
		$ns = '';
		
		foreach( $tokens as $token )
		{
			// -------------------------------------------------------------------------------------------
			// Gerçek İsim Alanı Oluşturuluyor...
			// -------------------------------------------------------------------------------------------
			if( $token[0] === T_NAMESPACE )
			{
				if( isset($tokens[$i + 2][1]) )
				{
					if( empty($tokens[$i + 4][1]) )
					{
						$ns = $tokens[$i + 2][1];
					}
					else
					{
						$ii = $i;
					
						while( isset($tokens[$ii + 2][1]) )
						{
							$ns .= $tokens[$ii + 2][1];
							
							$ii++;
						}
					}
				}
				
				$classInfo['namespace'] = $ns;
			}
			// -------------------------------------------------------------------------------------------
			
			// -------------------------------------------------------------------------------------------
			// Gerçek Sınıf İsmi Oluşturuluyor...
			// -------------------------------------------------------------------------------------------
			if( $token[0] === T_CLASS )
			{
				$classInfo['class'] = isset($tokens[$i + 2][1])
								    ? $tokens[$i + 2][1]
								    : NULL;
				
				break;
			}
			// -------------------------------------------------------------------------------------------
			
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
				$classInfo = self::tokenClassFileInfo($v);
				
				if( isset($classInfo['class']) )
				{
					$classes['classes'][strtolower($classInfo['class'])] = $v;	
					
					// Statik erişim sağlanmak istenen
					// Statik olmayan sınıfların
					// sınıf adına Static ön eki getirilerek
					// bu sınıfların statik kullanımlarının oluşturulması
					// sağlanabilir.			
					if( strpos(strtolower($classInfo['class']), strtolower('Static')) === 0 && $classInfo['class'] !== 'StaticAccess' )
					{			
						// Yeni sınıf ismi oluşturuluyor...
						$newClassName = str_ireplace('Static', '', $classInfo['class']);
						
						// Yeni sınıf dizini oluşturuluyor...
						$newPath = str_ireplace($baseDirectory, '', $v);	
						
						// Yeni StaticAccess/ dizin yolu oluşturuluyor...
						$pathEx = explode('/', $newPath);		
						array_pop($pathEx);		
						$newDir = implode('/', $pathEx);
						$dir    = SYSTEM_LIBRARIES_DIR.'StaticAccess/';
						$newDir = $dir.$newDir;	
						
						if( ! isDirExists($dir) )
						{
							mkdir($dir, 0777, true);
						}
						
						// Oluşturulacak dizinin var olup olmadığı
						// kontrol ediliyor...		
						if( ! isDirExists($newDir) )
						{
							// StaticAccess/ dizini içi sınıf dizini oluşturuluyor...
							mkdir($newDir, 0777, true);
						}
						
						$path = $newDir.'/'.$classInfo['class'].'.php';	
						
						// Oluşturulacak dosyanın var olup olmadığı
						// kontrol ediliyor...
						if( ! file_exists($path) )	
						{	
							// Statik sınıf içeriği oluşturuluyor....
							$classContent  = '<?php'.eol();
							$classContent .= 'class '.$newClassName.' extends StaticAccess'.eol();
							$classContent .= '{'.eol();	
							$classContent .= "\t".'public static function getClassName()'.eol();
							$classContent .= "\t".'{'.eol();
							$classContent .= "\t\t".'return __CLASS__;'.eol();
							$classContent .= "\t".'}'.eol();
							$classContent .= '}';
						
							// Dosya yazdırılıyor...
							$fileOpen  = fopen($path, 'w');	
							$fileWrite = fwrite($fileOpen, $classContent);
						
							fclose($fileOpen);
						}
					}
				}
				
				if( isset($classInfo['namespace']) )
				{
					$class = isset($classInfo['class'])
						   ? $classInfo['class']
						   : '';
					
					$fix = ! empty($class)
						   ? '\\'
						   : ''; 	   
					
					$classes['namespaces'][strtolower($class)] = strtolower($classInfo['namespace'].$fix.$class);	
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