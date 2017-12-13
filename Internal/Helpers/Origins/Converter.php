<?php namespace ZN\Helpers;

use ZN\DataTypes\Strings;
use ZN\IndividualStructures\Security;
use ZN\Helpers\Exception\InvalidArgumentException;
use ZN\Helpers\Exception\LogicException;
use ZN\DataTypes\Arrays;
use ZN\FileSystem\File;

class Converter
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
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

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

    //--------------------------------------------------------------------------------------------------------
    // Byte
    //--------------------------------------------------------------------------------------------------------
    //
    // @param float $bytes
    // @param int   $precision
    // @param bool  $unit
    //
    //--------------------------------------------------------------------------------------------------------
    public static function byte(Float $bytes, Int $precision = 1, Bool $unit = true) : String
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
            $un = ( ! empty($unit) )
                  ? " Bytes"
                  : "";

            $return = $bytes.$un;
        }
        elseif( $bytes <= $kb && $bytes > $byte )
        {
            $un = ( ! empty($unit) )
                  ? " KB"
                  : "";

            $return =  round(($bytes / $byte),$precision).$un;
        }
        elseif( $bytes <= $mb && $bytes > $kb )
        {
            $un = ( ! empty($unit) )
                  ? " MB"
                  : "";

            $return =  round(($bytes / $kb),$precision).$un;
        }
        elseif( $bytes <= $gb && $bytes > $mb )
        {
            $un = ( ! empty($unit) )
                  ? " GB"
                  : "";

            $return =   round(($bytes / $mb),$precision).$un;
        }
        elseif( $bytes <= $tb && $bytes > $gb )
        {
            $un = ( ! empty($unit) )
                  ? " TB"
                  : "";

            $return =   round(($bytes / $gb),$precision).$un;
        }
        elseif( $bytes <= $pb && $bytes > $tb )
        {
            $un = ( ! empty($unit) )
                  ? " PB"
                  : "";

            $return =   round(($bytes / $tb),$precision).$un;
        }
        elseif( $bytes <= $eb && $bytes > $pb )
        {
            $un = ( ! empty($unit) )
                  ? " EB"
                  : "";

            $return =   round(($bytes / $pb),$precision).$un;
        }
        else
        {
            $un = ( ! empty($unit) )
                  ? " Bytes"
                  : "";

            $return = str_replace(",", ".", number_format($bytes)).$un;
        }

        return $return;
    }

    //--------------------------------------------------------------------------------------------------------
    // Money -> 5.3.9[updated]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int    $money
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    public static function money(Int $money = 0, String $type = NULL, Bool $float = true) : String
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

        // 5.3.9 -> Added
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

    //--------------------------------------------------------------------------------------------------------
    // Money To Number -> 5.2.0
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $money
    //
    //--------------------------------------------------------------------------------------------------------
    public static function moneyToNumber($money) : Float
    {
        return str_replace('.', NULL, Strings\Split::divide($money, ','));
    }

    //--------------------------------------------------------------------------------------------------------
    // Time -> 5.3.38[edited]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int    $count
    // @param string $type
    // @param string $output
    //
    //--------------------------------------------------------------------------------------------------------
    public static function time(Int $count, String $type = 'second', String $output = 'day') : Float
    {
        if( $output === "second" ) $out = 1;
        if( $output === "minute" ) $out = 60;
        if( $output === "hour" )   $out = 60 * 60;
        if( $output === "day" )    $out = 60 * 60 * 24;
        if( $output === "week" )   $out = 60 * 60 * 24 * 7;
        if( $output === "month" )  $out = 60 * 60 * 24 * 30;
        if( $output === "year" )   $out = 60 * 60 * 24 * 30 * 12;

        if( $type === "second" )   $time = $count;
        if( $type === "minute" )   $time = 60 * $count;
        if( $type === "hour" )     $time = 60 * 60 * $count;
        if( $type === "day" )      $time = 60 * 60 * 24 * $count;
        if( $type === "week" )     $time = 60 * 60 * 24 * 7  * $count;
        if( $type === "month" )    $time = 60 * 60 * 24 * 30 * $count;
        if( $type === "year" )     $time = 60 * 60 * 24 * 30 * 12 * $count;

        return $time / $out;
    }

    //--------------------------------------------------------------------------------------------------------
    // Word
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $string
    // @param mixed  $badWords
    // @param mixed  $changeChar
    //
    //--------------------------------------------------------------------------------------------------------
    public static function word(String $string, $badWords = NULL, $changeChar = '[badwords]') : String
    {
        return str_ireplace($badWords, $changeChar, $string);
    }

    //--------------------------------------------------------------------------------------------------------
    // Anchor
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    // @param string $type: short, long
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public static function anchor(String $data, String $type = 'short', Array $attributes = NULL) : String
    {
        return preg_replace
        (
            '/(((https?|ftp)\:\/\/)(\w+\.)*(\w+)\.\w+\/*\S*)/xi',
            '<a href="$1"'.\Html::attributes((array) $attributes).'>'.( $type === 'short' ? '$5' : '$1').'</a>',
            $data
        );
    }

    //--------------------------------------------------------------------------------------------------------
    // High Light
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param array $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public static function highLight(String $str, Array $settings = []) : String
    {
        $phpFamily      = ! empty( $settings['php:family'] )    ? 'font-family:'.$settings['php:family'] : 'font-family:Consolas';
        $phpSize        = ! empty( $settings['php:size'] )      ? 'font-size:'.$settings['php:size'] : 'font-size:12px';
        $phpStyle       = ! empty( $settings['php:style'] )     ? $settings['php:style'] : '';
        $htmlFamily     = ! empty( $settings['html:family'] )   ? 'font-family:'.$settings['html:family'] : '';
        $htmlSize       = ! empty( $settings['html:size'] )     ? 'font-size:'.$settings['html:size'] : '';
        $htmlColor      = ! empty( $settings['html:color'] )    ? $settings['html:color'] : '';
        $htmlStyle      = ! empty( $settings['html:style'] )    ? $settings['html:style'] : '';
        $comment        = ! empty( $settings['comment:color'] ) ? $settings['comment:color'] : '#969896';
        $commentStyle   = ! empty( $settings['comment:style'] ) ? $settings['comment:style'] : '';
        $default        = ! empty( $settings['default:color'] ) ? $settings['default:color'] : '#000000';
        $defaultStyle   = ! empty( $settings['default:style'] ) ? $settings['default:style'] : '';
        $keyword        = ! empty( $settings['keyword:color'] ) ? $settings['keyword:color'] : '#a71d5d';
        $keywordStyle   = ! empty( $settings['keyword:style'] ) ? $settings['keyword:style'] : '';
        $string         = ! empty( $settings['string:color'] )  ? $settings['string:color']  : '#183691';
        $stringStyle    = ! empty( $settings['string:style'] )  ? $settings['string:style']  : '';
        $background     = ! empty( $settings['background'] )    ? $settings['background'] : '';
        $tags           = $settings['tags'] ?? true;

        ini_set("highlight.comment", "$comment; $phpFamily; $phpSize; $phpStyle; $commentStyle");
        ini_set("highlight.default", "$default; $phpFamily; $phpSize; $phpStyle; $defaultStyle");
        ini_set("highlight.keyword", "$keyword; $phpFamily; $phpSize; $phpStyle; $keywordStyle ");
        ini_set("highlight.string",  "$string;  $phpFamily; $phpSize; $phpStyle; $stringStyle");
        ini_set("highlight.html",    "$htmlColor; $htmlFamily; $htmlSize; $htmlStyle");

        // ----------------------------------------------------------------------------------------------
        // HIGHLIGHT
        // ----------------------------------------------------------------------------------------------
        $string = highlight_string($str, true);
        // ----------------------------------------------------------------------------------------------

        $string = Security\Script::encode(Security\PHP::encode(Security\Html::decode($string)));

        $tagArray = $tags === true
                  ? ['<div style="'.$background.'">&#60;&#63;php', '&#63;&#62;</div>']
                  : ['<div style="'.$background.'">', '</div>'];

        return str_replace(['&#60;&#63;php', '&#63;&#62;'], $tagArray, $string);
    }

    //--------------------------------------------------------------------------------------------------------
    // Char
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $string
    // @param string $type      : char, dec, hex, html
    // @param string $changeType: char, dec, hex, html
    //
    //--------------------------------------------------------------------------------------------------------
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

        return str_replace( $chars[strtolower($type)], $chars[strtolower($changeType)], $string );
    }

    //--------------------------------------------------------------------------------------------------------
    // Accent
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public static function accent(String $str) : String
    {
        $accent = array_merge(\Config::get('Expressions', 'accentChars'), self::$accentChars);

        $accent = Arrays::multikey($accent);

        return str_replace(array_keys($accent), array_values($accent), $str);
    }

    //--------------------------------------------------------------------------------------------------------
    // Url Word
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public static function urlWord(String $str) : String
    {
        return self::slug($str);
    }

    //--------------------------------------------------------------------------------------------------------
    // Slug -> 4.4.8 - 5.3.31|5.4.3[edited]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param bool   $protectExtension = false
    //
    //--------------------------------------------------------------------------------------------------------
    public static function slug(String $str, Bool $protectExtension = false) : String
    {
        if( $protectExtension === true )
        {
            $ext = File\Extension::get($str, true);
            $str = File\Extension::remove($str);
        }

        $str = self::accent(trim($str));

        $str = preg_replace('/&\w+\;/', '' , $str);
        $str = preg_replace("/\W/"    , '-' , $str);
        $str = preg_replace("/\_/"    , '-', $str);
        $str = preg_replace('/\-+/'   , '-', $str);

        return strtolower(trim($str, '-')) . ($ext ?? NULL);
    }

    //--------------------------------------------------------------------------------------------------------
    // Charset
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param string $fromCharset
    // @param string $toCharset
    //
    //--------------------------------------------------------------------------------------------------------
    public static function charset(String $str, String $fromCharset, String $toCharset = 'utf-8') : String
    {
        return mb_convert_encoding($str, $fromCharset, $toCharset);
    }

    //--------------------------------------------------------------------------------------------------------
    // To String
    //--------------------------------------------------------------------------------------------------------
    //
    // @param var $var
    //
    //--------------------------------------------------------------------------------------------------------
    public static function toString($var) : String
    {
        if( is_array($var) || is_object($var) )
        {
            return implode(' ', (array) $var);
        }

        return (string) $var;
    }

    //--------------------------------------------------------------------------------------------------------
    // To Object Recursive -> 5.0.0
    //--------------------------------------------------------------------------------------------------------
    //
    // @param var $var
    //
    //--------------------------------------------------------------------------------------------------------
    public static function toObjectRecursive($var) : \stdClass
    {
        $object = new \stdClass;

        return self::objectRecursive((array) $var, $object);
    }

    //--------------------------------------------------------------------------------------------------------
    // To Constant
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $var
    // @param string $prefix
    // @param string $suffix
    //
    //--------------------------------------------------------------------------------------------------------
    public static function toConstant(String $var, String $prefix = NULL, String $suffix = NULL)
    {
        $var = implode('_', Strings\Split::upperCase($var));
        
        $variable = \Autoloader::upper($prefix . $var . $suffix);

        if( defined($variable) )
        {
            return constant($variable);
        }
        elseif( defined($var) )
        {
            return constant($var);
        }
        else
        {
            if( is_numeric($var) )
            {
                return (int) $var;
            }

            return $var;
        }
    }

    //--------------------------------------------------------------------------------------------------
    // Protected Object Recursive
    //--------------------------------------------------------------------------------------------------
    //
    // @param array    $array
    // @param stdClass $obj
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------
    protected static function objectRecursive(Array $array, \stdClass &$std) : \stdClass
    {
        foreach( $array as $key => $value )
        {
            if( is_array($value) )
            {
                $std->$key = new \stdClass;

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
