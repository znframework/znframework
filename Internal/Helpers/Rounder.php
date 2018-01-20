<?php namespace ZN\Helpers;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Helpers\Exception\LogicException;

class Rounder
{
    /**
     * Average
     * 
     * @param float $number
     * @param int   $count = 0
     * 
     * @return float
     */
    public static function average(Float $number, Int $count = 0) : Float
    {
        return round($number, $count);
    }

    /**
     * Down
     * 
     * @param float $number
     * @param int   $count = 0
     * 
     * @return float
     */
    public static function down(Float $number, Int $count = 0) : Float
    {
        if( $count === 0 )
        {
            return floor($number);
        }

        $numbers = explode(".", $number);

        $edit = 0;

        if( ! empty($numbers[1]) )
        {
            $edit = substr($numbers[1], 0, $count);

            return (float) $numbers[0].".".$edit;
        }
        else
        {
            throw new LogicException('[Rounder::down()] -> Decimal values can not be specified for the integer! Check 2.($count) parameter!');
        }
    }

    /**
     * Up
     * 
     * @param float $number
     * @param int   $count = 0
     * 
     * @return float
     */
    public static function up(Float $number, Int $count = 0) : Float
    {
        if( $count === 0 )
        {
            return ceil($number);
        }

        $numbers = explode(".", $number);

        $edit = 0;

        if( ! empty($numbers[1]) )
        {
            $edit = substr($numbers[1], 0, $count);

            return (float) $numbers[0].".".($edit + 1);
        }
        else
        {
            throw new LogicException('[Rounder::up()] -> Decimal values can not be specified for the integer! Check 2.($count) parameter!');
        }
    }
}
