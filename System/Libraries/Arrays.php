<?php
/************************************************************/
/*                    LIBRARY ARRAYS                        */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* ARRAYS                                                                             	  *
*******************************************************************************************
| Sınıfı Kullanırken      :	Arrays::, $this->arrays, zn::$use->arrays, uselib('arrays')   |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/	
class Arrays
{
	/******************************************************************************************
	* ARRAY POS CHANGE                                                                        *
	*******************************************************************************************
	| Genel Kullanım: Herhangi bir dizi indeksini, istenilen başka bir dizi indeksine 		  |
	| eklemeye yarar.  															              |
	|																						  |
	| Parametreler: 3 parametresi vardır.                                              		  |
	| 1. array var @array => İşlem yapılıcak dizi.							  				  |
	| 2. string/numeric var @poss => Yerleştirme işlemi yapılacak elemanın indeksi.		      |
	| 3. string/numeric var @change_pos => Yerleştirme işlemi yapılacağı yeni indeks numarası.|
	|          																				  |
	| Örnek Kullanım:         																  |
	| $dizi = array("a", "b", "c", "d", "e");												  |
	| var_dump(array_posChange($dizi, 0, 4));  // Çıktı: b c d e a 				          |
	|          																				  |
	| Dizideki eleman isimlerini kullanarak yer değiştirmek.								  |	
	| var_dump(array_posChange($dizi, "a", "c"));  // Çıktı: b c a d e 					  |
	| var_dump(array_posChange($dizi, "b", "e"));  // Çıktı: a c d e b    					  |
	| 																						  |
	| Dizideki eleman numarası ve ismini kullanarak yer değiştirmek.					      |	
	| var_dump(array_posChange($dizi, 1, "c"));  // Çıktı: a c b d e 						  |
	| var_dump(array_posChange($dizi, "b", 4));  // Çıktı: a c d e b						  |
	|																						  |
	******************************************************************************************/	
	public static function posChange($array = '', $poss = '', $changePos = '')
	{
		if( ! is_array($array) ) 
		{
			return false;
		}
		
		if( ! is_numeric($poss) ) 
		{
			$poss = array_search($poss, $array);
		}
		
		if( ! is_numeric($changePos) ) 
		{
			$changePos = array_search($changePos, $array);
		}
		
		$pos = $poss;
		
		$lastArray = array();
		
		if( $pos > $changePos ) 
		{ 
			$pos = $changePos; 
			$changePos = $poss;
		}

		for($i = 0; $i < count($array); $i++)
		{		
			if( $i < $pos )
			{
				$lastArray[$i] = $array[$i];
			}
			else
			{			
				if( $i < $changePos )
				{
					$lastArray[$i] = $array[$i + 1];
				}
				elseif($i == $changePos)
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

	
	/******************************************************************************************
	* ARRAY POS REVERSE                                                                       *
	*******************************************************************************************
	| Genel Kullanım: Dizi elementlarını kendi içlerinde yer değiştirmek için kullanılır. 	  |
	|																						  |
	| Parametreler: 3 parametresi vardır.                                              		  |
	| 1. array var @array => İşlem yapılıcak dizi.							  				  |
	| 2. string/numeric var @poss => Yerleştirme işlemi yapılacak elemanın indeksi.		      |
	| 3. string/numeric var @change_pos => Yerleştirme işlemi yapılacağı yeni indeks numarası.|
	|          																				  |
	| Örnek Kullanım:         																  |
	| $dizi = array("a", "b", "c", "d", "e");												  |
	| var_dump(array_posReverse($dizi, 0, 4));  // Çıktı: e b c d a 						  |
	| var_dump(array_posReverse($dizi, 1, 3));  // Çıktı: a d c b e  						  |
	|																						  |
	| Dizideki eleman isimlerini kullanarak yer değiştirmek.								  |
	| var_dump(array_posReverse($dizi, "a", "c"));  // Çıktı: c b a d e 					  |
	| var_dump(array_posReverse($dizi, "b", "e"));  // Çıktı: a e c d b    				  |
	|																						  |
	| Dizideki eleman numarası ve ismini kullanarak yer değiştirmek.						  |
	| var_dump(array_posReverse($dizi, 1, "c"));  // Çıktı: a c b d e 						  |
	| var_dump(array_posReverse($dizi, "b", 4));  // Çıktı: a e c d b    					  |
	|          																				  |
	******************************************************************************************/
	public static function posReverse($array = '', $poss = '', $changePos = '')
	{
		if( ! is_array($array) ) 
		{
			return false;
		}
		
		if( ! is_numeric($poss) ) 
		{
			$poss = array_search($poss, $array);
		}
		if( ! is_numeric($changePos) ) 
		{
			$changePos = array_search($changePos, $array);
		}
		
		$pos = $poss;
		
		$lastArray = array();
		
		if( $pos > $changePos ) 
		{ 
			$pos = $changePos; 
			$changePos = $poss;
		}

		for($i = 0; $i < count($array); $i++)
		{
			if( $i == $pos )
			{	
				$element = $array[$i];
				$lastArray[$i] = "";
			}
			elseif( $i == $changePos )
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
	
	/******************************************************************************************
	* ARRAY CASE -> V2 - TEMMUZ GÜNCELLEMESİ                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dizinnin . 	                          |
	|																						  |
	******************************************************************************************/
	public static function casing($array = array(), $type = 'lower', $keyval = 'all')
	{
		return Convert::arrayCase($array, $type, $keyval);
	}
	
	/******************************************************************************************
	* ARRAY DELETE ELEMENT                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Diziden istenilen eleman veya elamanları silmek için kullanılır. 	      |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              		  |
	| 1. array var @array => İşlem yapılıcak dizi.							  				  |
	| 2. string/numeric var @object => Silinecek eleman.		                              |
	|          																				  |
	| Örnek Kullanım:         																  |
	| $dizi = array("a", "b", "c", "d", "e");												  |
	| var_dump(array_deleteElement($dizi, 1));  // Çıktı: a c d e  						  |
	| var_dump(array_deleteElement($dizi, 3));  // Çıktı: a b c e  						  |
	|																						  |		
	| Dizideki eleman isimlerini kullanarak silmek.										      |
	| var_dump(array_deleteElement($dizi, "a"));  // Çıktı: b c d e						  |
	| var_dump(array_deleteElement($dizi, "c"));  // Çıktı: a b d e						  |
	|																						  |
	| Dizideki elemanları toplu olarak silmek.												  |
	| var_dump(array_deleteElement($dizi, array("a", "c")));  // Çıktı: b d e 				  |
	| var_dump(array_deleteElement($dizi, array(1, 2)));  // Çıktı: a d e  				  |
	|          																				  |
	******************************************************************************************/
	public static function deleteElement($array = array(), $object = "")
	{
		if( ! is_array($array) ) 
		{
			return false;
		}
		
		$new_array = array();
		
		if( ! is_array($object) )
		{
			if( isset($array[$object]) )
			{			
				foreach($array as $k => $v)
				{
					if( $k !== $object )
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
				if( ! in_array($k, $object) && ! in_array($v, $object) )
				{
					$new_array[] = $v;	
				}			
			}	
			return $new_array;
		}
	}
	
	
	/******************************************************************************************
	* MULTI KEY ARRAY                                                                         *
	*******************************************************************************************
	| Genel Kullanım: Çoklu anahtar oluşturmak için kullanılır. 	                          |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              		  |
	| 1. array var @array => İşlem yapılıcak dizi.							  				  |
	| 2. string var @key_split => Çoklu anahtarları ayır edecek ayraç bilgisi. Varsayılan:|   |
	|          																				  |
	| Örnek Kullanım:   																	  |
	| $dizi = array('a|b|c|d' => 'deger');													  |
	| $dizi = multi_key_array($dizi);														  |
	|																						  |
	| var_dump($dizi);																		  |
	|																						  |
	| array (size=4)																		  |
	| 'a' => string 'deger' (length=5)														  |
	| 'b' => string 'deger' (length=5)													      |
	| 'c' => string 'deger' (length=5)														  |
	| 'd' => string 'deger' (length=5)     													  |
	|          																				  |
	******************************************************************************************/
	public static function multikey($array = array(), $key_split = "|")
	{
		$new_array = array();
		
		if( is_array($array) ) 
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
	
	/******************************************************************************************
	* ARRAY KEYVAL                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Bir dizinin anahtarını yada değerini elde etmek için kullanılır. 	      |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              		  |
	| 1. array var @array => İşlem yapılıcak dizi.							  				  |
	| 2. string var @keyval => Öğrenilmek istenen bilgi. Varsayılan:val                       |
	|          																				  |
	| Örnek Kullanım: array_keyval($dizi, "val")  											  |
	| 																						  |
	| 2. Parametrenin alabileceği değerler.         										  |
	| 1-val veya value // Diziye ait ilk elemanın değerini verir.							  |
	| 2-key // Diziye ait ilk elemanın anahtar değerini verir.								  |
	| 3-vals veya values // Diziye ait tüm değerler elde edilir.							  |
	| 4-keys // Diziye ait tüm anahtarlar elde edilir.        								  |
	|          																				  |
	******************************************************************************************/
	public static function keyval($array = array(), $keyval = "val")
	{
		if( ! is_array($array) ) 
		{
			return false;
		}
		
		if( $keyval === "val" || $keyval === "value" )
		{
			return current($array);
		}
		elseif( $keyval === "key" )
		{
			return key($array);
		}
		elseif( $keyval === "vals" || $keyval === "values" )
		{
			return array_values($array);
		}
		elseif( $keyval === "keys" )
		{
			return array_keys($array);
		}
		else
		{
			return current($array);
		}
	}

	
	/******************************************************************************************
	* OBJECT DATA                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Dizi olarak girilen verileri object veri tipine dönüştürür. 	          |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              		  |
	| 1. array var @array => İşlem yapılıcak dizi.							  				  |
	|																						  |
	| Örnek Kullanım: objectData(array(1 => true, 2 => false))  							  |
	| // {1:true, 2:false} 																	  |
	|          																				  |
	******************************************************************************************/
	public static function objectData($data = array())
	{
		if( ! is_array($data) )
		{
			return $data;	
		}
		return json_encode($data);		
	}	
}