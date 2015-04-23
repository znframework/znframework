<?php
class DbTool
{		
	
	private $prefix;
	
	public function __construct($config = array())
	{
		require_once(DB_DIR.'DbCommon.php');
		
		$this->db = dbcommon();
		
		$this->prefix = config::get('Database', 'prefix');
		
		if(empty($config)) $config = config::get('Database');
		
		$this->db->connect($config);
	}
	
	public function list_databases()
	{
		if($this->db->list_databases() !== false)
			return $this->db->list_databases();
		
		$this->db->query('SHOW DATABASES');
		if($this->db->error()) return false;
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
	
	public function list_tables()
	{
		if($this->db->list_tables() !== false)
			return $this->db->list_tables();
			
		$this->db->query('SHOW TABLES');
		if($this->db->error()) return false;
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
	
	public function backup($tables = '*', $filename = '', $path = FILES_DIR)
	{		
		if($this->db->backup($filename) !== false)
			return $this->db->backup($filename);
			
		if($tables === '*')
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
			$tables = is_array($tables) ? $tables : explode(',',$tables);
		}
		//cycle through
		$return = NULL;
		foreach($tables as $table)
		{
			if( ! empty($this->prefix) && ! strstr($table, $this->prefix))
				$table = $this->prefix.$table;
				
		    $this->db->query('SELECT * FROM '.$table);
			
			$num_fields = $this->db->num_fields();

			$return.= 'DROP TABLE '.$table.';';
			$this->db->query('SHOW CREATE TABLE '.$table);
			$row2 = $this->db->fetch_row();
			$return.= "\n\n".$row2[1].";\n\n";
		
			for ($i = 0; $i < $num_fields; $i++) 
			{
				
				while($row = $this->db->fetch_row())
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
	
	public function optimize_tables($table = '*')
	{
		$this->db->query("SHOW TABLES");
		
		if($table === '*')
		{
			foreach($this->db->result() as $tables)
			{
				foreach ($tables as $db => $tablename)
				{
					$this->db->query("OPTIMIZE TABLE ".$tablename);
				}
			}
			if($this->db->error()) return false;
		}
		else
		{
			$this->db->query("OPTIMIZE TABLE ".$this->prefix.$table);
			if($this->db->error()) return false;
		}
	
		return get_message('Database', 'db_optimize_tables_success');

	}
	
	public function repair_tables($table = '*')
	{
		$this->db->query("SHOW TABLES");
		
		if($table === '*')
		{
			foreach($this->db->result() as $tables)
			{
				foreach ($tables as $db => $tablename)
				{
					$this->db->query("REPAIR TABLE ".$tablename);
				}
			}
			if($this->db->error()) return false;
		}
		else
		{
			$this->db->query("REPAIR TABLE ".$this->prefix.$table);
			if($this->db->error()) return false;
		}
				
		return get_message('Database', 'db_repair_tables_success');
	}
	
	public function different_connection($connect_name = '')
	{
		if( ! is_string($connect_name)) return false;
	
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
	
	public function __destruct()
	{
		$this->db->close();	
	}
}