<?php	
namespace ZN\Database;

class InternalDBTool extends DatabaseCommon implements DBToolInterface
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
	// Tool
	//----------------------------------------------------------------------------------------------------
	// 
	// @var object
	//
	//----------------------------------------------------------------------------------------------------
	protected $tool;

	public function __construct()
	{
		parent::__construct();

		$this->tool = uselib($this->_drvlib($this->config['driver'], 'Tool'));
	}

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
		if( $otherListDatabases = $this->tool->listDatabases() )
		{
			return $otherListDatabases;
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
		if( $otherListTables = $this->tool->listTables() )
		{
			return $otherListTables;
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
		if( $otherOptimizeTable = $this->tool->optimizeTables($table) )
		{
			return $otherOptimizeTable;
		}

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
		if( $otherRepairTables = $this->tool->repairTables($table) )
		{
			return $otherRepairTables;
		}

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
	public function backup($tables = '*', String $fileName = NULL, $path = STORAGE_DIR)
	{		
		if( $otherBackup = $this->tool->backup($tables, $fileName, $path) )
		{
			return $otherBackup;
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
			return \Exceptions::throws('Error', 'fileNotWrite', $path.$fileName);
		}
		
		return lang('Database', 'backupTablesSuccess');
	}
}