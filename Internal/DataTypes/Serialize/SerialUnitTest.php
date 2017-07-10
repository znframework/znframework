<?php namespace ZN\DataTypes;

class SerialUnitTest extends \UnitTestController
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
        'class'   => 'Serial',
        'methods' =>
        [
            'encode' => [['p1' => 'p2']],
            'decode' => ['a:1:{s:2:"p1";s:2:"p2";}']
        ]
    ];
}
