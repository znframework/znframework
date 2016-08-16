<?php namespace ZN\Cryptography\Drivers;

use ZN\Cryptography\CryptoMapping;

class OpensslDriver extends CryptoMapping
{	
	//--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
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
		\Support::func('openssl_open', 'OPENSSL');

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
		$cipher = isset($settings['cipher']) ? $settings['cipher'] : 'aes-128';
	 	$key    = isset($settings['key'])    ? $settings['key']    : $this->keySize($cipher); 
		$mode   = isset($settings['mode'])   ? $settings['mode']   : 'cbc';
		$iv     = isset($settings['vector']) ? $settings['vector'] : $this->vectorSize($mode, $cipher);
		
		$cipher = $cipher."-".$mode;

		$encode = trim(openssl_encrypt($data, strtolower($cipher), $key, 1, $iv));
		
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
		$cipher = isset($settings['cipher']) ? $settings['cipher'] : 'aes-128';
	 	$key    = isset($settings['key'])    ? $settings['key']    : $this->keySize($cipher); 
		$mode   = isset($settings['mode'])   ? $settings['mode']   : 'cbc';
		$iv     = isset($settings['vector']) ? $settings['vector'] : $this->vectorSize($mode, $cipher);

		$cipher = $cipher."-".$mode;
		
		$data = base64_decode($data);
		
		return trim(openssl_decrypt(trim($data), $cipher, $key, 1, $iv));
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
		$cipher = strtolower($cipher);
		
		$ciphers =
		[	
			'aes-128' 	=> 16,
		];
		
		$ciphers = \Arrays::multikey($ciphers);
		
		if( ! isset($ciphers[$cipher]) )
		{
			$ciphers[$cipher] = 16;	
		}
		
		return mb_substr(hash('md5', $this->config['key']), 0, $ciphers[$cipher]);
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
		
		$modes = \Arrays::multikey($modes);
		
		$mode = isset($modes[$mode]) ? $modes[$mode] : 16;
		
		if( ! empty($cipher) )
		{
			$mode = isset($modes[$cipher]) ? $modes[$cipher] : $mode;
		}
		
		return mb_substr(hash('sha1', $this->config['key']), 0, $mode);
	}
}