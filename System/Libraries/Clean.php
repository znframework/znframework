<?php
/************************************************************/
/*                    LIBRARY CLEAN                         */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* CLEAN                                                                              	  *
*******************************************************************************************
| Sınıfı Kullanırken      :	clean:: , $this->clean , uselib('clean') , zn::$use->clean    |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/
class Clean
{
	/******************************************************************************************
	* CLEANER                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Dizi ya da metinsel ifadelerden veri silmek için kullanılır. 			  |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string/array var @search_data => Aranacak metin veya dizi elamanları.				  |
	| 2. string/array var @clean_word => Silinecek metin veya dizi elamanları.				  |
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
	public static function data($searchData = '', $cleanWord = '')
	{

		if( ! is_array($searchData) )
		{	
			if( ! isValue($cleanWord) ) 
			{
				$cleanWord = '';
			}
			
			$result = str_replace($cleanWord, '', $searchData);
		}
		else
		{
			if( ! is_array($cleanWord) ) 
			{
				$cleanWordArray[] = $cleanWord;
			}
			else
			{
				$cleanWordArray = $cleanWord;
			}
			
			$result = array_diff($searchData, $cleanWordArray);	
		}
		
		return $result;
	}
}