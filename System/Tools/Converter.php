<?php
/************************************************************/
/*                 TOOL CONVERTERS                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

// Function: char_converter()
// İşlev: Karakterleri bir türden diğer türe dönüştürmek için kullanılır.
// Parametreler
// @string = Dönüştürülecek metin.
// @type = Hangi türden dönüşüm yapılacağı.
// @change_type = Hangi türe dönüşüm yapılacağı.
// Dönüştürülebilecek türler => char, html, dex, hex
// Dönen Değer: Karakterleri dönüştürülmüş metin.
if(!function_exists('char_converter'))
{
	function char_converter($string = '', $type = 'char', $change_type = 'html')
	{
		if( ! is_value($string)) return false;
		if( ! is_string($type)) $type = 'char';
		if( ! is_string($change_type)) $change_type = 'html';
				
		for($i=32; $i<=255; $i++)
		{
			$hex_remaining = ($i%16);
			$hex_remaining = str_replace(array(10,11,12,13,14,15),array('A','B','C','D','E','F'),$hex_remaining);
			$hex = (floor($i/16)).$hex_remaining;
			if($hex[0] == "0") $hex = $hex[1];	
			
			if(chr($i) !== " ")
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

// Function: accent_converter()
// İşlev: Yabancı içerikli karaketerleri standart karakterlere dönüştürür.
// Parametreler
// @string = Dönüştürülecek metin.
// Örnek: Ç hargini C harfine dönüştürür.
// Dönen Değer: Karakterleri dönüştürülmüş metin.
if(!function_exists('accent_converter'))
{
	function accent_converter($str = '') 
	{	
		if( ! is_string($str)) return false;
		
		if (empty($str))return $str;
		
		import::tool('Array');
			
		$accent = config::get('ForeignChars', 'accent_chars');
		
		$accent = multi_key_array($accent);
		
		return str_replace(array_keys($accent), array_values($accent), $str); 
	} 
}

// Function: url_word_converter()
// İşlev: Yabancı karaketer içerikli metni url yapısına uygun hale dönüştürür.
// Parametreler
// @string = Dönüştürülecek metin.
// @splitword = Kelimeler arasına konacak karakter.
// Örnek: Güzel Ürünler = guzel-urunler.
// Dönen Değer: Karakterleri dönüştürülmüş metin.
if( ! function_exists('url_word_converter'))
{
	function url_word_converter($str = '', $splitword = '-')
	{
		if( ! is_string($str)) return false;
		
		if( ! is_string($splitword)) $splitword = "-";
		
		if (empty($str))return $str;
		
		import::tool('Array');
		
		$accent = config::get('ForeignChars', 'accent_chars');
		
		$accent = multi_key_array($accent);
		
		$str = str_replace(array_keys($accent), array_values($accent), $str); 
		
		$str = str_replace(array("'",'"',"?",":",".",";","<",">","&","%","~","\\","\/","[","]","(",")","$"),"",$str);
		
		$str = preg_replace("/\s+/", ' ', $str);
		
		$str = str_replace("&nbsp;", "", $str);
		
		$str = str_replace(" ",$splitword,trim(strtolower($str)));
		
		return $str;
		
	}
}

// Function: case_converter()
// İşlev: Büyük küçük harfe dönüştürme.
// Parametreler
// @string = Dönüştürülecek metin.
// @type = Hangi türe çevireleceği. Parametrenin alabileceği değerler upper, lower, initial
// 1-upper = Büyük harfe dönüştürür. Örnek: ZN FRAMEWORK
// 2-lower = Küçük harfe dönüştürür. Örnek: zn framework
// 3-title = Kelimelerin sadece ilk harfini büyük diğer harflerini küçük harfe dönüştürür. Örnek: Zn Framework
// Dönen Değer: Karakterleri dönüştürülmüş metin.
if( ! function_exists('case_converter'))
{
	function case_converter($str = '', $type = 'lower', $encoding = "utf-8")
	{
		if( ! is_string($str)) return false;
		if( ! is_string($type)) $type = 'lower';
				
		if(empty($str)) return false;
		
		$types  = array(
			'lower' => MB_CASE_LOWER,
			'upper' => MB_CASE_UPPER,
			'title' => MB_CASE_TITLE
		);
		
		if(isset($types[$type])) 
			$type = $types[$type];
		else
			$type = $types["lower"];
		return mb_convert_case($str, $type, $encoding);	
	}	
}