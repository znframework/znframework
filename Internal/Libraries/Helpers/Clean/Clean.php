<?php
namespace ZN\Helpers;

class InternalClean implements CleanInterface
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
	
	/******************************************************************************************
	* DATA                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Dizi ya da metinsel ifadelerden veri silmek için kullanılır. 			  |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string/array var @searchData => Aranacak metin veya dizi elamanları.				  |
	| 2. string/array var @cleanWord => Silinecek metin veya dizi elamanları.				  |
	|																						  |
	******************************************************************************************/	
	public function data($searchData = '', $cleanWord = '')
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