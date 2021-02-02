<?php namespace ZN\Helpers;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use stdClass;
use ZN\Base;
use ZN\Helper;
use ZN\Config;
use ZN\Datatype;
use ZN\Singleton;
use ZN\Filesystem;
use ZN\Helpers\Exception\LogicException;
use ZN\Helpers\Exception\InvalidArgumentException;

class Converter
{   
    /**
     * Keeps Accent Chars
     * 
     * @var array
     */
    public static $accentChars =
    [
        'ä|æ|ǽ'                                                         => 'ae',
        'œ'                                                             => 'oe',
        'Ä'                                                             => 'Ae',
        'À|Á|Â|Ã|Ä|Å|Ǻ|Ā|Ă|Ą|Ǎ|Α|Ά|Ả|Ạ|Ầ|Ẫ|Ẩ|Ậ|Ằ|Ắ|Ẵ|Ẳ|Ặ|А'             => 'A',
        'à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª|α|ά|ả|ạ|ầ|ấ|ẫ|ẩ|ậ|ằ|ắ|ẵ|ẳ|ặ|а'           => 'a',
        'Б'                                                             => 'B',
        'б'                                                             => 'b',
        'Ç|Ć|Ĉ|Ċ|Č'                                                     => 'C',
        'ç|ć|ĉ|ċ|č'                                                     => 'c',
        'Д'                                                             => 'D',
        'д'                                                             => 'd',
        'Ð|Ď|Đ|Δ'                                                       => 'Dj',
        'ð|ď|đ|δ'                                                       => 'dj',
        'È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě|Ε|Έ|Ẽ|Ẻ|Ẹ|Ề|Ế|Ễ|Ể|Ệ|Е|Э'                     => 'E',
        'è|é|ê|ë|ē|ĕ|ė|ę|ě|έ|ε|ẽ|ẻ|ẹ|ề|ế|ễ|ể|ệ|е|э'                     => 'e',
        'Ф'                                                             => 'F',
        'ф'                                                             => 'f',
        'Ĝ|Ğ|Ġ|Ģ|Γ|Г|Ґ'                                                 => 'G',
        'ĝ|ğ|ġ|ģ|γ|г|ґ'                                                 => 'g',
        'Ĥ|Ħ'                                                           => 'H',
        'ĥ|ħ'                                                           => 'h',
        'Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ|Η|Ή|Ί|Ι|Ϊ|Ỉ|Ị|И|Ы'                         => 'I',
        'ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı|η|ή|ί|ι|ϊ|ỉ|ị|и|ы|ї'                       => 'i',
        'Ĵ'                                                             => 'J',
        'ĵ'                                                             => 'j',
        'Ķ|Κ|К'                                                         => 'K',
        'ķ|κ|к'                                                         => 'k',
        'Ĺ|Ļ|Ľ|Ŀ|Ł|Λ|Л'                                                 => 'L',
        'ĺ|ļ|ľ|ŀ|ł|λ|л'                                                 => 'l',
        'М'                                                             => 'M',
        'м'                                                             => 'm',
        'Ñ|Ń|Ņ|Ň|Ν|Н'                                                   => 'N',
        'ñ|ń|ņ|ň|ŉ|ν|н'                                                 => 'n',
        'Ö|Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ|Ο|Ό|Ω|Ώ|Ỏ|Ọ|Ồ|Ố|Ỗ|Ổ|Ộ|Ờ|Ớ|Ỡ|Ở|Ợ|О'     => 'O',
        'ö|ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º|ο|ό|ω|ώ|ỏ|ọ|ồ|ố|ỗ|ổ|ộ|ờ|ớ|ỡ|ở|ợ|о'   => 'o',
        'П'                                                             => 'P',
        'п'                                                             => 'p',
        'Ŕ|Ŗ|Ř|Ρ|Р'                                                     => 'R',
        'ŕ|ŗ|ř|ρ|р'                                                     => 'r',
        'Ś|Ŝ|Ş|Ș|Š|Σ|С'                                                 => 'S',
        'ś|ŝ|ş|ș|š|ſ|σ|ς|с'                                             => 's',
        'Ț|Ţ|Ť|Ŧ|τ|Т'                                                   => 'T',
        'ț|ţ|ť|ŧ|т'                                                         => 't',
        'Ü|Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ|Ũ|Ủ|Ụ|Ừ|Ứ|Ữ|Ử|Ự|У'             => 'U',
        'ü|ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ|υ|ύ|ϋ|ủ|ụ|ừ|ứ|ữ|ử|ự|у'         => 'u',
        'Ý|Ÿ|Ŷ|Υ|Ύ|Ϋ|Ỳ|Ỹ|Ỷ|Ỵ|Й'                                         => 'Y',
        'ý|ÿ|ŷ|ỳ|ỹ|ỷ|ỵ|й'                                               => 'y',
        'В'                                                             => 'V',
        'в'                                                             => 'v',
        'Ŵ'                                                             => 'W',
        'ŵ'                                                             => 'w',
        'Ź|Ż|Ž|Ζ|З'                                                     => 'Z',
        'ź|ż|ž|ζ|з'                                                     => 'z',
        'Æ|Ǽ'                                                           => 'AE',
        'ß'                                                             => 'ss',
        'Ĳ'                                                             => 'IJ',
        'ĳ'                                                                 => 'ij',
        'Œ'                                                             => 'OE',
        'ƒ'                                                             => 'f',
        'ξ'                                                             => 'ks',
        'π'                                                             => 'p',
        'β'                                                             => 'v',
        'μ'                                                             => 'm',
        'ψ'                                                             => 'ps',
        'Ё'                                                             => 'Yo',
        'ё'                                                             => 'yo',
        'Є'                                                             => 'Ye',
        'є'                                                             => 'ye',
        'Ї'                                                             => 'Yi',
        'Ж'                                                             => 'Zh',
        'ж'                                                             => 'zh',
        'Х'                                                             => 'Kh',
        'х'                                                             => 'kh',
        'Ц'                                                             => 'Ts',
        'ц'                                                             => 'ts',
        'Ч'                                                             => 'Ch',
        'ч'                                                             => 'ch',
        'Ш'                                                             => 'Sh',
        'ш'                                                             => 'sh',
        'Щ'                                                             => 'Shch',
        'щ'                                                             => 'shch',
        'Ъ|ъ|Ь|ь'                                                       => '',
        'Ю'                                                             => 'Yu',
        'ю'                                                             => 'yu',
        'Я'                                                             => 'Ya',
        'я'                                                             => 'ya'
    ];

