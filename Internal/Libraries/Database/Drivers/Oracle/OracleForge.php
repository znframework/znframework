<?php
namespace ZN\Database\Drivers;

use ZN\Database\Abstracts\ForgeAbstract;

class OracleForge extends ForgeAbstract
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
	// Rename Column
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $table
	// @param mixed  $column
	//
	//----------------------------------------------------------------------------------------------------
	public function renameColumn($table, $column)
	{ 
		return 'ALTER TABLE '.$table.' RENAME COLUMN '.key($column).' TO '.current($column).';';
	}
}