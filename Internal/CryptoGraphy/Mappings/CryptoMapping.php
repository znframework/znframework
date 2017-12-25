<?php namespace ZN\CryptoGraphy;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use CLController;

class CryptoMapping extends CLController
{
    /**
     * Get project config
     * 
     * @const string
     */
    const config = 'Project';

    /**
     * It encrypts the data.
     * 
     * @param string $data
     * @param array  $settings
     * 
     * @return string
     */
    public function encrypt($data, $settings)
    {
        return false;
    }

    /**
     * It decrypts the data.
     * 
     * @param string $data
     * @param array  $settings
     * 
     * @return string
     */
    public function decrypt($data, $settings)
    {
        return false;
    }

    /**
     * Generates a random password.
     * 
     * @param int $length
     * 
     * @return string
     */
    public function keygen($length)
    {
        return false;
    }
}
