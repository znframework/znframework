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

use stdClass;
use ZN\Classes;
use ZN\DataTypes\Arrays;

class Debugger
{
    /**
     * Keeps Debug Data
     * 
     * @var array
     */
    protected $debug;

    /**
     * Magic Constructor
     */
    public function __construct()
    {
        $debug = debug_backtrace();

        $this->debug = Arrays\RemoveElement::first($debug, 3);
    }

    /**
     * Current Debug Data
     * 
     * @return object
     */
    public function current() : stdClass
    {
        return $this->_layer($this->debug, 0, 1);
    }

    /**
     * Parent Debug Data
     * 
     * @param int $index = 1
     * 
     * @return object
     */
    public function parent(Int $index = 1) : stdClass
    {
        return $this->_layer($this->debug, $index, $index + 1);
    }

    /**
     * Output Debug
     * 
     * @param mixed $type = 'array' - options[array|string|int value]
     * 
     * @return mixed
     */
    public function output($type = 'array')
    {
        $debug = Arrays\RemoveElement::first($this->debug, 2);
        $debug = array_merge([(array) $this->current()], $debug);

        if( is_numeric($type) )
        {
            return (object) ( $debug[$type] ?? $this->_default() );
        }
        elseif( $type === 'array' )
        {
            return $debug;
        }
        elseif( $type === 'string' )
        {
            return output($debug, [], true);
        }
        else
        {
            return $this->_default();
        }
    }

    /**
     * Protected Layer
     */
    protected function _layer($debug, $layer1 = 0, $layer2 = 1)
    {
        $file           = $debug[$layer1]['file']     ?? NULL;
        $line           = $debug[$layer1]['line']     ?? NULL;
        $function       = $debug[$layer2]['function'] ?? NULL;
        $class          = $debug[$layer2]['class']    ?? NULL;
        $args           = $debug[$layer2]['args']     ?? NULL;
        $type           = $debug[$layer1]['type']     ?? NULL;
        $type           = str_replace('->', '::', $type);
        $classSuffix    = $type.$function.'()';
        $method         = $class.$classSuffix;
        $internalMethod = Classes::onlyName((string) $class).$classSuffix;

        return (object)
        [
            'file'           => $file,
            'line'           => $line,
            'args'           => $args,
            'function'       => $function,
            'class'          => $class,
            'type'           => $type,
            'method'         => $method,
            'internalMethod' => $internalMethod
        ];
    }

    /**
     * Protected Default
     */
    protected function _default()
    {
        return (object)
        [
            'file'           => NULL,
            'line'           => NULL,
            'function'       => NULL,
            'class'          => NULL,
            'type'           => NULL,
            'method'         => NULL,
            'internalMethod' => NULL
        ];
    }
}
