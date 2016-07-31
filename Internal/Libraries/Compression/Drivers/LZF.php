<?php
namespace ZN\Compression\Drivers;

use ZN\Compression\CompressAbstract\CompressAbstract;

class LZFDriver extends CompressAbstract
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

	/******************************************************************************************
	* COMPRESS		                                                                          *
	*******************************************************************************************
	| Genel Kullanım: LZF sıkıştırma işlemi.			     	 							  |
	|          																				  |
	******************************************************************************************/
	public function compress($data = '', $blockSize = NULL, $workFactor = NULL)
	{
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
		return lzf_decompress($data);
	}
}