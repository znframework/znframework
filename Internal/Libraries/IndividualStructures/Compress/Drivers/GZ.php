<?php namespace ZN\IndividualStructures\Drivers;

use ZN\IndividualStructures\CompressDriverMapping;

class GZDriver extends CompressDriverMapping
{
	//--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------
	
	//--------------------------------------------------------------------------------------------------------
	// Write
	//--------------------------------------------------------------------------------------------------------
	//
	// @param string $file
	// @param string $data
	// @param string $mode
	//
	//--------------------------------------------------------------------------------------------------------
	public function write($file, $data, $mode)
	{
		$open = gzopen($file, $mode);
		
		if( empty($open) )
		{
			return \Exceptions::throws('Error', 'fileNotFound', $file);	
		}
		
		$return = gzwrite($open, $data, strlen($data));
		
		gzclose($open);
		
		return $return;
	}
	
	//--------------------------------------------------------------------------------------------------------
	// Read
	//--------------------------------------------------------------------------------------------------------
	//
	// @param string  $file
	// @param numeric $length
	// @param string  $type
	//
	//--------------------------------------------------------------------------------------------------------
	public function read($file, $length, $mode)
	{
		$open = gzopen($file, $mode);
		
		if( empty($open) )
		{
			return \Exceptions::throws('Error', 'fileNotFound', $file);	
		}
		
		$return = gzread($open, $length);
		
		gzclose($open);
		
		return $return;
	}
	
	//--------------------------------------------------------------------------------------------------------
	// Compress
	//--------------------------------------------------------------------------------------------------------
	//
	// @param string  $data
	// @param numeric $blockSize
	// @param mixed   $workFactor
	//
	//--------------------------------------------------------------------------------------------------------
	public function compress($data, $level, $encoding) 
	{
		nullCoalesce($encoding, 'deflate');

		return gzcompress($data, $level, \Converter::toConstant($encoding, 'ZLIB_ENCODING_'));
	}
	
	//--------------------------------------------------------------------------------------------------------
	// Uncompress
	//--------------------------------------------------------------------------------------------------------
	//
	// @param string  $data
	// @param numeric $small
	//
	//--------------------------------------------------------------------------------------------------------
	public function uncompress($data, $length)
	{
		return gzuncompress($data, $length);
	}
	
	//--------------------------------------------------------------------------------------------------------
	// Encode
	//--------------------------------------------------------------------------------------------------------
	//
	// @param string  $data
	// @param string  $encoding
	//
	//--------------------------------------------------------------------------------------------------------
	public function encode($data, $level, $encoding)
	{
		nullCoalesce($encoding, 'gzip');

		return gzencode($data, $level, \Converter::toConstant($encoding, 'FORCE_'));
	}
	
	//--------------------------------------------------------------------------------------------------------
	// Decode
	//--------------------------------------------------------------------------------------------------------
	//
	// @param string  $data
	// @param numeric $length
	//
	//--------------------------------------------------------------------------------------------------------
	public function decode($data, $length)
	{
		nullCoalesce($length, 0);

		return gzdecode($data, $length);
	}
	
	//--------------------------------------------------------------------------------------------------------
	// Deflate
	//--------------------------------------------------------------------------------------------------------
	//
	// @param string  $data
	// @param numeric $level
	// @param string  $encoding
	//
	//--------------------------------------------------------------------------------------------------------
	public function deflate($data, $level, $encoding)
	{
		nullCoalesce($encoding, 'raw');

		return gzdeflate($data, $level, \Converter::toConstant($encoding, 'ZLIB_ENCODING_'));
	}
	
	//--------------------------------------------------------------------------------------------------------
	// Inflate
	//--------------------------------------------------------------------------------------------------------
	//
	// @param string  $data
	// @param numeric $length
	//
	//--------------------------------------------------------------------------------------------------------
	public function inflate($data, $length)
	{		
		nullCoalesce($length, 0);

		return gzinflate($data, $length);
	}
}