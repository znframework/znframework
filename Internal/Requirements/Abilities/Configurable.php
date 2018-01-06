<?php 
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

trait ConfigurableAbility
{
    /**
     * Keeps the settings.
     * 
     * @var array
     */
    protected $config = [];

    /**
     * Creates config constants.
     * 
     * @param void
     * 
     * @return mixed
     * 
     */
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
    }

    /**
     * Sets the config.
     * 
     * @param array $settings
     * 
     * @return $this
     */
    public function config(Array $settings)
    {
        $configEx = $this->_configEx();
        $name     = $configEx->name;
        $key      = $configEx->key;

        Config::set($name, $key, $settings);

        return $this;
    }

    /**
     * protected
     * 
     * @param array $config
     * 
     * @return object
     */
    protected function _configEx($config)
    {
        $configEx = explode(':', $config);
        $name     = $configEx[0] ?? NULL;
        $key      = $configEx[1] ?? NULL;
        $constFix = '_CONFIG';

        if( $key !== NULL )
        {
            $const = $name.'_'.$key.$constFix;
        }
        else
        {
            $const = $name.$constFix;
        }

        return (object)
        [
            'name'  => $name,
            'key'   => $key,
            'const' => strtoupper($const)
        ];
    }

    /**
     * protected
     * 
     * @param mixed $configs
     * @param mixed $type = NULL
     * 
     * @return void
     */
    protected function _singleConfig($configs, $type = NULL)
    {
        $configEx = $this->_configEx($configs);
        $name     = $configEx->name;
        $key      = $configEx->key;
        $const    = $configEx->const;

        if( $type === 'multiple' )
        {
            $this->config = array_merge((array) $this->config, (array) Config::get($name , $key));
        }
        else
        {
            $this->config = Config::get($name , $key);
        }

        Illustrate($const, $this->config);
    }
}
