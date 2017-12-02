<?php namespace ZN\ViewObjects;

class HTMLUnitTest extends \UnitTestController
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
        'class'   => 'HTML',
        'methods' => 
        [
            'property'          => ['Example Property Value'],
            'exampleProperty'   => ['Other Example Property Value'],
            'image'             => ['example.jpg', 100, 200],
            #'ul'                => [function($ul){echo $ul->li(1);}, ['id' => '#id']]
            'form'              => [],
            'table'             => [],
            'list'              => [],
            'anchor'            => ['http://www.znframework.com', 'ZN Framework', ['id' => '#id']]
        ]
    ];
}
