<?php
/************************************************************/
/*                 TOOL CONVERTERS                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

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
if(!function_exists('char_converter'))
{
	function char_converter($string = '', $type = 'char', $change_type = 'html')
	{
		if( ! is_value($string) ) 
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
if(!function_exists('accent_converter'))
{
	function accent_converter($str = '') 
	{	
		if( ! is_string($str) ) 
		{
			return false;
		}
		
		import::tool('Array');
		
		// Config/ForeignChars.php dosyasından
		// kullanılacak karakter listesini al.
		$accent = config::get('ForeignChars', 'accent_chars');
		
		$accent = multi_key_array($accent);
		
		return str_replace(array_keys($accent), array_values($accent), $str); 
	} 
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
if( ! function_exists('url_word_converter'))
{
	function url_word_converter($str = '', $splitword = '-')
	{
		if( ! is_string($str) ) 
		{
			return false;
		}
	
		if( ! is_string($splitword) ) 
		{
			$splitword = "-";
		}	
		
		import::tool('Array');
		
		$accent = config::get('ForeignChars', 'accent_chars');
		
		$accent = multi_key_array($accent);
		
		$badchars = config::get('Security', 'url_bad_chars');
		
		$str = str_replace(array_keys($accent), array_values($accent), $str); 
		
		$str = str_replace($badchars, '', $str);
		
		$str = preg_replace("/\s+/", ' ', $str);
		
		$str = str_replace("&nbsp;", '', $str);
		
		$str = str_replace(' ', $splitword, trim(strtolower($str)));
		
		return $str;
		
	}
}

/******************************************************************************************
* CASE CONVERTER                                                                          *
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
if( ! function_exists('case_converter'))
{
	function case_converter($str = '', $type = 'lower', $encoding = "utf-8")
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
if( ! function_exists('charset_converter'))
{
	function charset_converter($str = '', $from_charset = 'utf-8', $to_charset = 'utf-8')
	{
		if( ! is_string($str) ) 
		{
			return false;
		}
		
		if( ! is_charset($from_charset) || ! is_charset($to_charset) ) 
		{
			return false;
		}
		
		return mb_convert_encoding($str, $from_charset, $to_charset);	
	}	
}