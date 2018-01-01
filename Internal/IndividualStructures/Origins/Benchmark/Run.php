<?php namespace ZN\IndividualStructures\Benchmark;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Run
{
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
