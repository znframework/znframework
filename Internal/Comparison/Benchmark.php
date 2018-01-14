<?php namespace ZN\Comparison;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Controller\Factory;

class Benchmark extends Factory
{
    const factory =
    [
        'methods' =>
        [
            'run'              => 'Run::test',
            'result'           => 'Run::result',
            'start'            => 'Testing::start',
            'end'              => 'Testing::end',
            'elapsedtime'      => 'ElapsedTime::calculate',
            'usedfiles'        => 'FileUsage::list',
            'usedfilecount'    => 'FileUsage::count',
            'calculatedmemory' => 'MemoryUsage::calculate',
            'memoryusage'      => 'MemoryUsage::normal',
            'maxmemoryusage'   => 'MemoryUsage::maximum'
        ]
    ];
}
