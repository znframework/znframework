<?php 
/************************************************************/
/*                   	SYSTEM FUNCTIONS                    */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

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
	
	if(version_compare(PHP_VERSION, $version, '>='))
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
	
	$charsets    = mb_list_encodings();
	$newcharsets = array();
	$charset     = strtolower($charset);
	
	foreach($charsets as $ch)
	{
		$newcharsets[] = strtolower($ch);
	}
	
	if( array_search($charset, $newcharsets, true) )
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
function output($data = '', $display = true)
{
	$globalstyle  = ' style="font-family:monospace, Tahoma, Arial; font-size:12px;"';
	
	$output  = "<span$globalstyle>";
	$output .= "<pre>";
	$output .= '********************************************************<br>';
	$output .= '* DATA OUTPUT                                          *<br>';
	$output .= '********************************************************';
	$output .= "</pre>";
	$output .= _output($data);
	$output .= "<br>";
	$output .= '********************************************************';
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
function _output($data = '', $tab = '', $start = 0)
{
	static $start;
	
	$output = '';
	$eof 	= '<br>';
	$tab 	= str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $start);
	
	$lengthstyle = ' style="color:grey"';
	$keystyle 	 = ' style="color:#000"';
	$typestyle   = ' style="color:#8C2300"';
	
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
				$valstyle  = ' style="color:green;"';	
				
				$type = gettype($v);
				
				if( $type === 'string' )
				{
					$v = "'".$v."'";	
					$valstyle = ' style="color:red;"';
					
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
		$vars_array = array();
		
		foreach($vars as $k => $v)
		{
			$vars_array['{'.$k.'}']	= $v;
		}
		
		$data = str_replace(array_keys($vars_array), array_values($vars_array), $data);
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
function writeLine($data = '', $vars = array(), $br_count = 1)
{
	echo write($data, $vars).str_repeat("<br>", $br_count);
}

// Function: compare()
// İşlev: İki veri arasında karşılaştırma yapmak için kullanılır.
// Parametreler: @p1 , @operator , $p2.
// Dönen Değerler: Karşılaştırma sağlanıyorsa true sağlanmıyorsa false değeri döner.
function compare($p1 = '', $operator = '=', $p2 = '')
{
	if( ! ( isValue($p1) || isValue($p2) ) )
	{
		return false;
	}
	
	if( ! is_string($operator) )
	{
		return false;	
	}
	
	return version_compare($p1, $p2, $operator);
}

// Function: eof()
// İşlev: Farklı işletim sistemlerine göre satır sonunu ifade eder.
// Dönen Değerler: \n\r, \r veya \n.

function eof($repeat = 1)
{
	if ( strtoupper(substr(PHP_OS,0,3)) === 'WIN' ) 
	{
        $ln = "\r\n";        
    }
    elseif ( strtoupper(substr(PHP_OS,0,3)) === 'MAC')
	{
        $ln = "\r";
	}
	else
	{
        $ln = "\n";
	}
	
	return str_repeat($ln, $repeat);
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
		return $_SESSION[md5("lang")] = "tr";
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

function setLang($l = "tr")
{
	if( ! is_string($l) )
	{
		return false;
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
	$langdir    = LANGUAGES_DIR.$file ;
	$syslangdir = SYSTEM_LANGUAGES_DIR.$file;
	
	global $lang;
	
	if( isFileExists($langdir) ) 
	{
		require_once($langdir);	
	}
	elseif( isFileExists($syslangdir) )
	{
		require_once($syslangdir);	
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
		if( isset($_SESSION[md5("lang")]) )
		{
			return $_SESSION[md5("lang")];
		}
		else
		{
			return $_SESSION[md5("lang")] = 'tr';
		}
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
	if( ! is_string($string) ) 
	{
		return false;
	}
	
	if( ! is_string($fix) )
	{
		$fix = '/';
	}
	
	$prefix = '';
	
	if( empty($string) )
	{
		return false;
	}
	
	if( strlen($fix) < strlen($string) )
	{
		for($i=0;$i<strlen($fix);$i++) $prefix .= $string[strlen($string) - strlen($fix) + $i]; 
	}
	else
	{
		return $string.$fix;	
	}
	
	if($prefix === $fix) 
	{
		return $string; 
	}
	else 
	{
		return $string.$fix;
	}
}

// Function: prefix()
// İşlev: Parametre olarak girilen değerlerin başına ek koymak için kullanılır.
// Parametreler: $string = Ön ek koyulmak istenen ifade, $fix = koyulacak son ek.
// Dönen Değerler: $string parametresi boş ise false değeri boş değil ise metinsel ifade
// başına ön ek eklenmiş yeni değeri döner eğer metinsel ifadenin başındaki karakter ile
// ön ek eklenecek karakter aynı ise yeniden herhangi bir ekleme işlemi gerçekleşmez.

function prefix($string = '',$fix = '/')
{
	if( ! is_string($string) )
	{
		return false;
	}
	
	if( ! is_string($fix) ) 
	{
		$fix = '/';
	}
	
	$prefix = '';
	
	if( empty($string) )
	{
		return false;
	}
	
	if( strlen($fix) < strlen($string) )
	{
		for($i=0;$i<strlen($fix);$i++) $prefix .= $string[$i]; 
	}
	else
	{
		return $fix.$string;	
	}
	if($prefix === $fix)
	{
		return $string; 
	}
	else 
	{
		return $fix.$string;
	}
}

// Function: currentUrl()
// İşlev: Açık olan sayfanın o anki url adresini döndürür.
// Parametreler: Yok.
// Dönen Değerler: Sayfanın aktif url adresini döndürür.

function currentUrl()
{
	return sslStatus().host().cleanInjection(server('request_uri'));
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
	
	if( $index > 0 )
	{
		$index = 0;
	}
	
	if( BASE_DIR !== "/" )
	{
		$base_dir = substr(BASE_DIR,1,-1);
		$base_dir = explode("/", $base_dir);
		$new_base_dir = "/";
		
		for($i = 0; $i < count($base_dir) + $index; $i++)
		{
			$new_base_dir .= suffix($base_dir[$i]);
		}
	}
	else
	{
		$new_base_dir = BASE_DIR;
	}
	
	$host = host();
	
	return sslStatus().$host.$new_base_dir.indexStatus().suffix(currentLang()).cleanInjection($uri);
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
	
	if( $index > 0 ) 
	{
		$index = 0;
	}
	
	if( BASE_DIR !== "/" )
	{
		$base_dir = substr(BASE_DIR,1,-1);
		$base_dir = explode("/", $base_dir);
		$new_base_dir = "/";
		
		for($i = 0; $i < count($base_dir) + $index; $i++)
		{
			$new_base_dir .= suffix($base_dir[$i]);
		}
	}
	else
	{
		$new_base_dir = BASE_DIR;
	}
	
	$host = host();
	
	return sslStatus().$host.$new_base_dir.cleanInjection($uri);
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
		$str_ex = explode("/",$str);
		$str    = str_replace($str_ex[0]."/", "", $str);	
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
// Parametreler: $is_path = true olması durumunda aktif yolun tamamını verir
// false olması durumunda ise sadece son segmentin bilgisini verir. 
// Dönen Değerler: Sayfanın o anki yolunu verir.  is_path = true: home/example is_path = false: example

function currentPath($is_path = true)
{
	if( ! is_bool($is_path) ) 
	{
		$is_path = true;
	}
	
	$current_page_path = str_replace("/".getLang()."/", "", server('current_path'));
	
	if ($current_page_path[0] === "/" )
	{
		$current_page_path = substr($current_page_path, 1, strlen($current_page_path)-1);
	}
	
	if( $is_path === true )
	{	
		return $current_page_path;
	}
	else
	{
		$str = explode("/", $current_page_path);
	
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
	
	if( $index > 0 ) 
	{
		$index = 0;
	}
	
	if( BASE_DIR !== "/" )
	{
		$base_dir = substr(BASE_DIR, 1, -1);
		$base_dir = explode("/", $base_dir);
		$new_base_dir = "";
		
		for($i = 0; $i < count($base_dir) + $index; $i++)
		{
			$new_base_dir .= suffix($base_dir[$i]);
		}
	}
	else
	{
		$new_base_dir = "";
	}
	
	return cleanInjection($new_base_dir.$uri);
}

// Function: prevPath()
// İşlev: Bir önceki gelinen sayfanın yolunu verir.
// Parametreler: $is_path = true olması durumunda gelinen yolun tamamını verir
// Dönen Değerler: Bir önceki gelinen sayfanın yolunu döndürür.
	
function prevPath($is_path = true)
{
	if( ! is_bool($is_path) ) 
	{
		$is_path = true;
	}
	
	$str = str_replace(sslStatus().host().BASE_DIR.indexStatus(), '', server("referer"));
	
	if( currentLang() )
	{
		$str = explode("/",$str); return $str[1]; 
	}
	
	if( $is_path === true )
	{
		return $str;	
	}
	else
	{
		$str = explode("/", $str);
		
		if( count($str) > 1 ) 
		{
			return $str[count($str) - 1];	
		}
		return $str[0];
	}
}

// Function: filePath()
// İşlev: Parametre olarak girilen yol url bilgisi içeriyorsa bu bilgiyi ayıklar
// ve dosyanın yolunu verir.
// Parametreler: $file = dosya adı, $remove_url = ayıklanacak url adresi
// Dönen Değerler: Dosyanın yolunu verir.

function filePath($file = "", $remove_url = "")
{
	if( ! is_string($file) ) 
	{
		return false;
	}
	
	if( ! is_string($remove_url) ) 
	{
		$remove_url = "";
	}
	
	if( isUrl($file) )
	{
		if( ! isUrl($remove_url) )
		{
			$remove_url = baseUrl();
		}
		
		$file = trim(str_replace($remove_url, '', $file));
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
		$pathinfo = pathinfo($file);
		
		if( isset($pathinfo[$info]) )
		{
			return $pathinfo[$info];
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
	
	if($dote === true) 
	{
		$dote = '.'; 
	}
	else 
	{
		$dote = '';
	}
	
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
	if( ! is_string($seperator) ) 
	{
		$seperator = "|";
	}
	
	if( ! isValue($index)) 
	{
		$index = 0;
	}
	
	if( empty($seperator) ) 
	{
		$seperator = "|";
	}
	
	$array_ex = explode($seperator, $str);
	
	if( $index < 0 )
	{
 		$ind = (count($array_ex)+($index));
	}
	elseif( $index === 'last' )
	{
		$ind = (count($array_ex) - 1);
	}
	elseif( $index === 'first' )
	{
		$ind = 0;
	}
	else
	{
		$ind = $index;
	}
	
	if( isset($array_ex[$ind]) )
	{
		return $array_ex[$ind];
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
	if( server('client_ip') )   //paylaşımlı bir bağlantı mı kullanıyor?
	{
		$ip = server('client_ip');
	}
	elseif( server('x_forwarded_for') )   //ip adresi proxy'den mi geliyor?
	{
		$ip = server('x_forwarded_for');
	}
	else
	{
	  	$ip = server('remote_addr');
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
		'remote_addr'				 => (isset($_SERVER['REMOTE_ADDR'])) 			? $_SERVER['REMOTE_ADDR'] 			: false,
		'remote_port'				 => (isset($_SERVER['REMOTE_PORT'])) 			? $_SERVER['REMOTE_PORT'] 			: false,	
		'request_method'			 => (isset($_SERVER['REQUEST_METHOD'] )) 		? $_SERVER['REQUEST_METHOD'] 		: false,
		'request_uri'				 => (isset($_SERVER['REQUEST_URI'])) 			? $_SERVER['REQUEST_URI'] 			: false,
		'request_scheme'			 => (isset($_SERVER['REQUEST_SCHEME'])) 		? $_SERVER['REQUEST_SCHEME'] 		: false,
		'request_time'				 => (isset($_SERVER['REQUEST_TIME'])) 			? $_SERVER['REQUEST_TIME'] 			: false,
		'request_time_float'		 => (isset($_SERVER['REQUEST_TIME_FLOAT'])) 	? $_SERVER['REQUEST_TIME_FLOAT'] 	: false,
		'accept'					 => (isset($_SERVER['HTTP_ACCEPT'])) 			? $_SERVER['HTTP_ACCEPT'] 			: false,
		'accept_charset'			 => (isset($_SERVER['HTTP_ACCEPT_CHARSET'])) 	? $_SERVER['HTTP_ACCEPT_CHARSET'] 	: false,
		'accept_encoding'			 => (isset($_SERVER['HTTP_ACCEPT_ENCODING'])) 	? $_SERVER['HTTP_ACCEPT_ENCODING'] 	: false,
		'accept_language'			 => (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) 	? $_SERVER['HTTP_ACCEPT_LANGUAGE'] 	: false,
		'client_ip'			 		 => (isset($_SERVER['HTTP_CLIENT_IP'])) 		? $_SERVER['HTTP_CLIENT_IP'] 		: false,
		'x_forwarded_for'			 => (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) 	? $_SERVER['HTTP_X_FORWARDED_FOR'] 	: false,
		'connection'				 => (isset($_SERVER['HTTP_CONNECTION'])) 		? $_SERVER['HTTP_CONNECTION'] 		: false,
		'host'						 => (isset($_SERVER['HTTP_HOST'])) 				? $_SERVER['HTTP_HOST'] 			: false,
		'referer'					 => (isset($_SERVER['HTTP_REFERER'])) 			? $_SERVER['HTTP_REFERER'] 			: false,
		'user_agent'				 => (isset($_SERVER['HTTP_USER_AGENT'])) 		? $_SERVER['HTTP_USER_AGENT'] 		: false,
		'cookie'					 => (isset($_SERVER['HTTP_COOKIE'])) 			? $_SERVER['HTTP_COOKIE'] 			: false,
		'cache_control'				 => (isset($_SERVER['HTTP_CACHE_CONTROL'])) 	? $_SERVER['HTTP_CACHE_CONTROL'] 	: false,
		'https'					 	 => (isset($_SERVER['HTTPS'])) 					? $_SERVER['HTTPS'] 				: false,
		'script_filename'			 => (isset($_SERVER['SCRIPT_FILENAME'])) 		? $_SERVER['SCRIPT_FILENAME'] 		: false,
		'script_name'				 => (isset($_SERVER['SCRIPT_NAME'])) 			? $_SERVER['SCRIPT_NAME'] 			: false,
		'path'						 => (isset($_SERVER['PATH'])) 					? $_SERVER['PATH'] 					: false,
		'path_info'					 => (isset($_SERVER['PATH_INFO'])) 				? $_SERVER['PATH_INFO'] 			: false,
		'current_path'				 => (isset($_SERVER['PATH_INFO'])) 				? $_SERVER['PATH_INFO'] 			: $_SERVER['QUERY_STRING'],
		'path_translated'			 => (isset($_SERVER['PATH_TRANSLATED'])) 		? $_SERVER['PATH_TRANSLATED'] 		: false,
		'pathext'					 => (isset($_SERVER['PATHEXT'])) 				? $_SERVER['PATHEXT'] 				: false,
		'redirect_query_string'		 => (isset($_SERVER['REDIRECT_QUERY_STRING'])) 	? $_SERVER['REDIRECT_QUERY_STRING'] : false,
		'redirect_url'				 => (isset($_SERVER['REDIRECT_URL'])) 			? $_SERVER['REDIRECT_URL'] 			: false,
		'redirect_status'			 => (isset($_SERVER['REDIRECT_STATUS'])) 		? $_SERVER['REDIRECT_STATUS'] 		: false,
		'php_self'					 => (isset($_SERVER['PHP_SELF'])) 				? $_SERVER['PHP_SELF'] 				: false,
		'query_string'				 => (isset($_SERVER['QUERY_STRING'])) 			? $_SERVER['QUERY_STRING'] 			: false,	
		'original_url'		 		 => (isset($_SERVER['HTTP_X_ORIGINAL_URL'])) 	? $_SERVER['HTTP_X_ORIGINAL_URL'] 	: false,
		'document_root' 			 => (isset($_SERVER['DOCUMENT_ROOT'])) 			? $_SERVER['DOCUMENT_ROOT'] 		: false,							
		'windir'					 => (isset($_SERVER['WINDIR'])) 				? $_SERVER['WINDIR'] 				: false,
		'comspec'					 => (isset($_SERVER['COMSPEC'])) 				? $_SERVER['COMSPEC'] 				: false,
		'system_root'				 => (isset($_SERVER['SystemRoot'])) 			? $_SERVER['SystemRoot'] 			: false,
		'gateway_interface'			 => (isset($_SERVER['GATEWAY_INTERFACE'])) 		? $_SERVER['GATEWAY_INTERFACE'] 	: false			
	);	
	
	if( isset($server[strtolower($type)]) )
	{
		return $server[strtolower($type)];
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
	if( ! is_string($url) ) 
	{
		return false;
	}
	if( empty($url) ) 
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
	
	if ( ! isUrl($url) )
	{
		$url = siteUrl($url);
	}
	
	if( ! empty($data) )
	{
		if( ! isset($_SESSION) ) 
		{
			session_start();
		}
		
		foreach($data as $k => $v)
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
// İşlev: Yönlendirme ile gönderilen datayı okumak için kullanıloır.
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
	
	if( isset($_SESSION[md5('redirect:'.$k)]) ) 
	{
		return $_SESSION[md5('redirect:'.$k)];
	}
	else
	{
		return false;
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
	$shortname = nsShortName($class);

	if( ! empty($shortname['namespace']) )
	{
		$class = $shortname['namespace'];
	}
	
	if( strstr($class, '/') )
	{
		$class = str_replace('/', '\\', $class);
	}
	
	if( class_exists($class) )
	{
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
	else
	{
		return $class;	
	}
}

// Function: getMessage()
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
function getMessage($lang_file, $error_msg, $ex = '')
{
	return lang($lang_file, $error_msg, $ex);
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
		$cu = str_replace(BASE_DIR, '', server('request_uri'));
	}
	else
	{
		$cu = substr(server('request_uri'), 1);
	}
	
	if( indexStatus() ) 
	{
		$cu = str_replace('index.php/', '', $cu);
	}
	
	return $cu;
}

// Function: requestUri()
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
function requestUri()
{
	$request_uri = ( server('current_path') ) 
	               ? substr(server('current_path'), 1) 
				   : currentUri();
	
	if( @$request_uri[strlen($request_uri) - 1] === '/' )
	{
			$request_uri = substr($request_uri, 0, -1);
	}
	
	$request_uri = routeUri($request_uri);
	
	return str_replace(suffix(getLang()), '', cleanInjection($request_uri));
}

// Function: routeUri()
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
function routeUri($request_uri = '')
{
	if( Config::get('Route','open-page') )
	{
			if( $request_uri === 'index.php' || empty($request_uri) || $request_uri === getLang() ) 
			{
				$request_uri = Config::get('Route','open-page');
			}
	}
			
	$uri_change = Config::get('Route','change-uri');
		
	if( ! empty($uri_change) )
	{
		foreach($uri_change as $key => $val)
		{		
			$request_uri = preg_replace('/'.$key.'/xi', $val, $request_uri);
		}
	}
	
	return $request_uri;
}

// Function: cleanInjection()
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
function cleanInjection($string = "")
{
	$url_injection_change_chars = Config::get("Security", 'url-change-chars');

	if( empty($url_injection_change_chars) ) 
	{
		return $string;
	}
	
	$badwords = $url_injection_change_chars;
	
	foreach($badwords as $key => $val)
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
	if( ! Config::get('Log', 'create-file')) 
	{
		return false;
	}
	
	$log_dir = APP_DIR.'Logs/';
	$extension = '.log';
	
	if( ! is_dir($log_dir) )
	{
		Folder::create($log_dir, 0777);	
	}
	
	if( is_file($log_dir.suffix($destination,$extension)) )
	{
		if( empty($time) ) 
		{
			$time = Config::get('Log', 'file-time');
		}
		
		$create_date = File::createDate($log_dir.suffix($destination,$extension), 'd.m.Y');
		
		$end_date = strtotime("$time",strtotime($create_date));
		
		$end_date = date('Y.m.d' ,$end_date );
		
		if( date('Y.m.d')  >  $end_date )
		{
			File::delete($log_dir.suffix($destination,$extension));
		}
	}

	$message = "IP: ".ipv4()." | Subject: ".$subject.' | Date: '.date('d.m.Y h:i:s')." | Message: ".$message.eof();
	error_log($message, 3, $log_dir.suffix($destination,$extension));
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
	if( $config['mod-gzip']['status'] === true ) 
	{
		$mod_gzip = '<ifModule mod_gzip.c>
mod_gzip_on Yes
mod_gzip_dechunk Yes
mod_gzip_item_include file .('.$config['mod-gzip']['included-file-extension'].')$
mod_gzip_item_include handler ^cgi-script$
mod_gzip_item_include mime ^text/.*
mod_gzip_item_include mime ^application/x-javascript.*
mod_gzip_item_exclude mime ^image/.*
mod_gzip_item_exclude rspheader ^Content-Encoding:.*gzip.*
</ifModule>'.eof(2);
	}
	else
	{
		$mod_gzip = '';
	}
	//-----------------------GZIP-------------------------------------------------------------
	
	//-----------------------EXPIRES----------------------------------------------------------
	// mod_expires = true ayarı yapılmışsa aşağıdaki kodları ekler.
	// Tarayıcı ile ön bellekleme başlatılmış olur.
	if( $config['mod-expires']['status'] === true ) 
	{
		$exp = '';
		foreach($config['mod-expires']['file-type-time'] as $type => $value)
		{
			$exp .= 'ExpiresByType '.$type.' "access plus '.$value.' seconds"'.eof();
		}
		
		$mod_expires = '<ifModule mod_expires.c>
ExpiresActive On
ExpiresDefault "access plus '.$config['mod-expires']['default-time'].' seconds"
'.$exp.'
</ifModule>'.eof(2);
	}
	else
	{
		$mod_expires = '';
	}
	//-----------------------EXPIRES----------------------------------------------------------
	
	//-----------------------HEADERS----------------------------------------------------------
	// mod_headers = true ayarı yapılmışsa aşağıdaki kodları ekler.
	// Header ile ön bellekleme başlatılmış olur.
	if( $config['mod-headers']['status'] === true ) 
	{
		$fmatch = '';
		foreach($config['mod-headers']['file-extension-time-access'] as $type => $value)
		{
			$fmatch .= '<filesMatch "\.('.$type.')$">
Header set Cache-Control "max-age='.$value['time'].', '.$value['access'].'"
</filesMatch>'.eof();
		}
		
		$mod_headers = '<ifModule mod_headers.c>
'.$fmatch.'
</ifModule>
'.eof(2);
	}
	else
	{
		$mod_headers = '';
	}
	//-----------------------HEADERS----------------------------------------------------------
	
	//-----------------------HEADER SET-------------------------------------------------------
	$headerset = Config::get("Headers");
	
	if( ! empty($headerset['set-htaccess-file']) )
	{
		$headers_iniset  = "<ifModule mod_expires.c>".eof();	
		
		foreach($headerset['iniset'] as $val)
		{
			$headers_iniset .= "$val".eof();
		}
		
		$headers_iniset .= "</ifModule>".eof(2);
	}
	else
	{
		$headers_iniset = '';
	}
	//-----------------------HEADER SET-------------------------------------------------------
	
	//-----------------------HTACCESS SET-----------------------------------------------------	
	$htaccess_settings = Config::get("Htaccess");
	
	if( ! empty($htaccess_settings['set-file']) )
	{
		$htaccess_settings_str = '';
		
		foreach($htaccess_settings['settings'] as $key => $val)
		{
			$htaccess_settings_str .= "<$key>".eof();
			
			foreach($val as $v)
			{
				$htaccess_settings_str .= $v;
			}
			
			$keyex = explode(" ", $key);
			$htaccess_settings_str .= eof()."</$keyex[0]>".eof(2);
		}	
	}
	else
	{
		$htaccess_settings_str = '';	
	}
	//-----------------------HTACCESS SET-----------------------------------------------------	
	
	// Htaccess dosyasına eklenecek veriler birleştiriliyor...
	$htaccess = $mod_gzip.$mod_expires.$mod_headers.$headers_iniset.$htaccess_settings_str;
	
	//-----------------------URI INDEX PHP----------------------------------------------------	
	if( ! Config::get('Uri','index.php') )
	{
		$htaccess .= "<IfModule mod_rewrite.c>".eof();
		$htaccess .= "RewriteEngine On".eof();
		$htaccess .= "RewriteBase /".eof();
		$htaccess .= "RewriteCond %{REQUEST_FILENAME} !-f".eof();
		$htaccess .= "RewriteCond %{REQUEST_FILENAME} !-d".eof();
		$htaccess .= 'RewriteRule ^(.*)$  '.server('script_name').Config::get('Uri','index-suffix').'/$1 [L]'.eof();
		$htaccess .= "</IfModule>";
	}
	//-----------------------URI INDEX PHP----------------------------------------------------
	
	//-----------------------UPLOAD SETTINGS--------------------------------------------------
	$uploadset = Config::get('Upload');		
	
	if( ! empty($uploadset['set-htaccess-file']) )
	{
		$upload_settings = $uploadset['settings'];
	}
	else
	{
		$upload_settings = array();
	}
	//-----------------------UPLOAD SETTINGS--------------------------------------------------
	
	//-----------------------SESSION SETTINGS-------------------------------------------------
	$sessionset = Config::get('Session');	
			
	if( ! empty($sessionset['set-htaccess-file']) )
	{
		$session_settings = $sessionset['settings'];
	}
	else
	{
		$session_settings = array();
	}
	//-----------------------SESSION SETTINGS-------------------------------------------------
	
	//-----------------------INI SETTINGS-----------------------------------------------------	
	$iniset = Config::get('Ini');	
		
	if( ! empty($iniset['set-htaccess-file']) )
	{
		$ini_settings = $iniset['settings'];
	}
	else
	{
		$ini_settings = array();
	}
	//-----------------------INI SETTINGS-----------------------------------------------------	
	
	// Ayarlar birleştiriliyor.	
	$all_settings = array_merge($ini_settings, $upload_settings, $session_settings);	
	
	if( ! empty($all_settings) )
	{
		$sets = '';
		foreach($all_settings as $k => $v)
		{
			if( $v !== '' )
			{
				$sets .= "php_value $k $v".eof();		 
			}			
		}
		
		if( ! empty($sets) )
		{
			$htaccess .= eof()."<IfModule mod_php5.c>".eof();
			$htaccess .= $sets;
			$htaccess .= "</IfModule>";
		}
	}
	
	// .htaccess dosyası varsa içeriği al yok ise içeriği boş geç
	if( file_exists('.htaccess') )
	{
		$get_contents = file_get_contents('.htaccess');
	}
	else
	{
		$get_contents = '';
	}
	// $htaccess değişkenin tuttuğu değer ile dosya içeri eşitse tekrar oluşturma
	if( trim($htaccess) === trim($get_contents) ) 
	{
		return false;
	}
	
	//echo $get_contents."<br>";
	//echo $htaccess;
	// .htaccess dosyasını oluştur.
	$file_open 	= fopen('.htaccess', 'w');
	$file_write = fwrite($file_open, trim($htaccess));
	fclose($file_open);
	
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

/******************************************************************************************
* NS SHORT NAME - DAHİL EDİLDİĞİ SÜRÜM:1.5                                                *
*******************************************************************************************
| Genel Kullanım: İsim alanı kısaltması kontrolünü sağlaması için oluşturulmuştur.		  |
|          																				  |
******************************************************************************************/
function nsShortName($class = '')
{
	$namespaces = Config::get('Namespace', 'short-name');
	
	$longns  = array_values($namespaces);
	$shortns = array_map('strtolower', array_keys($namespaces));	
	$number  = array_search(strtolower($class), $shortns);
	
	$namespace = $number > -1
			   ? $longns[$number]
			   : $namespace = '';	
	
	return array('classname' => $class, 'namespace' => $namespace);
}
//------------------------------------SYSTEM FUNCTIONS END----------------------------------------------------------------------------