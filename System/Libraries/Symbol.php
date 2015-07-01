<?php
/************************************************************/
/*                    LIBRARY SYMBOL                        */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* SYMBOL                                                                             	  *
*******************************************************************************************
| Sınıfı Kullanırken :	symbol::, $this->symbol, zn::$use->symbol, uselib('symbol')       |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/	
class Symbol
{
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
	public static function name($symbol_name = 'turkishLira')
	{
		if( ! is_string($symbol_name) ) 
		{
			return false;
		}
		
		$symbol = Config::get('Symbols',$symbol_name);
		
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