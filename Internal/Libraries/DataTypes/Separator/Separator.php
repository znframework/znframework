<?php namespace ZN\DataTypes;

class InternalSeparator extends \FactoryController
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
            'encode'       => 'Separator\Encode::do',
            'decode'       => 'Separator\Decode::do',
            'decodeObject' => 'Separator\Decode::object',
            'decodeArray'  => 'Separator\Decode::array'
        ]
    ];
}
