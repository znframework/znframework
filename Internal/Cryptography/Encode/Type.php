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

use ZN\IS;
use ZN\Singleton;
use ZN\Cryptography\Exception\InvalidArgumentException;

class Type extends EncodeExtends
{
    /**
     * The specified algorithm encrypts the data according to the type.
     * 
     * @param string $data
     * @param string $type = 'md5'
     * 
     * @return string
     */

    public static function create(String $data, String $type = 'md5') : String
    {
        $algos = ['golden', 'super'];

        if( ! IS::hash($type) && ! in_array($type, $algos) )
        {
            throw new InvalidArgumentException;
        }

        if( in_array($type, $algos) )
        {
            return Singleton::class('ZN\Cryptography\Encode')->$type($data);
        }

        return hash($type, $data);
    }
}
