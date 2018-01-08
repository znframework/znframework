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

class ML extends \FactoryController
{
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

    /**
     * Set langauge
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
