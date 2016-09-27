<?php namespace ZN\CryptoGraphy;

class EncodeUnitTest extends \UnitTestController
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    const unit =
    [
        'class'   => 'Encode',
        'methods' =>
        [
            'create' => [6, 'all'],
            'golden' => ['string', 'default'],
            'super'  => ['string'],
            'type'   => ['string', 'md5'],
            'data'   => ['string', 'md5']
        ]
    ];
}
