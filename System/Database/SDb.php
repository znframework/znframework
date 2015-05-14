<?php
/************************************************************/
/*                    STATIC DB LIBRARY                     */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class SDb
{
	private static $select;
	private static $select_column;
	private static $from;
	private static $where;
	private static $all;
	private static $distinct;
	private static $distinctrow;
	private static $high_priority;
	private static $straight_join;
	private static $small_result;		
	private static $big_result;			
	private static $buffer_result;	
	private static $cache;	
	private static $no_cache;
	private static $calc_found_rows;	
	private static $math;
	private static $group_by;
	private static $having;
	private static $order_by;
	private static $limit;
	private static $secure;
	private static $join;
	private static $trans_start;
	private static $trans_error;
	private static $prefix;
	private static $db;
	private static $connect;
	
	public static function connect($config = array())
	{
		require_once(DB_DIR.'DbCommon.php');
		
		self::$db = dbcommon();
		
		self::$prefix = config::get('Database', 'prefix');
		
		if(empty($config)) $config = config::get('Database');
		
		self::$db->connect($config);
		
		self::$connect = true;
	}
	
	public static function select($condition = '*')
	{
		if( ! is_string($condition)) $condition = '*';
		
		self::$select_column = ' '.$condition.' ';
		self::$select = 'SELECT';
	}
	
	public static function from($table = '')
	{
		if( ! is_string($table)) return false;
		
		self::$from = ' FROM '.self::$prefix.$table.' ';
	}
	
	public static function where($column = '', $value = '', $logical = '')
	{
		if( ! (is_string($column) || is_string($value))) return false;
		
		if(empty(self::$connect)) self::connect();
		
		$value = "'".self::$db->real_escape_string($value)."'";

		self::$where .= ' '.$column.' '.$value.' '.$logical.' ';
	}
	
	public static function having($column = '', $value = '', $logical = '')
	{
		if( ! (is_string($column) || is_string($value))) return false;
		
		if(empty(self::$connect)) self::connect();
		
		$value = "'".self::$db->real_escape_string($value)."'";

		self::$having = ' '.$column.' '.$value.' '.$logical.' ';
	}
	
	public static function join($table = '', $condition = '', $type = '')
	{
		if( ! is_string($table) ||  ! is_string($condition) ||  ! is_string($type)) return false;
		
		self::$join .= ' '.$type.' JOIN '.$table.' ON '.$condition.' ';
	}
	
	public static function get($table = '')
	{
		if( ! is_string($table)) return false;
		
		if(empty(self::$connect)) self::connect();
		
		if(empty(self::$select)) { self::$select = 'SELECT'; self::$select_column = ' * '; }
				
		if( ! empty($table)) self::$from = ' FROM '.self::$prefix.$table.' ';
		
		if( ! empty(self::$where)) 
		{
			$where = ' WHERE '; 
	
			if(strtolower(substr(trim(self::$where),-2)) === 'or')
				self::$where = substr(trim(self::$where),0,-2);
		
			if(strtolower(substr(trim(self::$where),-3)) === 'and')
				self::$where = substr(trim(self::$where),0,-3);		
		}
		else 
			$where = '';
		
		if( ! empty(self::$having))
		{
			$having = ' HAVING '; 
			
			if(strtolower(substr(trim(self::$having),-2)) === 'or')
				self::$having = substr(trim(self::$having),0,-2);
		
			if(strtolower(substr(trim(self::$having),-3)) === 'and')
				self::$having = substr(trim(self::$having),0,-3);		
		}
		else 
			$having = '';
		
		$query_builder = self::$select.
						 self::$all.
						 self::$distinct.
						 self::$distinctrow.
						 self::$high_priority.
						 self::$straight_join.
						 self::$small_result.
						 self::$big_result.
						 self::$buffer_result.
						 self::$cache.
						 self::$no_cache.
						 self::$calc_found_rows.
						 self::$select_column.
						 self::$math.
						 self::$from.
						 self::$join.
						 $where.self::$where.
						 self::$group_by.
						 $having.self::$having.
						 self::$order_by.
						 self::$limit;	
		
		self::_reset_query();
		
		$secure = self::$secure;
		
		self::$db->query(self::_query_security($query_builder), $secure);
	}
	
	public static function query($query = '')
	{
		if( ! is_string($query) || empty($query)) return false;
		
		if(empty(self::$connect)) self::connect();
		
		$secure = self::$secure;

		self::$db->query(self::_query_security($query), $secure);
		
		if( ! empty(self::$trans_start)) 
		{
			$trans_error = self::$db->error();
			if( ! empty($trans_error)) 
			{
				self::$trans_error = $trans_error; 
			}
		}
	}
	
	public static function exec_query($query = '')
	{
		if( ! is_string($query) || empty($query)) return false;	
		
		if(empty(self::$connect)) self::connect();
		
		$secure = self::$secure;
		
		return self::$db->exec(self::_query_security($query), $secure);
	}
	
	public static function trans_start()
	{
		if(empty(self::$connect)) self::connect();
		
		self::$trans_start = self::$db->trans_start();
	}
	
	public static function trans_end()
	{
		if(empty(self::$connect)) return false;
		
		if( ! empty(self::$trans_error))
			self::$db->trans_rollback();
		else
			self::$db->trans_commit();
		
		self::$trans_start = NULL;	
		self::$trans_error = NULL;
	}
	
	public static function total_rows(){if(empty(self::$connect)) return false; return self::$db->num_rows(); }
	
	public static function total_columns(){if(empty(self::$connect)) return false; return self::$db->num_fields(); }
	
	public static function columns(){if(empty(self::$connect)) return false; return self::$db->columns(); }
	
	public static function result(){if(empty(self::$connect)) return false; return self::$db->result(); }
	
	public static function result_array(){if(empty(self::$connect)) return false; return self::$db->result_array(); }
	
	public static function fetch_array(){if(empty(self::$connect)) return false; return self::$db->fetch_array(); }
	
	public static function fetch_assoc(){if(empty(self::$connect)) return false; return self::$db->fetch_assoc(); }
	
	public static function fetch_row(){if(empty(self::$connect)) return false; return self::$db->fetch_row(); }
	
	public static function row(){if(empty(self::$connect)) return false; return self::$db->row(); }
	
	public static function affected_rows(){if(empty(self::$connect)) return false; return self::$db->affected_rows(); }
	
	public static function insert_id(){if(empty(self::$connect)) return self::$db->insert_id(); }
	
	public static function column_data(){if(empty(self::$connect)) return false; return self::$db->column_data(); }
	
	public static function error(){if(empty(self::$connect)) return false; return self::$db->error(); }
	
	public static function close(){if(empty(self::$connect)) return false; self::$db->close(); }
	
	public static function all(){ self::$all = ' ALL '; }
	
	public static function distinct(){ self::$distinct = ' DISTINCT '; }
	
	public static function distinctrow(){ self::$distinctrow = ' DISTINCTROW '; }
	
	public static function straight_join(){ self::$straight_join = ' STRAIGHT_JOIN '; }	
		
	public static function high_priority(){ self::$high_priority = ' HIGH PRIORITY '; }
	
	public static function small_result(){ self::$small_result = ' SQL_SMALL_RESULT '; }
	
	public static function big_result(){ self::$big_result = ' SQL_BIG_RESULT '; }
	
	public static function buffer_result(){ self::$buffer_result = ' SQL_BUFFER_RESULT '; }
	
	public static function cache(){ self::$cache = ' SQL_CACHE '; }
	
	public static function no_cache(){ self::$no_cache = ' SQL_NO_CACHE '; }
	
	public static function calc_found_rows(){ self::$calc_found_rows = ' SQL_CALC_FOUND_ROWS '; }
	
	public static function math($expresion = array())
	{ 
		if( ! is_array($expresion)) return false;
		$exp = ''; $vals = '';
		if( ! empty($expresion))foreach($expresion as $mf => $val)
		{
			$exp .= $mf.'(';
			if( ! empty($val) && is_array($val))foreach($val as $v)
			{
				if( ! is_numeric($v)) $v = "'".$v."'";
				$vals .= $v.',';
			}
			$vals = substr($vals, 0, -1);
			$exp .= $vals.'),';
		}
		
		$math = substr($exp, 0, -1);
		
		self::$math = $math; 
	}
	
	public static function group_by($condition = '')
	{ 
		if( ! is_string($condition)) 
			return false; 
		
		self::$group_by = ' GROUP BY '.$condition.' ';
	}
	
	public static function order_by($condition = '', $type = '')
	{ 
		if( ! (is_string($condition) || is_string($type))) return false; 
		
		self::$order_by = ' ORDER BY '.$condition.' '.$type.' ';  
	}
	
	public static function limit($start = '', $limit = '')
	{ 
		if( ! is_numeric($start) || ! is_numeric($limit) ) return false; 
		
		if( ! empty($limit) ) $comma = ' , '; else $comma = '';
		
		self::$limit = ' LIMIT '.$start.$comma.$limit.' ';
	}
	
	
	public static function secure($data = array())
	{
		if( ! is_array($data)) return false;
		
		self::$secure = $data;
	}
	
	private static function _query_security($query = '')
	{	
		
		if(isset(self::$secure)) 
		{
			$secure = self::$secure;
			$secure_params = array();
			if( is_numeric(key($secure)))
			{	
				$strex = explode('?', $query);	
				$newstr = '';
				for($i = 0; $i < count($secure); $i++)
				{
					$newstr .= $strex[$i].self::$db->real_escape_string($secure[$i]);
				}
			
				$query = $newstr;
			}
			else
			{
				foreach(self::$secure as $k => $v)
				{
					$secure_params[$k] = self::$db->real_escape_string($v);
				}
			}
			$query = str_replace(array_keys($secure_params), array_values($secure_params), $query);
		}
		self::$secure = NULL;

		return $query;
	}
	
	private static function _reset_query()
	{
		self::$all = NULL;
		self::$distinct = NULL;
		self::$distinctrow = NULL;
		self::$high_priority = NULL;
		self::$straight_join = NULL;
		self::$small_result = NULL;
		self::$big_result = NULL;
		self::$buffer_result = NULL;
		self::$cache = NULL;
		self::$no_cache = NULL;
		self::$calc_found_rows = NULL;
		self::$select = NULL;
		self::$select_column = NULL;
		self::$math = NULL;
		self::$from = NULL;
		self::$where = NULL;
		self::$group_by = NULL;
		self::$having = NULL;
		self::$order_by = NULL;
		self::$limit = NULL;
	}
	
	public static function insert($table = '', $datas = array())
	{
		if( ! is_string($table) || empty($table)) return false;
		if( ! is_array($datas) || empty($datas)) return false;
		
		if(empty(self::$connect)) self::connect();
			
		$data = ""; $values = "";
		
		foreach($datas as $key => $value)
		{
			$data .= $key.",";
			if($value !== '?')
				$values .= "'".$value."'".",";
			else
				$values .= $value.",";
			
		}
			
		$insert_query = 'INSERT INTO '.self::$prefix.$table.' ('.substr($data,0,-1).') VALUES ('.substr($values,0,-1).')';
		
		$secure = self::$secure;
		self::$db->query(self::_query_security($insert_query), $secure);
	}
	
	public static function update($table = '', $set = array())
	{
		if( ! is_string($table) || empty($table)) return false;
		if( ! is_array($set) || empty($set)) return false;
		
		if(empty(self::$connect)) self::connect();
		
		if( ! empty(self::$where)) $where = ' WHERE '; else $where = '';
		
		$data = '';
		
		foreach($set as $key => $value)
		{
			$data .= $key.'='."'".$value."'".',';
		}
		$set = ' SET '.substr($data,0,-1);
		
		$update_query = 'UPDATE '.self::$prefix.$table.$set.$where.self::$where;
		
		self::$where = NULL;
		$secure = self::$secure;
		self::$db->query(self::_query_security($update_query), $secure);	
	}
	
	public static function delete($table = '')
	{
		if( ! is_string($table) || empty($table)) return false;
		
		if(empty(self::$connect)) self::connect();
		
		if( ! empty(self::$where)) $where = ' WHERE '; else $where = '';
		
		$delete_query = 'DELETE FROM '.self::$prefix.$table.$where.self::$where;
		
		self::$where = NULL;
		
		$secure = self::$secure;
		self::$db->query(self::_query_security($delete_query), $secure);
	}
	
	public static function version()
	{
		if(empty(self::$connect)) self::connect();
		return self::$db->version();	
	}
	
	public static function different_connection($connect_name = '')
	{
		if( ! is_string($connect_name)) return false;
		
		if(empty(self::$connect)) self::connect();
		
		$config = config::get('Database');
		$config_different = $config['different_connection'];
		
		if( ! isset($config_different[$connect_name])) return false;
		
		
		foreach($config as $key => $val)
		{
			if($key !== 'different_connection')
				if( ! isset($config_different[$connect_name][$key]))
					$config_different[$connect_name][$key] = $val;
		}
		
		return new Db($config_different[$connect_name]);
	}
}