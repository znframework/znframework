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
        Testing::start('run');
        $test();
        Testing::end('run');

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
            'elapsedTime'      => ElapsedTime::calculate('run'),
            'calculatedMemory' => MemoryUsage::calculate('run'),
            'usedFileCount'    => FileUsage::count('run'),
            'usedFiles'        => FileUsage::list('run')
        ];
    }
}
