<?php namespace ZN\DataTypes\XML;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Check
{
    //--------------------------------------------------------------------------------------------------------
    // Check -> 4.3.5
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    //--------------------------------------------------------------------------------------------------------
    public static function check(String $xml) : Bool
    {
        if( empty($xml) )
        {
            return false;
        }

        libxml_use_internal_errors(true);

        simplexml_load_string($xml);

        $return = ! (bool) libxml_get_errors();

        libxml_clear_errors();

        return $return;
    }
}
