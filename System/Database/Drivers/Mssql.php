<?php
/************************************************************/
/*                   MSSQL DRIVER LIBRARY                   */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class MssqlDriver
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
		
		$this->connect = 	($this->config['pconnect'] === true)
							? @mssql_pconnect($server, $this->config['user'], $this->config['password'])
							: @mssql_connect($server, $this->config['user'], $this->config['password']);
		
		if( empty($this->connect) ) die(get_message('Database', 'db_mysql_connect_error'));

		mssql_select_db($this->config['database'], $this->connect);
	}
	
	public function exec($query)
	{
		return mssql_query($query, $this->connect);
	}
	
	public function query($query, $security = array())
	{
		$this->query = mssql_query($query, $this->connect);
		
		return $this->query;
	}
	
	public function trans_start()
	{
		return $this->query('BEGIN TRAN');
	}
	
	public function trans_rollback()
	{
		return $this->query('ROLLBACK TRAN');
	}
	
	public function trans_commit()
	{
		return $this->query('COMMIT TRAN');
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
		{
			$query = version_compare($this->version(), '8', '>=')
				? 'SELECT SCOPE_IDENTITY() AS last_id'
				: 'SELECT @@IDENTITY AS last_id';
			
			$this->query($query);
			$row = $this->row();
			return $row->last_id;
		}
		else
			return false;
	}
	
	public function column_data()
	{
		if( empty($this->query)) return false;
		$columns = array();
		for ($i = 0, $c = $this->num_fields(); $i < $c; $i++)
		{
			$field = mssql_fetch_field($this->query, $i);
			$columns[$i]				= new stdClass();
			$columns[$i]->name			= $field->name;
			$columns[$i]->type			= $field->type;
			$columns[$i]->max_length	= $field->max_length;
			$columns[$i]->primary_key	= false;
		}
		return $columns;
	}
	
	
	public function backup($filename = ''){ return false; }
	
	public function truncate($table = ''){ return false;}
	
	public function add_column(){ return false; }
	
	public function drop_column(){ return false; }
	
	public function rename_column(){ return 'ALTER COLUMN '; }
	
	public function modify_column(){ return 'ALTER COLUMN '; }
	
	public function num_rows()
	{
		if( ! empty($this->query))
			return mssql_num_rows($this->query);
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
			$columns[] = mssql_field_name($this->query, $i);
		}
		
		return $columns;
	}
	
	public function num_fields()
	{
		if( ! empty($this->query))
			return mssql_num_fields($this->query);
		else
			return 0;	
	}
	public function result()
	{
		if( empty($this->query)) return false;
		$rows = array();
		while($data = mssql_fetch_assoc($this->query))
		{
			$rows[] = (object)$data;
		}
		
		return $rows;
	}
	
	public function result_array()
	{
		if( empty($this->query)) return false;
		$rows = array();
		while($data = mssql_fetch_assoc($this->query))
		{
			$rows[] = $data;
		}
		
		return $rows;
	}
	
	public function row()
	{
		if( empty($this->query)) return false;
		$data = mssql_fetch_assoc($this->query);
		return (object)$data;
	}
	
	public function real_escape_string($data = '')
	{
		return str_replace(array("'",'"'), array("\'", '\"'), $data);
	}
	
	public function error()
	{
		if( ! empty($this->connect))
			return mssql_get_last_message();
		else
			return false;
	}
	
	public function fetch_row()
	{
		if( ! empty($this->query))
			return mssql_fetch_row($this->query);
		else
			return 0;	
	}
	
	public function fetch_array()
	{
		if( ! empty($this->query))
			return mssql_fetch_array($this->query);
		else
			return false;	
	}
	
	public function fetch_assoc()
	{
		if( ! empty($this->query))
			return mssql_fetch_assoc($this->query);
		else
			return false;	
	}
	
	public function affected_rows()
	{
		if( ! empty($this->connect))
			return mssql_rows_affected($this->connect);
		else
			return false;	
	}
	
	public function close()
	{
		if( ! empty($this->connect)) @mssql_close($this->connect); else return false;
	}
	
	public function version()
	{
		if( ! empty($this->connect)) 
		{
			$this->query('SELECT @@VERSION AS ver;');
			return $this->row()->ver;
		}
	}
		
}