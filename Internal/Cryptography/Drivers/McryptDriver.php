<?php namespace ZN\Cryptography\Drivers;
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
use ZN\Helper;
use ZN\Datatype;
use ZN\Cryptography\CryptoMapping;
use ZN\Cryptography\Exception\UnsupportedExtensionException;

class McryptDriver extends CryptoMapping
{
    /**
     * Magic constructor
     * 
     * @param void
     * 
     * @return void
     */
	public function __construct()
	{
        if( IS::phpVersion('7.2') )
        {
            throw new UnsupportedExtensionException;
        }

		parent::__construct();
	}

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
        $set    = $this->_settings($settings);
        $encode = trim(mcrypt_encrypt($set->cipher, $set->key, $data, $set->mode, $set->iv));

        return base64_encode($encode);
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
        $set    = $this->_settings($settings);
        $data   = base64_decode($data);

        return trim(mcrypt_decrypt($set->cipher, $set->key, trim($data), $set->mode, $set->iv));
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
        return mcrypt_create_iv($length, MCRYPT_DEV_URANDOM);
    }

    /**
     * private keysize
     * 
     * @param string $cipher
     * 
     * @return string
     */
    private function keySize($cipher)
    {
        $cipher  = strtolower($cipher);
        $ciphers =
        [
            'des'                                           => 8,
            'cast_128|rijndael_128|serpent|twofish|xtea'    => 16,
            '3des|rijndael_192|saferplus|tripledes'         => 24,
            'cast_256|gost|loki97|rijndael_256'             => 32
        ];

        $ciphers = Datatype::multikey($ciphers);

        return mb_substr(hash('md5', $this->key), 0, $ciphers[$cipher] ?? 8);
    }

    /**
     * protected vector size
     * 
     * @param string $mode
     * @param string $cipher
     * 
     * @return string
     */
    protected function vectorSize($mode, $cipher)
    {
        $mode   = strtolower($mode);
        $cipher = strtolower($cipher);
        $modes  =
        [
            'cbc'                                                       => 8,
            'cast_256|loki97|rijndael_128|saferplus|serpent|twofish'    => 16,
            'rijndael_192'                                              => 24,
            'rijndael_256'                                              => 32,
        ];

        $modes = Datatype::multikey($modes);
        $mode  = $modes[$mode] ?? 8;

        if( ! empty($cipher) )
        {
            $mode = $modes[$cipher] ?? $mode;
        }

        return mb_substr(hash('sha1', $this->key), 0, $mode);
    }

    /**
     * protected settings
     * 
     * @param array $settings
     * 
     * @return object
     */
    protected function _settings($settings)
    {
        $cipher = $settings['cipher'] ?? 'des';
        $cipher = str_replace('-', '_', $cipher);

        $key    = $settings['key']    ?? $this->keySize($cipher);
        $mode   = $settings['mode']   ?? 'cbc';
        $iv     = $settings['vector'] ?? $this->vectorSize($mode, $cipher);

        $cipher = Helper::toConstant($cipher, 'MCRYPT_');
        $mode   = Helper::toConstant($mode, 'MCRYPT_MODE_');

        return (object)
        [
            'key'    => $key,
            'mode'   => $mode,
            'iv'     => $iv,
            'cipher' => $cipher
        ];
    }
}
