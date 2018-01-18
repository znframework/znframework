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

abstract class DriverMappingAbstract
{
    /**
     * Variables
     * 
     * @var mixed
     */
    protected $config, $connect, $query;

    /**
     * Abstract Methods
     */
    abstract public function connect($config);
    abstract public function exec($query, $security);
    abstract public function query($query, $security);

    /**
     * Standart Methods
     */
    public function multiQuery($query, $security){}
    public function transStart(){}
    public function transRollback(){}
    public function transCommit(){}
    public function insertID(){}
    public function columnData($column){}
    public function numRows(){}
    public function columns(){}
    public function numFields(){}
    public function realEscapeString($data){}
    public function error(){}
    public function fetchArray(){}
    public function fetchAssoc(){}
    public function fetchRow(){}
    public function affectedRows(){}
    public function close(){}
    public function version(){}

    /**
     * Result
     * 
     * @param string $type = 'object'
     * 
     * @return object|array|string
     */
    public function result($type = 'object')
    {
        if( empty($this->query) )
        {
            return [];
        }

        $rows = [];

        while( $data = $this->fetchAssoc() )
        {
            if( $type === 'object' )
            {
                $data = (object) $data;
            }

            $rows[] = $data;
        }

        return $rows;
    }

    /**
     * Result Array 
     * 
     * @return array
     */
    public function resultArray()
    {
        return $this->result('array');
    }

    /**
     * Row
     * 
     * @return object|false
     */
    public function row()
    {
        if( ! empty($this->query) )
        {
            $data = $this->fetchAssoc();

            return (object) $data;
        }
        else
        {
            return false;
        }
    }

    /**
     * Vartypes
     * 
     * @return string
     */
    public function vartypes()
    {
        return $this->variableTypes;
    }

    /**
     * Cvartype
     * 
     * @param string $type   = NULL
     * @param int    $len    = NULL
     * @param bool   $output = true
     * 
     * @return string
     */
    private function cvartype($type = NULL, $len = NULL, $output = true)
    {
        if( empty($len) )
        {
            return " $type ";
        }
        elseif( $output === true )
        {
            return " $type($len) ";
        }
        else
        {
            return " $type $len ";
        }
    }

    /**
     * Operator
     * 
     * @param string $operator = 'like'
     * 
     * @return mixed
     */
    public function operator($operator = 'like')
    {
        $operator = strtolower($operator);

        return $this->operators[$operator] ?? false;
    }

    /**
     * Statements
     * 
     * @param string $state = NULL
     * @param int    $len   = NULL
     * @param bool   $type  = true
     * 
     * @return string|false
     */
    public function statements($state = NULL, $len = NULL, $type = true)
    {
        $state = strtolower($state);

        if( $isstate = ($this->statements[$state] ?? NULL) )
        {
            if( strstr($isstate, '%') )
            {
                $vartype = str_replace('%', $len, $isstate);

                return $this->cvartype($vartype);
            }

            return $this->cvartype($isstate, $len, $type);
        }
        else
        {
            return false;
        }
    }

    /**
     * Variable Types
     * 
     * @param string $vartype = NULL
     * @param int    $len     = NULL
     * @param bool   $type    = true
     * 
     * @return string|false
     */
    public function variableTypes($vartype = NULL, $len = NULL, $type = true)
    {
        $vartype = strtolower($vartype);

        return   ! empty( $isvartype = ($this->variableTypes[$vartype] ?? NULL) )
                 ? $this->cvartype($isvartype, $len, $type)
                 : false;
    }

    /**
     * Close Connection
     */
    public function closeConnection()
    {
        $this->query   = NULL;
        $this->connect = NULL;
    }
}
