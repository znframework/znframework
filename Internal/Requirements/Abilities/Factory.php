<?php 

use ZN\DataTypes\Strings;

trait FactoryAbility
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
    // Class
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $class
    //
    //--------------------------------------------------------------------------------------------------------
    public static function class(String $class)
    {
        $namespace = NULL;

        if( defined('static::namespace') )
        {
            $namespace = suffix(static::namespace, '\\');
        }
        else
        {
            $calledClass = get_called_class();
            $namespace   = str_ireplace(Strings\Split::divide($calledClass, '\\', -1), NULL, $calledClass);
        }

        $class = $namespace.$class;

        return uselib($class);
    }
}
