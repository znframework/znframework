<?php
namespace ZN\Database\Drivers;

use ZN\Database\DriverForge;

class SQLiteForge extends DriverForge
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
	// Truncate
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $table
	//
	//----------------------------------------------------------------------------------------------------	
	public function truncate($table)
	{ 
		return 'DELETE FROM '.$table; 
	}
}