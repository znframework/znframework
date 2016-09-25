<?php namespace ZN\DataTypes\Strings;

use Strings, Converter;

class Casing implements CasingInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Casing
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param string $type lower, upper, title
    // @param string $encoding
    //
    //--------------------------------------------------------------------------------------------------------
    public function use(String $str, String $type = 'lower', String $encoding = 'utf-8') : String
    {
        return mb_convert_case($str, Converter::toConstant($type, 'MB_CASE_'), $encoding);
    }

    //--------------------------------------------------------------------------------------------------------
    // Upper Case
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param string $encoding
    //
    //--------------------------------------------------------------------------------------------------------
    public function upper(String $str, String $encoding = 'utf-8') : String
    {
        return $this->use($str, __FUNCTION__, $encoding);
    }

    //--------------------------------------------------------------------------------------------------------
    // Lower Case
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param string $encoding
    //
    //--------------------------------------------------------------------------------------------------------
    public function lower(String $str, String $encoding = 'utf-8') : String
    {
        return $this->use($str, __FUNCTION__, $encoding);
    }

    //--------------------------------------------------------------------------------------------------------
    // Title Case
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param string $encoding
    //
    //--------------------------------------------------------------------------------------------------------
    public function title(String $str, String $encoding = 'utf-8') : String
    {
        return $this->use($str, __FUNCTION__, $encoding);
    }

    //--------------------------------------------------------------------------------------------------------
    // Camel Case
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public function camel(String $str) : String
    {
        $string = $this->title($str);

        $string[0] = $this->lower($string);

        return Strings::mtrim($string);
    }

    //--------------------------------------------------------------------------------------------------------
    // Pascal Case
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public function pascal(String $str) : String
    {
        $string = $this->title($str);

        return Strings::mtrim($string);
    }
}