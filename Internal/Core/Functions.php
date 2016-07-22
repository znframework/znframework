<?php 
//----------------------------------------------------------------------------------------------------
// SİSTEM FONKSİYONLARI 
//----------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//----------------------------------------------------------------------------------------------------

//----------------------------------SYSTEM AND USER FUNCTIONS START-----------------------------------

//----------------------------------------------------------------------------------------------------
// getLang()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sitenin aktif dilinin ne olduğu bilgisini verir.
// Parametreler: Yok.
// Dönen Değerler: Herhangi bir dil set edilmişse o dilin değeri edilmemişse varsayılan tr değeri döner.
//          																				  
//----------------------------------------------------------------------------------------------------
function getLang()
{
	$systemLanguageData        = md5("SystemLanguageData");
	$defaultSystemLanguageData = md5("DefaultSystemLanguageData");
	
	$default = Config::get('Language', 'default');
	
	if( ! Session::select($defaultSystemLanguageData) )
	{
		Session::insert($defaultSystemLanguageData, $default);
	}
	else
	{
		if( Session::select($defaultSystemLanguageData) !== $default )	
		{
			Session::insert($defaultSystemLanguageData, $default);
			Session::insert($systemLanguageData, $default);
			
			return $default;
		}
	}
	
	if( Session::select($systemLanguageData) === false ) 
	{
		Session::insert($systemLanguageData, $default);
		
		return $default; 
	}
	else
	{ 
		return Session::select($systemLanguageData);
	}
}

//----------------------------------------------------------------------------------------------------
// setLang()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sitenin aktif dilini ayarlamak için kullanılır.
// Parametreler: $l = değiştirilecek dilin kısaltması. Varsayılan tr değeridir.
// Dönen Değerler: Herhangi bir değer döndürmez set edilen değeri öğrenmek için gel_lang() yöntemi kullanılır.
//          																				  
//----------------------------------------------------------------------------------------------------
function setLang($l = '')
{
	if( ! is_string($l) )
	{
		return false;
	}
	
	if( empty($l) )
	{
		$l = Config::get('Language', 'default');	
	}
	
	Session::insert(md5("SystemLanguageData"), $l);
}

//----------------------------------------------------------------------------------------------------
// lang()
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Dahil edilen dil dosyalarına ait verileri kullanma işlevini üstlenir.	 
//          																				  
//----------------------------------------------------------------------------------------------------
function lang($file = '', $str = '', $changed = '')
{
	// Parametreler kontrol ediliyor.		
	if( ! is_string($file) || ! is_string($str) ) 
	{
		return false;
	}
	
	$key 		   = removeExtension($file, 'php');
	$file 		   = Config::get('Language', 'shortCodes')[getLang()].'/'.suffix($file, '.php');
	$langDir       = restorationPath(LANGUAGES_DIR.$file);
	$sysLangDir    = INTERNAL_LANGUAGES_DIR.$file;
	$commonLangDir = EXTERNAL_LANGUAGES_DIR.$file;
	
	global $lang;
	
	if( is_file($langDir) ) 
	{
		require_once($langDir);	
	}
	elseif( is_file($sysLangDir) )
	{
		require_once($sysLangDir);	
	}
	elseif( is_file($commonLangDir) )
	{
		require_once($commonLangDir);	
	}
	
	// Belirtilen anahtar dahil edilen
	// Dil dosyası içerisinde mevcutsa
	// İşlemlere devam et.
	if( isset($lang[$key][$str]) )
	{
		$langstr = $lang[$key][$str];	
	}
	elseif( isset($lang[$key]) && empty($str) )
	{
		return $lang[$key];	
	}
	else
	{
		return false;	
	}
	
	// 2. Parametre Dizi değilse
	// Dil dosyaları içerisinde yer alan
	// & işareti yerine bu parametrenin değerin ata.
	if( ! is_array($changed) )
	{
		if( strstr($langstr, "%") && ! empty($changed) )
		{
			return str_replace("%", $changed , $langstr);
		}
		else
		{
			return $langstr;
		}
	}
	else
	{
		// 2. Parametre dizi ise
		// Anahtar olarak belirtilen
		// İşaretler yerine karşılarında
		// yer alan değerleri ata.
		if( ! empty($changed) )
		{
			$values = [];
			
			foreach( $changed as $key => $value )
			{
				$keys[]   = $key;
				$values[] = $value;	
			}
			
			return str_replace($keys, $values, $langstr);
		}
		else
		{
			return $langstr;
		}
	}
}

