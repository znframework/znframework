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

class SQLServerForge extends DriverForge
{
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
        return 'ALTER TABLE '.$table.' RENAME COLUMN '.key($column).' TO '.current($column).';';
    }
}