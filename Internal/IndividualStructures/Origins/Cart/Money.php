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

use ZN\Helpers\Converter;

class Money
{
    //--------------------------------------------------------------------------------------------------------
    // Money Format
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int    $money
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    public function format(Int $money, String $type = NULL) : String
    {
        return Converter::money($money, $type);
    }

    //--------------------------------------------------------------------------------------------------------
    // Money To Number -> 5.2.0
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $money
    //
    //--------------------------------------------------------------------------------------------------------
    public function number($money) : Float
    {
        return Converter::moneyToNumber($money);
    }
}
