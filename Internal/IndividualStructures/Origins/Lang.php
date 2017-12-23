<?php namespace ZN\IndividualStructures;

use ZN\In;

class Lang implements LangInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    protected static $shortCodes =
    [
        'ad' => 'Catalan',
        'ae' => 'Arabic',
        'af' => 'Persian',
        'ag' => 'English',
        'ai' => 'English',
        'al' => 'Albanian',
        'am' => 'Armenian',
        'an' => 'Dutch',
        'ao' => 'Kongo',
        'ar' => 'Welsh',
        'as' => 'Samoan',
        'at' => 'German',
        'au' => 'English',
        'aw' => 'Dutch',
        'ax' => 'Swedish',
        'az' => 'Azerbaijani',
        'ba' => 'Bosnian',
        'bb' => 'English',
        'bd' => 'Bengali',
        'be' => 'German',
        'bf' => 'Bambara',
        'bg' => 'Bulgarian',
        'bh' => 'Arabic',
        'bi' => 'Rundi',
        'bj' => 'French',
        'bm' => 'English',
        'bn' => 'English',
        'bo' => 'Aymara',
        'br' => 'Portuguese',
        'bs' => 'English',
        'bt' => 'Dzongkha',
        'bw' => 'English',
        'by' => 'Belarusian',
        'bz' => 'English',
        'ca' => 'English',
        'cc' => 'Malay',
        'cd' => 'French',
        'cf' => 'French',
        'cg' => 'Kongo',
        'ch' => 'German',
        'ci' => 'Akan',
        'ck' => 'English',
        'cl' => 'Aymara',
        'cm' => 'English',
        'cn' => 'Chinese',
        'zn' => 'Chinese',
        'co' => 'Spanish',
        'cr' => 'Spanish',
        'rs' => 'Serbian',
        'cu' => 'Spanish',
        'cv' => 'Portuguese',
        'cx' => 'Malay',
        'cy' => 'Greek',
        'cz' => 'Czech',
        'de' => 'Danish',
        'dj' => 'Afar',
        'dk' => 'Danish',
        'en' => 'English',
        'do' => 'Spanish',
        'dz' => 'Arabic',
        'ec' => 'Spanish',
        'ee' => 'Estonian',
        'eg' => 'Arabic',
        'er' => 'Afar',
        'es' => 'Spanish',
        'et' => 'Afar',
        'fi' => 'Finnish',
        'fj' => 'Fijian',
        'fk' => 'English',
        'fm' => 'English',
        'fo' => 'Faroese',
        'fr' => 'French',
        'ga' => 'French',
        'gb' => 'English',
        'gd' => 'English',
        'ge' => 'Georgian',
        'gf' => 'French',
        'gh' => 'Akan',
        'gi' => 'English',
        'gl' => 'Danish',
        'gm' => 'Bambara',
        'gn' => 'French',
        'gp' => 'French',
        'gq' => 'Spanish',
        'gr' => 'Greek',
        'gt' => 'Spanish',
        'gu' => 'Chamorro',
        'gw' => 'Portuguese',
        'gy' => 'English',
        'hk' => 'Chinese',
        'hn' => 'Spanish',
        'hr' => 'Croatian',
        'ht' => 'Haitian',
        'hu' => 'Hungarian',
        'id' => 'Indonesian',
        'ie' => 'Irish',
        'il' => 'Yiddish',
        'in' => 'Hindi',
        'io' => 'English',
        'iq' => 'Arabic',
        'ir' => 'Persian',
        'is' => 'Icelandic',
        'it' => 'Italian',
        'jm' => 'English',
        'jo' => 'Arabic',
        'jp' => 'Japanese',
        'ja' => 'Japanese',
        'ke' => 'English',
        'kg' => 'Kirghiz',
        'kh' => 'Khmer',
        'ki' => 'English',
        'km' => 'French',
        'kn' => 'English',
        'kp' => 'Korean',
        'ko' => 'Korean',
        'kr' => 'Korean',
        'kw' => 'Arabic',
        'ky' => 'English',
        'kz' => 'Kazakh',
        'la' => 'Lao',
        'lb' => 'Arabic',
        'lc' => 'English',
        'li' => 'German',
        'lk' => 'Sinhala',
        'lr' => 'English',
        'ls' => 'English',
        'lt' => 'Lithuanian',
        'lu' => 'Luxembourgish',
        'lv' => 'Latvian',
        'ly' => 'Arabic',
        'ma' => 'Arabic',
        'mc' => 'French',
        'md' => 'Moldavian',
        'mg' => 'Malagasy',
        'mh' => 'Marshallese',
        'mk' => 'Macedonian',
        'ml' => 'Bambara',
        'mm' => 'Burmese',
        'mn' => 'Mongolian',
        'mp' => 'Chamorro',
        'mq' => 'French',
        'mr' => 'Arabic',
        'ms' => 'English',
        'mt' => 'Maltese',
        'mu' => 'English',
        'mv' => 'Divehi',
        'mw' => 'Chichewa',
        'mx' => 'Spanish',
        'my' => 'Malay',
        'mz' => 'Portuguese',
        'na' => 'Ndonga',
        'nc' => 'French',
        'ne' => 'French',
        'nf' => 'English',
        'ng' => 'English',
        'ni' => 'Spanish',
        'nl' => 'Dutch',
        'no' => 'Norwegian',
        'np' => 'Nepali',
        'nr' => 'Nauru',
        'nu' => 'English',
        'nz' => 'English',
        'om' => 'Arabic',
        'pa' => 'Spanish',
        'pe' => 'Spanish',
        'pf' => 'French',
        'pg' => 'English',
        'ph' => 'English',
        'pk' => 'Sindhi',
        'pl' => 'Polish',
        'pm' => 'French',
        'pn' => 'English',
        'pr' => 'English',
        'ps' => 'Arabic',
        'pt' => 'Portuguese',
        'pw' => 'English',
        'py' => 'Spanish',
        'qa' => 'Arabic',
        're' => 'French',
        'ru' => 'Russian',
        'rw' => 'Kinyarwanda',
        'sa' => 'Arabic',
        'sb' => 'English',
        'sc' => 'English',
        'sd' => 'Arabic',
        'se' => 'Swedish',
        'sg' => 'Bengali',
        'sh' => 'English',
        'si' => 'Hungarian',
        'sk' => 'Slovak',
        'sl' => 'English',
        'sm' => 'Italian',
        'sn' => 'Fulah',
        'so' => 'Somali',
        'sr' => 'Javanese',
        'st' => 'Portuguese',
        'sv' => 'Spanish',
        'sy' => 'Syriac',
        'sz' => 'English',
        'tc' => 'English',
        'td' => 'Arabic',
        'tg' => 'Ewe',
        'th' => 'Thai',
        'tj' => 'Tajik',
        'tk' => 'English',
        'tl' => 'Portuguese',
        'tm' => 'Turkmen',
        'tn' => 'Arabic',
        'to' => 'Tongan',
        'tr' => 'Turkish',
        'tt' => 'English',
        'tv' => 'Tuvalu',
        'tw' => 'Chinese',
        'tz' => 'Swahili',
        'ua' => 'Ukrainian',
        'ug' => 'Ganda',
        'um' => 'English',
        'us' => 'English',
        'uy' => 'Spanish',
        'uz' => 'Uzbek',
        'va' => 'French',
        'vc' => 'English',
        've' => 'Spanish',
        'vg' => 'English',
        'vi' => 'English',
        'vn' => 'Vietnamese',
        'vu' => 'English',
        'wf' => 'French',
        'ws' => 'Samoan',
        'ye' => 'Arabic',
        'yt' => 'French',
        'za' => 'Afrikaans',
        'zm' => 'English',
        'zw' => 'English'
    ];

    //--------------------------------------------------------------------------------------------------
    // __callStatic()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $method
    // @param array  $parameters;
    //
    //--------------------------------------------------------------------------------------------------
    public function __call($method, $parameters)
    {
        $method = ucfirst($method);

        return self::select($method, ...$parameters);
    }

    //--------------------------------------------------------------------------------------------------
    // shortCodes
    //--------------------------------------------------------------------------------------------------
    //
    // @param $code = NULL
    //
    // @return Mixed
    //
    //--------------------------------------------------------------------------------------------------
    public static function shortCodes(String $code = NULL)
    {
        if( $code === NULL )
        {
            return self::$shortCodes;
        }

        return self::$shortCodes[$code] ?? 'English';
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
    public static function current() : String
    {
        if( ! \Config::get('Services','uri')['lang'] )
        {
            return false;
        }
        else
        {
            return self::get();
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
    public static function select(String $file = NULL, String $str = NULL, $changed = NULL)
    {
        global $lang;

        $file          = ( self::$shortCodes[self::get()] ?? 'English').'/'.suffix($file, '.php');
        $langDir       = LANGUAGES_DIR.$file;
        $commonLangDir = EXTERNAL_LANGUAGES_DIR.$file;

        if( is_file($langDir) && ! IS::import($langDir) )
        {
            $lang[$file] = import($langDir);
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
    public static function set(String $l = NULL) : Bool
    {
        if( empty($l) )
        {
            $l = \Config::get('Language', 'default');
        }

        return \Session::insert(In::defaultProjectKey('SystemLanguageData'), $l);
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
    public static function get() : String
    {
        $systemLanguageData        = In::defaultProjectKey('SystemLanguageData');
        $defaultSystemLanguageData = In::defaultProjectKey('DefaultSystemLanguageData');

        $default = \Config::get('Language', 'default');

        if( ! \Session::select($defaultSystemLanguageData) )
        {
            \Session::insert($defaultSystemLanguageData, $default);
        }
        else
        {
            if( \Session::select($defaultSystemLanguageData) !== $default )
            {
                \Session::insert($defaultSystemLanguageData, $default);
                \Session::insert($systemLanguageData, $default);

                return $default;
            }
        }

        if( \Session::select($systemLanguageData) === false )
        {
            \Session::insert($systemLanguageData, $default);

            return $default;
        }
        else
        {
            return \Session::select($systemLanguageData);
        }
    }
}
