<?php namespace ZN\Services;

class URIUnitTest extends \UnitTestController
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
        'class'   => 'URI',
        'methods' => 
        [
            'manipulation'      => [['home', 'test' => '12', 'abc']],
            'buildQuery'        => [['home', 'test' => 12]],
            'get'               => ['home'],
            'get:2'             => [1],
            'getNameCount'      => ['home'],
            'getNameAll'        => ['home'],
            'getByIndex'        => [1],
            'getByName'         => ['home'],
            'segmentArray'      => [],
            'totalSegments'     => [],
            'segmentCount'      => [],
            'segment'           => [1],
            'currentSegment'    => [],
            'current'           => [],
            'current:2'         => [true],
            'active'            => [],
            'active:2'          => [true],
            'base'              => [],
            'base:2'            => ['test'],
            'prev'              => []
        ]   
    ];
}
