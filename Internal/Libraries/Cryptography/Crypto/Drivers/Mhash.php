<?php namespace ZN\Cryptography\Drivers;

use ZN\Cryptography\CryptoMapping;

class MhashDriver extends CryptoMapping
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
	// Encrypt
	//--------------------------------------------------------------------------------------------------------
	// 
	// @param string $data
	// @param array  $settings
	//
	//--------------------------------------------------------------------------------------------------------
	public function encrypt($data, $settings)
	{
		$cipher = isset($settings['cipher']) ? $settings['cipher'] : 'sha256';
	 	$key    = isset($settings['key'])    ? $settings['key']    : $this->config['key']; 
		
		// MHASH_ ön eki ilave ediliyor.
		$cipher = \Converter::toConstant($cipher, 'MHASH_');
		
		return base64_encode(trim(mhash($cipher, $data, $key)));
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
		return mhash_keygen_s2k(MHASH_MD5, md5(mt_rand()), md5(mt_rand()), $length);
	}
}