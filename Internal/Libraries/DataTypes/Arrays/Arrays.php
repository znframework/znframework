<?php	
namespace ZN\DataTypes;

class InternalArrays extends \CallController implements ArraysInterface
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
	// Pos Change                                                                       
	//----------------------------------------------------------------------------------------------------
	//
	// @param array  $array
	// @param scalar $poss
	// @param scalar $changePoss
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function posChange(Array $array, $poss, $changePos)
	{
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
	// @param array  $array
	// @param scalar $poss
	// @param scalar $changePoss
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function posReverse(Array $array, $poss, $changePos)
	{
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
	public function casing(Array $array, String $type = 'lower', String $keyval = 'all')
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
	public function removeLast(Array $array, Int $count = 1)
	{
		if( $count <= 1 )
		{
			array_pop($array);
		}
		else
		{
			$arrayCount =  count($array);
			
			for( $i = 1; $i <= $count; $i++ )
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
	public function removeFirst(Array $array, Int $count = 1)
	{
		if( $count <= 1 )
		{
			array_shift($array);
		}
		else
		{
			$arrayCount =  count($array);
			
			for( $i = 1; $i <= $count; $i++ )
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
	public function addFirst(Array $array, $element)
	{
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
	public function addLast(Array $array, $element)
	{
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
	public function deleteElement(Array $array, $object)
	{
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
	public function multikey(Array $array, String $keySplit = '|')
	{
		$newArray = [];
		
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
	
	//----------------------------------------------------------------------------------------------------
	// Keyval
	//----------------------------------------------------------------------------------------------------
	//
	// @param array  $array
	// @param string $keyval: val/value, key, vals/values, keys						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function keyval(Array $array, String $keyval = 'val')
	{
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
	public function getLast(Array $array, Int $count = 1, Bool $preserveKey = false)
	{
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
	public function getFirst(Array $array, Int $count = 1, Bool $preserveKey = false)
	{
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
	public function order(Array $array, String $type = NULL, String $flags = 'regular')
	{
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
	public function objectData(Array $data)
	{
		return json_encode($data);		
	}	
	
	//----------------------------------------------------------------------------------------------------
	// Length
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array						  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function length(Array $data)
	{
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
	public function apportion(Array $data, Int $portionCount = 1, Bool $preserveKeys = false)
	{
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
	public function combine(Array $keys, Array $values)
	{
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
	public function countSameValues(Array $array, String $key)
	{
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
	public function flip(Array $array)
	{
		return array_flip($array);	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Transform
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array					  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function transform(Array $array)
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
	public function reverse(Array $array, Bool $preserveKeys = false)
	{
		return array_reverse($array, $preserveKeys);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Product
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array					  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function product(Array $array)
	{
		return array_product($array);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Sum
	//----------------------------------------------------------------------------------------------------
	//
	// @param array   $array					  
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function sum(Array $array)
	{
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
	public function random(Array $array, Int $countRequest = 1)
	{
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
	public function search(Array $array, $element, Bool $strict = false)
	{
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
	public function valueExists(Array $array, $element, Bool $strict = false)
	{
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
	public function keyExists(Array $array, $key)
	{	
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
	public function section(Array $array, Int $start = 0, Int $length = NULL, Bool $preserveKeys = false)
	{
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
	public function resection(Array $array, Int $start = 0, Int $length = NULL, $newElement = NULL)
	{
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
	public function deleteRecurrent(Array $array, String $flags = 'string')
	{
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
	public function series(Int $start, Int $end, Int $step = 1)
	{
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
	public function column(Array $array, $columnKey = 0, $indexKey = NULL)
	{
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
	public function excluding(Array $array, Array $excluding)
	{
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
	public function including(Array $array, Array $including)
	{
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
	public function each(Array $array, $callable)
    {
        foreach( $array as $k => $v ) 
		{
            $callable($v, $k);
        }
    }
}