<?php 
//----------------------------------------------------------------------------------------------------
// ÖN YÜKLENEN SABİT VE FONKSİYONLAR 
//----------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Invalid PHP Version
//----------------------------------------------------------------------------------------------------
//
// Versiyon Kontrolü Yapılıyor.
//
//----------------------------------------------------------------------------------------------------
if( ! isPhpVersion('5.6.0') )
{	
	trace('Invalid PHP Version! Required PHP version ["5.6.0"] and should be over!');
}
//-----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// APPLICATIONS_DIR
//----------------------------------------------------------------------------------------------------
//
// @return Applications/
//
//----------------------------------------------------------------------------------------------------
define('APPLICATIONS_DIR', 'Applications/'); 

//----------------------------------------------------------------------------------------------------
// RESTORATIONS_DIR
//----------------------------------------------------------------------------------------------------
//
// @return Restorations/
//
//----------------------------------------------------------------------------------------------------
define('RESTORATIONS_DIR', 'Restorations/'); 

//----------------------------------------------------------------------------------------------------
// BASE_DIR
//----------------------------------------------------------------------------------------------------
//
// @return Uygulamanın bulunduğu dizinin yolu.
//
//----------------------------------------------------------------------------------------------------
$baseDir = explode(DIRECTORY_INDEX, $_SERVER['SCRIPT_NAME']);

if( isset($baseDir[0]) )
{
	define('BASE_DIR', $baseDir[0]);
}

//----------------------------------------------------------------------------------------------------
// URIAPPDIR
//----------------------------------------------------------------------------------------------------
//
// @return URIAPPDIR
//
//----------------------------------------------------------------------------------------------------
$currentPath = server('currentPath');

$internalDir = ( ! empty($currentPath) ? explode('/', ltrim($currentPath, '/'))[0] : ''); 

global $application;

$othersapp = $application['directory']['others'];

if( is_array($othersapp) )
{
	$internalDir = ! empty($othersapp[$internalDir]) ? $othersapp[$internalDir] : '';
}

if( ! empty($internalDir) && is_dir(APPLICATIONS_DIR.$internalDir) )
{
	define('URIAPPDIR', $internalDir);	
}

//----------------------------------------------------------------------------------------------------
// STATIC_ACCESS
//----------------------------------------------------------------------------------------------------
//
// @return Static
//
//----------------------------------------------------------------------------------------------------
define('STATIC_ACCESS', 'Internal');

//----------------------------------------------------------------------------------------------------
// HIERARCHY_DIR
//----------------------------------------------------------------------------------------------------
//
// @return Internal/Core/Hierarchy.php
//
//----------------------------------------------------------------------------------------------------
define('HIERARCHY_DIR', CORE_DIR.'Hierarchy.php');

//----------------------------------------------------------------------------------------------------
// EOL
//----------------------------------------------------------------------------------------------------
//
// @return \r\n
//
//----------------------------------------------------------------------------------------------------
define('EOL', PHP_EOL);	

//----------------------------------------------------------------------------------------------------
// CRLF
//----------------------------------------------------------------------------------------------------
//
// @return \r\n
//
//----------------------------------------------------------------------------------------------------
define('CRLF', "\r\n");	

//----------------------------------------------------------------------------------------------------
// CR
//----------------------------------------------------------------------------------------------------
//
// @return \r
//
//----------------------------------------------------------------------------------------------------
define('CR', "\r");	

//----------------------------------------------------------------------------------------------------
// LF
//----------------------------------------------------------------------------------------------------
//
// @return \n
//
//----------------------------------------------------------------------------------------------------
define('LF', "\n");	

//----------------------------------------------------------------------------------------------------
// LF
//----------------------------------------------------------------------------------------------------
//
// @return \t
//
//----------------------------------------------------------------------------------------------------
define('HT', "\t");	

//----------------------------------------------------------------------------------------------------
// FF
//----------------------------------------------------------------------------------------------------
//
// @return \f
//
//----------------------------------------------------------------------------------------------------
define('FF', "\f");	

//----------------------------------------------------------------------------------------------------
// isResmac()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Config/Repear.php dosyasında yer alan machines = [] dizisi içerisinde ip numarası veya
// numaralarının o anki modeminizin ip'si ile eşleşip eşleşmediğini kontrol eder. Böylece site içi
// tadilat yapılan bilgisayar ile diğer kullanıcı bilgisayarlarının ayırt edilmesi sağlanır.
// Parametreler: Yok.
// Dönen Değerler: O anki ip'ni girilen iplerden biri ile uyuşuyorsa true uyuşmuyorsa false değeri döner.
//
//----------------------------------------------------------------------------------------------------
function isResmac()
{
	global $application;

	$restorationIP = $application['restoration']['machinesIP'];
	
	if( APPMODE === 'restoration' )
	{
		$ipv4 = ipv4();
		
		if( is_array($restorationIP) )
		{
			$result = in_array($ipv4, $restorationIP);
		}
		elseif( $ipv4 == $restorationIP )
		{
			$result = true;
		}
		else 
		{
			$result = false;
		}
	}
	else
	{
		$result = false;	
	}
		
	return $result;
}

