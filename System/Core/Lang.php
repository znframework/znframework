<?php

/************************************************************/
/*                     TOOL LANG                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* LANG FUNCTION                                                                           *
*******************************************************************************************
| Genel Kullanım: Dahil edilen dil dosyalarına ait verileri kullanma işlevini üstlenir.	  |
|																						  |
| Parametreler																			  |
| @str = Dil dosyası içerisinde anahtar ifade.											  |
| @changed = Dil dosyası içerisinde karakteri istenilen karakter ile değiştirmek. 		  |
| Örnek: % ibaresi yerine 'abc'															  |
|																						  |
******************************************************************************************/
if( ! function_exists("lang") )
{

	function lang($str = '', $changed = '')
	{
		// Parametreler kontrol ediliyor.		
		if( ! is_string($str) ||  empty($str) ) 
		{
			return false;
		}
		
		global $lang;
		
		// Belirtilen anahtar dahil edilen
		// Dil dosyası içerisinde mevcutsa
		// İşlemlere devam et.
		if( isset($lang[$str]) )
		{
			$langstr = $lang[$str];	
		}
		else
		{
			return false;	
		}
		
		// 2. Parametre Dizi değilse
		// Dil dosyaları içerisinde yer alan
		// & işareti yerine bu parametrenin değerin ata.
		if( ! is_array($changed) )
		{
			if( strstr($langstr, "%") && ! empty($changed) )
			{
				return str_replace("%", $changed , $langstr);
			}
			else
			{
				return $langstr;
			}
		}
		else
		{
			// 2. Parametre dizi ise
			// Anahtar olarak belirtilen
			// İşaretler yerine karşılarında
			// yer alan değerleri ata.
			if( ! empty($changed) )
			{
				$values = array();
				
				foreach($changed as $key => $value)
				{
					$keys[] = $key;
					$values[] = $value;	
				}
				
				return str_replace($keys, $values, $langstr);
			}
			else
			{
				return $langstr;
			}
		}
	}
}