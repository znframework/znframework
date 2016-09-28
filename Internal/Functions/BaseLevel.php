<?php
//--------------------------------------------------------------------------------------------------
// Base Level
//--------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// trace()
//--------------------------------------------------------------------------------------------------
//
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
//
//--------------------------------------------------------------------------------------------------
function trace($message)
{
    $style  = 'border:solid 1px #E1E4E5;';
    $style .= 'background:#FEFEFE;';
    $style .= 'padding:10px;';
    $style .= 'margin-bottom:10px;';
    $style .= 'font-family:Calibri, Ebrima, Century Gothic, Consolas, Courier New, Courier, monospace, Tahoma, Arial;';
    $style .= 'color:#666;';
    $style .= 'text-align:left;';
    $style .= 'font-size:14px;';

    $message = preg_replace('/\[(.*?)\]/', '<span style="color:#990000;">$1</span>', $message);

    $str  = "<div style=\"$style\">";
    $str .= $message;
    $str .= '</div>';

    exit($str);
}

//--------------------------------------------------------------------------------------------------
// isPhpVersion()
//--------------------------------------------------------------------------------------------------
//
// İşlev: Parametrenin geçerli php sürümü olup olmadığını kontrol eder.
// Parametreler: $version => Geçerliliği kontrol edilecek veri.
// Dönen Değerler: Geçerli sürümse true değilse false değerleri döner.
//
//--------------------------------------------------------------------------------------------------
function isPhpVersion($version = '5.2.4')
{
    if( ! is_scalar($version) )
    {
        return false;
    }

    $version = (string) $version;

    return version_compare(PHP_VERSION, $version, '>=') ? true : false;
}

//--------------------------------------------------------------------------------------------------
// absoluteRelativePath()
//--------------------------------------------------------------------------------------------------
//
// Gerçek yolu yalın yola çevirir.
//
//--------------------------------------------------------------------------------------------------
function absoluteRelativePath(String $path = NULL)
{
    return str_replace([REAL_BASE_DIR, DS], [NULL, '/'], $path);
}
