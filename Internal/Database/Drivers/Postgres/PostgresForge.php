<?php namespace ZN\Database\Drivers;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Database\DriverForge;

class PostgresForge extends DriverForge
{
    //--------------------------------------------------------------------------------------------------------
    // Modify Column
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param mixed  $column
    //
    //--------------------------------------------------------------------------------------------------------
    public function modifyColumn($table, $column)
    {
        return 'ALTER TABLE '.$table.' ALTER COLUMN ' . $this->_syntax($column, 'TYPE') . ';';
    }

    //--------------------------------------------------------------------------------------------------------
    // Rename Column
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param mixed  $column
    //
    //--------------------------------------------------------------------------------------------------------
    public function renameColumn($table, $column)
    { 
        return 'ALTER TABLE '.$table.' RENAME COLUMN ' . $this->_syntax($column, 'TO') . ';';
    }

    //--------------------------------------------------------------------------------------------------------
    // Add Column
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param mixed  $column
    //
    //--------------------------------------------------------------------------------------------------------
    public function addColumn($table, $columns)
    {
        return 'ALTER TABLE ' . $table . ' ADD ' . $this->_extractColumn($columns) . ';';
    }
}