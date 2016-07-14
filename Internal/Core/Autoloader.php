<?php
namespace ZN\Core;

class Autoloader
{	
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------

	//----------------------------------------------------------------------------------------------------
	// Protected Static Classes
	//----------------------------------------------------------------------------------------------------
	//
	// Otomatik yüklenen sınıfların bilgisi
	//
	// @var array
	//
	//----------------------------------------------------------------------------------------------------
	protected static $classes;
	
	//----------------------------------------------------------------------------------------------------
	// Protected Static Namespaces
	//----------------------------------------------------------------------------------------------------
	//
	// Otomatik yüklenen isim alanı olan sınıfların bilgisi
	//
	// @var array
	//
	//----------------------------------------------------------------------------------------------------
	protected static $namespaces;
	
	//----------------------------------------------------------------------------------------------------
	// Run
	//----------------------------------------------------------------------------------------------------
	//
	// Otomatik yükleyiciği çağırmak için oluşturulmuş yöntemdir.
	//
	// @param  autoloader $class
	// @return void
	//
	//----------------------------------------------------------------------------------------------------
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
		$file = restorationPath($classInfo['path']);
		
		// Böyle bir sınıf varsa dahil ediliyor...
		if( file_exists($file) )
		{	
			require_once($file);
			
			// Namespace olduğu halde class ismi bildirilirse
			// Sınıf haritasını yeniden oluşturmayı dene
			if
			(
				! class_exists($classInfo['namespace']) && 
				! trait_exists($classInfo['namespace']) && 
				! interface_exists($classInfo['namespace'])  
			)
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
	
	//----------------------------------------------------------------------------------------------------
	// Restart
	//----------------------------------------------------------------------------------------------------
	//
	// ClassMap'i yeniden oluşturmak için kullanılır.
	//
	// @param  void
	// @return bool
	//
	//----------------------------------------------------------------------------------------------------
	public static function restart()
	{
		$path = CONFIG_DIR.'ClassMap.php';
		
		if( is_file($path) ) 
		{
			unlink($path);
		}
		
		Config::set('ClassMap', 'classes'   , []);
		Config::set('ClassMap', 'namespaces', []);
		
		return self::createClassMap();
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Static Try Again Create Class Map
	//----------------------------------------------------------------------------------------------------
	//
	// @param  string $class
	// @return void
	//
	//----------------------------------------------------------------------------------------------------
	protected static function tryAgainCreateClassMap($class)
	{	
		self::createClassMap();	
			
		// Sınıf bilgileri alınıyor...
		$classInfo = self::getClassFileInfo($class);
		
		// Böyle bir sınıf varsa dahil ediliyor...
		if( file_exists($classInfo['path']) )
		{	
			require_once(restorationPath($classInfo['path']));
		}
		else
		{	
			die(getErrorMessage('Error', 'classError', $class));
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Create Class Map
	//----------------------------------------------------------------------------------------------------
	//
	// Config/Autoloader.php dosyasında belirtilen dizinlere ait sınıfların.  
	// yol bilgisi oluşturulur. Böylece bir sınıf dahil edilmeden kullanılabilir.
	//
	// @param  void
	// @return void
	//
	//----------------------------------------------------------------------------------------------------
	public static function createClassMap()
	{
		$configAutoloader = Config::get('Autoloader');
		$configClassMap   = Config::get('ClassMap');
		
		// Config/Autoloader.php dosyasından tarama
		// ayaraı kapalı ise tarama yapmaz.
		if( $configAutoloader['directoryScanning'] === false )
		{
			return false;			
		}
		
		// ClassMap'in oluşturulması için hangi dizinlerin
		// taranması gerektiği Config/Autoloader.php dosyasında
		// yer alır. Bu dizinlerin bilgisi alınıyor.
		$classMap = $configAutoloader['classMap'];
		
		// Belirtilen dizinler ve alt dizinler taranıyor
		// ve sınıf haritaları oluşturuluyor...
		if( ! empty($classMap) ) foreach($classMap as $directory)
		{
			$classMaps = self::searchClassMap($directory, $directory);
		}
		
		$classArray = array_diff_key
		(
			isset($classMaps['classes'])      ? $classMaps['classes']      : [], 
			isset($configClassMap['classes']) ? $configClassMap['classes'] : []
		);
		
		$eol  = EOL;
		
		// Config/ClassMap.php 
		$path = CONFIG_DIR.'ClassMap.php';
		
		// ----------------------------------------------------------------------------------------
		// ClassMap dosyasının sınıflar bölümü oluşturuluyor.
		// ----------------------------------------------------------------------------------------
		if( ! is_file($path) )
		{
			$classMapPage  = '<?php'.$eol;
			$classMapPage .= '//----------------------------------------------------------------------------------------------------'.$eol;
			$classMapPage .= '// This file automatically created and updated'.$eol;
			$classMapPage .= '//----------------------------------------------------------------------------------------------------'.$eol.$eol;
		}
		else
		{
			$classMapPage = '';	
		}
		
		if( ! empty($classArray) ) 
		{
			self::$classes    = $classMaps['classes'];
			
			foreach( $classArray as $k => $v )
			{
				$classMapPage .= '$config[\'ClassMap\'][\'classes\'][\''.$k.'\'] = \''.$v.'\';'.$eol;
			}
		}
		
		$namespaceArray = array_diff_key
		(
			isset($classMaps['namespaces']) ? $classMaps['namespaces'] : [], 
			isset($configClassMap['namespaces']) ? $configClassMap['namespaces'] : []
		);
		
		// ----------------------------------------------------------------------------------------
		// ClassMap dosyasının isim alanları bölümü oluşturuluyor.
		// ----------------------------------------------------------------------------------------	
		if( ! empty($namespaceArray) ) 
		{
			self::$namespaces = $classMaps['namespaces'];
			
			foreach( $namespaceArray as $k => $v )
			{
				$classMapPage .= '$config[\'ClassMap\'][\'namespaces\'][\''.$k.'\'] = \''.$v.'\';'.$eol;
			}
		}
		
		$classMapPage .= $eol.'//----------------------------------------------------------------------------------------------------';
	
		// ----------------------------------------------------------------------------------------
		// ClassMap verisi yine aynı isimde bir dosya olarak oluşturuluyor.
		// ----------------------------------------------------------------------------------------	
		file_put_contents($path, $classMapPage, FILE_APPEND);	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Get Class File Info
	//----------------------------------------------------------------------------------------------------
	//
	// Çağrılan sınıfın sınıf, yol ve namespace bilgilerini almak için oluşturulmuştur.
	//
	// @param  string $class
	// @return array
	//
	//----------------------------------------------------------------------------------------------------
	public static function getClassFileInfo($class = '')
	{	
		// ClassMap.php dosyasında yer alan veriler küçük harfle 
		// oluşturulduğu için parametre küçük harfe dönüştürülüyor.
		$classCaseLower = strtolower($class);
		
		// ClassMap.php dosyasına ait ayarlar alınıyor...
		$classMap = Config::get('ClassMap');
		
		// ClassMap oluşturulurken yeni çağrılan sınıfa ait bilgiler
		// dosyaya kaydedilemeden işlemler devam ettiği için sayfanın
		// bir kez yenilenmesi gerekmektedir. Bunun önüne geçmek için
		// oluşturulan dosya bilgisine ait veriler önce bir değişkende
		// saklanıyor. Eğer bu değişkendeki veri sayısı dosyadaki veri
		// sayısından fazla ise değişkenden veri çekiliyor. Böylecede
		// sayfanın yenilenmesine gerek kalmadan çağrılan sınıfın bilgisi
		// ClassMap.php dosyasına eklenmiş oluyor.
		$classes    = array_merge(isset($classMap['classes']) ? $classMap['classes'] : [], (array)self::$classes);

		// Yukarıdaki mantık isim alanlarının kullanımı içinde geçerlidir.
		$namespaces = array_merge(isset($classMap['namespaces']) ? $classMap['namespaces'] : [], (array)self::$namespaces);
		
		$path 	   = '';
		$namespace = '';
			
		// Tanımlanmakta olan sınıfın bilgisi classmap'te yer alan
		// sınıflar bölümünde var ise...		
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
			$namespace = $class;
			// ----------------------------------------------------------------------------------------
		}
		elseif( ! empty($namespaces) )
		{
			$namespaces = array_flip($namespaces);
			
			// Sınıf bilgisi isim alanları içinde mevcutsa.
			if( isset($namespaces[$classCaseLower]) )
			{
				// İsim alanı olarak parametre olarak girilen bilgiyi kullan.
				$namespace = $namespaces[$classCaseLower];		
				
				// Yol bilgisi olarak sınıflar içinde yer alan yol bilgisini kullan.					   
				$path      = isset($classes[$namespace])
						   ? $classes[$namespace]
						   : '';
			}
		}
		
		// ----------------------------------------------------------------------------------------
		// Namespace, class ve yol bilgileri döndürülüyor...
		// ----------------------------------------------------------------------------------------
		return array
		(
			'path' 		=> $path,
			'class'	   	=> $class,
			'namespace'	=> $namespace
		);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Token Class File Info
	//----------------------------------------------------------------------------------------------------
	//
	// Yolu belirtilen sınıfın sınıf ve namespace bilgilerini almak için oluşturulmuştur.
	//
	// @param  string $fileName
	// @return array
	//
	//----------------------------------------------------------------------------------------------------
	public static function tokenClassFileInfo($fileName = '')
	{
		if( ! is_file($fileName) )
		{
			return false;	
		}
		
		// Dosya içeriğini al ve tarama yap.
		$tokens    = token_get_all(file_get_contents($fileName));
		$classInfo = [];
		
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
					// İsim alanı tek bölümden oluşup oluşmadığı kontrol ediliyor...
					if( ! isset($tokens[$i + 3][1]) )
					{
						$ns = $tokens[$i + 2][1];
					}
					else
					{
						// İsim alanı \ sembolü ile ayrılmış birden
						// false bölümden oluşuyorsa kontrol edilir.
						$ii = $i;
					
						while( isset($tokens[$ii + 2][1]) )
						{
							$ns .= $tokens[$ii + 2][1];
							
							$ii++;
						}
					}
				}
				
				// İsim alanı bilgisi oluşturuluyor...
				$classInfo['namespace'] = trim($ns);
			}
			// -------------------------------------------------------------------------------------------
			
			// -------------------------------------------------------------------------------------------
			// Gerçek Sınıf İsmi Oluşturuluyor...
			// -------------------------------------------------------------------------------------------
			if
			( 
				$token[0] === T_CLASS     || 
				$token[0] === T_INTERFACE || 
				$token[0] === T_TRAIT 
			)
			{
				// Sınıf bilgisi oluşturuluyor...
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
	
	//----------------------------------------------------------------------------------------------------
	// Token File Info
	//----------------------------------------------------------------------------------------------------
	//
	// Yolu belirtilen fonksiyon bilgilerini almak için oluşturulmuştur.
	//
	// @param  string $fileName
	// @return array
	//
	//----------------------------------------------------------------------------------------------------
	public static function tokenFileInfo($fileName = '', $type = T_FUNCTION)
	{
		if( ! is_file($fileName) )
		{
			return false;	
		}
		
		// Dosya içeriğini al ve tarama yap.
		$tokens = token_get_all(file_get_contents($fileName));
		$info   = [];
		
		$i = 0;
		
		$type = \Convert::toConstant($type, 'T_');
		
		foreach( $tokens as $token )
		{
			// -------------------------------------------------------------------------------------------
			// Fonksiyon ismi yakalanıyor
			// -------------------------------------------------------------------------------------------
			if( $token[0] === $type )
			{
				// Sınıf bilgisi oluşturuluyor...
				$info[] = isset($tokens[$i + 2][1])
						? $tokens[$i + 2][1]
						: NULL;
			}
			// -------------------------------------------------------------------------------------------
			
			$i++;
		}	
	
		return $info;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Search Class Map
	//----------------------------------------------------------------------------------------------------
	//
	// Yolu belirtilen Config/Autoloader.php dosyasında belirtilen dizinlere ait sınıfların.  
	// yol bilgisi oluşturulur. createClassMap() yöntemi için oluşturulmuştur.
	//
	// @param  string $directory
	// @param  string $baseDirectory
	// @return void
	//
	//----------------------------------------------------------------------------------------------------
	protected static function searchClassMap($directory = '', $baseDirectory = '' )
	{
		static $classes;
			
		// Dizin parametreleri / eki içermiyorsa 
		// dizin bilgisinin sonuna / ekini ekle.
		$directory 	         = suffix($directory); 
		$baseDirectory       = suffix($baseDirectory); 
		$configClassMap      = Config::get('ClassMap');
		$configAutoloader    = Config::get('Autoloader');
		$directoryPermission = $configAutoloader['directoryPermission'];

		$files = glob($directory.'*');	
		$files = array_diff
		(
			$files, 
			isset($configClassMap['classes']) ? $configClassMap['classes'] : []
		);
		
		$staticAccessDirectory = INTERNAL_DIR.'StaticAccess/';
		
		$eol = EOL;
		
		if( ! empty($files) ) foreach( $files as $v )
		{
			// Sadece .php uzantılı dosyalar için işlem yap.
			if( is_file($v) )
			{
				// Sınıf isimleri ve yolları oluşturuluyor...
				$classInfo = self::tokenClassFileInfo($v);
				
				if( isset($classInfo['class']) )
				{
					$class = strtolower($classInfo['class']);
					
					// İsim alanı varsa oluşturuluyor...
					if( isset($classInfo['namespace']) )
					{	
						// İsim alanını oluştur.	
						$className = strtolower($classInfo['namespace']).'\\'.$class;		
						
						$classes['namespaces'][$className] = $class;
					}
					else
					{
						$className = $class;
					}
					
					$classes['classes'][$className] = $v;	
					
					$useStaticAccess = strtolower(STATIC_ACCESS);
					
					// Statik erişim sağlanmak istenen
					// Statik olmayan sınıfların
					// sınıf adına Static ön eki getirilerek
					// bu sınıfların statik kullanımlarının oluşturulması
					// sağlanabilir.			
					if( strpos($class, $useStaticAccess) === 0 )
					{			
						// Yeni sınıf ismi oluşturuluyor...
						$newClassName = str_ireplace($useStaticAccess, '', $classInfo['class']);
					
						// Yeni sınıf dizini oluşturuluyor...
						$newPath = str_ireplace($baseDirectory, '', $v);	
						
						// Yeni StaticAccess/ dizin yolu oluşturuluyor...
						$pathEx = explode('/', $newPath);		
						array_pop($pathEx);		
						$newDir = implode('/', $pathEx);
						$dir    = $staticAccessDirectory;
						$newDir = $dir.$newDir;	
						
						if( ! is_dir($dir) )
						{
							mkdir($dir, $directoryPermission, true);
						}
						
						// Oluşturulacak dizinin var olup olmadığı
						// kontrol ediliyor...		
						if( ! is_dir($newDir) )
						{
							// StaticAccess/ dizini içi sınıf dizini oluşturuluyor...
							mkdir($newDir, $directoryPermission, true);
						}
						
						$path = suffix($newDir).$classInfo['class'].'.php';
						
						// Sabit kontrolü yapılıyor.		
						$getFileContent = file_get_contents($v);
						
						preg_match_all('/const\s+(\w+)\s+\=\s+(.*?);/i', $getFileContent, $match);
						
						$const = ! empty($match[1]) ? $match[1] : [];
						$value = ! empty($match[2]) ? $match[2] : [];
						
						$constants = '';
						
						if( ! empty($const) ) 
						{
							foreach( $const as $key => $c )
							{
								$constants .= "\tconst ".$c.' = '.$value[$key].';'.$eol.$eol;
							}
						}
	
						// Statik sınıf içeriği oluşturuluyor....
						$classContent  = '<?php'.$eol;
						$classContent .= '//----------------------------------------------------------------------------------------------------'.$eol;
						$classContent .= '// This file automatically created and updated'.$eol;
						$classContent .= '//----------------------------------------------------------------------------------------------------'.$eol.$eol;
						$classContent .= 'class '.$newClassName.' extends ZN\Foundations\StaticAccess'.$eol;
						$classContent .= '{'.$eol;	
						$classContent .= $constants;
						$classContent .= "\t".'public static function getClassName()'.$eol;
						$classContent .= "\t".'{'.$eol;
						$classContent .= "\t\t".'return __CLASS__;'.$eol;
						$classContent .= "\t".'}'.$eol;
						$classContent .= '}'.$eol.$eol;
						$classContent .= '//----------------------------------------------------------------------------------------------------';
						
						$fileContentLength = is_file($path) ? strlen(file_get_contents($path)) : 0; 
						
						if( strlen($classContent) !== $fileContentLength )
						{
							file_put_contents($path, $classContent);
						}
						
						$classes['classes'][strtolower($newClassName)] = $path;
					}
				}
			}
			elseif( is_dir($v) )
			{
				// Yol bir dizini ifade ediyorsa taramaya devam et.
				self::searchClassMap($v, $baseDirectory);
			}
		}	
		
		return $classes;
	}
}

//----------------------------------------------------------------------------------------------------
// Autoload Register
//----------------------------------------------------------------------------------------------------
//
// Nesne çağrımında otomatik devreye girerek sınıfın yüklenmesini sağlar.
//
//----------------------------------------------------------------------------------------------------
  spl_autoload_register('ZN\Core\Autoloader::run');