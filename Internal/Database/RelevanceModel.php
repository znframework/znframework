<?php namespace ZN\Database;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Base;
use ZN\Datatype;
use ZN\Singleton;
use ZN\Exception;

class RelevanceModel
{
    /**
     * protected relevance
     * 
     * @var object
     */
    protected $relevance;
    
    /**
     * Result Methods
     * 
     * @var array
     */
    protected $resultMethods = 
    [
        'result', 'resultarray', 'row', 'columns', 'columndata', 'totalrows', 'totalcolumns', 'value',
        'stringquery', 'pagination'
    ];

    /**
     * Manipulation Methods
     * 
     * @var array 
     */ 
    protected $manipulationMethods = 
    [
        'update', 'delete'
    ];

    /**
     * Tool Methods
     * 
     * @var array
     */
    protected $toolMethods = 
    [
        'status', 'optimize', 'repair', 'backup'
    ];

    /**
     * Magic Construct
     * 
     * @param void
     * 
     * @return void
     */
    public function __construct()
    {
        $this->db    = Singleton::class('ZN\Database\DB');
        $this->tool  = Singleton::class('ZN\Database\DBTool');
        $this->forge = Singleton::class('ZN\Database\DBForge');

        if( ! defined('static::relevance') )
        {
            throw new Exception('relevance constant is not defined!');
        }
        elseif( empty(static::relevance) )
        {
            throw new Exception('at least 1 key is needed in [first_table.column:second_table.column] form for relevance constant!');
        }

        $this->relevance = static::relevance;

        $this->_selectColumnsPrefix();
    }

    /**
     * Magic call
     * 
     * @param string $method
     * @param array  $parameters
     * 
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        $lowerMethod = strtolower($method);

        $split = Datatype::splitUpperCase($method);
        
        if( in_array($lowerMethod, $this->resultMethods) )
        {
            return $this->_resultMethods($method, $parameters);
        }
        elseif( in_array($lowerMethod, $this->manipulationMethods) )
        {
            return $this->_manipulationMethods($method, $parameters);
        }
        elseif( in_array($lowerMethod, $this->toolMethods) )
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
            $this->db->$method(...$parameters);

            return $this;
        }    
    }

    /**
     * protected build syntax
     * 
     * @param string $database
     * @param string $table
     * @param string $column
     * @param string $param
     * 
     * @return string
     */
    protected function _dbtablecolumn($database, $table, $column, $param)
    {
        if( $database !== NULL )
        {
            return $table . '.' . $column . '.' . $database . $param;
        }

        return $table . '.' . $column . $param;
    }

    /**
     * protected get row
     * 
     * @param string $table
     * @param string $column
     * @param array  $parameters
     * @param string $database
     * 
     * @return object
     */
    protected function _row($table, $column, $parameters, $database)
    {
        $this->relevance();

        return $this->db->where
        (
            $this->_dbtablecolumn($database, $table, $column, $parameters[1] ?? NULL), 
            $parameters[0] ?? NULL
        )
        ->get($this->_tableName())
        ->row();
    }

    /**
     * protected update
     * 
     * @param string $table
     * @param string $column
     * @param array  $parameters
     * @param string $database
     * 
     * @return bool
     */
    protected function _update($table, $column, $parameters, $database)
    {
        $this->relevance();

        return $this->db->where
        (
            $this->_dbtablecolumn($database, $table, $column, $parameters[2] ?? NULL), 
            $parameters[1] ?? NULL
        )
        ->update($this->_tableName(), $parameters[0]);
    }

    /**
     * protected delete
     * 
     * @param string $table
     * @param string $column
     * @param array  $parameters
     * @param string $database
     * 
     * @return bool
     */
    protected function _delete($table, $column, $parameters, $database)
    {
        $this->relevance();

        return $this->db->where
        (
            $this->_dbtablecolumn($database, $table, $column, $parameters[1] ?? NULL), 
            $parameters[0] ?? NULL
        )
        ->delete($this->_tableName());
    }

    /**
     * protected tool methods
     * 
     * @param string $method
     * @param array  $parameters
     * 
     * @return mixed
     */
    protected function _toolMethods($method, $parameters)
    {
        if( $method !== 'backup' )
        {
            $method = $method . 'Tables';
        }

        return $this->tool->$method($this->_tables(), ...$parameters);
    }

    /**
     * Drop tables
     * 
     * @param void
     * 
     * @return bool
     */
    public function drop($type = 'dropTable')
    {
        $tables = $this->_tables();

        foreach( $tables as $table )
        {
            $this->forge->$type($table);
        }

        return true;
    }

    /**
    * Truncate tables
    * 
    * @param void
    * 
    * @return bool
    */
    public function truncate()
    {
        return $this->drop(__FUNCTION__);
    }

    /**
     * Get pagination
     * 
     * @param string $url      = NULL
     * @param array  $settings = []
     * @param bool   $output   = true
     * 
     * @param mixed
     */
    public function pagination(String $url = NULL, Array $settings = [], Bool $output = true)
    {
        return $this->get->pagination($url, $settings, $output);
    }

    /**
     * protected get tables
     * 
     * @param void
     * 
     * @return array
     */
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

    /**
     * protected result methods
     * 
     * @param string $method
     * @param array  $parameters
     * 
     * @return mixed
     */
    protected function _resultMethods($method, $parameters)
    {
        $this->relevance();

        $this->get = $this->db->get($this->_tableName());
        
        return $this->get->$method(...$parameters);
    }

    /**
     * protected manipulation methods
     * 
     * @param string $method
     * @param array  $parameters
     * 
     * @return mixed
     */
    protected function _manipulationMethods($method, $parameters)
    {
        $this->relevance();
        
        return $this->db->$method($this->_tableName(), ...$parameters);
    }

    /**
     * protected relevance 
     * 
     * Stores table joins.
     * 
     * @param void
     * 
     * @return void
     */ 
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

            $this->db->join($this->_texplode($value, -1), str_replace(':', '=', $value), $type);
        }
    }

    /**
     * protected select
     * 
     * @param string $table
     * 
     * @return string
     */
    protected function _select($table)
    {
        $columns = $this->db->get($table)->columns();

        $select  = array_map(function($data) use($table)
        {
            return Base::prefix($data, $table . '.' . $data . ' as ' . $table . '_');
        }, $columns);

        return implode(', ', $select);
    }

    /**
     * protected select columns prefix
     * 
     * @param void
     * 
     * @return void
     */
    protected function _selectColumnsPrefix()
    {
        $select = NULL;

        foreach( $this->_tables() as $table )
        {
            $select .= $this->_select($table) . ', ';
        }

        $this->db->select(rtrim($select, ', '));
    }

    /**
     * protected get table name
     * 
     * @param void
     * 
     * @return string
     */
    protected function _tableName()
    {
        return $this->_texplode($this->_current(), 0);
    }

    /**
     * protected texplode
     * 
     * @param string $value
     * @param int    $index = 0
     * 
     * @return string
     */
    protected function _texplode($value, $index = 0)
    {
        $ex = explode('.', Datatype::divide($value, ':', $index));

        return count($ex) === 3 ? $ex[0].$ex[1] : $ex[0];
    }

    /**
     * protected current
     * 
     * @param void
     * 
     * @return string
     */
    protected function _current()
    {
        return ! is_numeric($key = key($this->relevance)) ? $key : current($this->relevance);;
    }
}
