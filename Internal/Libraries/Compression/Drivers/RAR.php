<?php
namespace ZN\Compression\Drivers;

use ZN\Compression\DriverMapping;

class RarDriver extends DriverMapping
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