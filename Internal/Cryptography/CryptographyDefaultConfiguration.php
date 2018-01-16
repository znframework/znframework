<?php namespace ZN\Cryptography;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

/**
 * Default Cookie Configuration
 * 
 * Enabled when the configuration file can not be accessed.
 */
class CryptographyDefaultConfiguration
{
    /*
    |--------------------------------------------------------------------------
    | Cryto
    |--------------------------------------------------------------------------
    |
    | Sets the predefined driver for the Crypto library.
    |
    | Options: openssl, mcrypt, hash, phash, mhash
    |
    */

    public $driver = 'openssl';

    /*
    |--------------------------------------------------------------------------
    | Encode
    |--------------------------------------------------------------------------
    |
    | Sets which encryption algorithm will use the Encode class methods by default.
    |
    */

    public $type = 'md5';
}
