<?php trait UnitTestAbility
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
    public static function result(...$method)
    {
        if( ! defined('static::unit') )
        {
            return false;
        }

        $class   = static::unit['class'];
        $methods = static::unit['methods'];

        if( ! empty($method) )
        {
            $oldMethods = $methods;
            $methods    = [];

            foreach( $method as $met )
            {
                $methods[$met] = $oldMethods[$met];
            }
        }

        ZNUnitTest::class($class)
                  ->methods($methods)
                  ->start();

        return ZNUnitTest::result();
    }
}
