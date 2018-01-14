<?php namespace ZN\Shopping;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Controller\Factory;

class Cart extends Factory
{
    const factory =
    [
        'methods' =>
        [
            'insertitem'    => 'Insert::item',
            'insert'        => 'Insert::item',
            'selectitems'   => 'Select::items',
            'selectall'     => 'Select::items',
            'selectitem'    => 'Select::item',
            'select'        => 'Select::item',
            'totalitems'    => 'Total::items',
            'totalprices'   => 'Total::prices',
            'updateitem'    => 'Update::item',
            'update'        => 'Update::item',
            'deleteitem'    => 'Delete::item',
            'delete'        => 'Delete::item',
            'deleteitems'   => 'Delete::items',
            'deleteall'     => 'Delete::items',
            'moneyformat'   => 'Money::format',
            'formatmoney'   => 'Money::format',
            'moneytonumber' => 'Money::number'
        ]
    ];
}
