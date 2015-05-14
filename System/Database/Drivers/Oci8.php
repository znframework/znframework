<?php
/************************************************************/
/*                    OCI8 DRIVER LIBRARY                   */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Oci8Driver
{
	private $config;
	private $connect;
	private $query;
	public function connect($config = array())
	{
		$this->config = $config;
		
		$dsn = 	( ! empty($this->config['dsn']))
				? $this->config['dsn']
				: $this->config['host'];
		
		if($this->config['pconnect'] === true)
		{
			$this->connect = 	(empty($this->config['charset']))
								? @oci_pconnect 
								(
									$this->config['user'], 
									$this->config['password'], 
									$dsn
								)
								: @oci_pconnect 
								(
									$this->config['user'], 
									$this->config['password'], 
									$dsn, 
									$this->config['charset']
								);
		}
		else
		{
			$this->connect = 	(empty($this->config['charset']))
								? @oci_connect 
								(
									$this->config['user'], 
									$this->config['password'], 
									$dsn
								)
								: @oci_connect 
								(
									$this->config['user'], 
									$this->config['password'], 
									$dsn, 
									$this->config['charset']
								);
		}
		
		
		if( empty($this->connect) ) die(get_message('Database', 'db_mysql_connect_error'));
		
	}
	
	public function exec($query)
	{
		$que = oci_parse($this->connect, $query);
		oci_execute($que);
		
		return $que;
	}
	
	public function query($query, $security = array())
	{
		$this->query = oci_parse($this->connect, $query);
		oci_execute($this->query);
		return $this->query;
	}
	
	public function trans_start()
	{
		$commit_mode = (phpversion() > '5.3.2') ? OCI_NO_AUTO_COMMIT : OCI_DEFAULT;
		$this->exec($commit_mode);
		return true;
	}
	
	public function trans_rollback()
	{
		oci_rollback($this->connect);
		$commit_mode = OCI_COMMIT_ON_SUCCESS;
		return $this->exec($commit_mode);		 
	}
	
	public function trans_commit()
	{
		oci_commit($this->connect);
		$commit_mode = OCI_COMMIT_ON_SUCCESS;
		return $this->exec($commit_mode);
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
		for ($i = 1, $c = $this->num_fields(); $i <= $c; $i++)
		{
			$field				= new stdClass();
			$field->name		= oci_field_name($this->query, $i);
			$field->type		= oci_field_type($this->query, $i);
			$field->max_length	= oci_field_size($this->query, $i);
			$columns[] 			= $field;
		}
		return $columns;
	}
	
	public function backup($filename = ''){ return false; }
	
	public function truncate($table = ''){ return false;}
	
	public function add_column(){ return false; }
	
	public function drop_column(){ return false; }
	
	public function rename_column(){ return 'RENAME COLUMN '; }
	
	public function modify_column(){ return false; }
	
	public function num_rows()
	{
		if( ! empty($this->query))
			return oci_num_rows($this->query);
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
				$columns[] = oci_field_name($this->query,$i);
		}
		
		return $columns;
	}
	
	public function num_fields()
	{
		if( ! empty($this->query))
			return oci_num_fields($this->query);
		else
			return 0;	
	}
	public function result()
	{
		if( empty($this->query)) return false;
		$rows = array();
		while($data = oci_fetch_assoc($this->query))
		{
			$rows[] = (object)$data;
		}
		
		return $rows;
	}
	
	public function result_array()
	{
		if( empty($this->query)) return false;
		$rows = array();
		while($data = oci_fetch_assoc($this->query))
		{
			$rows[] = $data;
		}
		
		return $rows;
	}
	
	public function row()
	{
		if( empty($this->query)) return false;
		$data = oci_fetch_assoc($this->query);
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
			$error = oci_error($this->connect);
			return  $error['message'];
		}
		else
			return false;
	}
	
	public function fetch_row()
	{
		if( ! empty($this->query))
			return oci_fetch_row($this->query);
		else
			return 0;	
	}
	
	public function fetch_array()
	{
		if( ! empty($this->query))
			return oci_fetch_array($this->query);
		else
			return false;	
	}
	
	public function fetch_assoc()
	{
		if( ! empty($this->query))
			return oci_fetch_assoc($this->query);
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
		if( ! empty($this->connect)) @oci_close($this->connect); else return false;
	}	
	
	public function version()
	{
		if( ! empty($this->connect)) return oci_server_version($this->connect); else return false;
	}	
}