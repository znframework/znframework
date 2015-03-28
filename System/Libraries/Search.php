<?php
/************************************************************/
/*                       CLASS SEARCH                       */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Search
{
	// private static $result 
	// @var array
	// Arama sonucu verilerini tutaması için tanımlanmış dizi değişken
	private static $result;
	
	// private static $filter 
	// @var = array
	// Aramayı başlatmadan önce filtre uygulamak için
	// tanımlanmış dizi değişken
	private static $filter = array();
	
	// filter()
	// @column string = sütun ismi
	// @operator string = karşılaştırma veya mantıksal operatör
	// @value string/numeric = değer
	public static function filter($column = '', $operator = '', $value = '')
	{
		// sütun adı veya operatör metinsel ifade içermiyorsa false değeri döndür.
		if( ! is_string($column) || ! is_string($operator)) return false;
		
		// değer, metinsel veya sayısal değer içermiyorsa false değeri döndür.
		if( ! (is_string($value) || is_numeric($value))) return false;
		
		// $filtre dizi değişkenine parametre olarak gönderilen değerleri string olarak ekle.
		self::$filter[] = "$column|$operator|$value|and";
	}
	
	public static function or_filter($column = '', $operator = '', $value = '')
	{
		// sütun adı veya operatör metinsel ifade içermiyorsa false değeri döndür.
		if( ! is_string($column) || ! is_string($operator)) return false;
		
		// değer, metinsel veya sayısal değer içermiyorsa false değeri döndür.
		if( ! (is_string($value) || is_numeric($value))) return false;
		
		// $filtre dizi değişkenine parametre olarak gönderilen değerleri string olarak ekle.
		self::$filter[] = "$column|$operator|$value|or";
	}
	
	// get()	
	// site içi aramak için kullanılır
	// @conditions array = tablo adı ve tabloya ait sütun dizisidir
	// örnek: array('table1' => array('column1','column2') , 'table2' => array('column1','column2'));
	// @word string = aranacak kelime
	// @type string = arama türü => starting, ending, inside
	
	public static function get($conditions = array(), $word = '', $type = 'inside')
	{
		if( ! is_array($conditions)) return false;
		if( ! (is_string($word) || is_numeric($word))) return false;
		if( ! is_string($type)) $type = "inside";
		
		import::library('Database');
		$word = addslashes($word);
		
		$str = "";
		
		if($type === "inside") $str = '%'.$word.'%';
		if($type === "starting") $str = $word.'%';
		if($type === "ending") $str = '%'.$word;
		
		foreach($conditions as $key => $values)
		{
			db::distinct();

			
			foreach($values as $keys)
			{	
				db::or_where($keys,'like',$str);
				
				if( ! empty(self::$filter))
				{
					foreach(self::$filter as $val)
					{		
						$exval = explode("|", $val);
		
						if($exval[3] === "and")
							db::where($key.".".$exval[0], $exval[1], $exval[2]);	
						if($exval[3] === "or")
							db::or_where($key.".".$exval[0], $exval[1], $exval[2]);
					}	
				}
			}
			$get = db::get($key);
			self::$result[$key] = $get->result;
		}
		
		$result = self::$result;
		self::$result = '';
		self::$filter = array();
		return (object)$result;
	
	}
}