//----------------------------------------------------------------------------------------------------
// currentLang()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sitenin aktif dilinin ne olduğu bilgisini verir getLang() yönteminden farkı
// Config/Uri.php dosyasından lang = true olarak ayarlanmamışsa herhangi bir sonuç vermez.
// Parametreler: Yok..
// Dönen Değerler: Config/Uri.php dosyasından lang = true olarak ayarlı ise sitenin aktif dilini çevirir.
// herhangi bir set edilme gerçekleşmemişse varsayılan tr değerini döndürür.
//          																				  
//----------------------------------------------------------------------------------------------------
function currentLang()
{
	if( ! Config::get('Uri','lang') ) 
	{
		return false;
	}
	else
	{ 	
		return getLang();
	}
}

//----------------------------------------------------------------------------------------------------
// currentUrl()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Açık olan sayfanın o anki url adresini döndürür.
// Parametreler: @param string $fix: empty
// Dönen Değerler: Sayfanın aktif url adresini döndürür.
//          																				  
//----------------------------------------------------------------------------------------------------
function currentUrl($fix = '')
{
	$currentUrl = sslStatus().host().internalCleanInjection($_SERVER['REQUEST_URI']);

	if( ! empty($fix) )
	{
		return rtrim(suffix($currentUrl), $fix).$fix;	
	}

	return $currentUrl;
}

//----------------------------------------------------------------------------------------------------
// siteUrl()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sitenin url adresini döndürür baseUrl() den farkı bazı Config ayarları
// ile eklenen dil, ssl ve zeroneed.php gibi ekleride url adresinde barındırır.
// Parametreler: $uri = Site url adresine uri eki ekler, $index = Girilen sayısal negatif değer kadar 
// üst dizinin url adresini verir.
// Dönen Değerler: Sitenin url adresini verir. http://www.example.com/zeroneed.php/
//          																				  
//----------------------------------------------------------------------------------------------------
function siteUrl($uri = '', $index = 0)
{
	if( ! is_string($uri) ) 
	{
		return false;
	}
	
	if( ! is_numeric($index) )
	{
		$index = 0;
	}
	
	$newBaseDir = BASE_DIR;	
	
	if( BASE_DIR !== "/" )
	{
		$baseDir = substr(BASE_DIR, 1, -1);
		
		if( $index < 0 )
		{
			$baseDir    = explode("/", $baseDir);
			$newBaseDir = "/";
		
			for( $i = 0; $i < count($baseDir) + $index; $i++ )
			{
				$newBaseDir .= suffix($baseDir[$i]);
			}
		}
	}
	
	$host = host();
	
	return sslStatus().$host.$newBaseDir.indexStatus().suffix(currentLang()).internalCleanInjection($uri);
}

//----------------------------------------------------------------------------------------------------
// baseUrl()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sitenin kök url adresini döndürür. Configten eklenen dil veya zeroneed.php gibi ekler ilave edilmez.
// Parametreler: $uri = Site kök url adresine uri eki ekler, $index = Girilen sayısal negatif değer kadar 
// üst dizinin kök url adresini verir.
// Dönen Değerler: Sitenin kök url adresini verir. http://www.example.com/
//          																				  
//----------------------------------------------------------------------------------------------------
function baseUrl($uri = '', $index = 0)
{
	if( ! is_string($uri) ) 
	{
		return false;
	}
	
	if( ! is_numeric($index) )
	{
		$index = 0;
	}
	
	$newBaseDir = BASE_DIR;
	
	if( BASE_DIR !== "/" )
	{
		$baseDir = substr(BASE_DIR, 1, -1);
		
		if( $index < 0 )
		{
			$baseDir    = explode("/", $baseDir);
			$newBaseDir = "/";
			
			for($i = 0; $i < count($baseDir) + $index; $i++)
			{
				$newBaseDir .= suffix($baseDir[$i]);
			}
		}
	}
	
	$host = host();
	
	return sslStatus().$host.$newBaseDir.restorationPath(internalCleanInjection($uri));
}	
	
//----------------------------------------------------------------------------------------------------
// prevUrl()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Bir önceki gelinen sayfanın url adresini verir.
// Parametreler: Yok.
// Dönen Değerler: Bir önceki gelinen sayfanın url adresini döndürür.
//          																				  
//----------------------------------------------------------------------------------------------------	
function prevUrl()
{
	if( ! isset($_SERVER['HTTP_REFERER']) )
	{
		return false;
	}
	
 	$str = str_replace(sslStatus().host().BASE_DIR.indexStatus(), "", $_SERVER['HTTP_REFERER']);
	
	if( currentLang() )
	{
		$strEx = explode("/", $str);
		$str   = str_replace($strEx[0]."/", "", $str);	
	}
	
	return siteUrl(internalCleanInjection($str));	
}

//----------------------------------------------------------------------------------------------------
// hostUrl()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sitenin bulunduğu sunucunun adresini verir.
// Parametreler: $uri = Sunucu adresine eklenecek uri eki.
// Dönen Değerler: Bir önceki gelinen sayfanın url adresini döndürür. http://sunucuadi/
//          																				  
//----------------------------------------------------------------------------------------------------	
function hostUrl($uri = "")
{	
	if( ! is_string($uri) ) 
	{
		return false;
	}
	
	return sslStatus().suffix(host()).internalCleanInjection($uri);
}

