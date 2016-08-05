<?php
namespace ZN\Helpers;

class InternalSymbol extends \CallController implements SymbolInterface
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
	// Name
	//----------------------------------------------------------------------------------------------------
	// 
	// @var string
	//
	//----------------------------------------------------------------------------------------------------
	public function name(String $symbolName = NULL)
	{
		nullCoalesce($symbolName, 'turkishLira');

		$symbol = \Config::get('Symbols', $symbolName);
		
		if( ! empty($symbol) )
		{ 
			return $symbol; 
		}
		else
		{ 
			return false;
		}
	}	
}