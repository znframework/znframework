<?php

/************************************************************/
/*                    TOOL FILTERS                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

// Function: word_filter()
// İşlev: Metin içinde istenilmeyen kelimelerin izole edilmesi için kullanılır.
// Parametreler
// @string = Filtrelenecek veri.
// @badwords = Filtrelenmesi istenen kelime veya kelimeler. string veya array veri türü.
// @changechar = Kötü içerikli kelimelerin yerini alacak yeni kelime veya kelimeler. string veya array veri türü.
// Dönen Değer: Filtrelenmiş veri.
if(!function_exists('word_filter'))
{
	function word_filter($string = '', $badwords = '', $changechar = '[badwords]')
	{
		if( ! is_value($string) ) 
		{
			return false;
		}
		
		import::library('Regex');
	
		if( ! is_array($badwords) ) 
		{
			return  $string = reg::replace($badwords, $changechar, $string, '<inspace><insens>');
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
			
			$string = reg::replace($value, $ch, $string, '<inspace><insens>');
		}

		return $string;
	}	
}