<?php namespace ZN\DataTypes\XML;

class Check implements CheckInterface
{
    //--------------------------------------------------------------------------------------------------------
    // Check -> 4.3.5
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    //--------------------------------------------------------------------------------------------------------
    public function check(String $xml) : Bool
    {
        libxml_use_internal_errors(true);

        simplexml_load_string($xml);

        $return = ! (bool) libxml_get_errors();

        libxml_clear_errors();

        return $return;
    }
}
