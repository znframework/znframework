<?php trait FactoryAbility
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

        $class = $namespace.$class;

        return uselib($class);
    }
}
