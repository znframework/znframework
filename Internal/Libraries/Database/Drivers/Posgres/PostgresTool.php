<?php namespace ZN\Database\Drivers;

use ZN\Database\DriverTool;

class PostgresTool extends DriverTool
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
    // List Databases
    //--------------------------------------------------------------------------------------------------------
    //
    // Hostunuda yer var olan veritabanlarını listeler.
    //
    // @param  void
    // @return array
    //
    //--------------------------------------------------------------------------------------------------------
    public function listDatabases()
    {
        $result = \DB::query('SELECT datname FROM pg_database')->result();
        
        if( \DB::error() ) 
        {
            return false;
        }
        
        $newDatabases = [];
        
        foreach( $result as $databases )
        {
            foreach( $databases as $db => $database )
            {
                $newDatabases[] = $database;
            }
        }
        
        return $newDatabases;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // List Tables
    //--------------------------------------------------------------------------------------------------------
    //
    // Bağlı olduğunuz veritabanına ait tabloları listeler.
    //
    // @param  void
    // @return array
    //
    //--------------------------------------------------------------------------------------------------------
    public function listTables()
    {
        $result = \DB::query("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public'")->result();
        
        if( \DB::error() ) 
        {
            return false;
        }
        
        $newTables = [];
        
        foreach( $result as $tables )
        {
            foreach( $tables as $tb => $table )
            {
                $newTables[] = $table;
            }
        }
        
        return $newTables;
    }
}