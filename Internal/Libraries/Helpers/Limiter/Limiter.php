<?php
namespace ZN\Helpers;

class InternalLimiter extends \CallController implements LimiterInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Word
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	// @param int    $limit
	// @param string $endChar
	// @param bool   $stripTags
	// @param string $encoding
	//
	//----------------------------------------------------------------------------------------------------
	public function word(String $str, Int $limit = 100, String $endChar = '...', Bool $stripTags = true, String $encoding = "utf-8") : String
	{
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

	//----------------------------------------------------------------------------------------------------
	// Char
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	// @param int    $limit
	// @param string $endChar
	// @param bool   $stripTags
	// @param string $encoding
	//
	//----------------------------------------------------------------------------------------------------
	public function char(String $str, Int $limit = 500, String $endChar = '...',  Bool $stripTags = false, String $encoding = "utf-8") : String
	{		
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
