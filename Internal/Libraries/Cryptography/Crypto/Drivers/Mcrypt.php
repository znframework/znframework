<?php
namespace ZN\Cryptography\Drivers;

use ZN\Cryptography\CryptoInterface;

class McryptDriver implements CryptoInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	/******************************************************************************************
	* CALL                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Geçersiz fonksiyon girildiğinde çağrılması için.						  |
	|          																				  |
	******************************************************************************************/
	public function __call($method = '', $param = '')
	{	
		die(getErrorMessage('Error', 'undefinedFunction', "McryptDriver::$method()"));	
	}

	/******************************************************************************************
	* ENCRYPT                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Dizgeyi şifreler.										 		          |
	
	  @param string $data
	  @param array  $settings -> cipher, key, mode, vector
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	public function encrypt($data = '', $settings = [])
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
	
	/******************************************************************************************
	* DECRYPT                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Şifrelenmiş dizgeyi çözer.							 		          |
	
	  @param string $data
	  @param array  $settings -> cipher, key, mode, vector
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	public function decrypt($data = '', $settings = [])
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
	
	/******************************************************************************************
	* KEYGEN                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen uzunlukta anahtar oluşturur.				 		          |
	
	  @param string $length = 8
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	public function keygen($length = 8)
	{
		return mcrypt_create_iv($length, MCRYPT_DEV_URANDOM);
	}
	
	/******************************************************************************************
	* PROTECTED KEY SIZE                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Key belirtilmezse ön tanımlı key oluşturmak içindir.	 		          |
	
	  @param string $cipher
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	private function keySize($cipher = '')
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
	
	/******************************************************************************************
	* PROTECTED VECTOR SIZE                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Iv belirtilmezse ön tanımlı iv oluşturmak içindir.	 		          |
	
	  @param string $mode
	  @param string $cipher
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	protected function vectorSize($mode = '', $cipher = '')
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