<?php namespace ZN\CryptoGraphy\Encode;

class RandomPassword extends EncodeExtends implements RandomPasswordInterface
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
    // Create
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int    $count
    // @param string $chars
    //
    //--------------------------------------------------------------------------------------------------------
    public function create(Int $count = 6, String $chars = 'all') : String
    {
        $password = '';
        $alpha    = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOQPRSTUVWXYZ';
        $numeric  = '1234567890';

        if( $chars === 'all' || $chars === 'alnum' )
        {
            $characters = $numeric . $alpha;
        }
        if( $chars === 'numeric' )
        {
            $characters = $numeric;
        }
        if( $chars === 'string' || $chars === 'alpha' )
        {
            $characters = $alpha;
        }

        for( $i = 0; $i < $count; $i++ )
        {
            $password .= substr( $characters, rand( 0, strlen($characters)), 1 );
        }

        return $password;
    }
}
