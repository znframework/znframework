<?php 
/************************************************************/
/*                       CLASS SECURITY                     */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* SECURITY                                                                            	  *
*******************************************************************************************
| Sınıfı Kullanırken      :	Security:: , $this->security , zn::$use->security   		  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/
class Security
{
	/******************************************************************************************
	* NC ENCODE                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Kötü içerikli karakterlerin temizlemesi için                            |
	| kullanılır.												                              |
	|															                              |
	| Parametreler: 3 adet parametre alır.                                                    |
	| 1. string var @string => Temizleme yapılacak metin.                                     |
	| 2. string/array var @badword => Kötü içerikli kelimeler.                                |
	| 3. string/array var @changechar => Değiştirilecek kelilemeler                           |
	|          																				  |
	| 2. ve 3. Parametreler kullanılmaz ise varsayılan olarak Config/Security.php dosyasında  |
	| yer alan nc_encode => change chars karakterleri ayarlı olacaktır. 					  |
	******************************************************************************************/
	public static function ncEncode($string = '', $badWords = '', $changeChar = '[badchars]')
	{
		if( ! is_string($string)) 
		{
			return false;
		}
	
		// 2. Parametre boş ise varsayılan olarak Config/Security.php dosya ayarlarını kullan.	
		if( empty($badWords) )
		{
			$secnc = Config::get("Security", 'ncEncode');
			$badWords = $secnc['bad_chars'];
			$changeChar = $secnc['change_bad_chars'];
		}
		if( ! is_array($badWords)) return  $string = Regex::replace($badWords, $changeChar, $string, 'xi');
		
		$ch = '';
		$i = 0;	
		
		foreach($badWords as $value)
		{		
			if( ! is_array($changeChar) )
			{
				$ch = $changeChar;
			}
			else
			{
				if( isset($changeChar[$i]) )
				{
					$ch = $changeChar[$i];	
					$i++;
				}
			}
			
			$string = Regex::replace($value, $ch, $string, 'xi');
		}
	
		return $string;
	}	
		
		
	/******************************************************************************************
	* INJECTION ENCODE                                                                        *
	*******************************************************************************************
	| Genel Kullanım: SQL sorgularında tehdit edici karakterlerin izole edilmesi için         |
	| kullanılır. Hangi karakterlerin izole edileceği Config/Security.php dosyasında yer alan.|									         
	| Injection_bad_chars parametresinde mevcuttur.											  |				                           
	| Parametreler: 3 adet parametre alır. 													  |
	|																						  |                                                   
	| 1. string var @string => Temizleme yapılacak metin.                                     |
	******************************************************************************************/	
	public static function injectionEncode($string = '')
	{
		if( ! is_string($string)) 
		{
			return false;
		}
		
		$secBadChars = Config::get("Security", 'injectionBadChars');
		
		if( ! empty($secBadChars)) 
		{
			foreach($secBadChars as $badChar => $changeChar)
			{
				if(is_numeric($badChar))
				{
					$badChar = $changeChar;
					$changeChar = '';
				}
				
				$badChar = trim($badChar, '/');
				
				$string = preg_replace('/'.$badChar.'/xi', $changeChar, $string);
			}
		}
		
		return addslashes(trim($string));
	}
	
	
	/******************************************************************************************
	* INJECTION DECODE                                                                        *
	*******************************************************************************************
	| Genel Kullanım: SQL sorgularında tehdit edici karakterlerin izole edilen karakterlerin  |
	| kullanılır. Ancak sadece izole edilen tırnak işareleri tekrar eski haline getirilir.    |
	|																						  |	
	| 1. string var @string => Temizleme yapılacak metin. 									  |								       
	******************************************************************************************/	
	public static function injectionDecode($string = '')
	{
		if( ! is_string($string))
		{ 
			return false;
		}
		
		return stripslashes(trim($string));
	}
	
	
	/******************************************************************************************
	* XSS ENCODE                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Script kodların kullanımında tehdit edici karakterlerin izole edilmesini|
	| sağlamak için kullanılır. Dönüştürülecek karakterlerin listesi için Cofig/Security.php  |	
	|																						  |
	| 1. string var @string => Temizleme yapılacak metin.           					      |
	******************************************************************************************/	
	public static function xssEncode($string = '')
	{
		if( ! is_string($string)) 
		{
			return false;
		}
		
		$secBadChars = Config::get("Security", 'scriptBadChars');
		
		if( ! empty($secBadChars)) 
		{
			foreach($secBadChars as $badChar => $changeChar)
			{
				if(is_numeric($badChar))
				{
					$badChar = $changeChar;
					$changeChar = '';
				}
				
				$badChar = trim($badChar, '/');
				
				$string = preg_replace('/'.$badChar.'/xi', $changeChar, $string);
			}
		}
		
		return $string;
	}


