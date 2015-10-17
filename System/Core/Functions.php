<?php 
/************************************************************/
/*                   	SYSTEM FUNCTIONS                    */
/************************************************************/
/*
/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
/* Site: www.zntr.net
/* Lisans: The MIT License
/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
*/

//------------------------------------SYSTEM AND USER FUNCTIONS START-----------------------------------------------------------------

// Function: isPhpVersion()
// İşlev: Parametrenin geçerli php sürümü olup olmadığını kontrol eder.
// Parametreler: $version => Geçerliliği kontrol edilecek veri.
// Dönen Değerler: Geçerli sürümse true değilse false değerleri döner.

function isPhpVersion($version = '5.2.4')
{
	if( ! isValue($version) )
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

// Function: undefined()
// İşlev: Parametrenin değer alıp almadığını kontrol eder.
// Parametreler: $str = Herhangi bir değer.
// Dönen Değerler: değer almışsa false almamış ise true değeri döner.

function undefined($str = NULL)
{
	if( isset($str) )
	{
		return false;
	}
	else
	{
		return true;
	}
}

// Function: isDefined()
// İşlev: Parametrenin değer alıp almadığını kontrol eder.
// Parametreler: $str = Herhangi bir değer.
// Dönen Değerler: değer almışsa true almamış ise false  değeri döner.

function isDefined($str = NULL)
{
	if( isset($str) )
	{
		return true;
	}
	else
	{
		return false;
	}
}

// Function: isImport()
// İşlev: Bir dosyanın daha önce dahil edilip edilmediğini kontrol eder.
// Parametreler: $path = Kontrol edilecek dosya yolu.
// Dönen Değerler: Daha önce dahil edilmişse true edilmemiş ise false değeri döner.

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

// Function: isFileExists()
// İşlev: Parametre olarak girilen değerin dosya olup olmadığını dosya ise var olup olmadığını kontrol eder.
// Parametreler: $file = Kontrol edilecek dosya yolu.
// Dönen Değerler: Parametre dosya yolunu ifade ediyor ve böyle bir dosya var ise true bu şartlara uymuyorsa false değeri döner.

function isFileExists($file = '')
{
	if( ! is_string($file) ) 
	{
		return false;
	}
	
	if( isUrl($file) )
	{
		$file = trim(str_replace(baseUrl(), '', $file));
	}
	
	if( ! is_file($file) )
	{
		return false;
	}
	
	if( file_exists($file) ) 
	{
		return true; 
	}
	else
	{ 
		return false;
	}
}

// Function: isDirExists()
// İşlev: Parametre olarak girilen değerin dizin olup olmadığını dizin ise var olup olmadığını kontrol eder.
// Parametreler: $dir = Kontrol edilecek dosya yolu.
// Dönen Değerler: Parametre dizin yolunu ifade ediyor ve böyle bir dizin var ise true bu şartlara uymuyorsa false değeri döner.

function isDirExists($dir = '')
{
	if( ! is_string($dir) ) 
	{
		return false;
	}
	
	if( isUrl($dir) )
	{
		$dir = trim(str_replace(baseUrl(), '', $dir));
	}
	
	if( ! is_dir($dir) )
	{
		return false;
	}
	
	if( file_exists($dir) ) 
	{
		return true; 
	}
	else
	{ 
		return false;
	}
}

// Function: isUrl()
// İşlev: Parametre olarak girilen değerin url adresi olup olmadığını kontrol eder.
// Parametreler: $url = Kontrol edilecek url adresi.
// Dönen Değerler: Parametre url adresini ifade ediyorsa true etmiyorsa false değeri döner.

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

// Function: isEmail()
// İşlev: Parametre olarak girilen değerin e-posta adresi olup olmadığını kontrol eder.
// Parametreler: $email = Kontrol edilecek e-posta adresi.
// Dönen Değerler: Parametre e-posta adresini ifade ediyorsa true etmiyorsa false değeri döner.

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

// Function: isRepmac()
// İşlev: Config/Repear.php dosyasında yer alan machines = array() dizisi içerisinde ip numarası veya
// numaralarının o anki modeminizin ip'si ile eşleşip eşleşmediğini kontrol eder. Böylece site içi
// tadilat yapılan bilgisayar ile diğer kullanıcı bilgisayarlarının ayırt edilmesi sağlanır.
// Parametreler: Yok.
// Dönen Değerler: O anki ip'ni girilen iplerden biri ile uyuşuyorsa true uyuşmuyorsa false değeri döner.

function isRepmac()
{
	if( is_array(Config::get('Repair','machines')) )
	{
		$result = in_array(ipv4(), Config::get('Repair','machines'));
	}
	elseif( ipv4() == Config::get('Repair','machines') )
	{
		$result = true;
	}
	else 
	{
		$result = false;
	}
	
	return $result;
}

// Function: isValue()
// İşlev: Parametrenin metinsel, sayılsal veya boolean türde veri içerip içermediğini kontrol eder.
// Parametreler: Herhangi bir değer.
// Dönen Değerler: Parametre metinsel, sayısal veya bollean türde ise true, değilse false değeri döner.

function isValue($str = NULL)
{
	if( is_string($str) || is_numeric($str) || is_bool($str) )
	{
		return true;
	}
	else
	{
		return false;
	}
}	

// Function: isChar()
// İşlev: Parametrenin metinsel veya sayılsal türde veri içerip içermediğini kontrol eder.
// Parametreler: Herhangi bir değer.
// Dönen Değerler: Parametre metinsel veya sayısal türde ise true, değilse false değeri döner.

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

// Function: isRealNumeric()
// İşlev: Parametrenin string olmayan bir numerik veri olup olmadığını kontrol eder.
// Parametreler: Herhangi bir değer.
// Dönen Değerler: Parametre metinsel veya sayısal türde ise true, değilse false değeri döner.

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

/******************************************************************************************
* IS DECLARED CLASS - DAHİL EDİLDİĞİ SÜRÜM:1.5                                            *
*******************************************************************************************
| Genel Kullanım: Bir sınıfın tanımlanıp tanımlanmadığını kontrol etmek için kullanılır.  | 
|          																				  |
******************************************************************************************/
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

// Function: isHash()
// İşlev: Parametrenin geçerli şifreleme algoritmalarından biri olup olmadığını kontrol eder.
// Parametreler: Herhangi bir değer.
// Dönen Değerler: Parametre geçerli algoritmalardan biri ise true, değilse false değeri döner.
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

// Function: isCharset()
// İşlev: Parametrenin geçerli karakter seti olup olmadığını kontrol eder.
// Parametreler: Geçerli karakter seti.
// Dönen Değerler: Parametre geçerli karakter seti ise true, değilse false değeri döner.

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

// Function: charsetList()
// İşlev: Geçerli karakter seli listesini verir.
// Dönen Değerler: Karakter setlerini listeler.
function charsetList()
{
	return mb_list_encodings();	
}

/******************************************************************************************
* OUTPUT - DAHİL EDİLDİĞİ SÜRÜM:1.4                                                       *
*******************************************************************************************
| Genel Kullanım: Düzenli çıktı oluşturmak için kullanılır. Özelikle dizi nesnelerinde	  |
| dizi içeriğinin düzenli çıktısını almak için kullanılır.			  					  |
|															                              |
| Parametreler: Tek parametresi vardır.                                              	  |
| 1. mixed var @data => Çıktısı oluşturulacak nesne.									  |
|          																				  |
| Örnek Kullanım: output(array(1,2,3));        							  	  			  |
|          																				  |
******************************************************************************************/
function output($data = '', $settings = array(), $display = true)
{
	if( ! is_array($settings) )
	{
		return false;	
	}
	
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
	
	if( $display === true)
	{
		echo $output;
	}
	else
	{
		return $output;	
	}
}	
function _output($data = '', $tab = '', $start = 0, $settings = array())
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

/******************************************************************************************
* WRITE - DAHİL EDİLDİĞİ SÜRÜM:1.4                                                        *
*******************************************************************************************
| Genel Kullanım: Çıktı oluşturmak için kullanılır.			  					          |
|															                              |
| Parametreler: 2 parametresi vardır.                                              	      |
| 1. mixed var @data => Ekrana yazdırılacak veri.									      |
| 2. array var @vars => Yazdırılacak veri içine değişken değeri göndermek için kullanılır.|
|          																				  |
| Örnek Kullanım: write('Merhaba {0}', array('Dünya')); // Merhaba Dünya       			  |
| Örnek Kullanım: write('Merhaba {x}', array('x' => 'Dünya')); // Merhaba Dünya       	  |
|          																				  |
******************************************************************************************/
function write($data = '', $vars = array())
{
	if( ! isValue($data) )
	{
		echo 'Not String!'; 
		return false;
	}

	if( ! empty($data) && is_array($vars) )
	{
		$varsArray = array();
		
		foreach( $vars as $k => $v )
		{
			$varsArray['{'.$k.'}']	= $v;
		}
		
		$data = str_replace(array_keys($varsArray), array_values($varsArray), $data);
	}
	
	echo $data;
}

/******************************************************************************************
* WRITELN - DAHİL EDİLDİĞİ SÜRÜM:1.4                                                      *
*******************************************************************************************
| Genel Kullanım: Çıktı oluşturmak için kullanılır.	Write() yönteminde farkı çıktıdan	  | 
| sonra bir alt satıra geçer.								  					          |
|															                              |
| Parametreler: 3 parametresi vardır.                                              	      |
| 1. mixed var @data => Ekrana yazdırılacak veri.									      |
| 2. array var @vars => Yazdırılacak veri içine değişken değeri göndermek için kullanılır.|
| 3. numeric var @br_count => Kaç adet alt satır bırakılacağı. Varsayılan:1				  |
|          																				  |
| Örnek Kullanım: writeLine('Merhaba {0}', array('Dünya')); // Merhaba Dünya       		  |
| Örnek Kullanım: writeLine('Merhaba {x}', array('x' => 'Dünya')); // Merhaba Dünya         |
|          																				  |
******************************************************************************************/
function writeLine($data = '', $vars = array(), $brCount = 1)
{
	echo write($data, $vars).str_repeat("<br>", $brCount);
}

// Function: compare()
// İşlev: İki veri arasında karşılaştırma yapmak için kullanılır.
// Parametreler: @p1 , @operator , $p2.
// Dönen Değerler: Karşılaştırma sağlanıyorsa true sağlanmıyorsa false değeri döner.
function compare($p1 = '', $operator = '=', $p2 = '')
{
	if( ! ( isValue($p1) || isValue($p2) || is_string($operator) ) )
	{
		return false;
	}
	
	return version_compare($p1, $p2, $operator);
}

// Function: eol()
// İşlev: Farklı işletim sistemlerine göre satır sonunu ifade eder.
// Dönen Değerler: \n\r, \r veya \n.

function eol($repeat = 1)
{
	if ( strtoupper(substr(PHP_OS,0,3)) === 'WIN' ) 
	{
        $eol = "\r\n";        
    }
    elseif ( strtoupper(substr(PHP_OS,0,3)) === 'MAC')
	{
        $eol = "\r";
	}
	else
	{
        $eol = "\n";
	}
	
	return str_repeat($eol, $repeat);
}

// Function: getLang()
// İşlev: Sitenin aktif dilinin ne olduğu bilgisini verir.
// Parametreler: Yok.
// Dönen Değerler: Herhangi bir dil set edilmişse o dilin değeri edilmemişse varsayılan tr değeri döner.

function getLang()
{
	if( ! isset($_SESSION) ) 
	{
		session_start();
	}
	
	if( ! isset($_SESSION[md5("lang")]) ) 
	{
		return $_SESSION[md5("lang")] = Config::get('Language', 'default');
	}
	else
	{ 
		return $_SESSION[md5("lang")];
	}
}

// Function: setLang()
// İşlev: Sitenin aktif dilini ayarlamak için kullanılır.
// Parametreler: $l = değiştirilecek dilin kısaltması. Varsayılan tr değeridir.
// Dönen Değerler: Herhangi bir değer döndürmez set edilen değeri öğrenmek için gel_lang() yöntemi kullanılır.

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
	
	if( ! isset($_SESSION) ) 
	{
		session_start();
	}
	
	$_SESSION[md5("lang")] = $l;
}