//----------------------------------------------------------------------------------------------------
// restorationPath()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Restorasyon durumu açıkça dizin verisini değiştirir.
// Parametreler: Yok.
// Dönen Değerler: O anki ip'ni girilen iplerden biri ile uyuşuyorsa true uyuşmuyorsa false değeri döner.
//
//----------------------------------------------------------------------------------------------------
function restorationPath($path = '')
{
	if( isResmac() === true )
	{
		$newPath = preg_replace('/^'.rtrim(APPDIR, '/').'/', rtrim(RESDIR, '/'), $path);
		
		if( file_exists($newPath) )
		{
			return $newPath;	
		}
		else
		{
			return $path;	
		}
	} 
	
	return $path;
}

//----------------------------------------------------------------------------------------------------
// isPhpVersion()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Parametrenin geçerli php sürümü olup olmadığını kontrol eder.
// Parametreler: $version => Geçerliliği kontrol edilecek veri.
// Dönen Değerler: Geçerli sürümse true değilse false değerleri döner.
//
//----------------------------------------------------------------------------------------------------
function isPhpVersion($version = '5.2.4')
{
	if( ! is_scalar($version) )
	{
		return false;
	}
	
	$version = (string)$version;
	
	if( version_compare(PHP_VERSION, $version, '>=') )
	{
		return true;
	}
	else
	{
		return false;
	}
}

//----------------------------------------------------------------------------------------------------
// isImport()
//----------------------------------------------------------------------------------------------------
// 
// İşlev: Bir dosyanın daha önce dahil edilip edilmediğini kontrol eder.
// Parametreler: $path = Kontrol edilecek dosya yolu.
// Dönen Değerler: Daha önce dahil edilmişse true edilmemiş ise false değeri döner.
//
//----------------------------------------------------------------------------------------------------
function isImport($path = '')
{	
	if( ! is_string($path) )
	{
		return false;
	}
	
	if( in_array( realpath(suffix($path, '.php')), get_required_files() ) ) 
	{
		return true;
	}
	else
	{ 
		return false;
	}
}

//----------------------------------------------------------------------------------------------------
// isUrl()
//----------------------------------------------------------------------------------------------------
// 
// İşlev: Parametre olarak girilen değerin url adresi olup olmadığını kontrol eder.
// Parametreler: $url = Kontrol edilecek url adresi.
// Dönen Değerler: Parametre url adresini ifade ediyorsa true etmiyorsa false değeri döner.
//
//----------------------------------------------------------------------------------------------------
function isUrl($url = '')
{
	if( ! is_string($url) ) 
	{
		return false;
	}
	
	if( ! preg_match('#^(\w+:)?//#i', $url) )
	{
		return false;
	}
	else
	{
		return true;
	}
}

//----------------------------------------------------------------------------------------------------
// isEmail()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Parametre olarak girilen değerin e-posta adresi olup olmadığını kontrol eder.
// Parametreler: $email = Kontrol edilecek e-posta adresi.
// Dönen Değerler: Parametre e-posta adresini ifade ediyorsa true etmiyorsa false değeri döner.
//
//----------------------------------------------------------------------------------------------------
function isEmail($email = '')
{
	if( ! is_string($email) ) 
	{
		return false;
	}
	
	if( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email) )
	{ 
		return false; 
	}
	else
	{ 
		return true;
	}
}

//----------------------------------------------------------------------------------------------------
// isChar()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Parametrenin metinsel veya sayılsal türde veri içerip içermediğini kontrol eder.
// Parametreler: Herhangi bir değer.
// Dönen Değerler: Parametre metinsel veya sayısal türde ise true, değilse false değeri döner.
//
//----------------------------------------------------------------------------------------------------
function isChar($str = NULL)
{
	if( is_string($str) || is_numeric($str) )
	{
		return true;
	}
	else
	{
		return false;
	}
}	

//----------------------------------------------------------------------------------------------------
// isRealNumeric()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Parametrenin string olmayan bir numerik veri olup olmadığını kontrol eder.
// Parametreler: Herhangi bir değer.
// Dönen Değerler: Parametre metinsel veya sayısal türde ise true, değilse false değeri döner.
//
//----------------------------------------------------------------------------------------------------
function isRealNumeric($num = 0)
{
	if( ! is_string($num) && is_numeric($num) )
	{
		return true;
	}
	else
	{
		return false;
	}
}

