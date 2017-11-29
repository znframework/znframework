<?php namespace ZN\DataTypes;

class XML extends \FactoryController
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
            'version'     => 'XML\Builder::version:this',
            'encoding'    => 'XML\Builder::encoding:this',
            'build'       => 'XML\Builder::do',
            'save'        => 'XML\Save::do',
            'load'        => 'XML\Loader::do',
            'parse'       => 'XML\Parser::do',
            'parsearray'  => 'XML\Parser::array',
            'parsejson'   => 'XML\Parser::json',
            'parseobject' => 'XML\Parser::object',
            'parsesimple' => 'XML\Parser::simple',
            'check'       => 'XML\Check::check',
        ]
    ];
}
