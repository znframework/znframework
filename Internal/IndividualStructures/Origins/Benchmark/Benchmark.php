<?php namespace ZN\IndividualStructures;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Benchmark extends \FactoryController
{
    const factory =
    [
        'methods' =>
        [
            'run'              => 'Benchmark\Run::test',
            'result'           => 'Benchmark\Run::result',
            'start'            => 'Benchmark\Testing::start',
            'end'              => 'Benchmark\Testing::end',
            'elapsedtime'      => 'Benchmark\ElapsedTime::calculate',
            'usedfiles'        => 'Benchmark\FileUsage::list',
            'usedfilecount'    => 'Benchmark\FileUsage::count',
            'calculatedmemory' => 'Benchmark\MemoryUsage::calculate',
            'memoryusage'      => 'Benchmark\MemoryUsage::normal',
            'maxmemoryusage'   => 'Benchmark\MemoryUsage::maximum'
        ]
    ];
}
