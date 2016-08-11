<?php
namespace ZN\Helpers;

interface LimiterInterface
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
	public function word(String $str, Int $limit = 100, String $endChar = '...', Bool $stripTags = true, String $encoding = "utf-8") : String;

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
	public function char(String $str, Int $limit = 500, String $endChar = '...',  Bool $stripTags = false, String $encoding = "utf-8") : String;	
}
