<?php namespace ZN\CryptoGraphy\Encode;

class RandomPassword extends EncodeExtends
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
    // Create -> 5.3.35[edited]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int    $count = 6
    // @param string $chars = 'alnum', options: numeric, string/alpha, special, all, alnum
    //
    //--------------------------------------------------------------------------------------------------------
    public static function create(Int $count = 6, String $chars = 'alnum') : String
    {
        $password = '';
        $alpha    = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOQPRSTUVWXYZ';
        $numeric  = '1234567890';
        $special  = '*-+/?!.;,:\'\\#$%&{}[]()';

        switch( $chars )
        {
            case 'numeric' : $characters = $numeric;                     break;
            case 'string'  :
            case 'alpha'   : $characters = $alpha;                       break;
            case 'special' : $characters = $special;                     break;
            case 'all'     : $characters = $alpha . $numeric . $special; break;
            case 'alnum'   :
            default        : $characters = $alpha . $numeric;
        }

        return substr(str_shuffle($characters), 0, $count);
    }
}
