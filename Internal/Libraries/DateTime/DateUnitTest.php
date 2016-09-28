<?php namespace ZN\DateTime;

class DateUnitTest extends \UnitTestController
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
        'class'   => 'Date',
        'methods' =>
        [
            'current'   => [],
            'standart'  => [],
            'convert'   => ['2015.30.03'],
            'compare'   => ['2015.30.03', '>', '2015.30.02'],
            'toNumeric' => ['2015.30.03'],
            'calculate' => ['2015.30.03', '-30 day'],
            'set'       => ['Y-m-d']
        ]
    ];
}
