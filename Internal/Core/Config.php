<?php namespace ZN\Core;

class Config
{
    //--------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------
    // Config Priority
    //--------------------------------------------------------------------------------------------------
    //
    // Primary  : Internal Config
    // Secondary: Applications Config
    // Tertiary : External Config
    //
    //--------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------
    // $setConfigs
    //--------------------------------------------------------------------------------------------------
    //
    // Set edilen ayarları tutacak dizi değişken
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------
    private static $setConfigs = [];

    //--------------------------------------------------------------------------------------------------
    // $config
    //--------------------------------------------------------------------------------------------------
    //
    // Ayarları tutacak dizi değişken
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------
    private static $config = [];

    //--------------------------------------------------------------------------------------------------
    // _config()
    //--------------------------------------------------------------------------------------------------
    //
    // @param  string $file
    // @return void
    //
    //--------------------------------------------------------------------------------------------------
    private static function _config(string $file) : void
    {
        if( empty(self::$config[$file]) )
        {
            $externalPath = EXTERNAL_CONFIG_DIR.suffix($file,".php");
            $projectPath  = CONFIG_DIR.suffix($file,".php");
            $internalPath = INTERNAL_CONFIG_DIR.suffix($file,".php");

            $allConfig    = [];

            if( is_file($externalPath) )
            {
                $allConfig = array_merge($allConfig, (array) require_once($externalPath));
            }

            if( is_file($projectPath) )
            {
                $allConfig = array_merge($allConfig, (array) require_once($projectPath));
            }

            if( is_file($internalPath) )
            {
                $allConfig = array_merge($allConfig, (array) require_once($internalPath));
            }

            self::$config[$file] = $allConfig;
        }
    }

    //--------------------------------------------------------------------------------------------------
// get()
//--------------------------------------------------------------------------------------------------
//
// @param  string $file
// @param  string $configs
// @return array
//
//--------------------------------------------------------------------------------------------------
public static function get(string $file, string $configs = NULL, $settings = NULL ) : array
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
        return self::$config[$file] ?? [];
    }

    return self::$config[$file][$configs] ?? [];
}
//--------------------------------------------------------------------------------------------------
// set()
//--------------------------------------------------------------------------------------------------
//
// @param  string $file
// @param  string $configs
// @return array
//
//--------------------------------------------------------------------------------------------------
public static function set(string $file, $configs, $set = NULL) : array
{
    if( empty($configs) )
    {
        return [];
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

    //--------------------------------------------------------------------------------------------------
    // iniSet()
    //--------------------------------------------------------------------------------------------------
    //
    // @param  mixed  $key
    // @param  string $val
    // @return void
    //
    //--------------------------------------------------------------------------------------------------
    public static function iniSet($key, $val = NULL) : void
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

    //--------------------------------------------------------------------------------------------------
    // iniGet()
    //--------------------------------------------------------------------------------------------------
    //
    // @param  mixed  $key
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------
    // iniGetAll()
    //--------------------------------------------------------------------------------------------------
    //
    // @param  string $key
    // @param  bool   $details
    // @return array
    //
    //--------------------------------------------------------------------------------------------------
    public static function iniGetAll( ? string $extension = NULL, bool $details = true) : array
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

    //--------------------------------------------------------------------------------------------------
    // iniRestore()
    //--------------------------------------------------------------------------------------------------
    //
    // @param  string $str
    // @return void
    //
    //--------------------------------------------------------------------------------------------------
    public static function iniRestore(string $str) : void
    {
        ini_restore($str);
    }
}

class_alias('ZN\Core\Config', 'Config');
