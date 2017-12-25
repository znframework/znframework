<?php namespace ZN\CryptoGraphy\Encode;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use Encode;
use ZN\IndividualStructures\IS;
use ZN\CryptoGraphy\Exception\InvalidArgumentException;

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
            throw new InvalidArgumentException('Error', 'hashParameter', 'String $type');
        }

        if( in_array($type, $algos) )
        {
            return Encode::$type($data);
        }

        return hash($type, $data);
    }
}