//----------------------------------------------------------------------------------------------------
// currentPath()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Açık olan sayfanın o anki yolunu verir.
// Parametreler: $isPath = true olması durumunda aktif yolun tamamını verir
// false olması durumunda ise sadece son segmentin bilgisini verir. 
// Dönen Değerler: Sayfanın o anki yolunu verir.  is_path = true: home/example is_path = false: example
//          																				  
//----------------------------------------------------------------------------------------------------
function currentPath($isPath = true)
{
	if( ! is_bool($isPath) ) 
	{
		$isPath = true;
	}
	
	$currentPagePath = str_replace("/".getLang()."/", "", server('currentPath'));
	
	if( isset($currentPagePath[0]) && $currentPagePath[0] === "/" )
	{
		$currentPagePath = substr($currentPagePath, 1, strlen($currentPagePath) - 1);
	}
	
	if( $isPath === true )
	{	
		return $currentPagePath;
	}
	else
	{
		$str = explode("/", $currentPagePath);
	
		if( count($str) > 1 ) 
		{
			return $str[count($str) - 1];	
		}
		
		return $str[0];
	}
}

//----------------------------------------------------------------------------------------------------
// basePath()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sitenin kök yolunu döndürür. Configten eklenen dil veya zeroneed.php gibi ekler ilave edilmez.
// Parametreler: $uri = Site kök yoluna uri eki ekler, $index = Girilen sayısal negatif değer kadar 
// üst dizinin kök yolunu verir.
// Dönen Değerler: Sitenin kök yolunu verir. znframework/
//          																				  
//----------------------------------------------------------------------------------------------------
function basePath($uri = '', $index = 0)
{
	if( ! is_string($uri) ) 
	{
		return false;
	}
	
	if( ! is_numeric($index) ) 
	{
		$index = 0;
	}
	
	$newBaseDir = substr(BASE_DIR, 1);
	
	if( BASE_DIR !== "/" )
	{
		if( $index < 0 )
		{
			$baseDir = substr(BASE_DIR, 1, -1);
			
			$baseDir = explode("/", $baseDir);
			
			$newBaseDir = '';
			
			for( $i = 0; $i < count($baseDir) + $index; $i++ )
			{
				$newBaseDir .= suffix($baseDir[$i]);
			}
		}
	}
	
	return internalCleanInjection($newBaseDir.$uri);
}

//----------------------------------------------------------------------------------------------------
// prevPath()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Bir önceki gelinen sayfanın yolunu verir.
// Parametreler: $isPath = true olması durumunda gelinen yolun tamamını verir
// Dönen Değerler: Bir önceki gelinen sayfanın yolunu döndürür.
//          																				  
//----------------------------------------------------------------------------------------------------	
function prevPath($isPath = true)
{
	if( ! isset($_SERVER['HTTP_REFERER']) )
	{
		return false;
	}
	
	if( ! is_bool($isPath) ) 
	{
		$isPath = true;
	}
	
	$str = str_replace(sslStatus().host().BASE_DIR.indexStatus(), '', $_SERVER['HTTP_REFERER']);
	
	if( currentLang() )
	{
		$str = explode("/",$str); return $str[1]; 
	}
	
	if( $isPath === true )
	{
		return $str;	
	}
	else
	{
		$str = explode("/", $str);
		
		$count = count($str);
		
		if( $count > 1 ) 
		{
			return $str[$count - 1];	
		}
		
		return $str[0];
	}
}

//----------------------------------------------------------------------------------------------------
// filePath()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Parametre olarak girilen yol url bilgisi içeriyorsa bu bilgiyi ayıklar
// ve dosyanın yolunu verir.
// Parametreler: $file = dosya adı, $removeUrl = ayıklanacak url adresi
// Dönen Değerler: Dosyanın yolunu verir.
//          																				  
//----------------------------------------------------------------------------------------------------
function filePath($file = "", $removeUrl = "")
{
	if( ! is_string($file) ) 
	{
		return false;
	}
	
	if( ! is_string($removeUrl) ) 
	{
		$removeUrl = "";
	}
	
	if( isUrl($file) )
	{
		if( ! isUrl($removeUrl) )
		{
			$removeUrl = baseUrl();
		}
		
		$file = trim(str_replace($removeUrl, '', $file));
	}
	
	return $file;
}


