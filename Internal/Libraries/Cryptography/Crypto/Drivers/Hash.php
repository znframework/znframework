<?php
namespace ZN\Cryptography\Drivers;

use ZN\Cryptography\CryptoAbstract\CryptoAbstract;

class HashDriver extends CryptoAbstract
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------

	public function encrypt($data = '', $settings = [])
	{
		$cipher = isset($settings['cipher']) ? $settings['cipher'] : 'sha256';
	 	$key    = isset($settings['key'])    ? $settings['key']    : \Config::get('Encode', 'projectKey'); 
		
		return base64_encode(trim(hash_hmac($cipher, $data, $key)));
	}

	public function keygen($length = 8)
	{
		return hash_pbkdf2('md5', md5(mt_rand()), mcrypt_create_iv($length, MCRYPT_DEV_URANDOM), $length, $length);
	}
}