/******************************************************************************************
* LANG FUNCTION                                                                           *
*******************************************************************************************
| Genel Kullanım: Dahil edilen dil dosyalarına ait verileri kullanma işlevini üstlenir.	  |
|																						  |
| Parametreler																			  |
| @str = Dil dosyası içerisinde anahtar ifade.											  |
| @changed = Dil dosyası içerisinde karakteri istenilen karakter ile değiştirmek. 		  |
| Örnek: % ibaresi yerine 'abc'															  |
|																						  |
******************************************************************************************/
function lang($file = '', $str = '', $changed = '')
{
	// Parametreler kontrol ediliyor.		
	if( ! is_string($file) || ! is_string($str) ) 
	{
		return false;
	}
	
	$key 		= removeExtension($file, 'php');
	$file 		= Config::get('Language', getLang()).'/'.suffix($file, '.php');
	$langDir    = LANGUAGES_DIR.$file ;
	$sysLangDir = SYSTEM_LANGUAGES_DIR.$file;
	
	global $lang;
	
	if( isFileExists($langDir) ) 
	{
		require_once($langDir);	
	}
	elseif( isFileExists($sysLangDir) )
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
	elseif(isset($lang[$key]) && empty($str) )
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
			
			foreach($changed as $key => $value)
			{
				$keys[] = $key;
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

// Function: currentLang()
// İşlev: Sitenin aktif dilinin ne olduğu bilgisini verir getLang() yönteminden farkı
// Config/Uri.php dosyasından lang = true olarak ayarlanmamışsa herhangi bir sonuç vermez.
// Parametreler: Yok..
// Dönen Değerler: Config/Uri.php dosyasından lang = true olarak ayarlı ise sitenin aktif dilini çevirir.
// herhangi bir set edilme gerçekleşmemişse varsayılan tr değerini döndürür.

function currentLang()
{
	if( ! isset($_SESSION) ) 
	{
		session_start();
	}
	
	if( ! Config::get("Uri","lang") ) 
	{
		return false;
	}
	else
	{ 	
		return getLang();
	}
}



// Function: suffix()
// İşlev: Parametre olarak girilen değerlerin sonuna ek koymak için kullanılır.
// Parametreler: $string = Son ek koyulmak istenen ifade, $fix = koyulacak son ek.
// Dönen Değerler: $string parametresi boş ise false değeri boş değil ise metinsel ifade
// sonuna son ek eklenmiş yeni değeri döner eğer metinsel ifadenin sonundaki karakter ile
// son ek eklenecek karakter aynı ise yeniden herhangi bir ekleme işlemi gerçekleşmez.

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
	
	return $string;
}

// Function: prefix()
// İşlev: Parametre olarak girilen değerlerin başına ek koymak için kullanılır.
// Parametreler: $string = Ön ek koyulmak istenen ifade, $fix = koyulacak son ek.
// Dönen Değerler: $string parametresi boş ise false değeri boş değil ise metinsel ifade
// başına ön ek eklenmiş yeni değeri döner eğer metinsel ifadenin başındaki karakter ile
// ön ek eklenecek karakter aynı ise yeniden herhangi bir ekleme işlemi gerçekleşmez.
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
	
	return $string;
}

