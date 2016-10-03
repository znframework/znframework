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
    public function objectData(array $data) : string
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
    public function length(array $data) : int
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
    public function apportion(array $data, int $portionCount = 1, bool $preserveKeys = false) : array
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
    public function combine(array $keys, array $values) : array
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
    public function countSameValues(array $array, string $key = NULL)
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
    public function flip(array $array) : array
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
    public function transform(array $array) : array
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
    public function implementCallback(...$args) : array
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
    public function map(...$args) : array
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
    public function recursiveMerge(...$args) : array
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
    public function merge(...$args) : array
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
    public function intersect(...$args) : array
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
    public function reverse(array $array, bool $preserveKeys = false) : array
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
    public function product(array $array) : float
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
    public function sum(array $array) : float
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
    public function random(array $array, int $countRequest = 1)
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
    public function search(array $array, $element, bool $strict = false)
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
    public function valueExists(array $array, $element, bool $strict = false) : bool
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
    public function keyExists(array $array, $key) : bool
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
    public function section(array $array, int $start = 0, int $length = NULL, bool $preserveKeys = false) : array
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
    public function resection(array $array, int $start = 0, int $length = NULL, $newElement = NULL) : array
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
    public function deleteRecurrent(array $array, string $flags = 'string') : array
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
    public function series(int $start, int $end, int $step = 1) : array
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
    public function column(array $array, $columnKey = 0, $indexKey = NULL) : array
    {
        return array_column($array, $columnKey, $indexKey);
    }
}
