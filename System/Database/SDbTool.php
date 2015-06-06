<?php
/************************************************************/
/*                  STATIC DB TOOL LIBRARY                  */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* SDbTool                                                                            	  *
*******************************************************************************************
| Dahil(Import) Edilirken : SDbTool 						                              |
| Sınıfı Kullanırken      :	sdbtool::	   												  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/	
class SDbTool
{	
	/* Prefix Değişkeni
	 *  
	 * Tablo ön eki bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */	
	private static $prefix;
	
	/* Db Değişkeni
	 *  
	 * Veritabanı referans bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private static $db;
	
	/* Connect Değişkeni
	 *  
	 * Veritabanı bağlantı bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private static $connect;
	
	/******************************************************************************************
	* CONNECT                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Nesne tanımlaması ve veritabanı ayarları çalıştırılıyor.				  |
	|          																				  |
	******************************************************************************************/
	public static function connect($config = array())
	{
		require_once(DB_DIR.'DbCommon.php');
		
		self::$db = dbcommon();
		
		self::$prefix = config::get('Database', 'prefix');
		
		if( empty($config) ) 
		{
			$config = config::get('Database');
		}
		
		self::$db->connect($config);
		
		self::$connect = true;
	}
	
	/******************************************************************************************
	* LIST DATABASES                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Database listesini öğrenmek için kullanılır.  					      |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: sdbtool::list_databases();        		     						  |
	|          																				  |
	******************************************************************************************/
	public static function list_databases()
	{
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		if( self::$db->list_databases() !== false ) 
		{
			return self::$db->list_databases();
		}
		
		self::$db->query('SHOW DATABASES');
		
		if( self::$db->error() ) 
		{
			return false;
		}
		
		$newdatabases = array();
		
		foreach(self::$db->result() as $databases)
		{
			foreach($databases as $db => $database)
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
	| Örnek Kullanım: sdbtool::list_tables();        		 							      |   
	|          																				  |
	******************************************************************************************/
	public static function list_tables()
	{
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		if( self::$db->list_tables() !== false )
		{
			return self::$db->list_tables();
		}
		
		self::$db->query('SHOW TABLES');
		
		if( self::$db->error() ) 
		{
			return false;
		}
		
		$newtables = array();
		
		foreach(self::$db->result() as $tables)
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
	| Örnek Kullanım: sdbtool::backup('*', 'backup');                		 				  |
	|          																				  |
	******************************************************************************************/
	public static function backup($tables = '*', $filename = '', $path = FILES_DIR)
	{		
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		if( self::$db->backup($filename) !== false )
		{
			return self::$db->backup($filename);
		}
		
		if( $tables === '*' )
		{
			$tables = array();
			
			self::$db->query('SHOW TABLES');
			
			while($row = self::$db->fetch_row())
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
			if( ! empty(self::$prefix) && ! strstr($table, self::$prefix) )
			{
				$table = self::$prefix.$table;
			}
			
		    self::$db->query('SELECT * FROM '.$table);
			
			$num_fields = self::$db->num_fields();

			$return.= 'DROP TABLE '.$table.';';
			self::$db->query('SHOW CREATE TABLE '.$table);
			$row2 = self::$db->fetch_row();
			$return.= ln(2).$row2[1].";".ln(2);
		
			for ($i = 0; $i < $num_fields; $i++) 
			{		
				while($row = self::$db->fetch_row())
				{
					$return.= 'INSERT INTO '.$table.' VALUES(';
					
					for($j=0; $j<$num_fields; $j++) 
					{
						$row[$j] = addslashes($row[$j]);
						$row[$j] = preg_replace("/\n/","\\n",$row[$j]);
						
						if( isset($row[$j]) ) 
						{ 
							$return.= '"'.$row[$j].'"'; 
						} 
						else 
						{ 
							$return.= '""'; 
						}
						
						if( $j < ($num_fields - 1) ) 
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
	| Örnek Kullanım: sdbtool::optimize_tables("tbl1, tbl2"); 					      		  |
	|          																				  |
	******************************************************************************************/
	public static function optimize_tables($table = '*')
	{
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		self::$db->query("SHOW TABLES");
		
		if( $table === '*' )
		{
			foreach(self::$db->result() as $tables)
			{
				foreach ($tables as $db => $tablename)
				{
					self::$db->query("OPTIMIZE TABLE ".$tablename);
				}
			}
			if( self::$db->error() ) 
			{
				return false;
			}
		}
		else
		{
			$tables = ( is_array($table) ) 
					  ? $table 
					  : explode(',',$table);
			
			if( is_array($tables) )foreach($tables as $tablename)
			{
				self::$db->query("OPTIMIZE TABLE ".self::$prefix.$tablename);
				
				if( self::$db->error() ) 
				{
					return false;
				}
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
	public static function repair_tables($table = '*')
	{
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		self::$db->query("SHOW TABLES");
		
		if( $table === '*' )
		{
			foreach(self::$db->result() as $tables)
			{
				foreach($tables as $db => $tablename)
				{
					self::$db->query("REPAIR TABLE ".$tablename);
				}
			}
			if( self::$db->error() ) 
			{
				return false;
			}
		}
		else
		{
			$tables = ( is_array($table) ) 
			 		  ? $table 
					  : explode(',',$table);
			
			if( is_array($tables) )foreach($tables as $tablename)
			{
				self::$db->query("REPAIR TABLE ".self::$prefix.$tablename);
				
				if( self::$db->error() ) 
				{
					return false;
				}
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
	public static function different_connection($connect_name = '')
	{
		if( ! is_string($connect_name) ) 
		{
			return false;
		}
		
		if( empty(self::$connect) ) 
		{
			self::connect();
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
}