/******************************************************************************************
* PRESUFFIX -> V2.0.0 TEMMUZ V022 GÜNCELLEMESİ İLE EKLENMİŞTİR                            *
*******************************************************************************************
| Genel Kullanım: Metnin başına ve sonuna ek koymak için oluşturulmuştur.				  |
|          																				  |
******************************************************************************************/
function presuffix($string = '', $fix = '/')
{
	return suffix(prefix($string, $fix), $fix);
}

// Function: currentUrl()
// İşlev: Açık olan sayfanın o anki url adresini döndürür.
// Parametreler: Yok.
// Dönen Değerler: Sayfanın aktif url adresini döndürür.

function currentUrl()
{
	return sslStatus().host().cleanInjection(server('requestUri'));
}

// Function: siteUrl()
// İşlev: Sitenin url adresini döndürür baseUrl() den farkı bazı Config ayarları
// ile eklenen dil, ssl ve index.php gibi ekleride url adresinde barındırır.
// Parametreler: $uri = Site url adresine uri eki ekler, $index = Girilen sayısal negatif değer kadar 
// üst dizinin url adresini verir.
// Dönen Değerler: Sitenin url adresini verir. http://www.example.com/index.php/

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
	
	return sslStatus().$host.$newBaseDir.indexStatus().currentLang().cleanInjection($uri);
}