    /**
     * Convert string to bytes.
     * 
     * @param string $data
     * 
     * @return float
     */
    public static function toBytes(String $data) : Float
    {
        $number = substr($data, 0, -2);

        switch( strtoupper(substr($data, -2)) )
        {
            case 'KB': return $number * 1024;
            case 'MB': return $number * pow(1024, 2);
            case 'GB': return $number * pow(1024, 3);
            case 'TB': return $number * pow(1024, 4);
            case 'PB': return $number * pow(1024, 5);

            default  : return $data;
        }
    }

    /**
     * Calculate byte
     * 
     * @param float  $bytes
     * @param int    $precision = 1
     * @param bool   $unit      = true
     * @param string $fix      = ''
     * 
     * @return string
     */
    public static function byte(Float $bytes, Int $precision = 1, Bool $unit = true, String $fix = '') : String
    {
        $byte   = 1024;
        $kb     = 1024 * $byte;
        $mb     = 1024 * $kb;
        $gb     = 1024 * $mb;
        $tb     = 1024 * $gb;
        $pb     = 1024 * $tb;
        $eb     = 1024 * $pb;

        if( $bytes <= $byte && $bytes > -1 )
        {
            $un     = 'B';
            $return = $bytes;
        }
        elseif( $bytes <= $kb && $bytes > $byte )
        {
            $un     = 'KB';
            $return = round(($bytes / $byte),$precision);
        }
        elseif( $bytes <= $mb && $bytes > $kb )
        {
            $un     = 'MB';
            $return = round(($bytes / $kb),$precision);
        }
        elseif( $bytes <= $gb && $bytes > $mb )
        {
            $un     = 'GB';
            $return = round(($bytes / $mb),$precision);
        }
        elseif( $bytes <= $tb && $bytes > $gb )
        {
            $un     = 'TB';
            $return = round(($bytes / $gb),$precision);
        }
        elseif( $bytes <= $pb && $bytes > $tb )
        {
            $un     = 'PB';
            $return = round(($bytes / $tb),$precision);
        }
        elseif( $bytes <= $eb && $bytes > $pb )
        {
            $un     = 'EB';
            $return = round(($bytes / $pb),$precision);
        }
        else
        {
            $un     = 'B';
            $return = str_replace(",", ".", number_format($bytes));
        }

        return $return . ( ! empty($unit) ? $fix . $un : NULL );
    }

