<?php
namespace ZN\Database\Abstracts;

abstract class ToolAbstract
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
	// List Databases
	//----------------------------------------------------------------------------------------------------
	//
	// Hostunuda yer var olan veritabanlarını listeler.
	//
	// @param  void
	// @return array
	//
	//----------------------------------------------------------------------------------------------------
	public function listDatabases()
	{
		return false;
	}

	//----------------------------------------------------------------------------------------------------
	// List Tables
	//----------------------------------------------------------------------------------------------------
	//
	// Bağlı olduğunuz veritabanına ait tabloları listeler.
	//
	// @param  void
	// @return array
	//
	//----------------------------------------------------------------------------------------------------
	public function listTables()
	{
		return false;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Optimize Tables
	//----------------------------------------------------------------------------------------------------
	//
	// Bağlı olduğunuz veritabanına ait tabloları optimize eder.
	//
	// @param  mixed $table: '*', 'tbl1, tbl2' ya da array('tbl1', 'tbl2')
	// @return string message
	//
	//----------------------------------------------------------------------------------------------------
	public function optimizeTables($table)
	{
		return false;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Repair Tables
	//----------------------------------------------------------------------------------------------------
	//
	// Bağlı olduğunuz veritabanına ait tabloları onarır.
	//
	// @param  mixed $table: '*', 'tbl1, tbl2' ya da array('tbl1', 'tbl2')
	// @return string message
	//
	//----------------------------------------------------------------------------------------------------
	public function repairTables($table)
	{
		return false;
	}

	//----------------------------------------------------------------------------------------------------
	// Backup
	//----------------------------------------------------------------------------------------------------
	//
	// Bağlı olduğunuz veritabanına ait tablolarınızın yedeğini alır.
	// Yedek dosyası içerisinde tablo oluşturma veriler ve kayıtlar yer alır.
	//
	// @param  mixed  $table: '*', 'tbl1, tbl2' ya da array('tbl1', 'tbl2')
	// @param  string $filename
	// @return string $path: STORAGE_DIR
	//
	//----------------------------------------------------------------------------------------------------
	public function backup($tables, $fileName, $path)
	{
		return false;		
	}
}