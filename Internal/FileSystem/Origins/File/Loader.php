<?php namespace ZN\FileSystem\File;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\FileSystem\Exception\FileNotFoundException;

class Loader
{
    //--------------------------------------------------------------------------------------------------------
    // Require
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    // @return array
    //
    //--------------------------------------------------------------------------------------------------------
    public static function require(String $file, String $type = 'require')
    {
        $file = Info::rpath($file);

        if( ! is_file($file) )
        {
            throw new FileNotFoundException($file);
        }

        switch( $type )
        {
            case 'require':
                return require $file;
            break;

            case 'require_once':
                return require_once $file;
            break;

            case 'include':
                return include $file;
            break;

            case 'include_once':
                return include_once $file;
            break;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Require Once
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    // @return array
    //
    //--------------------------------------------------------------------------------------------------------
    public static function requireOnce(String $file)
    {
        return self::require($file, 'require_once');
    }

    //--------------------------------------------------------------------------------------------------------
    // Include
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    // @return array
    //
    //--------------------------------------------------------------------------------------------------------
    public static function include(String $file)
    {
        return self::require($file, 'include');
    }

    //--------------------------------------------------------------------------------------------------------
    // Include Once
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    // @return array
    //
    //--------------------------------------------------------------------------------------------------------
    public static function includeOnce(String $file)
    {
        return self::require($file, 'include_once');
    }
}
