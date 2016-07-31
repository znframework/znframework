<?php
namespace ZN\Compression\Drivers;

use ZN\Compression\CompressAbstract\CompressAbstract;

class ZlibDriver extends CompressAbstract
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
		if( ! isPhpVersion('5.4.0') )
		{
			die(getErrorMessage('Error', 'invalidVersion', ['%' => 'zlib_', '#' => '5.4.0']));		
		}	
	}

	/******************************************************************************************
	* ENCODE		                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Zlibli bir dizge oluşturur.				     						  |
	|          																				  |
	******************************************************************************************/
	public function encode($data = '', $level = -1, $encoding = ZLIB_ENCODING_GZIP)
	{
		return zlib_encode($data, $encoding, $level);
	}
	
	/******************************************************************************************
	* DECODE	                                                      	                      *
	*******************************************************************************************
	| Genel Kullanım: Gzipli bir dizgenin sıkıştırmasını açar.								  |
	|          																				  |
	******************************************************************************************/
	public function decode($data = '', $length = 0)
	{
		return zlib_decode($data, $length);
	}
}