<?php namespace ZN\DataTypes;

class Arrays extends \FactoryController
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
            'keyval'                => 'Arrays\Element::use',
            'key'                   => 'Arrays\Element::key',
            'value'                 => 'Arrays\Element::value',
            'keys'                  => 'Arrays\Element::keys',
            'values'                => 'Arrays\Element::values',
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
            'random'                => 'Arrays\Random::do',
            'rand'                  => 'Arrays\Random::do',
            'search'                => 'Arrays\Search::do',
            'section'               => 'Arrays\Section::do',
            'slice'                 => 'Arrays\Section::do',
            'resection'             => 'Arrays\Section::resection',
            'splice'                => 'Arrays\Section::resection',
            'deleterecurrent'       => 'Arrays\Unique::do',
            'unique'                => 'Arrays\Unique::do',
            'series'                => 'Arrays\Series::do',
            'range'                 => 'Arrays\Series::do',
            'column'                => 'Arrays\Column::do',
        ]
    ];
}
