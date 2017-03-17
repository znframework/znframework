<?php namespace ZN\CryptoGraphy\Drivers;

use ZN\CryptoGraphy\CryptoMapping;
use Support, Arrays;

class OpensslDriver extends CryptoMapping
{
	//--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

	//--------------------------------------------------------------------------------------------------------
	// Construct
	//--------------------------------------------------------------------------------------------------------
	//
	// @param void
	//
	//--------------------------------------------------------------------------------------------------------
	public function __construct()
	{
		Support::func('openssl_open', 'OPENSSL');

		parent::__construct();
	}

	//--------------------------------------------------------------------------------------------------------
	// Encrypt
	//--------------------------------------------------------------------------------------------------------
	//
	// @param string $data
	// @param array  $settings
	//
	//--------------------------------------------------------------------------------------------------------
	public function encrypt($data, $settings)
	{
		$set    = $this->_settings($settings);
		$encode = trim(openssl_encrypt($data, strtolower($set->cipher), $set->key, 1, $set->iv));

		return base64_encode($encode);
	}

	//--------------------------------------------------------------------------------------------------------
	// Decrypt
	//--------------------------------------------------------------------------------------------------------
	//
	// @param string $data
	// @param array  $settings
	//
	//--------------------------------------------------------------------------------------------------------
	public function decrypt($data, $settings)
	{
		$set  = $this->_settings($settings);
		$data = base64_decode($data);

		return trim(openssl_decrypt(trim($data), $set->cipher, $set->key, 1, $set->iv));
	}

	//--------------------------------------------------------------------------------------------------------
	// Keygen
	//--------------------------------------------------------------------------------------------------------
	//
	// @param numeric $length
	//
	//--------------------------------------------------------------------------------------------------------
	public function keygen($length)
	{
		return openssl_random_pseudo_bytes($length);
	}

	//--------------------------------------------------------------------------------------------------------
	// Protected
	//--------------------------------------------------------------------------------------------------------
	private function keySize($cipher)
	{
		$cipher  = strtolower($cipher);
		$ciphers =
		[
			'aes-128' 	=> 16,
		];

		$ciphers = Arrays::multikey($ciphers);

		return mb_substr(hash('md5', PROJECT_CONFIG['key']), 0, $ciphers[$cipher] ?? 16);
	}

	//--------------------------------------------------------------------------------------------------------
	// Protected
	//--------------------------------------------------------------------------------------------------------
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

		$modes = Arrays::multikey($modes);
		$mode  = $modes[$mode] ?? 16;

		if( ! empty($cipher) )
		{
			$mode = $modes[$cipher] ?? $mode;
		}

		return mb_substr(hash('sha1', PROJECT_CONFIG['key']), 0, $mode);
	}

	//--------------------------------------------------------------------------------------------------------
    // Protected Settings
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array settings
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _settings($settings)
    {
		$cipher = $settings['cipher'] ?? 'aes-128';
	 	$key    = $settings['key']    ?? $this->keySize($cipher);
		$mode   = $settings['mode']   ?? 'cbc';
		$iv     = $settings['vector'] ?? $this->vectorSize($mode, $cipher);
		$cipher = $cipher."-".$mode;

        return (object)
        [
            'key'    => $key,
            'iv'     => $iv,
            'cipher' => $cipher
        ];
    }
}
