<?php
class IbaseDriver
{
	private $config;
	private $connect;
	private $query;
	private $ibase_trans;
	public function connect($config = array())
	{
		$this->config = $config;
		$this->connect =	($this->config['pconnect'] === true) 
							? @ibase_pconnect
							(
								$this->config['host'].':'.$this->config['database'], 
								$this->config['user'], 
								$this->config['password'], 
								$this->config['charset']
							)
							: @ibase_connect
							(
								$this->config['host'].':'.$this->config['database'], 
								$this->config['user'], 
								$this->config['password'], 
								$this->config['charset']
							);
		
		if( empty($this->connect) ) die(get_message('Database', 'db_mysql_connect_error'));
	}
	
	public function exec($query)
	{
		return ibase_query($this->connect, $query);
	}
	
	public function query($query, $security = array())
	{
		$this->query = ibase_query($this->connect, $query);
		
		return $this->query;
	}
	
	public function trans_start()
	{
		$this->ibase_trans = ibase_trans($this->connect);
			
		return true;	
	}
	
	public function trans_rollback()
	{
		return ibase_rollback($this->ibase_trans);
	}
	
	public function trans_commit()
	{
		return ibase_commit($this->ibase_trans);
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
			return ibase_gen_id('id');
		else
			return false;
	}
	
	public function column_data()
	{
		if( empty($this->query)) return false;
		$columns = array();
		for ($i = 0, $c = $this->num_fields(); $i < $c; $i++)
		{
			$info = ibase_field_info($this->query, $i);
			$columns[$i]				= new stdClass();
			$columns[$i]->name			= $info['name'];
			$columns[$i]->type			= $info['type'];
			$columns[$i]->max_length	= $info['length'];
			$columns[$i]->primary_key	= false;
		}
		return $columns;
	}
	
	public function backup($filename = '')
	{
		
		if ($service = ibase_service_attach($this->config['host'], $this->config['user'], $this->config['password']))
		{
			$backup = ibase_backup($service, $this->config['database'], $filename.'.fbk');
			ibase_service_detach($service);
			return $backup;
		}
		
		return false;	
	}
	
	public function truncate($table = ''){ return 'DELETE FROM '.$table;}
	
	public function add_column(){ return false; }
	
	public function drop_column(){ return false; }
	
	public function rename_column(){ return 'ALTER COLUMN '; }
	
	public function modify_column(){ return 'ALTER COLUMN '; }
	
	public function num_rows()
	{
		if( ! empty($this->query))
			return count($this->result());
		else
			return 0;	
	}
	
	public function columns()
	{
		if( empty($this->query)) return false;
		
		$columns = array();
		$num_fields = $this->num_fields();
		$field = '';
		for($i=0; $i < $num_fields; $i++)
		{		
			$field = ibase_field_info($this->query, $i);
			$column[] = $field['name'];
		}
		
		return $columns;
	}
	
	public function num_fields()
	{
		if( ! empty($this->query))
			return ibase_num_fields($this->query);
		else
			return 0;	
	}
	public function result()
	{
		if( empty($this->query)) return false;
		$rows = array();
		while($data = ibase_fetch_assoc($this->query))
		{
			$rows[] = (object)$data;
		}
		
		return $rows;
	}
	
	public function result_array()
	{
		if( empty($this->query)) return false;
		$rows = array();
		while($data = ibase_fetch_assoc($this->query))
		{
			$rows[] = $data;
		}
		
		return $rows;
	}
	
	public function row()
	{
		if( empty($this->query)) return false;
		$data = ibase_fetch_assoc($this->query);
		return (object)$data;
	}
	
	public function real_escape_string($data = '')
	{
		return str_replace(array("'",'"'), array("\'", '\"'), $data);
	}
	
	public function error()
	{
		if( ! empty($this->connect))
			return ibase_errmsg();
		else
			return false;
	}
	
	public function fetch_row()
	{
		if( ! empty($this->query))
			return ibase_fetch_row($this->query);
		else
			return 0;	
	}
	
	public function fetch_array()
	{
		if( ! empty($this->query))
			return ibase_fetch_array($this->query);
		else
			return false;	
	}
	
	public function fetch_assoc()
	{
		if( ! empty($this->query))
			return ibase_fetch_assoc($this->query);
		else
			return false;	
	}
	
	public function affected_rows()
	{
		if( ! empty($this->connect))
			return ibase_affected_rows($this->connect);
		else
			return false;	
	}
	
	public function close()
	{
		if( ! empty($this->connect)) @ibase_close($this->connect); else return false;
	}
	
	public function version()
	{
		if( ! empty($this->connect)) return false;
	}	
}