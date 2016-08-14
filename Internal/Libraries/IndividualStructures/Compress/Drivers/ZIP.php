<?php namespace ZN\IndividualStructures\Drivers;

use ZN\IndividualStructures\CompressDriverMapping;

class ZipDriver extends CompressDriverMapping
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
	// Extract
	//--------------------------------------------------------------------------------------------------------
	// 
	// @param  string $source
	// @param  string $target
	// @return bool
	//
	//--------------------------------------------------------------------------------------------------------
	public function extract($source, $target, $password = NULL)
	{
		return \File::zipExtract($source, $target);
	}
	
	//--------------------------------------------------------------------------------------------------------
	// Read
	//--------------------------------------------------------------------------------------------------------
	//
	// @param string  $file
	//
	//--------------------------------------------------------------------------------------------------------
	public function read($file, $length = NULL, $mode = NULL)
	{
		$open = zip_open($file);
		
		if( empty($open) )
		{
			return \Exceptions::throws('Error', 'fileNotFound', $file);	
		}
		
		$return = zip_read($open);
		
		zip_close($open);
		
		return $return;
	}
}