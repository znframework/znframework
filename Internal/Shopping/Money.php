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

use ZN\Helpers\Converter;

class Money
{
    /**
     * Format money
     * 
     * @param int    $money
     * @param string $type = NULL
     * 
     * @return string
     */
    public function format(Int $money, String $type = NULL) : String
    {
        return Converter::money($money, $type);
    }

    /**
     * Money to number
     * 
     * @param string $money
     * 
     * @return float
     */
    public function number($money) : Float
    {
        return Converter::moneyToNumber($money);
    }
}
