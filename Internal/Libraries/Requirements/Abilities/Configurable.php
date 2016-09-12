<?php namespace ZN\Requirements\Abilities;

use Config, Classes;

trait Configurable
{
    //--------------------------------------------------------------------------------------------------------
    // Config
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $config = [];

    //--------------------------------------------------------------------------------------------------------
    // Construct
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    public function configurable()
    {
        if( ! defined('static::config') )
        {
            return false;
        }

        $configs = static::config;

        if( ! is_array($configs) )
        {
            $this->_singleConfig($configs);
        }
        else
        {
            foreach( $configs as $config )
            {
                $this->_singleConfig($config, 'multiple');
            }
        }

        $constName = strtoupper(Classes::onlyName(get_called_class())).'_CONFIG';

        Illustrate($constName, $this->config);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Single Config
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _singleConfig($configs, $type = NULL)
    {
        $configEx = $this->_configEx($configs);
        $name     = $configEx->name;
        $key      = $configEx->key;

        if( $type === 'multiple' )
        {
            $this->config = array_merge((array) $this->config, (array) Config::get($name , $key));
        }
        else
        {
            $this->config = Config::get($name , $key);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Config
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  array  $settings: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function config(Array $settings)
    {
        $configEx = $this->_configEx();
        $name     = $configEx->name;
        $key      = $configEx->key;

        Config::set($name, $key, $settings);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Config Ex
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _configEx($config)
    {
        $configEx = explode(':', $config);
        $name     = $configEx[0] ?? NULL;
        $key      = $configEx[1] ?? NULL;

        return (object)
        [
            'name' => $name,
            'key'  => $key
        ];
    }
}

class_alias('ZN\Requirements\Abilities\Configurable', 'ConfigurableAbility');
