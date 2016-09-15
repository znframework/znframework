<?php trait MagicFactoryAbility
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    public function __call($method, $parameters)
    {
        if( ! defined('static::factory') )
        {
            throw new UndefinedConstException('[const factory] is required to use the [Call Factory Method Ability]!');
        }

        $originMethodName = $method;
        $method = strtolower($method);

        if( ! isset(static::factory['methods'][$method]) )
        {
            Support::classMethod(__CLASS__, $originMethodName);
        }

        $class   = static::factory['methods'][$method];
        $factory = static::factory['class'];

        return $factory::class($class)->$method(...$parameters);
    }
}
