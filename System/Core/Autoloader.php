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
		// Config/ClassMap.php dosyasını oluştur. 
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
		// ClassMap'in oluşturulması için hangi dizinlerin
		// taranması gerektiği Config/Autoloader.php dosyasında
		// yer alır. Bu dizinlerin bilgisi alınıyor.
		$classMap = Config::get('Autoloader', 'classMap');
		
		// Belirtilen dizinler ve alt dizinler taranıyor
		// ve sınıf haritaları oluşturuluyor...
		if( ! empty($classMap) ) foreach($classMap as $directory)
		{
			$classMaps = self::searchClassMap($directory, $directory);
		}
		
		// Config/ClassMap.php 
		$path = CONFIG_DIR.'ClassMap.php';
		
		// ----------------------------------------------------------------------------------------
		// ClassMap dosyasının sınıflar bölümü oluşturuluyor.
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
		
		// ----------------------------------------------------------------------------------------
		// ClassMap dosyasının isim alanları bölümü oluşturuluyor.
		// ----------------------------------------------------------------------------------------
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
		$classes    = count($classMap['classes']) > count(self::$classes)
					? $classMap['classes']
					: self::$classes;
		
		// Yukarıdaki mantık isim alanlarının kullanımı içinde geçerlidir.
		$namespaces = count($classMap['namespaces']) > count(self::$namespaces)
					? $classMap['namespaces']
					: self::$namespaces;
		
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
			$namespace = isset($namespaces[$classCaseLower])
				       ? $namespaces[$classCaseLower] 
				       : $class;
			// ----------------------------------------------------------------------------------------
		}
		elseif( ! empty($namespaces) )
		{
			// Tanımlanmakta olan sınıfın bilgisi classmap'te yer alan sınıflar 
			// bölümünde yoksa namespace bölümünde ara..
			
			// ClassMap.php dosyasında oluşturulumuş namespaces ve classes
			// verileri arasında ilişki kuruluyor..
			// Bunun amacı tanımlanan sınıf bilgisi bir isim alanı içeriyorsa
			// İsim alanından araştırması hayır sınıf bilgisi içeriyorsa 
			// sınıflar içinde araştırmasıdır. Yani isim alanı olan sınıflar
			// da sadece sınıf isimleri kullanılarak erişim sağlanabiliyor.
			$namespaceValues = array_values($namespaces);
			$namespaceKeys   = array_keys($namespaces);
			$index 		     = array_search($classCaseLower, $namespaceValues);

			// Sınıf bilgisi isim alanları içinde mevcutsa.
			if( $index > -1 )
			{
				// İsim alanı olarak parametre olarak girilen bilgiyi kullan.
				$namespace = $namespaceKeys[$index];		
				
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
	
	/******************************************************************************************
	* TOKEN CLASS FILE INFO                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Yolu belirtilen sınıfın sınıf ve namespace bilgilerini almak için       |
	| oluşturulmuştur.								  										  |
	|          																				  |
	******************************************************************************************/
	public static function tokenClassFileInfo($fileName = '')
	{
		// Dosya içeriğini al ve tarama yap.
		$tokens   = token_get_all(file_get_contents($fileName));
		
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
					// İsim alanı tek bölümden oluşup oluşmadığı kontrol ediliyor...
					if( empty($tokens[$i + 4][1]) )
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
				$classInfo['namespace'] = $ns;
			}
			// -------------------------------------------------------------------------------------------
			
			// -------------------------------------------------------------------------------------------
			// Gerçek Sınıf İsmi Oluşturuluyor...
			// -------------------------------------------------------------------------------------------
			if( $token[0] === T_CLASS )
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
		
		// Dizin parametreleri / eki içermiyorsa 
		// dizin bilgisinin sonuna / ekini ekle.
		$directory 	   = suffix($directory); 
		$baseDirectory = suffix($baseDirectory); 
		
		// Dizine ait alt dosya ve dizinler alınıyor...
		$files = glob($directory.'*');
	
		if( ! empty($files) ) foreach($files as $v)
		{
			// Sadece .php uzantılı dosyalar için işlem yap.
			if( is_file($v) && extension($v) === 'php' )
			{
				$classEx = explode('/', $v);
				
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
					
					// Statik erişim sağlanmak istenen
					// Statik olmayan sınıfların
					// sınıf adına Static ön eki getirilerek
					// bu sınıfların statik kullanımlarının oluşturulması
					// sağlanabilir.			
					if( strpos($class, strtolower('__USE_STATIC_ACCESS__')) === 0 )
					{			
						// Yeni sınıf ismi oluşturuluyor...
						$newClassName = str_ireplace('__USE_STATIC_ACCESS__', '', $classInfo['class']);
					
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

/* AUTOLOADER RUN *
*
* 
* Otomatik Yükleme Çalıştırılıyor...
*/
spl_autoload_register('Autoloader::run');