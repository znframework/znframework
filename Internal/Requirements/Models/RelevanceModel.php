<?php namespace ZN\Requirements\Models;

use DB, DBTool, DBForge, Strings, Arrays, GeneralException;

class RelevanceModel extends \BaseController
{
    //--------------------------------------------------------------------------------------------------------
    // Relevance Model -> 5.3.5
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------
    
    //--------------------------------------------------------------------------------------------------------
    // Relevance 
    //--------------------------------------------------------------------------------------------------------
    // 
    // @var object
    //
    //--------------------------------------------------------------------------------------------------------  
    protected $relevance;
    
    //--------------------------------------------------------------------------------------------------------
    // Result Methods 
    //--------------------------------------------------------------------------------------------------------
    // 
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------  
    protected $resultMethods = 
    [
        'result', 'resultarray', 'row', 'columns', 'columndata', 'totalrows', 'totalcolumns', 'value',
        'stringquery'
    ];

    //--------------------------------------------------------------------------------------------------------
    // Manipulation Methods 
    //--------------------------------------------------------------------------------------------------------
    // 
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------  
    protected $manipulationMethods = 
    [
        'update', 'delete'
    ];

    //--------------------------------------------------------------------------------------------------------
    // Tool Methods 
    //--------------------------------------------------------------------------------------------------------
    // 
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------  
    protected $toolMethods = 
    [
        'status', 'optimize', 'repair', 'backup'
    ];

    //--------------------------------------------------------------------------------------------------------
    // Magic Construct 
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------  
    public function __construct()
    {
        if( ! defined('static::relevance') )
        {
            throw new GeneralException('relevance constant is not defined!');
        }
        elseif( empty(static::relevance) )
        {
            throw new GeneralException('at least 1 key is needed in [first_table.column:second_table.column] form for relevance constant!');
        }

        $this->relevance = static::relevance;

        $this->_selectColumnsPrefix();
    }

