<?php
/************************************************************/
/*                  SQLITE3 DRIVER LIBRARY                  */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Sqlite3Driver
{
	private $config;
	private $connect;
	private $query;
	public function connect($config = array())
	{
		$this->config = $config;
		
		try
		{
			$this->connect = 	( ! empty($this->config['password']))
							 	? new SQLite3($this->config['database'], SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE, $this->config['password'])
							  	: new SQLite3($this->config['database']);
		}	
		catch(Exception $e)
		{
			die(get_message('Database', 'db_mysql_connect_error'));
		}
	}	
	
	public function exec($query)
	{
		return $this->connect->exec($query);
	}
		
	public function query($query, $security = array())
	{
		$this->query = $this->connect->query($query);
		return $this->query;
	}
	
	public function trans_start()
	{
		return $this->connect->exec('BEGIN TRANSACTION');
	}
	
	public function trans_rollback()
	{
		return $this->connect->exec('ROLLBACK');		 
	}
	
	public function trans_commit()
	{
		return $this->connect->exec('END TRANSACTION');
	}
	
	
	public function list_databases()
	{
		return false;
	}
	
	public function list_tables()
	{
		return false;
	}
	
	
	public function insert_id()
	{
		return $this->connect->lastInsertRowID();
	}
	
	public function column_data()
	{
		if( empty($this->query)) return false;
		
		static $data_types = array(
			SQLITE3_INTEGER	=> 'integer',
			SQLITE3_FLOAT	=> 'float',
			SQLITE3_TEXT	=> 'text',
			SQLITE3_BLOB	=> 'blob',
			SQLITE3_NULL	=> 'null'
		);
		$columns = array();
		for ($i = 0, $c = $this->num_fields(); $i < $c; $i++)
		{	
			$type 						= $this->query->columnType($i);
			
			$columns[$i]				= new stdClass();
			$columns[$i]->name			= $this->result_id->columnName($i);		
			$columns[$i]->type			= isset($data_types[$type]) ? $data_types[$type] : $type;
			$columns[$i]->max_length	= NULL;
		}
		return $columns;
	}
	
	public function backup($filename = ''){ return false; }
		
	public function truncate($table = ''){ return 'DELETE FROM '.$table; }
	
	public function add_column(){ return false; }
	
	public function drop_column(){ return false; }
	
	public function rename_column(){ return false; }
	
	public function modify_column(){ return false; }
	
	public function num_rows()
	{
		if( empty($this->result)) return false;
		return count($this->result());
	}
	
	public function columns()
	{
		if( empty($this->query)) return false;
		
		$columns = array();
		

		$num_fields = $this->num_fields();
		for($i=0; $i < $num_fields; $i++)
		{		
			$columns[] = $this->query->columnName($i);
		}
		
		return $columns;
	}
	
	public function num_fields()
	{
		if( ! empty($this->query))
			return $this->query->numColumns();
		else
			return 0;
	}
	
	public function result()
	{
		if( empty($this->query)) return false;
		$rows = array();
		while($data = $this->query->fetchArray(SQLITE3_ASSOC))
		{
			$rows[] = (object)$data;
		}
		
		return $rows;
	}
	
	
	public function result_array()
	{
		if( empty($this->query)) return false;
		$rows = array();
		while($data = $this->query->fetchArray(SQLITE3_ASSOC))
		{
			$rows[] = $data;
		}
		
		return $rows;
	
	}
	
	public function fetch_array()
	{
		if( ! empty($this->query))
			return $this->query->fetchArray(SQLITE3_BOTH);
		else
			return false;	
	}
	
	public function fetch_assoc()
	{
		if( ! empty($this->query))
			return $this->query->fetchArray(SQLITE3_ASSOC);
		else
			return false;	
	}
	
	public function row()
	{
		if( empty($this->query)) return false;
		$data = $this->query->fetchArray(SQLITE3_ASSOC);
		return (object)$data;
	}
	
	public function real_escape_string($data = '')
	{
		if( empty($this->connect)) return false;
		return $this->connect->escapeString($data);
	}
	
	public function error()
	{
		if( ! empty($this->connect))
			return $this->connect->lastErrorMsg();
		else
			return false;
	}
	
	public function fetch_row()
	{
		if( ! empty($this->query))
			return $this->query->fetchArray();
		else
			return 0;	
	}
	
	public function affected_rows()
	{
		if( ! empty($this->connect))
			return  $this->connect->changes();
		else
			return false;	
	}
	
	public function close()
	{
		if( ! empty($this->connect)) @$this->connect->close(); else return false;
	}
	
	public function version($v = 'versionString')
	{
		if( ! empty($this->connect))
		{
			$version = SQLite3::version();
			
			return $version[$v];
		}
		else
			return false;
	}
}