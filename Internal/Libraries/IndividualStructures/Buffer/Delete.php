<?php namespace ZN\IndividualStructures\Buffer;

use Session;

class Delete
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
    // @param  string $name
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public static function do($name) : Bool
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
