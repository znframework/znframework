<?php namespace ZN\IndividualStructures;

class InternalCart extends \FactoryController implements InternalCartInterface
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
            'selectitems' => 'Cart\Select::items',
            'selectitem'  => 'Cart\Select::item',
            'totalitems'  => 'Cart\Total::items',
            'totalprices' => 'Cart\Total::prices',
            'updateitem'  => 'Cart\Update::item',
            'deleteitem'  => 'Cart\Delete::item',
            'deleteitems' => 'Cart\Delete::items',
            'moneyformat' => 'Cart\Money::format',
        ]
    ];
}
