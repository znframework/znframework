<?php
/************************************************************/
/*                   FBSQL DRIVER LIBRARY                   */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class FbsqlDriver
{
	private $config;
	private $connect;
	private $query;
	public function connect($config = array())
	{
		$this->config = $config;
		$this->connect = 	($this->config['pconnect'] === true)
							? @fbsql_pconnect($this->config['host'], $this->config['user'], $this->config['password'])
							: @fbsql_connect($this->config['host'], $this->config['user'], $this->config['password']);
		
		if( empty($this->connect) ) die(get_message('Database', 'db_mysql_connect_error'));
		
		fbsql_select_db($this->config['database'], $this->connect);
	}
	
	public function exec($query)
	{
		return fbsql_query($this->connect, $query);
	}
	
	public function query($query, $security = array())
	{
		$this->query = fbsql_query($query, $this->connect);
		return $this->query;
	}
	
	public function trans_start()
	{
		if(fbsql_autocommit($this->connect))
			fbsql_autocommit($this->connect, false);
			
		return true;	
	}
	
	public function trans_rollback()
	{
		fbsql_rollback($this->connect);
		if ( ! fbsql_autocommit($this->connect))
		{
			fbsql_autocommit($this->connect, true);
		}
		return TRUE;
	}
	
	public function trans_commit()
	{
		fbsql_commit($this->connect);
		if ( ! fbsql_autocommit($this->connect))
		{
			fbsql_autocommit($this->connect, true);
		}
		return true;
	}
	
	public function list_databases()
	{
		if( ! empty($this->connect))
			return fbsql_list_dbs($this->connect);
		else
			return false;
	}
	
	public function list_tables()
	{
		if( ! empty($this->connect))
			return fbsql_list_tables($this->config['database'], $this->connect);
		else
			return false;
	}
	
	public function insert_id()
	{
		if( ! empty($this->connect))
			return fbsql_insert_id($this->connect);
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
			$columns[$i]->name			= fbsql_field_name($this->query, $i);
			$columns[$i]->type			= fbsql_field_type($this->query, $i);
			$columns[$i]->max_length	= fbsql_field_len($this->query, $i);
			$columns[$i]->primary_key	= (int) (strpos(fbsql_field_flags($this->query, $i), 'primary_key') !== false);
		}
		return $columns;
	}
	
	public function backup($filename = ''){ return false; }
	
	public function truncate($table = ''){ return false; }
	
	public function add_column(){ return false; }
	
	public function drop_column(){ return false; }
	
	public function rename_column(){ return 'RENAME COLUMN ';}
	
	public function modify_column(){ return false; }
	
	public function num_rows()
	{
		if( ! empty($this->query))
			return fbsql_num_rows($this->query);
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
			$columns[] = fbsql_field_name($this->query, $i);
		}
		
		return $columns;
	}
	
	public function num_fields()
	{
		if( ! empty($this->query))
			return fbsql_num_fields($this->query);
		else
			return 0;	
	}
	public function result()
	{
		if( empty($this->query)) return false;
		$rows = array();
		while($data = fbsql_fetch_assoc($this->query))
		{
			$rows[] = (object)$data;
		}
		
		return $rows;
	}
	
	public function result_array()
	{
		if( empty($this->query)) return false;
		$rows = array();
		while($data = fbsql_fetch_assoc($this->query))
		{
			$rows[] = $data;
		}
		
		return $rows;
	}
	
	public function row()
	{
		if( empty($this->query)) return false;
		$data = fbsql_fetch_assoc($this->query);
		return (object)$data;
	}
	
	public function real_escape_string($data = '')
	{
		return str_replace(array("'",'"'), array("\'", '\"'), $data);
	}
	
	public function error()
	{
		if( ! empty($this->connect))
			return fbsql_error($this->connect);
		else
			return false;
	}
	
	public function fetch_row()
	{
		if( ! empty($this->query))
			return fbsql_fetch_row($this->query);
		else
			return 0;	
	}
	
	public function fetch_array()
	{
		if( ! empty($this->query))
			return fbsql_fetch_array($this->query);
		else
			return false;	
	}
	
	public function fetch_assoc()
	{
		if( ! empty($this->query))
			return fbsql_fetch_assoc($this->query);
		else
			return false;	
	}
	
	public function affected_rows()
	{
		if( ! empty($this->connect))
			return fbsql_affected_rows($this->connect);
		else
			return false;	
	}
	
	public function close()
	{
		if( ! empty($this->connect)) @fbsql_close($this->connect); else return false;
	}	
	
	public function version()
	{	
		if( ! empty($this->connect)) return false;
	}
}