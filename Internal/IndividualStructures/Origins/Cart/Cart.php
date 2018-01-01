<?php namespace ZN\IndividualStructures;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Cart extends \FactoryController
{
    const factory =
    [
        'methods' =>
        [
            'insertitem'    => 'Cart\Insert::item',
            'insert'        => 'Cart\Insert::item',
            'selectitems'   => 'Cart\Select::items',
            'selectall'     => 'Cart\Select::items',
            'selectitem'    => 'Cart\Select::item',
            'select'        => 'Cart\Select::item',
            'totalitems'    => 'Cart\Total::items',
            'totalprices'   => 'Cart\Total::prices',
            'updateitem'    => 'Cart\Update::item',
            'update'        => 'Cart\Update::item',
            'deleteitem'    => 'Cart\Delete::item',
            'delete'        => 'Cart\Delete::item',
            'deleteitems'   => 'Cart\Delete::items',
            'deleteall'     => 'Cart\Delete::items',
            'moneyformat'   => 'Cart\Money::format',
            'formatmoney'   => 'Cart\Money::format',
            'moneytonumber' => 'Cart\Money::number'
        ]
    ];
}
