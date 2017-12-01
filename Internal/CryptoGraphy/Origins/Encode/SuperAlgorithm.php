<?php namespace ZN\CryptoGraphy\Encode;

use ZN\IndividualStructures\IS;

class SuperAlgorithm extends EncodeExtends
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Super
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    public static function create(String $data) : String
    {
        $projectKey = PROJECT_CONFIG['key'];

        $algo = CRYPTOGRAPHY_ENCODE_CONFIG['type'];

        if( ! IS::hash($algo) )
        {
            $algo = 'md5';
        }

        if( empty($projectKey) )
        {
            $additional = hash($algo, host());
        }
        else
        {
            $additional = hash($algo, $projectKey);
        }

        $data = hash($algo, $data);

        return hash($algo, $data . $additional);
    }
}