// Function: baseUrl()
// İşlev: Sitenin kök url adresini döndürür. Configten eklenen dil veya index.php gibi ekler ilave edilmez.
// Parametreler: $uri = Site kök url adresine uri eki ekler, $index = Girilen sayısal negatif değer kadar 
// üst dizinin kök url adresini verir.
// Dönen Değerler: Sitenin kök url adresini verir. http://www.example.com/

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
	
	return sslStatus().$host.$newBaseDir.cleanInjection($uri);
}	
	
// Function: prevUrl()
// İşlev: Bir önceki gelinen sayfanın url adresini verir.
// Parametreler: Yok.
// Dönen Değerler: Bir önceki gelinen sayfanın url adresini döndürür.
	
function prevUrl()
{
 	$str = str_replace(sslStatus().host().BASE_DIR.indexStatus(), "", server("referer"));
	
	if( currentLang() )
	{
		$strEx = explode("/", $str);
		$str   = str_replace($strEx[0]."/", "", $str);	
	}
	
	return siteUrl(cleanInjection($str));	
}

// Function: hostName()
// İşlev: Sitenin bulunduğu sunucunun adresini verir.
// Parametreler: $uri = Sunucu adresine eklenecek uri eki.
// Dönen Değerler: Bir önceki gelinen sayfanın url adresini döndürür. http://sunucuadi/
	
