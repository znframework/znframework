<?php
/************************************************************/
/*                     LIBRARY CONVERT                      */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* CONVERT                                                                             	  *
*******************************************************************************************
| Sınıfı Kullanırken : convert::, $this->convert, zn::$use->convert, uselib('convert')	  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/	
class Convert
{
	/******************************************************************************************
	* CHAR CONVERTER                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Karakterleri bir türden diğer türe dönüştürmek için kullanılır. 		  |
	|																						  |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @string => Dönüştürülecek metin.				                          |
	| 2. [ string var @type ] => Hangi türden dönüşüm yapılacağı. Varsayılan:char			  |
	| 3. [ string var @change_type ] => Hangi türe dönüşüm yapılacağı. Varsayılan:html		  |
	|   																					  |
	| Dönüştürülebilecek türler => char, html, dex, hex										  |
	|       																				  |
	| Örnek Kullanım:  																	      |
	| echo char_converter('Metin'); // Kaynak Kod Çıktı: &#77;&#101;&#116;&#105;&#110; 		  |
	| echo char_converter('Metin', 'char', 'dec'); // Çıktı: 77 101 116 105 110 			  |
	| echo char_converter('Metin', 'char', 'hex'); // Çıktı: 4D 65 74 69 6E 				  |
	|																						  |
	| Kendi Aralarında Dönüştürme														      |
	| $html = char_converter('Metin');														  |
	| $dec = char_converter('Metin', 'char', 'dec');										  |
	| $hex = char_converter('Metin', 'char', 'hex');										  |
	|																						  |
	| echo char_converter($hex, 'hex', 'char'); // Çıktı: Metin								  |
	| echo char_converter($dec, 'dec', 'hex'); // Çıktı: 4D 65 74 69 6E					      |
	| echo char_converter($html, 'html', 'dec'); // Çıktı: 77 101 116 105 110                 |	
	|       																				  |																					  |
	******************************************************************************************/
	public static function char($string = '', $type = 'char', $change_type = 'html')
	{
		if( ! isValue($string) ) 
		{
			return false;
		}
		if( ! is_string($type) ) 
		{
			$type = 'char';
		}
		if( ! is_string($change_type) ) 
		{
			$change_type = 'html';
		}
		
		for($i=32; $i<=255; $i++)
		{
			$hex_remaining = ($i%16);
			$hex_remaining = str_replace(array(10,11,12,13,14,15),array('A','B','C','D','E','F'),$hex_remaining);
			$hex = ( floor($i/16) ).$hex_remaining;
			
			if( $hex[0] == '0' ) 
			{
				$hex = $hex[1];	
			}
			
			if( chr($i) !== ' ' )
			{
				$chars['char'][] 	= chr($i);
				$chars['dec'][] 	= $i." ";
				$chars['hex'][] 	= $hex." ";
				$chars['html'][] 	= "&#{$i};";
			}		
		}	
		
		return str_replace($chars[strtolower($type)], $chars[strtolower($change_type)], $string);
	}

	/******************************************************************************************
	* ACCENT CONVERTER                                                                        *
	*******************************************************************************************
	| Genel Kullanım: Yabancı içerikli karaketerleri standart karakterlere dönüştürür. 		  |
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string var @string => Dönüştürülecek metin.				                          |
	|       																				  |
	| Örnek Kullanım:  																	      |
	| echo accent_converter('Åķŝǻň'); // Çıktı: Aksan 										  |
	|       																				  |
	******************************************************************************************/
	public static function accent($str = '') 
	{	
		if( ! is_string($str) ) 
		{
			return false;
		}
		
		// Config/ForeignChars.php dosyasından
		// kullanılacak karakter listesini al.
		$accent = Config::get('ForeignChars', 'accentChars');
		
		$accent = Arrays::multikey($accent);
		
		return str_replace(array_keys($accent), array_values($accent), $str); 
	} 

