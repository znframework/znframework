<?php
class PhashDriver
{
	/***********************************************************************************/
	/* 	PASSWORD HASH LIBRARY				                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Phash
	/* Versiyon: 2.0 Eylül Güncellemesi
	/* Tanımlanma: Mixed
	/* Dahil Edilme: Gerektirmez
	/* Erişim: Phash::, $this->Phash, zn::$use->Phash, uselib('Phash')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/

	public function __construct()
	{
		if( ! isPhpVersion('5.5.0') )
		{
			die(getErrorMessage('Error', 'invalidVersion', array('%' => 'password_', '#' => '5.5.0')));		
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
		die(getErrorMessage('Error', 'undefinedFunction', "PhashDriver::$method()"));	
	}
	
	public function encrypt($data = '', $settings = array())
	{
		// Bu sürücü tarafından desteklenmemektedir.
		return lang('Error', 'notSupport');
	}
	
	public function decrypt($data = '', $settings = array())
	{
		// Bu sürücü tarafından desteklenmemektedir.
		return lang('Error', 'notSupport');
	}
	
	public function keygen($length)
	{
		return mb_substr(password_hash(Config::get('Encode', 'projectKey'), PASSWORD_BCRYPT), -$length);
	}
}