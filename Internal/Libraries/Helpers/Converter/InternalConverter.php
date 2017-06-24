<?php namespace ZN\Helpers;

class InternalConverter extends \FactoryController
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
            'byte'       => 'Converter\Numeric::byte',
            'money'      => 'Converter\Numeric::money',
            'time'       => 'Converter\Numeric::time',
            'word'       => 'Converter\Text::word',
            'anchor'     => 'Converter\Text::anchor',
            'highlight'  => 'Converter\Text::highLight',
            'char'       => 'Converter\Unicode::char',
            'accent'     => 'Converter\Unicode::accent',
            'urlword'    => 'Converter\Unicode::urlWord',
            'slug'       => 'Converter\Unicode::slug',
            'charset'    => 'Converter\Unicode::charset',
            'toint'      => 'Converter\VariableTypes::toInt',
            'tointeger'  => 'Converter\VariableTypes::toInteger',
            'tobool'     => 'Converter\VariableTypes::toBool',
            'toboolean'  => 'Converter\VariableTypes::toBoolean',
            'tostring'   => 'Converter\VariableTypes::toString',
            'tofloat'    => 'Converter\VariableTypes::toFloat',
            'toreal'     => 'Converter\VariableTypes::toReal',
            'todouble'   => 'Converter\VariableTypes::toDouble',
            'toobject'   => 'Converter\VariableTypes::toObject',
            'toobjectrecursive' => 'Converter\VariableTypes::toObjectRecursive',
            'toarray'    => 'Converter\VariableTypes::toArray',
            'toconstant' => 'Converter\VariableTypes::toConstant',
        ]
    ];
}
