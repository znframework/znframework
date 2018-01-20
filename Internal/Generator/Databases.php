<?php namespace ZN\Generator;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Base;
use ZN\Config;
use ZN\Filesystem;
use ZN\DataTypes\Arrays;

class Databases extends DatabaseDefinitions
{   
    /**
     * Actives Path
     * 
     * @var string
     */
    protected $activesPath  = DATABASES_DIR . 'Actives/';

    /**
     * Archives Path
     * 
     * @var string
     */
    protected $archivesPath = DATABASES_DIR . 'Archives/';

    /**
     * Process databases
     */
    public function generate()
    {
        $this->active(); $this->archive();
    }

    /**
     * Protected Actives Databases
     */
    protected function active()
    {
        $activesPath  = $this->activesPath;
        $archivesPath = $this->archivesPath;
        $folders      = Filesystem::getFiles($activesPath, 'dir');

        if( empty($folders) )
        {
            return false;
        }

        $currentDriver = Config::get('Database', 'database')['driver'];

        if( stristr('pdo:mysql|mysqli', $currentDriver) )
        {
            $encoding = $this->db->encoding();
        }
        else
        {
            $encoding = NULL;
        }

        $status = false;
        $tableKeyColumnValues = [$this->db->varchar(1), $this->db->null()];

        foreach( $folders as $database )
        {
            $this->forge->createDatabase($database, $encoding);

            $databasePath = $activesPath . $database . '/';

            $tables = Filesystem::getFiles($databasePath, 'php');

            if( ! empty($tables) )
            {
                $dbForge = $this->forge->differentConnection(['database' => $database]);
                $db      = $this->db->differentConnection(['database' => $database]);

                foreach( $tables as $table )
                {
                    $tableData = Base::import($databasePath . $table);
                    $file      = $table;
                    $table     = Filesystem::removeExtension($table);

                    if( ! array_key_exists('id', $tableData) )
                    {
                        $tableData = array_merge
                        ([
                            'id' => [$this->db->int(11), $this->db->notNull(), $this->db->autoIncrement(), $this->db->primaryKey()]
                        ], $tableData);                        
                    }

                    $tableColumns    = $db->get($table)->columns();
                    $pregGrepArray   = preg_grep('/_000/', $tableColumns);
                    $currentTableKey = strtolower(current($pregGrepArray));
                    $currentColumns  = Arrays\RemoveElement::element($tableColumns, $pregGrepArray);
                    $tableKey        = strtolower($table.'_000' . md5(json_encode($tableData)));

                    if( ! empty($currentColumns) )
                    {
                        $columnsMerge = array_merge(array_flip($currentColumns), $tableData);

                        foreach( $columnsMerge as $key => $val )
                        {
                            if( is_numeric($val) )
                            {
                                $dbForge->dropColumn($table, $key);
                                $status = true;
                            }
                            elseif( in_array($key, $currentColumns) )
                            {
                                if( $currentTableKey !== $tableKey )
                                {
                                    $dbForge->modifyColumn($table, [$key => $val]);
                                    $status = true;
                                }
                                else
                                {
                                    $status = false;
                                }
                            }
                            else
                            {
                                $dbForge->addColumn($table, [$key => $val]);
                                $status = true;
                            }
                        }

                        if( $status === true )
                        {
                            $tableName     = $database . '/' . $table;
                            $dbArchivePath = $archivesPath . $database . '/';
                            $writePath     = $archivesPath . $tableName . '_' . time() . '.php';
                            $writeContent  = file_get_contents($activesPath . $tableName . '.php');

                            Filesystem::createFolder($dbArchivePath);

                            file_put_contents($writePath, $writeContent);

                            $dbForge->renameColumn($table, [$currentTableKey.' '.$tableKey => $tableKeyColumnValues]);
                        }
                    }
                    else
                    {
                        $tableData[$tableKey] = $tableKeyColumnValues;

                        $dbForge->createTable($table, $tableData);
                    }
                }
            }
        }
    }

    /**
     * Protected Archives Database
     */
    protected function archive()
    {
        $archivesPath = $this->archivesPath;

        $folders = Filesystem::getFiles($archivesPath, 'dir');

        if( empty($folders) )
        {
            return false;
        }

        foreach( $folders as $database )
        {
            $databasePath = $archivesPath . $database . '/';

            $tables   = Filesystem::getFiles($databasePath, 'php');
            $pregGrep = preg_grep("/\_[0-9]*\.php/", $tables);
            $tables   = Arrays\RemoveElement::element($tables, $pregGrep);

            if( ! empty($tables) )
            {
                $dbForge  = $this->forge->differentConnection(['database' => $database]);

                foreach( $tables as $table )
                {
                    $dbForge->dropTable(Filesystem::removeExtension($table));
                }
            }

            $tool = $this->tool->differentConnection(['database' => $database]);

            if( empty($tool->listTables()) )
            {
                $this->forge->dropDatabase($database);
            }
        }
    }
}