function hostName($uri = "")
{	
	if( ! is_string($uri) ) 
	{
		return false;
	}
	
	return sslStatus().suffix(host()).cleanInjection($uri);
}

// Function: host()
// İşlev: Sitenin bulunduğu hostun adını verir.
// Dönen Değerler: sunucuadi

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

// Function: currentPath()
// İşlev: Açık olan sayfanın o anki yolunu verir.
// Parametreler: $isPath = true olması durumunda aktif yolun tamamını verir
// false olması durumunda ise sadece son segmentin bilgisini verir. 
// Dönen Değerler: Sayfanın o anki yolunu verir.  is_path = true: home/example is_path = false: example

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

// Function: baseUrl()
// İşlev: Sitenin kök yolunu döndürür. Configten eklenen dil veya index.php gibi ekler ilave edilmez.
// Parametreler: $uri = Site kök yoluna uri eki ekler, $index = Girilen sayısal negatif değer kadar 
// üst dizinin kök yolunu verir.
// Dönen Değerler: Sitenin kök yolunu verir. znframework/

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
			
			for($i = 0; $i < count($baseDir) + $index; $i++)
			{
				$newBaseDir .= suffix($baseDir[$i]);
			}
		}
	}
	
	return cleanInjection($newBaseDir.$uri);
}

// Function: prevPath()
// İşlev: Bir önceki gelinen sayfanın yolunu verir.
// Parametreler: $isPath = true olması durumunda gelinen yolun tamamını verir
// Dönen Değerler: Bir önceki gelinen sayfanın yolunu döndürür.
	
