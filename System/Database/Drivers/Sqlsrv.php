<?php
/************************************************************/
/*                 SQL SERVER DRIVER LIBRARY                */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class SqlsrvDriver
{
	private $config;
	private $connect;
	private $query;
	public function connect($config = array())
	{
		$this->config = $config;
		
		$server = 	( ! empty($this->config['server']))
					? $this->config['server']
					: $this->config['host'];
		if( ! empty($this->config['port'])) $server .= ', '.$this->config['port'];
		
		$connection = array(
			'UID'					=> $this->config['user'],
			'PWD'					=> $this->config['password'],
			'Database'				=> $this->config['database'],
			'ConnectionPooling'		=> 0,
			'CharacterSet'			=> $this->config['charset'],
			'Encrypt'				=> $this->config['encode'],
			'ReturnDatesAsStrings'	=> 1
		);
		
		$this->connect = @sqlsrv_connect($server, $connection);
		
		if( empty($this->connect) ) die(get_message('Database', 'db_mysql_connect_error'));
	}
	
	public function exec($query)
	{
		return sqlsrv_query($this->connect, $query);
	}
	
	public function query($query)
	{
		$this->query = sqlsrv_query($this->connect, $query);
		return $this->query;
	}
	
	public function trans_start()
	{
		return sqlsrv_begin_transaction($this->connect);
	}
	
	public function trans_rollback()
	{
		return sqlsrv_rollback($this->connect);		 
	}
	
	public function trans_commit()
	{
		return sqlsrv_commit($this->connect);
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
		$this->query('SELECT @@IDENTITY AS insert_id');
		$row = $query->row();
		return $row->insert_id;
	}
	
	public function column_data()
	{
		if( empty($this->query)) return false;
		
		$columns = array();
		foreach (sqlsrv_field_metadata($this->query) as $i => $field)
		{
			$columns[$i]				= new stdClass();
			$columns[$i]->name			= $field['Name'];
			$columns[$i]->type			= $field['Type'];
			$columns[$i]->max_length	= $field['Size'];
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
			return sqlsrv_num_rows($this->query);
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
			$columns[] = sqlsrv_get_field($this->query, $i);
		}
		
		return $columns;
	}
	
	public function num_fields()
	{
		if( ! empty($this->query))
			return sqlsrv_num_fields($this->query);
		else
			return 0;	
	}
	public function result()
	{
		if( empty($this->query)) return false;
		$rows = array();
		while($data = sqlsrv_fetch_array($this->query))
		{
			$rows[] = (object)$data;
		}
		
		return $rows;
	}
	
	public function result_array()
	{
		if( empty($this->query)) return false;
		$rows = array();
		while($data = sqlsrv_fetch_array($this->query, SQLSRV_FETCH_ASSOC))
		{
			$rows[] = $data;
		}
		
		return $rows;
	}
	
	public function row()
	{
		if( empty($this->query)) return false;
		$data = sqlsrv_fetch_array($this->query, SQLSRV_FETCH_ASSOC);
		return (object)$data;
	}
	
	public function real_escape_string($data = '')
	{
		return str_replace(array("'",'"'), array("\'", '\"'), $data);
	}
	
	public function error()
	{
		if( ! empty($this->connect))
		{
			$error = sqlsrv_errors(SQLSRV_ERR_ERRORS);
			return $error['message'];
		}
		else
			return false;
	}
	
	public function fetch_row()
	{
		if( ! empty($this->query))
			return sqlsrv_fetch($this->query, SQLSRV_FETCH_ASSOC);
		else
			return 0;	
	}
	
	
	public function fetch_array()
	{
		if( ! empty($this->query))
			return sqlsrv_fetch_array($this->query, SQLSRV_FETCH_BOTH);
		else
			return false;	
	}
	
	public function fetch_assoc()
	{
		if( ! empty($this->query))
			return sqlsrv_fetch_array($this->query, SQLSRV_FETCH_ASSOC);
		else
			return false;	
	}
	
	public function affected_rows()
	{
		if( ! empty($this->connect))
			return sqlsrv_rows_affected($this->connect);
		else
			return false;	
	}
	
	public function close()
	{
		if( ! empty($this->connect)) @sqlsrv_close($this->connect); else return false;
	}	
	
	public function version()
	{
		if( ! empty($this->connect))
		{
			$info = sqlsrv_server_info($this->connect);
			return $info['SQLServerVersion'];
		}
		else
			return false;
	}
}