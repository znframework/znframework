<?php
/************************************************************/
/*                      TOOL ENCODER                        */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

// Function: encoder()
// İşlev: Veriyi şifrelemek için kullanılır.
// Parametreler
// @str = Şifrelenecek data.
// @type = Şifreleme türü. Parametrenin alabileceği değerler: md5, sha1
// Dönen Değer: Şifrelenmiş bilgi.
if( ! function_exists('encoder'))
{
	function encoder($str = '', $type = 'md5')
	{
		if( ! (is_string($str) || is_numeric($str))) return false;
		if( ! is_string($type)) $type = 'md5';
		if($type === 'md5')
			return md5($str);
		else if($type === 'sha1')
			return sha1($str);	
	}
}

// Function: php_tag_encoder()
// İşlev: Php taglarını numerik koda çevirir.
// Parametreler
// @str = Şifrelenecek data.
// Dönen Değer: Şifrelenmiş bilgi.
if( ! function_exists('php_tag_encoder'))
{
	function php_tag_encoder($str = '')
	{
		if( ! is_string($str)) return false;
		
		if (empty($str)) return $str;
		
		$php_tag_chars = array(
			'<?',
			'?>'
		);
		$php_tag_html_chars = array(
			'&#60;&#63;',
			'&#63;&#62;'
		);
		
		return str_replace($php_tag_chars, $php_tag_html_chars, $str);
	}
}

// Function: nail_encoder()
// İşlev: Tırnak işaretlerini numerik koda dönüştürmek çevirir.
// Parametreler
// @str = Şifrelenecek data.
// Dönen Değer: Şifrelenmiş bilgi.
if( ! function_exists('nail_encoder'))
{
	function nail_encoder($str = '')
	{
		if( ! is_string($str)) return false;
		
		if (empty($str))return $str;
		
		$str = str_replace(array("'",'"'),array("&#145;", "&#147;"),$str);
		
		return $str;
	}
}

// Function: foreign_char_encoder()
// İşlev: Farklı dillerdeki yabancı karakterleri numerik koda çevirir.
// Parametreler
// @str = Şifrelenecek data.
// Dönen Değer: Şifrelenmiş bilgi.
if( ! function_exists("foreign_char_encoder"))
{
	function foreign_char_encoder($str = '')
	{	
		if( ! is_string($str)) return false;
	
		if (empty($str))return $str;
		
		$chars = config::get('ForeignChars', 'numerical_codes');
		
		return str_replace(array_keys($chars), array_values($chars), $str);
	}	
}