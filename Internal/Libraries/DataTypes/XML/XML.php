<?php namespace ZN\DataTypes;

class InternalXML extends \FactoryController
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
        'methods' =>
        [
            'version'     => 'XML\Builder::version:this',
            'encoding'    => 'XML\Builder::encoding:this',
            'build'       => 'XML\Builder::do',
            'save'        => 'XML\Save::do',
            'load'        => 'XML\Loader::do',
            'parse'       => 'XML\Parser::do',
            'parseArray'  => 'XML\Parser::array',
            'parseJson'   => 'XML\Parser::json',
            'parseObject' => 'XML\Parser::object',
        ]
    ];
}
