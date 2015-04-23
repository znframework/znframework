<?php
class SDbTool
{		
	private static $prefix;
	private static $db;
	private static $connect;
	
	public static function connect($config = array())
	{
		require_once(DB_DIR.'DbCommon.php');
		
		self::$db = dbcommon();
		
		self::$prefix = config::get('Database', 'prefix');
		
		if(empty($config)) $config = config::get('Database');
		
		self::$db->connect($config);
		
		self::$connect = true;
	}
	
	public static function list_databases()
	{
		if(empty(self::$connect)) self::connect();
		
		if(self::$db->list_databases() !== false)
			return self::$db->list_databases();
		
		self::$db->query('SHOW DATABASES');
		if(self::$db->error()) return false;
		$newdatabases = array();
		foreach(self::$db->result() as $databases)
		{
			foreach ($databases as $db => $database)
			{
				$newdatabases[] = $database;
			}
		}
		return $newdatabases;
	}
	
	public static function list_tables()
	{
		if(empty(self::$connect)) self::connect();
		
		if(self::$db->list_tables() !== false)
			return self::$db->list_tables();
			
		self::$db->query('SHOW TABLES');
		if(self::$db->error()) return false;
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
	
	public static function backup($tables = '*', $filename = '', $path = FILES_DIR)
	{		
		
		if(empty(self::$connect)) self::connect();
		
		if(self::$db->backup($filename) !== false)
			return self::$db->backup($filename);
			
		if($tables === '*')
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
			$tables = is_array($tables) ? $tables : explode(',',$tables);
		}
		//cycle through
		$return = NULL;
		foreach($tables as $table)
		{
			if( ! empty(self::$prefix) && ! strstr($table, self::$prefix))
				$table = self::$prefix.$table;
			
		    self::$db->query('SELECT * FROM '.$table);
			
			$num_fields = self::$db->num_fields();

			$return.= 'DROP TABLE '.$table.';';
			self::$db->query('SHOW CREATE TABLE '.$table);
			$row2 = self::$db->fetch_row();
			$return.= "\n\n".$row2[1].";\n\n";
		
			for ($i = 0; $i < $num_fields; $i++) 
			{
				
				while($row = self::$db->fetch_row())
				{
					$return.= 'INSERT INTO '.$table.' VALUES(';
					for($j=0; $j<$num_fields; $j++) 
					{
						$row[$j] = addslashes($row[$j]);
						$row[$j] = preg_replace("/\n/","\\n",$row[$j]);
						if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
						if ($j<($num_fields-1)) { $return.= ','; }
					}
					$return.= ");\n";
				}
			}
			$return.="\n\n\n";
		}
		
		if(empty($filename)) 
			$filename = 'db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql';
		 
		$handle = fopen($path.$filename,'w+');
		fwrite($handle,$return);
		fclose($handle);
		
		return get_message('Database', 'db_backup_tables_success');
	}
	
	public static function optimize_tables($table = '*')
	{
		if(empty(self::$connect)) self::connect();
		
		self::$db->query("SHOW TABLES");
		
		if($table === '*')
		{
			foreach(self::$db->result() as $tables)
			{
				foreach ($tables as $db => $tablename)
				{
					self::$db->query("OPTIMIZE TABLE ".$tablename);
				}
			}
			if(self::$db->error()) return false;
		}
		else
		{
			$tables = is_array($table) ? $table : explode(',',$table);
			
			if(is_array($tables))foreach($tables as $tablename)
			{
				self::$db->query("OPTIMIZE TABLE ".self::$prefix.$tablename);
				if(self::$db->error()) return false;
			}
		}
	
		return get_message('Database', 'db_optimize_tables_success');

	}
	
	public static function repair_tables($table = '*')
	{
		if(empty(self::$connect)) self::connect();
		
		self::$db->query("SHOW TABLES");
		
		if($table === '*')
		{
			foreach(self::$db->result() as $tables)
			{
				foreach ($tables as $db => $tablename)
				{
					self::$db->query("REPAIR TABLE ".$tablename);
				}
			}
			if(self::$db->error()) return false;
		}
		else
		{
			$tables = is_array($table) ? $table : explode(',',$table);
			
			if(is_array($tables))foreach($tables as $tablename)
			{
				self::$db->query("REPAIR TABLE ".self::$prefix.$tablename);
				if(self::$db->error()) return false;
			}
		}
				
		return get_message('Database', 'db_repair_tables_success');
	}
	
	public static function different_connection($connect_name = '')
	{
		if( ! is_string($connect_name)) return false;
		
		if(empty(self::$connect)) self::connect();
		
		$config = config::get('Database');
		$config_different = $config['different_connection'];
		
		if( ! isset($config_different[$connect_name])) return false;
		
		
		foreach($config as $key => $val)
		{
			if($key !== 'different_connection')
				if( ! isset($config_different[$connect_name][$key]))
					$config_different[$connect_name][$key] = $val;
		}
		
		return new DbTool($config_different[$connect_name]);
	}
}