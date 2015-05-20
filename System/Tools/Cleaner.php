<?php
/************************************************************/
/*                    TOOL CLEANER                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

/******************************************************************************************
* CLEANER                                                                                 *
*******************************************************************************************
| Genel Kullanım: Dizi ya da metinsel ifadelerden veri silmek için kullanılır. 			  |
|																						  |
| Parametreler: 2 parametresi vardır.                                              	      |
| 1. string/array var @search_data => Aranacak metin veya dizi elamanları.				  |
<<<<<<< HEAD
| 2. string/array var @clean_word => Silinecek metin veya dizi elamanları.				  |
=======
| 3. string/array var @clean_word => Silinecek metin veya dizi elamanları.				  |
>>>>>>> origin/master
|          																				  |
| Örnek Kullanım:  																	      |
|																				          |
| Metinsel ifadelerde temizleme işlemi       											  |
| echo cleaner('bilgi@zntr.net', 'bilgi'); // Çıktı: @zntr.net 							  |
| echo cleaner('bilgi@zntr.net', array('bilgi', '.net')); // Çıktı: @zntr 				  |
|																				          |
| Dizi İçerikli ifadelerde temizleme işlemi												  |
| var_dump( cleaner(array('a', 'b', 'c'), 'b') ); // Çıktı: a c 						  |
| var_dump( cleaner(array('a', 'b', 'c'), array('b', 'c')) ); // Çıktı: a 				  |
|																						  |
******************************************************************************************/	
if(!function_exists('cleaner'))
{
	function cleaner($search_data = '', $clean_word = '')
	{

		if( ! is_array($search_data) )
		{	
			if( ! is_value($clean_word) ) 
			{
				$clean_word = '';
			}
			
			$result = str_replace($clean_word, '', $search_data);
		}
		else
		{
			if( ! is_array($clean_word) ) 
			{
				$clean_word_array[] = $clean_word;
			}
			else
			{
				$clean_word_array = $clean_word;
			}
			
			$result = array_diff($search_data, $clean_word_array);	
		}
		
		return $result;
	}
}
