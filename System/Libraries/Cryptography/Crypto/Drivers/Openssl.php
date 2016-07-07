<?php
namespace ZN\Cryptography\Drivers;

use ZN\Cryptography\CryptoInterface;

class OpensslDriver implements CryptoInterface
{	
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	public function __construct()
	{
		if( ! function_exists('openssl_open') )
		{
			die(getErrorMessage('Error', 'undefinedFunctionExtension', 'OPENSSL'));	
		}	
	}
	
	/******************************************************************************************
	* CALL                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Geçersiz fonksiyon girildiğinde çağrılması için.						  |
	|          																				  |
	******************************************************************************************/
	public function __call($method = '', $param = '')
	{	
		die(getErrorMessage('Error', 'undefinedFunction', "OpensslDriver::$method()"));	
	}
	
	/******************************************************************************************
	* ENCRYPT                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Dizgeyi şifreler.										 		          |
	
	  @param string $data
	  @param array  $settings -> cipher, key, mode, iv
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	public function encrypt($data = '', $settings = [])
	{
		$cipher = isset($settings['cipher']) ? $settings['cipher'] : 'aes-128';
	 	$key    = isset($settings['key'])    ? $settings['key']    : $this->keySize($cipher); 
		$mode   = isset($settings['mode'])   ? $settings['mode']   : 'cbc';
		$iv     = isset($settings['vector']) ? $settings['vector'] : $this->vectorSize($mode, $cipher);
		
		$cipher = $cipher."-".$mode;

		$encode = trim(openssl_encrypt($data, strtolower($cipher), $key, 1, $iv));
		
		return base64_encode($encode);
	}
	
	/******************************************************************************************
	* DECRYPT                                                                                 *
	********************************************ofb*********************************************
	| Genel Kullanım: Şifrelenmiş dizgeyi çözer.							 		          |
	
	  @param string $data
	  @param array  $settings -> cipher, key, mode, iv
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	public function decrypt($data = '', $settings = [])
	{
		$cipher = isset($settings['cipher']) ? $settings['cipher'] : 'aes-128';
	 	$key    = isset($settings['key'])    ? $settings['key']    : $this->keySize($cipher); 
		$mode   = isset($settings['mode'])   ? $settings['mode']   : 'cbc';
		$iv     = isset($settings['vector']) ? $settings['vector'] : $this->vectorSize($mode, $cipher);

		$cipher = $cipher."-".$mode;
		
		$data = base64_decode($data);
		
		return trim(openssl_decrypt(trim($data), $cipher, $key, 1, $iv));
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
		return openssl_random_pseudo_bytes($length);
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
			'aes-128' 	=> 16,
		);
		
		$ciphers = \Arrays::multikey($ciphers);
		
		if( ! isset($ciphers[$cipher]) )
		{
			$ciphers[$cipher] = 16;	
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
			'cbc' 	=> 16,
			'rc2'   => 8,
			'ecb'   => 0
		);
		
		$modes = \Arrays::multikey($modes);
		
		$mode = isset($modes[$mode]) ? $modes[$mode] : 16;
		
		if( ! empty($cipher) )
		{
			$mode = isset($modes[$cipher]) ? $modes[$cipher] : $mode;
		}
		
		return mb_substr(hash('sha1', \Config::get('Encode', 'projectKey')), 0, $mode);
	}
}