//----------------------------------------------------------------------------------------------------
// redirect()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Yönlendirme yapmak için kullanılır.
// Parametreler: $url = yönlendirme yapılacak adres, $time = Yönlendirme süresi
// $data = [] yönlendirilecek sayfaya veri gönderme, $exit = true 
// Dönen Değerler: Yok.
//          																				  
//----------------------------------------------------------------------------------------------------
function redirect($url = '', $time = 0, $data = [], $exit = true)
{	
	if( ! is_string($url) || empty($url) ) 
	{
		return false;
	}
	
	if( ! isUrl($url) )
	{
		$url = siteUrl($url);
	}
	
	if( ! empty($data) )
	{
		foreach( $data as $k => $v )
		{
			Session::insert('redirect:'.$k, $v);	
		}		
	}
	
	if( $time > 0 ) 
	{
		sleep($time);
	}
	
	header("Location: $url", true);
	
	if( $exit === true ) 
	{
		exit;
	}
}

//----------------------------------------------------------------------------------------------------
// redirectData()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Yönlendirme ile gönderilen datayı okumak için kullanılır.
// Parametreler: $k = Gönderilen bilginin anahtar kelimesi.
// Dönen Değerler: Anahtar ifadenin değeri.
//          																				  
//----------------------------------------------------------------------------------------------------
function redirectData($k = '')
{
	if( ! is_scalar($k) ) 
	{
		return false;
	}
	
	if( $data = Session::select('redirect:'.$k) ) 
	{
		return $data;
	}
	else
	{
		return false;
	}
}

//----------------------------------------------------------------------------------------------------
// redirectDeleteData()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Yönlendirme ile gönderilen datayı silmek için kullanıloır.
// Parametreler: $data = Gönderilen bilginin anahtar kelimesi. Metinsel veya dizisel olabilir.
// Dönen Değerler: void.
//          																				  
//----------------------------------------------------------------------------------------------------
function redirectDeleteData($data = '')
{
	if( is_array($data) ) foreach( $data as $v )
	{
		Session::delete('redirect:'.$v);	
	}
	else
	{
		Session::delete('redirect:'.$data);
	}
}

//----------------------------------------------------------------------------------------------------
// library()
//----------------------------------------------------------------------------------------------------
//
// Kütüphane kullanımı için oluşturulmuştur.
//          																				  
//----------------------------------------------------------------------------------------------------
function library($class = NULL, $function = NULL, $parameters = [])
{
	if( empty($class) || empty($function) ) 
	{
		return false;
	}
		
	$var = uselib($class);
	
	if( ! is_array($parameters) ) 
	{
		$parameters = [$parameters];
	}
	
	if( is_callable([$var, $function]) )
	{
		return call_user_func_array([$var, $function], $parameters);
	}
	else
	{
		return false;
	}
}

//----------------------------------------------------------------------------------------------------
// uselib()
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Herhangi bir sınıfı kullanmak için oluşturulmuştur.					  
//          																				  
//----------------------------------------------------------------------------------------------------
function uselib($class = '', $parameters = [])
{
	if( ! class_exists($class) )
	{
		$classInfo = ZN\Core\Autoloader::getClassFileInfo($class);
		
		$class = $classInfo['namespace'];
		
		if( ! class_exists($class) )
		{
			die(getErrorMessage('Error', 'classError', $class));	
		}
	}

	if( ! isset(zn::$use->$class) )
	{
		if( ! is_object(zn::$use) )
		{
			zn::$use = new stdClass();	
		}

		zn::$use->$class = new $class(...$parameters);
	}
	
	return zn::$use->$class;	
}

//----------------------------------------------------------------------------------------------------
// getErrorMessage()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
//          																				  
//----------------------------------------------------------------------------------------------------
function getErrorMessage($langFile = '', $errorMsg = '', $ex = '')
{
	$style  = 'border:solid 1px #E1E4E5;';
	$style .= 'background:#FEFEFE;';
	$style .= 'padding:10px;';
	$style .= 'margin-bottom:10px;';
	$style .= 'font-family:Calibri, Ebrima, Century Gothic, Consolas, Courier New, Courier, monospace, Tahoma, Arial;';
	$style .= 'color:#666;';
	$style .= 'text-align:left;';
	$style .= 'font-size:14px;';
	
	$exStyle = 'color:#900;';
	
	if( ! is_array($ex) )
	{
		$ex = '<span style="'.$exStyle .'">'.$ex.'</span>';
	}
	else
	{
		$newArray = [];
		
		if( ! empty($ex) ) foreach( $ex as $k => $v )
		{
			$newArray[$k] = $v;
		}
		
		$ex = $newArray;
	}
	
	$str  = "<div style=\"$style\">";
	
	if( $errorMsg !== true )
	{
		$str .= lang($langFile, $errorMsg, $ex);
	}
	else
	{	
		$str .= $langFile;
	}
	
	$str .= '</div><br>';
	
	return $str;
}

