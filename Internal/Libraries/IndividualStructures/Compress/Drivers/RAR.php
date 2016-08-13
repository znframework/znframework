<?php namespace ZN\IndividualStructures\Drivers;

use ZN\IndividualStructures\CompressDriverMapping;

class RarDriver extends CompressDriverMapping
{
	//----------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //----------------------------------------------------------------------------------------------------

	//----------------------------------------------------------------------------------------------------
	// Extract
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string $source
	// @param  string $target
	// @return bool
	//
	//----------------------------------------------------------------------------------------------------
	public function extract($source, $target, $password)
	{
		$rarFile = rar_open($source, $password);
		$list    = rar_list($rarFile);
		
		if( ! empty($list) ) foreach( $list as $file ) 
		{
			$entry = rar_entry_get($rarFile, $file);
			$entry->extract($target);
		}
		else
		{
			return \Exceptions::throws('Error', 'emptyVariable', '$list');	
		}
		
		rar_close($rarFile);
	}
}