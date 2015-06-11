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

// Function: is_phpversion()
// İşlev: Parametrenin geçerli php sürümü olup olmadığını kontrol eder.
// Parametreler: $version => Geçerliliği kontrol edilecek veri.
// Dönen Değerler: Geçerli sürümse true değilse false değerleri döner.

function is_phpversion($version = '5.2.4')
{
	if( ! is_value($version) )
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

// Function: is_defined()
// İşlev: Parametrenin değer alıp almadığını kontrol eder.
// Parametreler: $str = Herhangi bir değer.
// Dönen Değerler: değer almışsa true almamış ise false  değeri döner.

function is_defined($str = NULL)
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

// Function: is_import()
// İşlev: Bir dosyanın daha önce dahil edilip edilmediğini kontrol eder.
// Parametreler: $path = Kontrol edilecek dosya yolu.
// Dönen Değerler: Daha önce dahil edilmişse true edilmemiş ise false değeri döner.

function is_import($path = '')
{	
	if( ! is_string($path) )
	{
		return false;
	}
	
	if( in_array( realpath(suffix($path,".php")), get_required_files() ) ) 
	{
		return true;
	}
	else
	{ 
		return false;
	}
}

// Function: is_file_exists()
// İşlev: Parametre olarak girilen değerin dosya olup olmadığını dosya ise var olup olmadığını kontrol eder.
// Parametreler: $file = Kontrol edilecek dosya yolu.
// Dönen Değerler: Parametre dosya yolunu ifade ediyor ve böyle bir dosya var ise true bu şartlara uymuyorsa false değeri döner.

function is_file_exists($file = '')
{
	if( ! is_string($file) ) 
	{
		return false;
	}
	
	if( is_url($file) )
	{
		$file = trim(str_replace(base_url(), '', $file));
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

// Function: is_dir_exists()
// İşlev: Parametre olarak girilen değerin dizin olup olmadığını dizin ise var olup olmadığını kontrol eder.
// Parametreler: $dir = Kontrol edilecek dosya yolu.
// Dönen Değerler: Parametre dizin yolunu ifade ediyor ve böyle bir dizin var ise true bu şartlara uymuyorsa false değeri döner.

function is_dir_exists($dir = '')
{
	if( ! is_string($dir) ) 
	{
		return false;
	}
	
	if( is_url($dir) )
	{
		$dir = trim(str_replace(base_url(), '', $dir));
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

// Function: is_url()
// İşlev: Parametre olarak girilen değerin url adresi olup olmadığını kontrol eder.
// Parametreler: $url = Kontrol edilecek url adresi.
// Dönen Değerler: Parametre url adresini ifade ediyorsa true etmiyorsa false değeri döner.

function is_url($url = '')
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

// Function: is_email()
// İşlev: Parametre olarak girilen değerin e-posta adresi olup olmadığını kontrol eder.
// Parametreler: $email = Kontrol edilecek e-posta adresi.
// Dönen Değerler: Parametre e-posta adresini ifade ediyorsa true etmiyorsa false değeri döner.

function is_email($email = '')
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

// Function: is_repmac()
// İşlev: Config/Repear.php dosyasında yer alan machines = array() dizisi içerisinde ip numarası veya
// numaralarının o anki modeminizin ip'si ile eşleşip eşleşmediğini kontrol eder. Böylece site içi
// tadilat yapılan bilgisayar ile diğer kullanıcı bilgisayarlarının ayırt edilmesi sağlanır.
// Parametreler: Yok.
// Dönen Değerler: O anki ip'ni girilen iplerden biri ile uyuşuyorsa true uyuşmuyorsa false değeri döner.

function is_repmac()
{
	if( is_array(config::get('Repair','machines')) )
	{
		$result = in_array(ipv4(), config::get('Repair','machines'));
	}
	elseif( ipv4() == config::get('Repair','machines') )
	{
		$result = true;
	}
	else 
	{
		$result = false;
	}
	
	return $result;
}

// Function: is_value()
// İşlev: Parametrenin metinsel, sayılsal veya boolean türde veri içerip içermediğini kontrol eder.
// Parametreler: Herhangi bir değer.
// Dönen Değerler: Parametre metinsel, sayısal veya bollean türde ise true, değilse false değeri döner.

function is_value($str = NULL)
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

// Function: is_char()
// İşlev: Parametrenin metinsel veya sayılsal türde veri içerip içermediğini kontrol eder.
// Parametreler: Herhangi bir değer.
// Dönen Değerler: Parametre metinsel veya sayısal türde ise true, değilse false değeri döner.

function is_char($str = NULL)
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
function is_declared_class($class = '')
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

// Function: is_hash()
// İşlev: Parametrenin geçerli şifreleme algoritmalarından biri olup olmadığını kontrol eder.
// Parametreler: Herhangi bir değer.
// Dönen Değerler: Parametre geçerli algoritmalardan biri ise true, değilse false değeri döner.
function is_hash($type = '')
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

// Function: is_charset()
// İşlev: Parametrenin geçerli karakter seti olup olmadığını kontrol eder.
// Parametreler: Geçerli karakter seti.
// Dönen Değerler: Parametre geçerli karakter seti ise true, değilse false değeri döner.

function is_charset($charset = '')
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

// Function: charset_list()
// İşlev: Geçerli karakter seli listesini verir.
// Dönen Değerler: Karakter setlerini listeler.

function charset_list()
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
	if( ! is_value($data) )
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
| Örnek Kullanım: writeln('Merhaba {0}', array('Dünya')); // Merhaba Dünya       		  |
| Örnek Kullanım: writeln('Merhaba {x}', array('x' => 'Dünya')); // Merhaba Dünya         |
|          																				  |
******************************************************************************************/
function writeln($data = '', $vars = array(), $br_count = 1)
{
	echo write($data, $vars).str_repeat("<br>", $br_count);
}

// Function: compare()
// İşlev: İki veri arasında karşılaştırma yapmak için kullanılır.
// Parametreler: @p1 , @operator , $p2.
// Dönen Değerler: Karşılaştırma sağlanıyorsa true sağlanmıyorsa false değeri döner.
function compare($p1 = '', $operator = '=', $p2 = '')
{
	if( ! ( is_value($p1) || is_value($p2) ) )
	{
		return false;
	}
	
	if( ! is_string($operator) )
	{
		return false;	
	}
	
	return version_compare($p1, $p2, $operator);
}

// Function: ln()
// İşlev: Farklı işletim sistemlerine göre satır sonunu ifade eder.
// Dönen Değerler: \n\r, \r veya \n.

function ln($repeat = 1)
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

// Function: get_lang()
// İşlev: Sitenin aktif dilinin ne olduğu bilgisini verir.
// Parametreler: Yok.
// Dönen Değerler: Herhangi bir dil set edilmişse o dilin değeri edilmemişse varsayılan tr değeri döner.

function get_lang()
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

// Function: set_lang()
// İşlev: Sitenin aktif dilini ayarlamak için kullanılır.
// Parametreler: $l = değiştirilecek dilin kısaltması. Varsayılan tr değeridir.
// Dönen Değerler: Herhangi bir değer döndürmez set edilen değeri öğrenmek için gel_lang() yöntemi kullanılır.

function set_lang($l = "tr")
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
	
	
	$key 		= remove_extension($file, 'php');
	$file 		= config::get('Language', get_lang()).'/'.suffix($file, '.php');
	$langdir    = LANGUAGES_DIR.$file ;
	$syslangdir = SYSTEM_LANGUAGES_DIR.$file;
	
	global $lang;
	
	if( is_file_exists($langdir) ) 
	{
		require_once($langdir);	
	}
	elseif( is_file_exists($syslangdir) )
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
	elseif(isset($lang[$key]))
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

// Function: current_lang()
// İşlev: Sitenin aktif dilinin ne olduğu bilgisini verir get_lang() yönteminden farkı
// Config/Uri.php dosyasından lang = true olarak ayarlanmamışsa herhangi bir sonuç vermez.
// Parametreler: Yok..
// Dönen Değerler: Config/Uri.php dosyasından lang = true olarak ayarlı ise sitenin aktif dilini çevirir.
// herhangi bir set edilme gerçekleşmemişse varsayılan tr değerini döndürür.

function current_lang()
{
	if( ! isset($_SESSION) ) 
	{
		session_start();
	}
	
	if( ! config::get("Uri","lang") ) 
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

// Function: current_url()
// İşlev: Açık olan sayfanın o anki url adresini döndürür.
// Parametreler: Yok.
// Dönen Değerler: Sayfanın aktif url adresini döndürür.

function current_url()
{
	return ssl_status().host().clean_injection(server('request_uri'));
}

// Function: site_url()
// İşlev: Sitenin url adresini döndürür base_url() den farkı bazı Config ayarları
// ile eklenen dil, ssl ve index.php gibi ekleride url adresinde barındırır.
// Parametreler: $uri = Site url adresine uri eki ekler, $index = Girilen sayısal negatif değer kadar 
// üst dizinin url adresini verir.
// Dönen Değerler: Sitenin url adresini verir. http://www.example.com/index.php/

function site_url($uri = '', $index = 0)
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
	
	return ssl_status().$host.$new_base_dir.index_status().suffix(current_lang()).clean_injection($uri);
}

// Function: base_url()
// İşlev: Sitenin kök url adresini döndürür. Configten eklenen dil veya index.php gibi ekler ilave edilmez.
// Parametreler: $uri = Site kök url adresine uri eki ekler, $index = Girilen sayısal negatif değer kadar 
// üst dizinin kök url adresini verir.
// Dönen Değerler: Sitenin kök url adresini verir. http://www.example.com/

function base_url($uri = '', $index = 0)
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
	
	return ssl_status().$host.$new_base_dir.clean_injection($uri);
}	
	
// Function: prev_url()
// İşlev: Bir önceki gelinen sayfanın url adresini verir.
// Parametreler: Yok.
// Dönen Değerler: Bir önceki gelinen sayfanın url adresini döndürür.
	
function prev_url()
{
 $str = str_replace(ssl_status().host().BASE_DIR.index_status(), "",server("referer"));
	
	if( current_lang() )
	{
		$str_ex = explode("/",$str);
		$str    = str_replace($str_ex[0]."/", "", $str);	
	}
	
	return site_url(clean_injection($str));	
}

// Function: hostname()
// İşlev: Sitenin bulunduğu sunucunun adresini verir.
// Parametreler: $uri = Sunucu adresine eklenecek uri eki.
// Dönen Değerler: Bir önceki gelinen sayfanın url adresini döndürür. http://sunucuadi/
	
function hostname($uri = "")
{	
	if( ! is_string($uri) ) 
	{
		return false;
	}
	
	return ssl_status().suffix(host()).clean_injection($uri);
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

// Function: current_path()
// İşlev: Açık olan sayfanın o anki yolunu verir.
// Parametreler: $is_path = true olması durumunda aktif yolun tamamını verir
// false olması durumunda ise sadece son segmentin bilgisini verir. 
// Dönen Değerler: Sayfanın o anki yolunu verir.  is_path = true: home/example is_path = false: example

function current_path($is_path = true)
{
	if( ! is_bool($is_path) ) 
	{
		$is_path = true;
	}
	
	$current_page_path = str_replace("/".get_lang()."/", "", server('current_path'));
	
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

// Function: base_url()
// İşlev: Sitenin kök yolunu döndürür. Configten eklenen dil veya index.php gibi ekler ilave edilmez.
// Parametreler: $uri = Site kök yoluna uri eki ekler, $index = Girilen sayısal negatif değer kadar 
// üst dizinin kök yolunu verir.
// Dönen Değerler: Sitenin kök yolunu verir. znframework/

function base_path($uri = '', $index = 0)
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
	
	return clean_injection($new_base_dir.$uri);
}

// Function: prev_path()
// İşlev: Bir önceki gelinen sayfanın yolunu verir.
// Parametreler: $is_path = true olması durumunda gelinen yolun tamamını verir
// Dönen Değerler: Bir önceki gelinen sayfanın yolunu döndürür.
	
function prev_path($is_path = true)
{
	if( ! is_bool($is_path) ) 
	{
		$is_path = true;
	}
	
	$str = str_replace(ssl_status().host().BASE_DIR.index_status(), '', server("referer"));
	
	if( current_lang() )
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

// Function: file_path()
// İşlev: Parametre olarak girilen yol url bilgisi içeriyorsa bu bilgiyi ayıklar
// ve dosyanın yolunu verir.
// Parametreler: $file = dosya adı, $remove_url = ayıklanacak url adresi
// Dönen Değerler: Dosyanın yolunu verir.

function file_path($file = "", $remove_url = "")
{
	if( ! is_string($file) ) 
	{
		return false;
	}
	
	if( ! is_string($remove_url) ) 
	{
		$remove_url = "";
	}
	
	if( is_url($file) )
	{
		if( ! is_url($remove_url) )
		{
			$remove_url = base_url();
		}
		
		$file = trim(str_replace($remove_url, '', $file));
	}
	
	return $file;
}


// Function: path_info()
// İşlev: Dosya hakkında uzantı dizin adı dosya adı gibi ayrıntılar hakkında bilgi verir.
// Parametreler: $file = dosya yolu, $info = basename, dirname, filename, extension
// Dönen Değerler: Dosya hakkında bilgi.

function path_info($file = "", $info = "basename")
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
	
	return $dote.strtolower(path_info($file, "extension"));
}

// Function: remove_extension()
// İşlev: Metinsel dosya isimlerinde yer alan uzantıları kaldırmak için kullanılır.
// Dönen Değerler: Uzantısı kaldırılmış dosya adı.

function remove_extension($file = '')
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
	
	if( ! is_value($index)) 
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
	if( server("client_ip") )   //paylaşımlı bir bağlantı mı kullanıyor?
	{
		$ip = server("client_ip");
	}
	elseif( server("x_forwarded_for") )   //ip adresi proxy'den mi geliyor?
	{
		$ip = server("x_forwarded_for");
	}
	else
	{
	  	$ip = server("remote_addr");
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
	
	if ( ! is_url($url) )
	{
		$url = site_url($url);
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

// Function: redirect_data()
// İşlev: Yönlendirme ile gönderilen datayı okumak için kullanıloır.
// Parametreler: $k = Gönderilen bilginin anahtar kelimesi.
// Dönen Değerler: Anahtar ifadenin değeri.

function redirect_data($k = '')
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
	$shortname = ns_short_name($class);

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

/******************************************************************************************
* IMPORTED LIBRARIES - DAHİL EDİLDİĞİ SÜRÜM:1.2                                           *
*******************************************************************************************
| Genel Kullanım: Dahil edilen kütüphane listesine erişmek için kullanılır.				  | 
|          																				  |
******************************************************************************************/
function imported_libraries()
{	
	$libraries = array();
	
	foreach(get_required_files() as $files) 
	{
		$real_libdir = 'Libraries';

		if( strstr($files, $real_libdir) )
		{
			$fileex = explode($real_libdir, $files);
			
			$class = remove_extension($fileex[1]);
			
			$libraries[] = str_replace(array('\\','/'), '', $class);
		}	
	}
	
	return $libraries;
}

/******************************************************************************************
* IMPORTED TOOLS - DAHİL EDİLDİĞİ SÜRÜM:1.2                                               *
*******************************************************************************************
| Genel Kullanım: Dahil edilen kütüphane listesine erişmek için kullanılır.				  | 
|          																				  |
******************************************************************************************/
function imported_tools()
{	
	$tools = array();
	
	foreach(get_required_files() as $files) 
	{
		$real_libdir = 'Tools';

		if( strstr($files, $real_libdir) )
		{
			$fileex = explode($real_libdir, $files);
			
			$class = remove_extension($fileex[1]);
			
			$tools[] = str_replace(array('\\','/'), '', $class);
		}	
	}
	
	return $tools;
}

// Function: get_message()
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
function get_message($lang_file, $error_msg, $ex = '')
{
	return lang($lang_file, $error_msg, $ex);
}

// Function: error_report()
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
function error_report($type = NULL)
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

// Function: current_uri()
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
function current_uri()
{
	if( BASE_DIR !== '/' )
	{
		$cu = str_replace(BASE_DIR, '', server('request_uri'));
	}
	else
	{
		$cu = substr(server('request_uri'), 1);
	}
	
	if( index_status() ) 
	{
		$cu = str_replace('index.php/', '', $cu);
	}
	
	return $cu;
}

// Function: request_uri()
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
function request_uri()
{
	$request_uri = ( server('current_path') ) 
	               ? substr(server('current_path'), 1) 
				   : current_uri();
	
	if( @$request_uri[strlen($request_uri) - 1] === "/" )
	{
			$request_uri = substr($request_uri, 0, -1);
	}
	
	$request_uri = route_uri($request_uri);
	
	return str_replace(suffix(get_lang()), '', clean_injection($request_uri));
}

// Function: route_uri()
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
function route_uri($request_uri = '')
{
	if( config::get("Route","open_page") )
	{
			if( $request_uri === 'index.php' || empty($request_uri) || $request_uri === get_lang() ) 
			{
				$request_uri = config::get("Route","open_page");
			}
	}
			
	$uri_change = config::get('Route','change_uri');
		
	if( ! empty($uri_change) )
	{
		foreach($uri_change as $key => $val)
		{		
			$request_uri = preg_replace('/'.$key.'/xi', $val, $request_uri);
		}
	}
	
	return $request_uri;
}

// Function: clean_injection()
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
function clean_injection($string = "")
{
	$url_injection_change_chars = config::get("Security", "url_change_chars");

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
	if( ! config::get('Log', 'create_file')) 
	{
		return false;
	}
	
	$log_dir = APP_DIR.'Logs/';
	$extension = '.log';
	
	if( ! is_dir($log_dir) )
	{
		folder::create($log_dir, 0777);	
	}
	
	if( is_file($log_dir.suffix($destination,$extension)) )
	{
		if( empty($time) ) 
		{
			$time = config::get('Log', 'file_time');
		}
		
		$create_date = file::create_date($log_dir.suffix($destination,$extension), 'd.m.Y');
		
		$end_date = strtotime("$time",strtotime($create_date));
		
		$end_date = date('Y.m.d' ,$end_date );
		
		if( date('Y.m.d')  >  $end_date )
		{
			file::delete($log_dir.suffix($destination,$extension));
		}
	}

	$message = "IP: ".ipv4()." | Subject: ".$subject.' | Date: '.date('d.m.Y h:i:s')." | Message: ".$message.ln();
	error_log($message, 3, $log_dir.suffix($destination,$extension));
}

// Function: create_htaccess_file()
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
function create_htaccess_file()
{	
	// Cache.php ayar dosyasından ayarlar çekiliyor.
	$config = config::get('Cache');
	
	//-----------------------GZIP-------------------------------------------------------------
	// mod_gzip = true ayarı yapılmışsa aşağıdaki kodları ekler.
	// Gzip ile ön bellekleme başlatılmış olur.
	if( $config['mod_gzip']['status'] === true ) 
	{
		$mod_gzip = '<ifModule mod_gzip.c>
mod_gzip_on Yes
mod_gzip_dechunk Yes
mod_gzip_item_include file .('.$config['mod_gzip']['included_file_extension'].')$
mod_gzip_item_include handler ^cgi-script$
mod_gzip_item_include mime ^text/.*
mod_gzip_item_include mime ^application/x-javascript.*
mod_gzip_item_exclude mime ^image/.*
mod_gzip_item_exclude rspheader ^Content-Encoding:.*gzip.*
</ifModule>'.ln(2);
	}
	else
	{
		$mod_gzip = '';
	}
	//-----------------------GZIP-------------------------------------------------------------
	
	//-----------------------EXPIRES----------------------------------------------------------
	// mod_expires = true ayarı yapılmışsa aşağıdaki kodları ekler.
	// Tarayıcı ile ön bellekleme başlatılmış olur.
	if( $config['mod_expires']['status'] === true ) 
	{
		$exp = '';
		foreach($config['mod_expires']['file_type_time'] as $type => $value)
		{
			$exp .= 'ExpiresByType '.$type.' "access plus '.$value.' seconds"'.ln();
		}
		
		$mod_expires = '<ifModule mod_expires.c>
ExpiresActive On
ExpiresDefault "access plus '.$config['mod_expires']['default_time'].' seconds"
'.$exp.'
</ifModule>'.ln(2);
	}
	else
	{
		$mod_expires = '';
	}
	//-----------------------EXPIRES----------------------------------------------------------
	
	//-----------------------HEADERS----------------------------------------------------------
	// mod_headers = true ayarı yapılmışsa aşağıdaki kodları ekler.
	// Header ile ön bellekleme başlatılmış olur.
	if( $config['mod_headers']['status'] === true ) 
	{
		$fmatch = '';
		foreach($config['mod_headers']['file_extension_time_access'] as $type => $value)
		{
			$fmatch .= '<filesMatch "\.('.$type.')$">
Header set Cache-Control "max-age='.$value['time'].', '.$value['access'].'"
</filesMatch>'.ln();
		}
		
		$mod_headers = '<ifModule mod_headers.c>
'.$fmatch.'
</ifModule>
'.ln(2);
	}
	else
	{
		$mod_headers = '';
	}
	//-----------------------HEADERS----------------------------------------------------------
	
	//-----------------------HEADER SET-------------------------------------------------------
	$headerset = config::get("Headers");
	
	if( ! empty($headerset['set_htaccess_file']) )
	{
		$headers_iniset  = "<ifModule mod_expires.c>".ln();	
		
		foreach($headerset['iniset'] as $val)
		{
			$headers_iniset .= "$val".ln();
		}
		
		$headers_iniset .= "</ifModule>".ln(2);
	}
	else
	{
		$headers_iniset = '';
	}
	//-----------------------HEADER SET-------------------------------------------------------
	
	//-----------------------HTACCESS SET-----------------------------------------------------	
	$htaccess_settings = config::get("Htaccess");
	
	if( ! empty($htaccess_settings['set_file']) )
	{
		$htaccess_settings_str = '';
		
		foreach($htaccess_settings['settings'] as $key => $val)
		{
			$htaccess_settings_str .= "<$key>".ln();
			
			foreach($val as $v)
			{
				$htaccess_settings_str .= $v;
			}
			
			$keyex = explode(" ", $key);
			$htaccess_settings_str .= ln()."</$keyex[0]>".ln(2);
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
	if( ! config::get('Uri','index.php') )
	{
		$htaccess .= "<IfModule mod_rewrite.c>".ln();
		$htaccess .= "RewriteEngine On".ln();
		$htaccess .= "RewriteBase /".ln();
		$htaccess .= "RewriteCond %{REQUEST_FILENAME} !-f".ln();
		$htaccess .= "RewriteCond %{REQUEST_FILENAME} !-d".ln();
		$htaccess .= 'RewriteRule ^(.*)$  '.server('script_name').config::get("Uri","index_suffix").'/$1 [L]'.ln();
		$htaccess .= "</IfModule>";
	}
	//-----------------------URI INDEX PHP----------------------------------------------------
	
	//-----------------------UPLOAD SETTINGS--------------------------------------------------
	$uploadset = config::get('Upload');		
	
	if( ! empty($uploadset['set_htaccess_file']) )
	{
		$upload_settings = $uploadset['settings'];
	}
	else
	{
		$upload_settings = array();
	}
	//-----------------------UPLOAD SETTINGS--------------------------------------------------
	
	//-----------------------SESSION SETTINGS-------------------------------------------------
	$sessionset = config::get('Session');	
			
	if( ! empty($sessionset['set_htaccess_file']) )
	{
		$session_settings = $sessionset['settings'];
	}
	else
	{
		$session_settings = array();
	}
	//-----------------------SESSION SETTINGS-------------------------------------------------
	
	//-----------------------INI SETTINGS-----------------------------------------------------	
	$iniset = config::get('Ini');	
		
	if( ! empty($iniset['set_htaccess_file']) )
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
				$sets .= "php_value $k $v".ln();		 
			}			
		}
		
		if( ! empty($sets) )
		{
			$htaccess .= ln()."<IfModule mod_php5.c>".ln();
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

// Function: ssl_status()
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
function ssl_status()
{
	if( config::get('Uri','ssl') )
	{ 
		return 'https://'; 
	}
	else
	{ 
		return 'http://';	
	}
}

// Function: index_status()
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
function index_status()
{
	if( config::get('Uri','index.php') ) 
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
function ns_short_name($class = '')
{
	$namespaces = config::get('Namespace', 'short_name');
	
	$longns  = array_values($namespaces);
	$shortns = array_map('strtolower', array_keys($namespaces));	
	$number  = array_search(strtolower($class), $shortns);
	
	$namespace = $number > -1
			   ? $longns[$number]
			   : $namespace = '';	
	
	return array('classname' => $class, 'namespace' => $namespace);
}
//------------------------------------SYSTEM FUNCTIONS END----------------------------------------------------------------------------