<?php
namespace ZN\Cryptography\Drivers;

use ZN\Cryptography\CryptoInterface;

class PhashDriver implements CryptoInterface
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
		if( ! isPhpVersion('5.5.0') )
		{
			die(getErrorMessage('Error', 'invalidVersion', ['%' => 'password_', '#' => '5.5.0']));		
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
	
	public function encrypt($data = '', $settings = [])
	{
		// Bu sürücü tarafından desteklenmemektedir.
		return lang('Error', 'notSupport');
	}
	
	public function decrypt($data = '', $settings = [])
	{
		// Bu sürücü tarafından desteklenmemektedir.
		return lang('Error', 'notSupport');
	}
	
	public function keygen($length = 8)
	{
		return mb_substr(password_hash(\Config::get('Encode', 'projectKey'), PASSWORD_BCRYPT), -$length);
	}
}