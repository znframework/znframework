<?php namespace ZN\Helpers;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Singleton;
use ZN\Inclusion;
use ZN\Comparison;

class Tester
{
    /**
     * Keeps class name
     * 
     * @var string
     */
    protected $class;

    /**
     * Keeps methods
     * 
     * @var array
     */
    protected $methods;

    /**
     * Get result
     * 
     * @var string
     */
    protected $result;

    /**
     * Total elapsed time
     * 
     * @var float
     */
    protected $totalElasedTime;

    /**
     * Total memory usage
     * 
     * @var float
     */
    protected $totalMemoryUsage;

    /**
     * Total file count
     * 
     * @var int
     */
    protected $totalFileCount;

    /**
     * Get arguments
     * 
     * @var array
     */
    protected $arguments;

    /**
     * Defines class name.
     * 
     * @param string $class
     * 
     * @return Tester
     */
    public function class(String $class) : Tester
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Defines class methods.
     * 
     * @param array $methods
     * 
     * @return Tester
     */
    public function methods(Array $methods) : Tester
    {
        $this->arguments = debug_backtrace(0)[0]['args'][0];

        $this->methods = $methods;

        return $this;
    }

    /**
     * Start unit test
     * 
     * @param void
     * 
     * @return void
     */
    public function start()
    {
        $this->result = NULL;

        $index = 0;
        
        foreach( $this->methods as $method => $parameters )
        {
            $method = explode(':', $method)[0];

            Comparison\Testing::start($method);
            $returnValue = Singleton::class($this->class)->$method(...$parameters);
            Comparison\Testing::end($method);

            $this->_output($this->class, $method, gettype($returnValue), $returnValue);

            $index++;
        }

        $this->_outputBottom($index);
        $this->_startDefaultVariables();
    }

    /**
     * Show result
     * 
     * @param void
     * 
     * @return string
     */
    public function result()
    {
        return Inclusion\Template::use('UnitTests/Output', ['input' => $this->result]);
    }

    /**
     * Output
     * 
     * @param string $class
     * @param string $method
     * @param string $returnType
     * @param string $returnValue
     * 
     * @return void
     */
    protected function _output($class, $method, $returnType, $returnValue)
    {
        $elapsedTime      = Comparison\ElapsedTime::calculate($method);
        $calculatedMemory = Comparison\MemoryUsage::calculate($method);
        $usedFileCount    = Comparison\FileUsage::count($method);
        $returnType       = ucfirst($returnType);

        $this->totalElasedTime  += $elapsedTime;
        $this->totalMemoryUsage += $calculatedMemory;
        $this->totalFileCount   += $usedFileCount;

        $param = $this->arguments[$method];

        $param = array_map(function($data)
        {
            if( ! is_scalar($data) )
            {
                return gettype($data);
            }
            elseif( is_string($data) )
            {
                return "'" . $data . "'";
            }

            return $data;
        }, $param);

        $this->result .= Inclusion\Template::use('UnitTests/ResultTable', 
        [
            'class'       => $class,
            'method'      => $method . '(' . implode(', ', $param) . ')',
            'returnType'  => $returnType,
            'returnValue' => is_scalar($returnValue) ? $returnValue : $returnType,
            'elapsedTime' => $elapsedTime,
            'index'       => str_replace('\\', '-', $class) . '-' . $method
        ], true);
    }

    /**
     * protected output table bottom
     * 
     * @param int $index
     * 
     * @return void
     */
    protected function _outputBottom($index)
    {
        $this->result .= Inclusion\Template::use('UnitTests/TotalTable', 
        [

            'elapsedTime'    => $this->totalElasedTime,
            'memoryUsage'    => $this->totalMemoryUsage,
            'totalFileCount' => $this->totalFileCount,
            'index'          => $index
        ], true);

        $this->_defaultVariables();
    }

    /**
     * Default variables
     * 
     * @param void
     * 
     * @return void
     */
    protected function _defaultVariables()
    {
        $this->totalElasedTime  = NULL;
        $this->totalMemoryUsage = NULL;
        $this->totalFileCount   = NULL;
    }

    /**
     * Default start variables
     * 
     * @param void
     * 
     * @return void
     */
    protected function _startDefaultVariables()
    {
        $this->class   = NULL;
        $this->methods = [];
    }
}
