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

// Function: uppercase()
// İşlev: Metinsel ifadeleri büyük harfe çevirir.
// Parametreler
// @str = Metin
// @encoding = Kodlama Türü
if( ! function_exists('uppercase'))
{
	function uppercase($str = '', $encoding = 'utf-8')
	{
		if( ! is_string($str)) return false;
		
		$str = mb_strtoupper($str, $encoding);
		
		return $str;
	}	
}

// Function: lowercase()
// İşlev: Metinsel ifadeleri küçük harfe çevirir.
// Parametreler
// @str = Metin
// @encoding = Kodlama Türü
if( ! function_exists('lowercase'))
{
	function lowercase($str = '', $encoding = 'utf-8')
	{
		if( ! is_string($str)) return false;
		
		$str = mb_strtolower($str, $encoding);
		
		return $str;
	}	
}

// Function: titlecase()
// İşlev: Metinsel ifadeleri küçük harfe çevirir.
// Parametreler
// @str = Metin
// @encoding = Kodlama Türü
if( ! function_exists('titlecase'))
{
	function titlecase($str = '', $encoding = 'utf-8')
	{
		if( ! is_string($str)) return false;
		
		$str = mb_convert_case($str, MB_CASE_TITLE, $encoding);
		
		return $str;
	}	
}

// Function: substring()
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
if( ! function_exists('substring'))
{
	function substring($str = '', $starting = 0, $count = 0, $encoding = "utf-8")
	{
		if( ! is_string($str)) return false;
		if( ! (is_numeric($starting) || is_string($starting))) $starting = 0;
		if( ! (is_numeric($count) || is_string($count))) $count = 0;
		
		if(empty($count))
		{ 
			return $str;
		}
		if($starting === 'first') $starting = 0;
		if($starting === 'middle') $starting = floor(mb_strlen($str, $encoding) / 2);
		
		if($count === 'all') $count = mb_strlen($str, $encoding) - ($starting);

		return mb_substr($str, $starting, $count, $encoding);
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

// Function: string_reshuffle()
// İşlev: Metinsel ifadeler içinde istenilen karaketerleri birbirleri ile yer değiştirmek için kullanılır.
// Parametreler
// @str = Değişiklik yapılacak metin.
// @shuffle = Yer değiştirilmesi istenen ilk karakter veya karakterler.
// @reshuffle = Yer değiştirilmesi istenen ikinci karakter veya karakterler.
if( ! function_exists('string_reshuffle'))
{
	function string_reshuffle($str = '', $shuffle = '', $reshuffle = '')
	{
		if( ! is_string($str) || empty($str)) return false;
		if( ! is_value($shuffle)) return $str;
		if( ! is_value($reshuffle)) return $str;
		
		if(empty($shuffle)) return $str;
		
		$shuffleex = explode($shuffle, $str);
		
		$newstr = "";
		foreach($shuffleex as $v)
		{
			$newstr .=  str_replace($reshuffle, $shuffle, $v).$reshuffle;	
		} 
		
		return substr($newstr, 0, -strlen($reshuffle));
	}	
}

// Function: string_recurrent_count()
// İşlev: Metinsel ifadelerde tekrarlayan karakter veya karakterlerin sayısını öğrenmek için kullanılır.
// Parametreler
// @str = Arama yapılacak metin.
// @char = Kaç kez tekrar ettiği hesaplanmak istenen karakter veya karakterler.
if( ! function_exists('string_recurrent_count'))
{
	function string_recurrent_count($str = '', $char = '')
	{
		if( ! is_string($str) || empty($str)) return false;
		if( ! is_value($char)) return $str;
		
		return count(explode($char, $str)) - 1;
	}	
}

// Function: string_placement()
// İşlev: Metinsel ifadeler içinde istenilen karakterlerin yerine başka karakterler yerleştirmek için kullanılır.
// Parametreler
// @str = Değişiklik yapılacak metin.
// @delimiter = Hangi karakterin yerine yerleştirme yapılacağı.
// @array = Değiştirilmek istenen karakterler yerine sırasıyla hangi karakterlerin geleceği.
if( ! function_exists('string_placement'))
{
	function string_placement($str = '', $delimiter = '?', $array = array())
	{
		if( ! is_string($str) || empty($str)) return false;
		if( ! is_array($array)) return false;
		
		if( ! empty($delimiter))
			$strex = explode($delimiter, $str);
		else
			return $str;
		
		if((count($strex) - 1) !== count($array))
			return $str;
			
		$newstr = '';
		
		for($i = 0; $i < count($array); $i++)
		{
			$newstr .= $strex[$i].$array[$i];
		}
	
		return $newstr.$strex[count($array)];
	}	
}