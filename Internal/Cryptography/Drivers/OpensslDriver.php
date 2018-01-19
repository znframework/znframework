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

use ZN\Support;
use ZN\Datatype;
use ZN\Cryptography\CryptoMapping;

class OpensslDriver extends CryptoMapping
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
		Support::func('openssl_open', 'OPENSSL');

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
		$encode = trim(openssl_encrypt($data, strtolower($set->cipher), $set->key, 1, $set->iv));

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
		$set  = $this->_settings($settings);
		$data = base64_decode($data);

		return trim(openssl_decrypt(trim($data), $set->cipher, $set->key, 1, $set->iv));
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
		return openssl_random_pseudo_bytes($length);
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
			'aes-128' 	=> 16,
		];

		$ciphers = Datatype::multikey($ciphers);

		return mb_substr(hash('md5', $this->key), 0, $ciphers[$cipher] ?? 16);
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

		$modes =
		[
			'cbc' 	=> 16,
			'rc2'   => 8,
			'ecb'   => 0
		];

		$modes = Datatype::multikey($modes);
		$mode  = $modes[$mode] ?? 16;

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
		$cipher = $settings['cipher'] ?? 'aes-128';
	 	$key    = $settings['key']    ?? $this->keySize($cipher);
		$mode   = $settings['mode']   ?? 'cbc';
		$iv     = $settings['vector'] ?? $this->vectorSize($mode, $cipher);
		$cipher = $cipher . '-' . $mode;

        return (object)
        [
            'key'    => $key,
            'iv'     => $iv,
            'cipher' => $cipher
        ];
    }
}
