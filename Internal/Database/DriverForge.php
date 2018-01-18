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

class DriverForge
{
    /**
     * Create Database
     * 
     * @param string $dbname
     * @param string $extras
     * 
     * @return string
     */
    public function createDatabase($dbname, $extras)
    {
        return 'CREATE DATABASE ' . $dbname . $this->_extras($extras);
    }

    /**
     * Drop Database
     * 
     * @param string $dbname
     * 
     * @return string
     */
    public function dropDatabase($dbname)
    {
        return 'DROP DATABASE ' . $dbname;
    }

    /**
     * Create Table
     * 
     * @param string $tabşe
     * @param array  $columns
     * @param string $extras
     * 
     * @return string
     */
    public function createTable($table, $columns, $extras)
    {
        $column = '';

        foreach( $columns as $key => $value )
        {
            $values = '';

            if( is_array($value) ) foreach( $value as $val )
            {
                $values .= ' ' . $val;
            }
            else
            {
                $values = $value;
            }

            $column .= $key . ' ' . $values . ',';
        }

        return 'CREATE TABLE ' . $table . '(' .rtrim(trim($column), ',') . ')' . $this->_extras($extras);
    }

    /**
     * Drop Table
     * 
     * @param string $table
     * 
     * @return string
     */
    public function dropTable($table)
    {
        return 'DROP TABLE ' . $table;
    }

    /**
     * Alter Table
     * 
     * @param string $table
     * @param mixed  $condition
     */
    public function alterTable($table, $condition){}

    /**
     * Rename Table
     * 
     * @param string $name
     * @param string $newname
     * 
     * @return string
     */
    public function renameTable($name, $newName)
    {
        return 'ALTER TABLE ' . $name . ' RENAME TO ' . $newName;
    }

    /**
     * Truncate
     * 
     * @param string $table
     * 
     * @return string
     */
    public function truncate($table)
    {
        return 'TRUNCATE TABLE ' . $table;
    }

    /**
     * Add Column
     * 
     * @param string $table
     * @param array  $columns
     * 
     * @return string
     */
    public function addColumn($table, $columns)
    {
        return 'ALTER TABLE ' . $table . ' ADD (' . $this->_extractColumn($columns) . ');';
    }

    /**
     * Drop Column
     * 
     * @param string $table
     * @param array  $columns
     * 
     * @return string
     */
    public function dropColumn($table, $column)
    {
        return 'ALTER TABLE ' . $table . ' DROP ' . $column . ';';
    }

    /**
     * MOdify Column
     * 
     * @param string $table
     * @param array  $columns
     * 
     * @return string
     */
    public function modifyColumn($table, $columns)
    {
        return 'ALTER TABLE ' . $table . ' MODIFY ' . $this->_extractColumn($columns) . ';';
    }

    /**
     * Rename Column
     * 
     * @param string $table
     * @param array  $columns
     * 
     * @return string
     */
    public function renameColumn($table, $columns)
    {
        return 'ALTER TABLE ' . $table . ' CHANGE COLUMN ' . $this->_extractColumn($columns) . ';';
    }

    /**
     * protected Syntax
     */
    protected function _syntax($column, $sep = NULL)
    {
        return key($column) . ' ' . $sep . ' ' . (is_array($cols = current($column)) ? implode(' ', $cols) : $cols);
    }

    /**
     * Protected Extract Column
     */
    protected function _extractColumn($columns)
    {
        $con = NULL;

        foreach( $columns as $column => $values )
        {
            $colvals = '';

            if( is_array($values) )
            {
                foreach( $values as $val )
                {
                    $colvals .= ' ' . $val;
                }
            }
            else
            {
                $colvals .= ' ' . $values;
            }

            $con .= $column . $colvals . ',';
        }

        return rtrim($con, ',');
    }

    /**
     * Protected Extras
     */
    protected function _extras($extras)
    {
        if( is_array($extras) )
        {
            $extraCodes = ' ' . implode(' ', $extras) . ';';
        }
        elseif( is_string($extras) )
        {
            $extraCodes = ' ' . $extras . ';';
        }
        else
        {
            $extraCodes = '';
        }

        return $extraCodes;
    }
}
