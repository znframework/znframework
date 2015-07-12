<?php
class Clean
{
	/***********************************************************************************/
	/* CLEAN LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Clean
	/* Versiyon: 1.4
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: captcha::, $this->clean, zn::$use->clean, uselib('clean')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/******************************************************************************************
	* DATA                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Dizi ya da metinsel ifadelerden veri silmek için kullanılır. 			  |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string/array var @searchData => Aranacak metin veya dizi elamanları.				  |
	| 2. string/array var @cleanWord => Silinecek metin veya dizi elamanları.				  |
	|          																				  |
	| Örnek Kullanım:  																	      |
	|																				          |
	| Metinsel ifadelerde temizleme işlemi       											  |
	| echo data('bilgi@zntr.net', 'bilgi'); // Çıktı: @zntr.net 							  |
	| echo data('bilgi@zntr.net', array('bilgi', '.net')); // Çıktı: @zntr 				      |
	|																				          |
	| Dizi İçerikli ifadelerde temizleme işlemi												  |
	| var_dump( data(array('a', 'b', 'c'), 'b') ); // Çıktı: a c 						      |
	| var_dump( data(array('a', 'b', 'c'), array('b', 'c')) ); // Çıktı: a 				      |
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