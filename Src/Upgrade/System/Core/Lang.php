<?php

/************************************************************/
/*                     TOOL LANG                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

// Function: lang()
// İşlev: Dahil edilen dil dosyalarına ait verileri kullanma işlevini üstlenir.
// Parametreler
// @str = Dil dosyası içerisinde anahtar ifade.
// @changed = Dil dosyası içerisinde karakteri istenilen karakter ile değiştirmek. Örnek: % ibaresi yerine 'abc'
if( ! function_exists("lang") )
{

	function lang($str = '', $changed = '')
	{		
		if( ! is_string($str)) return false;
		
		if(empty($str)) return false;
		
		global $lang;
		
		if( ! is_array($changed))
		{
			if(strpos(@$lang[$str],"%") > -1 && $changed != '')
			{
				return str_replace("%", $changed , $lang[$str]);
				echo 1;	
			}
			else
			{
				return @$lang[$str];
			}
		}
		else
		{
			if( ! empty($changed))
			{
				$values = array();
				foreach($changed as $key => $value)
				{
					$keys[] = $key;
					$values[] = $value;	
				}
				return str_replace($keys, $values, $lang[$str]);
			}
			else
			{
				return @$lang[$str];	
			}
		}
	}
	
}