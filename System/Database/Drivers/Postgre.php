<?php
class PostgreDriver
{
	private $config;
	private $connect;
	private $query;
	public function connect($config = array())
	{
		$this->config = $config;
		$dsn = '';
		if(empty($this->config['dsn'])) 
		{
			if( ! empty($this->config['host']))$dsn .= 'host='.$this->config['host'];
			if( ! empty($this->config['port']))$dsn .= ' port='.$this->config['port'];
			if( ! empty($this->config['database']))$dsn .= ' dbname='.$this->config['database'];
			if( ! empty($this->config['user']))$dsn .= ' user='.$this->config['user'];
			if( ! empty($this->config['password']))$dsn .= ' password='.$this->config['password'];
		}
		else
			$dsn = $this->config['dsn'];
			
		$this->connect = 	($this->config['pconnect'] === true)
							? @pg_pconnect($dsn)
							: @pg_connect($dsn);
							
		if( empty($this->connect) ) die(get_message('Database', 'db_mysql_connect_error'));
		
		if( ! empty($this->config['charset'])) pg_set_client_encoding($this->connect, $this->config['charset']);
	}
	
	public function exec($query)
	{
		return pg_query($this->connect, $query);
	}
	
	public function query($query)
	{
		$this->query = pg_query($this->connect, $query);
		return $this->query;
	}
	
	public function trans_start()
	{
		return (bool) pg_query($this->connect, 'BEGIN');
	}
	
	public function trans_rollback()
	{
		return (bool) pg_query($this->connect, 'ROLLBACK');
	}
	
	public function trans_commit()
	{
		return (bool) pg_query($this->connect, 'COMMIT');
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
		return false;
	}
	
	public function column_data()
	{
		if( empty($this->query)) return false;
		
		$columns = array();
		for ($i = 0, $c = $this->num_fields(); $i < $c; $i++)
		{
			$columns[$i]				= new stdClass();
			$columns[$i]->name			= pg_field_name($this->query, $i);
			$columns[$i]->type			= pg_field_type($this->query, $i);
			$columns[$i]->max_length	= pg_field_size($this->query, $i);
		}
		return $columns;
	}
		
	public function backup($filename = ''){ return false; }
		
	public function truncate($table = ''){ return false; }
	
	public function add_column(){ return false; }
	
	public function drop_column(){ return false; }
	
	public function rename_column(){ return 'RENAME COLUMN '; }
	
	public function modify_column(){ return false; }
	
	public function num_rows()
	{
		if( ! empty($this->query))
			return pg_num_rows($this->query);
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
			$columns[] = pg_field_name($this->query, $i);
		}
		
		return $columns;
	}
	
	public function num_fields()
	{
		if( ! empty($this->query))
			return pg_num_fields($this->query);
		else
			return 0;	
	}
	public function result()
	{
		if( empty($this->query)) return false;
		$rows = array();
		while($data = pg_fetch_assoc($this->query))
		{
			$rows[] = (object)$data;
		}
		
		return $rows;
	}
	
	public function result_array()
	{
		if( empty($this->query)) return false;
		$rows = array();
		while($data = pg_fetch_assoc($this->query))
		{
			$rows[] = $data;
		}
		
		return $rows;
	}
	
	public function row()
	{
		if( empty($this->query)) return false;
		$data = pg_fetch_assoc($this->query);
		return (object)$data;
	}
	
	public function real_escape_string($data = '')
	{
		if( empty($this->connect)) return false;
		return pg_escape_string($this->connect, $data);
	}
	
	public function error()
	{
		if( ! empty($this->connect))
			return pg_last_error($this->connect);
		else
			return false;
	}
	
	public function fetch_row()
	{
		if( ! empty($this->query))
			return pg_fetch_row($this->query);
		else
			return 0;	
	}
	
	public function fetch_array()
	{
		if( ! empty($this->query))
			return pg_fetch_array($this->query);
		else
			return false;	
	}
	
	public function fetch_assoc()
	{
		if( ! empty($this->query))
			return pg_fetch_assoc($this->query);
		else
			return false;	
	}
	
	public function affected_rows()
	{
		if( ! empty($this->connect))
			return pg_affected_rows($this->connect);
		else
			return false;	
	}
	
	public function close()
	{
		if( ! empty($this->connect)) @pg_close($this->connect); else return false;
	}	
	
	public function version()
	{
		if( ! empty($this->connect)) return pg_version($this->connect); else return false;
	}
}