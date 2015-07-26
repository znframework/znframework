<?php	
class __USE_STATIC_ACCESS__Arrays
{
	/***********************************************************************************/
	/* ARRAYS LIBRARY					                   	                           */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Arrays
	/* Versiyon: 1.0
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: html::, $this->arrays, zn::$use->arrays, uselib('arrays')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
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
	|																						  |
	******************************************************************************************/	
	public function posChange($array = '', $poss = '', $changePos = '')
	{
		if( ! is_array($array) ) 
		{
			return Error::set(lang('Error', 'arrayParameter', 'array'));
		}
		
		if( ! isRealNumeric($poss) ) 
		{
			$poss = array_search($poss, $array);
		}
		
		if( ! isRealNumeric($changePos) ) 
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

		for( $i = 0; $i < count($array); $i++ )
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
				elseif( $i == $changePos )
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
	******************************************************************************************/
	public function posReverse($array = '', $poss = '', $changePos = '')
	{
		if( ! is_array($array) ) 
		{
			return Error::set(lang('Error', 'arrayParameter', 'array'));
		}
		
		if( ! isRealNumeric($poss) ) 
		{
			$poss = array_search($poss, $array);
		}
		if( ! isRealNumeric($changePos) ) 
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

		for( $i = 0; $i < count($array); $i++ )
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
		
		if( isset($changeElement) )
		{
			$lastArray[$pos] = $changeElement;
		}
		
		if( isset($element) )
		{
			$lastArray[$changePos] = $element;
		}
		
		return $lastArray;
	}
	
	/******************************************************************************************
	* ARRAY CASE -> V2 - TEMMUZ GÜNCELLEMESİ                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dizinnin . 	                          |
	|																						  |
	******************************************************************************************/
	public function casing($array = array(), $type = 'lower', $keyval = 'all')
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
	******************************************************************************************/
	public function deleteElement($array = array(), $object = "")
	{
		if( ! is_array($array) ) 
		{
			return Error::set(lang('Error', 'arrayParameter', 'array'));
		}
		
		$newArray = array();
		
		if( ! is_array($object) )
		{
			if( isset($array[$object]) )
			{			
				foreach( $array as $k => $v )
				{
					if( $k !== $object )
					{
						$newArray[$k] = $v;
					}	
				}	
						
				return $newArray;	
			}
			else
			{
				if( is_numeric($object) )
				{
					for( $i=0; $i<count($array); $i++ )
					{
						if($i !== $object)
						{
							$newArray[] = $array[$i];		
						}	
					}				
					
					return $newArray;
				}
				else
				{
					foreach( $array as $k => $v )
					{			
						if( $v !== $object )
						{
							$newArray[] = $array[$k];		
						}	
					}	
					
					return $newArray;
				} 	
			}
		}
		else
		{
			foreach( $array as $k => $v )
			{			
				if( ! in_array($k, $object) && ! in_array($v, $object) )
				{
					$newArray[] = $v;	
				}			
			}	
			
			return $newArray;
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
	******************************************************************************************/
	public function multikey($array = array(), $keySplit = "|")
	{
		$newArray = array();
		
		if( is_array($array) ) 
		{
			foreach( $array as $k => $v )
			{
				$keys = explode($keySplit, $k);
				
				foreach( $keys as $val )
				{
					$newArray[$val] = $v;	
				}		
			}
			
			return $newArray;
		}
		else 
		{
			return Error::set(lang('Error', 'arrayParameter', 'array'));
		}
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
	******************************************************************************************/
	public function keyval($array = array(), $keyval = "val")
	{
		if( ! is_array($array) ) 
		{
			return Error::set(lang('Error', 'arrayParameter', 'array'));
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
	|          																				  |
	******************************************************************************************/
	public function objectData($data = array())
	{
		if( ! is_array($data) )
		{
			return $data;	
		}
		
		return json_encode($data);		
	}	
}