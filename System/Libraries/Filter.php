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
	public static function word($string = '', $badWords = '', $changeChar = '[badwords]')
	{
		if( ! isValue($string) ) 
		{
			return false;
		}
		
		if( ! is_array($badWords) ) 
		{
			return  $string = Regex::replace($badWords, $changeChar, $string, 'xi');
		}
		
		$ch = '';
		$i = 0;	
		
		foreach($badWords as $value)
		{
			if( ! is_array($changeChar) )
			{
				$ch = $changeChar;
			}
			else
			{
				if( isset($changeChar[$i]) )
				{
					$ch = $changeChar[$i];	
					$i++;
				}
			}
			
			$string = Regex::replace($value, $ch, $string, 'xi');
		}

		return $string;
	}	
}