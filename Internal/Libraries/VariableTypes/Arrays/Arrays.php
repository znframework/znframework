<?php	
namespace ZN\VariableTypes;

class InternalArrays implements ArraysInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Call Undefined Method                                                                       
	//----------------------------------------------------------------------------------------------------
	//
	// __call()
	//																						  
	//----------------------------------------------------------------------------------------------------
	use \CallUndefinedMethodTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Error Control                                                                      
	//----------------------------------------------------------------------------------------------------
	//
	// error()
	//																						  
	//----------------------------------------------------------------------------------------------------
	use \ErrorControlTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Pos Change                                                                       
	//----------------------------------------------------------------------------------------------------
	//
	// Genel Kullanım: Herhangi bir dizi indeksini, istenilen başka bir dizi indeksine 		  
	// eklemeye yarar.  															              
	//																						  
	// Parametreler: 3 parametresi vardır.                                              		  
	// 1. array var @array => İşlem yapılıcak dizi.							  				  
	// 2. string/numeric var @poss => Yerleştirme işlemi yapılacak elemanın indeksi.		      
	// 3. string/numeric var @change_pos => Yerleştirme işlemi yapılacağı yeni indeks numarası.
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function posChange($array = '', $poss = '', $changePos = '')
	{
		if( ! is_array($array) ) 
		{
			return \Errors::set('Error', 'arrayParameter', 'array');
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
		
		$lastArray = [];
		
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

	
	//----------------------------------------------------------------------------------------------------
	// Pos Reverse
	//----------------------------------------------------------------------------------------------------
	//
	// Genel Kullanım: Dizi elementlarını kendi içlerinde yer değiştirmek için kullanılır. 	  
	//																						  
	// Parametreler: 3 parametresi vardır.                                              		  
	// 1. array var @array => İşlem yapılıcak dizi.							  				  
	// 2. string/numeric var @poss => Yerleştirme işlemi yapılacak elemanın indeksi.		      
	// 3. string/numeric var @change_pos => Yerleştirme işlemi yapılacağı yeni indeks numarası.
	//          																				  
	//----------------------------------------------------------------------------------------------------
	public function posReverse($array = '', $poss = '', $changePos = '')
	{
		if( ! is_array($array) ) 
		{
			return \Errors::set('Error', 'arrayParameter', 'array');
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
		
		$lastArray = [];
		
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
	
	//----------------------------------------------------------------------------------------------------
	// Casing
	//----------------------------------------------------------------------------------------------------
	//
	// @param array  $array
	// @param string $type  : lower, upper, title
	// @param string $keyval: all, key, val	                          								  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function casing($array = [], $type = 'lower', $keyval = 'all')
	{
		return \Convert::arrayCase($array, $type, $keyval);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Remove Last
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array
	// @param numeric $count							  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function removeLast($array = [], $count = 1)
	{
		if( ! is_array($array) ) 
		{
			return \Errors::set('Error', 'arrayParameter', 'array');
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
	
	//----------------------------------------------------------------------------------------------------
	// Remove First
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array		
	// @param numeric $count			  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function removeFirst($array = [], $count = 1)
	{
		if( ! is_array($array) ) 
		{
			return \Errors::set('Error', 'arrayParameter', 'array');
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
	
	//----------------------------------------------------------------------------------------------------
	// Add First
	//----------------------------------------------------------------------------------------------------
	//
	// @param array $array
	// @param mixed $element						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function addFirst($array = [], $element = '')
	{
		if( ! is_array($array) ) 
		{
			return \Errors::set('Error', 'arrayParameter', 'array');
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
	
	//----------------------------------------------------------------------------------------------------
	// Add Last
	//----------------------------------------------------------------------------------------------------
	//
	// @param array $array
	// @param mixed $element						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function addLast($array = [], $element = [])
	{
		if( ! is_array($array) ) 
		{
			return \Errors::set('Error', 'arrayParameter', 'array');
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
	
	//----------------------------------------------------------------------------------------------------
	// Delete Element
	//----------------------------------------------------------------------------------------------------
	//
	// @param array $array
	// @param mixed $object						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function deleteElement($array = [], $object = '')
	{
		if( ! is_array($array) ) 
		{
			return \Errors::set('Error', 'arrayParameter', 'array');
		}
		
		$newArray = [];
		
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
	
	
	//----------------------------------------------------------------------------------------------------
	// Multikey
	//----------------------------------------------------------------------------------------------------
	//
	// @param array  $array
	// @param string $keySplit:|						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function multikey($array = [], $keySplit = "|")
	{
		$newArray = [];
		
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
			return \Errors::set('Error', 'arrayParameter', 'array');
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Keyval
	//----------------------------------------------------------------------------------------------------
	//
	// @param array  $array
	// @param string $keyval: val/value, key, vals/values, keys						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function keyval($array = [], $keyval = "val")
	{
		if( ! is_array($array) ) 
		{
			return \Errors::set('Error', 'arrayParameter', 'array');
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
		
	//----------------------------------------------------------------------------------------------------
	// Get Last
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array
	// @param numeric $count
	// @param bool	  $preserveKey						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function getLast($array = [], $count = 1, $preserveKey = false)
	{
		if( ! is_array($array) )
		{
			return \Errors::set('Error', 'arrayParameter', '1.(array)');	
		}
		
		if( $count <= 1 )
		{
			$array = end($array);
		}
		else
		{
			return $this->section($array, -$count, NULL, $preserveKey);
		}
		
		return $array;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Get First
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array
	// @param numeric $count
	// @param bool	  $preserveKey						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function getFirst($array = [], $count = 1, $preserveKey = false)
	{
		if( ! is_array($array) )
		{
			return \Errors::set('Error', 'arrayParameter', '1.(array)');	
		}
		
		if( $count <= 1 )
		{
			$array = $array[0];
		}
		else
		{
			return $this->section($array, 0, $count, $preserveKey);
		}
		
		return $array;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Order
	//----------------------------------------------------------------------------------------------------
	//
	// @param array  $array
	// @param string $type :desc, asc...
	// @param string $flags:regular						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function order($array = [], $type = '', $flags = 'regular')
	{
		if( ! is_array($array) )
		{
			return \Errors::set('Error', 'arrayParameter', '1.(array)');	
		}
		
		if( ! is_string($type) )
		{
			return \Errors::set('Error', 'stringParameter', '2.(type)');	
		}

		$flags = \Convert::toConstant($flags, 'SORT_');
		
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
	
	//----------------------------------------------------------------------------------------------------
	// Object Data
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array					  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function objectData($data = [])
	{
		if( ! is_array($data) )
		{
			return $data;	
		}
		
		return json_encode($data);		
	}	
	
	//----------------------------------------------------------------------------------------------------
	// Length
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function length($data = [])
	{
		if( ! is_array($data) )
		{
			return \Errors::set('Error', 'arrayParameter', '1.(data)');	
		}
		
		return count($data);	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Apportion
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array
	// @param numeric $portionCount
	// @param bool	  $preserveKeys						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function apportion($data = [], $portionCount = 1, $preserveKeys = false)
	{
		if( ! is_array($data) )
		{
			return \Errors::set('Error', 'arrayParameter', '1.(data)');	
		}
		
		return array_chunk($data, $portionCount, $preserveKeys);	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Combine
	//----------------------------------------------------------------------------------------------------
	//
	// @param array $keys
	// @param array $values					  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function combine($keys = [], $values = [])
	{
		if( ! is_array($keys) || ! is_array($values) )
		{
			return \Errors::set('Error', 'arrayParameter', '1.(keys) & 2.(values)');	
		}
		
		return array_combine($keys, $values);	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Count Same Values
	//----------------------------------------------------------------------------------------------------
	//
	// @param array $array
	// @param mixed $key					  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function countSameValues($array = [], $key = NULL)
	{
		if( ! is_array($array) )
		{
			return \Errors::set('Error', 'arrayParameter', '1.(array)');	
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
	
	//----------------------------------------------------------------------------------------------------
	// Flip
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array					  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function flip($array = [])
	{
		if( ! is_array($array) )
		{
			return \Errors::set('Error', 'arrayParameter', '1.(array)');	
		}
		
		return array_flip($array);	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Transform
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array					  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function transform($array = [])
	{
		return $this->flip($array);	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Implement Callback(Map)
	//----------------------------------------------------------------------------------------------------
	//
	// @param ...args				  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function implementCallback(...$args)
	{
		return $this->map(...$args);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Map
	//----------------------------------------------------------------------------------------------------
	//
	// @param ...args				  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function map(...$args)
	{
		return array_map(...$args);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Recursive Merge
	//----------------------------------------------------------------------------------------------------
	//
	// @param ...args				  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function recursiveMerge(...$args)
	{
		return array_merge_recursive(...$args);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Merge
	//----------------------------------------------------------------------------------------------------
	//
	// @param ...args			  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function merge(...$args)
	{
		return array_merge(...$args);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Intersect
	//----------------------------------------------------------------------------------------------------
	//
	// @param ...args			  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function intersect(...$args)
	{
		return array_intersect(...$args);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Reverse
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array
	// @param bool	  $preserveKeys						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function reverse($array = [], $preserveKeys = false)
	{
		if( ! is_array($array) )
		{
			return \Errors::set('Error', 'arrayParameter', '1.(array)');	
		}
		
		if( ! is_bool($preserveKeys) )
		{
			return \Errors::set('Error', 'booleanParameter', '2.(preserveKeys)');	
		}
		
		return array_reverse($array, $preserveKeys);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Product
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array					  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function product($array = [])
	{
		if( ! is_array($array) )
		{
			return \Errors::set('Error', 'arrayParameter', '1.(array)');	
		}
		
		return array_product($array);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Sum
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array					  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function sum($array = [])
	{
		if( ! is_array($array) )
		{
			return \Errors::set('Error', 'arrayParameter', '1.(array)');	
		}
		
		return array_sum($array);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Random
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array
	// @param numeric $countRequest					  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function random($array = [], $countRequest = 1)
	{
		if( ! is_array($array) )
		{
			return \Errors::set('Error', 'arrayParameter', '1.(array)');	
		}
		
		if( ! is_numeric($countRequest) )
		{
			return \Errors::set('Error', 'numericParameter', '2.(countRequest)');	
		}
		
		return array_rand($array, $countRequest);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Search
	//----------------------------------------------------------------------------------------------------
	//
	// @param array $array
	// @param mixed $element
	// @param bool	$strict						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function search($array = [], $element = '', $strict = false)
	{
		if( ! is_array($array) )
		{
			return \Errors::set('Error', 'arrayParameter', '1.(array)');	
		}
		
		if( ! is_bool($strict) )
		{
			return \Errors::set('Error', 'booleanParameter', '3.(strict)');	
		}
		
		return array_search($element, $array, $strict);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Value Exists
	//----------------------------------------------------------------------------------------------------
	//
	// @param array $array
	// @param mixed $element
	// @param bool	$strict						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function valueExists($array = [], $element = '', $strict = false)
	{
		if( ! is_array($array) )
		{
			return \Errors::set('Error', 'arrayParameter', '1.(array)');	
		}
		
		if( ! is_bool($strict) )
		{
			return \Errors::set('Error', 'booleanParameter', '3.(strict)');	
		}
		
		return in_array($element, $array, $strict);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Key Exists
	//----------------------------------------------------------------------------------------------------
	//
	// @param array $array
	// @param mixed $key					  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function keyExists($array = [], $key = '')
	{
		if( ! is_array($array) )
		{
			return \Errors::set('Error', 'arrayParameter', '1.(array)');	
		}
		
		return array_key_exists($key, $array);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Section
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array
	// @param numeric $start
	// @param numeric $length
	// @param bool	  $preserveKey						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function section($array = [], $start = 0, $length = NULL, $preserveKeys = false)
	{
		if( ! is_array($array) )
		{
			return \Errors::set('Error', 'arrayParameter', '1.(array)');	
		}
		
		return array_slice($array, $start, $length, $preserveKeys);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Resection
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array
	// @param numeric $start
	// @param numeric $length
	// @param mixed	  $newElement						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function resection($array = [], $start = 0, $length = NULL, $newElement = NULL)
	{
		if( ! is_array($array) )
		{
			return \Errors::set('Error', 'arrayParameter', '1.(array)');	
		}
		
		array_splice($array, $start, $length, $newElement);
		
		return $array;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Delete Recurrent
	//----------------------------------------------------------------------------------------------------
	//
	// @param array  $array
	// @param string $flags					  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function deleteRecurrent($array = [], $flags = 'string')
	{
		if( ! is_array($array) )
		{
			return \Errors::set('Error', 'arrayParameter', '1.(array)');	
		}
		
		return array_unique($array, \Convert::toConstant($flags, 'SORT_'));
	}
	
	//----------------------------------------------------------------------------------------------------
	// Series
	//----------------------------------------------------------------------------------------------------
	//
	// @param numeric $start
	// @param numeric $end
	// @param numeric $count						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function series($start = 0, $end = 0, $step = 1)
	{
		if( ! is_numeric($start) || ! is_numeric($end) || ! is_numeric($step) )
		{
			return \Errors::set('Error', 'numericParameter', '1.(start) & 2.(end) & 3.(step)');	
		}
		
		return range($start, $end, $step);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Column
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array
	// @param mixed   $columnKey
	// @param mixed	  $indexKey						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function column($array = [], $columnKey = 0, $indexKey = NULL)
	{
		if( ! is_array($array) )
		{
			return \Errors::set('Error', 'arrayParameter', '1.(array)');	
		}
		
		return array_column($array, $columnKey, $indexKey);
	}
	
	//----------------------------------------------------------------------------------------------------
	// excluding
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array
	// @param array   $excluding					  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function excluding($array = [], $excluding = [])
	{
		if( ! is_array($array) )
		{
			return \Errors::set('Error', 'arrayParameter', '1.(array)');	
		}
		
		$newArray = [];
		
		foreach( $array as $key => $val )
		{
			if( ! in_array($val, $excluding) && ! in_array($key, $excluding) )
			{
				$newArray[$key] = $val;
			}	
		}
		
		return $newArray;
	}
	
	//----------------------------------------------------------------------------------------------------
	// including
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array
	// @param array   $excluding					  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function including($array = [], $including = [])
	{
		if( ! is_array($array) )
		{
			return \Errors::set('Error', 'arrayParameter', '1.(array)');	
		}
		
		$newArray = [];
		
		foreach( $array as $key => $val )
		{
			if( in_array($val, $including) || in_array($key, $including) )
			{
				$newArray[$key] = $val;
			}	
		}
		
		return $newArray;
	}
	
	//----------------------------------------------------------------------------------------------------
	// each
	//----------------------------------------------------------------------------------------------------
	//
	// @param array    $array
	// @param callable $callable				  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function each($array = [], $callable = '')
    {
        foreach( $array as $k => $v ) 
		{
            $callable($v, $k);
        }
    }
}