<?php 
//----------------------------------------------------------------------------------------------------
// SİSTEM FONKSİYONLARI 
//----------------------------------------------------------------------------------------------------
//
// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.zntr.net
// Lisans     : The MIT License
// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
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
	if( Session::select("lang") === false ) 
	{
		return Session::insert("lang", Config::get('Language', 'default'));
	}
	else
	{ 
		return Session::select("lang");
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
	
	Session::insert("lang", $l);
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
	
	$key 		= removeExtension($file, 'php');
	$file 		= Config::get('Language', getLang()).'/'.suffix($file, '.php');
	$langDir    = restorationPath(LANGUAGES_DIR.$file);
	$sysLangDir = SYSTEM_LANGUAGES_DIR.$file;
	
	global $lang;
	
	if( is_file($langDir) ) 
	{
		require_once($langDir);	
	}
	elseif( is_file($sysLangDir) )
	{
		require_once($sysLangDir);	
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
			$values = array();
			
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
	if( ! Config::get("Uri","lang") ) 
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
// Parametreler: Yok.
// Dönen Değerler: Sayfanın aktif url adresini döndürür.
//          																				  
//----------------------------------------------------------------------------------------------------
function currentUrl()
{
	return sslStatus().host().cleanInjection($_SERVER['REQUEST_URI']);
}

//----------------------------------------------------------------------------------------------------
// siteUrl()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sitenin url adresini döndürür baseUrl() den farkı bazı Config ayarları
// ile eklenen dil, ssl ve index.php gibi ekleride url adresinde barındırır.
// Parametreler: $uri = Site url adresine uri eki ekler, $index = Girilen sayısal negatif değer kadar 
// üst dizinin url adresini verir.
// Dönen Değerler: Sitenin url adresini verir. http://www.example.com/index.php/
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
	
	return sslStatus().$host.$newBaseDir.indexStatus().suffix(currentLang()).cleanInjection($uri);
}

//----------------------------------------------------------------------------------------------------
// baseUrl()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sitenin kök url adresini döndürür. Configten eklenen dil veya index.php gibi ekler ilave edilmez.
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
	
	return sslStatus().$host.$newBaseDir.restorationPath(cleanInjection($uri));
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
 	$str = str_replace(sslStatus().host().BASE_DIR.indexStatus(), "", $_SERVER['HTTP_REFERER']);
	
	if( currentLang() )
	{
		$strEx = explode("/", $str);
		$str   = str_replace($strEx[0]."/", "", $str);	
	}
	
	return siteUrl(cleanInjection($str));	
}