    /**
     * Convert Money
     * 
     * @param float  $money = 0
     * @param string $type  = NULL
     * @param bool   $float = true 
     * 
     * @return string
     */
    public static function money(Float $money = 0, String $type = NULL, Bool $float = true) : String
    {
        $moneyFormat = '';
        $money       = round($money, 2);
        $strEx      = explode(".",$money);
        $join        = [];
        $str         = strrev($strEx[0]);

        for( $i = 0; $i < strlen($str); $i++ )
        {
            if( $i%3 === 0 )
            {
                array_unshift($join, '.');
            }

            array_unshift($join, $str[$i]);
        }

        for( $i = 0; $i < count($join); $i++ )
        {
            $moneyFormat .= $join[$i];
        }

        # 5.3.9[added]
        if( ($type[0] ?? NULL) === '!' )
        {
            $left  = ltrim($type, '!') . ' ';
            $right = NULL;
        }
        else
        {
            $right = ' ' . $type;
            $left  = NULL;
        }

        $remaining = $strEx[1] ?? '00';

        if( strlen($remaining) === 1 )
        {
            $remaining .= '0';
        }

        $moneyFormat = $left . substr($moneyFormat,0,-1).($float === true ? ','.$remaining : '') . $right;

        return $moneyFormat;
    }

    /**
     * Money to Number
     * 
     * @param string|int
     * 
     * @return float
     */
    public static function moneyToNumber($money) : Float
    {
        return str_replace('.', NULL, Datatype::divide($money, ','));
    }

    /**
     * Convert time
     * 
     * @param int    $count
     * @param string $type   = 'second'
     * @param string $output = 'day'
     * 
     * @return float
     */
    public static function time(Int $count, String $type = 'second', String $output = 'day') : Float
    {
        switch( Base::removeSuffix($output, 's') )
        {
            case 'second': $out = 1;                                 break;
            case 'minute': $out = 60;                                break;
            case 'hour'  : $out = 60 * 60;                           break;
            case 'day'   : $out = 60 * 60 * 24;                      break;
            case 'week'  : $out = 60 * 60 * 24 * 7;                  break;
            case 'month' : $out = 60 * 60 * 24 * 30;                 break;
            case 'year'  : $out = 60 * 60 * 24 * 30 * 12;            break;
        }

        switch( Base::removeSuffix($type, 's') )
        {
            case 'second': $time = $count;                           break;
            case 'minute': $time = 60 * $count;                      break;
            case 'hour'  : $time = 60 * 60 * $count;                 break;
            case 'day'   : $time = 60 * 60 * 24 * $count;            break;
            case 'week'  : $time = 60 * 60 * 24 * 7  * $count;       break;
            case 'month' : $time = 60 * 60 * 24 * 30 * $count;       break;
            case 'year'  : $time = 60 * 60 * 24 * 30 * 12 * $count;  break;
        }

        return $time / $out;
    }

    /**
     * Convert word
     * 
     * @param string $string
     * @param mixed  $badWords   = NULL
     * @param mixed  $changeChar = '[badwords]'
     * 
     * @return string
     */
    public static function word(String $string, $badWords = NULL, $changeChar = '[badwords]') : String
    {
        return str_ireplace($badWords, $changeChar, $string);
    }

    /**
     * Creates anchor
     * 
     * @param string $data
     * @param string $type = 'short'
     * @param array  $attributes = NULL
     * 
     * @return string
     */
    public static function anchor(String $data, String $type = 'short', Array $attributes = NULL) : String
    {
        return preg_replace
        (
            '/(^|\s|>)(((https?|ftp)\:\/\/)(\w+\.)*(\w+)\.[^<>\s]+)/xi',
            '$1<a href="$2"'.Singleton::class('ZN\Hypertext\Html')->attributes((array) $attributes).'>'.( $type === 'short' ? '$6' : '$2').'</a>',
            $data
        );
    }

    /**
     * Convert high lightin
     * 
     * @param string $str
     * @param array  $settings
     * 
     * @return string
     */
    public static function highLight(String $str, Array $settings = []) : String
    {
        return Helper::highLight($str, $settings);
    }

