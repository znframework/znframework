<?php trait UnitTestAbility
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
    public static function result()
    {
        if( ! defined('static::unit') )
        {
            throw new UndefinedConstException('[const unit] is required to use the [UnitTest Ability]!');
        }

        ZNUnitTest::class(static::unit['class'])
                  ->methods(static::unit['methods'])
                  ->start();

        return ZNUnitTest::result();
    }
}
