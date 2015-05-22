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
		if( ! is_value($str) ) 
		{
			return false;
		}
		
		if( ! is_string($type) ) 
		{
			$type = 'md5';
		}
		
		if( $type === 'md5' )
		{
			return md5($str);
		}
		elseif( $type === 'sha1' )
		{ 
			return sha1($str);	
		}
		else
		{
			if( in_array($type, hash_algos()) )
			{
				return hash($type, $str);
			}
			else
			{
				return md5($str);
			}
		}
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
		if( ! is_string($str) || empty($str) ) 
		{
			return false;
		}
		
		$php_tag_chars = array
		(
			'<?' => '&#60;&#63;',
			'?>' => '&#63;&#62;'
		);
		
		return str_replace(array_keys($php_tag_chars), array_values($php_tag_chars), $str);
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
		if( ! is_string($str) || empty($str) ) 
		{
			return false;
		}
		
		$nail_chars = array
		(
			"'" => "&#145;",
			'"' => "&#147;"
		);
		
		$str = str_replace(array_keys($nail_chars), array_values($nail_chars), $str);
		
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
		if( ! is_string($str) || empty($str) ) 
		{
			return false;
		}
		
		$chars = config::get('ForeignChars', 'numerical_codes');
		
		return str_replace(array_keys($chars), array_values($chars), $str);
	}	
}