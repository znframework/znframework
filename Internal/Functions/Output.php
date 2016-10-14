<?php
//--------------------------------------------------------------------------------------------------
// Output
//--------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// output()
//--------------------------------------------------------------------------------------------------
//
// @param mixed $data
// @param array $settings = []
// @param bool  $content  = false
//
// @return void
//
//--------------------------------------------------------------------------------------------------
function output($data, Array $settings = [], Bool $content = false)
{
    // ---------------------------------------------------------------------------------------------
    // AYARLAR
    // ---------------------------------------------------------------------------------------------
    $textType = $settings['textType'] ?? 'monospace, Tahoma, Arial';
    $textSize = $settings['textSize'] ?? '12px';
    // ---------------------------------------------------------------------------------------------

    $globalStyle = ' style="font-family:'.$textType.'; font-size:'.$textSize .';"';

    $output  = "<span$globalStyle>";
    $output .= internalOutput($data, '', 0, $settings);
    $output .= "</span>";

    if( $content === false)
    {
        echo $output;
    }
    else
    {
        return $output;
    }
}

//--------------------------------------------------------------------------------------------------
// write()
//--------------------------------------------------------------------------------------------------
//
// @param string $data
// @param array  $vars = []
//
// @return void
//
//--------------------------------------------------------------------------------------------------
function write(String $data, Array $vars = [])
{
    if( ! is_scalar($data) )
    {
        echo 'Not String!'; return false;
    }

    if( ! empty($data) && is_array($vars) )
    {
        $varsArray = [];

        foreach( $vars as $k => $v )
        {
            $varsArray['{'.$k.'}']  = $v;
        }

        $data = str_replace(array_keys($varsArray), array_values($varsArray), $data);
    }

    echo $data;
}

//--------------------------------------------------------------------------------------------------
// writeLine()
//--------------------------------------------------------------------------------------------------
//
// @param string $data
// @param array  $vars    = []
// @param int    $brCount = 1
//
// @return void
//
//--------------------------------------------------------------------------------------------------
function writeLine(String $data, Array $vars = [], Int $brCount = 1)
{
    echo write($data, $vars) . str_repeat('<br>', $brCount);
}