//----------------------------------------------------------------------------------------------------
// report()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
//          																				  
//----------------------------------------------------------------------------------------------------
function report($subject = 'unknown', $message = '', $destination = '', $time = '')
{
	if( ! Config::get('Log', 'createFile')) 
	{
		return false;
	}
	
	if( $destination === '' )
	{
		$destination = str_replace(' ', '-', $subject);
	}
	
	$logDir    = STORAGE_DIR.'Logs/';
	$extension = '.log';
	
	if( ! is_dir($logDir) )
	{
		Folder::create($logDir, 0755);	
	}
	
	if( is_file($logDir.suffix($destination, $extension)) )
	{
		if( empty($time) ) 
		{
			$time = Config::get('Log', 'fileTime');
		}
		
		$createDate = File::createDate($logDir.suffix($destination, $extension), 'd.m.Y');
		$endDate    = strtotime("$time", strtotime($createDate));
		$endDate    = date('Y.m.d', $endDate);
		
		if( date('Y.m.d')  >  $endDate )
		{
			File::delete($logDir.suffix($destination, $extension));
		}
	}

	$message = "IP: ".ipv4()." | Subject: ".$subject.' | Date: '.Date::set('{dayNumber0}.{monthNumber0}.{year} {H024}:{minute}:{second}')." | Message: ".$message.EOL;
	error_log($message, 3, $logDir.suffix($destination, $extension));
}

//----------------------------------------------------------------------------------------------------
// headers()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
//          																				  
//----------------------------------------------------------------------------------------------------
function headers($header = '')
{
	if( empty($header) )
	{
		return false;
	}
	
	if( ! is_array($header) )
	{
		 header($header);
	}
	else 
	{
		if( isset($header) ) foreach( $header as $k => $v )
		{
			header($v);
		}
	}
}

//----------------------------------------------------------------------------------------------------
// sslStatus()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
//          																				  
//----------------------------------------------------------------------------------------------------
function sslStatus()
{
	if( Config::get('Uri','ssl') )
	{ 
		return 'https://'; 
	}
	else
	{ 
		return 'http://';	
	}
}

//----------------------------------------------------------------------------------------------------
// indexStatus()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
//          																				  
//----------------------------------------------------------------------------------------------------
function indexStatus()
{
	if( Config::get('Htaccess', 'uri')[DIRECTORY_INDEX] ) 
	{
		return DIRECTORY_INDEX.'/'; 
	}
	else
	{ 
		return '';	
	}
}
//------------------------------------SYSTEM AND USER FUNCTIONS END-----------------------------------


//------------------------------------SYSTEM FUNCTIONS START------------------------------------------

//----------------------------------------------------------------------------------------------------
// currentUri()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
//          																				  
//----------------------------------------------------------------------------------------------------
function currentUri()
{
	if( BASE_DIR !== '/' )
	{
		$cu = str_replace(BASE_DIR, '', $_SERVER['REQUEST_URI']);
	}
	else
	{
		$cu = substr($_SERVER['REQUEST_URI'], 1);
	}
	
	if( indexStatus() ) 
	{
		$cu = str_replace(indexStatus(), '', $cu);
	}
	
	return $cu;
}

//----------------------------------------------------------------------------------------------------
// internalRequestURI()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
//          																				  
//----------------------------------------------------------------------------------------------------
function internalRequestURI()
{
	$requestUri = currentUri()
	            ? str_replace(DIRECTORY_INDEX.'/', '', currentUri()) 
				: substr(server('currentPath'), 1);
	
	if( isset($requestUri[strlen($requestUri) - 1]) && $requestUri[strlen($requestUri) - 1] === '/' )
	{
			$requestUri = substr($requestUri, 0, -1);
	}
	
	$requestUri	= internalCleanInjection(internalRouteURI($requestUri));
	$requestUri = internalCleanURIPrefix($requestUri, currentLang());
	
	if( defined('URIAPPDIR') )
	{
		$requestUri = internalCleanURIPrefix($requestUri, URIAPPDIR);
	}
	
	return $requestUri;
}

//----------------------------------------------------------------------------------------------------
// internalCleanURIPrefix()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sistem kullanıyor.
//          																				  
//----------------------------------------------------------------------------------------------------
function internalCleanURIPrefix($uri, $cleanData)
{
	$suffixData = suffix($cleanData);

	if( ! empty($cleanData) && stripos($uri, $suffixData) === 0 )
	{
		$uri = substr($uri, strlen($suffixData));
	}
	
	return $uri;
}