//----------------------------------------------------------------------------------------------------
// isDeclaredClass()
//----------------------------------------------------------------------------------------------------
//
// Bir sınıfın tanımlanıp tanımlanmadığını kontrol etmek için kullanılır.  
//
//----------------------------------------------------------------------------------------------------
function isDeclaredClass($class = '')
{
	if( ! is_string($class) )
	{
		return false;
	}
	
	if( in_array(strtolower($class), array_map('strtolower', get_declared_classes())) )
	{
		return true;	
	}
	else
	{
		return false;	
	}
}


//----------------------------------------------------------------------------------------------------
// isHash()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Parametrenin geçerli şifreleme algoritmalarından biri olup olmadığını kontrol eder.
// Parametreler: Herhangi bir değer.
// Dönen Değerler: Parametre geçerli algoritmalardan biri ise true, değilse false değeri döner.
//
//----------------------------------------------------------------------------------------------------
function isHash($type = '')
{
	if( ! is_string($type) )
	{
		return false;
	}
	
	if( in_array($type, hash_algos()) )
	{
		return true;
	}
	else
	{
		return false;
	}
}

//----------------------------------------------------------------------------------------------------
// isCharset()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Parametrenin geçerli karakter seti olup olmadığını kontrol eder.
// Parametreler: Geçerli karakter seti.
// Dönen Değerler: Parametre geçerli karakter seti ise true, değilse false değeri döner.
//
//----------------------------------------------------------------------------------------------------
function isCharset($charset = '')
{
	if( ! is_string($charset) )
	{
		return false;
	}
	
	if( array_search(strtolower($charset), array_map('strtolower', mb_list_encodings()), true) )
	{
		return true;
	}
	else
	{
		return false;
	}
}

//----------------------------------------------------------------------------------------------------
// is[]
//----------------------------------------------------------------------------------------------------
//
// İşlev: Parametrenin boş değil ve dizi olup olmadığını kontrol eder.
// Parametreler: Herhangi bir dizi.
// Dönen Değerler: Bool.
//
//----------------------------------------------------------------------------------------------------
function isArray($array = [])
{
	if( ! empty($array) && is_array($array) )
	{
		return true;
	}
	else
	{
		return false;
	}
}

//----------------------------------------------------------------------------------------------------
// charsetList()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Geçerli karakter seli listesini verir.
// Dönen Değerler: Karakter setlerini listeler.
//
//----------------------------------------------------------------------------------------------------
function charsetList()
{
	return mb_list_encodings();	
}

//----------------------------------------------------------------------------------------------------
// output()
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Düzenli çıktı oluşturmak için kullanılır. Özelikle dizi nesnelerinde	  
// dizi içeriğinin düzenli çıktısını almak için kullanılır.			  																				                                   							
//
//----------------------------------------------------------------------------------------------------
function output($data = '', $settings = [], $content = false)
{	
	// ----------------------------------------------------------------------------------------------
	// AYARLAR
	// ----------------------------------------------------------------------------------------------
	$textType 		= isset($settings['textType'])      ? $settings['textType']     : 'monospace, Tahoma, Arial';
	$textSize 		= isset($settings['textSize'])      ? $settings['textSize']     : '12px';	
	// ----------------------------------------------------------------------------------------------
	
	$globalStyle  = ' style="font-family:'.$textType.'; font-size:'.$textSize .';"';
	
	$output  = "<span$globalStyle>";
	$output .= _output($data, '', 0, $settings);
	$output .= "</span>";
	
	if( $content === false)
	{
		echo $output;
	}
	else
	{
		return $output;	
	}
}	
function _output($data = '', $tab = '', $start = 0, $settings = [])
{
	static $start;
	
	$lengthColor 	= isset($settings['lengthColor'])  	? $settings['lengthColor']  : 'grey';
	$keyColor 		= isset($settings['keyColor']) 		? $settings['keyColor']		: '#000';
	$typeColor 		= isset($settings['typeColor']) 	? $settings['typeColor']	: '#8C2300';
	$stringColor 	= isset($settings['stringColor']) 	? $settings['stringColor']	: 'red';
	$numericColor 	= isset($settings['numericColor']) 	? $settings['numericColor']	: 'green';
	
	$output = '';
	$eof 	= '<br>';
	$tab 	= str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $start);
	
	$lengthstyle = ' style="color:'.$lengthColor.'"';
	$keystyle 	 = ' style="color:'.$keyColor.'"';
	$typestyle   = ' style="color:'.$typeColor.'"';
	
	$vartype = 'array';
	
	if( is_object($data) )
	{
		$data = (array)$data;
		$vartype = 'object';
	}
	
	if( ! is_array($data) )
	{
		return $data.$eof;	
	}
	else
	{
		foreach($data as $k => $v)
		{
			if( is_object($v) )
			{
				$v = (array)$v;
				$vartype = 'object';
			}
			
			if( ! is_array($v) )
			{	
				$valstyle  = ' style="color:'.$numericColor.';"';	
				
				$type = gettype($v);
				
				if( $type === 'string' )
				{
					$v = "'".$v."'";	
					$valstyle = ' style="color:'.$stringColor.';"';
					
					$type = 'string';
				}
				elseif( $type === 'boolean' )
				{
					$v = ( $v === true )
						 ? 'true'
						 : 'false';
					
					$type = 'boolean';
				}
				
				$output .= "$tab<span$keystyle>$k</span> => <span$typestyle>$type</span> <span$valstyle>$v</span> <span$lengthstyle>( length = ".strlen($v)." )</span>,$eof";
			}
			else
			{
				$output .= "$tab<span$keystyle>$k</span> => <span$typestyle>$vartype</span> $eof $tab( $eof "._output($v, $tab, $start++)." $tab), ".$eof;	
				$start--;
			}
		}
	}
	
	return $output;
}	

