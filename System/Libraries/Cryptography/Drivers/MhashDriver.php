<?php
class MhashDriver
{
	/***********************************************************************************/
	/* MHASH LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Mhash
	/* Versiyon: 2.0 Eylül Güncellemesi
	/* Tanımlanma: Mixed
	/* Dahil Edilme: Gerektirmez
	/* Erişim: Mhash::, $this->Mhash, zn::$use->Mhash, uselib('Mhash')
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
		die(getErrorMessage('Error', 'undefinedFunction', "MhashDriver::$method()"));	
	}

	public function encrypt($data = '', $settings = array())
	{
		$cipher = isset($settings['cipher']) ? $settings['cipher'] : 'sha256';
	 	$key    = isset($settings['key'])    ? $settings['key']    : Config::get('Encode', 'projectKey'); 
		
		// MHASH_ ön eki ilave ediliyor.
		$cipher = Convert::toConstant($cipher, 'MHASH_');
		
		return base64_encode(trim(mhash($cipher, $data, $key)));
	}
	
	public function decrypt($data = '', $settings = array())
	{
		// Bu sürücü tarafından desteklenmemektedir.
		return lang('Error', 'notSupport');
	}
	
	public function keygen($length)
	{
		return mhash_keygen_s2k(MHASH_MD5, md5(mt_rand()), md5(mt_rand()), $length);
	}
}