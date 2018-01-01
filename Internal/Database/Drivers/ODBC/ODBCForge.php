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

class ODBCForge extends DriverForge
{
    //--------------------------------------------------------------------------------------------------------
    // Truncate
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    //
    //--------------------------------------------------------------------------------------------------------
    public function truncate($table)
    { 
        return 'DELETE FROM '.$table; 
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
        return 'ALTER TABLE '.$table.' RENAME COLUMN  '.rtrim($column, ',').';';
    }
}