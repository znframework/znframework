<?php namespace ZN\IndividualStructures;

use Session, CallController;
use ZN\IndividualStructures\Buffer\Exception\InvalidArgumentException;

class InternalBuffer extends CallController implements BufferInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // File
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $file
    // @return content
    //
    //--------------------------------------------------------------------------------------------------------
    public function file(String $file) : String
    {
        if( ! file_exists($file) )
        {
            throw new InvalidArgumentException('Error', 'fileParameter', '1.($file)');
        }

        ob_start();

        require($file);

        $contents = ob_get_contents();

        ob_end_clean();

        return $contents;
    }

    //--------------------------------------------------------------------------------------------------------
    // Func
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string/callable $func
    // @param  array           $params
    // @return callable
    //
    //--------------------------------------------------------------------------------------------------------
    public function func($func, Array $params = [])
    {
        if( ! is_callable($func) )
        {
            throw new InvalidArgumentException('Error', 'callableParameter', '1.($func)');
        }

        ob_start();

        if( ! empty($params) )
        {
            return call_user_func_array($func, $params);
        }
        else
        {
            return $func();
        }

        $contents = ob_get_contents();

        ob_end_clean();

        return $contents;
    }

    //--------------------------------------------------------------------------------------------------------
    // Callback / Func
    //--------------------------------------------------------------------------------------------------------
    //
    // func() yönteminin takma adıdır.
    //
    //--------------------------------------------------------------------------------------------------------
    public function callback($func, Array $params = [])
    {
        return $this->func($func, $params);
    }

    //--------------------------------------------------------------------------------------------------------
    // Insert
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string                 $name
    // @param  callable/object/string $data
    // @param  array                  $params
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function insert(String $name, $data, Array $params = []) : Bool
    {
        $systemObData = md5('OB_DATAS_'.$name);

        if( is_callable($data) )
        {
            return Session::insert($systemObData, $this->func($data, (array) $params));
        }
        elseif( file_exists($data) )
        {
            return Session::insert($systemObData, $this->file($data));
        }
        else
        {
            return Session::insert($systemObData, $data);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Select
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $name
    // @return callable/content
    //
    //--------------------------------------------------------------------------------------------------------
    public function select(String $name)
    {
        return Session::select(md5('OB_DATAS_'.$name));
    }

    //--------------------------------------------------------------------------------------------------------
    // Delete
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $name
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function delete($name) : Bool
    {
        if( is_array($name) )
        {
            foreach( $name as $delete )
            {
                Session::delete(md5('OB_DATAS_'.$delete));
            }

            return true;
        }
        elseif( is_scalar($name) )
        {
            return Session::delete(md5('OB_DATAS_'.$name));
        }

        return false;
    }
}
