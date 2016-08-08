<?php
namespace ZN\Compression\Drivers;

use ZN\Compression\DriverMapping;

class BZDriver extends DriverMapping
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
	// Write
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $file
	// @param string $data
	// @param string $mode
	//
	//----------------------------------------------------------------------------------------------------
	public function write($file, $data, $mode)
	{
		$open = bzopen($file, $mode);
		
		if( empty($open) )
		{
			return \Exceptions::throws('Error', 'fileNotFound', $file);	
		}
		
		$return = bzwrite($open, $data, strlen($data));
		
		bzclose($open);
		
		return $return;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Read
	//----------------------------------------------------------------------------------------------------
	//
	// @param string  $file
	// @param numeric $length
	// @param string  $type
	//
	//----------------------------------------------------------------------------------------------------
	public function read($file, $length, $type)
	{
		$open = bzopen($file, $type);
		
		if( empty($open) )
		{
			return \Exceptions::throws('Error', 'fileNotFound', $file);	
		}
		
		$return = bzread($open, $length);
		
		bzclose($open);
		
		return $return;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Compress
	//----------------------------------------------------------------------------------------------------
	//
	// @param string  $data
	// @param int     $blockSize
	// @param int     $workFactor
	//
	//----------------------------------------------------------------------------------------------------
	public function compress($data, $blockSize, $workFactor)
	{
		nullCoalesce($blockSize, 4);
		nullCoalesce($workFactor, 0);

		return bzcompress($data, $blockSize, (int) $workFactor);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Uncompress
	//----------------------------------------------------------------------------------------------------
	//
	// @param string  $data
	// @param numeric $small
	//
	//----------------------------------------------------------------------------------------------------
	public function uncompress($data, $small)
	{
		return bzdecompress($data, $small);
	}
}