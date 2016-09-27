<?php namespace ZN\DataTypes;

use Arrays, CLController;

class InternalRegex extends CLController implements InternalRegexInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    const config = 'Regex';

    //--------------------------------------------------------------------------------------------------------
    // Match
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $pattern
    // @param string $str
    // @param string $ex
    // @param string $delimiter
    //
    //--------------------------------------------------------------------------------------------------------
    public function match(String $pattern, String $str, String $ex = NULL, String $delimiter = '/') : Array
    {
        $pattern = $this->_regularConverting($pattern, $ex, $delimiter);

        preg_match($pattern, $str , $return);

        return $return;
    }

    //--------------------------------------------------------------------------------------------------------
    // Match All
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $pattern
    // @param string $str
    // @param string $ex
    // @param string $delimiter
    //
    //--------------------------------------------------------------------------------------------------------
    public function matchAll(String $pattern, String $str, String $ex = NULL, String $delimiter = '/') : Array
    {
        $pattern = $this->_regularConverting($pattern, $ex, $delimiter);

        preg_match_all($pattern, $str , $return);

        return $return;
    }

    //--------------------------------------------------------------------------------------------------------
    // Replace
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $pattern
    // @param string $rep
    // @param string $str
    // @param string $ex
    // @param string $delimiter
    //
    //--------------------------------------------------------------------------------------------------------
    public function replace(String $pattern, String $rep, String $str, String $ex = NULL, String $delimiter = '/')
    {
        $pattern = $this->_regularConverting($pattern, $ex, $delimiter);

        return preg_replace($pattern, $rep, $str);
    }

    //--------------------------------------------------------------------------------------------------------
    // Group
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public function group(String $str) : String
    {
        return "(".$str.")";
    }

    //--------------------------------------------------------------------------------------------------------
    // Recount
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public function recount(String $str) : String
    {
        return "{".$str."}";
    }

    //--------------------------------------------------------------------------------------------------------
    // To
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public function to(String $str) : String
    {
        return "[".$str."]";
    }

    //--------------------------------------------------------------------------------------------------------
    // Quote
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    // @param string $delimiter
    //
    //--------------------------------------------------------------------------------------------------------
    public function quote(String $data, String $delimiter = NULL) : String
    {
        return preg_quote($data, $delimiter);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Regular Converting
    //--------------------------------------------------------------------------------------------------------
    protected function _regularConverting($pattern, $ex, $delimiter)
    {

        $specialChars = REGEX_CONFIG['specialChars'];

        $pattern = str_ireplace(array_keys($specialChars ), array_values($specialChars), $pattern);

        // Config/Regex.php dosyasından düzenlenmiş karakter
        // listeleri alınıyor.
        $regexChars   = Arrays::multikey(REGEX_CONFIG['regexChars']);

        $settingChars = Arrays::multikey(REGEX_CONFIG['settingChars']);
        // --------------------------------------------------------------------------------------------

        $pattern = str_ireplace(array_keys($regexChars), array_values($regexChars), $pattern);

        if( ! empty($ex) )
        {
            $ex = str_ireplace(array_keys($settingChars), array_values($settingChars), $ex);
        }

        return presuffix($pattern, $delimiter).$ex;
    }
}
