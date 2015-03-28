<?php
/************************************************************/
/*                     TOOL BUILDER                         */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

// Function: attributes()
// İşlev: Dizi olarak girilen anahtar değer çiftlerini özellik="değer" formuna sokmak için kullanılır.
// Parametreler
// @attributes = Dizi parametresi alır özellik ve değer içeren.
// Dönen Değer: Json tipinde veri.

if(!function_exists('attributes'))
{
	function attributes($attributes = '')
	{
		$attribute = '';
		if(is_array($attributes))
		{
			foreach($attributes as $key => $values)
			{
				if(is_numeric($key))
					$key = $values;
				$attribute .= ' '.$key.'="'.$values.'"';
			}	
		}
		
		return $attribute;	
	}
}

// Function: xml_builder()
// İşlev: Xml belgesi oluşturmak için kullanılır.
// Parametreler
// @elements = Elementin adı eğer node elemen olacaksa node=eleman adı şeklinde yazılılır.
// @content = Elementin içeriği.
// @attribute = Elementin özellikleri.
// @version = Xml belgesinin versiyon bilgisi.
// @encoding = Xml belgesinin versiyon karakter seti.
// Dönen Değer: Xml belgesi.

if(!file_exists('xml_builder'))
{
	function xml_builder($elements = '', $content = '', $attribute = '', $version = '1.0', $encoding = 'utf-8')
	{		
		if( ! is_string($elements)) return false;		
		if( ! is_string($content)) $content = '';	
		if( ! is_string($version)) $version = '1.0';
		if( ! is_string($encoding)) $encoding = 'utf-8';
	
		if(empty($elements)) return false;
		
		if(strstr($elements, "node"))
		{
			$elements_ex = explode("=", $elements);
			$elements = trim($elements_ex[1]);
			$str = '<?xml version="'.$version.'" encoding="'.$encoding.'"?>';
		}		
		else
			$str = "";
			
		$str .= "\n".'<'.$elements.attributes($attribute).'>'."\n\t".$content."\n".'</'.$elements.'>'."\n";
		return $str;
	}	
}

// Function: list_builder()
// İşlev: Liste oluşturmak için kullanılır.
// Parametreler
// @elements = Dizi tipinde liste elemanları girilir.
// @attributes = Elementin özellikleri.
// @type = Liste tipi.
// Dönen Değer: Liste.

if(!function_exists('list_builder'))
{
	function list_builder($elements = '', $attributes = '', $type = 'ul')
	{
		if( ! is_array($elements) || empty($elements)) return false;
		
		if( ! is_string($type)) $type = 'ul';
		
		$list = '<'.$type.attributes($attributes).'>'."\n";
		
		$i=0;
		foreach($elements as $k => $values)
		{
			$list .= "\t".'<li>'.$values.'</li>'."\n";
			$i++;
		}
		
		$list .= '</'.$type.'>'."\n";
		return $list;
	}
}

// Function: table_builder()
// İşlev: Liste oluşturmak için kullanılır.
// Parametreler
// @elements = Dizi tipinde liste elemanları girilir.
// @attributes = Elementin özellikleri.
// @type = Liste tipi.
// Dönen Değer: Liste.

if(!file_exists('table_builder'))
{
	function table_builder($elements = '', $attributes = '')
	{
		if( ! is_array($elements) || empty($elements)) return false;
		
		$table = '<table '.attributes($attributes).'>';
		$colno = 1;
		$rowno = 1;
		
		foreach($elements as $key => $element)
		{
			$table .= "\n\t".'<tr>'."\n";
			
			if(is_array($element))foreach($element as $k => $v)
			{
				$val = $v;
				$attr = "";
				
				if(is_array($v))
				{
					$attr = attributes($v);
					$val = $k;
				}
			
				$table .= "\t\t".'<td'.$attr.'>'.$val.'</td>'."\n";	
				$colno++;
			}
		
			$table .= "\t".'</tr>'."\n";
			$rowno++;
		}
		$table .= '</table>';
		
		return $table;
	}
}

