<?php
namespace ZN\IndividualStructures\Drivers;

use ZN\IndividualStructures\CompressDriverMapping;

class ZlibDriver extends CompressDriverMapping
{
	//----------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //----------------------------------------------------------------------------------------------------
	
	public function __construct()
	{
		if( ! isPhpVersion('5.4.0') )
		{
			die(getErrorMessage('Error', 'invalidVersion', ['%' => 'zlib_', '#' => '5.4.0']));		
		}	
	}

	//----------------------------------------------------------------------------------------------------
	// Encode
	//----------------------------------------------------------------------------------------------------
	//
	// @param string  $data
	// @param mixed   $encoding
	//
	//----------------------------------------------------------------------------------------------------
	public function encode($data, $level, $encoding)
	{
		nullCoalesce($encoding, 'gzip');

		return zlib_encode($data, \Converter::toConstant($encoding, 'ZLIB_ENCODING_'), $level);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Decode
	//----------------------------------------------------------------------------------------------------
	//
	// @param string  $data
	// @param numeric $length
	//
	//----------------------------------------------------------------------------------------------------
	public function decode($data, $length)
	{
		return zlib_decode($data, $length);
	}
}