<?php namespace ZN\IndividualStructures\Benchmark;

class Run
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Test
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $test
    // @return Run
    //
    //--------------------------------------------------------------------------------------------------------
    public function test(Callable $test) : Run
    {
        \Benchmark::start('run');
        $test();
        \Benchmark::end('run');

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Result
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return stdClass
    //
    //--------------------------------------------------------------------------------------------------------
    public function result() : \stdClass
    {
        return (object)
        [
            'elapsedTime'      => \Benchmark::elapsedTime('run'),
            'calculatedMemory' => \Benchmark::calculatedMemory('run'),
            'usedFileCount'    => \Benchmark::usedFileCount('run'),
            'usedFiles'        => \Benchmark::usedFiles('run')
        ];
    }
}
