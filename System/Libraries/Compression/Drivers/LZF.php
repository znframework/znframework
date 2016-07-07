<?php
namespace ZN\Compression\Drivers;

use ZN\Compression\CompressInterface;

class LZFDriver implements CompressInterface
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
		if( ! function_exists('lzf_compress') )
		{
			die(getErrorMessage('Error', 'undefinedFunctionExtension', 'LZF'));	
		}	
	}
	
	public function extract($source = NULL, $target = NULL, $password = NULL)
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	public function write($file = NULL, $data = NULL)
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	public function read($file = NULL, $length = NULL, $type = NULL)
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}

	/******************************************************************************************
	* COMPRESS		                                                                          *
	*******************************************************************************************
	| Genel Kullanım: LZF sıkıştırma işlemi.			     	 							  |
	|          																				  |
	******************************************************************************************/
	public function compress($data = '', $blockSize = NULL, $workFactor = NULL)
	{
		if( ! is_scalar($data) )
		{
			return \Errors::set('Error', 'valueParameter', '1.(data)');	
		}
		
		return lzf_compress($data);
	}
	
	/******************************************************************************************
	* UNCOMPRESS	                                                                          *
	*******************************************************************************************
	| Genel Kullanım: LZF sıkıştırmasını açma işlemi.								     	  |
	|          																				  |
	******************************************************************************************/
	public function uncompress($data = '', $small = 0)
	{
		if( ! is_scalar($data) )
		{
			return \Errors::set('Error', 'valueParameter', '1.(data)');	
		}

		return lzf_decompress($data);
	}
	
	public function encode($data = NULL, $level = NULL, $encoding = NULL)
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	public function decode($data = NULL, $length = NULL)
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
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