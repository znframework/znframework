<?php
namespace ZN\Cryptography\Drivers;

use ZN\Cryptography\CryptoMapping;

class McryptDriver extends CryptoMapping
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Encrypt
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $data
	// @param array  $settings
	//
	//----------------------------------------------------------------------------------------------------
	public function encrypt($data, $settings)
	{
		$cipher = isset($settings['cipher']) ? $settings['cipher'] : 'des';
		$cipher = str_replace('-', '_', $cipher);
	 	$key    = isset($settings['key'])    ? $settings['key']    : $this->keySize($cipher); 
		$mode   = isset($settings['mode'])   ? $settings['mode']   : 'cbc';
		$iv     = isset($settings['vector']) ? $settings['vector'] : $this->vectorSize($mode, $cipher);

		// MCRYPT_ ön eki ilave ediliyor.
		$cipher = \Convert::toConstant($cipher, 'MCRYPT_');
		
		// MCRYPT_MODE_ ön eki ilave ediliyor.
		$mode   = \Convert::toConstant($mode, 'MCRYPT_MODE_');
		
		$encode = trim(mcrypt_encrypt($cipher, $key, $data, $mode, $iv));
		
		return base64_encode($encode);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Decrypt
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $data
	// @param array  $settings
	//
	//----------------------------------------------------------------------------------------------------
	public function decrypt($data, $settings)
	{
		$cipher = isset($settings['cipher']) ? $settings['cipher'] : 'des';
		$cipher = str_replace('-', '_', $cipher);
	 	$key    = isset($settings['key'])    ? $settings['key']    : $this->keySize($cipher); 
		$mode   = isset($settings['mode'])   ? $settings['mode']   : 'cbc';
		$iv     = isset($settings['vector']) ? $settings['vector'] : $this->vectorSize($mode, $cipher);
		
		// MCRYPT_ ön eki ilave ediliyor.
		$cipher = \Convert::toConstant($cipher, 'MCRYPT_');
		
		// MCRYPT_MODE_ ön eki ilave ediliyor.
		$mode   = \Convert::toConstant($mode, 'MCRYPT_MODE_');
		
		$data = base64_decode($data);
		
		return trim(mcrypt_decrypt($cipher, $key, trim($data), $mode, $iv));
	}
	
	//----------------------------------------------------------------------------------------------------
	// Keygen
	//----------------------------------------------------------------------------------------------------
	//
	// @param numeric $length
	//
	//----------------------------------------------------------------------------------------------------
	public function keygen($length)
	{
		return mcrypt_create_iv($length, MCRYPT_DEV_URANDOM);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected
	//----------------------------------------------------------------------------------------------------
	private function keySize($cipher)
	{
		$cipher = strtolower($cipher);
		
		$ciphers = array
		(	
			'des'  										 	=> 8,
			'cast_128|rijndael_128|serpent|twofish|xtea' 	=> 16,
			'3des|rijndael_192|saferplus|tripledes'    		=> 24,
			'cast_256|gost|loki97|rijndael_256'				=> 32
				
		);
		
		$ciphers = \Arrays::multikey($ciphers);
		
		if( ! isset($ciphers[$cipher]) )
		{
			$ciphers[$cipher] = 8;	
		}
		
		return mb_substr(hash('md5', \Config::get('Encode', 'projectKey')), 0, $ciphers[$cipher]);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected
	//----------------------------------------------------------------------------------------------------
	protected function vectorSize($mode, $cipher)
	{
		$mode   = strtolower($mode);
		$cipher = strtolower($cipher);
		
		$modes = array
		(
			'cbc'      													=> 8,
			'cast_256|loki97|rijndael_128|saferplus|serpent|twofish' 	=> 16,
			'rijndael_192'												=> 24,
			'rijndael_256'												=> 32,
		);
		
		$modes = \Arrays::multikey($modes);
		
		$mode = isset($modes[$mode]) ? $modes[$mode] : 8;
		
		if( ! empty($cipher) )
		{
			$mode = isset($modes[$cipher]) ? $modes[$cipher] : $mode;
		}
		
		return mb_substr(hash('sha1', \Config::get('Encode', 'projectKey')), 0, $mode);
	}
}