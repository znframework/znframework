<?php
namespace ZN\Helpers;

class InternalLimit implements LimitInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	use \CallUndefinedMethodTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Error Control
	//----------------------------------------------------------------------------------------------------
	// 
	// $error
	// $success
	//
	// error()
	// success()
	//
	//----------------------------------------------------------------------------------------------------
	use \ErrorControlTrait;
	
	// Function: word_limiter()
	// İşlev: Bir metinin kaç kelime ile sınırlanacağını belirler.
	// Parametreler
	// @str = Sınırlanacak metin.
	// @limit = Kaç kelime ile sınırlanacağı
	// @endchar = Metnin kelime sayısı sınırlanan sayıdan fazla ise devamı olduğunu gösteren ve metnin sonuna eklenen karakter.
	// @striptags = Metindeki html tagları numerik koda dönüştürülsün mü?. true veya false.
	// Dönen Değer: Dönüştürülmüş veri.
	public function word($str = '', $limit = 100, $endChar = '...', $stripTags = true, $encoding = "utf-8")
	{
		if( ! is_string($str) ) 
		{
			return \Errors::set('Error', 'stringParameter', 'str');
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
		
		$str = str_replace(["\n","\r","&nbsp;"], " ", $str);
		
		preg_match('/^\s*+(?:\S++\s*+){1,'.(int) $limit.'}/', $str, $matches);
	
		if( mb_strlen($str, $encoding) === mb_strlen($matches[0], $encoding) )
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
	public function char($str = '', $limit = 500, $endChar = '...',  $stripTags = false, $encoding = "utf-8")
	{
		if( ! is_string($str) ) 
		{
			return \Errors::set('Error', 'stringParameter', 'str');
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
		
		$str = preg_replace("/\s+/", ' ', str_replace(["\r\n", "\r", "\n", "&nbsp;"], ' ', $str));
	
		if( mb_strlen($str, $encoding) <= $limit )
		{
			return $str;
		}
		else
		{
			return mb_substr($str, 0, $limit, $encoding).$endChar;	
		}
	}	
}
