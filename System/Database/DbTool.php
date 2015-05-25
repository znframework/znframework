<?php
/************************************************************/
/*                     DB TOOL LIBRARY                      */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* DbTool		                                                                          *
*******************************************************************************************
| Dahil(Import) Edilirken : DbTool 							                              |
| Sınıfı Kullanırken      :	$this->dbtool->												  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/	
class DbTool
{		
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
		require_once(DB_DIR.'DbCommon.php');
		
		$this->db = dbcommon();
		
		$this->prefix = config::get('Database', 'prefix');
		
		if( empty($config) ) 
		{
			$config = config::get('Database');
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
	| Örnek Kullanım: $this->dbtool->list_databases();        		 						  |
	|          																				  |
	******************************************************************************************/
	public function list_databases()
	{
		if( $this->db->list_databases() !== false )
		{
			return $this->db->list_databases();
		}
		
		$this->db->query('SHOW DATABASES');
		
		if( $this->db->error() ) 
		{
			return false;
		}
		
		$newdatabases = array();
		
		foreach($this->db->result() as $databases)
		{
			foreach ($databases as $db => $database)
			{
				$newdatabases[] = $database;
			}
		}
		
		return $newdatabases;
	}
	
	/******************************************************************************************
	* LIST TABLES                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Tablo listesini öğrenmek için kullanılır.  					      	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: $this->dbtool->list_tables();        		 							  |
	|          																				  |
	******************************************************************************************/
	public function list_tables()
	{
		if( $this->db->list_tables() !== false )
		{
			return $this->db->list_tables();
		}
		
		$this->db->query('SHOW TABLES');
		
		if( $this->db->error() ) 
		{
			return false;
		}
		
		$newtables = array();
		
		foreach($this->db->result() as $tables)
		{
			foreach ($tables as $tb => $table)
			{
				$newtables[] = $table;
			}
		}
		
		return $newtables;
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
	public function backup($tables = '*', $filename = '', $path = FILES_DIR)
	{		
		if( $this->db->backup($filename) !== false )
		{
			return $this->db->backup($filename);
		}
		
		if( $tables === '*' )
		{
			$tables = array();
			
			$this->db->query('SHOW TABLES');
			
			while($row = $this->db->fetch_row())
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
			
			$num_fields = $this->db->num_fields();

			$return.= 'DROP TABLE '.$table.';';
			$this->db->query('SHOW CREATE TABLE '.$table);
			$row2 = $this->db->fetch_row();
			$return.= ln(2).$row2[1].";".ln(2);
		
			for ($i = 0; $i < $num_fields; $i++) 
			{
				
				while($row = $this->db->fetch_row())
				{
					$return.= 'INSERT INTO '.$table.' VALUES(';
					
					for($j=0; $j<$num_fields; $j++) 
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
						
						if ( $j<($num_fields-1) ) 
						{ 
							$return.= ','; 
						}
					}
					$return.= ");".ln();
				}
			}
			$return .= ln(3);
		}
		
		if( empty($filename) ) 
		{ 
			$filename = 'db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql';
		}
		
		$handle = fopen($path.$filename,'w+');
		fwrite($handle,$return);
		fclose($handle);
		
		return get_message('Database', 'db_backup_tables_success');
	}
	
	/******************************************************************************************
	* OPTIMIZE TABLES                                                                         *
	*******************************************************************************************
	| Genel Kullanım: Tabloları optimize etmek için kullanılır.  					    	  |
	|															                              |
    | Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string/array var @table => Optimize edilmesi istenilen tablo listesi. Varsayılan:*   |
	|          																				  |
	| Örnek Kullanım: $this->dbtool->optimize_tables("tbl1, tbl2"); 					      |
	|          																				  |
	******************************************************************************************/
	public function optimize_tables($table = '*')
	{
		$this->db->query("SHOW TABLES");
		
		if( $table === '*' )
		{
			foreach($this->db->result() as $tables)
			{
				foreach ($tables as $db => $tablename)
				{
					$this->db->query("OPTIMIZE TABLE ".$tablename);
				}
			}
			
			if( $this->db->error() ) 
			{
				return false;
			}
		}
		else
		{
			$tables = ( is_array($table) ) 
					  ? $table
					  : explode(',',$table);
			
			foreach ($tables as $tablename)
			{
				$this->db->query("OPTIMIZE TABLE ".$this->prefix.$tablename);
			}
				
			if( $this->db->error() ) 
			{
				return false;
			}
		}
	
		return get_message('Database', 'db_optimize_tables_success');
	}
	
	/******************************************************************************************
	* REPAIR TABLES                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Tabloları onarmak etmek için kullanılır.      	     		    	  |
	|															                              |
    | Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string/array var @table => Onarılması istenilen tablo listesi. Varsayılan:*          |
	|          																				  |
	| Örnek Kullanım: $this->dbtool->repair_tables("tbl1, tbl2");        		 			  |
	|          																				  |
	******************************************************************************************/
	public function repair_tables($table = '*')
	{
		$this->db->query("SHOW TABLES");
		
		if( $table === '*' )
		{
			foreach($this->db->result() as $tables)
			{
				foreach ($tables as $db => $tablename)
				{
					$this->db->query("REPAIR TABLE ".$tablename);
				}
			}
			
			if( $this->db->error() ) 
			{
				return false;
			}
		}
		else
		{	
			$tables = ( is_array($table) ) 
					  ? $table
					  : explode(',',$table);
			
			foreach ($tables as $tablename)
			{
				$this->db->query("REPAIR TABLE  ".$this->prefix.$tablename);
			}
			
			if( $this->db->error() ) 
			{
				return false;
			}
		}
				
		return get_message('Database', 'db_repair_tables_success');
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
	public function different_connection($connect_name = '')
	{
		if( ! is_string($connect_name) ) 
		{
			return false;
		}
		
		$config = config::get('Database');
		$config_different = $config['different_connection'];
		
		if( ! isset($config_different[$connect_name]) ) 
		{
			return false;
		}
		
		foreach($config as $key => $val)
		{
			if( $key !== 'different_connection' )
			{
				if( ! isset($config_different[$connect_name][$key]) )
				{
					$config_different[$connect_name][$key] = $val;
				}
			}
		}
		
		return new DbTool($config_different[$connect_name]);
	}
	
	/******************************************************************************************
	* DESTRUCT                                                                                *
	******************************************************************************************/
	public function __destruct()
	{
		$this->db->close();	
	}
}