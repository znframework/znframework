<?php namespace ZN\IndividualStructures\Buffer;

use Session;

class Insert
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
    // Do
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string                 $name
    // @param  callable/object/string $data
    // @param  array                  $params
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public static function do(String $name, $data, Array $params = []) : Bool
    {
        $systemObData = md5('OB_DATAS_'.$name);

        if( is_callable($data) )
        {
            return Session::insert($systemObData, Callback::do($data, (array) $params));
        }
        elseif( is_file($data) )
        {
            return Session::insert($systemObData, File::do($data));
        }
        else
        {
            return Session::insert($systemObData, $data);
        }
    }
}
