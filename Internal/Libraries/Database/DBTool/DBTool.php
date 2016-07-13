<?php	
namespace ZN\Database;

class InternalDBTool implements DBToolInterface, DatabaseInterface
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
	// Common
	//----------------------------------------------------------------------------------------------------
	// 
	// $config
	// $prefix
	// $secure
	// $table
	// $tableName
	// $stringQuery
	// $unlimitedStringQuery
	//
	// run()
	// table()
	// stringQuery()
	// differentConnection()
	// secure()
	// error()
	// close()
	// version()
	//
	//----------------------------------------------------------------------------------------------------
	use DatabaseTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Database Methods Başlangıç
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
		if( $this->db->listDatabases() !== false )
		{
			return $this->db->listDatabases();
		}
		
		$this->db->query('SHOW DATABASES');
		
		if( $this->db->error() ) 
		{
			return false;
		}
		
		$newDatabases = [];
		
		foreach( $this->db->result() as $databases )
		{
			foreach ($databases as $db => $database)
			{
				$newDatabases[] = $database;
			}
		}
		
		return $newDatabases;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Database Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Table Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

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
		if( $this->db->listTables() !== false )
		{
			return $this->db->listTables();
		}
		
		$this->db->query('SHOW TABLES');
		
		if( $this->db->error() ) 
		{
			return false;
		}
		
		$newTables = [];
		
		foreach( $this->db->result() as $tables )
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
	public function optimizeTables($table = '*')
	{
		$this->db->query("SHOW TABLES");
		
		if( $table === '*' )
		{
			foreach( $this->db->result() as $tables )
			{
				foreach( $tables as $db => $tableName )
				{
					$this->db->query("OPTIMIZE TABLE ".$tableName);
				}
			}
			
			if( $this->db->error() ) 
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
				$this->db->query("OPTIMIZE TABLE ".$this->prefix.$tableName);
			}
				
			if( $this->db->error() ) 
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
	public function repairTables($table = '*')
	{
		$this->db->query("SHOW TABLES");
		
		if( $table === '*' )
		{
			foreach( $this->db->result() as $tables )
			{
				foreach( $tables as $db => $tableName )
				{
					$this->db->query("REPAIR TABLE ".$tableName);
				}
			}
			
			if( $this->db->error() ) 
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
				$this->db->query("REPAIR TABLE  ".$this->prefix.$tableName);
			}
			
			if( $this->db->error() ) 
			{
				return false;
			}
		}
				
		return lang('Database', 'repairTablesSuccess');
	}
	
	//----------------------------------------------------------------------------------------------------
	// Table Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Backup Method Başlangıç
	//----------------------------------------------------------------------------------------------------

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
	public function backup($tables = '*', $fileName = '', $path = STORAGE_DIR)
	{		
		if( $this->db->backup($fileName) !== false )
		{
			return $this->db->backup($fileName);
		}
		
		if( $path === STORAGE_DIR )
		{
			$path .= 'DatabaseBackup';
		}
		
		$eol = EOL;
		
		if( $tables === '*' )
		{
			$tables = [];
			
			$this->db->query('SHOW TABLES');
			
			while($row = $this->db->fetchRow())
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
			
			// Yedek yüklenirken aynı isimler
			// var olan tablolar silinir.
			$return.= 'DROP TABLE IF EXISTS '.$table.';';
			
			// Tabloların oluşturulma seması çıkartılır.
			$this->db->query('SHOW CREATE TABLE '.$table);
			$fetchRow = $this->db->fetchRow();
			
			// Yedeğe eklenecek kayıtlar oluşturuluyor.
			$this->db->query('SELECT * FROM '.$table);
			$fetchResult = $this->db->result();
		
			$return.= $eol.$eol.$fetchRow[1].";".$eol.$eol;
		
			if( ! empty($fetchResult) ) foreach( $fetchResult as $row ) 
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				
				foreach( $row as $k => $v )
				{
					$v  = $this->db->realEscapeString($v );
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
			\Errors::set('Error', 'fileNotWrite', $path.$fileName);
		}
		
		return lang('Database', 'backupTablesSuccess');
	}
	
	//----------------------------------------------------------------------------------------------------
	// Backup Method Bitiş
	//----------------------------------------------------------------------------------------------------
}