<?php
/************************************************************/
/*                    TOOL CLEANER                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

// Function: cleaner()
// İşlev: Dizi ya da metinsel ifadelerden veri silmek için kullanılır.
// Parametreler
// @search_data = Temizlenecek olan dizi veya metinsel ifade.
// @clean_word = Temizlenecek kelime veya kelime dizisi.
// Dönen Değer: Yeni metinsel ifade veya dizi.

if(!function_exists('cleaner'))
{
	function cleaner($search_data = '', $clean_word = '')
	{

		if( ! is_array($search_data))
		{	
			if( ! (is_string($clean_word) || is_numeric($clean_word))) $clean_word = '';
			
			$result = str_replace($clean_word, "", $search_data);
		}
		else
		{
			if( ! is_array($clean_word)) 
				$clean_word_array[] = $clean_word;
			else
				$clean_word_array = $clean_word;
			$result = array_diff($search_data, $clean_word_array);	
		}
		
		return $result;
	}
}
