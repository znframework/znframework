<?php
namespace ZN\Compression\Drivers;

use ZN\Compression\DriverMapping;

class LZFDriver extends DriverMapping
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
		\Support::func('lzf_compress', 'LZF');	
	}

	//----------------------------------------------------------------------------------------------------
	// Compress
	//----------------------------------------------------------------------------------------------------
	//
	// @param string  $data
	// @param numeric $blockSize
	// @param mixed   $workFactor
	//
	//----------------------------------------------------------------------------------------------------
	public function compress($data, $level = NULL, $encoding = NULL)
	{
		return lzf_compress($data);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Uncompress
	//----------------------------------------------------------------------------------------------------
	//
	// @param string  $data
	// @param numeric $small
	//
	//----------------------------------------------------------------------------------------------------
	public function uncompress($data, $length = NULL)
	{
		return lzf_decompress($data);
	}
}