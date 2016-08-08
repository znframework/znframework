<?php
namespace ZN\Cryptography\Drivers;

use ZN\Cryptography\CryptoMapping;

class PhashDriver extends CryptoMapping
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
	// Construct
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function __construct()
	{
		if( ! isPhpVersion('5.5.0') )
		{
			die(getErrorMessage('Error', 'invalidVersion', ['%' => 'password_', '#' => '5.5.0']));		
		}	
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
		return mb_substr(password_hash(\Config::get('Encode', 'projectKey'), PASSWORD_BCRYPT), -$length);
	}
}