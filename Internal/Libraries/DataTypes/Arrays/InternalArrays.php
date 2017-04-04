<?php namespace ZN\DataTypes;

use Converter, Json;

class InternalArrays extends \FactoryController implements InternalArraysInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    const factory =
    [
        'methods' =>
        [
            'casing'                => 'Arrays\Casing::use',
            'lowercase'             => 'Arrays\Casing::lower',
            'uppercase'             => 'Arrays\Casing::upper',
            'titlecase'             => 'Arrays\Casing::title',
            'lowerkeys'             => 'Arrays\Casing::lowerKeys',
            'upperkeys'             => 'Arrays\Casing::upperKeys',
            'titlekeys'             => 'Arrays\Casing::titleKeys',
            'lowervalues'           => 'Arrays\Casing::lowerValues',
            'uppervalues'           => 'Arrays\Casing::upperValues',
            'titlevalues'           => 'Arrays\Casing::titleValues',
            'getfirst'              => 'Arrays\GetElement::first',
            'getlast'               => 'Arrays\GetElement::last',
            'addfirst'              => 'Arrays\AddElement::first',
            'addlast'               => 'Arrays\AddElement::last',
            'removekey'             => 'Arrays\RemoveElement::key',
            'removevalue'           => 'Arrays\RemoveElement::value',
            'remove'                => 'Arrays\RemoveElement::use',
            'removelast'            => 'Arrays\RemoveElement::last',
            'removefirst'           => 'Arrays\RemoveElement::first',
            'deleteelement'         => 'Arrays\RemoveElement::element',
            'order'                 => 'Arrays\Sort::order',
            'sort'                  => 'Arrays\Sort::normal',
            'descending'            => 'Arrays\Sort::descending',
            'ascending'             => 'Arrays\Sort::ascending',
            'ascendingkey'          => 'Arrays\Sort::ascendingKey',
            'descendingkey'         => 'Arrays\Sort::descendingKey',
            'userassocsort'         => 'Arrays\Sort::userAssoc',
            'userkeysort'           => 'Arrays\Sort::userKey',
            'usersort'              => 'Arrays\Sort::user',
            'insensitivesort'       => 'Arrays\Sort::insensitive',
            'naturalsort'           => 'Arrays\Sort::natural',
            'shuffle'               => 'Arrays\Sort::shuffle',
            'including'             => 'Arrays\Including::use',
            'include'               => 'Arrays\Including::use',
            'excluding'             => 'Arrays\Excluding::use',
            'exclude'               => 'Arrays\Excluding::use',
            'each'                  => 'Arrays\Each::use',
            'multikey'              => 'Arrays\MultipleKey::use',
            'keyval'                => 'Arrays\KeyValue::use',
            'key'                   => 'Arrays\KeyValue::key',
            'value'                 => 'Arrays\KeyValue::value',
            'keys'                  => 'Arrays\KeyValue::keys',
            'values'                => 'Arrays\KeyValue::values',
        ]
    ];

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
            return $return[$key] ?? false;
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
    // Intersect Key
    //--------------------------------------------------------------------------------------------------------
    //
    // @param ...args
    //
    //--------------------------------------------------------------------------------------------------------
    public function intersectKey(...$args) : Array
    {
        return array_intersect_key(...$args);
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
    // Value Exists Insenstive
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    // @param mixed $element
    // @param bool  $insenstive
    //
    //--------------------------------------------------------------------------------------------------------
    public function valueExistsInsensitive(Array $array, $element, Bool $strict = false) : Bool
    {
        return $this->valueExists($this->map('strtolower', $array), strtolower($element), $strict);
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
