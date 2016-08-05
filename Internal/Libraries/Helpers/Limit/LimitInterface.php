<?php
namespace ZN\Helpers;

interface LimitInterface
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
	public function word(String $str, $limit, $endChar, $stripTags, $encoding);

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
	public function char(String $str, $limit, $endChar,  $stripTags, $encoding);	
}
