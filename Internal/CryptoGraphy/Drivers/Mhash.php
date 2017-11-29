<?php namespace ZN\CryptoGraphy\Drivers;

use ZN\CryptoGraphy\CryptoMapping;
use ZN\Helpers\Converter;

class MhashDriver extends CryptoMapping
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
	// Encrypt
	//--------------------------------------------------------------------------------------------------------
	//
	// @param string $data
	// @param array  $settings
	//
	//--------------------------------------------------------------------------------------------------------
	public function encrypt($data, $settings)
	{
		$cipher = $settings['cipher'] ?? 'sha256';
	 	$key    = $settings['key']    ?? PROJECT_CONFIG['key'];
		$cipher = Converter::toConstant($cipher, 'MHASH_');

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
