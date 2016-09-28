<?php namespace ZN\IndividualStructures;

class InternalBenchmark extends \FactoryController implements InternalBenchmarkInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

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