//----------------------------------------------------------------------------------------------------
// write()
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Çıktı oluşturmak için kullanılır.			  					          
//															                             
// Parametreler: 2 parametresi vardır.                                              	      
// 1. mixed var @data => Ekrana yazdırılacak veri.									      
// 2. array var @vars => Yazdırılacak veri içine değişken değeri göndermek için kullanılır.
//          																				  
//----------------------------------------------------------------------------------------------------
function write($data = '', $vars = [])
{
	if( ! is_scalar($data) )
	{
		echo 'Not String!'; 
		return false;
	}

	if( ! empty($data) && is_array($vars) )
	{
		$varsArray = [];
		
		foreach( $vars as $k => $v )
		{
			$varsArray['{'.$k.'}']	= $v;
		}
		
		$data = str_replace(array_keys($varsArray), array_values($varsArray), $data);
	}
	
	echo $data;
}

//----------------------------------------------------------------------------------------------------
// writeLine()
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Çıktı oluşturmak için kullanılır.	Write() yönteminde farkı çıktıdan	  
// sonra bir alt satıra geçer.								  					          														                              
//          																				  
//----------------------------------------------------------------------------------------------------
function writeLine($data = '', $vars = [], $brCount = 1)
{
	echo write($data, $vars).str_repeat("<br>", $brCount);
}


//----------------------------------------------------------------------------------------------------
// compare()
//----------------------------------------------------------------------------------------------------
//
// İşlev: İki veri arasında karşılaştırma yapmak için kullanılır.
// Parametreler: @p1 , @operator , $p2.
// Dönen Değerler: Karşılaştırma sağlanıyorsa true sağlanmıyorsa false değeri döner.
//          																				  
//----------------------------------------------------------------------------------------------------
function compare($p1 = '', $operator = '=', $p2 = '')
{
	if( ! ( is_scalar($p1) || is_scalar($p2) || is_string($operator) ) )
	{
		return false;
	}
	
	return version_compare($p1, $p2, $operator);
}

//----------------------------------------------------------------------------------------------------
// EOL
//----------------------------------------------------------------------------------------------------
//
// İşlev: Farklı işletim sistemlerine göre satır sonunu ifade eder.
// Dönen Değerler: \n\r, \r veya \n.
//          																				  
//----------------------------------------------------------------------------------------------------
function eol($repeat = 1)
{
	return str_repeat(EOL, $repeat);
}

//----------------------------------------------------------------------------------------------------
// getOS()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Mevcut işletim sisteminin türünü verir.
// Dönen Değerler: WIN, MAC, LINUX ya da UNKNOWN
//          																				  
//----------------------------------------------------------------------------------------------------
function getOS()
{
	if( stristr(PHP_OS, 'WIN') ) 
	{
        return 'WIN';        
    }
    elseif( stristr(PHP_OS, 'MAC') )
	{
        return 'MAC';
	}
	elseif( stristr(PHP_OS, 'LINUX') )
	{
        return 'LINUX';
	}
	else
	{
		return 'UNKNOWN';
	}
}