	/******************************************************************************************
	* URL WORD CONVERTER                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Yabancı karaketer içerikli metni url yapısına uygun hale dönüştürür 	  |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @string => Dönüştürülecek metin.				                          |
	| 1. [ string var @splitword ] => Kelimeler arasına konacak işaret. Varsayılan:-		  |
	|       																				  |
	| Örnek Kullanım:  																	      |
	| echo url_word_converter('Zn Kod Çatısına Hoş'); // zn-kod-catisina-hos 				  |
	| echo url_word_converter('Zn Kod Çatısına Hoş', '/'); //  zn/kod/catisina/hos			  |
	|       																				  |
	******************************************************************************************/
	public static function urlWord($str = '', $splitword = '-')
	{
		if( ! is_string($str) ) 
		{
			return false;
		}
	
		if( ! is_string($splitword) ) 
		{
			$splitword = "-";
		}	
		
		$accent = Config::get('ForeignChars', 'accentChars');
		
		$accent = Arrays::multikey($accent);
		
		$badchars = Config::get('Security', 'urlBadChars');
		
		$str = str_replace(array_keys($accent), array_values($accent), $str); 
		
		$str = str_replace($badchars, '', $str);
		
		$str = preg_replace("/\s+/", ' ', $str);
		
		$str = str_replace("&nbsp;", '', $str);
		
		$str = str_replace(' ', $splitword, trim(strtolower($str)));
		
		return $str;
		
	}

	/******************************************************************************************
	* CASING CONVERTER                                                                        *
	*******************************************************************************************
	| Genel Kullanım: Küçük büyük harf dönüştürmeleri yapmak için kullanılır.			  	  |
	|																						  |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @string => Dönüştürülecek metin.				                          |
	| 2. [ string var @type ] => Dönüşümün tipi. Varsayılan:lower					     	  |
	| 3. [ string var @encoding ] => Dönüşümün karakter seti. Varsayılan:utf-8				  |
	|       																				  |
	| Kullanılabilir Dönüşüm Tipleri: lower, upper, title   								  |
	|																						  |
	| Örnek Kullanım:  																	      |
	| echo case_converter('Zn Kod Çatısına Hoş'); // Çıktı: zn kod çatısına hoş				  |
	| echo case_converter('Zn Kod Çatısına Hoş', 'upper'); // Çıktı: ZN KOD ÇATISINA HOŞ	  |
	| echo case_converter('Zn Kod Çatısına Hoş', 'title'); // Çıktı: Zn Kod Çatısına Hoş	  |
	|       																				  |
	******************************************************************************************/
	public static function casing($str = '', $type = 'lower', $encoding = "utf-8")
	{
		if( ! is_string($str) ) 
		{
			return false;
		}
		
		if( ! is_string($type) ) 
		{
			$type = 'lower';
		}
		
		$types  = array
		(
			'lower' => MB_CASE_LOWER,
			'upper' => MB_CASE_UPPER,
			'title' => MB_CASE_TITLE
		);
		
		if( isset($types[$type]) ) 
		{
			$type = $types[$type];
		}
		else
		{
			$type = $types["lower"];
		}
		
		return mb_convert_case($str, $type, $encoding);	
	}	

	/******************************************************************************************
	* CHARSET CONVERTER                                                                       *
	*******************************************************************************************
	| Genel Kullanım: Küçük büyük harf dönüştürmeleri yapmak için kullanılır.			  	  |
	|																						  |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @string => Dönüştürülecek metin.				                          |
	| 2. [ string var @from_charset ] => Hangi karakter setinden. Varsayılan:utf-8			  |
	| 3. [ string var @to_charset ] => Hangi karakter setine. Varsayılan:utf-8				  |
	|																						  |
	| Örnek Kullanım:  																	      |
	| echo case_converter('Zn Kod Çatısına Hoş', 'latin5', 'urtf-8');                         |
	|       																				  |
	******************************************************************************************/
	public static function charset($str = '', $from_charset = 'utf-8', $to_charset = 'utf-8')
	{
		if( ! is_string($str) ) 
		{
			return false;
		}
		
		if( ! isCharset($from_charset) || ! isCharset($to_charset) ) 
		{
			return false;
		}
		
		return mb_convert_encoding($str, $from_charset, $to_charset);	
	}
	
