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

use stdClass;
use ZN\IndividualStructures\Lang;
use ZN\FileSystem\Exception\IOException;
use ZN\FileSystem\Folder;

class DriverTool extends DriverExtends
{
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
    public function listDatabases($query = 'SHOW DATABASES')
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
    public function listTables($query = 'SHOW TABLES')
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
    protected function _list($query)
    {
        $result = $this->differentConnection->query($query)->result();

        if( empty($result) )
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
        $infos = new stdClass;

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
        return $this->repairTables($table, 'OPTIMIZE TABLE', 'optimizeTablesSuccess');
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
    public function repairTables($table, $query = 'REPAIR TABLE', $message = 'repairTablesSuccess')
    {
        $result = $this->differentConnection->query("SHOW TABLES")->result();
        $status = NULL;

        if( $table === '*' )
        {
            foreach( $result as $tables )
            {
                foreach( $tables as $db => $tableName )
                {
                    $status = $this->differentConnection->query($query . ' ' . $tableName);
                }
            }
        }
        else
        {
            $tables = is_array($table)
                    ? $table
                    : explode(',',$table);

            foreach( $tables as $tableName )
            {
                $status = $this->differentConnection->query($query . ' ' . Properties::$prefix . $tableName);
            }
        }

        if( $status !== NULL )
        {
            return Lang::select('Database', $message);
        }

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

            $fetchResult = $this->differentConnection->query('SELECT * FROM '.$table)->result();

            $return .= $eol.$eol.$fetchRow[1].";".$eol.$eol;

            if( ! empty($fetchResult) ) foreach( $fetchResult as $row )
            {
                $return.= 'INSERT INTO '.$table.' VALUES(';

                foreach( $row as $k => $v )
                {
                    $v = preg_replace("/\n/","\\n", $v );

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

        if( ! is_dir($path) )
        {
            mkdir($path);
        }

        if( ! file_put_contents(suffix($path).$fileName, $return) )
        {
            throw new IOException('Error', 'fileNotWrite', $path.$fileName);
        }

        return Lang::select('Database', 'backupTablesSuccess');
    }

    //--------------------------------------------------------------------------------------------------------
    // Import -> 5.3.9 - 5.4.1[edited]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function import(String $file)
    {
        if( is_file($file) )
        {   
            return $this->differentConnection->multiQuery(file_get_contents($file));
        }

        return false;
    }
}
