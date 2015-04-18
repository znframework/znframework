<?php
class DbForge
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
	
	public function create_database($dbname = '')
	{
		if( ! is_string($dbname) || empty($dbname)) return false;
		
		$this->db->exec('CREATE DATABASE '.$dbname);
	}
	
	public function drop_database($dbname = '')
	{
		if( ! is_string($dbname) || empty($dbname)) return false;
		
		$this->db->exec('DROP DATABASE '.$dbname);
	}
	
	public function create_table($table = '', $condition = array())
	{
		if( ! is_string($table) || empty($table)) return false;
		if( ! is_array($condition)) return false;
		
		$keys = array_keys($condition);
		
		$column = "";
		
		foreach($condition as $key => $value)
		{
			$column .= $key.' '.$value.',';
		}
		
		$this->db->exec('CREATE TABLE '.$this->prefix.$table.'('.substr($column,0,-1).')');
	}
	
	public function drop_table($table = '')
	{
		if( ! is_string($table) || empty($table)) return false;
		
		$this->db->exec('DROP TABLE '.$this->prefix.$table);
	}
	
	public function alter_table($table = '', $condition = array())
	{
		if(key($condition) === 'rename_table') 			$this->rename_table($table, $condition['rename_table']);
		elseif(key($condition) === 'add_column') 		$this->add_column($table, $condition['add_column']);
		elseif(key($condition) === 'drop_column') 		$this->drop_column($table, $condition['drop_column']);	
		elseif(key($condition) === 'modify_column') 	$this->modify_column($table, $condition['modify_column']);
		elseif(key($condition) === 'rename_column') 	$this->rename_column($table, $condition['rename_column']);
	}
		
	public function rename_table($name = '', $new_name = '')
	{
		if( ! is_string($name) || ! is_string($new_name)) return false;
		if(empty($name) || empty($new_name)) return false;
		
		$this->db->exec('ALTER TABLE '.$this->prefix.$name.' RENAME TO '.$this->prefix.$new_name);
	}
	
	public function add_column($table = '', $condition = array())
	{
		if( ! is_string($table) || empty($table)) return false;
		if( ! is_array($condition)) return false;
		
		if($this->db->add_column() !== false)
			$add_column = $this->db->add_column();
		else
			$add_column = 'ADD ';
		
		$con = NULL;
		
		foreach($condition as $column => $values)
		{
			$colvals = '';
			if(is_array($values))
			{	
				foreach($values as $val)
					$colvals .= ' '.$val;
			}
			else
				$colvals .= ' '.$values;
				
			$con .= $add_column.$column.$colvals.',';
		}		
			
		$con = substr($con, 0 , -1);
		
		$this->db->exec('ALTER TABLE '.$table.' '.$con.';'); 
	}
	
	public function drop_column($table = '', $column = '')
	{
		if( ! is_string($table) || empty($table)) return false;
		if( ! (is_string($column) || is_array($column)) || empty($column)) return false;
		
		if($this->db->drop_column() !== false)
			$drop_column = $this->db->drop_column();
		else
			$drop_column = 'DROP ';
		
		if( ! is_array($column))
			$this->db->exec('ALTER TABLE '.$this->prefix.$table.' '.$drop_column.$column.';');		
		else
			foreach($column as $col)
				$this->db->exec('ALTER TABLE '.$this->prefix.$table.' '.$drop_column.$col.';');
	}
	
	public function modify_column($table = '', $condition = array())
	{
		if( ! is_string($table) || empty($table)) return false;
		if( ! is_array($condition)) return false;
		
		if($this->db->modify_column() !== false)
			$modify_column = $this->db->modify_column();
		else
			$modify_column = 'MODIFY ';
		
		$con = NULL;
			
		foreach($condition as $column => $values)
		{
			$colvals = '';
			if(is_array($values))
			{	
				foreach($values as $val)
					$colvals .= ' '.$val;
			}
			else
				$colvals .= ' '.$values;
				
			$con .= $modify_column.$column.$colvals.',';
		}		
		
		$con = substr($con, 0 , -1);
		
		$this->db->exec('ALTER TABLE '.$this->prefix.$table.' '.$con.';');
	}
	
	public function rename_column($table = '', $condition = array())
	{
		if( ! is_string($table) || empty($table)) return false;
		if( ! is_array($condition)) return false;
		
		if($this->db->rename_column() !== false)
			$rename_column = $this->db->rename_column();
		else
			$rename_column = 'CHANGE COLUMN ';
		
		$con = NULL;
		
		foreach($condition as $column => $values)
		{
			$colvals = '';
			if(is_array($values))
			{	
				foreach($values as $val)
					$colvals .= ' '.$val;
			}
			else
				$colvals .= ' '.$values;
				
			$con .= $rename_column.$column.$colvals.',';
		}		
		
		$con = substr($con, 0 , -1);
		
		$this->db->exec('ALTER TABLE '.$this->prefix.$table.' '.$con.';');
	}
	
	public function truncate($table = '')
	{
		if( ! is_string($table) || empty($table)) return false;
		
		if($this->db->truncate() !== false)
			$truncate = $this->db->truncate();
		else
			$truncate = 'TRUNCATE TABLE ';
			
		$this->db->exec($truncate.$this->prefix.$table);
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
		
		return new DbForge($config_different[$connect_name]);
	}
	
	public function error(){ return $this->db->error(); }
	
	public function __destruct()
	{
		$this->db->close();	
	}
}