<?php namespace ZN\DataTypes;

use Converter;

class InternalArrays extends \FactoryController
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
            'reverse'               => 'Arrays\Sort::reverse',
            'including'             => 'Arrays\Including::use',
            'include'               => 'Arrays\Including::use',
            'excluding'             => 'Arrays\Excluding::use',
            'exclude'               => 'Arrays\Excluding::use',
            'each'                  => 'Arrays\Each::use',
            'force'                 => 'Arrays\Force::do',
            'forcevalues'           => 'Arrays\Force::values',
            'forcekeys'             => 'Arrays\Force::keys',
            'multikey'              => 'Arrays\MultipleKey::use',
            'keyval'                => 'Arrays\KeyValue::use',
            'key'                   => 'Arrays\KeyValue::key',
            'value'                 => 'Arrays\KeyValue::value',
            'keys'                  => 'Arrays\KeyValue::keys',
            'values'                => 'Arrays\KeyValue::values',
            'unidimensional'        => 'Arrays\Unidimensional::do',
            'flatten'               => 'Arrays\Unidimensional::do',
            'objectdata'            => 'Arrays\Convert::objectData',
            'toJson'                => 'Arrays\Convert::json',
            'flip'                  => 'Arrays\Transform::flip',
            'transform'             => 'Arrays\Transform::flip',
            'length'                => 'Arrays\Length::get',
            'countsamevalues'       => 'Arrays\Length::sameValues',
            'lengthsamevalues'      => 'Arrays\Length::sameValues',
            'valueexists'           => 'Arrays\Exists::value',
            'valueexistsinsensitive'=> 'Arrays\Exists::valueInsensitive',
            'keyexists'             => 'Arrays\Exists::key',
            'keyexistsinsensitive'  => 'Arrays\Exists::keyInsensitive',
            'apportion'             => 'Arrays\Chunk::do',
            'chunk'                 => 'Arrays\Chunk::do',
            'combine'               => 'Arrays\Combine::do',
            'map'                   => 'Arrays\Map::do',
            'implementcallback'     => 'Arrays\Map::do',
            'merge'                 => 'Arrays\Merge::do',
            'recursivemerge'        => 'Arrays\Merge::recursive',
            'intersect'             => 'Arrays\Intersect::do',
            'intersectkey'          => 'Arrays\Intersect::key',
            'product'               => 'Arrays\Calculate::product',
            'sum'                   => 'Arrays\Calculate::sum',
        ]
    ];

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
