<?php
//--------------------------------------------------------------------------------------------------
// URL
//--------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// currentUrl()
//--------------------------------------------------------------------------------------------------
//
// @param string $fix
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function currentUrl(String $fix = '') : String
{
    $currentUrl = sslStatus().host().internalCleanInjection(server('requestUri'));

    if( ! empty($fix) )
    {
        return rtrim(suffix($currentUrl), $fix).$fix;
    }

    return $currentUrl;
}

//--------------------------------------------------------------------------------------------------
// siteUrl()
//--------------------------------------------------------------------------------------------------
//
// @param string $uri
// @param int    $index
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function siteUrl(String $uri = '', Int $index = 0) : String
{
    $newBaseDir = BASE_DIR;

    if( BASE_DIR !== "/" )
    {
        $baseDir = substr(BASE_DIR, 1, -1);

        if( $index < 0 )
        {
            $baseDir    = explode("/", $baseDir);
            $newBaseDir = "/";

            for( $i = 0; $i < count($baseDir) + $index; $i++ )
            {
                $newBaseDir .= suffix($baseDir[$i]);
            }
        }
    }

    $host = host();

    return sslStatus().
           $host.
           $newBaseDir.
           indexStatus().
           internalCleanInjection((CURRENT_PROJECT === DEFAULT_PROJECT ? NULL : suffix(CURRENT_PROJECT)) . suffix(currentLang()) . $uri);
}

//--------------------------------------------------------------------------------------------------
// baseUrl()
//--------------------------------------------------------------------------------------------------
//
// @param string $uri
// @param int    $index
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function baseUrl(String $uri = '', Int $index = 0) : String
{
    $newBaseDir = BASE_DIR;

    if( BASE_DIR !== "/" )
    {
        $baseDir = substr(BASE_DIR, 1, -1);

        if( $index < 0 )
        {
            $baseDir    = explode("/", $baseDir);
            $newBaseDir = "/";

            for($i = 0; $i < count($baseDir) + $index; $i++)
            {
                $newBaseDir .= suffix($baseDir[$i]);
            }
        }
    }

    $host = host();

    return sslStatus().$host.$newBaseDir.internalCleanInjection(absoluteRelativePath($uri));
}

//--------------------------------------------------------------------------------------------------
// prevUrl()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function prevUrl() : String
{
    if( ! isset($_SERVER['HTTP_REFERER']) )
    {
        return false;
    }

    $str = str_replace(sslStatus().host().BASE_DIR.indexStatus(), "", $_SERVER['HTTP_REFERER']);

    if( currentLang() )
    {
        $strEx = explode("/", $str);
        $str   = str_replace($strEx[0]."/", "", $str);
    }

    return siteUrl(internalCleanInjection($str));
}

//--------------------------------------------------------------------------------------------------
// hostUrl()
//--------------------------------------------------------------------------------------------------
//
// @param string $uri
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function hostUrl(String $uri = '') : String
{
    return sslStatus().suffix(host()).internalCleanInjection($uri);
}
