<?php namespace ZN\Database;

class InternalDBTool extends Connection implements InternalDBToolInterface
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
    // Tool
    //--------------------------------------------------------------------------------------------------------
    //
    // @var object
    //
    //--------------------------------------------------------------------------------------------------------
    protected $tool;

    public function __construct()
    {
        parent::__construct();

        $this->tool = $this->_drvlib('Tool');
    }

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
    public function listDatabases() : Array
    {
        return $this->tool->listDatabases();
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
    public function listTables() : Array
    {
        return $this->tool->listTables();
    }

    //--------------------------------------------------------------------------------------------------------
    // statusTables
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  mixed $table: '*', 'oneTable' or ['tbl1', 'tbl2']
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    public function statusTables($table = '*') : \stdClass
    {
        return $this->tool->statusTables($table);
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
    public function optimizeTables($table = '*') : String
    {
        return $this->tool->optimizeTables($table);
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
    public function repairTables($table = '*') : String
    {
        return $this->tool->repairTables($table);
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
    public function backup($tables = '*', String $fileName = NULL, String $path = STORAGE_DIR) : String
    {
        return $this->tool->backup($tables, $fileName, $path);
    }
}