    /**
     * Convert char
     * 
     * @param string $string
     * @param string $type       - options[char|dec|hex|html]
     * @param string $changeType - options[char|dec|hex|html]
     * 
     * @return string
     */
    public static function char(String $string, String $type = 'char', String $changeType = 'html') : String
    {
        $options = ['char', 'html', 'hex', 'dec'];

        if( ! in_array($type, $options) || ! in_array($changeType, $options) )
        {
            throw new InvalidArgumentException('[Converter::char()] -> Available Options: [char], [html], [hex], [dec]  For 2.($type) & 3.($changeType)!');
        }

        if( $type === $changeType )
        {
            throw new LogicException('[Converter::char()] -> 2.($type) & 3.($changeType) parameters [can not be equal]!');
        }

        $string = self::accent($string);

        if( ! is_string($type) )
        {
            $type = 'char';
        }

        if( ! is_string($changeType) )
        {
            $changeType = 'html';
        }

        for( $i = 32; $i <= 255; $i++ )
        {
            $hexRemaining = ( $i % 16 );
            $hexRemaining = str_replace( [10, 11, 12, 13, 14, 15], ['A', 'B', 'C', 'D', 'E', 'F'], $hexRemaining );
            $hex          = ( floor( $i / 16) ).$hexRemaining;

            if( $hex[0] == '0' )
            {
                $hex = $hex[1];
            }

            if( chr($i) !== ' ' )
            {
                $chars['char'][] = chr($i);
                $chars['dec'][]  = $i." ";
                $chars['hex'][]  = $hex." ";
                $chars['html'][] = "&#{$i};";
            }
        }

        return trim(str_replace( $chars[strtolower($type)], $chars[strtolower($changeType)], $string ));
    }

    /**
     * Converter Accent Char
     * 
     * [fixed]5.7.6
     * 
     * @param string $str
     * 
     * @return string
     */
    public static function accent(String $str) : String
    {
        $accent = array_merge(Config::get('Expressions', 'accentChars') ?: [], self::$accentChars);

        $accent = Datatype::multikey($accent);

        return str_replace(array_keys($accent), array_values($accent), $str);
    }

    /**
     * Convert URL word
     * 
     * @param string $str
     * 
     * @return string
     */
    public static function urlWord(String $str) : String
    {
        return self::slug($str);
    }

    /**
     * Convert slug
     * 
     * @param string $str
     * @param string $protectExtension = false
     * 
     * @return string
     */
    public static function slug(String $str, Bool $protectExtension = false) : String
    {
        if( $protectExtension === true )
        {
            $ext = Filesystem::getExtension($str, true);
            $str = Filesystem::removeExtension($str);
        }

        $str = self::accent(trim($str));

        $str = preg_replace('/\&\#*\w+\;/', '' , $str);
        $str = preg_replace("/\W/"        , '-', $str);
        $str = preg_replace("/\_/"        , '-', $str);
        $str = preg_replace('/\-+/'       , '-', $str);

        return mb_convert_case(trim($str, '-'), MB_CASE_LOWER) . ($ext ?? NULL);
    }

    /** 
     * Convert charset
     * 
     * @param string $str
     * @param string $fromCharset
     * @param string $toCharset = 'utf-8'
     * 
     * @return string
     */

    public static function charset(String $str, String $fromCharset, String $toCharset = 'utf-8') : String
    {
        return mb_convert_encoding($str, $fromCharset, $toCharset);
    }

    /**
     * Convert to string
     * 
     * @param mixed $var
     * 
     * @return string
     */
    public static function toString($var) : String
    {
        if( is_array($var) || is_object($var) )
        {
            return implode(' ', (array) $var);
        }

        return (string) $var;
    }

    /**
     * Convert to object recursive
     * 
     * @param array $var
     * 
     * @return stdClass
     */
    public static function toObjectRecursive(Array $var) : stdClass
    {
        $object = new stdClass;

        return self::objectRecursive((array) $var, $object);
    }

    /**
     * Convert to constant
     * 
     * @param string $var
     * @param string $prefix = NULL
     * @param string $suffix = NULL
     */
    public static function toConstant(String $var, String $prefix = NULL, String $suffix = NULL)
    {
        return Helper::toConstant($var, $prefix, $suffix);
    }

    /**
     * Protected Object Recursive
     */
    protected static function objectRecursive(Array $array, stdClass &$std) : stdClass
    {
        foreach( $array as $key => $value )
        {
            if( is_array($value) )
            {
                $std->$key = new stdClass;

                self::objectRecursive($value, $std->$key);
            }
            else
            {
                $std->$key = $value;
            }
        }

        return $std;
    }
}
