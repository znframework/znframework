<?php namespace Project\Controllers;

use Arrays, Collection, Import;

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

    //--------------------------------------------------------------------------------------------------------
    // Static $data
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    public static $data = [];

    //--------------------------------------------------------------------------------------------------------
    // Static $data
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    public static $usableMethods =
    [
        'view', 'script', 'style', 'font', 'template', 'page', 'something', 'theme', 'resource', 'plugin'
    ];

    //--------------------------------------------------------------------------------------------------------
    // Magic Call Static
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $method
    // @param array  $parameters
    //
    //--------------------------------------------------------------------------------------------------------
    public static function __callStatic($method, $parameters)
    {
        self::call($method, $parameters);

        return new self;
    }

    //--------------------------------------------------------------------------------------------------------
    // Magic Call
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $method
    // @param array  $parameters
    //
    //--------------------------------------------------------------------------------------------------------
    public function __call($method, $parameters)
    {
        self::call($method, $parameters);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Call
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $method
    // @param array  $parameters
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function call($method, $parameters)
    {
        if( stripos($parameters[0], ':') )
        {
            $ex = explode(':', $parameters[0]);

            if( Arrays::valueExists(self::$usableMethods, $met = $ex[0]) )
            {
                $parameters = Collection::data($parameters)->removeFirst()->addLast(true)->get();

                if( strstr('page|view|something', $met) && ! is_array($parameters[0]) )
                {
                    $parameters = Arrays::addFirst($parameters, NULL);
                }

                self::$data[$method] = Import::$met($ex[1] ?? NULL, ...$parameters);
            }
        }
        else
        {
            self::$data[$method] = $parameters[0] ?? false;
        }
    }
}
