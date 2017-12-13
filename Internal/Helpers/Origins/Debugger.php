<?php namespace ZN\Helpers;

use ZN\DataTypes\Arrays;

class Debugger
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
    // Debug
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $debug;

    //--------------------------------------------------------------------------------------------------------
    // Construct
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return void
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct()
    {
        $debug = debug_backtrace(2);

        $this->debug = Arrays\RemoveElement::first($debug, 3);
    }

    //--------------------------------------------------------------------------------------------------------
    // Current
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return stdClass
    //
    //--------------------------------------------------------------------------------------------------------
    public function current() : \stdClass
    {
        return $this->_layer($this->debug, 0, 1);
    }

    //--------------------------------------------------------------------------------------------------------
    // Internal
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return stdClass
    //
    //--------------------------------------------------------------------------------------------------------
    public function next() : \stdClass
    {
        $internal = $this->_layer($this->output(), 2, 3);

        if( $internal->class === NULL )
        {
            return $this->_layer($this->debug, 1, 1);
        }

        return $internal;
    }

    //--------------------------------------------------------------------------------------------------------
    // Current
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  mixed $type = 'array', Options: array, string and numeric value
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------------
    // Current
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return stdClass
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _layer($debug, $layer1 = 0, $layer2 = 1)
    {
        $file           = $debug[$layer1]['file']     ?? NULL;
        $line           = $debug[$layer1]['line']     ?? NULL;
        $function       = $debug[$layer2]['function'] ?? NULL;
        $class          = $debug[$layer2]['class']    ?? NULL;
        $type           = $debug[$layer1]['type']     ?? NULL;
        $type           = str_replace('->', '::', $type);
        $classSuffix    = $type.$function.'()';
        $method         = $class.$classSuffix;
        $internalMethod = \Classes::onlyName((string) $class).$classSuffix;

        return (object)
        [
            'file'           => $file,
            'line'           => $line,
            'function'       => $function,
            'class'          => $class,
            'type'           => $type,
            'method'         => $method,
            'internalMethod' => $internalMethod
        ];
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Default
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return array
    //
    //--------------------------------------------------------------------------------------------------------
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
