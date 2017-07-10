<?php namespace ZN\DataTypes;

use Converter;

class InternalStrings extends \FactoryController
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    const factory =
    [
        'methods' =>
        [
            'mtrim'          => 'Strings\Trim::middle',
            'trimslashes'    => 'Strings\Trim::slashes',
            'casing'         => 'Strings\Casing::use',
            'lowercase'      => 'Strings\Casing::lower',
            'uppercase'      => 'Strings\Casing::upper',
            'titlecase'      => 'Strings\Casing::title',
            'pascalcase'     => 'Strings\Casing::pascal',
            'camelcase'      => 'Strings\Casing::camel',
            'underscorecase' => 'Strings\Casing::underscore',
            'search'         => 'Strings\Search::use',
            'searchposition' => 'Strings\Search::position',
            'searchstring'   => 'Strings\Search::string',
            'reshuffle'      => 'Strings\Substitution::reshuffle',
            'placement'      => 'Strings\Substitution::placement',
            'replace'        => 'Strings\Substitution::replace',
            'toarray'        => 'Strings\Transform::array',
            'toascii'        => 'Strings\Transform::ascii',
            'tochar'         => 'Strings\Transform::char',
            'toarray'        => 'Strings\Transform::array',
            'split'          => 'Strings\Transform::split',
            'addslashes'     => 'Strings\Security::addSlashes',
            'removeslashes'  => 'Strings\Security::removeSlashes',
        ]
    ];

    //--------------------------------------------------------------------------------------------------------
    // Section
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param int    $starting
    // @param int    $count
    // @param string $encoding
    //
    //--------------------------------------------------------------------------------------------------------
    public function section(String $str, Int $starting = 0, Int $count = NULL, String $encoding = 'utf-8') : String
    {
        return mb_substr($str, $starting, $count, $encoding);
    }

    //--------------------------------------------------------------------------------------------------------
    // Recurrent Count
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param string $char
    //
    //--------------------------------------------------------------------------------------------------------
    public function recurrentCount(String $str, String $char) : Int
    {
        return count(explode($char, $str)) - 1;
    }

    //--------------------------------------------------------------------------------------------------------
    // Length
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param string $encoding
    //
    //--------------------------------------------------------------------------------------------------------
    public function length(String $string, String $encoding = 'utf-8') : Int
    {
        return mb_strlen($string, $encoding);
    }

    //--------------------------------------------------------------------------------------------------------
    // Repeat
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param numeric $count
    //
    //--------------------------------------------------------------------------------------------------------
    public function repeat(String $string, Int $count = 1) : String
    {
        return str_repeat($string, $count);
    }

    //--------------------------------------------------------------------------------------------------------
    // Pad
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param numeric $count
    // @param string  $chars
    // @param string  $type
    //
    //--------------------------------------------------------------------------------------------------------
    public function pad(String $string, Int $count = 1, String $chars = ' ', String $type = 'right') : String
    {
        return str_pad($string, $count, $chars, Converter::toConstant($type, 'STR_PAD_'));
    }

    //--------------------------------------------------------------------------------------------------------
    // Apportion
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string  $string
    // @param numeric $length
    // @param string  $end
    //
    //--------------------------------------------------------------------------------------------------------
    public function apportion(String $string, Int $length = 76, String $end = "\r\n") : String
    {
        $arrayChunk = array_chunk(preg_split("//u", $string, -1, PREG_SPLIT_NO_EMPTY), $length);

        $string = "";

        foreach( $arrayChunk as $chunk )
        {
            $string .= implode("", $chunk) . $end;
        }

        return $string;
    }

    //--------------------------------------------------------------------------------------------------------
    // Divide
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string  $string
    // @param string  $seperator
    // @param numeric $index
    //
    //--------------------------------------------------------------------------------------------------------
    public function divide(String $str, String $separator = "|", $index = 0) : String
    {
        return divide($str, $separator, $index);
    }

    //--------------------------------------------------------------------------------------------------------
    // Translation Table
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param string $quote
    //
    //--------------------------------------------------------------------------------------------------------
    public function translationTable(String $table = 'specialchars', String $quote = 'compat') : Array
    {
        return get_html_translation_table(Converter::toConstant($table, 'HTML_'), Converter::toConstant($quote, 'ENT_'));
    }
}
