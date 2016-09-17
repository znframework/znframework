<?php namespace ZN\DataTypes;

class InternalSeparator extends \FactoryController implements InternalSeparatorInterface
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
            'decodeobject' => 'Separator\Decode::object',
            'decodearray'  => 'Separator\Decode::array'
        ]
    ];
}