//----------------------------------------------------------------------------------------------------
// hostName()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sitenin bulunduğu sunucunun adresini verir.
// Parametreler: $uri = Sunucu adresine eklenecek uri eki.
// Dönen Değerler: Bir önceki gelinen sayfanın url adresini döndürür. http://sunucuadi/
//          																				  
//----------------------------------------------------------------------------------------------------	
function hostName($uri = "")
{	
	if( ! is_string($uri) ) 
	{
		return false;
	}
	
	return sslStatus().suffix(host()).cleanInjection($uri);
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
	
	if( $currentPagePath[0] === "/" )
	{
		$currentPagePath = substr($currentPagePath, 1, strlen($currentPagePath)-1);
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
// İşlev: Sitenin kök yolunu döndürür. Configten eklenen dil veya index.php gibi ekler ilave edilmez.
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
	
	return cleanInjection($newBaseDir.$uri);
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
// $data = array() yönlendirilecek sayfaya veri gönderme, $exit = true 
// Dönen Değerler: Yok.
//          																				  
//----------------------------------------------------------------------------------------------------
function redirect($url = '', $time = 0, $data = array(), $exit = true)
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
function library($class = NULL, $function = NULL, $parameters = array())
{
	if( empty($class) || empty($function) ) 
	{
		return false;
	}
		
	$var = uselib($class);
	
	if( ! is_array($parameters) ) 
	{
		$parameters = array($parameters);
	}
	
	if( is_callable(array($var, $function)) )
	{
		return call_user_func_array( array($var, $function), $parameters );
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
function uselib($class = '', $parameters = array())
{
	if( ! class_exists($class) )
	{
		$classInfo = Autoloader::getClassFileInfo($class);
		
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

		switch( count($parameters) )
		{
			// Parametre yoksa
			case 0 : zn::$use->$class = new $class; break;
	
			// 1 parametre için
			case 1 : zn::$use->$class = new $class($parameters[0]); break;
			
			// 2 parametre için
			case 2 : zn::$use->$class = new $class($parameters[0], $parameters[1]); break;
			
			// 3 parametre için
			case 3 : zn::$use->$class = new $class($parameters[0], $parameters[1], $parameters[2]); break;
	
			// 4 parametre için
			case 4 : zn::$use->$class = new $class($parameters[0], $parameters[1], $parameters[2], $parameters[3]); break;
				
			// 5 parametre için
			case 5 : zn::$use->$class = new $class($parameters[0], $parameters[1], $parameters[2], $parameters[3], $parameters[4]); break;
			
			// Daha fazla parametre için
			// next 5.6.0
			// default: zn::$use->$class = new $class(...$parameters);
		
		}
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
	$style = '
		border:solid 1px #E1E4E5;
		background:#FEFEFE;
		padding:10px;
		margin-bottom:10px;
		font-family:Calibri, Ebrima, Century Gothic, Consolas, Courier New, Courier, monospace, Tahoma, Arial;
		color:#666;
		text-align:left;
		font-size:14px;
	';
	
	$exStyle = 'color:#900;';
	
	if( ! is_array($ex) )
	{
		$ex = '<span style="'.$exStyle .'">'.$ex.'</span>';
	}
	else
	{
		$newArray = array();
		
		if( ! empty($ex) ) foreach( $ex as $k => $v )
		{
			$newArray[$k] = $v;
		}
		
		$ex = $newArray;
	}
	
	$str  = "<div style=\"$style\">";
	$str .= lang($langFile, $errorMsg, $ex);
	$str .= '</div><br>';
	
	return $str;
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
// requestUri()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
//          																				  
//----------------------------------------------------------------------------------------------------
function requestUri()
{
	$requestUri = ( server('currentPath') ) 
	               ? substr(server('currentPath'), 1) 
				   : currentUri();
	
	if( isset($requestUri[strlen($requestUri) - 1]) && $requestUri[strlen($requestUri) - 1] === '/' )
	{
			$requestUri = substr($requestUri, 0, -1);
	}
	
	$requestUri = routeUri($requestUri);
	
	return str_replace(suffix(getLang()), '', cleanInjection($requestUri));
}

//----------------------------------------------------------------------------------------------------
// routeUri()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
//          																				  
//----------------------------------------------------------------------------------------------------
function routeUri($requestUri = '')
{
	if( Config::get('Route','openPage') )
	{
			if( $requestUri === 'index.php' || empty($requestUri) || $requestUri === getLang() ) 
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
// cleanInjection()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
//          																				  
//----------------------------------------------------------------------------------------------------
function cleanInjection($string = "")
{
	$urlInjectionChangeChars = Config::get("Security", 'urlChangeChars');

	if( ! empty($urlInjectionChangeChars) ) foreach( $urlInjectionChangeChars as $key => $val )
	{		
		$string = preg_replace(presuffix($key).'xi', $val, $string);
	}
	
	return $string;
	
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
	
	$logDir    = APPDIR.'Logs/';
	$extension = '.log';
	
	if( ! is_dir($logDir) )
	{
		Folder::create($logDir, 0644);	
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

	$message = "IP: ".ipv4()." | Subject: ".$subject.' | Date: '.date('d.m.Y h:i:s')." | Message: ".$message.eol();
	error_log($message, 3, $logDir.suffix($destination, $extension));
}

//----------------------------------------------------------------------------------------------------
// createHtaccessFile()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
//          																				  
//----------------------------------------------------------------------------------------------------
function createHtaccessFile()
{	
	// Cache.php ayar dosyasından ayarlar çekiliyor.
	$config = Config::get('Cache');
	$eol    = eol();
	
	//-----------------------GZIP-------------------------------------------------------------
	// mod_gzip = true ayarı yapılmışsa aşağıdaki kodları ekler.
	// Gzip ile ön bellekleme başlatılmış olur.
	if( $config['modGzip']['status'] === true ) 
	{
		$modGzip = '<ifModule mod_gzip.c>
mod_gzip_on Yes
mod_gzip_dechunk Yes
mod_gzip_item_include file .('.$config['modGzip']['includedFileExtension'].')$
mod_gzip_item_include handler ^cgi-script$
mod_gzip_item_include mime ^text/.*
mod_gzip_item_include mime ^application/x-javascript.*
mod_gzip_item_exclude mime ^image/.*
mod_gzip_item_exclude rspheader ^Content-Encoding:.*gzip.*
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
			$exp .= 'ExpiresByType '.$type.' "access plus '.$value.' seconds"'.$eol;
		}
		
		$modExpires = '<ifModule mod_expires.c>
ExpiresActive On
ExpiresDefault "access plus '.$config['modExpires']['defaultTime'].' seconds"
'.$exp.'
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
			$fmatch .= '<filesMatch "\.('.$type.')$">
Header set Cache-Control "max-age='.$value['time'].', '.$value['access'].'"
</filesMatch>'.$eol;
		}
		
		$modHeaders = '<ifModule mod_headers.c>
'.$fmatch.'
</ifModule>
'.$eol.$eol;
	}
	else
	{
		$modHeaders = '';
	}
	//-----------------------HEADERS----------------------------------------------------------
	
	//-----------------------HEADER SET-------------------------------------------------------
	$headerSet = Config::get("Headers");
	
	if( ! empty($headerSet['setHtaccessFile']) )
	{
		$headersIniSet  = "<ifModule mod_expires.c>".$eol;	
		
		foreach( $headerSet['iniSet'] as $val )
		{
			$headersIniSet .= "$val".$eol;
		}
		
		$headersIniSet .= "</ifModule>".$eol.$eol;
	}
	else
	{
		$headersIniSet = '';
	}
	//-----------------------HEADER SET-------------------------------------------------------
	
	//-----------------------HTACCESS SET-----------------------------------------------------	
	$htaccessSettings = Config::get("Htaccess");
	
	if( ! empty($htaccessSettings['setFile']) )
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
							$htaccessSettingsStr .= "$k $v".$eol;
						}
						else
						{
							$htaccessSettingsStr .= $v.$eol;
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
	$htaccess = $modGzip.$modExpires.$modHeaders.$headersIniSet.$htaccessSettingsStr;
	
	//-----------------------URI INDEX PHP----------------------------------------------------	
	if( ! Config::get('Uri','index.php') )
	{
		$htaccess .= "<IfModule mod_rewrite.c>".$eol;
		$htaccess .= "RewriteEngine On".$eol;
		$htaccess .= "RewriteBase /".$eol;
		$htaccess .= "RewriteCond %{REQUEST_FILENAME} !-f".$eol;
		$htaccess .= "RewriteCond %{REQUEST_FILENAME} !-d".$eol;
		$htaccess .= 'RewriteRule ^(.*)$  '.$_SERVER['SCRIPT_NAME'].Config::get('Uri','indexSuffix').'/$1 [L]'.$eol;
		$htaccess .= "</IfModule>".$eol;
	}
	//-----------------------URI INDEX PHP----------------------------------------------------
	
	//-----------------------UPLOAD SETTINGS--------------------------------------------------
	$uploadSet = Config::get('Upload');		
	
	if( ! empty($uploadSet['setHtaccessFile']) )
	{
		$uploadSettings = $uploadSet['settings'];
	}
	else
	{
		$uploadSettings = array();
	}
	//-----------------------UPLOAD SETTINGS--------------------------------------------------
	
	//-----------------------SESSION SETTINGS-------------------------------------------------
	$sessionSet = Config::get('Session');	
			
	if( ! empty($sessionSet['setHtaccessFile']) )
	{
		$sessionSettings = $sessionSet['settings'];
	}
	else
	{
		$sessionSettings = array();
	}
	//-----------------------SESSION SETTINGS-------------------------------------------------
	
	//-----------------------INI SETTINGS-----------------------------------------------------	
	$iniSet = Config::get('Ini');	
		
	if( ! empty($iniSet['setHtaccessFile']) )
	{
		$iniSettings = $iniSet['settings'];
	}
	else
	{
		$iniSettings = array();
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
				$sets .= "php_value $k $v".$eol;		 
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
		$getContents = file_get_contents('.htaccess');
	}
	else
	{
		$getContents = '';
	}
	// $htaccess değişkenin tuttuğu değer ile dosya içeri eşitse tekrar oluşturma
	if( trim($htaccess) === trim($getContents) ) 
	{
		return false;
	}
	
	if( ! file_put_contents('.htaccess', trim($htaccess)) )
	{
		Error::set('Error', 'fileNotWrite', '.htaccess');
	}
	
	unset( $htaccess );	
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
	if( Config::get('Uri','index.php') ) 
	{
		return 'index.php/'; 
	}
	else
	{ 
		return '';	
	}
}
//------------------------------------SYSTEM FUNCTIONS END--------------------------------------------