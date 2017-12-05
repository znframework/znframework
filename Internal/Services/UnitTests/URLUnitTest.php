<?php namespace ZN\Services;

class URLUnitTest extends \UnitTestController
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
        'class'   => 'URL',
        'methods' => 
        [
            'base'           => [],
            'base:2'         => ['test'],
            'site'           => [],
            'site:2'         => ['test'],
            'sites'          => [],
            'current'        => [],
            'current:2'      => ['test'],
            'host'           => [],
            'host:2'         => ['test']
        ]
    ];
}
