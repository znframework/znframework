<?php namespace ZN\Classes;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Config
{
    /**
     * Set configs
     * 
     * @var array
     */
    private static $setConfigs = [];

    /**
     * Get config
     * 
     * @var array
     */
    private static $config = [];

    /**
     * Magic call static
     * 
     * @param string $method
     * @param array  $parameters
     * 
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        $method = ucfirst($method);

        if( is_array($parameters[0] ?? NULL) || count($parameters) >= 2 )
        {
            return self::set($method, ...$parameters);
        }

        return self::get($method, ...$parameters);
    }

    /**
     * private merge configs
     * 
     * @param string $file
     * 
     * @return void
     */
    private static function _config($file)
    {
        if( empty(self::$config[$file]) )
        {
            $path = suffix($file, '.php');

            self::$config[$file] = array_merge
            (
                (array) import(SETTINGS_DIR . $path),
                (array) import(CONFIG_DIR   . $path)   
            );
        }
    }

    /**
     * Get config
     * 
     * @param string $file
     * @param string $configs  = NULL
     * @param mixed  $settings = NULL
     * 
     * @return mixed
     */
    public static function get(String $file, String $configs = NULL, $settings = NULL )
    {
        self::_config($file);

        if( ! empty($settings) )
        {
            self::set($file, $configs, $settings);
        }

        if( isset(self::$setConfigs[$file]) )
        {
            if( ! empty(self::$setConfigs[$file]) ) foreach( self::$setConfigs[$file] as $k => $v )
            {
                if( isset(self::$config[$file][$k]) && is_array(self::$config[$file][$k]) )
                {
                    self::$config[$file][$k] = array_merge(self::$config[$file][$k], (array) self::$setConfigs[$file][$k]);
                }
                else
                {
                    self::$config[$file][$k] = self::$setConfigs[$file][$k];
                }
            }
        }

        if( empty($configs) )
        {
            return self::$config[$file] ?? false;
        }

        return self::$config[$file][$configs] ?? false;
    }

    /**
     * Set config
     * 
     * @param string $file
     * @param mixed  $configs
     * @param mixed  $set = NULL
     * 
     * @return mixed
     */
    public static function set(String $file, $configs, $set = NULL)
    {
        if( empty($configs) )
        {
            return false;
        }

        if( ! is_array($configs) )
        {
            self::$setConfigs[$file][$configs] = $set;
        }
        else
        {
            foreach( $configs as $k => $v )
            {
                self::$setConfigs[$file][$k] = $v;
            }
        }
        
        return self::$setConfigs;
    }

    /**
     * Ini set
     * 
     * @param mixed $key
     * @param mixed $val = NULL
     * 
     * @return mixed
     */
    public static function iniSet($key, $val = NULL)
    {
        if( empty($key) )
        {
            return false;
        }

        if( ! is_array($key) )
        {
            if( is_array($val) )
            {
                return false;
            }

            if( $val !== '' )
            {
                ini_set($key, $val);
            }
        }
        else
        {
            foreach( $key as $k => $v )
            {
                if( $v !== '' )
                {
                    ini_set($k, $v);
                }
            }
        }
    }

    /**
     * Ini get
     * 
     * @param mixed $key
     * 
     * @return mixed
     */
    public static function iniGet($key)
    {
        if( ! is_array($key) )
        {
            return ini_get($key);
        }
        else
        {
            $keys = [];

            foreach( $key as $k )
            {
                $keys[$k] = ini_get($k);
            }

            return $keys;
        }
    }

    /**
     * Ini get all
     * 
     * @param string $extension = NULL
     * @param bool   $details   = true
     * 
     * @return array
     */
    public static function iniGetAll(String $extension = NULL, Bool $details = true) : Array
    {
        if( empty($extension) )
        {
            return ini_get_all();
        }
        else
        {
            return ini_get_all($extension, $details);
        }
    }

    /**
     * Ini restore
     * 
     * @param string $str
     * 
     * @return void
     */
    public static function iniRestore(String $str)
    {
        ini_restore($str);
    }
}

# Alias Config
class_alias('ZN\Classes\Config', 'Config');
