<?php namespace ZN\IndividualStructures;

use ZN\In, Config, Session, IS;

class InternalLang implements InternalLangInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------
    // currentLang()
    //--------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------
    function current() : String
    {
        if( ! Config::get('Services','uri')['lang'] )
        {
            return false;
        }
        else
        {
            return $this->get();
        }
    }

    //--------------------------------------------------------------------------------------------------
    // select()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $file
    // @param string $str
    // @param mixed  $changed
    //
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------
    function select(String $file = NULL, String $str = NULL, $changed = NULL)
    {
        global $lang;

        $file          = ( Config::get('Language', 'shortCodes')[$this->get()] ?? 'English').'/'.suffix($file, '.php');
        $langDir       = LANGUAGES_DIR.$file;
        $sysLangDir    = INTERNAL_LANGUAGES_DIR.$file;
        $commonLangDir = EXTERNAL_LANGUAGES_DIR.$file;

        if( is_file($langDir) && ! IS::import($langDir) )
        {
            $lang[$file] = import($langDir);
        }
        elseif( is_file($sysLangDir) && ! IS::import($sysLangDir) )
        {
            $lang[$file] = import($sysLangDir);
        }
        elseif( is_file($commonLangDir) && ! IS::import($commonLangDir) )
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
    // setLang()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $l
    //
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------
    function set(String $l = NULL) : Bool
    {
        if( empty($l) )
        {
            $l = Config::get('Language', 'default');
        }

        return Session::insert(In::defaultProjectKey('SystemLanguageData'), $l);
    }


    //--------------------------------------------------------------------------------------------------
    // getLang()
    //--------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------
    public function get() : String
    {
        $systemLanguageData        = In::defaultProjectKey('SystemLanguageData');
        $defaultSystemLanguageData = In::defaultProjectKey('DefaultSystemLanguageData');

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
}
