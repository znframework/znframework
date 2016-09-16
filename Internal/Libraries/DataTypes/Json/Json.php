<?php namespace ZN\DataTypes;

class InternalJson extends \FactoryController
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
            'encode'       => 'Json\Encode::do',
            'decode'       => 'Json\Decode::do',
            'decodeObject' => 'Json\Decode::object',
            'decodeArray'  => 'Json\Decode::array',
            'error'        => 'Json\ErrorInfo::message',
            'errval'       => 'Json\ErrorInfo::message',
            'errno'        => 'Json\ErrorInfo::no',
        ]
    ];
}
