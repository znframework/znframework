<?php
namespace ZN\Database;

class InternalDBForge extends DatabaseCommon implements DBForgeInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------

	//----------------------------------------------------------------------------------------------------
	// Forge
	//----------------------------------------------------------------------------------------------------
	// 
	// @var object
	//
	//----------------------------------------------------------------------------------------------------
	protected $forge;

	//----------------------------------------------------------------------------------------------------
	// Extras
	//----------------------------------------------------------------------------------------------------
	// 
	// @var mixed
	//
	//----------------------------------------------------------------------------------------------------
	protected $extras;

	//----------------------------------------------------------------------------------------------------
	// Construct
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function __construct()
	{
		parent::__construct();

		$this->forge = uselib($this->_drvlib($this->config['driver'], 'Forge'));
	}

	//----------------------------------------------------------------------------------------------------
	// Extras
	//----------------------------------------------------------------------------------------------------
	// 
	// @param mixed $extras
	//
	//----------------------------------------------------------------------------------------------------
	public function extras($extras)
	{
		$this->extras = $extras;

		return $this;
	}

	//----------------------------------------------------------------------------------------------------
	// Create Database
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $dbname
	// @param mixed  $extras
	//
	//----------------------------------------------------------------------------------------------------
	public function createDatabase(String $dbname, $extras = NULL)
	{
		$query  = $this->forge->createDatabase($dbname, $this->extras($extras, 'extras'));	
		
		return $this->_runExecQuery($query);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Drop Database
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $dbname
	//
	//----------------------------------------------------------------------------------------------------
	public function dropDatabase(String $dbname)
	{
		$query  = $this->forge->dropDatabase($dbname);	
		
		return $this->_runExecQuery($query);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Create Table
	//----------------------------------------------------------------------------------------------------
	// 
	// @param mixed $table
	// @param mixed $condition
	// @param mixed $extras
	//
	//----------------------------------------------------------------------------------------------------
	public function createTable(String $table = NULL, Array $condition, $extras = NULL)
	{
		$column = '';

		foreach( $condition as $key => $value )
		{
			$values = '';
			
			if( is_array($value) ) foreach( $value as $val )
			{
				$values .= ' '.$val;
			}
			else
			{
				$values = $value;	
			}
			
			$column .= $key.' '.$values.',';
		}
		
		$query = $this->forge->createTable($this->_p($table), $column, $extras);
	
		return $this->_runExecQuery($query);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Drop Table
	//----------------------------------------------------------------------------------------------------
	// 
	// @param mixed $table
	//
	//----------------------------------------------------------------------------------------------------
	public function dropTable(String $table = NULL)
	{	
		$query = $this->forge->dropTable($this->_p($table));
		
		return $this->_runExecQuery($query);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Alter Table
	//----------------------------------------------------------------------------------------------------
	// 
	// @param mixed $table
	// @param mixed $condition
	//
	//----------------------------------------------------------------------------------------------------
	public function alterTable(String $table = NULL, Array $condition = NULL)
	{
		$table     = $this->_p($table);	
		
		if( key($condition) === 'renameTable' ) 			
		{
			return $this->renameTable($table, $condition['renameTable']);
		}
		elseif( key($condition) === 'addColumn' ) 		
		{
			return $this->addColumn($table, $condition['addColumn']);
		}
		elseif( key($condition) === 'dropColumn' ) 		
		{
			return $this->dropColumn($table, $condition['dropColumn']);	
		}
		elseif( key($condition) === 'modifyColumn' ) 	
		{
			return $this->modifyColumn($table, $condition['modifyColumn']);
		}
		elseif( key($condition) === 'renameColumn' ) 	
		{
			return $this->renameColumn($table, $condition['renameColumn']);
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Rename Table
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $name
	// @param string $newName
	//
	//----------------------------------------------------------------------------------------------------
	public function renameTable(String $name, String $newName)
	{
		$query  = $this->forge->renameTable($this->_p($name, 'prefix'), $this->_p($newName, 'prefix'));
		
		return $this->_runExecQuery($query);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Truncate
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $table
	//
	//----------------------------------------------------------------------------------------------------
	public function truncate(String $table = NULL)
	{
		$query = $this->forge->truncate($this->_p($table));
		
		return $this->_runExecQuery($query);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Add Column
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $table
	// @param array  $condition
	//
	//----------------------------------------------------------------------------------------------------
	public function addColumn(String $table = NULL, Array $columns = NULL)
	{	
		$con = NULL;
		
		$columns = $this->_p($columns, 'column');

		foreach( $columns as $column => $values )
		{
			$colvals = '';
			
			if( is_array($values) )
			{	
				foreach( $values as $val )
				{
					$colvals .= ' '.$val;
				}
			}
			else
			{
				$colvals .= ' '.$values;
			}
			
			$con .= $column.$colvals.',';
		}		
		
		$query  = $this->forge->addColumn($this->_p($table), $con);
		
		return $this->_runExecQuery($query);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Drop Column
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $table
	// @param mixed  $column
	//
	//----------------------------------------------------------------------------------------------------
	public function dropColumn(String $table = NULL, $column = NULL)
	{
		if( ! is_array($column) )
		{
			$query = $this->forge->dropColumn($this->_p($table), $column);
			
			return $this->_runExecQuery($query);
		}
		else
		{
			$columns = $this->_p($column, 'column');

			foreach( $columns as $col )
			{
				$query = $this->forge->dropColumn($this->_p($table), $col);
				
				$this->_runExecQuery($query);
			}
			
			return true;
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Modify Column
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $table
	// @param mixed  $columns
	//
	//----------------------------------------------------------------------------------------------------
	public function modifyColumn(String $table = NULL, Array $columns = NULL)
	{
		$con = NULL;

		$columns = $this->_p($columns, 'column');
			
		foreach( $columns as $column => $values )
		{
			$colvals = '';
			
			if( is_array($values) )
			{	
				foreach( $values as $val )
				{
					$colvals .= ' '.$val;
				}
			}
			else
			{
				$colvals .= ' '.$values;
			}
			
			$con .= $modifyColumn.$column.$colvals.',';
		}		
	
		$query  = $this->forge->modifyColumn($this->_p($table), $con);
		
		return $this->_runExecQuery($query);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Rename Column
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $table
	// @param mixed  $columns
	//
	//----------------------------------------------------------------------------------------------------
	public function renameColumn(String $table = NULL , Array $columns = NULL)
	{	
		$con = NULL;
		
		$columns = $this->_p($columns, 'column');

		foreach( $columns as $column => $values )
		{
			$colvals = '';
			
			if( is_array($values) )
			{	
				foreach( $values as $val )
				{
					$colvals .= ' '.$val;
				}
			}
			else
			{
				$colvals .= ' '.$values;
			}
			
			$con .= $column.$to.$colvals.',';
		}		

		$query  = $this->forge->renameColumn($this->_p($table), $con);
		
		return $this->_runExecQuery($query);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Column Manipulation Methods Bitiş
	//----------------------------------------------------------------------------------------------------
}