<?php namespace ZN\CryptoGraphy;

class InternalEncode extends \FactoryController implements InternalEncodeInterface
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
            'create' => 'Encode\RandomPassword::create',
            'golden' => 'Encode\GoldenAlgorithm::create',
            'super'  => 'Encode\SuperAlgorithm::create',
            'type'   => 'Encode\Type::create',
            'data'   => 'Encode\Type::create'
        ]
    ];
}