//----------------------------------------------------------------------------------------------------
// internalRouteURI()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
//          																				  
//----------------------------------------------------------------------------------------------------
function internalRouteURI($requestUri = '')
{
	if( Config::get('Route','openPage') )
	{
		$internalDir = NULL;
		
		if( defined('URIAPPDIR') )
		{
			global $application;
			
			$configAppdir = $application['directory']['others'];
			
			if( is_array($configAppdir) )
			{
				$internalDir = ! empty($configAppdir[$requestUri]) ? $requestUri : URIAPPDIR;
			}
			else
			{
				$internalDir = URIAPPDIR;	
			}
		}
		
		if
		( 	
			$requestUri === DIRECTORY_INDEX || 	 				 
			$requestUri === getLang() 		|| 
			$requestUri === $internalDir    ||
			empty($requestUri) 
		) 
		{
			$requestUri = Config::get('Route','openPage');	
		}
	}
		
	$config      = Config::get('Route');
	$uriChange   = $config['changeUri'];
	$patternType = $config['patternType'];
		
	if( ! empty($uriChange) ) foreach( $uriChange as $key => $val )
	{	
		if( $patternType === 'classic' )
		{
			$requestUri = preg_replace(presuffix($key).'xi', $val, $requestUri);
		}
		else
		{
			$requestUri = Regex::replace($key, $val, $requestUri, 'xi');
		}
	}
	
	return $requestUri;
}

//----------------------------------------------------------------------------------------------------
// internalCleanInjection()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
//          																				  
//----------------------------------------------------------------------------------------------------
function internalCleanInjection($string = "")
{
	$urlInjectionChangeChars = Config::get('Security', 'urlChangeChars');

	if( ! empty($urlInjectionChangeChars) ) foreach( $urlInjectionChangeChars as $key => $val )
	{		
		$string = preg_replace(presuffix($key).'xi', $val, $string);
	}
	
	return $string;
	
}

//----------------------------------------------------------------------------------------------------
// internalCreateRobotsFile()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
//          																				  
//----------------------------------------------------------------------------------------------------
function internalCreateRobotsFile()
{	
	$rules = Config::get('Robots', 'rules');
	
	$robots = '';
	
	if( isArray($rules) ) foreach( $rules as $key => $val )
	{
		if( ! is_numeric($key) ) // Tekli Kullanım
		{
			switch( $key )
			{
				case 'userAgent' :
					$robots .= ! empty( $val ) ? 'User-agent: '.$val.EOL : '';
				break;	
				
				case 'allow'    :
				case 'disallow' :
					if( ! empty($val) ) foreach( $val as $v )
					{
						$robots .= ucfirst($key).': '.$v.EOL;	
					}		
				break;
			}
		}
		else
		{
			if( isArray($val) ) foreach( $val as $r => $v ) // Çoklu Kullanım
			{
				switch( $r )
				{
					case 'userAgent' :
						$robots .= ! empty( $v ) ? 'User-agent: '.$v.EOL : '';
					break;	
					
					case 'allow'    :
					case 'disallow' :
						if( ! empty($v) ) foreach( $v as $vr )
						{
							$robots .= ucfirst($r).': '.$vr.EOL;	
						}		
					break;
				}
			}	
		}
	}
	
	// robots.txt dosyası varsa içeriği al yok ise içeriği boş geç
	if( file_exists('robots.txt') )
	{
		$getContents = file_get_contents('robots.txt');
	}
	else
	{
		$getContents = '';
	}
	// robots.txt değişkenin tuttuğu değer ile dosya içeri eşitse tekrar oluşturma
	if( trim($robots) === trim($getContents) ) 
	{
		return false;
	}
	
	if( ! file_put_contents('robots.txt', trim($robots)) )
	{
		Errors::set('Error', 'fileNotWrite', 'robots.txt');
	}
	
	unset( $robots );	
}

