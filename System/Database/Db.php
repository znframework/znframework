<?php
class Db
{
	private $select;
	private $from;
	private $where;
	private $all;
	private $distinct;
	private $distinctrow;
	private $high_priority;
	private $straight_join;
	private $small_result;		
	private $big_result;			
	private $buffer_result;	
	private $cache;	
	private $no_cache;
	private $calc_found_rows;	
	private $math;
	private $group_by;
	private $having;
	private $order_by;
	private $limit;
	private $secure;
	private $join;
	private $trans_start;
	private $trans_error;
	private $prefix;
	
	public function __construct($config = array())
	{
		require_once(DB_DIR.'DbCommon.php');
		
		$this->db = dbcommon();
		
		$this->prefix = config::get('Database', 'prefix');
		
		if(empty($config)) $config = config::get('Database');
		
		$this->db->connect($config);
	}
	
	public function select($condition = '*')
	{
		if( ! is_string($condition)) $condition = '*';
		
		$this->select = 'SELECT '.$condition.' ';
		return $this;
	}
	
	public function from($table = '')
	{
		if( ! is_string($table)) return false;
		
		$this->from = ' FROM '.$this->prefix.$table.' ';
		
		return $this;
	}
	
	public function where($column = '', $value = '', $logical = '')
	{
		if( ! (is_string($column) || is_string($value))) return false;
		
		$value = "'".$this->db->real_escape_string($value)."'";
		
		$condition = ' '.$logical.' ';
		
		$this->where .= ' '.$column.' '.$value.' '.$logical.' ';
		
		return $this;
	}
	
	public function having($column = '', $value = '', $logical = '')
	{
		if( ! (is_string($column) || is_string($value))) return false;
		
		$value = "'".$this->db->real_escape_string($value)."'";
		
		$condition = ' '.$logical.' ';
		
		$this->having = ' '.$column.' '.$value.' '.$logical.' ';
		
		return $this;
	}
	
	public function join($table = '', $condition = '', $type = '')
	{
		if( ! is_string($table) ||  ! is_string($condition) ||  ! is_string($type)) return false;
		
		$this->join .= ' '.$type.' JOIN '.$table.' ON '.$condition.' ';
		
		return $this;
	}
	
	public function get($table = '')
	{
		if( ! is_string($table)) return false;
		
		if(empty($this->select)) $this->select = 'SELECT * ';
				
		if( ! empty($table)) $this->from = ' FROM '.$this->prefix.$table.' ';
		
		if( ! empty($this->where)) $where = ' WHERE '; else $where = '';
		
		if( ! empty($this->having)) $having = ' HAVING '; else $having = '';
		
		$query_builder = $this->all.
						 $this->distinct.
						 $this->distinctrow.
						 $this->high_priority.
						 $this->straight_join.
						 $this->small_result.
						 $this->big_result.
						 $this->buffer_result.
						 $this->cache.
						 $this->no_cache.
						 $this->calc_found_rows.
						 $this->select.
						 $this->math.
						 $this->from.
						 $this->join.
						 $where.$this->where.
						 $this->group_by.
						 $having.$this->having.
						 $this->order_by.
						 $this->limit;	
		
		$this->_reset_query();
		
		$secure = $this->secure;
		
		$this->db->query($this->_query_security($query_builder), $secure);
		
		return $this;
	}
	
	public function query($query = '')
	{
		if( ! is_string($query) || empty($query)) return false;
		
		$secure = $this->secure;

		$this->db->query($this->_query_security($query), $secure);
		
		if( ! empty($this->trans_start)) 
		{
			$trans_error = $this->db->error();
			if( ! empty($trans_error)) 
			{
				$this->trans_error = $trans_error; 
			}
		}
		
		return $this;
	}
	
	public function exec_query($query = '')
	{
		if( ! is_string($query) || empty($query)) return false;	
		
		$secure = $this->secure;
		
		return $this->db->exec($this->_query_security($query), $secure);
	}
	
	public function trans_start()
	{
		$this->trans_start = $this->db->trans_start();
	}
	
	public function trans_end()
	{
		if( ! empty($this->trans_error))
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		
		$this->trans_start = NULL;	
		$this->trans_error = NULL;
	}
	
	public function total_rows(){ return $this->db->num_rows(); }
	
	public function total_columns(){ return $this->db->num_fields(); }
	
	public function columns(){ return $this->db->columns(); }
	
	public function result(){ return $this->db->result(); }
	
	public function result_array(){ return $this->db->result_array(); }
	
	public function fetch_array(){ return $this->db->fetch_array(); }
	
	public function fetch_assoc(){ return $this->db->fetch_assoc(); }
	
	public function fetch_row(){ return $this->db->fetch_row(); }
	
	public function row(){ return $this->db->row(); }
	
	public function affected_rows(){ return $this->db->affected_rows(); }
	
	public function insert_id(){ return $this->db->insert_id(); }
	
	public function column_data(){ return $this->db->column_data(); }
	
	public function error(){ return $this->db->error(); }
	
	public function close(){ return $this->db->close(); }
	
	public function all(){ $this->all = ' ALL '; return $this; }
	
	public function distinct(){ $this->distinct = ' DISTINCT '; return $this; }
	
	public function distinctrow(){ $this->distinctrow = ' DISTINCTROW '; return $this; }
	
