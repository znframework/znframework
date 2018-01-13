<?php namespace ZN\Filesystem;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Filesystem\Exception\FileNotFoundException;

class Loader
{
    /**
     * Require File
     * 
     * @param string $file
     * @param string $type = 'require'
     * 
     * @return mixed
     */
    public static function require(String $file, String $type = 'require')
    {
        $file = Info::rpath($file);

        if( ! is_file($file) )
        {
            throw new FileNotFoundException($file);
        }

        switch( $type )
        {
            case 'require'     : return require      $file;
            case 'require_once': return require_once $file;
            case 'include'     : return include      $file;
            case 'include_once': return include_once $file;
        }
    }

    /**
     * Require Once
     * 
     * @param string $file
     * 
     * @return mixed
     */
    public static function requireOnce(String $file)
    {
        return self::require($file, 'require_once');
    }

    /**
     * Include
     * 
     * @param string $file
     * 
     * @return mixed
     */
    public static function include(String $file)
    {
        return self::require($file, 'include');
    }

    /**
     * Include Once
     * 
     * @param string $file
     * 
     * @return mixed
     */
    public static function includeOnce(String $file)
    {
        return self::require($file, 'include_once');
    }
}
