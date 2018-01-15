<?php namespace ZN;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

 class Lang
{
    /**
     * Keeps current language content
     * 
     * @var mixed
     */
    protected static $lang = NULL;

    /**
     * Magic call
     * 
     * @param string $method
     * @param array  $parameters
     * 
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        $method = ucfirst($method);

        return self::select($method, ...$parameters);
    }

    /**
     * Get current lang code
     * 
     * @param void
     * 
     * @return mixed
     */
    public static function current()
    {
        if( ! Config::get('Services','uri')['lang'] )
        {
            return false;
        }
        else
        {
            return self::get();
        }
    }

    /**
     * Get language content
     * 
     * @param string $file    = NULL
     * @param string $str     = NULL
     * @param mixed  $changed = NULL
     * 
     * @return mixed
     */
    public static function select(String $file = NULL, String $str = NULL, $changed = NULL)
    {
        if( ! isset(self::$lang[$file]) )
        {   
            $file          = self::get().'/'.Base::suffix($file, '.php');
            $langDir       = LANGUAGES_DIR.$file;
            $commonLangDir = EXTERNAL_LANGUAGES_DIR.$file;

            if( is_file($langDir) && ! IS::import($langDir) )
            {
                self::$lang[$file] = require $langDir;
            }
            elseif( is_file($commonLangDir) && ! IS::import($commonLangDir) )
            {
                self::$lang[$file] = require $commonLangDir;
            }
        }

        if( empty($str) && isset(self::$lang[$file]) )
        {
            return self::$lang[$file];
        }
        elseif( ! empty(self::$lang[$file][$str]) )
        {
            $langstr = self::$lang[$file][$str];
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

    /**
     * Sets language
     * 
     * @param string $l = NULL
     * 
     * @return bool
     */
    public static function set(String $l = NULL) : Bool
    {
        if( empty($l) )
        {
            $l = Config::get('Project', 'language');
        }

        return $_SESSION[In::defaultProjectKey('SystemLanguageData')] = $l;
    }

    /**
     * Get language short code
     * 
     * @return string
     */
    public static function get() : String
    {
        $systemLanguageData        = In::defaultProjectKey('SystemLanguageData');
        $defaultSystemLanguageData = In::defaultProjectKey('DefaultSystemLanguageData');

        $default = Config::get('Project', 'language');
        
        if( empty($_SESSION[$defaultSystemLanguageData]) )
        {
            $_SESSION[$defaultSystemLanguageData] = $default;
        }
        else
        {
            if( $_SESSION[$defaultSystemLanguageData] !== $default )
            {
                $_SESSION[$defaultSystemLanguageData] = $default;
                $_SESSION[$systemLanguageData]        = $default;

                return $default;
            }
        }

        if( empty($_SESSION[$systemLanguageData]) )
        {
            $_SESSION[$systemLanguageData] = $default;

            return $default;
        }
        else
        {
            return $_SESSION[$systemLanguageData];
        }
    }
}
