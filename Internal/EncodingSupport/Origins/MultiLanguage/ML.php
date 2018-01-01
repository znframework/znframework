<?php namespace ZN\EncodingSupport;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\IndividualStructures\Lang;

class ML extends \FactoryController
{
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
