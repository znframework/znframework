<?php	
class __USE_STATIC_ACCESS__DBTool
{	
	/***********************************************************************************/
	/* DB TOOL LIBRARY		    		                   	                           */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: DBTool
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: $this->dbtool, zn::$use->dbtool, uselib('dbtool')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
		
	/* Prefix Değişkeni
	 *  
	 * Tablo ön eki bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $prefix;
	
	/******************************************************************************************
	* CONSTRUCT                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Nesne tanımlaması ve veritabanı ayarları çalıştırılıyor.				  |
	|          																				  |
	******************************************************************************************/
	public function __construct($config = array())
	{
		require_once(SYSTEM_LIBRARIES_DIR.'Database/DBCommon.php');
		
		$this->db = DBCommon();
		
		$this->prefix = Config::get('Database', 'prefix');
		
		if( empty($config) ) 
		{
			$config = Config::get('Database');
		}
		
		$this->db->connect($config);
	}
	
	/******************************************************************************************
	* LIST DATABASES                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Database listesini öğrenmek için kullanılır.  					      |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: $this->dbtool->listDatabases();        		 						  |
	|          																				  |
	******************************************************************************************/
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
		
		$newDatabases = array();
		
		foreach($this->db->result() as $databases)
		{
			foreach ($databases as $db => $database)
			{
				$newDatabases[] = $database;
			}
		}
		
		return $newDatabases;
	}
	
	/******************************************************************************************
	* LIST TABLES                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Tablo listesini öğrenmek için kullanılır.  					      	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: $this->dbtool->listTables();        		 							  |
	|          																				  |
	******************************************************************************************/
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
		
		$newTables = array();
		
		foreach($this->db->result() as $tables)
		{
			foreach ($tables as $tb => $table)
			{
				$newTables[] = $table;
			}
		}
		
		return $newTables;
	}
	
	/******************************************************************************************
	* BACKUP                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Veritabanının yedeğini almak için kullanılır.  					      |
	|															                              |
    | Parametreler: 3 parametresi vardır.                                              		  |
	| 1. string/array var @tables => Yedeği alınmak istenen tablo listesi. Varsayılan:*       |
	| 2. string var @filename => Hangi isimle kaydedileceği. Varsayılan:*       			  |
	| 3. string var @path => Yedeğin kaydedileceği dizin. Varsayılan:FILES_DIR		          |
	|          																				  |
	| Örnek Kullanım: $this->dbtool->backup('*', 'backup');        		 					  |
	|          																				  |
	******************************************************************************************/
	public function backup($tables = '*', $fileName = '', $path = FILES_DIR)
	{		
		if( $this->db->backup($fileName) !== false )
		{
			return $this->db->backup($fileName);
		}
		
		if( $tables === '*' )
		{
			$tables = array();
			
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
		
		foreach($tables as $table)
		{
			if( ! empty($this->prefix) && ! strstr($table, $this->prefix) )
			{
				$table = $this->prefix.$table;
			}
			
		    $this->db->query('SELECT * FROM '.$table);
			
			$numFields = $this->db->numFields();

			$return.= 'DROP TABLE '.$table.';';
			$this->db->query('SHOW CREATE TABLE '.$table);
			$row2 = $this->db->fetchRow();
			$return.= eol(2).$row2[1].";".eol(2);
		
			for ($i = 0; $i < $numFields; $i++) 
			{
				
				while($row = $this->db->fetchRow())
				{
					$return.= 'INSERT INTO '.$table.' VALUES(';
					
					for($j=0; $j<$numFields; $j++) 
					{
						$row[$j] = addslashes($row[$j]);
						$row[$j] = preg_replace("/\n/","\\n",$row[$j]);
						
						if ( isset($row[$j]) ) 
						{ 
							$return.= '"'.$row[$j].'"' ; 
						} 
						else 
						{ 
							$return.= '""'; 
						}
						
						if ( $j<($numFields-1) ) 
						{ 
							$return.= ','; 
						}
					}
					$return.= ");".eol();
				}
			}
			$return .= eol(3);
		}
		
		if( empty($fileName) ) 
		{ 
			$fileName = 'db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql';
		}
		
		$handle = fopen($path.$fileName, 'w+');
		fwrite($handle, $return);
		fclose($handle);
		
		return getMessage('Database', 'backupTablesSuccess');
	}
	
	/******************************************************************************************
	* OPTIMIZE TABLES                                                                         *
	*******************************************************************************************
	| Genel Kullanım: Tabloları optimize etmek için kullanılır.  					    	  |
	|															                              |
    | Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string/array var @table => Optimize edilmesi istenilen tablo listesi. Varsayılan:*   |
	|          																				  |
	| Örnek Kullanım: $this->dbtool->optimizeTables("tbl1, tbl2"); 					      |
	|          																				  |
	******************************************************************************************/
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
	
		return getMessage('Database', 'optimizeTablesSuccess');
	}
	
	/******************************************************************************************
	* REPAIR TABLES                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Tabloları onarmak etmek için kullanılır.      	     		    	  |
	|															                              |
    | Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string/array var @table => Onarılması istenilen tablo listesi. Varsayılan:*          |
	|          																				  |
	| Örnek Kullanım: $this->dbtool->repairTables("tbl1, tbl2");        		 			  |
	|          																				  |
	******************************************************************************************/
	public function repairTables($table = '*')
	{
		$this->db->query("SHOW TABLES");
		
		if( $table === '*' )
		{
			foreach( $this->db->result() as $tables )
			{
				foreach ($tables as $db => $tableName)
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
				
		return getMessage('Database', 'repairTablesSuccess');
	}
	
	/******************************************************************************************
	* DIFFERENT CONNECTION                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Birden fazla ve birden farklı veritabanı bağlantısı yapmak içindir.	  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @connect_name => Bağlantı veri dizisi ismi.       	                      |
	|          																				  |
	| >>>>>>>>>>>>>>>>>>>>>>>>>>>Detaylı kullanım için zntr.net<<<<<<<<<<<<<<<<<<<<<<<<<<  	  |
	|          																				  |
	******************************************************************************************/
	public function differentConnection($connectName = '')
	{
		if( ! is_string($connectName) ) 
		{
			return false;
		}
		
		$config = Config::get('Database');
		$configDifferent = $config['differentConnection'];
		
		if( ! isset($configDifferent[$connectName]) ) 
		{
			return false;
		}
		
		foreach( $config as $key => $val )
		{
			if( $key !== 'differentConnection' )
			{
				if( ! isset($configDifferent[$connectName][$key]) )
				{
					$configDifferent[$connectName][$key] = $val;
				}
			}
		}
		
		return new DbTool($configDifferent[$connectName]);
	}
	
	/******************************************************************************************
	* ERROR                                                                                   *
	******************************************************************************************/
	public function error()
	{
		Error::set($this->db->error()); 
		return $this->db->error(); 
	}
	
	/******************************************************************************************
	* DESTRUCT                                                                                *
	******************************************************************************************/
	public function __destruct()
	{
		$this->db->close();	
	}
}