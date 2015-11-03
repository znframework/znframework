<?php
class HashDriver
{
	/***********************************************************************************/
	/* HASH LIBRARY							                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Hash
	/* Versiyon: 2.0 Eylül Güncellemesi
	/* Tanımlanma: Mixed
	/* Dahil Edilme: Gerektirmez
	/* Erişim: Hash::, $this->Hash, zn::$use->Hash, uselib('Hash')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/******************************************************************************************
	* CALL                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Geçersiz fonksiyon girildiğinde çağrılması için.						  |
	|          																				  |
	******************************************************************************************/
	public function __call($method = '', $param = '')
	{	
		die(getErrorMessage('Error', 'undefinedFunction', "HashDriver::$method()"));	
	}

	public function encrypt($data = '', $settings = array())
	{
		$cipher = isset($settings['cipher']) ? $settings['cipher'] : 'sha256';
	 	$key    = isset($settings['key'])    ? $settings['key']    : Config::get('Encode', 'projectKey'); 
		
		return base64_encode(trim(hash_hmac($cipher, $data, $key)));
	}
	
	public function decrypt($data = '', $settings = array())
	{
		// Bu sürücü tarafından desteklenmemektedir.
		return lang('Error', 'notSupport');
	}
	
	public function keygen($length)
	{
		return hash_pbkdf2('md5', md5(mt_rand()), mcrypt_create_iv($length, MCRYPT_DEV_URANDOM), $length, $length);
	}
}