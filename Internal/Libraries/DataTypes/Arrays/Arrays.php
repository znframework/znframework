<?php namespace ZN\DataTypes;

use Converter, Json;

class InternalArrays implements ArraysInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    const factory =
    [
        'class'   => 'ZN\DataTypes\ArrayFactory',
        'methods' =>
        [
            'casing'                => 'ArrayCase',
            'lowercase'             => 'ArrayCase',
            'uppercase'             => 'ArrayCase',
            'titlecase'             => 'ArrayCase',
            'lowerkeys'             => 'ArrayCase',
            'upperkeys'             => 'ArrayCase',
            'titlekeys'             => 'ArrayCase',
            'lowervalues'           => 'ArrayCase',
            'uppervalues'           => 'ArrayCase',
            'titlevalues'           => 'ArrayCase',
            'getfirst'              => 'GetElement',
            'getlast'               => 'GetElement',
            'addfirst'              => 'AddElement',
            'addlast'               => 'AddElement',
            'removekey'             => 'RemoveElement',
            'removevalue'           => 'RemoveElement',
            'remove'                => 'RemoveElement',
            'removelast'            => 'RemoveElement',
            'removefirst'           => 'RemoveElement',
            'deleteelement'         => 'RemoveElement',
            'order'                 => 'ArraySort',
            'sort'                  => 'ArraySort',
            'descending'            => 'ArraySort',
            'ascending'             => 'ArraySort',
            'ascendingkey'          => 'ArraySort',
            'descendingkey'         => 'ArraySort',
            'userassocsort'         => 'ArraySort',
            'userkeysort'           => 'ArraySort',
            'usersort'              => 'ArraySort',
            'insensitivesort'       => 'ArraySort',
            'naturalsort'           => 'ArraySort',
            'shuffle'               => 'ArraySort',
            'including'             => 'ArrayInclude',
            'include'               => 'ArrayInclude',
            'excluding'             => 'ArrayExclude',
            'exclude'               => 'ArrayExclude',
            'each'                  => 'ArrayEach',
            'multikey'              => 'MultipleKey',
            'keyval'                => 'ArrayKeyValue',
            'key'                   => 'ArrayKeyValue',
            'value'                 => 'ArrayKeyValue',
            'keys'                  => 'ArrayKeyValue',
            'values'                => 'ArrayKeyValue',
        ]
    ];

    use \MagicFactoryAbility;

    //--------------------------------------------------------------------------------------------------------
    // Object Data
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    //
    //--------------------------------------------------------------------------------------------------------
    public function objectData(Array $data) : String
    {
        return Json::encode($data);
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
    public function countSameValues(Array $array, String $key = NULL)
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
}
