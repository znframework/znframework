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

class Regex
{
    /**
     * Keeps Regular Expression Chars
     * 
     * @var array
     */
    protected $regexChars =
    [
        # Patterns For Routes
        ':numeric'                      => '(\d+$)',
        ':id'                           => '(\d+$)',
        ':alnum'                        => '(\w+$)',
        ':alpha'                        => '([a-zA-Z]+$)',
        ':all'                          => '(.+)',
        ':seo'                          => '((\w+|\-)+$)',

        # Standart
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

    /**
     * Keeps settings char
     * 
     * @var array
     */
    protected $settingChars =
    [
        '{insens}'    => 'i',
        '{generic}'   => 'g',
        '{each}'      => 's',
        '{multiline}' => 'm',
        '{inspace}'   => 'x'
    ];

    /**
     * Keeps special chars
     * 
     * @var array
     */
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

    /**
     * Magic Constructor
     */
    public function __construct()
    {
        $this->regexChars = array_merge(Config::get('Expressions', 'regex'), $this->regexChars);
    }

    /**
     * Special to classic pattern
     * 
     * @param string $pattern
     * @param string $ex        = NULL
     * @param string $delimiter = '/'
     * 
     * @return string
     */
    public function special2classic(String $pattern, String $ex = NULL, String $delimiter = '/') : String
    {
        return (string) $this->_regularConverting($pattern, $ex, $delimiter);
    }

    /**
     * Classic to special pattern
     * 
     * @param string $pattern
     * @param string $delimiter = '/'
     * 
     * @return string
     */
    public function classic2special(String $pattern, String $delimiter = '/') : String
    {
        $specialChars = $this->specialChars;
        $regexChars   = Datatype::multikey($this->regexChars);
        $settingChars = Datatype::multikey($this->settingChars);
        $pattern      = str_ireplace(array_values($regexChars  ), array_keys($regexChars  ), $pattern);
        $pattern      = str_ireplace(array_values($specialChars), array_keys($specialChars), $pattern);

        return rtrim(ltrim($pattern, $delimiter), $delimiter);
    }

    /**
     * Special to classic pattern
     * 
     * @param string $pattern
     * @param string $str
     * @param string $ex        = NULL
     * @param string $delimiter = '/'
     * 
     * @return array
     */
    public function match(String $pattern, String $str, String $ex = NULL, String $delimiter = '/') : Array
    {
        $pattern = $this->_regularConverting($pattern, $ex, $delimiter);

        preg_match($pattern, $str , $return);

        return $return;
    }

    /**
     * Match All
     * 
     * @param string $pattern
     * @param string $str
     * @param string $ex        = NULL
     * @param string $delimiter = '/'
     * 
     * @return array
     */
    public function matchAll(String $pattern, String $str, String $ex = NULL, String $delimiter = '/') : Array
    {
        $pattern = $this->_regularConverting($pattern, $ex, $delimiter);

        preg_match_all($pattern, $str , $return);

        return $return;
    }

    /**
     * Replace
     * 
     * @param string $pattern
     * @param string $str
     * @param string $ex        = NULL
     * @param string $delimiter = '/'
     * 
     * @return array
     */
    public function replace(String $pattern, String $rep, String $str, String $ex = NULL, String $delimiter = '/')
    {
        $pattern = $this->_regularConverting($pattern, $ex, $delimiter);

        return preg_replace($pattern, $rep, $str);
    }

    /**
     * Group
     * 
     * @param string $str
     * 
     * @return string
     */
    public function group(String $str) : String
    {
        return "(".$str.")";
    }

    /**
     * Recount
     * 
     * @param string $str
     * 
     * @return string
     */
    public function recount(String $str) : String
    {
        return "{".$str."}";
    }

    /**
     * To
     * 
     * @param string $str
     * 
     * @return string
     */
    public function to(String $str) : String
    {
        return "[".$str."]";
    }

    /**
     * Preg Quote
     * 
     * @param string $data
     * @param string $delimiter = NULL
     * 
     * @return string
     */
    public function quote(String $data, String $delimiter = NULL) : String
    {
        return preg_quote($data, $delimiter);
    }

    /**
     * Protected Regular Coverting
     */
    protected function _regularConverting($pattern, $ex, $delimiter)
    {
        $specialChars = $this->specialChars;

        $pattern = str_ireplace(array_keys($specialChars), array_values($specialChars), $pattern);

        $regexChars   = Datatype::multikey($this->regexChars);
        $settingChars = Datatype::multikey($this->settingChars);

        $pattern = str_ireplace(array_keys($regexChars), array_values($regexChars), $pattern);

        if( ! empty($ex) )
        {
            $ex = str_ireplace(array_keys($settingChars), array_values($settingChars), $ex);
        }

        return Base::presuffix($pattern, $delimiter).$ex;
    }
}
