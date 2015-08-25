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
	* CALL                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Geçersiz fonksiyon girildiğinde çağrılması için.						  |
	|          																				  |
	******************************************************************************************/
	public function __call($method = '', $param = '')
	{	
		die(getErrorMessage('Error', 'undefinedFunction', "Arrays::$method()"));	
	}
	
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
	| Genel Kullanım: Dizinnin . 	                          								  |
	|																						  |
	******************************************************************************************/
	public function casing($array = array(), $type = 'lower', $keyval = 'all')
	{
		return Convert::arrayCase($array, $type, $keyval);
	}
	
	/******************************************************************************************
	* REMOVE LAST -> V2 - EYLÜL GÜNCELLEMESİ                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dizinin son kaldırmak silmek için kullanılır.							  |
	|																						  |
	******************************************************************************************/
	public function removeLast($array = array(), $count = 1)
	{
		if( ! is_array($array) ) 
		{
			return Error::set(lang('Error', 'arrayParameter', 'array'));
		}
		
		if( $count <= 1 )
		{
			array_pop($array);
		}
		else
		{
			$arrayCount =  count($array);
			
			for($i = 1; $i <= $count; $i++)
			{
				array_pop($array);
				
				if( $i === $arrayCount )
				{
					break;
				}
			}	
		}
		
		return $array;
	}
	
	/******************************************************************************************
	* REMOVE FIRST -> V2 - EYLÜL GÜNCELLEMESİ                                                 *
	*******************************************************************************************
	| Genel Kullanım: Dizinin ilk elemanını kaldırmak için kullanılır.						  |
	|																						  |
	******************************************************************************************/
	public function removeFirst($array = array(), $count = 1)
	{
		if( ! is_array($array) ) 
		{
			return Error::set(lang('Error', 'arrayParameter', 'array'));
		}
		
		if( $count <= 1 )
		{
			array_shift($array);
		}
		else
		{
			$arrayCount =  count($array);
			
			for($i = 1; $i <= $count; $i++)
			{
				array_shift($array);
				
				if( $i === $arrayCount )
				{
					break;
				}
			}	
		}
		
		return $array;
	}
	
	/******************************************************************************************
	* ADD FIRST -> V2 - EYLÜL GÜNCELLEMESİ                                                    *
	*******************************************************************************************
	| Genel Kullanım: Dizinin başına elaman ekleme için kullanılır.							  |
	|																						  |
	******************************************************************************************/
	public function addFirst($array = array(), $element = '')
	{
		if( ! is_array($array) ) 
		{
			return Error::set(lang('Error', 'arrayParameter', 'array'));
		}
		
		if( ! is_array($element) )
		{
			array_unshift($array, $element);	
		}
		else
		{
			$array = array_merge($element, $array);
		}
		
		return $array;
	}
	
	/******************************************************************************************
	* ADD LAST -> V2 - EYLÜL GÜNCELLEMESİ                                                     *
	*******************************************************************************************
	| Genel Kullanım: Dizinin sonuna elaman ekleme için kullanılır.							  |
	|																						  |
	******************************************************************************************/
	public function addLast($array = array(), $element = array())
	{
		if( ! is_array($array) ) 
		{
			return Error::set(lang('Error', 'arrayParameter', 'array'));
		}
		
		if( ! is_array($element) )
		{
			array_push($array, $element);	
		}
		else
		{
			$array = array_merge($array, $element);
		}
		
		return $array;
	}
	
	/******************************************************************************************
	* ARRAY DELETE ELEMENT                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Diziden istenilen eleman veya elamanları silmek için kullanılır. 	      |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              		  |
	| 1. array var @array => İşlem yapılıcak dizi.							  				  |
	| 2. mixed var @object => Silinecek eleman.		                              |
	|          																				  |
	******************************************************************************************/
	public function deleteElement($array = array(), $object = '')
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
	* GET LAST		                             			                                  *
	*******************************************************************************************
	| Genel Kullanım: Dizinin son elemanını döndürür.										  |
	
	  @param 	array   $array
	  @param 	numeric $count
	  @param	bool	$preserverKey
	  @return 	string, array
	|          																				  |
	******************************************************************************************/
	public function getLast($array = array(), $count = 1, $preserverKey = false)
	{
		if( ! is_array($array) )
		{
			return Error::set(lang('Error', 'arrayParameter', '1.(array)'));	
		}
		
		if( $count <= 1 )
		{
			$array = end($array);
		}
		else
		{
			return $this->section($array, -$count, NULL, $preserverKey);
		}
		
		return $array;
	}
	
	/******************************************************************************************
	* GET FIRST		                             			                                  *
	*******************************************************************************************
	| Genel Kullanım: Dizinin ilk elemanını döndürür.										  |
	
	  @param 	array   $array
	  @param 	numeric $count
	  @param	bool	$preserverKey
	  @return 	string, array
	|          																				  |
	******************************************************************************************/
	public function getFirst($array = array(), $count = 1, $preserverKey = false)
	{
		if( ! is_array($array) )
		{
			return Error::set(lang('Error', 'arrayParameter', '1.(array)'));	
		}
		
		if( $count <= 1 )
		{
			$array = $array[0];
		}
		else
		{
			return $this->section($array, 0, $count, $preserverKey);
		}
		
		return $array;
	}
	
	/******************************************************************************************
	* ORDER                                        			                                  *
	*******************************************************************************************
	| Genel Kullanım: Dizide sıralama yapmak için kullanılır.								  |
	
	  @param 	array  $array
	  @param	string $type  -> asc(asort),  		desc(arsort), 		 	asckey(ksort),   
	  							 desckey(krsort), 	user(usort),		 	userassoc(uasort), 
								 userkey(uksort), 	insens(natcasesort), 	natural(natsort), 	
								 reverse(rsort),	random(shuffle)
	  @param 	value  $flags -> regular, numeric, string, locale_string, natural, flag_case
	  @return 	array
	|          																				  |
	******************************************************************************************/
	public function order($array = array(), $type = '', $flags = 'regular')
	{
		if( ! is_array($array) )
		{
			return Error::set(lang('Error', 'arrayParameter', '1.(array)'));	
		}
		
		if( ! is_string($type) )
		{
			return Error::set(lang('Error', 'stringParameter', '2.(type)'));	
		}

		$flags = Convert::toConstant($flags, 'SORT_');
		
		switch($type)
		{	
			case 'desc' 		: arsort($array, $flags); 	break;
			case 'asc'  		: asort($array, $flags);  	break;			
			case 'asckey'  		: ksort($array, $flags);  	break;
			case 'desckey' 		: krsort($array, $flags); 	break;
			case 'insens' 		: natcasesort($array);    	break;	
			case 'natural' 		: natsort($array);		   	break;
			case 'reverse' 		: rsort($array, $flags);  	break;
			case 'userassoc' 	: uasort($array, $flags); 	break;
			case 'userkey' 		: uksort($array, $flags); 	break;
			case 'user' 		: usort($array, $flags);  	break;
			case 'random' 		: shuffle($array);  		break;
			default				: sort($array, $flags);	
		}
		
		return $array;
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
	
	/******************************************************************************************
	* LENGTH                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dizinin eleman sayısını döndürür.							 	          |
	|          																				  |
	******************************************************************************************/
	public function length($data = array())
	{
		if( ! is_array($data) )
		{
			return Error::set(lang('Error', 'arrayParameter', '1.(data)'));	
		}
		
		return count($data);	
	}
	
	/******************************************************************************************
	* APPORTION                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Diziyi eşit paraçlara böler.								 	          |
	|          																				  |
	******************************************************************************************/
	public function apportion($data = array(), $portionCount = 1, $preserveKeys = false)
	{
		if( ! is_array($data) )
		{
			return Error::set(lang('Error', 'arrayParameter', '1.(data)'));	
		}
		
		return array_chunk($data, $portionCount, $preserveKeys);	
	}
	
	/******************************************************************************************
	* COMBINE                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: ' diziyi anahtar değer çifti olarak birleştirir.			 	          |
	
	  @param 	array $keys
	  @param	array $values
	  @return 	array
	|          																				  |
	******************************************************************************************/
	public function combine($keys = array(), $values = array())
	{
		if( ! is_array($keys) || ! is_array($values) )
		{
			return Error::set(lang('Error', 'arrayParameter', '1.(keys) & 2.(values)'));	
		}
		
		return array_combine($keys, $values);	
	}
	
	/******************************************************************************************
	* COUNT SAME VALUES                                                                       *
	*******************************************************************************************
	| Genel Kullanım: Dizide yer alan değerlerden hangisinden kaç tane olduğunu sayar.        |
	
	  @param 	array $array
	  @param	value $key
	  @return 	array, string
	|          																				  |
	******************************************************************************************/
	public function countSameValues($array = array(), $key = NULL)
	{
		if( ! is_array($array) )
		{
			return Error::set(lang('Error', 'arrayParameter', '1.(array)'));	
		}
		
		$return = array_count_values($array);	
		
		if( ! empty($key) )
		{
			if( isset($return[$key]) )
			{
				return $return[$key];	
			}
			else
			{
				return false;	
			}
		}
		
		return $return;
	}
	
	/******************************************************************************************
	* FLIP                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Dizinin anahtarları ile değerleri yer değiştirir.			 	          |
	
	  @param 	array $array
	  @return 	array
	|          																				  |
	******************************************************************************************/
	public function flip($array = array())
	{
		if( ! is_array($array) )
		{
			return Error::set(lang('Error', 'arrayParameter', '1.(array)'));	
		}
		
		return array_flip($array);	
	}
	
	/******************************************************************************************
	* IMPLEMENT CALLBACK                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen dizilerin elemanlarına geriçağırım işlevini uygular.		  |
	
	  @param 	string $functionName
	  @param 	array ...arguments
	  @return	array
	|          																				  |
	******************************************************************************************/
	public function implementCallback()
	{
		return Functions::callArray('array_map', func_get_args());
	}
	
	/******************************************************************************************
	* RECURSIVE MERGE                                                                         *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen dizileri bileştirmek için kullanılır.						  |
	
	  @param 	array ...arguments
	  @return 	array
	|          																				  |
	******************************************************************************************/
	public function recursiveMerge()
	{
		return Functions::callArray('array_merge_recursive', func_get_args());
	}
	
	/******************************************************************************************
	* MERGE                                        			                                  *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen dizileri bileştirmek için kullanılır.						  |
	
	  @param 	array ...arguments
	  @return 	array
	|          																				  |
	******************************************************************************************/
	public function merge()
	{
		return Functions::callArray('array_merge', func_get_args());
	}
	
	/******************************************************************************************
	* REVERSE                                     			                                  *
	*******************************************************************************************
	| Genel Kullanım: Diziyi tersine sıralayıp döndürür.									  |
	
	  @param 	array $array
	  @param 	bool  $preserveKeys
	  @return 	array
	|          																				  |
	******************************************************************************************/
	public function reverse($array = array(), $preserveKeys = false)
	{
		if( ! is_array($array) )
		{
			return Error::set(lang('Error', 'arrayParameter', '1.(array)'));	
		}
		
		if( ! is_bool($preserveKeys) )
		{
			return Error::set(lang('Error', 'booleanParameter', '2.(preserveKeys)'));	
		}
		
		return array_reverse($array, $preserveKeys);
	}
	
	/******************************************************************************************
	* PRODUCT                                     			                                  *
	*******************************************************************************************
	| Genel Kullanım: Dizideki değerlerin çarpımını verir.									  |
	
	  @param 	array $array
	  @return 	numeric
	|          																				  |
	******************************************************************************************/
	public function product($array = array())
	{
		if( ! is_array($array) )
		{
			return Error::set(lang('Error', 'arrayParameter', '1.(array)'));	
		}
		
		return array_product($array);
	}
	
	/******************************************************************************************
	* SUM                                     				                                  *
	*******************************************************************************************
	| Genel Kullanım: Dizideki değerlerin toplamını verir.									  |
	
	  @param 	array $array
	  @return 	numeric
	|          																				  |
	******************************************************************************************/
	public function sum($array = array())
	{
		if( ! is_array($array) )
		{
			return Error::set(lang('Error', 'arrayParameter', '1.(array)'));	
		}
		
		return array_sum($array);
	}
	
	/******************************************************************************************
	* RANDOM                                     			                                  *
	*******************************************************************************************
	| Genel Kullanım: Bir diziden belli sayıda rasgele eleman döndürür.						  |
	
	  @param 	array 	$array
	  @param	numeric $countRequest
	  @return 	numeric, array
	|          																				  |
	******************************************************************************************/
	public function random($array = array(), $countRequest = 1)
	{
		if( ! is_array($array) )
		{
			return Error::set(lang('Error', 'arrayParameter', '1.(array)'));	
		}
		
		if( ! is_numeric($countRequest) )
		{
			return Error::set(lang('Error', 'numericParameter', '2.(countRequest)'));	
		}
		
		return array_rand($array, $countRequest);
	}
	
	/******************************************************************************************
	* SEARCH                                     			                                  *
	*******************************************************************************************
	| Genel Kullanım: Bir dizide belirtilen değeri arar ve bulursa ilgili anahtarı döndürür.  |
	
	  @param 	array $array
	  @param 	mixed $element
	  @param 	bool  $strict
	  @return 	numeric
	|          																				  |
	******************************************************************************************/
	public function search($array = array(), $element = '', $strict = false)
	{
		if( ! is_array($array) )
		{
			return Error::set(lang('Error', 'arrayParameter', '1.(array)'));	
		}
		
		if( ! is_bool($strict) )
		{
			return Error::set(lang('Error', 'booleanParameter', '3.(strict)'));	
		}
		
		return array_search($element, $array, $strict);
	}
	
	/******************************************************************************************
	* VALUE EXISTS                                 			                                  *
	*******************************************************************************************
	| Genel Kullanım: Bir dizide bir değerin varlığını araştırır.  							  |
	
	  @param 	array $array
	  @param 	mixed $element
	  @param 	bool  $strict
	  @return 	bool
	|          																				  |
	******************************************************************************************/
	public function valueExists($array = array(), $element = '', $strict = false)
	{
		if( ! is_array($array) )
		{
			return Error::set(lang('Error', 'arrayParameter', '1.(array)'));	
		}
		
		if( ! is_bool($strict) )
		{
			return Error::set(lang('Error', 'booleanParameter', '3.(strict)'));	
		}
		
		return in_array($element, $array, $strict);
	}
	
	/******************************************************************************************
	* KEY EXISTS                                  			                                  *
	*******************************************************************************************
	| Genel Kullanım: Bir dizide bir anahtarın varlığını arar.  							  |
	
	  @param 	array $array
	  @param 	mixed $key
	  @return 	bool
	|          																				  |
	******************************************************************************************/
	public function keyExists($array = array(), $key = '')
	{
		if( ! is_array($array) )
		{
			return Error::set(lang('Error', 'arrayParameter', '1.(array)'));	
		}
		
		return array_key_exists($key, $array);
	}
	
	/******************************************************************************************
	* SECTION                                     			                                  *
	*******************************************************************************************
	| Genel Kullanım: Bir dizinin belli bir bölümünü döndürür.								  |
	
	  @param 	array 	$array
	  @param 	numeric $start
	  @param 	numeric $length
	  @param 	bool	$preserveKeys
	  @return	array
	|          																				  |
	******************************************************************************************/
	public function section($array = array(), $start = 0, $length = NULL, $preserveKeys = false)
	{
		if( ! is_array($array) )
		{
			return Error::set(lang('Error', 'arrayParameter', '1.(array)'));	
		}
		
		return array_slice($array, $start, $length, $preserveKeys);
	}
	
	/******************************************************************************************
	* RESECTION                                     			                                  *
	*******************************************************************************************
	| Genel Kullanım: Bir dizinin belli bir bölümünü silip yerine başka şeyler koyar.		  |
	
	  @param 	array 	$array
	  @param 	numeric $start
	  @param 	numeric $length
	  @param 	mixed	$newElement
	  @return 	array
	|          																				  |
	******************************************************************************************/
	public function resection($array = array(), $start = 0, $length = NULL, $newElement = NULL)
	{
		if( ! is_array($array) )
		{
			return Error::set(lang('Error', 'arrayParameter', '1.(array)'));	
		}
		
		array_splice($array, $start, $length, $newElement);
		
		return $array;
	}
	
	/******************************************************************************************
	* DELETE RECURRENT                             			                                  *
	*******************************************************************************************
	| Genel Kullanım: Diziden yinelenen değerleri siler.									  |
	
	  @param 	array $array
	  @param 	value $flags -> regular, numeric, string, locale_string
	  @return 	array
	|          																				  |
	******************************************************************************************/
	public function deleteRecurrent($array = array(), $flags = 'string')
	{
		if( ! is_array($array) )
		{
			return Error::set(lang('Error', 'arrayParameter', '1.(array)'));	
		}
		
		return array_unique($array, Convert::toConstant($flags, 'SORT_'));
	}
	
	/******************************************************************************************
	* SERIES                             			             		                      *
	*******************************************************************************************
	| Genel Kullanım: Belli bir eleman aralığını içeren bir dizi oluşturur.					  |
	
	  @param 	numeric $start
	  @param 	numeric $end
	  @param 	numeric $step
	  @return 	array
	|          																				  |
	******************************************************************************************/
	public function series($start = 0, $end = 0, $step = 1)
	{
		if( ! is_numeric($start) || ! is_numeric($end) || ! is_numeric($step) )
		{
			return Error::set(lang('Error', 'numericParameter', '1.(start) & 2.(end) & 3.(step)'));	
		}
		
		return range($start, $end, $step);
	}
}