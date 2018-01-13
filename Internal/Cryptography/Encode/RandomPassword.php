<?php namespace ZN\Cryptography\Encode;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class RandomPassword
{
    /**
     * Generates random encrypted data.
     * 
     * @param int    $count = 0
     * @param string $chars = 'alnum' - options[alnum|numeric|string|alpha|special|all]
     * 
     * @return string
     */
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
