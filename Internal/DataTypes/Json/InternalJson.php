<?php namespace ZN\DataTypes;

class InternalJson extends \FactoryController
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
            'encode'       => 'Json\Encode::do',
            'decode'       => 'Json\Decode::do',
            'decodeobject' => 'Json\Decode::object',
            'decodearray'  => 'Json\Decode::array',
            'error'        => 'Json\ErrorInfo::message',
            'errval'       => 'Json\ErrorInfo::message',
            'errno'        => 'Json\ErrorInfo::no',
            'check'        => 'Json\ErrorInfo::check'
        ]
    ];
}