//----------------------------------------------------------------------------------------------------
// suffix()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Parametre olarak girilen değerlerin sonuna ek koymak için kullanılır.
// Parametreler: $string = Son ek koyulmak istenen ifade, $fix = koyulacak son ek.
// Dönen Değerler: $string parametresi boş ise false değeri boş değil ise metinsel ifade
// sonuna son ek eklenmiş yeni değeri döner eğer metinsel ifadenin sonundaki karakter ile
// son ek eklenecek karakter aynı ise yeniden herhangi bir ekleme işlemi gerçekleşmez.
//          																				  
//----------------------------------------------------------------------------------------------------
function suffix($string = '', $fix = '/')
{
	if( ! is_scalar($string) ) 
	{
		return false;
	}
	
	if( ! is_string($fix) )
	{
		$fix = '/';
	}

	if( strlen($fix) <= strlen($string) )
	{
		$suffix = substr($string, -strlen($fix));
		
		if( $suffix !== $fix)
		{
			$string = $string.$fix;
		}
	}
	else
	{
		$string = $string.$fix;	
	}
	
	if( $string === '/' )
	{
		return false;	
	}
	
	return $string;
}

//----------------------------------------------------------------------------------------------------
// prefix()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Parametre olarak girilen değerlerin başına ek koymak için kullanılır.
// Parametreler: $string = Ön ek koyulmak istenen ifade, $fix = koyulacak son ek.
// Dönen Değerler: $string parametresi boş ise false değeri boş değil ise metinsel ifade
// başına ön ek eklenmiş yeni değeri döner eğer metinsel ifadenin başındaki karakter ile
// ön ek eklenecek karakter aynı ise yeniden herhangi bir ekleme işlemi gerçekleşmez.
//          																				  
//----------------------------------------------------------------------------------------------------
function prefix($string = '', $fix = '/')
{
	if( ! is_scalar($string) )
	{
		return false;
	}
	
	if( ! is_string($fix) ) 
	{
		$fix = '/';
	}
	
	if( strlen($fix) <= strlen($string) )
	{	
		$prefix = substr($string, 0, strlen($fix));
	
		if( $prefix !== $fix )
		{
			$string = $fix.$string;
		}
	}
	else
	{
		$string = $fix.$string;	
	}
	
	if( $string === '/' )
	{
		return false;	
	}
	
	return $string;
}

//----------------------------------------------------------------------------------------------------
// presuffix()
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Metnin başına ve sonuna ek koymak için oluşturulmuştur.				 
//          																				  
//----------------------------------------------------------------------------------------------------
function presuffix($string = '', $fix = '/')
{
	return suffix(prefix($string, $fix), $fix);
}

//----------------------------------------------------------------------------------------------------
// host()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sitenin bulunduğu hostun adını verir.
// Dönen Değerler: sunucuadi
//          																				  
//----------------------------------------------------------------------------------------------------
function host() 
{
	if( isset($_SERVER['HTTP_X_FORWARDED_HOST']) )
	{
		$host =	$_SERVER['HTTP_X_FORWARDED_HOST'];
		
		$elements = explode(',', $host);

		$host = trim(end($elements));
	}
	else
	{
		if( isset($_SERVER['HTTP_HOST']) )
		{
			$host = $_SERVER['HTTP_HOST'];
		}
		else
		{
			if( isset($_SERVER['SERVER_NAME']) )
			{
				$host = $_SERVER['SERVER_NAME'];
			}
			else
			{
				$host = ! empty($_SERVER['SERVER_ADDR']) 
						? $_SERVER['SERVER_ADDR'] 
						: '';	
			}
		}
	}
		
	return trim($host);
}

//----------------------------------------------------------------------------------------------------
// hostName()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sitenin bulunduğu hostun adını verir.
// Dönen Değerler: sunucuadi
//          																				  
//----------------------------------------------------------------------------------------------------
function hostName() 
{
	return host();
}
//----------------------------------------------------------------------------------------------------
// pathInfos()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Dosya hakkında uzantı dizin adı dosya adı gibi ayrıntılar hakkında bilgi verir.
// Parametreler: $file = dosya yolu, $info = basename, dirname, filename, extension
// Dönen Değerler: Dosya hakkında bilgi.
//          																				  
//----------------------------------------------------------------------------------------------------
function pathInfos($file = "", $info = "basename")
{
	if( ! is_string($file) ) 
	{
		return false;
	}
	
	if( ! is_string($info) )
	{
		$info = "basename";
	}
	
	if( ! empty($file) )
	{
		$pathInfo = pathinfo($file);
		
		if( isset($pathInfo[$info]) )
		{
			return $pathInfo[$info];
		}
		else
		{ 
			return false;
		}
	}
	else
	{
		return false;	
	}
}

//----------------------------------------------------------------------------------------------------
// extension()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Dosya uzantısını öğrenmek için kullanılır.
// Parametreler: $file = dosya yolu, $dote = true olması durumunda uzantının başına nokta koyar.
// Dönen Değerler: Dosyanın uzantısı.  $dote = true: .php , $dote = false: php 
//          																				  
//----------------------------------------------------------------------------------------------------
function extension($file = '', $dote = false)
{
	if( ! is_string($file) ) 
	{
		return false;
	}
	
	if( ! is_bool($dote) )
	{
		$dote = false;
	}
	
	$dote = $dote === true 
		  ? '.'
		  : '';
	
	return $dote.strtolower(pathInfos($file, "extension"));
}