    //--------------------------------------------------------------------------------------------------------
    // Magic Call 
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $method
    // @param array  $parameters
    //
    //--------------------------------------------------------------------------------------------------------  
    public function __call($method, $parameters)
    {
        $lowerMethod = strtolower($method);

        $split = Strings::splitUpperCase($method);
        
        if( Arrays::valueExists($this->resultMethods, strtolower($lowerMethod)) )
        {
            return $this->_resultMethods($method, $parameters);
        }
        elseif( Arrays::valueExists($this->manipulationMethods, strtolower($lowerMethod)) )
        {
            return $this->_manipulationMethods($method, $parameters);
        }
        elseif( Arrays::valueExists($this->toolMethods, strtolower($lowerMethod)) )
        {
            return $this->_toolMethods($method, $parameters);
        }
        elseif( $split[0] === 'row' )
        {
            return $this->_row($split[1], $split[2], $parameters, $split[3] ?? NULL);
        }
        elseif( $split[0] === 'update' )
        {
            return $this->_update($split[1], $split[2], $parameters, $split[3] ?? NULL);
        }
        elseif( $split[0] === 'delete' )
        {
            return $this->_delete($split[1], $split[2], $parameters, $split[3] ?? NULL);
        }
        else
        {
            DB::$method(...$parameters);

            return $this;
        }    
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected DB Table Column
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $database
    // @param string $table
    // @param string $column
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _dbtablecolumn($database, $table, $column, $param)
    {
        if( $database !== NULL )
        {
            return $table . '.' . $column . '.' . $database . $param;
        }

        return $table . '.' . $column . $param;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Row
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $table
    // @param string $colunm
    // @param array  $parameters
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _row($table, $column, $parameters, $database)
    {
        $this->relevance();

        return DB::where
        (
            $this->_dbtablecolumn($database, $table, $column, $parameters[1] ?? NULL), 
            $parameters[0] ?? NULL
        )
        ->get($this->_tableName())
        ->row();
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Update
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $table
    // @param string $colunm
    // @param array  $parameters
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _update($table, $column, $parameters, $database)
    {
        $this->relevance();

        return DB::where
        (
            $this->_dbtablecolumn($database, $table, $column, $parameters[2] ?? NULL), 
            $parameters[1] ?? NULL
        )
        ->update($this->_tableName(), $parameters[0]);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Delete
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $table
    // @param string $colunm
    // @param array  $parameters
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _delete($table, $column, $parameters, $database)
    {
        $this->relevance();

        return DB::where
        (
            $this->_dbtablecolumn($database, $table, $column, $parameters[1] ?? NULL), 
            $parameters[0] ?? NULL
        )
        ->delete($this->_tableName());
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Tool Methods
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _toolMethods($method, $parameters)
    {
        if( $method !== 'backup' )
        {
            $method = $method . 'Tables';
        }

        return DBTool::$method($this->_tables(), ...$parameters);
    }

    //--------------------------------------------------------------------------------------------------------
    // Drop
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function drop($type = 'dropTable')
    {
        $tables = $this->_tables();

        foreach( $tables as $table )
        {
            DBForge::$type($table);
        }

        return true;
    }

    //--------------------------------------------------------------------------------------------------------
    // Drop
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function truncate()
    {
        return $this->drop(__FUNCTION__);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Tables
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------  
    protected function _tables()
    {
        $tables = [];
        
        foreach( $this->relevance as $key => $value )
        {
            if( ! is_numeric($key) )
            {
                $value = $key;
            }

            $tables[] = $this->_texplode($value); 
            $tables[] = $this->_texplode($value, 1);
        }
        

        return array_unique($tables);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Result Methods
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $method
    // @param array  $parameters
    //
    //--------------------------------------------------------------------------------------------------------  
    protected function _resultMethods($method, $parameters)
    {
        $this->relevance();
        
        return DB::get($this->_tableName())->$method(...$parameters);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Manipulation Methods
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $method
    // @param array  $parameters
    //
    //--------------------------------------------------------------------------------------------------------  
    protected function _manipulationMethods($method, $parameters)
    {
        $this->relevance();
        
        return DB::$method($this->_tableName(), ...$parameters);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Relevance
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------  
    protected function relevance()
    {
        $result = [];

        foreach( $this->relevance as $key => $value )
        {
            $type = 'inner';

            if( ! is_numeric($key) )
            {
                $type  = $value;
                $value = $key;
            }

            DB::join($this->_texplode($value, -1), str_replace(':', '=', $value), $type);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Select
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $table
    //
    //-------------------------------------------------------------------------------------------------------- 
    protected function _select($table)
    {
        $columns = DB::get($table)->columns();

        $select  = Arrays::forceValues($columns, function($data) use($table)
        {
            return prefix($data, $table . '.' . $data . ' as ' . $table . '_');
        });

        return implode(', ', $select);
    }

     //--------------------------------------------------------------------------------------------------------
    // Protected Select Columns Prefix
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param void
    //
    //-------------------------------------------------------------------------------------------------------- 
    protected function _selectColumnsPrefix()
    {
        $select = NULL;

        foreach( $this->_tables() as $table )
        {
            $select .= $this->_select($table) . ', ';
        }

        DB::select(rtrim($select, ', '));
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Table Name
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param void
    //
    //-------------------------------------------------------------------------------------------------------- 
    protected function _tableName()
    {
        return $this->_texplode($this->_current(), 0);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Texplode
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $value
    // @param int    $index
    //
    //--------------------------------------------------------------------------------------------------------  
    protected function _texplode($value, $index = 0)
    {
        $ex = explode('.', Strings::divide($value, ':', $index));

        return count($ex) === 3 ? $ex[0].$ex[1] : $ex[0];
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Current
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------  
    protected function _current()
    {
        return ! is_numeric($key = key($this->relevance)) ? $key : current($this->relevance);;
    }
}

class_alias('ZN\Requirements\Models\RelevanceModel', 'RelevanceModel');