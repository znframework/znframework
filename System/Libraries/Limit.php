<?php
/************************************************************/
/*                   LBIRARY LIMIT                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* LIMIT                                                                               	  *
*******************************************************************************************
| Sınıfı Kullanırken : limit::, $this->limit, zn::$use->limit, uselib('limit')	  	  	  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/	
class Limit
{
	// Function: word_limiter()
	// İşlev: Bir metinin kaç kelime ile sınırlanacağını belirler.
	// Parametreler
	// @str = Sınırlanacak metin.
	// @limit = Kaç kelime ile sınırlanacağı
	// @endchar = Metnin kelime sayısı sınırlanan sayıdan fazla ise devamı olduğunu gösteren ve metnin sonuna eklenen karakter.
	// @striptags = Metindeki html tagları numerik koda dönüştürülsün mü?. true veya false.
	// Dönen Değer: Dönüştürülmüş veri.
	public static function word($str = '', $limit = 100, $endChar = '...', $stripTags = true)
	{
		if( ! is_string($str) ) 
		{
			return false;
		}
		
		if( ! is_numeric($limit) ) 
		{
			$limit = 100;
		}
		
		if( ! is_string($endChar) ) 
		{
			$endChar = '...';
		}
		
		if( ! is_bool($stripTags) ) 
		{
			$stripTags = true;
		}
		
		$str = trim($str);
		
		if( empty($str) )
		{
			return $str;
		}
		
	
		if( $stripTags === true ) 
		{
			$str = strip_tags($str);
		}
		
		$str = str_replace(array("\n","\r","&nbsp;"), " ", $str);
		
		preg_match('/^\s*+(?:\S++\s*+){1,'.(int) $limit.'}/', $str, $matches);
	
		if( strlen($str) === strlen($matches[0]) )
		{
			$endChar = '';
		}
	
		return rtrim($matches[0]).$endChar;
	}

	// Function: char_limiter()
	// İşlev: Bir metinin kaç karakter ile sınırlanacağını belirler.
	// Parametreler
	// @str = Sınırlanacak metin.
	// @limit = Kaç karakter ile sınırlanacağı
	// @endchar = Metnin kelime sayısı sınırlanan sayıdan fazla ise devamı olduğunu gösteren ve metnin sonuna eklenen karakter.
	// @striptags = Metindeki html tagları numerik koda dönüştürülsün mü?. true veya false.
	// Dönen Değer: Dönüştürülmüş veri.
	public static function char($str = '', $limit = 500, $endChar = '...',  $stripTags = false, $encoding = "utf-8")
	{
		if( ! is_string($str) ) 
		{
			return false;
		}
		
		if( ! is_numeric($limit) )
		{
			$limit = 500;
		}
		
		if( ! is_string($endChar) ) 
		{
			$endChar = '...';
		}
		
		if( ! is_bool($stripTags) ) 
		{
			$stripTags = true;
		}
		
		$str = trim($str);
		
		if( empty($str) )
		{
			return $str;
		}
		
		if( $stripTags === true ) 
		{
			$str = strip_tags($str);
		}
		
		$str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n", "&nbsp;"), ' ', $str));
	
		if( strlen($str) <= $limit )
		{
			return $str;
		}
		else
		{
			return mb_substr($str, 0, $limit, $encoding).$endChar;	
		}
	}	
}
