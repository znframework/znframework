<?php namespace ZN\IndividualStructures;

use CallController, Classes;

class InternalSupport extends CallController implements InternalSupportInterface
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
    // Protected Loaded
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $value
    // @param string $func
    // @param string $error
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _loaded($name, $value, $func, $error)
    {
        if( empty($value) )
        {
            $value = ucfirst($name);
        }

        if( ! $func($name) )
        {
            if( is_string($error) )
            {
                die(\Errors::message('Error', $error, $value));
            }
            else
            {
                die(\Errors::message(key($error), current($error), $value));
            }
        }

        return false;
    }

    //--------------------------------------------------------------------------------------------------------
    // Func
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $name
    // @param  string  $value
    //
    //--------------------------------------------------------------------------------------------------------
    public function func(String $name, String $value = NULL)
    {
        return $this->_loaded($name, $value, 'function_exists', 'undefinedFunctionExtension');
    }

    //--------------------------------------------------------------------------------------------------------
    // Callback
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $name
    // @param  string  $value
    //
    //--------------------------------------------------------------------------------------------------------
    public function callback(String $name, String $value = NULL)
    {
        return $this->_loaded($name, $value, 'function_exists', 'undefinedFunction');
    }

    //--------------------------------------------------------------------------------------------------------
    // Extension
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $name
    // @param  string  $value
    //
    //--------------------------------------------------------------------------------------------------------
    public function extension(String $name, String $value = NULL)
    {
        return $this->_loaded($name, $value, 'extension_loaded', 'undefinedFunctionExtension');
    }

    //--------------------------------------------------------------------------------------------------------
    // Library
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $name
    // @param  string  $value
    //
    //--------------------------------------------------------------------------------------------------------
    public function library(String $name, String $value = NULL)
    {
        return $this->_loaded($name, $value, 'class_exists', 'classError');
    }

    //--------------------------------------------------------------------------------------------------------
    // Writable
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $name
    // @param  string  $value
    //
    //--------------------------------------------------------------------------------------------------------
    public function writable(String $name, String $value = NULL)
    {
        return $this->_loaded($name, $value, 'is_writable', 'fileNotWrite');
    }

    //--------------------------------------------------------------------------------------------------------
    // Driver
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $name
    // @param  string  $value
    //
    //--------------------------------------------------------------------------------------------------------
    public function driver(Array $drivers, String $driver = NULL)
    {
        if( ! in_array(strtolower($driver), $drivers) )
        {
            die(\Errors::message('Error', 'driverError', $driver));
        }

        return true;
    }

    //--------------------------------------------------------------------------------------------------------
    // Class Method
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $class
    // @param  string  $method
    //
    //--------------------------------------------------------------------------------------------------------
    public function classMethod(String $class, String $method)
    {
        die(\Errors::message
        (
            'Error',
            'undefinedFunction',
            \Strings::divide(str_ireplace(INTERNAL_ACCESS, '', Classes::onlyName($class)), '\\', -1)."::$method()"
        ));
    }
}
