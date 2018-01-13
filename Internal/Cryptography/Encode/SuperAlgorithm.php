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

use ZN\Config;
use ZN\IS;

class SuperAlgorithm extends EncodeExtends
{
    /**
     * Generates encrypted data.
     * 
     * @param string $data
     * 
     * @return string
     */
    public static function create(String $data) : String
    { 
        $projectKey = Config::get('Project', 'key');

        $algo = self::$config['encode']['type'];

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