//----------------------------------------------------------------------------------------------------
// removeExtension()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Metinsel dosya isimlerinde yer alan uzantıları kaldırmak için kullanılır.
// Dönen Değerler: Uzantısı kaldırılmış dosya adı.
//          																				  
//----------------------------------------------------------------------------------------------------
function removeExtension($file = '')
{
	if( ! is_string($file) ) 
	{
		return false;
	}
	
	return preg_replace('/\\.[^.\\s]{3,4}$/', '', $file);
}

//----------------------------------------------------------------------------------------------------
// divide()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Metinsel ifadeyi parçalar ve istenilen elamanına ulaşılmasını sağlar.
// Parametreler: $str = Parçalanacak metinsel ifade, $seperator = Metnin parçalara ayrılacağı karakter
// $index = kaçıncı parça.
// Dönen Değerler: indeks numarasına göre parça değer döndürür.
//          																				  
//----------------------------------------------------------------------------------------------------
function divide($str = '', $seperator = "|", $index = 0)
{
	if( ! is_string($str ))
	{
		return false;
	}
	if( ! is_string($seperator) || empty($seperator) ) 
	{
		$seperator = "|";
	}
	
	if( ! is_scalar($index) ) 
	{
		$index = 0;
	}
	
	$arrayEx = explode($seperator, $str);
	
	if( $index === 'all' )
	{
		return $arrayEx;
	}
	
	if( $index < 0 )
	{
 		$ind = (count($arrayEx)+($index));
	}
	elseif( $index === 'last' )
	{
		$ind = (count($arrayEx) - 1);
	}
	elseif( $index === 'first' )
	{
		$ind = 0;
	}
	else
	{
		$ind = $index;
	}
	
	if( isset($arrayEx[$ind]) )
	{
		return $arrayEx[$ind];
	}
	else
	{
		return false;
	}
}


//----------------------------------------------------------------------------------------------------
// ipv4()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Kullanıcı iplerini verir.
// Parametreler: Yok.
// Dönen Değerler: IP değeri.
//          																				  
//----------------------------------------------------------------------------------------------------
function ipv4()
{
	if( isset($_SERVER['HTTP_CLIENT_IP']) ) 
	{
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}
	elseif( isset($_SERVER['HTTP_X_FORWARDED_FOR']) ) 
	{
		$ip = divide($_SERVER['HTTP_X_FORWARDED_FOR'], ',');
	}
	else
	{
	  	$ip = $_SERVER['REMOTE_ADDR'];
	}
 
	if( $ip === '::1')
 	{
		$ip = '127.0.0.1';	
	}
	
	return $ip;
}

