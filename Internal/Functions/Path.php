<?php
//--------------------------------------------------------------------------------------------------
// Path
//--------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// currentPath()
//--------------------------------------------------------------------------------------------------
//
// @param bool $isPath
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function currentPath(Bool $isPath = true) : String
{
    $currentPagePath = str_replace("/".getLang()."/", "", server('currentPath'));

    if( isset($currentPagePath[0]) && $currentPagePath[0] === "/" )
    {
        $currentPagePath = substr($currentPagePath, 1, strlen($currentPagePath) - 1);
    }

    if( $isPath === true )
    {
        return $currentPagePath;
    }
    else
    {
        $str = explode("/", $currentPagePath);

        if( count($str) > 1 )
        {
            return $str[count($str) - 1];
        }

        return $str[0];
    }
}

//--------------------------------------------------------------------------------------------------
// basePath()
//--------------------------------------------------------------------------------------------------
//
// @param string $uri
// @param int    $index
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function basePath(String $uri = '', Int $index = 0) : String
{
    $newBaseDir = substr(BASE_DIR, 1);

    if( BASE_DIR !== "/" )
    {
        if( $index < 0 )
        {
            $baseDir = substr(BASE_DIR, 1, -1);

            $baseDir = explode("/", $baseDir);

            $newBaseDir = '';

            for( $i = 0; $i < count($baseDir) + $index; $i++ )
            {
                $newBaseDir .= suffix($baseDir[$i]);
            }
        }
    }

    return internalCleanInjection($newBaseDir.$uri);
}

//--------------------------------------------------------------------------------------------------
// prevPath()
//--------------------------------------------------------------------------------------------------
//
// @param bool $isPath
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function prevPath(Bool $isPath = true) : String
{
    if( ! isset($_SERVER['HTTP_REFERER']) )
    {
        return false;
    }

    $str = str_replace(sslStatus().host().BASE_DIR.indexStatus(), '', $_SERVER['HTTP_REFERER']);

    if( currentLang() )
    {
        $str = explode("/",$str); return $str[1];
    }

    if( $isPath === true )
    {
        return $str;
    }
    else
    {
        $str = explode('/', $str);

        $count = count($str);

        if( $count > 1 )
        {
            return $str[$count - 1];
        }

        return (string) $str[0];
    }
}

//--------------------------------------------------------------------------------------------------
// filePath()
//--------------------------------------------------------------------------------------------------
//
// @param string $file
// @param string $removeurl
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function filePath(String $file = '', String $removeUrl = '') : String
{
    if( isUrl($file) )
    {
        if( ! isUrl($removeUrl) )
        {
            $removeUrl = baseUrl();
        }

        $file = trim(str_replace($removeUrl, '', $file));
    }

    return $file;
}
