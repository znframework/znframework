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

class GoldenAlgorithm extends EncodeExtends
{
    /**
     * Generates encrypted data.
     * 
     * @param string $data
     * @param string $additional = 'default'
     * 
     * @return string
     */
    public static function create(String $data, String $additional = 'default') : String
    {
        $algo = self::$config['type'];

        if( ! IS::hash($algo) )
        {
            $algo = 'md5';
        }

        $additional = hash($algo, $additional);

        $data = hash($algo, $data);

        return hash($algo, $data . $additional);
    }
}