	/******************************************************************************************
	* HTML EMCODE                                                                             *
	*******************************************************************************************
	| Genel Kullanım: HTML özel karakterlerinin ( < , > )izole edilmesini                     |
	| sağlamak için kullanılır. 															  |	
	|																						  |
	| 1. string var @string => Temizleme yapılacak metin.           					      |
	| 2. string var @type => Tırnak işaretleri.           					                  |
	******************************************************************************************/	
	public static function htmlEncode($string, $type = 'quotes')
	{
		if( ! is_string($string)) 
		{
			return false;
		}
		
		if( ! is_string($type)) 
		{	
			$type = 'quotes';
		}
		
		if($type === 'quotes') 
		{
			$tp = ENT_QUOTES; 
		}
		elseif($type === 'nonquotes')
		{
			$tp = ENT_NOQUOTES; 
		}
		else 
		{
			$tp = ENT_COMPAT;
		}
		
		return htmlspecialchars(trim($string), $tp);
	}
	
	
	/******************************************************************************************
	* HTML DECODE                                                                             *
	*******************************************************************************************
	| Genel Kullanım: İzole edilen HTML özel karakterlerinin ( < , > ) gerçek hallerine       |
	| dönmesini sağlamak için kullanılır. 												      |	
	|																						  |
	| 1. string var @string => Temizleme yapılacak metin.           					      |
	| 2. string var @type => Tırnak işaretleri.           					                  |
	******************************************************************************************/	
	public static function htmlDecode($string, $type = 'quotes')
	{
		if( ! is_string($string))
		{
			return false;
		}
		
		if( ! is_string($type)) 
		{
			$type = 'quotes';
		}
		
		if($type === 'quotes')
		{ 
			$tp = ENT_QUOTES; 
		}
		elseif($type === 'combat')
		{	
			$tp = ENT_COMPAT; 
		}
		else 
		{
			$tp = ENT_NOQUOTES;
		}
		
		return htmlspecialchars_decode(trim($string), $tp);
	}
	
	// Function: phpTagEncode()
	// İşlev: Php taglarını numerik koda çevirir.
	// Parametreler
	// @str = Şifrelenecek data.
	// Dönen Değer: Şifrelenmiş bilgi.
	public static function phpTagEncode($str = '')
	{
		if( ! is_string($str) || empty($str) ) 
		{
			return false;
		}
		
		$phpTagChars = array
		(
			'<?' => '&#60;&#63;',
			'?>' => '&#63;&#62;'
		);
		
		return str_replace(array_keys($phpTagChars), array_values($phpTagChars), $str);
	}
	
	// Function: phpTagDecode()
	// İşlev: Php taglarını numerik koda çevirir.
	// Parametreler
	// @str = Şifrelenecek data.
	// Dönen Değer: Şifrelenmiş bilgi.
	public static function phpTagDecode($str = '')
	{
		if( ! is_string($str) || empty($str) ) 
		{
			return false;
		}
		
		$phpTagChars = array
		(
			'<?' => '&#60;&#63;',
			'?>' => '&#63;&#62;'
		);
		
		return str_replace(array_values($phpTagChars), array_keys($phpTagChars), $str);
	}
	
	// Function: nailEncode()
	// İşlev: Tırnak işaretlerini numerik koda dönüştürmek çevirir.
	// Parametreler
	// @str = Şifrelenecek data.
	// Dönen Değer: Şifrelenmiş bilgi.
	public static function nailEncode($str = '')
	{
		if( ! is_string($str) || empty($str) ) 
		{
			return false;
		}
		
		$nailChars = array
		(
			"'" => "&#145;",
			'"' => "&#147;"
		);
		
		$str = str_replace(array_keys($nailChars), array_values($nailChars), $str);
		
		return $str;
	}
	
	// Function: nailDecode()
	// İşlev: Tırnak işaretlerini numerik koda dönüştürmek çevirir.
	// Parametreler
	// @str = Şifrelenecek data.
	// Dönen Değer: Şifrelenmiş bilgi.
	public static function nailDecode($str = '')
	{
		if( ! is_string($str) || empty($str) ) 
		{
			return false;
		}
		
		$nailChars = array
		(
			"'" => "&#145;",
			'"' => "&#147;"
		);
		
		$str = str_replace(array_values($nailChars), array_keys($nailChars), $str);
		
		return $str;
	}
	
	// Function: foreignCharEncode()
	// İşlev: Farklı dillerdeki yabancı karakterleri numerik koda çevirir.
	// Parametreler
	// @str = Şifrelenecek data.
	// Dönen Değer: Şifrelenmiş bilgi.
	public static function foreignCharEncode($str = '')
	{	
		if( ! is_string($str) || empty($str) ) 
		{
			return false;
		}
		
		$chars = Config::get('ForeignChars', 'numericalCodes');
		
		return str_replace(array_keys($chars), array_values($chars), $str);
	}	
	
	// Function: foreignCharDecode()
	// İşlev: Farklı dillerdeki yabancı karakterleri numerik koda çevirir.
	// Parametreler
	// @str = Şifrelenecek data.
	// Dönen Değer: Şifrelenmiş bilgi.
	public static function foreignCharDecode($str = '')
	{	
		if( ! is_string($str) || empty($str) ) 
		{
			return false;
		}
		
		$chars = Config::get('ForeignChars', 'numericalCodes');
		
		return str_replace(array_values($chars), array_keys($chars), $str);
	}	
}