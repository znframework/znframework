<?php namespace ZN\DataTypes;

use FactoryController;

class InternalStrings extends FactoryController
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
            'mtrim'            => 'Strings\Trim::middle',
            'trimslashes'      => 'Strings\Trim::slashes',
            'casing'           => 'Strings\Casing::use',
            'lowercase'        => 'Strings\Casing::lower',
            'uppercase'        => 'Strings\Casing::upper',
            'titlecase'        => 'Strings\Casing::title',
            'pascalcase'       => 'Strings\Casing::pascal',
            'camelcase'        => 'Strings\Casing::camel',
            'underscorecase'   => 'Strings\Casing::underscore',
            'search'           => 'Strings\Search::use',
            'searchposition'   => 'Strings\Search::position',
            'searchstring'     => 'Strings\Search::string',
            'reshuffle'        => 'Strings\Substitution::reshuffle',
            'placement'        => 'Strings\Substitution::placement',
            'replace'          => 'Strings\Substitution::replace',
            'toarray'          => 'Strings\Transform::array',
            'toascii'          => 'Strings\Transform::ascii',
            'tochar'           => 'Strings\Transform::char',
            'toarray'          => 'Strings\Transform::array',
            'split'            => 'Strings\Transform::split',
            'addslashes'       => 'Strings\Security::addSlashes',
            'removeslashes'    => 'Strings\Security::removeSlashes',
            'section'          => 'Strings\Section::use',
            'length'           => 'Strings\Length::get',
            'recurrentcount'   => 'Strings\Length::recurrentCount',
            'repeat'           => 'Strings\Repeat::do',
            'pad'              => 'Strings\Pad::use',
            'splituppercase'   => 'Strings\Split::upperCase',
            'apportion'        => 'Strings\Split::apportion',
            'divide'           => 'Strings\Split::divide',
            'translationtable' => 'Strings\TranslationTable::get',
        ]
    ];
}
