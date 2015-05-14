<?php
/************************************************************/
/*                  STATIC DB FORGE LIBRARY                 */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class SDbForge
{
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
	
	public static function create_database($dbname = '')
	{
		if( ! is_string($dbname) || empty($dbname)) return false;
		
		if(empty(self::$connect)) self::connect();
			
		self::$db->exec('CREATE DATABASE '.$dbname);
	}
	
	public static function drop_database($dbname = '')
	{
		if( ! is_string($dbname) || empty($dbname)) return false;
		
		if(empty(self::$connect)) self::connect();
		
		self::$db->exec('DROP DATABASE '.$dbname);
	}
	
	public static function create_table($table = '', $condition = array())
	{
		if( ! is_string($table) || empty($table)) return false;
		if( ! is_array($condition)) return false;
		
		$keys = array_keys($condition);
		
		$column = "";
		
		foreach($condition as $key => $value)
		{
			$column .= $key.' '.$value.',';
		}
		
		if(empty(self::$connect)) self::connect();
		
		self::$db->exec('CREATE TABLE '.self::$prefix.$table.'('.substr($column,0,-1).')');
	}
	
	public static function drop_table($table = '')
	{
		if( ! is_string($table) || empty($table)) return false;
		
		if(empty(self::$connect)) self::connect();
		
		self::$db->exec('DROP TABLE '.self::$prefix.$table);
	}
	
	public static function alter_table($table = '', $condition = array())
	{
		if(empty(self::$connect)) self::connect();
	
		if(key($condition) === 'rename_table') 			self::rename_table($table, $condition['rename_table']);
		elseif(key($condition) === 'add_column') 		self::add_column($table, $condition['add_column']);
		elseif(key($condition) === 'drop_column') 		self::drop_column($table, $condition['drop_column']);	
		elseif(key($condition) === 'modify_column') 	self::modify_column($table, $condition['modify_column']);
		elseif(key($condition) === 'rename_column') 	self::rename_column($table, $condition['rename_column']);
	}
		
	public static function rename_table($name = '', $new_name = '')
	{
		if( ! is_string($name) || ! is_string($new_name)) return false;
		if(empty($name) || empty($new_name)) return false;
		
		if(empty(self::$connect)) self::connect();
		
		self::$db->exec('ALTER TABLE '.self::$prefix.$name.' RENAME TO '.self::$prefix.$new_name);
	}
	
	public static function add_column($table = '', $condition = array())
	{
		if( ! is_string($table) || empty($table)) return false;
		if( ! is_array($condition)) return false;
		
		if(empty(self::$connect)) self::connect();
		
		if(self::$db->add_column() !== false)
			$add_column = self::$db->add_column();
		else
			$add_column = 'ADD ';
		
		$con = NULL;
		
		foreach($condition as $column => $values)
		{
			$colvals = '';
			if(is_array($values))
			{	
				foreach($values as $val)
					$colvals .= ' '.$val;
			}
			else
				$colvals .= ' '.$values;
				
			$con .= $add_column.$column.$colvals.',';
		}		
			
		$con = substr($con, 0 , -1);
		
		self::$db->exec('ALTER TABLE '.$table.' '.$con.';'); 
	}
	
	public static function drop_column($table = '', $column = '')
	{
		if( ! is_string($table) || empty($table)) return false;
		if( ! (is_string($column) || is_array($column)) || empty($column)) return false;
		
		if(empty(self::$connect)) self::connect();
		
		if(self::$db->drop_column() !== false)
			$drop_column = self::$db->drop_column();
		else
			$drop_column = 'DROP ';
		
		if( ! is_array($column))
			self::$db->exec('ALTER TABLE '.self::$prefix.$table.' '.$drop_column.$column.';');		
		else
			foreach($column as $col)
				self::$db->exec('ALTER TABLE '.self::$prefix.$table.' '.$drop_column.$col.';');
	}
	
	public static function modify_column($table = '', $condition = array())
	{
		if( ! is_string($table) || empty($table)) return false;
		if( ! is_array($condition)) return false;
		
		if(empty(self::$connect)) self::connect();
		
		if(self::$db->modify_column() !== false)
			$modify_column = self::$db->modify_column();
		else
			$modify_column = 'MODIFY ';
		
		$con = NULL;
			
		foreach($condition as $column => $values)
		{
			$colvals = '';
			if(is_array($values))
			{	
				foreach($values as $val)
					$colvals .= ' '.$val;
			}
			else
				$colvals .= ' '.$values;
				
			$con .= $modify_column.$column.$colvals.',';
		}		
		
		$con = substr($con, 0 , -1);
		
		self::$db->exec('ALTER TABLE '.self::$prefix.$table.' '.$con.';');
	}
	
	public static function rename_column($table = '', $condition = array())
	{
		if( ! is_string($table) || empty($table)) return false;
		if( ! is_array($condition)) return false;
		
		if(empty(self::$connect)) self::connect();
		
		if(self::$db->rename_column() !== false)
			$rename_column = self::$db->rename_column();
		else
			$rename_column = 'CHANGE COLUMN ';
		
		$con = NULL;
		
		foreach($condition as $column => $values)
		{
			$colvals = '';
			if(is_array($values))
			{	
				foreach($values as $val)
					$colvals .= ' '.$val;
			}
			else
				$colvals .= ' '.$values;
				
			$con .= $rename_column.$column.$colvals.',';
		}		
		
		$con = substr($con, 0 , -1);
		
		self::$db->exec('ALTER TABLE '.self::$prefix.$table.' '.$con.';');
	}
	
	public static function truncate($table = '')
	{
		if( ! is_string($table) || empty($table)) return false;
		
		if(empty(self::$connect)) self::connect();
		
		if(self::$db->truncate() !== false)
			$truncate = self::$db->truncate();
		else
			$truncate = 'TRUNCATE TABLE ';
			
		self::$db->exec($truncate.self::$prefix.$table);
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
		
		return new DbForge($config_different[$connect_name]);
	}
	
	public static function error(){ if(empty(self::$connect)) return false; return self::$db->error(); }
}