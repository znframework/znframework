<?php namespace ZN\XML;
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
    /**
     * Controls whether an XML document is valid.
     * 
     * @param string $xml
     * 
     * @return bool
     */
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
