<?php namespace ZN\IndividualStructures;

class Buffer extends \FactoryController
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
            'file'     => 'Buffer\File::do',
            'func'     => 'Buffer\Callback::do',
            'function' => 'Buffer\Callback::do',
            'callback' => 'Buffer\Callback::do',
            'closure'  => 'Buffer\Callback::do',
            'code'     => 'Buffer\Callback::code',
            'insert'   => 'Buffer\Insert::do',
            'select'   => 'Buffer\Select::do',
            'delete'   => 'Buffer\Delete::do'
        ]
    ];
}
