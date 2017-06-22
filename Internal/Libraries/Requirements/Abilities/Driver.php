<?php

use Coalesce;
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
    // Construct
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $driver
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct(String $driver = NULL)
    {
        parent::__construct();

        if( ! defined('static::driver') )
        {
            throw new UndefinedConstException('[const driver] is required to use the [Driver Ability]!');
        }

        Coalesce::null($driver, $this->config['driver'] ?? NULL);

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
