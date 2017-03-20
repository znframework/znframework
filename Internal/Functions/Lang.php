<?php
//--------------------------------------------------------------------------------------------------
// Lang
//--------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// getLang()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function getLang() : String
{
    $systemLanguageData        = internalDefaultProjectKey('SystemLanguageData');
    $defaultSystemLanguageData = internalDefaultProjectKey('DefaultSystemLanguageData');

    $default = Config::get('Language', 'default');

    if( ! Session::select($defaultSystemLanguageData) )
    {
        Session::insert($defaultSystemLanguageData, $default);
    }
    else
    {
        if( Session::select($defaultSystemLanguageData) !== $default )
        {
            Session::insert($defaultSystemLanguageData, $default);
            Session::insert($systemLanguageData, $default);

            return $default;
        }
    }

    if( Session::select($systemLanguageData) === false )
    {
        Session::insert($systemLanguageData, $default);

        return $default;
    }
    else
    {
        return Session::select($systemLanguageData);
    }
}

//--------------------------------------------------------------------------------------------------
// setLang()
//--------------------------------------------------------------------------------------------------
//
// @param string $l
//
// @return bool
//
//--------------------------------------------------------------------------------------------------
function setLang(String $l = NULL) : Bool
{
    if( empty($l) )
    {
        $l = Config::get('Language', 'default');
    }

    return Session::insert(internalDefaultProjectKey('SystemLanguageData'), $l);
}

//--------------------------------------------------------------------------------------------------
// lang()
//--------------------------------------------------------------------------------------------------
//
// @param string $file
// @param string $str
// @param mixed  $changed
//
// @return mixed
//
//--------------------------------------------------------------------------------------------------
function lang(String $file, String $str = NULL, $changed = NULL)
{
    global $lang;

    $file          = ( Config::get('Language', 'shortCodes')[getLang()] ?? 'English').'/'.suffix($file, '.php');
    $langDir       = LANGUAGES_DIR.$file;
    $sysLangDir    = INTERNAL_LANGUAGES_DIR.$file;
    $commonLangDir = EXTERNAL_LANGUAGES_DIR.$file;

    if( is_file($langDir) && ! isImport($langDir) )
    {
        $lang[$file] = import($langDir);
    }
    elseif( is_file($sysLangDir) && ! isImport($sysLangDir) )
    {
        $lang[$file] = import($sysLangDir);
    }
    elseif( is_file($commonLangDir) && ! isImport($commonLangDir) )
    {
        $lang[$file] = import($commonLangDir);
    }

    if( empty($str) && isset($lang[$file]) )
    {
        return $lang[$file];
    }
    elseif( ! empty($lang[$file][$str]) )
    {
        $langstr = $lang[$file][$str];
    }
    else
    {
        return false;
    }

    if( ! is_array($changed) )
    {
        if( strstr($langstr, "%") && ! empty($changed) )
        {
            return str_replace("%", $changed , $langstr);
        }
        else
        {
            return $langstr;
        }
    }
    else
    {
        if( ! empty($changed) )
        {
            $values = [];

            foreach( $changed as $key => $value )
            {
                $keys[]   = $key;
                $values[] = $value;
            }

            return str_replace($keys, $values, $langstr);
        }
        else
        {
            return $langstr;
        }
    }
}

//--------------------------------------------------------------------------------------------------
// currentLang()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function currentLang() : String
{
    if( ! Config::get('Services','uri')['lang'] )
    {
        return false;
    }
    else
    {
        return getLang();
    }
}
