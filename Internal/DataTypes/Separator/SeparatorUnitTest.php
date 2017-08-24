<?php namespace ZN\DataTypes;

class SeparatorUnitTest extends \UnitTestController
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
        'class'   => 'Separator',
        'methods' =>
        [
            'encode' => [['p1' => 'p2']],
            'decode' => ['p1']
        ]
    ];
}
