<?php namespace ZN\IndividualStructures\Import;

use Folder, Import;

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
    public function use($packages, Bool $recursive = false, Bool $getContents = false, String $dir = NULL)
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
            return $this->_package($dir.$packages, $recursive, $getContents);
        }
        else
        {
            $return = '';

            if( ! empty($packages) ) foreach( $packages as $package )
            {
                $return .= $this->_package($dir.$package, $recursive, true);
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
    public function resource($theme = 'Default', Bool $recursive = false, Bool $getContents = false)
    {
        return $this->use($theme, $recursive, $getContents, RESOURCES_DIR);
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
    public function theme($theme = 'Default', Bool $recursive = false, Bool $getContents = false)
    {
        return $this->use($theme, $recursive, $getContents, THEMES_DIR);
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
    public function plugin($plugin = 'Default', Bool $recursive = false, Bool $getContents = false)
    {
        return $this->use($plugin, $recursive, $getContents, PLUGINS_DIR);
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
    protected function _package($packages, $recursive, $getContents)
    {
        $eol    = EOL;
        $return = '';

        // Common Directory
        if( ! is_dir($packages) && ! is_file($packages) )
        {
            $packages = str_replace(RESOURCES_DIR, EXTERNAL_RESOURCES_DIR, $packages);
        }

        if( Folder::exists($packages) )
        {
            $packageFiles = Folder::allFiles(suffix($packages), $recursive);

            if( ! empty($packageFiles) )
            {
                foreach( $packageFiles as $val )
                {
                    if( $getContents === true )
                    {
                        $return .= Import::something($val, [], true);
                    }
                    else
                    {
                        Import::something($val);
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
            return Import::something($packages, [], $getContents);
        }
    }
}
