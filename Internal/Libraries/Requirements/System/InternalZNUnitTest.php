<?php namespace ZN\Requirements\System;

use Benchmark;

class InternalZNUnitTest
{
    protected $class;
    protected $methods;
    protected $result;
    protected $totalElasedTime;
    protected $totalMemoryUsage;
    protected $totalFileCount;

    public function class(String $class) : InternalZNUnitTest
    {
        $this->class = $class;

        return $this;
    }

    public function methods(Array $methods) : InternalZNUnitTest
    {
        $this->methods = $methods;

        return $this;
    }

    public function start()
    {
        $this->result = NULL;

        foreach( $this->methods as $method => $parameters )
        {
            $method = explode(':', $method)[0];

            Benchmark::start($method);
            uselib($this->class)->$method(...$parameters);
            Benchmark::end($method);

            $this->_output($this->class, $method);
        }

        $this->_outputBottom();
    }

    public function result()
    {
        return '<pre>'.$this->result.'</pre>';
    }

    protected function _output($class, $method)
    {
        $elapsedTime      = Benchmark::elapsedTime($method);
        $calculatedMemory = Benchmark::calculatedMemory($method);
        $usedFileCount    = Benchmark::usedFileCount($method);

        $this->totalElasedTime  += $elapsedTime;
        $this->totalMemoryUsage += $calculatedMemory;
        $this->totalFileCount   += $usedFileCount;

        $this->result .= '---------------------------------------------------<br>';
        $this->result .= $class.'::'.$method.'<br>';
        $this->result .= '---------------------------------------------------<br>';
        $this->result .= 'Syntax Check : OK<br>';
        $this->result .= 'Elapsed Time : '.$elapsedTime.' SECONDS<br>';
        $this->result .= '---------------------------------------------------<br><br>';
    }

    protected function _outputBottom()
    {
        $this->result .= '---------------------------------------------------<br>';
        $this->result .= 'TOTAL<br>';
        $this->result .= '---------------------------------------------------<br>';
        $this->result .= 'Syntax Check : OK<br>';
        $this->result .= 'Elapsed Time : '.$this->totalElasedTime.' SECONDS<br>';
        $this->result .= 'Memory Usage : '.$this->totalMemoryUsage.' BYTES<br>';
        $this->result .= 'File Count   : '.$this->totalFileCount.'<br>';
        $this->result .= '---------------------------------------------------';

        $this->_defaultVariables();
    }

    protected function _defaultVariables()
    {
        $this->totalElasedTime  = NULL;
        $this->totalMemoryUsage = NULL;
        $this->totalFileCount   = NULL;
    }
}
