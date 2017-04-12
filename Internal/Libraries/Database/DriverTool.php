<?php namespace ZN\Database;

use File, Folder;
use ZN\FileSystem\Exception\IOException;

class DriverTool extends DriverExtends
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
        $result = $this->differentConnection->query('SHOW DATABASES')->result();

        if( $this->differentConnection->error() )
        {
            return [];
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
        $result = $this->differentConnection->query('SHOW TABLES')->result();

        if( $this->differentConnection->error() )
        {
            return [];
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
        $infos = new \stdClass;

        if( $table === '*' )
        {
            $listTables = $this->listTables();

            foreach( $listTables as $table )
            {
                $infos->$table = $this->differentConnection->status($table)->row();
            }
        }
        elseif( is_array($table) )
        {
            foreach( $table as $tbl )
            {
                $infos->$tbl = $this->differentConnection->status($tbl)->row();
            }
        }
        else
        {
            $infos = $this->differentConnection->status($table)->row();
        }

        return $infos;
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
        $result = $this->differentConnection->query("SHOW TABLES")->result();

        if( $table === '*' )
        {
            foreach( $result as $tables )
            {
                foreach( $tables as $db => $tableName )
                {
                    $this->differentConnection->query("OPTIMIZE TABLE ".$tableName);
                }
            }

            if( $this->differentConnection->error() )
            {
                return false;
            }
        }
        else
        {
            $tables = is_array($table)
                    ? $table
                    : explode(',',$table);

            foreach( $tables as $tableName )
            {
                $this->differentConnection->query("OPTIMIZE TABLE ".Properties::$prefix.$tableName);
            }

            if( $this->differentConnection->error() )
            {
                return false;
            }
        }

        return lang('Database', 'optimizeTablesSuccess');
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
    public function repairTables($table)
    {
        $result = $this->differentConnection->query("SHOW TABLES")->result();

        if( $table === '*' )
        {
            foreach( $result as $tables )
            {
                foreach( $tables as $db => $tableName )
                {
                    $this->differentConnection->query("REPAIR TABLE ".$tableName);
                }
            }

            if( $this->differentConnection->error() )
            {
                return false;
            }
        }
        else
        {
            $tables = is_array($table)
                    ? $table
                    : explode(',',$table);

            foreach( $tables as $tableName )
            {
                $this->differentConnection->query("REPAIR TABLE  ".Properties::$prefix.$tableName);
            }

            if( $this->differentConnection->error() )
            {
                return false;
            }
        }

        return lang('Database', 'repairTablesSuccess');
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
        if( $path === STORAGE_DIR )
        {
            $path .= 'DatabaseBackup';
        }

        $eol = EOL;

        if( $tables === '*' )
        {
            $tables = [];

            $resultArray = $this->differentConnection->query('SHOW TABLES')->resultArray();

            foreach( $resultArray as $key => $val )
            {
                $tables[] = current($val);
            }
        }
        else
        {
            $tables = ( is_array($tables) )
                      ? $tables
                      : explode(',',$tables);
        }

        $return = NULL;

        foreach( $tables as $table )
        {
            if( ! empty(Properties::$prefix) && ! strstr($table, Properties::$prefix) )
            {
                $table = Properties::$prefix.$table;
            }

            $return .= 'DROP TABLE IF EXISTS '.$table.';';

            $fetchRow = $this->differentConnection->query('SHOW CREATE TABLE '.$table)->fetchRow();

            $fetchResult = \DB::differentConnection($this->settings)->query('SELECT * FROM '.$table)->result();

            $return .= $eol.$eol.$fetchRow[1].";".$eol.$eol;

            if( ! empty($fetchResult) ) foreach( $fetchResult as $row )
            {
                $return.= 'INSERT INTO '.$table.' VALUES(';

                foreach( $row as $k => $v )
                {
                    $v  = $this->differentConnection->realEscapeString((string) $v);
                    $v  = preg_replace("/\n/","\\n", $v );

                    if ( isset($v) )
                    {
                        $return.= '"'.$v .'", ' ;
                    }
                    else
                    {
                        $return.= '"", ';
                    }
                }

                $return = rtrim(trim($return), ', ');

                $return .= ");".$eol;
            }

            $return .= $eol.$eol.$eol;
        }

        if( empty($fileName) )
        {
            $fileName = 'db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql';
        }

        if( ! Folder::exists($path) )
        {
            Folder::create($path);
        }

        if( ! File::write(suffix($path).$fileName, $return) )
        {
            throw new IOException('Error', 'fileNotWrite', $path.$fileName);
        }

        return lang('Database', 'backupTablesSuccess');
    }
}
