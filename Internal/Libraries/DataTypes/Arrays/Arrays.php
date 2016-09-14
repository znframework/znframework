<?php namespace ZN\DataTypes;

use Converter, CallController;
use ZN\DataTypes\Arrays\Exception\InvalidArgumentException;
use ZN\DataTypes\Arrays\Exception\LogicException;

class InternalArrays extends CallController implements ArraysInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Casing
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    // @param string $type  : lower, upper, title
    // @param string $keyval: all, key, val
    //
    //--------------------------------------------------------------------------------------------------------
    public function casing(Array $array, String $type = 'lower', String $keyval = 'all') : Array
    {
        return Converter::arrayCase($array, $type, $keyval);
    }

    //--------------------------------------------------------------------------------------------------------
    // Remove Key
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    // @param mixed $keys
    //
    //--------------------------------------------------------------------------------------------------------
    public function removeKey(Array $array, $keys) : Array
    {
        if( ! is_array($keys) )
        {
            unset($array[$keys]);
        }
        else
        {
            foreach( $keys as $key )
            {
                unset($array[$key]);
            }
        }

        return $array;
    }

    //--------------------------------------------------------------------------------------------------------
    // Remove Value
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    // @param mixed $values
    //
    //--------------------------------------------------------------------------------------------------------
    public function removeValue(Array $array, $values) : Array
    {
        return $this->deleteElement($array, $values);
    }

    //--------------------------------------------------------------------------------------------------------
    // Remove
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    // @param mixed $keys
    // @param mixed $values
    //
    //--------------------------------------------------------------------------------------------------------
    public function remove(Array $array, $keys, $values) : Array
    {
        if( ! empty($keys) )
        {
            $array = $this->removeKey($array, $keys);
        }

        if( ! empty($values) )
        {
            $array = $this->removeValue($array, $values);
        }

        return $array;
    }

    //--------------------------------------------------------------------------------------------------------
    // Remove Last
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    // @param numeric $count
    //
    //--------------------------------------------------------------------------------------------------------
    public function removeLast(Array $array, Int $count = 1, $type = 'array_pop') : Array
    {
        if( $count <= 1 )
        {
            $type($array);
        }
        else
        {
            $arrayCount = count($array);

            for( $i = 1; $i <= $count; $i++ )
            {
                $type($array);

                if( $i === $arrayCount )
                {
                    break;
                }
            }
        }

        return $array;
    }

    //--------------------------------------------------------------------------------------------------------
    // Remove First
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    // @param numeric $count
    //
    //--------------------------------------------------------------------------------------------------------
    public function removeFirst(Array $array, Int $count = 1) : Array
    {
        return $this->removeLast($array, $count, 'array_shift');
    }

    //--------------------------------------------------------------------------------------------------------
    // Delete Element
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    // @param mixed $object
    //
    //--------------------------------------------------------------------------------------------------------
    public function deleteElement(Array $array, $object) : Array
    {
        if( ! is_array($object) )
        {
            $object = [$object];
        }

        return array_diff($array, $object);
    }

    //--------------------------------------------------------------------------------------------------------
    // Add First
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    // @param mixed $element
    //
    //--------------------------------------------------------------------------------------------------------
    public function addFirst(Array $array, $element, $type = 'array_unshift') : Array
    {
        if( ! is_array($element) )
        {
            $type($array, $element);
        }
        else
        {
            if( $type === 'array_unshift' )
            {
                $array = array_merge($element, $array);
            }
            else
            {
                $array = array_merge($array, $element);
            }
        }

        return $array;
    }

    //--------------------------------------------------------------------------------------------------------
    // Add Last
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    // @param mixed $element
    //
    //--------------------------------------------------------------------------------------------------------
    public function addLast(Array $array, $element) : Array
    {
        return $this->addFirst($array, $element, 'array_push');
    }

    //--------------------------------------------------------------------------------------------------------
    // Multikey
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    // @param string $keySplit:|
    //
    //--------------------------------------------------------------------------------------------------------
    public function multikey(Array $array, String $keySplit = '|') : Array
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

    //--------------------------------------------------------------------------------------------------------
    // Keyval
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    // @param string $keyval: val/value, key, vals/values, keys
    //
    //--------------------------------------------------------------------------------------------------------
    public function keyval(Array $array, String $keyval = 'value')
    {
        switch( $keyval )
        {
            case 'value'  : return current($array);
            case 'key'    : return key($array);
            case 'values' : return array_values($array);
            case 'keys'   : return array_keys($array);
            default       : throw new InvalidArgumentException
            (
                '[Arrays::keyval()], 2.($keyval) parameter is invalid! [Available Options:] value, key, values, keys'
            );
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Get Last
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    // @param numeric $count
    // @param bool    $preserveKey
    //
    //--------------------------------------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------------
    // Get First
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    // @param numeric $count
    // @param bool    $preserveKey
    //
    //--------------------------------------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------------
    // Order
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    // @param string $type :desc, asc...
    // @param string $flags:regular
    //
    //--------------------------------------------------------------------------------------------------------
    public function order(Array $array, String $type = NULL, String $flags = 'regular') : Array
    {
        $flags = Converter::toConstant($flags, 'SORT_');

        switch($type)
        {
            case 'desc'         : arsort($array, $flags);   break;
            case 'asc'          : asort($array, $flags);    break;
            case 'asckey'       : ksort($array, $flags);    break;
            case 'desckey'      : krsort($array, $flags);   break;
            case 'insens'       : natcasesort($array);      break;
            case 'natural'      : natsort($array);          break;
            case 'reverse'      : rsort($array, $flags);    break;
            case 'userassoc'    : uasort($array, $flags);   break;
            case 'userkey'      : uksort($array, $flags);   break;
            case 'user'         : usort($array, $flags);    break;
            case 'random'       : shuffle($array);          break;
            default             : sort($array, $flags);
        }

        return $array;
    }

    //--------------------------------------------------------------------------------------------------------
    // Object Data
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    //
    //--------------------------------------------------------------------------------------------------------
    public function objectData(Array $data) : String
    {
        return json_encode($data);
    }

    //--------------------------------------------------------------------------------------------------------
    // Length
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    //
    //--------------------------------------------------------------------------------------------------------
    public function length(Array $data) : Int
    {
        return count($data);
    }

    //--------------------------------------------------------------------------------------------------------
    // Apportion
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    // @param numeric $portionCount
    // @param bool    $preserveKeys
    //
    //--------------------------------------------------------------------------------------------------------
    public function apportion(Array $data, Int $portionCount = 1, Bool $preserveKeys = false) : Array
    {
        return array_chunk($data, $portionCount, $preserveKeys);
    }

    //--------------------------------------------------------------------------------------------------------
    // Combine
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $keys
    // @param array $values
    //
    //--------------------------------------------------------------------------------------------------------
    public function combine(Array $keys, Array $values) : Array
    {
        return array_combine($keys, $values);
    }

    //--------------------------------------------------------------------------------------------------------
    // Count Same Values
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    // @param mixed $key
    //
    //--------------------------------------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------------
    // Flip
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    //
    //--------------------------------------------------------------------------------------------------------
    public function flip(Array $array) : Array
    {
        return array_flip($array);
    }

    //--------------------------------------------------------------------------------------------------------
    // Transform
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    //
    //--------------------------------------------------------------------------------------------------------
    public function transform(Array $array) : Array
    {
        return $this->flip($array);
    }

    //--------------------------------------------------------------------------------------------------------
    // Implement Callback(Map)
    //--------------------------------------------------------------------------------------------------------
    //
    // @param ...args
    //
    //--------------------------------------------------------------------------------------------------------
    public function implementCallback(...$args) : Array
    {
        return $this->map(...$args);
    }

    //--------------------------------------------------------------------------------------------------------
    // Map
    //--------------------------------------------------------------------------------------------------------
    //
    // @param ...args
    //
    //--------------------------------------------------------------------------------------------------------
    public function map(...$args) : Array
    {
        return array_map(...$args);
    }

    //--------------------------------------------------------------------------------------------------------
    // Recursive Merge
    //--------------------------------------------------------------------------------------------------------
    //
    // @param ...args
    //
    //--------------------------------------------------------------------------------------------------------
    public function recursiveMerge(...$args) : Array
    {
        return array_merge_recursive(...$args);
    }

    //--------------------------------------------------------------------------------------------------------
    // Merge
    //--------------------------------------------------------------------------------------------------------
    //
    // @param ...args
    //
    //--------------------------------------------------------------------------------------------------------
    public function merge(...$args) : Array
    {
        return array_merge(...$args);
    }

    //--------------------------------------------------------------------------------------------------------
    // Intersect
    //--------------------------------------------------------------------------------------------------------
    //
    // @param ...args
    //
    //--------------------------------------------------------------------------------------------------------
    public function intersect(...$args) : Array
    {
        return array_intersect(...$args);
    }

    //--------------------------------------------------------------------------------------------------------
    // Reverse
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    // @param bool    $preserveKeys
    //
    //--------------------------------------------------------------------------------------------------------
    public function reverse(Array $array, Bool $preserveKeys = false) : Array
    {
        return array_reverse($array, $preserveKeys);
    }

    //--------------------------------------------------------------------------------------------------------
    // Product
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    //
    //--------------------------------------------------------------------------------------------------------
    public function product(Array $array) : Float
    {
        return array_product($array);
    }

    //--------------------------------------------------------------------------------------------------------
    // Sum
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    //
    //--------------------------------------------------------------------------------------------------------
    public function sum(Array $array) : Float
    {
        return array_sum($array);
    }

    //--------------------------------------------------------------------------------------------------------
    // Random
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    // @param numeric $countRequest
    //
    //--------------------------------------------------------------------------------------------------------
    public function random(Array $array, Int $countRequest = 1)
    {
        return array_rand($array, $countRequest);
    }

    //--------------------------------------------------------------------------------------------------------
    // Search
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    // @param mixed $element
    // @param bool  $strict
    //
    //--------------------------------------------------------------------------------------------------------
    public function search(Array $array, $element, Bool $strict = false)
    {
        return array_search($element, $array, $strict);
    }

    //--------------------------------------------------------------------------------------------------------
    // Value Exists
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    // @param mixed $element
    // @param bool  $strict
    //
    //--------------------------------------------------------------------------------------------------------
    public function valueExists(Array $array, $element, Bool $strict = false) : Bool
    {
        return in_array($element, $array, $strict);
    }

    //--------------------------------------------------------------------------------------------------------
    // Key Exists
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    // @param mixed $key
    //
    //--------------------------------------------------------------------------------------------------------
    public function keyExists(Array $array, $key) : Bool
    {
        return array_key_exists($key, $array);
    }

    //--------------------------------------------------------------------------------------------------------
    // Section
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    // @param numeric $start
    // @param numeric $length
    // @param bool    $preserveKey
    //
    //--------------------------------------------------------------------------------------------------------
    public function section(Array $array, Int $start = 0, Int $length = NULL, Bool $preserveKeys = false) : Array
    {
        return array_slice($array, $start, $length, $preserveKeys);
    }

    //--------------------------------------------------------------------------------------------------------
    // Resection
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    // @param numeric $start
    // @param numeric $length
    // @param mixed   $newElement
    //
    //--------------------------------------------------------------------------------------------------------
    public function resection(Array $array, Int $start = 0, Int $length = NULL, $newElement = NULL) : Array
    {
        array_splice($array, $start, $length, $newElement);

        return $array;
    }

    //--------------------------------------------------------------------------------------------------------
    // Delete Recurrent
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    // @param string $flags
    //
    //--------------------------------------------------------------------------------------------------------
    public function deleteRecurrent(Array $array, String $flags = 'string') : Array
    {
        return array_unique($array, Converter::toConstant($flags, 'SORT_'));
    }

    //--------------------------------------------------------------------------------------------------------
    // Series
    //--------------------------------------------------------------------------------------------------------
    //
    // @param numeric $start
    // @param numeric $end
    // @param numeric $count
    //
    //--------------------------------------------------------------------------------------------------------
    public function series(Int $start, Int $end, Int $step = 1) : Array
    {
        return range($start, $end, $step);
    }

    //--------------------------------------------------------------------------------------------------------
    // Column
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    // @param mixed   $columnKey
    // @param mixed   $indexKey
    //
    //--------------------------------------------------------------------------------------------------------
    public function column(Array $array, $columnKey = 0, $indexKey = NULL) : Array
    {
        return array_column($array, $columnKey, $indexKey);
    }

    //--------------------------------------------------------------------------------------------------------
    // excluding
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    // @param array   $excluding
    //
    //--------------------------------------------------------------------------------------------------------
    public function excluding(Array $array, Array $excluding) : Array
    {
        $newArray = [];

        if( count($excluding) > count($array) )
        {
            throw new LogicException
            (
                'DataTypes',
                'array:notExceedLength',
                ['%' => '2.($excluding)', '#' => '1.($array)']
            );
        }

        foreach( $array as $key => $val )
        {
            if( ! in_array($val, $excluding) && ! in_array($key, $excluding) )
            {
                $newArray[$key] = $val;
            }
        }

        return $newArray;
    }

    //--------------------------------------------------------------------------------------------------------
    // including
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    // @param array   $excluding
    //
    //--------------------------------------------------------------------------------------------------------
    public function including(Array $array, Array $including) : Array
    {
        $newArray = [];

        if( count($including) > count($array) )
        {
            throw new LogicException
            (
                'DataTypes',
                'array:notExceedLength',
                ['%' => '2.($including)', '#' => '1.($array)']
            );
        }

        foreach( $array as $key => $val )
        {
            if( in_array($val, $including) || in_array($key, $including) )
            {
                $newArray[$key] = $val;
            }
        }

        return $newArray;
    }

    //--------------------------------------------------------------------------------------------------------
    // each
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array    $array
    // @param callable $callable
    //
    //--------------------------------------------------------------------------------------------------------
    public function each(Array $array, $callable)
    {
        if( ! is_callable($callable) )
        {
            throw new InvalidArgumentException('Error', 'callableParameter', '2.($callable)');
        }

        foreach( $array as $k => $v )
        {
            $callable($v, $k);
        }
    }
}
