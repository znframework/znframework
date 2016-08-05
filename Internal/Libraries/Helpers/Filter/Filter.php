<?php
namespace ZN\Helpers;

class InternalFilter extends \CallController implements FilterInterface
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
	// @param string $string
	// @param mixed  $badWords
	// @param mixed  $changeChar
	//
	//----------------------------------------------------------------------------------------------------
	public function word(String $string, $badWords, $changeChar = NULL)
	{
		nullCoalesce($changeChar, '[badwords]');

		return str_ireplace($badWords, $changeChar, $string);
	}	
	
	//----------------------------------------------------------------------------------------------------
	// Data
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $string
	// @param mixed  $badWords
	// @param mixed  $changeChar
	//
	//----------------------------------------------------------------------------------------------------
	public function data(String $string, $badWords, $changeChar = NULL)
	{
		return $this->word($string, $badWords, $changeChar);
	}
}