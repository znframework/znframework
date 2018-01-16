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

use ZN\Filesystem;

class Extension
{
    /**
     * Get Extension
     * 
     * @param string $file
     * @param bool   $dot = false
     * 
     * @return string
     */
    public static function get(String $file, Bool $dot = false) : String
    {
        return Filesystem::getExtension($file, $dot);
    }

    /**
     * Remove Extension
     * 
     * @param string $file
     * 
     * @return string
     */
    public static function remove(String $file) : String
    {
        return Filesystem::removeExtension($file);
    }
}
