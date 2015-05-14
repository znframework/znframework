<?php
/************************************************************/
/*                  MYSQLI DRIVER LIBRARY                   */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class MysqliDriver
{
	private $config;
	private $connect;
	private $query;
	public function connect($config = array())
	{
		$this->config = $config;
		
		$this->connect = @mysqli_connect($this->config['host'], $this->config['user'], $this->config['password'], $this->config['database']);
		
		if( empty($this->connect) ) die(get_message('Database', 'db_mysql_connect_error'));
	
		if($this->config['charset'])   
			$this->query("SET NAMES '".$this->config['charset']."'");
		if($this->config['charset'])   
			$this->query('SET CHARACTER SET '.$this->config['charset']);	
		if($this->config['collation']) 
			$this->query('SET COLLATION_CONNECTION = "'.$this->config['collation'].'"');
	}
	
	public function exec($query)
	{
		return mysqli_query($this->connect, $query);
	}
	
	public function query($query)
	{
		$this->query = mysqli_query($this->connect, $query);
		return $this->query;
	}
	
	public function trans_start()
	{
		mysqli_autocommit($this->connect, false);
		return (phpversion() > 5.5)
			? mysqli_begin_transaction($this->connect)
			: $this->query('START TRANSACTION');
	}
	
	public function trans_rollback()
	{
		if (mysqli_rollback($this->connect))
		{
			mysqli_autocommit($this->connect, true);
			return true;
		}
	}
	
	public function trans_commit()
	{
		if (mysqli_commit($this->connect))
		{
			mysqli_autocommit($this->connect, true);
			return true;
		}
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
			return mysqli_insert_id($this->connect);
		else
			return false;
	}
	
	public function column_data()
	{
		if( empty($this->query)) return false;
		
		$columns = array();
		$field_data = mysqli_fetch_fields($this->query);
		for ($i = 0, $c = count($field_data); $i < $c; $i++)
		{
			$columns[$i]				= new stdClass();
			$columns[$i]->name			= $field_data[$i]->name;
			$columns[$i]->type			= $field_data[$i]->type;
			$columns[$i]->max_length	= $field_data[$i]->max_length;
			$columns[$i]->primary_key	= (int) ($field_data[$i]->flags & 2);
			$columns[$i]->default		= $field_data[$i]->def;
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
			return mysqli_num_rows($this->query);
		else
			return 0;	
	}
	
	public function columns()
	{
		if( empty($this->query)) return false;
		$columns = array();
		$fields = mysqli_fetch_fields($this->query);
		$num_fields = $this->num_fields();
		for($i=0; $i < $num_fields; $i++)
		{		
			$columns[] = $fields[$i]->name;
		}
		
		return $columns;
	}
	
	public function num_fields()
	{
		if( ! empty($this->query))
			return mysqli_num_fields($this->query);
		else
			return 0;	
	}
	public function result()
	{
		if( empty($this->query)) return false;
		$rows = array();
		while($data = mysqli_fetch_assoc($this->query))
		{
			$rows[] = (object)$data;
		}
		
		return $rows;
	}
	
	public function result_array()
	{
		if( empty($this->query)) return false;
		$rows = array();
		while($data = mysqli_fetch_assoc($this->query))
		{
			$rows[] = $data;
		}
		
		return $rows;
	}
	
	public function row()
	{
		if( ! empty($this->query))
		{
			$data = mysqli_fetch_assoc($this->query);
			return (object)$data;
		}
		else
			return false;
	}
	
	public function real_escape_string($data = '')
	{
		if( ! empty($this->connect))
			return mysqli_real_escape_string($this->connect, $data);
		else
			return false;
	}
	
	public function error()
	{
		if( ! empty($this->connect))
			return mysqli_error($this->connect);
		else
			return false;
	}
	
	public function fetch_row()
	{
		if( ! empty($this->query))
			return mysqli_fetch_row($this->query);
		else
			return 0;	
	}
	
	public function fetch_array()
	{
		if( ! empty($this->query))
			return mysqli_fetch_array($this->query);
		else
			return false;	
	}
	
	public function fetch_assoc()
	{
		if( ! empty($this->query))
			return mysqli_fetch_assoc($this->query);
		else
			return false;	
	}
	
	public function affected_rows()
	{
		if( ! empty($this->connect))
			return mysqli_affected_rows($this->connect);
		else
			return false;	
	}
	
	public function close()
	{
		if( ! empty($this->connect)) @mysqli_close($this->connect); else return false;
	}
	
	public function version()
	{
		if( ! empty($this->connect)) return mysqli_get_server_version($this->connect); else return false;
	}	
}