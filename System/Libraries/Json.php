<?php 
/************************************************************/
/*                      CLASS JSON                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* JSON                                                                               	  *
*******************************************************************************************
| Sınıfı Kullanırken      :	json:: , $this->json , uselib('json')-> , zn::$use->json      |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/
class Json
{
	/* Key Değişkeni
	 *  
	 * Anahtar ile değer asındaki ayraç
	 * Varsayılan:+-?||?-+
	 */
	private static $key = "+-?||?-+" ;
	
	/* Seperator Değişkeni
	 *  
	 * Anahtar ve değerler asındaki ayraç
	 * Varsayılan:|?-++-?|
	 */
	private static $seperator = "|?-++-?|";
	
	/******************************************************************************************
	* ENCODE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen ayraçlara göre diziyi özel bir veri tipine çeviriyor.        |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. array var @data => Özel veriye çevrilecek dizi parametresi.        	  			  |
	| 2. [ string var @key ] => Anahtar değer ayracı. Varsayılan:+-?||?-+	                  |
	| 3. [ string var @seperator ] => Parametre ayracı. Varsayılan:|?-++-?|	                  |
	|          																				  |
	| Örnek Kullanım: encode(array(1 => 1, 2 => 2));        	  					          |
	| // 1+-?||?-+1|?-++-?|2+-?||?-+2     													  |
	|          																				  |
	******************************************************************************************/	
	public static function encode($data = array(), $key = '', $seperator = '')
	{
		// Parametre kontrolleri yapılıyor. -------------------------------------------
		if( ! is_array($data) ) 
		{
			return false;
		}
		
		if( ! is_string($key) ) 
		{
			$key = '';
		}
		
		if( ! is_string($seperator) ) 
		{
			$seperator = '';
		}
		
		$word = '';
		
		// @key parametresi boş ise ön tanımlı ayracı kullan.
		if( empty($key) ) 
		{
			$key = self::$key;
		}
		
		// @seperator parametresi boş ise ön tanımlı ayracı kullan.
		if( empty($seperator) ) 
		{
			$seperator = self::$seperator;
		}
		// -----------------------------------------------------------------------------
		
		// Özel veri tipine çevirme işlemini başlat.
		foreach($data as $k => $v)
		{
			$word .= $k.$key.$v.$seperator;	
		}
		
		return substr($word, 0, -(strlen($seperator)));
	}
	
	/******************************************************************************************
	* DECODE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Özel veriyi Object veri türüne çevirir.        						  |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. array var @data => Object veri türüne çevrilecek özel veri.        	  			  |
	| 2. [ string var @key ] => Anahtar değer ayracı. Varsayılan:+-?||?-+	                  |
	| 3. [ string var @seperator ] => Parametre ayracı. Varsayılan:|?-++-?|	                  |
	|          																				  |
	| Örnek Kullanım: decode('1+-?||?-+1|?-++-?|2+-?||?-+2 ');        	  					  |
	| //  (object)array(1 => 1, 2 => 2)   													  |
	|          																				  |
	******************************************************************************************/	

	public static function decode($word = '', $key = '', $seperator = '')
	{
		// Parametre kontrolleri yapılıyor. -------------------------------------------
		if( ! is_string($word) ) 
		{
			return false;
		}
		
		if( empty($word) ) 
		{
			return false;
		}
		
		if( ! is_string($key) ) 
		{
			$key = '';
		}
		
		if( ! is_string($seperator) ) 
		{
			$seperator = '';
		}
		
		if( empty($key) ) 
		{
			$key = self::$key;
		}
		
		if( empty($seperator) ) 
		{
			$seperator = self::$seperator;
		}
		// -----------------------------------------------------------------------------
		
		$keyval = explode($seperator, $word);
		$splits = array();
		$object = array();
		
		if( is_array($keyval) ) foreach($keyval as $v)
		{
			 $splits = explode($key, $v);
			 if( isset($splits[1]) )
			 {
				$object[$splits[0]] = $splits[1];
			 }
		}
		
		return (object)$object;
	}
}