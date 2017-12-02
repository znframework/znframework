<?php namespace ZN\ViewObjects;

class ValidateUnitTest extends \UnitTestController
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
        'class'   => 'Validate',
        'methods' => 
        [
            'data'          => ['Example Data'],
            'numeric'       => [],
            'maxchar'       => [10],
            'minchar'       => [4],
            'get'           => [],
            'status'        => []
        ]
    ];
}
