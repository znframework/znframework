<?php namespace ZN\Database;

class DriverTool
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
		$result = \DB::query('SHOW DATABASES')->result();
		
		if( \DB::error() ) 
		{
			return [];
		}
		
		$newDatabases = [];
		
		foreach( $result as $databases )
		{
			foreach ($databases as $db => $database)
			{
				$newDatabases[] = $database;
			}
		}
		
		return $newDatabases;
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
		$result = \DB::query('SHOW TABLES')->result();
		
		if( \DB::error() ) 
		{
			return [];
		}
		
		$newTables = [];
		
		foreach( $result as $tables )
		{
			foreach( $tables as $tb => $table )
			{
				$newTables[] = $table;
			}
		}
		
		return $newTables;
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
		$result = \DB::query("SHOW TABLES")->result();
		
		if( $table === '*' )
		{
			foreach( $result as $tables )
			{
				foreach( $tables as $db => $tableName )
				{
					\DB::query("OPTIMIZE TABLE ".$tableName);
				}
			}
			
			if( \DB::error() ) 
			{
				return false;
			}
		}
		else
		{
			$tables = is_array($table)
					? $table
					: explode(',',$table);
			
			foreach( $tables as $tableName )
			{
				\DB::query("OPTIMIZE TABLE ".$this->prefix.$tableName);
			}
				
			if( \DB::error() ) 
			{
				return false;
			}
		}
	
		return lang('Database', 'optimizeTablesSuccess');
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
		$result = \DB::query("SHOW TABLES")->result();
		
		if( $table === '*' )
		{
			foreach( $result as $tables )
			{
				foreach( $tables as $db => $tableName )
				{
					\DB::query("REPAIR TABLE ".$tableName);
				}
			}
			
			if( \DB::error() ) 
			{
				return false;
			}
		}
		else
		{	
			$tables = is_array($table)
					? $table
					: explode(',',$table);
			
			foreach( $tables as $tableName )
			{
				\DB::query("REPAIR TABLE  ".$this->prefix.$tableName);
			}
			
			if( \DB::error() ) 
			{
				return false;
			}
		}
				
		return lang('Database', 'repairTablesSuccess');
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
		if( $path === STORAGE_DIR )
		{
			$path .= 'DatabaseBackup';
		}
		
		$eol = EOL;
		
		if( $tables === '*' )
		{
			$tables = [];
			
			$fetchRow = \DB::query('SHOW TABLES')->fetchRow();
			
			while( $row = $fetchRow )
			{
				$tables[] = $row[0];
			}
		}
		else
		{
			$tables = ( is_array($tables) ) 
					  ? $tables 
					  : explode(',',$tables);
		}
		
		$return = NULL;
		
		foreach( $tables as $table )
		{
			if( ! empty($this->prefix) && ! strstr($table, $this->prefix) )
			{
				$table = $this->prefix.$table;
			}
			
			$return.= 'DROP TABLE IF EXISTS '.$table.';';
			
			$fetchRow = \DB::query('SHOW CREATE TABLE '.$table)->fetchRow();
		
			$fetchResult = \DB::query('SELECT * FROM '.$table)->result();
		
			$return.= $eol.$eol.$fetchRow[1].";".$eol.$eol;
		
			if( ! empty($fetchResult) ) foreach( $fetchResult as $row ) 
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				
				foreach( $row as $k => $v )
				{
					$v  = \DB::realEscapeString($v);
					$v  = preg_replace("/\n/","\\n", $v );
					
					if ( isset($v) ) 
					{ 
						$return.= '"'.$v .'", ' ; 
					} 
					else 
					{ 
						$return.= '"", '; 
					}
				}
				
				$return = rtrim(trim($return), ', ');
			
				$return.= ");".$eol;	
			}
			
			$return .= $eol.$eol.$eol;
		}
		
		if( empty($fileName) ) 
		{ 
			$fileName = 'db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql';
		}
		
		if( ! is_dir($path) )
		{
			mkdir($path, 0755, true);	
		}
		
		if( ! file_put_contents(suffix($path).$fileName, $return) )
		{
			return \Exceptions::throws('Error', 'fileNotWrite', $path.$fileName);
		}
		
		return lang('Database', 'backupTablesSuccess');
	}
}