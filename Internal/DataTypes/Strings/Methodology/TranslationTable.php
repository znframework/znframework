<?php namespace ZN\DataTypes\Strings;

use ZN\Helpers\Converter;

class TranslationTable
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
    // Translation Table
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param string $quote
    //
    //--------------------------------------------------------------------------------------------------------
    public static function get(String $table = 'specialchars', String $quote = 'compat') : Array
    {
        return get_html_translation_table
        (
            Converter\VariableTypes::toConstant($table, 'HTML_'),
            Converter\VariableTypes::toConstant($quote, 'ENT_' )
        );
    }
}
