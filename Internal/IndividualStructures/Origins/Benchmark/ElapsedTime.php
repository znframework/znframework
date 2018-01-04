<?php namespace ZN\IndividualStructures\Benchmark;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class ElapsedTime
{
    //--------------------------------------------------------------------------------------------------------
    // Elapsed Time
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $result
    // @param  numeric $decimal
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public static function calculate(String $result, Int $decimal = 4) : Float
    {
        $resend  = $result."_end";
        $restart = $result."_start";

        if( ! isset(Properties::$tests[$restart]) )
        {
            throw new \GeneralException('[Benchmark::elapsedTime(\''.$result.'\')] -> Parameter is not a valid test start!');
        }

        if( ! isset(Properties::$tests[$resend]) )
        {
            throw new \GeneralException('[Benchmark::elapsedTime(\''.$result.'\')] -> Parameter is not a valid test end!');
        }

        return round(((float) Properties::$tests[$resend] - (float) Properties::$tests[$restart]), $decimal);
    }
}
