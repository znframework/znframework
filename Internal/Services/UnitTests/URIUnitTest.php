<?php namespace ZN\Services;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class URIUnitTest extends \UnitTestController
{
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