//----------------------------------------------------------------------------------------------------
// server()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Server bilgilerine ulaşmak için kullanılır.
// Parametreler: $type = istenilen server komut türü.
// Dönen Değerler: Server komut türüne göre sunucu bilgisi.
//          																				  
//----------------------------------------------------------------------------------------------------
function server($type = '')
{
	if( ! is_string($type) ) 
	{
		return false;
	}
	
	$server = array
	(
		''							 => $_SERVER,
		'name' 						 => (isset($_SERVER['SERVER_NAME'])) 			? $_SERVER['SERVER_NAME'] 			: false,
		'admin'						 => (isset($_SERVER['SERVER_ADMIN'])) 			? $_SERVER['SERVER_ADMIN'] 			: false,
		'protocol'					 => (isset($_SERVER['SERVER_PROTOCOL'])) 		? $_SERVER['SERVER_PROTOCOL'] 		: false,
		'signature'			 	     => (isset($_SERVER['SERVER_SIGNATURE'])) 		? $_SERVER['SERVER_SIGNATURE'] 		: false,
		'software'					 => (isset($_SERVER['SERVER_SOFTWARE'])) 		? $_SERVER['SERVER_SOFTWARE'] 		: false,		
		'remoteAddr'				 => (isset($_SERVER['REMOTE_ADDR'])) 			? $_SERVER['REMOTE_ADDR'] 			: false,
		'remotePort'				 => (isset($_SERVER['REMOTE_PORT'])) 			? $_SERVER['REMOTE_PORT'] 			: false,	
		'requestMethod'			 	 => (isset($_SERVER['REQUEST_METHOD'] )) 		? $_SERVER['REQUEST_METHOD'] 		: false,
		'requestUri'				 => (isset($_SERVER['REQUEST_URI'])) 			? $_SERVER['REQUEST_URI'] 			: false,
		'requestScheme'			 	 => (isset($_SERVER['REQUEST_SCHEME'])) 		? $_SERVER['REQUEST_SCHEME'] 		: false,
		'requestTime'				 => (isset($_SERVER['REQUEST_TIME'])) 			? $_SERVER['REQUEST_TIME'] 			: false,
		'requestTimeFloat'		 	 => (isset($_SERVER['REQUEST_TIME_FLOAT'])) 	? $_SERVER['REQUEST_TIME_FLOAT'] 	: false,
		'accept'					 => (isset($_SERVER['HTTP_ACCEPT'])) 			? $_SERVER['HTTP_ACCEPT'] 			: false,
		'acceptCharset'			 	 => (isset($_SERVER['HTTP_ACCEPT_CHARSET'])) 	? $_SERVER['HTTP_ACCEPT_CHARSET'] 	: false,
		'acceptEncoding'			 => (isset($_SERVER['HTTP_ACCEPT_ENCODING'])) 	? $_SERVER['HTTP_ACCEPT_ENCODING'] 	: false,
		'acceptLanguage'			 => (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) 	? $_SERVER['HTTP_ACCEPT_LANGUAGE'] 	: false,
		'clientIp'			 		 => (isset($_SERVER['HTTP_CLIENT_IP'])) 		? $_SERVER['HTTP_CLIENT_IP'] 		: false,
		'xForwardedHost'			 => (isset($_SERVER['HTTP_X_FORWARDED_HOST'])) 	? $_SERVER['HTTP_X_FORWARDED_HOST'] : false,
		'xForwardedFor'				 => (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) 	? $_SERVER['HTTP_X_FORWARDED_FOR'] 	: false,
		'xOriginalUrl'		 		 => (isset($_SERVER['HTTP_X_ORIGINAL_URL'])) 	? $_SERVER['HTTP_X_ORIGINAL_URL'] 	: false,
		'xRequestedWith'		 	 => (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) 	? $_SERVER['HTTP_X_REQUESTED_WITH'] : false,
		'connection'				 => (isset($_SERVER['HTTP_CONNECTION'])) 		? $_SERVER['HTTP_CONNECTION'] 		: false,
		'host'						 => (isset($_SERVER['HTTP_HOST'])) 				? $_SERVER['HTTP_HOST'] 			: false,
		'referer'					 => (isset($_SERVER['HTTP_REFERER'])) 			? $_SERVER['HTTP_REFERER'] 			: false,
		'userAgent'				 	 => (isset($_SERVER['HTTP_USER_AGENT'])) 		? $_SERVER['HTTP_USER_AGENT'] 		: false,
		'cookie'					 => (isset($_SERVER['HTTP_COOKIE'])) 			? $_SERVER['HTTP_COOKIE'] 			: false,
		'cacheControl'				 => (isset($_SERVER['HTTP_CACHE_CONTROL'])) 	? $_SERVER['HTTP_CACHE_CONTROL'] 	: false,
		'https'					 	 => (isset($_SERVER['HTTPS'])) 					? $_SERVER['HTTPS'] 				: false,
		'scriptFileName'			 => (isset($_SERVER['SCRIPT_FILENAME'])) 		? $_SERVER['SCRIPT_FILENAME'] 		: false,
		'scriptName'				 => (isset($_SERVER['SCRIPT_NAME'])) 			? $_SERVER['SCRIPT_NAME'] 			: false,
		'path'						 => (isset($_SERVER['PATH'])) 					? $_SERVER['PATH'] 					: false,
		'pathInfo'					 => (isset($_SERVER['PATH_INFO'])) 				? $_SERVER['PATH_INFO'] 			: false,
		'currentPath'				 => (isset($_SERVER['PATH_INFO'])) 				? $_SERVER['PATH_INFO'] 			: $_SERVER['QUERY_STRING'],
		'pathTranslated'			 => (isset($_SERVER['PATH_TRANSLATED'])) 		? $_SERVER['PATH_TRANSLATED'] 		: false,
		'pathext'					 => (isset($_SERVER['PATHEXT'])) 				? $_SERVER['PATHEXT'] 				: false,
		'redirectQueryString'		 => (isset($_SERVER['REDIRECT_QUERY_STRING'])) 	? $_SERVER['REDIRECT_QUERY_STRING'] : false,
		'redirectUrl'				 => (isset($_SERVER['REDIRECT_URL'])) 			? $_SERVER['REDIRECT_URL'] 			: false,
		'redirectStatus'			 => (isset($_SERVER['REDIRECT_STATUS'])) 		? $_SERVER['REDIRECT_STATUS'] 		: false,
		'phpSelf'					 => (isset($_SERVER['PHP_SELF'])) 				? $_SERVER['PHP_SELF'] 				: false,
		'queryString'				 => (isset($_SERVER['QUERY_STRING'])) 			? $_SERVER['QUERY_STRING'] 			: false,	
		'documentRoot' 			 	 => (isset($_SERVER['DOCUMENT_ROOT'])) 			? $_SERVER['DOCUMENT_ROOT'] 		: false,							
		'windir'					 => (isset($_SERVER['WINDIR'])) 				? $_SERVER['WINDIR'] 				: false,
		'comspec'					 => (isset($_SERVER['COMSPEC'])) 				? $_SERVER['COMSPEC'] 				: false,
		'systemRoot'				 => (isset($_SERVER['SystemRoot'])) 			? $_SERVER['SystemRoot'] 			: false,
		'gatewayInterface'			 => (isset($_SERVER['GATEWAY_INTERFACE'])) 		? $_SERVER['GATEWAY_INTERFACE'] 	: false			
	);	
	
	if( isset($server[$type]) )
	{
		if( is_array($server[$type]) )
		{
			return $server[$type];	
		}
		else
		{
			return htmlspecialchars($server[$type], ENT_QUOTES, "utf-8");
		}
	}
	elseif( isset($_SERVER[$type]) )
	{
		return htmlspecialchars($_SERVER[$type], ENT_QUOTES, "utf-8");
	}
	
	return false;
}	

