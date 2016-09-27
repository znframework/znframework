<?php namespace ZN\CryptoGraphy\Encode;

class SuperAlgorithm extends EncodeExtends implements SuperAlgorithmInterface
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
    public function create(String $data) : String
    {
        $projectKey = PROJECT_CONFIG['key'];

        $algo = CRYPTOGRAPHY_ENCODE_CONFIG['type'];

        if( ! isHash($algo) )
        {
            $algo = 'md5';
        }

        // Proje Anahatarı belirtizme bu veri yerine
        // Proje anahtarı olarak sitenin host adresi
        // eklenecek ek veri kabul edilir.
        if( empty($projectKey) )
        {
            $additional = hash($algo, host());
        }
        else
        {
            $additional = hash($algo, $projectKey);
        }

        // Veri şifreleniyor.
        $data = hash($algo, $data);

        // Veri ve ek yeniden şifreleniyor.
        return hash($algo, $data.$additional);
    }
}
