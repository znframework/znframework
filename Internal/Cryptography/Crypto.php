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

use ZN\Ability\Driver;

class Crypto implements CryptoInterface
{
    use Driver;

    /**
     * Get driver
     * 
     * @const array
     */
    const driver =
    [
        'options'   => ['openssl', 'mhash', 'phash', 'hash', 'mcrypt'],
        'namespace' => 'ZN\Cryptography\Drivers',
        'config'    => 'Cryptography',
        'default'   => 'ZN\Cryptography\CryptographyDefaultConfiguration'
    ];

    /**
     * It encrypts the data.
     * 
     * @param string $data
     * @param array  $settings
     * 
     * @return string
     */
    public function encrypt(String $data,  Array $settings = []) : String
    {
        return $this->driver->encrypt($data, $settings);
    }

    /**
     * It decrypts the data.
     * 
     * @param string $data
     * @param array  $settings
     * 
     * @return string
     */
    public function decrypt(String $data, Array $settings = []) : String
    {
        return $this->driver->decrypt($data, $settings);
    }

    /**
     * Generates a random password.
     * 
     * @param int $length
     * 
     * @return string
     */
    public function keygen(Int $length = 8) : String
    {
        return $this->driver->keygen($length);
    }
}
