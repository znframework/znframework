<?php namespace ZN\Inclusion;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Base;
use ZN\Filesystem;
use ZN\Inclusion\Project\Theme;

class Package
{
    /**
     * Get package
     * 
     * @param mixed  $packages
     * @param bool   $recursive   = false
     * @param bool   $getContents = false
     * @param string $dir         = NULL
     * 
     * @return mixed
     */
    public static function use($packages, Bool $recursive = false, Bool $getContents = false, String $dir = NULL)
    {
        if( ! empty(Properties::$parameters['usable']) )
        {
            $getContents = Properties::$parameters['usable'];
        }

        if( ! empty(Properties::$parameters['recursive']) )
        {
            $recursive = Properties::$parameters['recursive'];
        }

        Properties::$parameters = [];

        if( ! is_array($packages) )
        {
            return self::_package($dir . $packages, $recursive, $getContents);
        }
        else
        {
            $return = '';

            if( ! empty($packages) ) foreach( $packages as $package )
            {
                $return .= self::_package($dir . $package, $recursive, true);
            }

            if( $getContents === false )
            {
                echo $return;
            }
            else
            {
                return $return;
            }
        }
    }

    /**
     * Get theme
     * 
     * @param mixed  $theme       = 'Default'
     * @param bool   $recursive   = false
     * @param bool   $getContents = false
     * 
     * @return mixed
     */
    public static function theme($theme = 'Default', Bool $recursive = false, Bool $getContents = false)
    {
        if( Theme::$active !== NULL && is_array($theme) )
        {
            $dir = THEMES_DIR . Theme::$active;
        }
        else
        {
            $dir = THEMES_DIR;
        }

        return self::use($theme, $recursive, $getContents, $dir);
    }

    /**
     * Get theme
     * 
     * @param mixed  $plugin      = 'Default'
     * @param bool   $recursive   = false
     * @param bool   $getContents = false
     * 
     * @return mixed
     */
    public static function plugin($plugin = 'Default', Bool $recursive = false, Bool $getContents = false)
    {
        return self::use($plugin, $recursive, $getContents, PLUGINS_DIR);
    }

    /**
     * Protected Package
     */
    protected static function _package($packages, $recursive, $getContents)
    {
        $eol    = EOL;
        $return = '';

        # Common Directory
        if( ! is_dir($packages) && ! is_file($packages) )
        {
            $packages = str_replace(RESOURCES_DIR, EXTERNAL_RESOURCES_DIR, $packages);
        }

        if( is_dir($packages) )
        {
            $packageFiles = Filesystem::getFiles(Base::suffix($packages), $recursive);

            if( ! empty($packageFiles) )
            {
                foreach( $packageFiles as $val )
                {
                    if( $getContents === true )
                    {
                        $return .= Something::use($val, [], true);
                    }
                    else
                    {
                        Something::use($val);
                    }
                }

                return $return;
            }
            else
            {
                return false;
            }
        }
        elseif( is_file($packages) )
        {
            # Local Directory
            return Something::use($packages, [], $getContents);
        }
    }
}