	/******************************************************************************************
	* TO INT			                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü int türüne çevirmek için kullanılır.			  |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public static function toInt($var = NULL)
	{
		return (int)$var;	
	}
	
	/******************************************************************************************
	* TO INTEGER			                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü int türüne çevirmek için kullanılır.			  |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public static function toInteger($var = NULL)
	{
		return (integer)$var;	
	}
	
	/******************************************************************************************
	* TO BOOL			                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü boolean türüne çevirmek için kullanılır.		  |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public static function toBool($var = NULL)
	{
		return (bool)$var;	
	}
	
	/******************************************************************************************
	* TO BOOLEAN    	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü boolean türüne çevirmek için kullanılır.		  |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public static function toBoolean($var = NULL)
	{
		return (boolean)$var;	
	}
	
	/******************************************************************************************
	* TO STRING      	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü string türüne çevirmek için kullanılır.		  |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public static function toString($var = NULL)
	{
		if( is_array($var) || is_object($var) ) 
		{
			return $var;
		}
		
		return (string)$var;	
	}
	
	/******************************************************************************************
	* TO FLOAT      	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü float türüne çevirmek için kullanılır.		      |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public static function toFloat($var = NULL)
	{
		return (float)$var;	
	}	
	
	/******************************************************************************************
	* TO REAL        	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü real türüne çevirmek için kullanılır.		      |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public static function toReal($var = NULL)
	{
		return (real)$var;	
	}	
	
	/******************************************************************************************
	* TO DOUBLE      	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü double türüne çevirmek için kullanılır.		  |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public static function toDouble($var = NULL)
	{
		return (double)$var;	
	}
	
	/******************************************************************************************
	* TO OBJECT      	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü object türüne çevirmek için kullanılır.		  |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public static function toObject($var = NULL)
	{
		return (object)$var;	
	}
	
	/******************************************************************************************
	* TO ARRAY      	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü array türüne çevirmek için kullanılır.		      |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public static function toArray($var = NULL)
	{
		return (array)$var;	
	}
	
	/******************************************************************************************
	* TO UNSET      	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkeni silmek için kullanılır.		  								  |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Silinecek değişken.				                         	  	  |
	|       																				  |
	******************************************************************************************/
	public static function toUnset($var = NULL)
	{
		return (unset)$var;	
	}
	/******************************************************************************************
	* VAR TYPE			                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü değiştirmek için kullanılır.			  	  	  |	
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	| 2. [ string var @type ] => Hangi türe. Varsayılan:int									  |
	|																						  |
	| Örnek Kullanım:  																	      |
	| echo case_converter('Zn Kod Çatısına Hoş', 'latin5', 'urtf-8');                         |
	|       																				  |
	******************************************************************************************/
	public static function varType($var = '', $type = 'int')
	{
		if( ! is_string($type) ) 
		{
			return false;
		}
		
		switch($type)
		{
			case 'int':
				return (int)$var;
			break;	
			
			case 'integer':
				return (integer)$var;
			break;	
			
			case 'bool':
				return (bool)$var;
			break;	
			
			case 'boolean':
				return (boolean)$var;
			break;
			
			case 'str':
			case 'string':
				if(is_array($var) || is_object($var)) return $var;
				return (string)$var;
			break;
			
			case 'float':
				return (float)$var;
			break;
			
			case 'real':
				return (real)$var;
			break;
			
			case 'double':
				return (double)$var;
			break;
			
			case 'object':
				return (object)$var;
			break;
			
			case 'array':
				return (array)$var;
			break;
			
			case 'unset':
				return (unset)$var;
			break;
		}
	}
}