//----------------------------------------------------------------------------------------------------
// internalCreateHtaccessFile()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
//          																				  
//----------------------------------------------------------------------------------------------------
function internalCreateHtaccessFile()
{	
	// Cache.php ayar dosyasından ayarlar çekiliyor.
	$htaccessSettings = Config::get('Htaccess');
	
	$config = $htaccessSettings['cache'];
	$eol    = EOL;
	$tab	= HT;
	
	//-----------------------GZIP-------------------------------------------------------------
	// mod_gzip = true ayarı yapılmışsa aşağıdaki kodları ekler.
	// Gzip ile ön bellekleme başlatılmış olur.
	if( $config['modGzip']['status'] === true ) 
	{
		$modGzip = '<ifModule mod_gzip.c>
'.$tab.'mod_gzip_on Yes
'.$tab.'mod_gzip_dechunk Yes
'.$tab.'mod_gzip_item_include file .('.$config['modGzip']['includedFileExtension'].')$
'.$tab.'mod_gzip_item_include handler ^cgi-script$
'.$tab.'mod_gzip_item_include mime ^text/.*
'.$tab.'mod_gzip_item_include mime ^application/x-javascript.*
'.$tab.'mod_gzip_item_exclude mime ^image/.*
'.$tab.'mod_gzip_item_exclude rspheader ^Content-Encoding:.*gzip.*
</ifModule>'.$eol.$eol;
	}
	else
	{
		$modGzip = '';
	}
	//-----------------------GZIP-------------------------------------------------------------
	
	//-----------------------EXPIRES----------------------------------------------------------
	// mod_expires = true ayarı yapılmışsa aşağıdaki kodları ekler.
	// Tarayıcı ile ön bellekleme başlatılmış olur.
	if( $config['modExpires']['status'] === true ) 
	{
		$exp = '';
		foreach($config['modExpires']['fileTypeTime'] as $type => $value)
		{
			$exp .= $tab.'ExpiresByType '.$type.' "access plus '.$value.' seconds"'.$eol;
		}
		
		$modExpires = '<ifModule mod_expires.c>
'.$tab.'ExpiresActive On
'.$tab.'ExpiresDefault "access plus '.$config['modExpires']['defaultTime'].' seconds"
'.rtrim($exp, $eol).'
</ifModule>'.$eol.$eol;
	}
	else
	{
		$modExpires = '';
	}
	//-----------------------EXPIRES----------------------------------------------------------
	
	//-----------------------HEADERS----------------------------------------------------------
	// mod_headers = true ayarı yapılmışsa aşağıdaki kodları ekler.
	// Header ile ön bellekleme başlatılmış olur.
	if( $config['modHeaders']['status'] === true ) 
	{
		$fmatch = '';
		foreach( $config['modHeaders']['fileExtensionTimeAccess'] as $type => $value )
		{
			$fmatch .= $tab.'<filesMatch "\.('.$type.')$">
'.$tab.$tab.'Header set Cache-Control "max-age='.$value['time'].', '.$value['access'].'"
'.$tab.'</filesMatch>'.$eol;
		}
		
		$modHeaders = '<ifModule mod_headers.c>
'.rtrim($fmatch, $eol).'
</ifModule>
'.$eol;
	}
	else
	{
		$modHeaders = '';
	}
	//-----------------------HEADERS----------------------------------------------------------
	
	//-----------------------HEADER SET-------------------------------------------------------

	if( $htaccessSettings['headers']['status'] === true )
	{
		$headersIniSet  = "<ifModule mod_expires.c>".$eol;	
		
		foreach( $htaccessSettings['headers']['settings'] as $val )
		{
			$headersIniSet .= $tab."$val".$eol;
		}
		
		$headersIniSet .= "</ifModule>".$eol.$eol;
	}
	else
	{
		$headersIniSet = '';
	}
	//-----------------------HEADER SET-------------------------------------------------------
	
	//-----------------------HTACCESS SET-----------------------------------------------------	
	
	if( ! empty($htaccessSettings['settings']) )
	{
		$htaccessSettingsStr = '';
		
		foreach( $htaccessSettings['settings'] as $key => $val )
		{
			if( ! is_numeric($key) )
			{
				if( is_array($val) )
				{
					$htaccessSettingsStr .= "<$key>".$eol;
					
					foreach( $val as $k => $v)
					{
						if( ! is_numeric($k) )
						{
							$htaccessSettingsStr .= $tab."$k $v".$eol;
						}
						else
						{
							$htaccessSettingsStr .= $tab.$v.$eol;
						}
					}
					
					$keyex = explode(" ", $key);
					$htaccessSettingsStr .= "</$keyex[0]>".$eol.$eol;
				}
				else
				{
					$htaccessSettingsStr .= "$key $val".$eol;
				}
			}
			else
			{
				$htaccessSettingsStr .= $val.$eol;
			}
		}	
	}
	else
	{
		$htaccessSettingsStr = '';	
	}
	//-----------------------HTACCESS SET-----------------------------------------------------	
	
	// Htaccess dosyasına eklenecek veriler birleştiriliyor...
	
	$htaccess  = '#----------------------------------------------------------------------------------------------------'.$eol;
	$htaccess .= '# This file automatically created and updated'.$eol;
	$htaccess .= '#----------------------------------------------------------------------------------------------------'.$eol.$eol;
	$htaccess .= $modGzip.$modExpires.$modHeaders.$headersIniSet.$htaccessSettingsStr;
	
	//-----------------------URI ZERONEED PHP----------------------------------------------------	
	if( ! $htaccessSettings['uri'][DIRECTORY_INDEX] )
	{
		$indexSuffix = $htaccessSettings['uri']['indexSuffix'];
		$flag		 = ! empty($indexSuffix) ? 'QSA' : 'L';
		
		$htaccess .= "<IfModule mod_rewrite.c>".$eol;
		$htaccess .= $tab."RewriteEngine On".$eol;
		$htaccess .= $tab."RewriteBase /".$eol;
		$htaccess .= $tab."RewriteCond %{REQUEST_FILENAME} !-f".$eol;
		$htaccess .= $tab."RewriteCond %{REQUEST_FILENAME} !-d".$eol;
		$htaccess .= $tab.'RewriteRule ^(.*)$  '.$_SERVER['SCRIPT_NAME'].$indexSuffix.'/$1 ['.$flag.']'.$eol;
		$htaccess .= "</IfModule>".$eol.$eol;
	}
	//-----------------------URI ZERONEED PHP----------------------------------------------------
	
	//-----------------------ERROR REQUEST----------------------------------------------------	
	$htaccess .= 'ErrorDocument 403 '.BASE_DIR.DIRECTORY_INDEX.$eol.$eol;	
	//-----------------------ERROR REQUEST----------------------------------------------------
	
	//-----------------------DIRECTORY INDEX--------------------------------------------------
	$htaccess .= 'DirectoryIndex '.DIRECTORY_INDEX.$eol.$eol;	
	//-----------------------DIRECTORY INDEX--------------------------------------------------
	
	if( ! empty($uploadSet['status']) )
	{
		$uploadSettings = $htaccessSettings['upload'];
	}
	else
	{
		$uploadSettings = [];
	}
	//-----------------------UPLOAD SETTINGS--------------------------------------------------
	
	//-----------------------SESSION SETTINGS-------------------------------------------------
		
	if( ! empty($htaccessSettings['session']['status']) )
	{
		$sessionSettings = $htaccessSettings['session']['settings'];
	}
	else
	{
		$sessionSettings = [];
	}
	//-----------------------SESSION SETTINGS-------------------------------------------------
	
	//-----------------------INI SETTINGS-----------------------------------------------------		
	if( $htaccessSettings['ini']['status'] === true )
	{
		$iniSettings = $htaccessSettings['ini']['settings'];
	}
	else
	{
		$iniSettings = [];
	}
	//-----------------------INI SETTINGS-----------------------------------------------------	
	
	// Ayarlar birleştiriliyor.	
	$allSettings = array_merge($iniSettings, $uploadSettings, $sessionSettings);	
	
	if( ! empty($allSettings) )
	{
		$sets = '';
		foreach( $allSettings as $k => $v )
		{
			if( $v !== '' )
			{
				$sets .= $tab."php_value $k $v".$eol;		 
			}			
		}
		
		if( ! empty($sets) )
		{
			$htaccess .= $eol."<IfModule mod_php5.c>".$eol;
			$htaccess .= $sets;
			$htaccess .= "</IfModule>";
		}
	}
	
	// .htaccess dosyası varsa içeriği al yok ise içeriği boş geç
	if( file_exists('.htaccess') )
	{
		$getContents = trim(file_get_contents('.htaccess'));
	}
	else
	{
		$getContents = '';
	}
	
	$htaccess .= '#----------------------------------------------------------------------------------------------------';
	
	$htaccess = trim($htaccess);
	
	// $htaccess değişkenin tuttuğu değer ile dosya içeri eşitse tekrar oluşturma
	if( $htaccess === $getContents ) 
	{
		return false;
	}
	
	if( ! file_put_contents('.htaccess', trim($htaccess)) )
	{
		Errors::set('Error', 'fileNotWrite', '.htaccess');
	}
	
	unset( $htaccess );	
}

