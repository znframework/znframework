<?php namespace ZN\EncodingSupport;

use ZN\IndividualStructures\Lang;

class ML extends \FactoryController
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
            'select'       => 'MultiLanguage\Select::do',
            'selectall'    => 'MultiLanguage\Select::all',
            'insert'       => 'MultiLanguage\Insert::do',
            'update'       => 'MultiLanguage\Update::do',
            'delete'       => 'MultiLanguage\Delete::do',
            'deleteall'    => 'MultiLanguage\Delete::all',
            'grid'         => 'MultiLanguage\Grid::create',
            'table'        => 'MultiLanguage\Grid::create',
            'limit'        => 'MultiLanguage\Grid::limit',
            'url'          => 'MultiLanguage\Grid::url'
        ]
    ];

    //--------------------------------------------------------------------------------------------------------
    // Lang
    //--------------------------------------------------------------------------------------------------------
    //
    // Sayfanın aktif dilini ayarlamak için kullanılır.
    // @param string $lang
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function lang(String $lang = 'tr') : Bool
    {
        Lang::set($lang);
    }
}
