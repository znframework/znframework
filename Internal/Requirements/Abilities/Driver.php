<?php

use ZN\IndividualStructures\Support;
use ZN\Requirements\Abilities\Exception\UndefinedConstException;

trait DriverAbility
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
    // Protected Crypto
    //--------------------------------------------------------------------------------------------------------
    //
    // Sürücü bilgisi
    //
    // @var  string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $driver;

    //--------------------------------------------------------------------------------------------------------
    // Protected Selected Driver Name
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $selectedDriverName;

    //--------------------------------------------------------------------------------------------------------
    // Construct -> 5.3.42[edited]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $driver
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct(String $driver = NULL)
    {
        // 5.3.42[added]
        if( method_exists(get_parent_class(), '__construct'))
        {
            parent::__construct();
        }
       
        if( ! defined('static::driver') )
        {
            throw new UndefinedConstException('[const driver] is required to use the [Driver Ability]!');
        }

        // 5.3.42|5.4.5[edited]
        $driver = $driver                 ??
                  $this->config['driver'] ?? 
                  (isset(static::driver['config']) ? Config::get(...explode(':', static::driver['config']))['driver'] : NULL) ?: 
                  static::driver['options'][0];
        
        $this->selectedDriverName = $driver;

        Support::driver(static::driver['options'], $driver);

        if( ! isset(static::driver['namespace']) )
        {
            $this->driver = uselib($driver);
        }
        else
        {
            $this->driver = uselib(suffix(static::driver['namespace'], '\\').$driver.'Driver');
        }

        if( isset(static::driver['construct']) )
        {
            $construct = static::driver['construct'];

            $this->{$construct}();
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Driver
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $driver
    // @return object
    //
    //--------------------------------------------------------------------------------------------------------
    public function driver(String $driver) : self
    {
        return new self($driver);
    }
}
