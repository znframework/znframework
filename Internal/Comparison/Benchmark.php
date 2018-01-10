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

use ZN\Controllers\FactoryController;

class Benchmark extends FactoryController
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
