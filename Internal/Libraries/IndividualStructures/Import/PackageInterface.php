<?php namespace ZN\IndividualStructures\Import;

interface PackageInterface
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
    public function use($packages, Bool $recursive = false, Bool $getContents = false, String $dir = NULL);

    //--------------------------------------------------------------------------------------------------------
    // Theme
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $theme
    // @param bool   $recursive
    // @param bool   $getContents
    //
    //--------------------------------------------------------------------------------------------------------
    public function theme($theme = 'Default', Bool $recursive = false, Bool $getContents = false);

    //--------------------------------------------------------------------------------------------------------
    // Plugin
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $plugin
    // @param bool   $recursive
    // @param bool   $getContents
    //
    //--------------------------------------------------------------------------------------------------------
    public function plugin($plugin = 'Default', Bool $recursive = false, Bool $getContents = false);
}
