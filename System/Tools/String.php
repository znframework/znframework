<?php
/************************************************************/
/*                     TOOL STRING                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

// Function: mtrim()
// İşlev: Verideki tüm boşlukları silmek için kullanılır.
// Parametreler
// @str = Boşlukları silinecek veri.
if( ! function_exists('mtrim'))
{
	function mtrim($str = '')
	{
		if( ! is_string($str)) return false;
		
		$str = preg_replace('/\s+/',"",$str);
		$str = preg_replace('/&nbsp;/',"",$str);
		return $str;
	}	
}

// Function: trim_slashes()
// İşlev: Verinin başındaki veya sonundaki / taksim karakterlerini silmek için kullanılır.
// Parametreler
// @str = Başındaki ve sonundaki / taksim işaretleri temizlenecek olan veri.
if( ! function_exists('trim_slashes'))
{
	function trim_slashes($str = '')
	{
		if( ! is_string($str)) return false;
		
		$str = trim($str, "/");
		
		return $str;
	}	
}

// Function: sub_string()
// İşlev: Veriyi kırpmak için kullanılır.
// Parametreler
// @str = Kırpılacak veri.
// @starting = Kırpmaya kaçıncı karakterden başlnacağı. Parametrenin alabileceği değerler: sayısal veriler, first, middle
// 1- sayısal veriler: herhangi bir sayı.
// 2- first: ilk karakterden itibaren.
// 3- middle: ortanca karakterden itibaren.
// @count = Kaç karakter kırpılacağı. Parametrenin alabileceği değerler: sayısal veriler, all
// 1- sayısal veriler: herhangi bir sayı.
// 1- all: Kalan bütün karakterler.
if( ! function_exists('sub_string'))
{
	function sub_string($str = '', $starting = 0, $count = 0)
	{
		if( ! is_string($str)) return false;
		if( ! (is_numeric($starting) || is_string($starting))) $starting = 0;
		if( ! (is_numeric($count) || is_string($count))) $count = 0;
		
		if(empty($count))
		{ 
			return $str;
		}
		
		if( is_numeric($starting) )	
		{
			if( $starting > strlen($str)) 
			{	
				return $str;
			}
		}
		if( is_numeric($count) && is_numeric($starting))
		{	
			if($starting < strlen($str) && ($starting + $count > strlen($str)))
			{	
				$count = strlen($str);
			}
		}
		$new_str = NULL;
		
		$ending = $starting + $count;		
				
		if($starting >= 0 || $starting === "first" || $starting === "middle")
		{
			if($starting === "first")
				$starting = 0;

			if($starting === "middle")
				$starting = (int)floor(strlen($str) / 2);	
				
					
			if($count === 'all')
				$ending = strlen($str);
			else
				$ending = $count + $starting;
			
			for($i = $starting; $i < $ending; $i++)
			{
				if(isset($str[$i]))
					$new_str .= $str[$i];
			}
		
			return $new_str;
		}
		else
		{	
			$starting = strlen($str) + $starting;
	
			if( $starting + $count > strlen($str))
				return $str;
			
			$ending = $starting + $count;
			
			if($count === 'all')
				$ending = strlen($str);
					
			for($i = $starting; $i < $ending; $i++)
			{
				$new_str .= $str[$i];	
			}	
			return $new_str;
		}		
	
	}	
}

// Function: string_search()
// İşlev: Metinsel ifadeler içinde arama yapmak için kullanılır.
// Parametreler
// @str = Arama yapılacak metin.
// @needle = Aranan karakter veya karakterler.
// @type = Arama sonucunun türü. Parametrenin alabileceği değerler: str/string veya pos/position
// 1-str/string: aranan kelime bulunmuş ise bulunan veri döner.
// 2-pos/position: aranan kelime bulunmuş ise bulunan verinin ilk karakterinin indeks numarası döner.
if( ! function_exists('string_search'))
{
	function string_search($str = '', $needle = '', $type = "str")
	{
		if( ! is_string($str)) return false;
		if( ! is_string($type)) $type = "str";
		if( ! is_string($needle)) $needle = "";
		
		if($type === "str" || $type === "string")
			return strstr($str, $needle);
		if($type === "pos" || $type === "position")
			return strpos($str, $needle);
	}	
}