<?php
/************************************************************/
/*                  SQLITE DRIVER LIBRARY                   */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class SqliteDriver
{
	private $config;
	private $connect;
	private $query;
	public function connect($config = array())
	{
		$this->config = $config;
		$this->connect = 	($this->config['pconnect'] === true)
							? @sqlite_popen($this->config['database'], 0666, $error)
							: @sqlite_open($this->config['database'], 0666, $error);
		
		if( ! empty($error) ) die(get_message('Database', 'db_mysql_connect_error'));
	}
	
	public function exec($query)
	{
		return sqlite_exec($this->connect, $query);
	}
	
	public function query($query, $security = array())
	{
		$this->query = sqlite_query($this->connect, $query);
		return $this->query;
	}
	
	public function trans_start()
	{
		$this->query('BEGIN TRANSACTION');
		return true;
	}
	
	public function trans_rollback()
	{
		$this->query('ROLLBACK');
		return true;
	}
	
	public function trans_commit()
	{
		$this->query('COMMIT');
		return true;
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
		if( ! empty($this->connect))
			return sqlite_last_insert_rowid($this->connect);
		else
			return false;
	}
	
	public function column_data()
	{
		if( empty($this->query)) return false;
		
		$columns = array();
		for ($i = 0, $c = $this->num_fields(); $i < $c; $i++)
		{
			$columns[$i]				= new stdClass();
			$columns[$i]->name			= sqlite_field_name($this->query, $i);
			$columns[$i]->type			= NULL;
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
		if( ! empty($this->query))
			return sqlite_num_rows($this->query);
		else
			return 0;	
	}
	
	public function columns()
	{
		if( empty($this->query)) return false;
		
		$columns = array();
		$num_fields = $this->num_fields();
		for($i=0; $i < $num_fields; $i++)
		{		
			$columns[] = sqlite_field_name($this->query, $i);
		}
		
		return $columns;
	}
	
	public function num_fields()
	{
		if( ! empty($this->query))
			return sqlite_num_fields($this->query);
		else
			return 0;	
	}
	public function result()
	{
		if( empty($this->query)) return false;
		$rows = array();
		while($data = sqlite_fetch_array($this->query))
		{
			$rows[] = (object)$data;
		}
		
		return $rows;
	}
	
	public function result_array()
	{
		if( empty($this->query)) return false;
		$rows = array();
		while($data = sqlite_fetch_array($this->query))
		{
			$rows[] = $data;
		}
		
		return $rows;
	}
	
	public function row()
	{
		if( empty($this->query)) return false;
		$data = sqlite_fetch_array($this->query);
		return (object)$data;
	}
	
	public function real_escape_string($data = '')
	{
		if( empty($this->connect)) return false;
		return sqlite_escape_string($data);
	}
	
	public function error()
	{
		if( ! empty($this->connect))
		{
			$code = sqlite_last_error($this->connect);
			return sqlite_error_string($code);
		}
		else
			return false;
	}
	
	public function fetch_row()
	{
		if( ! empty($this->query))
			return sqlite_fetch_single($this->query);
		else
			return 0;	
	}
	
	public function fetch_array()
	{
		if( ! empty($this->query))
			return sqlite_fetch_array($this->query);
		else
			return false;	
	}
	
	public function fetch_assoc()
	{
		if( ! empty($this->query))
			return sqlite_fetch_array($this->query);
		else
			return false;	
	}
	
	public function affected_rows()
	{
		if( ! empty($this->connect))
			return false;
		else
			return false;	
	}
	
	public function close()
	{
		if( ! empty($this->connect)) @sqlite_close($this->connect); else return false;
	}	
	
	public function version()
	{
		if( ! empty($this->connect)) return sqlite_libversion(); else return false;
	}
}