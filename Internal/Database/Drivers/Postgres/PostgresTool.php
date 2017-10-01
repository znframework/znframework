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
    public function listDatabases($query = 'SELECT datname FROM pg_database')
    {
        return $this->_list($query);
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
    public function listTables($query = "SELECT table_name FROM information_schema.tables WHERE table_schema = 'public'")
    {
        return $this->_list($query);
    }

    //--------------------------------------------------------------------------------------------------------
    // statusTables
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  mixed $table: '*', 'oneTable' or ['tbl1', 'tbl2']
    // @return stdClass
    //
    //--------------------------------------------------------------------------------------------------------
    public function statusTables($table)
    {
        return false;
    }

    //--------------------------------------------------------------------------------------------------------
    // Optimize Tables
    //--------------------------------------------------------------------------------------------------------
    //
    // Bağlı olduğunuz veritabanına ait tabloları optimize eder.
    //
    // @param  mixed $table: '*', 'tbl1, tbl2' ya da array('tbl1', 'tbl2')
    // @return string message
    //
    //--------------------------------------------------------------------------------------------------------
    public function optimizeTables($table)
    {
        return false;
    }

    //--------------------------------------------------------------------------------------------------------
    // Repair Tables
    //--------------------------------------------------------------------------------------------------------
    //
    // Bağlı olduğunuz veritabanına ait tabloları onarır.
    //
    // @param  mixed $table: '*', 'tbl1, tbl2' ya da array('tbl1', 'tbl2')
    // @return string message
    //
    //--------------------------------------------------------------------------------------------------------
    public function repairTables($table, $query = '', $message = '')
    {
        return false;
    }

    //--------------------------------------------------------------------------------------------------------
    // Backup
    //--------------------------------------------------------------------------------------------------------
    //
    // Bağlı olduğunuz veritabanına ait tablolarınızın yedeğini alır.
    // Yedek dosyası içerisinde tablo oluşturma veriler ve kayıtlar yer alır.
    //
    // @param  mixed  $table: '*', 'tbl1, tbl2' ya da array('tbl1', 'tbl2')
    // @param  string $filename
    // @return string $path: STORAGE_DIR
    //
    //--------------------------------------------------------------------------------------------------------
    public function backup($tables, $fileName, $path)
    {
        return false;
    }
}
