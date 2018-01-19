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
use ZN\Cryptography\CryptographyDefaultConfiguration;

class EncodeExtends
{
    /**
     * Keeps config
     * 
     * @var array
     */
    protected static $config; 

    /**
     * Magic constructor
     * 
     * @param void
     * 
     * @return void
     */
    public function __construct()
    {
        self::$config = Config::default(new CryptographyDefaultConfiguration)::get('Cryptography');
    }
}
