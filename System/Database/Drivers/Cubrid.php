<?php
class CubridDriver
{
	private $config;
	private $connect;
	private $query;
	public function connect($config = array())
	{
		$this->config = $config;
		$this->connect = 	(empty($this->config['user']))
							? @cubrid_connect
							(
								$this->config['host'], 
								$this->config['port'], 
								$this->config['database']
							)
							: @cubrid_connect
							(
								$this->config['host'], 
								$this->config['port'], 
								$this->config['database'], 
								$this->config['user'] , 
								$this->config['password']
							);
		
		
		if( empty($this->connect) ) die(get_message('Database', 'db_mysql_connect_error'));
	}
	
	public function exec($query)
	{
		return cubrid_query($query, $this->connect);
	}
	
	public function query($query, $security = array())
	{
		$this->query = cubrid_query($query, $this->connect);
		return $this->query;
	}
	
	public function trans_start()
	{
		if(cubrid_get_autocommit($this->connect))
			cubrid_set_autocommit($this->connect, CUBRID_AUTOCOMMIT_FALSE);
			
		return true;	
	}
	
	public function trans_rollback()
	{
		cubrid_rollback($this->connect);
		if( ! cubrid_get_autocommit($this->connect))
		{
			cubrid_set_autocommit($this->connect, CUBRID_AUTOCOMMIT_TRUE);
		}
		return TRUE;
	}
	
	public function trans_commit()
	{
		cubrid_commit($this->connect);
		if( ! cubrid_get_autocommit($this->connect))
		{
			cubrid_set_autocommit($this->connect, CUBRID_AUTOCOMMIT_TRUE);
		}
		return true;
	}
	
	public function list_databases()
	{
		if( ! empty($this->connect))
			return cubrid_list_dbs($this->connect);
		else
			return false;
	}
	
	public function list_tables()
	{
		return false;
	}
	
	public function insert_id()
	{
		if( ! empty($this->connect))
			return cubrid_insert_id($this->connect);
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
			$columns[$i]->name			= cubrid_field_name($this->query, $i);
			$columns[$i]->type			= cubrid_field_type($this->query, $i);
			$columns[$i]->max_length	= cubrid_field_len($this->query, $i);
			$columns[$i]->primary_key	= (int) (strpos(cubrid_field_flags($this->query, $i), 'primary_key') !== false);
		}
		return $columns;
	}
	
	public function backup($filename = ''){ return false; }
	
	public function truncate($table = ''){ return false; }
	
	public function add_column(){ return false; }
	
	public function drop_column(){ return false; }
	
	public function rename_column(){ return false;}
	
	public function modify_column(){ return false; }
	
	public function num_rows()
	{
		if( ! empty($this->query))
			return cubrid_num_rows($this->query);
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
				$columns[] = cubrid_field_name($this->query,$i);
		}
		
		return $columns;
	}
	
	public function num_fields()
	{
		if( ! empty($this->query))
			return cubrid_num_fields($this->query);
		else
			return 0;	
	}
	public function result()
	{
		if( empty($this->query)) return false;
		$rows = array();
		while($data = cubrid_fetch_assoc($this->query))
		{
			$rows[] = (object)$data;
		}
		
		return $rows;
	}
	
	public function result_array()
	{
		if( empty($this->query)) return false;
		$rows = array();
		while($data = cubrid_fetch_assoc($this->query))
		{
			$rows[] = $data;
		}
		
		return $rows;
	}
	
	public function row()
	{
		if( empty($this->query)) return false;
		
		$data = cubrid_fetch_assoc($this->query);
		return (object)$data;
	}
	
	public function real_escape_string($data = '')
	{
		if( empty($this->connect)) return false;
		
		return cubrid_real_escape_string($data, $this->connect);
	}
	
	public function error()
	{
		if( ! empty($this->connect))	
			return cubrid_error($this->connect);
		else
			return false;
	}
	
	public function fetch_array()
	{
		if( ! empty($this->query))
			return cubrid_fetch_array($this->query);
		else
			return false;	
	}
	
	public function fetch_assoc()
	{
		if( ! empty($this->query))
			return cubrid_fetch_assoc($this->query);
		else
			return false;	
	}
	
	public function fetch_row()
	{
		if( ! empty($this->query))
			return cubrid_fetch_row($this->query);
		else
			return 0;	
	}
	
	public function affected_rows()
	{
		if( ! empty($this->connect))
			return cubrid_affected_rows($this->connect);
		else
			return false;	
	}
	
	public function close()
	{
		if( ! empty($this->connect)) 
			@cubrid_close ($this->connect);
		else
			return false;
	}	
	
	public function version()
	{
		if( ! empty($this->connect)) 
			return cubrid_version();
		else
			return false;
	}
}