<?php
/************************************************************/
/*                     TOOL REPEATER                        */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

// Function: repeater()
// İşlev: Tekrarlayıcı.
// Parametreler
// @str = Tekrarlanacak veri.
// @count = Tekrar sayısı.
// Dönen Değer: Tekrar edilmiş veri.
if( ! function_exists('repeater'))
{
	function repeater($str = '', $count = 1)
	{		
		if( ! is_string($str)) return false;
		if( ! is_numeric($count)) $count = 1;
		
		if(empty($str)) return false; 
			
		if($count == 0) 
			$count = 1;
		
		return str_repeat($str, $count);
	}
}