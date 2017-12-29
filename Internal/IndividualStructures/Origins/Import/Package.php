<?php namespace ZN\IndividualStructures\Import;

use Project\Controllers\Theme;
use ZN\FileSystem\Folder;

class Package
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Package
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $package
    // @param bool   $recursive
    // @param bool   $getContents
    //
    //--------------------------------------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------------
    // Resource -> 5.1.0
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $theme
    // @param bool   $recursive
    // @param bool   $getContents
    //
    //--------------------------------------------------------------------------------------------------------
    public static function resource($theme = 'Default', Bool $recursive = false, Bool $getContents = false)
    {
        return self::use($theme, $recursive, $getContents, RESOURCES_DIR);
    }

    //--------------------------------------------------------------------------------------------------------
    // Theme
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $theme
    // @param bool   $recursive
    // @param bool   $getContents
    //
    //--------------------------------------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------------
    // Plugin
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $plugin
    // @param bool   $recursive
    // @param bool   $getContents
    //
    //--------------------------------------------------------------------------------------------------------
    public static function plugin($plugin = 'Default', Bool $recursive = false, Bool $getContents = false)
    {
        return self::use($plugin, $recursive, $getContents, PLUGINS_DIR);
    }



    //--------------------------------------------------------------------------------------------------------
    // Protected Package
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $package
    // @param bool   $recursive
    // @param bool   $getContents
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _package($packages, $recursive, $getContents)
    {
        $eol    = EOL;
        $return = '';

        // Common Directory
        if( ! is_dir($packages) && ! is_file($packages) )
        {
            $packages = str_replace(RESOURCES_DIR, EXTERNAL_RESOURCES_DIR, $packages);
        }

        if( is_dir($packages) )
        {
            $packageFiles = Folder\FileList::allFiles(suffix($packages), $recursive);

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
            // Local Directory
            return Something::use($packages, [], $getContents);
        }
    }
}
