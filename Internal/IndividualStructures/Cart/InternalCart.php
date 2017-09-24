<?php namespace ZN\IndividualStructures;

class InternalCart extends \FactoryController
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
            'insertitem'  => 'Cart\Insert::item',
            'insert'      => 'Cart\Insert::item',
            'selectitems' => 'Cart\Select::items',
            'selectall'   => 'Cart\Select::items',
            'selectitem'  => 'Cart\Select::item',
            'select'      => 'Cart\Select::item',
            'totalitems'  => 'Cart\Total::items',
            'totalprices' => 'Cart\Total::prices',
            'updateitem'  => 'Cart\Update::item',
            'update'      => 'Cart\Update::item',
            'deleteitem'  => 'Cart\Delete::item',
            'delete'      => 'Cart\Delete::item',
            'deleteitems' => 'Cart\Delete::items',
            'deleteall'   => 'Cart\Delete::items',
            'moneyformat' => 'Cart\Money::format',
            'formatmoney' => 'Cart\Money::format'
        ]
    ];
}
