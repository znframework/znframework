<?php
/************************************************************/
/*                     TOOL SYMBOL                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
*  SYMBOL                                                                     			  *
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
if( ! function_exists('symbol') )
{
	function symbol($symbol_name = 'turkish_lira')
	{
		if( ! is_string($symbol_name) ) 
		{
			return false;
		}
		
		$symbol = config::get('Symbols',$symbol_name);
		
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