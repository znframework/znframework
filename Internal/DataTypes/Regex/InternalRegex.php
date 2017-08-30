<?php namespace ZN\DataTypes;

use Arrays, Config;

class InternalRegex implements InternalRegexInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Regex Chars
    //--------------------------------------------------------------------------------------------------------
    //
    // Genel Kullanımı: Düzenli ifadelerde yer alan özel karakterlerle ilgili aşağıdaki
    // değişiklikler yapılmıştır.
    //
    //--------------------------------------------------------------------------------------------------------
    protected $regexChars =
    [
        // Patterns For Routes
        ':numeric'                      => '(\d+$)',
        ':id'                           => '(\d+$)',
        ':alnum'                        => '(\w+$)',
        ':alpha'                        => '([a-zA-Z]+$)',
        ':all'                          => '(.+)',
        ':seo'                          => '((\w+|\-)+$)',

        '{nonWord}'                     => '\W+',
        '{word}'                        => '\w+',
        '{nonNumeric}'                  => '\D',
        '{numeric}|{num}'               => '\d',
        '{schar}|{specialChar}'         => '\W',
        '{nonSchar}|{nonSpecialChar}'   => '\w',
        '{alpha}'                       => '[a-zA-Z]+',
        '{alnum}'                       => '[a-zA-Z0-9]+',
        '{number}'                      => '[0-9]+',
        '{char}|{any}'                  => '.',
        '{nonSpace}'                    => '\S',
        '{space}'                       => '\s',
        '{starting}|{start}'            => '^',
        '{ending}|{end}'                => '$',
        '{repeatZ}|{iterate}'           => '*',
        '{repeat}'                      => '+',
        '{whether}'                     => '?',
        '{or}'                          => '|',
        '{eolR}|{lr}|{cf}'              => '\r',
        '{eolN}|{ln}|{lf}'              => '\n',
        '{eol}|{crlf}|{lrln}'           => '\r\n',
        '{lnlr}'                        => '\n\r',
        '{tab}|{lt}|{ht}'               => '\t',
        '{esc}|{le}'                    => '\e',
        '{hex}|{lx}'                    => '\x'
    ];

    //--------------------------------------------------------------------------------------------------------
    // Setting Chars
    //--------------------------------------------------------------------------------------------------------
    //
    // Genel Kullanımı: Düzenli ifadelerde oluşturulan desen sonuna konulan karakterlerle
    // ilgili aşağıdaki değişiklikler yapılmıştır
    //
    //--------------------------------------------------------------------------------------------------------
    protected $settingChars =
    [
        '{insens}'    => 'i',
        '{generic}'   => 'g',
        '{each}'      => 's',
        '{multiline}' => 'm',
        '{inspace}'   => 'x'
    ];

    //--------------------------------------------------------------------------------------------------------
    // Special Chars
    //--------------------------------------------------------------------------------------------------------
    //
    // Genel Kullanımı: Düzenli ifadelerde yer alan özel karakterleri normal karakterler gibi
    // kullanmak için aşağıdaki değişiklikler yapılmıştır.
    //
    //--------------------------------------------------------------------------------------------------------
    protected $specialChars =
    [
        '.' => '\.',
        '^' => '\^',
        '$' => '\$',
        '*' => '\*',
        '+' => '\+',
        '?' => '\?',
        '|' => '\|',
        '/' => '\/'
    ];

    public function __construct()
    {
        $this->regexChars = array_merge(Config::get('Expressions', 'regex'), $this->regexChars);
    }

    //--------------------------------------------------------------------------------------------------------
    // Special 2 Classic -> 4.3.2
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $pattern
    // @param string $ex
    // @param string $delimiter
    //
    //--------------------------------------------------------------------------------------------------------
    public function special2classic(String $pattern, String $ex = NULL, String $delimiter = '/') : String
    {
        return (string) $this->_regularConverting($pattern, $ex, $delimiter);
    }

    //--------------------------------------------------------------------------------------------------------
    // Classic 2 Special -> 4.3.2
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $pattern
    // @param string $ex
    // @param string $delimiter
    //
    //--------------------------------------------------------------------------------------------------------
    public function classic2special(String $pattern, String $delimiter = '/') : String
    {
        $specialChars = $this->specialChars;
        $regexChars   = Arrays::multikey($this->regexChars);
        $settingChars = Arrays::multikey($this->settingChars);
        $pattern      = str_ireplace(array_values($regexChars), array_keys($regexChars), $pattern);
        $pattern      = str_ireplace(array_values($specialChars), array_keys($specialChars), $pattern);

        return rtrim(ltrim($pattern, $delimiter), $delimiter);
    }

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
        $specialChars = $this->specialChars;

        $pattern = str_ireplace(array_keys($specialChars), array_values($specialChars), $pattern);

        $regexChars   = Arrays::multikey($this->regexChars);
        $settingChars = Arrays::multikey($this->settingChars);

        $pattern = str_ireplace(array_keys($regexChars), array_values($regexChars), $pattern);

        if( ! empty($ex) )
        {
            $ex = str_ireplace(array_keys($settingChars), array_values($settingChars), $ex);
        }

        return presuffix($pattern, $delimiter).$ex;
    }
}
