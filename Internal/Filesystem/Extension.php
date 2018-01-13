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
        $dot = $dot === true ? '.' : '';

        return $dot . strtolower(pathinfo($file, PATHINFO_EXTENSION));
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
        return preg_replace('/\\.[^.\\s]{2,4}$/', '', $file);
    }
}