function prevPath($isPath = true)
{
	if( ! is_bool($isPath) ) 
	{
		$isPath = true;
	}
	
	$str = str_replace(sslStatus().host().BASE_DIR.indexStatus(), '', server("referer"));
	
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

// Function: filePath()
// İşlev: Parametre olarak girilen yol url bilgisi içeriyorsa bu bilgiyi ayıklar
// ve dosyanın yolunu verir.
// Parametreler: $file = dosya adı, $removeUrl = ayıklanacak url adresi
// Dönen Değerler: Dosyanın yolunu verir.

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


// Function: pathInfos()
// İşlev: Dosya hakkında uzantı dizin adı dosya adı gibi ayrıntılar hakkında bilgi verir.
// Parametreler: $file = dosya yolu, $info = basename, dirname, filename, extension
// Dönen Değerler: Dosya hakkında bilgi.
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

// Function: extension()
// İşlev: Dosya uzantısını öğrenmek için kullanılır.
// Parametreler: $file = dosya yolu, $dote = true olması durumunda uzantının başına nokta koyar.
// Dönen Değerler: Dosyanın uzantısı.  $dote = true: .php , $dote = false: php 

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

// Function: removeExtension()
// İşlev: Metinsel dosya isimlerinde yer alan uzantıları kaldırmak için kullanılır.
// Dönen Değerler: Uzantısı kaldırılmış dosya adı.

function removeExtension($file = '')
{
	if( ! is_string($file) ) 
	{
		return false;
	}
	
	return preg_replace('/\\.[^.\\s]{3,4}$/', '', $file);
}

// Function: divide()
// İşlev: Metinsel ifadeyi parçalar ve istenilen elamanına ulaşılmasını sağlar.
// Parametreler: $str = Parçalanacak metinsel ifade, $seperator = Metnin parçalara ayrılacağı karakter
// $index = kaçıncı parça.
// Dönen Değerler: indeks numarasına göre parça değer döndürür.

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
	
	if( ! isValue($index)) 
	{
		$index = 0;
	}
	
	$arrayEx = explode($seperator, $str);
	
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

// Function: ipv4()
// İşlev: Kullanıcı iplerini verir.
// Parametreler: Yok.
// Dönen Değerler: IP değeri.

function ipv4()
{
	if( server('clientIp') )   //paylaşımlı bir bağlantı mı kullanıyor?
	{
		$ip = server('clientIp');
	}
	elseif( server('xForwardedFor') )   //ip adresi proxy'den mi geliyor?
	{
		$ip = server('xForwardedFor');
	}
	else
	{
	  	$ip = server('remoteAddr');
	}
 
	return $ip;
}

// Function: server()
// İşlev: Server bilgilerine ulaşmak için kullanılır.
// Parametreler: $type = istenilen server komut türü.
// Dönen Değerler: Server komut türüne göre sunucu bilgisi.

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
		'xForwardedFor'				 => (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) 	? $_SERVER['HTTP_X_FORWARDED_FOR'] 	: false,
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
		'originalUrl'		 		 => (isset($_SERVER['HTTP_X_ORIGINAL_URL'])) 	? $_SERVER['HTTP_X_ORIGINAL_URL'] 	: false,
		'documentRoot' 			 	 => (isset($_SERVER['DOCUMENT_ROOT'])) 			? $_SERVER['DOCUMENT_ROOT'] 		: false,							
		'windir'					 => (isset($_SERVER['WINDIR'])) 				? $_SERVER['WINDIR'] 				: false,
		'comspec'					 => (isset($_SERVER['COMSPEC'])) 				? $_SERVER['COMSPEC'] 				: false,
		'systemRoot'				 => (isset($_SERVER['SystemRoot'])) 			? $_SERVER['SystemRoot'] 			: false,
		'gatewayInterface'			 => (isset($_SERVER['GATEWAY_INTERFACE'])) 		? $_SERVER['GATEWAY_INTERFACE'] 	: false			
	);	
	
	if( isset($server[$type]) )
	{
		return $server[$type];
	}
	else
	{
		return false;
	}
}	

// Function: redirect()
// İşlev: Yönlendirme yapmak için kullanılır.
// Parametreler: $url = yönlendirme yapılacak adres, $time = Yönlendirme süresi
// $data = array() yönlendirilecek sayfaya veri gönderme, $exit = true 
// Dönen Değerler: Yok.

function redirect($url = '', $time = 0, $data = array(), $exit = true)
{	
	if( ! is_string($url) || empty($url) ) 
	{
		return false;
	}

	if( ! is_numeric($time) )
	{
		$time = '0';
	}
	
	if( ! is_bool($exit) ) 
	{
		$exit = true;
	}
	
	if( ! isUrl($url) )
	{
		$url = siteUrl($url);
	}
	
	if( ! empty($data) )
	{
		if( ! isset($_SESSION) ) 
		{
			session_start();
		}
		
		foreach( $data as $k => $v )
		{
			$_SESSION[md5('redirect:'.$k)] = $v;	
		}		
	}
	
	if( $time === 0 ) 
	{
		header("Location: {$url}", true);
	}
	else
	{
		sleep($time);
		
		header("Location: {$url}", true);
	}
	
	if( $exit === true ) 
	{
		exit;
	}
}

