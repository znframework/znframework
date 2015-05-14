<?php
/************************************************************/
/*                    ODBC DRIVER LIBRARY                   */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class OdbcDriver
{
	private $config;
	private $connect;
	private $query;
	public function connect($config = array())
	{	
		$this->config = $config;
		
		$dsn = 	( ! empty($this->config['dsn']))
				? $this->config['dsn']
				: 'DRIVER='.$this->config['host'].';SERVER='.$this->config['server'].';DATABASE='.$this->config['database'];
				
		
		$this->connect = 	($this->config['pconnect'] === true)
							? @odbc_pconnect($dsn , $this->config['user'], $this->config['password'])
							: @odbc_connect($dsn , $this->config['user'], $this->config['password']);
		
		if( empty($this->connect) ) die(get_message('Database', 'db_mysql_connect_error'));
		
	}
	
	public function exec($query)
	{
		return odbc_exec($this->connect, $query);
	}
	
	public function query($query, $security = array())
	{
		$this->query = odbc_prepare($this->connect, $query);
		odbc_execute($this->query, $security);
		return $this->query;
	}
	
	public function trans_start()
	{
		return odbc_autocommit($this->connect, false);
	}
	
	public function trans_rollback()
	{
		$rollback = odbc_rollback($this->connect);
		odbc_autocommit($this->connect, true);
		return $rollback;	 
	}
	
	public function trans_commit()
	{
		$commit = odbc_commit($this->connect);
		odbc_autocommit($this->connect, true);
		return $commit;
	}
	
	
	public function list_databases()
	{
		return false;
	}
	
	public function list_tables()
	{
		return false;
	}
	
	public function insert_id(){ return false; }
	
	public function column_data()
	{
		if( empty($this->query)) return false;
		
		$columns = array();
		for ($i = 0, $index = 1, $c = $this->num_fields(); $i < $c; $i++, $index++)
		{
			$columns[$i]				= new stdClass();
			$columns[$i]->name			= odbc_field_name($this->query, $index);
			$columns[$i]->type			= odbc_field_type($this->query, $index);
			$columns[$i]->max_length	= odbc_field_len($this->query, $index);
			$columns[$i]->primary_key	= 0;
			$columns[$i]->default		= '';
		}
		return $columns;
	}
	
	public function backup($filename = ''){ return false; }
		
	public function truncate($table = ''){ return 'DELETE FROM '.$table; }
	
	public function add_column(){ return false; }
	
	public function drop_column(){ return false; }
	
	public function rename_column(){ return 'RENAME COLUMN '; }
	
	public function modify_column(){ return false; }
	
	public function num_rows()
	{
		if( ! empty($this->query))
			return odbc_num_rows($this->query);
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
			$columns[] = odbc_field_name($this->query, $i);
		}
		
		return $columns;
	}
	
	public function num_fields()
	{
		if( ! empty($this->query))
			return odbc_num_fields($this->query);
		else
			return 0;	
	}
	public function result()
	{
		if( empty($this->query)) return false;
		$rows = array();
		while($data = odbc_fetch_array($this->query))
		{
			$rows[] = (object)$data;
		}
		
		return $rows;
	}
	
	public function result_array()
	{
		if( empty($this->query)) return false;
		$rows = array();
		while($data = odbc_fetch_array($this->query))
		{
			$rows[] = $data;
		}
		
		return $rows;
	}
	
	public function row()
	{
		if( empty($this->query)) return false;
		$data = odbc_fetch_array($this->query);
		return (object)$data;
	}
	
	public function real_escape_string($data = '')
	{
		return str_replace(array("'",'"'), array("\'", '\"'), $data);
	}
	
	public function error()
	{
		if( ! empty($this->connect))
			return odbc_error($this->connect);
		else
			return false;
	}
	
	public function fetch_row()
	{
		if( ! empty($this->query))
			return odbc_fetch_row($this->query);
		else
			return 0;	
	}
	
	public function fetch_array()
	{
		if( ! empty($this->query))
			return odbc_fetch_array($this->query);
		else
			return false;	
	}
	
	public function fetch_assoc()
	{
		if( ! empty($this->query))
			return odbc_fetch_array($this->query);
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
		if( ! empty($this->connect)) @odbc_close($this->connect);
	}	
	
	public function version()
	{
		if( ! empty($this->connect)) return false;
	}	
}