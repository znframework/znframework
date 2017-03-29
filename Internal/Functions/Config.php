<?php
//--------------------------------------------------------------------------------------------------
// Config
//--------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// Configs
//--------------------------------------------------------------------------------------------------
//
// @param array variadic $configs
//
// @return mixed
//
//--------------------------------------------------------------------------------------------------
function configs(...$configs) : Array
{
    $allConfig = [];

    foreach( $configs as $config )
    {
        if( is_array($config) )
        {
            $allConfig = array_merge($allConfig, config(key($config), current($config)));
        }
        else
        {
            $allConfig = array_merge($allConfig, config($config));
        }
    }

    return $allConfig;
}

//--------------------------------------------------------------------------------------------------
// Config
//--------------------------------------------------------------------------------------------------
//
// @param string $file
// @param string $value
// @param mixed  $newValue
//
// @return mixed
//
//--------------------------------------------------------------------------------------------------
function config(String $file, String $value = NULL, $newValue = NULL)
{
    if( $newValue === NULL )
    {
        return Config::get($file, $value);
    }
    else
    {
        $default = Config::get($file, $value);

        Config::set($file, $value, $newValue);

        if( is_array($newValue) )
        {
            $config = Config::get($file, $value);
        }
        else
        {
            $config = Config::get($file);
        }

        Config::set($file, $value, $default);

        return $config;
    }
}

//--------------------------------------------------------------------------------------------------
// Gconfig
//--------------------------------------------------------------------------------------------------
//
// @param string $value
//
// @return mixed
//
//--------------------------------------------------------------------------------------------------
function gconfig(String $value = NULL)
{
    global $gconfig;

    if( empty($gconfig) )
    {
        $configs = array_merge
        (
            Folder::files(EXTERNAL_CONFIG_DIR, 'php'),
            Folder::files(CONFIG_DIR, 'php'),
            Folder::files(INTERNAL_CONFIG_DIR, 'php')
        );

        $gconfig = [];

        foreach( $configs as $file )
        {
            $file    = removeExtension($file);
            $gconfig = array_merge($gconfig, (array) Config::get($file));
        }
    }

    if( $value === NULL )
    {
        return $gconfig;
    }

    return $gconfig[$value] ?? false;
}