// Function: redirectData()
// İşlev: Yönlendirme ile gönderilen datayı okumak için kullanılır.
// Parametreler: $k = Gönderilen bilginin anahtar kelimesi.
// Dönen Değerler: Anahtar ifadenin değeri.
function redirectData($k = '')
{
	if( ! is_string($k) ) 
	{
		return false;
	}
	
	if( ! isset($_SESSION) ) 
	{
		session_start();
	}
	
	$data = md5('redirect:'.$k);
	
	if( isset($_SESSION[$data]) ) 
	{
		return $_SESSION[$data];
	}
	else
	{
		return false;
	}
}

// Function: redirectDeleteData()
// İşlev: Yönlendirme ile gönderilen datayı silmek için kullanıloır.
// Parametreler: $data = Gönderilen bilginin anahtar kelimesi. Metinsel veya dizisel olabilir.
// Dönen Değerler: void.
function redirectDeleteData($data = '')
{
	if( is_array($data) ) foreach( $data as $v )
	{
		$v = md5('redirect:'.$v);
	
		if( isset($_SESSION[$v]) )
		{
			unset($_SESSION[$v]);
		}	
	}
	else
	{
		$data = md5('redirect:'.$data);
		
		if( isset($_SESSION[$data]) )
		{
			unset($_SESSION[$data]);
		}
	}
}

// Function: library()
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

/******************************************************************************************
* USELIB - DAHİL EDİLDİĞİ SÜRÜM:1.4                                                       *
*******************************************************************************************
| Genel Kullanım: Herhangi bir sınıfı kullanmak için oluşturulmuştur.					  |
|															                              |
| Parametreler: Tek parametresi vardır.                                              	  |
| 1. string var @class => Kullanılacak sınıf ismi.									      |
|          																				  |
| Örnek Kullanım: uselib('Db')->get('Download')->result(); // Sonuçlar..	       		  |
|          																				  |
******************************************************************************************/
function uselib($class = '')
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
		
		zn::$use->$class = new $class;
		
		return zn::$use->$class;
	}
	else
	{
		return zn::$use->$class;	
	}
}

// Function: getMessage()
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
function getMessage($langFile, $errorMsg, $ex = '')
{
	return lang($langFile, $errorMsg, $ex);
}

