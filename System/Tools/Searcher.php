<?php
/************************************************************/
/*                   TOOL SEARCHER                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

// Function: searcher()
// İşlev: Dizilerde ve metinsel ifadeler arama yapmak için kullanılır.
// Parametreler
// @search_data = Aranacak olan metin veya dizi.
// @search_word = Aranacak olan karakter veya karakterler
// @output = Arama sonucu türü. Parametrenin alabileceği değerler: bool, boolean, pos, position
// 1- bool/boolean sonucun bulunuduğunu yada bulunmadığını gösteren true veya false değeri döndürür.
// 2- pos/position sonuc bulunmuş ise bulunan bilginin başlangıç indeks numarasını bulunmamış ise -1 değerini döndürür.
// Dönen Değer: Arama sonucu.
if(!function_exists('searcher'))
{
	function searcher($search_data = '', $search_word = '', $output = 'bool')
	{
		if( ! is_string($output) ) 
		{
			$output = 'bool';
		}
		
		if( ! is_array($search_data) )
		{	
			if( ! is_value($search_word) ) 
			{
				return false;
			}
			
			if( $output === 'str' || $output === 'string' ) 
			{
				return strstr($search_data, $search_word);
			}
			elseif( $output === 'pos' || $output === 'position' ) 
				return strpos($search_data, $search_word);
			elseif( $output === 'bool' || $output === 'boolean' ) 
			{
				$result = strpos($search_data, $search_word);
				
				if( $result > -1 )
				{ 
					return true;
				}
				else
				{
					return false;
				}
			}
			else 
			{
				return false;
			}
		}
		else
		{			
			$result = array_search($search_word, $search_data);	
			
			if( $output === 'pos' || $output === 'position' )
			{
				if( ! empty($result) )
				{
					return $result;
				}
				else
				{
					return -1;
				}
			}
			elseif( $output === 'bool' || $output === 'boolean' )
			{
				if( ! empty($result) )
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			elseif( $output === 'str' || $output === 'string' )
			{
				if( ! empty($result) )
				{
					return $search_word;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
	}
}
