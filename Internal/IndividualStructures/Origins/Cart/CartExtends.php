<?php namespace ZN\IndividualStructures\Cart;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class CartExtends
{
    use \DriverAbility;

    //--------------------------------------------------------------------------------------------------------
    // Consts
    //--------------------------------------------------------------------------------------------------------
    //
    // @const string
    //
    //--------------------------------------------------------------------------------------------------------
    const driver =
    [
        'options' => ['session', 'cookie'],
        'config'  => 'IndividualStructures:cart'
    ];
}
