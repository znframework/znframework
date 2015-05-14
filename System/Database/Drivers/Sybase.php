<?php
/************************************************************/
/*                  SYBASE DRIVER LIBRARY                   */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class SybaseDriver
{
	private $config;
	private $connect;
	private $query;
	public function connect($config = array())
	{
		$this->config = $config;
		$this->connect = 	($this->config['pconnect'] === true)
							? @sybase_pconnect($this->config['host'], $this->config['user'], $this->config['password'] , $this->config['charset'] , $this->config['appname'])
							: @sybase_connect($this->config['host'], $this->config['user'], $this->config['password'] , $this->config['charset'] , $this->config['appname']);
		
		if( empty($this->connect) ) die(get_message('Database', 'db_mysql_connect_error'));
		
		sybase_select_db($this->config['database'], $this->connect);
	}
	
	public function exec($query)
	{
		return sybase_query($this->connect, $query);
	}
	
	public function query($query, $security = array())
	{
		$this->query = sybase_query($query, $this->connect);
		return $this->query;
	}
	
	public function trans_start()
	{
		sybase_query($this->connect, 'BEGIN TRANSACTION');
		return true;
	}
	
	public function trans_rollback()
	{
		return sybase_query($this->connect, 'ROLLBACK TRANSACTION');	 
	}
	
	public function trans_commit()
	{
		return sybase_query($this->connect, 'COMMIT TRANSACTION');
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
			$info = sybase_fetch_field($this->query, $i);
			
			$columns[$i]				= new stdClass();
			$columns[$i]->name			= $info->name;
			$columns[$i]->type			= $info->type;
			$columns[$i]->max_length	= $info->max_length;
		}
		return $columns;
	}
	
	public function backup($filename = ''){ return false; }
	
	public function truncate($table = ''){ return false; }
	
	public function add_column(){ return false; }
	
	public function drop_column(){ return false; }
	
	public function rename_column(){ return false; }
	
	public function modify_column(){ return false; }
	
	public function num_rows()
	{
		if( ! empty($this->query))
			return sybase_num_rows($this->query);
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
			$columns[] = sybase_fetch_field($this->query, $i);
		}
		
		return $columns;
	}
	
	public function num_fields()
	{
		if( ! empty($this->query))
			return sybase_num_fields($this->query);
		else
			return 0;	
	}
	public function result()
	{
		if( empty($this->query)) return false;
		$rows = array();
		while($data = sybase_fetch_assoc($this->query))
		{
			$rows[] = (object)$data;
		}
		
		return $rows;
	}
	
	public function result_array()
	{
		if( empty($this->query)) return false;
		$rows = array();
		while($data = sybase_fetch_assoc($this->query))
		{
			$rows[] = $data;
		}
		
		return $rows;
	}
	
	public function row()
	{
		if( empty($this->query)) return false;
		$data = sybase_fetch_assoc($this->query);
		return (object)$data;
	}
	
	public function real_escape_string($data = '')
	{
		return str_replace(array("'",'"'), array("\'", '\"'), $data);
	}
	
	public function error()
	{
		if( ! empty($this->connect))
			return sybase_get_last_message();
		else
			return false;
	}
	
	public function fetch_row()
	{
		if( ! empty($this->query))
			return sybase_fetch_row($this->query);
		else
			return 0;	
	}
	
	public function fetch_array()
	{
		if( ! empty($this->query))
			return sybase_fetch_array($this->query);
		else
			return false;	
	}
	
	public function fetch_assoc()
	{
		if( ! empty($this->query))
			return sybase_fetch_assoc($this->query);
		else
			return false;	
	}
	
	public function affected_rows()
	{
		if( ! empty($this->connect))
			return sybase_affected_rows($this->connect);
		else
			return false;	
	}
	
	public function close()
	{
		if( ! empty($this->connect)) @sybase_close($this->connect); else return false;
	}	
	
	public function version()
	{
		if( ! empty($this->connect)) return false;
	}
}