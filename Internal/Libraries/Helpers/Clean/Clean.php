<?php
namespace ZN\Helpers;

class InternalClean extends \CallController implements CleanInterface
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
	// Data
	//----------------------------------------------------------------------------------------------------
	// 
	// @param mixed $searchData
	// @param mixed $cleanWord
	//
	//----------------------------------------------------------------------------------------------------
	public function data($searchData, $cleanWord)
	{
		if( ! is_array($searchData) )
		{	
			if( ! is_scalar($cleanWord) ) 
			{
				$cleanWord = '';
			}
			
			$result = str_replace($cleanWord, '', $searchData);
		}
		else
		{
			if( ! is_array($cleanWord) ) 
			{
				$cleanWordArray[] = $cleanWord;
			}
			else
			{
				$cleanWordArray = $cleanWord;
			}
			
			$result = array_diff($searchData, $cleanWordArray);	
		}
		
		return $result;
	}
}