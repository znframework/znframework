<?php
/************************************************************/
/*                     TOOL SYMBOL                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

// Function: symbol()
// İşlev: Config/Symbols.php dosyasında belirtilen özel sembolleri kullanabilmek için kullanılır.
// Parametreler
// @symbol = Config/Symbols.php dosyasından kullanılacak olan özel karakterin adı.
// Dönen Değer: Sembol.
if( ! function_exists('symbol') )
{
	function symbol($symbol_name = 'turkish_lira')
	{
		if( ! is_string($symbol_name)) return false;
		
		$symbol = config::get('Symbols',$symbol_name);
		
		if( ! empty($symbol)) 
			return $symbol; 
		else 
			return false;
	}	
}