<?php
/************************************************************/
/*                     LIBRARY FILTER                       */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* FILTER                                                                            	  *
*******************************************************************************************
| Sınıfı Kullanırken      :	filter:: , $this->filter , uselib('filter') , zn::$use->filter|
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/
class Filter
{
	// Function: word_filter()
	// İşlev: Metin içinde istenilmeyen kelimelerin izole edilmesi için kullanılır.
	// Parametreler
	// @string = Filtrelenecek veri.
	// @badwords = Filtrelenmesi istenen kelime veya kelimeler. string veya array veri türü.
	// @changechar = Kötü içerikli kelimelerin yerini alacak yeni kelime veya kelimeler. string veya array veri türü.
	// Dönen Değer: Filtrelenmiş veri.
	public static function word($string = '', $badwords = '', $changechar = '[badwords]')
	{
		if( ! isValue($string) ) 
		{
			return false;
		}
		
		if( ! is_array($badwords) ) 
		{
			return  $string = regex::replace($badwords, $changechar, $string, '<inspace><insens>');
		}
		
		$ch = '';
		$i = 0;	
		
		foreach($badwords as $value)
		{
			if( ! is_array($changechar) )
			{
				$ch = $changechar;
			}
			else
			{
				if( isset($changechar[$i]) )
				{
					$ch = $changechar[$i];	
					$i++;
				}
			}
			
			$string = regex::replace($value, $ch, $string, '<inspace><insens>');
		}

		return $string;
	}	
}