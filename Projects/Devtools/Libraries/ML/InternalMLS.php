<?php

use ZN\Lang;
use ZN\Controller\Factory;

class InternalMLS extends Factory
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
            'select'       => 'ML\Select::do',
            'selectall'    => 'ML\Select::all',
            'insert'       => 'ML\Insert::do',
            'update'       => 'ML\Update::do',
            'delete'       => 'ML\Delete::do',
            'deleteall'    => 'ML\Delete::all',
            'grid'         => 'ML\Grid::create',
            'table'        => 'ML\Grid::create',
            'limit'        => 'ML\Grid::limit',
            'url'          => 'ML\Grid::url'
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
