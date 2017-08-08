<?php namespace Project\Controllers;

trait ViewTrait
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    public static $data = [];

    public static function __callStatic($method, $parameters)
    {
        self::$data[$method] = $parameters[0] ?? false;

        return new self;
    }

    public function __call($method, $parameters)
    {
        self::$data[$method] = $parameters[0] ?? false;

        return $this;
    }
}
