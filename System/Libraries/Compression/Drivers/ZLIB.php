<?php
namespace ZN\Compression\Drivers;

use ZN\Compression\CompressInterface;

class ZlibDriver implements CompressInterface
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
	
	public function extract($source = '', $target = '.', $password = NULL)
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	public function write($file = NULL, $data = NULL, $mode = NULL)
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	public function read($file = '', $length = 1024, $mode = 'r')
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	public function compress($data = '', $blockSize = NULL, $workFactor = NULL)
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	public function uncompress($data = '', $small = 0)
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}

	/******************************************************************************************
	* ENCODE		                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Zlibli bir dizge oluşturur.				     						  |
	|          																				  |
	******************************************************************************************/
	public function encode($data = '', $level = -1, $encoding = ZLIB_ENCODING_GZIP)
	{
		if( ! is_scalar($data) )
		{
			return \Errors::set('Error', 'valueParameter', '1.(data)');	
		}
		
		if( ! is_numeric($level) || ! is_numeric($encoding) )
		{
			return \Errors::set('Error', 'numericParameter', '2.(level) & 3.(encoding)');	
		}
		
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
		if( ! is_scalar($data) )
		{
			return \Errors::set('Error', 'valueParameter', '1.(data)');	
		}
		
		if( ! is_numeric($length) )
		{
			return \Errors::set('Error', 'numericParameter', '2.(length)');	
		}
		
		return zlib_decode ($data, $length);
	}
	
	public function deflate($data = NULL, $level = NULL, $encoding = NULL)
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	public function inflate($data = NULL, $length = NULL)
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
}