//----------------------------------------------------------------------------------------------------
// errorReport()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
//          																				  
//----------------------------------------------------------------------------------------------------
function errorReport($type = NULL)
{	
	$result = error_get_last();
	
	if( $type === NULL )
	{
		return $result;
	}
	else
	{
		if( isset($result[$type]) )
		{
			return $result[$type];
		}
		else
		{
			return false;
		}
	}
}

//----------------------------------------------------------------------------------------------------
// internalApplicationContainerDir()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
//          																				  
//----------------------------------------------------------------------------------------------------
function internalApplicationContainerDir()
{
	global $application;
	
	$containers = $application['containers'];
	
	if( ! empty($containers) && defined('URIAPPDIR') )
	{
		return ! empty($containers[URIAPPDIR])
			   ? APPLICATIONS_DIR.suffix($containers[URIAPPDIR])
			   : APPDIR;
	}
	
	return APPDIR;
}

//----------------------------------------------------------------------------------------------------
// Application Mode
//----------------------------------------------------------------------------------------------------
//
// @param string $mode: publication, development, restoration
//
//----------------------------------------------------------------------------------------------------
function internalApplicationMode($mode)
{
	//------------------------------------------------------------------------------------------------
	// Kullanılabilir Uygulama Seçenekleri
	//------------------------------------------------------------------------------------------------
	switch( strtolower($mode) )
	{ 
		//--------------------------------------------------------------------------------------------
		// Publication Yayın Modu
		// Tüm hatalar kapalıdır.
		// Projenin tamamlanmasından sonra bu modun kullanılması önerilir.
		//--------------------------------------------------------------------------------------------
		case 'publication' :
			error_reporting(0); 
		break;
		//--------------------------------------------------------------------------------------------
		
		//-------------------------------------------------------------------------------------------*
		// Restoration Onarım Modu
		// Hataların görünümü görecelidir.
		//--------------------------------------------------------------------------------------------
		case 'restoration' :
		//--------------------------------------------------------------------------------------------
		// Development Geliştirme Modu
		// Tüm hatalar açıktır.
		//--------------------------------------------------------------------------------------------
		case 'development' : 
			error_reporting(-1);
		break; 
		//--------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------
		// Farklı bir kullanım hatası
		//--------------------------------------------------------------------------------------------
		default: trace('Invalid Application Mode! Available Options: ["development"], ["restoration"] or ["publication"]');
		//--------------------------------------------------------------------------------------------
	}	
	//------------------------------------------------------------------------------------------------	
}

//----------------------------------------------------------------------------------------------------
// trace()
//----------------------------------------------------------------------------------------------------
//
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
//          																				  
//----------------------------------------------------------------------------------------------------
function trace($message = '', $keys = [])
{
	$style  = 'border:solid 1px #E1E4E5;';
	$style .= 'background:#FEFEFE;';
	$style .= 'padding:10px;';
	$style .= 'margin-bottom:10px;';
	$style .= 'font-family:Calibri, Ebrima, Century Gothic, Consolas, Courier New, Courier, monospace, Tahoma, Arial;';
	$style .= 'color:#666;';
	$style .= 'text-align:left;';
	$style .= 'font-size:14px;';
	
	$message = preg_replace('/\[(.*?)\]/', '<span style="color:#990000;">$1</span>', $message);
	
	$str  = "<div style=\"$style\">";
	$str .= $message;
	$str .= '</div>';
	
	exit(write($str, $keys));
}