<?php namespace ZN\Language;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Lang;
use ZN\Controller\Factory;

class ML extends Factory
{
    const factory =
    [
        'methods' =>
        [
            'select'       => 'Select::do',
            'selectall'    => 'Select::all',
            'insert'       => 'Insert::do',
            'update'       => 'Update::do',
            'delete'       => 'Delete::do',
            'deleteall'    => 'Delete::all',
            'grid'         => 'Grid::create',
            'table'        => 'Grid::create',
            'limit'        => 'Grid::limit',
            'url'          => 'Grid::url'
        ]
    ];

    /**
     * Set language
     * 
     * @param string $lang = 'tr'
     * 
     * @return bool
     */
    public function lang(String $lang = 'tr') : Bool
    {
        return Lang::set($lang);
    }
}