	public function straight_join(){ $this->straight_join = ' STRAIGHT_JOIN '; return $this; }	
		
	public function high_priority(){ $this->high_priority = ' HIGH PRIORITY '; return $this; }
	
	public function small_result(){ $this->small_result = ' SQL_SMALL_RESULT '; return $this; }
	
	public function big_result(){ $this->big_result = ' SQL_BIG_RESULT '; return $this; }
	
	public function buffer_result(){ $this->buffer_result = ' SQL_BUFFER_RESULT '; return $this; }
	
	public function cache(){ $this->cache = ' SQL_CACHE '; return $this; }
	
	public function no_cache(){ $this->no_cache = ' SQL_NO_CACHE '; return $this; }
	
	public function calc_found_rows(){ $this->calc_found_rows = ' SQL_CALC_FOUND_ROWS '; return $this; }
	
	public function math($expresion = array())
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
		
		$this->math = $math; 
		
		return $this; 
	}
	
	public function group_by($condition = ''){ if( ! is_string($condition)) return false; $this->group_by = ' GROUP BY '.$condition.' ' ; return $this; }
	
	public function order_by($condition = '', $type = '')
	{ 
		if( ! (is_string($condition) || is_string($type))) return false; 
		
		$this->order_by = ' ORDER BY '.$condition.' '.$type.' ';  
		
		return $this; 
	}
	
	public function limit($start = '', $limit = '')
	{ 
		if( ! is_numeric($start) || ! is_numeric($limit) ) return false; 
		
		if( ! empty($limit) ) $comma = ' , '; else $comma = '';
		
		$this->limit = ' LIMIT '.$start.$comma.$limit.' ';
		
		return $this; 
	}
	
	
	public function secure($data = array())
	{
		if( ! is_array($data)) return false;
		
		$this->secure = $data;
		
		return $this;
	}
	
	private function _query_security($query = '')
	{	
		
		if(isset($this->secure)) 
		{
			$secure = $this->secure;
			$secure_params = array();
			if( is_numeric(key($secure)))
			{	
				$strex = explode('?', $query);	
				$newstr = '';
				for($i = 0; $i < count($secure); $i++)
				{
					$newstr .= $strex[$i].$this->db->real_escape_string($secure[$i]);
				}
			
				$query = $newstr;
			}
			else
			{
				foreach($this->secure as $k => $v)
				{
					$secure_params[$k] = $this->db->real_escape_string($v);
				}
			}
			$query = str_replace(array_keys($secure_params), array_values($secure_params), $query);
		}
		$this->secure = NULL;

		return $query;
	}
	
	private function _reset_query()
	{
		$this->all = NULL;
		$this->distinct = NULL;
		$this->distinctrow = NULL;
		$this->high_priority = NULL;
		$this->straight_join = NULL;
		$this->small_result = NULL;
		$this->big_result = NULL;
		$this->buffer_result = NULL;
		$this->cache = NULL;
		$this->no_cache = NULL;
		$this->calc_found_rows = NULL;
		$this->select = NULL;
		$this->math = NULL;
		$this->from = NULL;
		$this->where = NULL;
		$this->group_by = NULL;
		$this->having = NULL;
		$this->order_by = NULL;
		$this->limit = NULL;
	}
	
	public function insert($table = '', $datas = array())
	{
		if( ! is_string($table) || empty($table)) return false;
		if( ! is_array($datas) || empty($datas)) return false;
		
		$data = ""; $values = "";
		
		foreach($datas as $key => $value)
		{
			$data .= $key.",";
			if($value !== '?')
				$values .= "'".$value."'".",";
			else
				$values .= $value.",";
			
		}
			
		$insert_query = 'INSERT INTO '.$this->prefix.$table.' ('.substr($data,0,-1).') VALUES ('.substr($values,0,-1).')';
		
		$secure = $this->secure;
		$this->db->query($this->_query_security($insert_query), $secure);
	}
	
	public function update($table = '', $set = array())
	{
		if( ! is_string($table) || empty($table)) return false;
		if( ! is_array($set) || empty($set)) return false;
		
		if( ! empty($this->where)) $where = ' WHERE '; else $where = '';
		
		$data = '';
		
		foreach($set as $key => $value)
		{
			$data .= $key.'='."'".$value."'".',';
		}
		$set = ' SET '.substr($data,0,-1);
		
		$update_query = 'UPDATE '.$this->prefix.$table.$set.$where.$this->where;
		
		$this->where = NULL;
		$secure = $this->secure;
		$this->db->query($this->_query_security($update_query), $secure);	
	}
	
	public function delete($table = '')
	{
		if( ! is_string($table) || empty($table)) return false;
		
		if( ! empty($this->where)) $where = ' WHERE '; else $where = '';
		
		$delete_query = 'DELETE FROM '.$this->prefix.$table.$where.$this->where;
		
		$this->where = NULL;
		
		$secure = $this->secure;
		$this->db->query($this->_query_security($delete_query), $secure);
	}
	
	public function version()
	{
		return $this->db->version();	
	}
	
	public function different_connection($connect_name = '')
	{
		if( ! is_string($connect_name)) return false;
	
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
	
	public function __destruct()
	{
		$this->db->close();	
	}
}