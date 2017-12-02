<?php namespace ZN\ViewObjects;

class ValidationUnitTest extends \UnitTestController
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
        'class'   => 'Validation',
        'methods' => 
        [
            'rules'         => ['name', ['required'], 'Name'],
            'check'         => [NULL],
            'error'         => ['string'],
            'postBack'      => ['p1', 'post']
        ]
    ];
}
