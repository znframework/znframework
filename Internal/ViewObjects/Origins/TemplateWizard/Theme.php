<?php namespace Project\Controllers;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */
class Theme
{
    /**
     * Active status
     * 
     * @var string
     */
    public static $active = NULL;

    /**
     * Active theme.
     * 
     * @param string $active = 'Default'
     * 
     * @return void
     */
    public static function active(String $active = 'Default')
    {
        self::$active = suffix($active);
    }
}

# Alias Theme
class_alias('Project\Controllers\Theme', 'Theme');
