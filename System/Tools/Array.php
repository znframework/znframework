<?php
/************************************************************/
/*                    TOOL ARRAY                            */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

// 


// Function: array_pos_change()
// İşlev:Herhangi bir dizi indeksini, istenilen başka bir dizi indeksine eklemeye yarar.
// Parametreler
// @array = dizi
// @poss = yerleştirilecek index
// @changePos = değiştirilecek index
// Dönen Değer: Yeni Dizi.

if(!function_exists('array_pos_change'))
{
	function array_pos_change($array = '', $poss = '', $changePos = '')
	{
		if( ! is_array($array)) return false;
		
		if( ! is_numeric($poss)) $poss = array_search($poss, $array);
		if( ! is_numeric($changePos)) $changePos = array_search($changePos, $array);
		
		$pos = $poss;
		
		$lastArray = array();
		
		if($pos > $changePos) { $pos = $changePos; $changePos = $poss;}

		for($i = 0; $i < count($array); $i++)
		{		
			if($i < $pos)
			{
				$lastArray[$i] = $array[$i];
			}
			else
			{			
				if($i < $changePos)
				{
					$lastArray[$i] = $array[$i + 1];
				}
				else if($i == $changePos)
				{
					$lastArray[$i] = $array[$pos];
				}
				else
				{
					$lastArray[$i] = $array[$i];
				}	
			}
		}
		
		return $lastArray;
	}
}

// Function: array_pos_reverse()
// İşlev: Dizi elementlarını kendi içlerinde yer değiştirmek için kullanılır.
// Parametreler
// @array = dizi
// @poss = değiştirilecek index
// @changePos = değiştirilecek index
// Dönen Değer: Yeni Dizi.

if(!function_exists('array_pos_reverse'))
{
	function array_pos_reverse($array = '', $poss = '', $changePos = '')
	{
		if( ! is_array($array)) return false;
		
		if( ! is_numeric($poss)) $poss = array_search($poss, $array);
		if( ! is_numeric($changePos)) $changePos = array_search($changePos, $array);
		
		$pos = $poss;
		
		$lastArray = array();
		
		if($pos > $changePos) { $pos = $changePos; $changePos = $poss;}

		for($i = 0; $i < count($array); $i++)
		{
			if($i == $pos)
			{	
				$element = $array[$i];
				$lastArray[$i] = "";
			}
			else if($i == $changePos)
			{
				$changeElement = $array[$i];
				$lastArray[$i] = "";
			}
			else 
			{
				$lastArray[$i] = $array[$i];	
			}
		}
		
		$lastArray[$pos] = $changeElement;
		$lastArray[$changePos] = $element;
		
		return $lastArray;
	}
}

// Function: array_delete_element()
// İşlev: Diziden istenilen eleman veya elamanları silmek için kullanılır.
// Parametreler
// @array = dizi
// @object = string veya array veri tipi içerir değiştirilecek dizi elemanı veya elemanları
// Dönen Değer: Yeni Dizi.

if( ! function_exists("array_delete_element"))
{
	function array_delete_element($array = array(), $object = "")
	{
		if( ! is_array($array)) return false;
		
		$new_array = array();
		
		if( ! is_array($object))
		{
			if(isset($array[$object]))
			{
				
				foreach($array as $k => $v)
				{
					if($k !== $object)
					{
						$new_array[$k] = $v;
					}	
				}
				
				return $new_array;	
			}
			else
			{
				if( is_numeric($object) )
				{
					for($i=0; $i<count($array); $i++)
					{
						if($i !== $object)
						{
							$new_array[] = $array[$i];		
						}	
					}
					
					return $new_array;
				}
				else
				{
					foreach($array as $k => $v)
					{			
						if($v !== $object)
						{
							$new_array[] = $array[$k];		
						}	
					}	
					return $new_array;
				} 	
			}
		}
		else
		{
			foreach($array as $k => $v)
			{			
				if( ! in_array($k, $object) && ! in_array($v, $object))
				{
					$new_array[] = $v;	
				}
			
			}	
			return $new_array;
		}
	}
}

// Function: multi_key_array()
// İşlev: Farklı birden fazla anahtar kelimeye aynı değeri atamak için kullanılır.
// Parametreler
// @array = dizi
// @key_split = Anahtar keimelerin hangi karakterle ayrılacağı.
// Dönen Değer: Yeni Dizi.

if( ! function_exists("multi_key_array"))
{
	function multi_key_array($array = array(), $key_split = "|")
	{
		$new_array = array();
		if(is_array($array)) 
		{
			foreach($array as $k => $v)
			{
				$keys = explode($key_split, $k);
				foreach($keys as $val)
				{
					$new_array[$val] = $v;	
				}		
			}
			
			return $new_array;
		}
		else return false;
	}
}

// Function: array_keyval()
// İşlev: Bir dizinin anahtarını yada değerini elde etmek için kullanılır.
// Parametreler
// @array = dizi
// @keyval = Dizinin anahtarı mı değeri mi?
// Dönen Değer: Anahtar yada değer bilgisi.

if( ! function_exists("array_keyval"))
{
	function array_keyval($array = array(), $keyval = "val")
	{
		if( ! is_array($array)) return false;
		
		if($keyval === "val" || $keyval === "value")
			return current($array);
		elseif($keyval === "key")
			return key($array);
		elseif($keyval === "vals" || $keyval === "values")
			return array_values($array);
		elseif($keyval === "keys")
			return array_keys($array);
		else
			return current($array);
	}
}