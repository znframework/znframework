<?php namespace ZN\Database\Drivers;

use ZN\Database\DriverForge;

class OracleForge extends DriverForge
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

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