//----------------------------------------------------------------------------------------------------
// internalStartingContoller()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
//          																				  
//----------------------------------------------------------------------------------------------------
function internalStartingContoller($startController = '', $param = [])
{
	$controllerEx = explode(':', $startController);
		
	$controllerPath  = ! empty($controllerEx[0]) ? $controllerEx[0] : '';
	$controllerFunc  = ! empty($controllerEx[1]) ? $controllerEx[1] : 'main';
	$controllerFile  = CONTROLLERS_DIR.suffix($controllerPath, '.php');
	$controllerClass = divide($controllerPath, '/', -1);
	
	if( is_file($controllerFile) )
	{
		require_once($controllerFile);
		
		if( ! is_callable([$controllerClass, $controllerFunc]) )
		{
			// Hatayı rapor et.
			report('Error', lang('Error', 'callUserFuncArrayError', $controllerFunc), 'SystemCallUserFuncArrayError');	
				
			// Hatayı ekrana yazdır.
			die(Errors::message('Error', 'callUserFuncArrayError', $controllerFunc));
		}
		
		return uselib($controllerClass)->$controllerFunc(...$param);
	}	
	else
	{
		// Hatayı rapor et.
		report('Error', lang('Error', 'notIsFileError', $controllerFile), 'SystemNotIsFileError');
		
		// Hatayı ekrana yazdır.
		die(Errors::message('Error', 'notIsFileError', $controllerFile));	
	}
}
//------------------------------------SYSTEM FUNCTIONS END--------------------------------------------