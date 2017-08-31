<?php namespace ZN\Helpers\Converter;

use Config, Arrays;
use ZN\Helpers\Converter\Exception\InvalidArgumentException;
use ZN\Helpers\Converter\Exception\LogicException;

class Unicode
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    public $accentChars =
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
    // Char
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $string
    // @param string $type      : char, dec, hex, html
    // @param string $changeType: char, dec, hex, html
    //
    //--------------------------------------------------------------------------------------------------------
    public function char(String $string, String $type = 'char', String $changeType = 'html') : String
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

        $string = $this->accent($string);

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
    public function accent(String $str) : String
    {
        $accent = array_merge(Config::get('Expressions', 'accentChars'), $this->accentChars);

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
    public function urlWord(String $str) : String
    {
        return $this->slug($str);
    }

    //--------------------------------------------------------------------------------------------------------
    // Slug -> 4.4.8
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public function slug(String $str) : String
    {
        $str = $this->accent(trim($str));
        $str = preg_replace('/&\w+\;/', '' , $str);
        $str = preg_replace("/\s+/"   , '_', $str);
        $str = preg_replace("/\W/"    , '' , $str);
        $str = preg_replace("/\_/"    , '-', $str);
        $str = preg_replace('/\-+/'   , '-', $str);

        return strtolower($str);
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
    public function charset(String $str, String $fromCharset, String $toCharset = 'utf-8') : String
    {
        return mb_convert_encoding($str, $fromCharset, $toCharset);
    }
}
