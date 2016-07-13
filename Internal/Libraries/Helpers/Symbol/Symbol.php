<?php
namespace ZN\Helpers;

class InternalSymbol implements SymbolInterface
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
	
	/******************************************************************************************
	*  NAME                                                                     			  *
	*******************************************************************************************
	| Genel Kullanım: Config/Symbols.php dosyasında belirtilen özel sembolleri kullanabilmek  |
	| için kullanılır.														                  |
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string var @sybom_name => Config/Symbols.php dosyasındaki anahtar isimler.			  |
	|          																				  |
	| Örnek Kullanım: symbol('daimon');         											  |
	|          																				  |
	******************************************************************************************/	
	public function name($symbolName = 'turkishLira')
	{
		if( ! is_string($symbolName) ) 
		{
			return \Errors::set('Error', 'stringParameter', 'symbolName');
		}
		
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