// Function: getErrorMessage()
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
function getErrorMessage($langFile = '', $errorMsg = '', $ex = '')
{
	$style = '
		border:solid 1px #E1E4E5;
		background:#F3F6F6;
		padding:10px;
		margin-bottom:10px;
		font-family:Courier New, Courier, monospace, Tahoma, Arial;
		color:#333;
		text-align:left;
		font-size:16px;
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

// Function: errorReport()
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
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

//------------------------------------SYSTEM AND USER FUNCTIONS END-------------------------------------------------------------------


//------------------------------------SYSTEM FUNCTIONS START--------------------------------------------------------------------------

// Function: currentUri()
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
function currentUri()
{
	if( BASE_DIR !== '/' )
	{
		$cu = str_replace(BASE_DIR, '', server('requestUri'));
	}
	else
	{
		$cu = substr(server('requestUri'), 1);
	}
	
	if( indexStatus() ) 
	{
		$cu = str_replace(indexStatus(), '', $cu);
	}
	
	return $cu;
}

// Function: requestUri()
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
function requestUri()
{
	$requestUri = ( server('currentPath') ) 
	               ? substr(server('currentPath'), 1) 
				   : currentUri();
	
	if( @$requestUri[strlen($requestUri) - 1] === '/' )
	{
			$requestUri = substr($requestUri, 0, -1);
	}
	
	$requestUri = routeUri($requestUri);
	
	return str_replace(suffix(getLang()), '', cleanInjection($requestUri));
}

// Function: routeUri()
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
function routeUri($requestUri = '')
{
	if( Config::get('Route','openPage') )
	{
			if( $requestUri === 'index.php' || empty($requestUri) || $requestUri === getLang() ) 
			{
				$requestUri = Config::get('Route','openPage');
			}
	}
			
	$uriChange = Config::get('Route','changeUri');
		
	if( ! empty($uriChange) ) foreach( $uriChange as $key => $val )
	{	
		$requestUri = preg_replace('/'.$key.'/xi', $val, $requestUri);
	}
	
	return $requestUri;
}

// Function: cleanInjection()
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
function cleanInjection($string = "")
{
	$urlInjectionChangeChars = Config::get("Security", 'urlChangeChars');

	if( ! empty($urlInjectionChangeChars) ) foreach( $urlInjectionChangeChars as $key => $val )
	{		
		$string = preg_replace('/'.$key.'/xi', $val, $string);
	}
	
	return $string;
	
}

// Function: report()
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
function report($subject = 'unknown', $message = '', $destination = 'message', $time = '')
{
	if( ! Config::get('Log', 'createFile')) 
	{
		return false;
	}
	
	$logDir    = APP_DIR.'Logs/';
	$extension = '.log';
	
	if( ! is_dir($logDir) )
	{
		Folder::create($logDir, 0777);	
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

// Function: createHtaccessFile()
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
function createHtaccessFile()
{	
	// Cache.php ayar dosyasından ayarlar çekiliyor.
	$config = Config::get('Cache');
	
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
</ifModule>'.eol(2);
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
			$exp .= 'ExpiresByType '.$type.' "access plus '.$value.' seconds"'.eol();
		}
		
		$modExpires = '<ifModule mod_expires.c>
ExpiresActive On
ExpiresDefault "access plus '.$config['modExpires']['defaultTime'].' seconds"
'.$exp.'
</ifModule>'.eol(2);
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
</filesMatch>'.eol();
		}
		
		$modHeaders = '<ifModule mod_headers.c>
'.$fmatch.'
</ifModule>
'.eol(2);
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
		$headersIniSet  = "<ifModule mod_expires.c>".eol();	
		
		foreach( $headerSet['iniSet'] as $val )
		{
			$headersIniSet .= "$val".eol();
		}
		
		$headersIniSet .= "</ifModule>".eol(2);
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
			$htaccessSettingsStr .= "<$key>".eol();
			
			foreach( $val as $v )
			{
				$htaccessSettingsStr .= $v;
			}
			
			$keyex = explode(" ", $key);
			$htaccessSettingsStr .= eol()."</$keyex[0]>".eol(2);
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
		$htaccess .= "<IfModule mod_rewrite.c>".eol();
		$htaccess .= "RewriteEngine On".eol();
		$htaccess .= "RewriteBase /".eol();
		$htaccess .= "RewriteCond %{REQUEST_FILENAME} !-f".eol();
		$htaccess .= "RewriteCond %{REQUEST_FILENAME} !-d".eol();
		$htaccess .= 'RewriteRule ^(.*)$  '.server('scriptName').Config::get('Uri','indexSuffix').'/$1 [L]'.eol();
		$htaccess .= "</IfModule>";
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
				$sets .= "php_value $k $v".eol();		 
			}			
		}
		
		if( ! empty($sets) )
		{
			$htaccess .= eol()."<IfModule mod_php5.c>".eol();
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
	
	//echo $getContents."<br>";
	//echo $htaccess;
	// .htaccess dosyasını oluştur.
	$fileOpen  = fopen('.htaccess', 'w');
	$fileWrite = fwrite($fileOpen, trim($htaccess));
	fclose($fileOpen);
	
	// $htaccess değişkenini kaldır.
	unset( $htaccess );	
	
}

// Function: headers()
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
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
		if( isset($header) ) foreach($header as $k => $v)
		{
			header($v);
		}
	}
}

// Function: sslStatus()
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
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

// Function: indexStatus()
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
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
//------------------------------------SYSTEM FUNCTIONS END----------------------------------------------------------------------------