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

use ZN\Config;
use ZN\Filesystem;

class GrandVision extends DatabaseDefinitions
{   
    /**
     * Vision Directory
     * 
     * @var string
     */
    protected $visionDirectory = 'Visions/';

    /**
     * Magic Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->defaultDatabaseName = Config::get('Database', 'database')['database'];
    }

    /**
     * Generate Grand Vision
     * 
     * @param mixed ...$database
     */
    public function generate(...$database)
    {
        $databases = $database;

        if( is_array(($database[0] ?? NULL)) )
        {
            $databases = $database[0];
        }

        if( empty($database) )
        {
            $databases = $this->tool->listDatabases();
        }

        $visionPath = $this->visionDirectory;
        $defaultDB  = $this->defaultDatabaseName;

        foreach( $databases as $connection => $database )
        {
            $configs = [];

            if( is_array($database) )
            {
                $configs  = $database;
                $database = $connection;
            }

            $configs['database'] = $database;

            $tables   = $this->tool->differentConnection(['database' => $database])->listTables();
            $database = ucfirst($database);
            $filePath = $visionPath.$database;

            Filesystem::createFolder(MODELS_DIR.$filePath);

            foreach( $tables as $table )
            {
                $table = ucfirst($table);

                $name = INTERNAL_ACCESS.
                        ( strtolower($database) === strtolower($defaultDB) ? NULL : $database ).
                        $table . 'Vision';

                (new File)->object
                (
                    'model', 
                    $name,
                    [
                        'path'      => $filePath,
                        'namespace' => 'Visions\\'.$database,
                        'use'       => ['GrandModel'],
                        'extends'   => 'GrandModel',
                        'constants' =>
                        [
                            'table'      => "'".$table."'",
                            'connection' => $this->stringArray($configs)
                        ]
                    ]
                );
            }
        }
    }

    /**
     * Delete Grand Vision
     * 
     * @param string $databaes = '*'
     * @param array  $tables   = NULL
     */
    public function delete(String $database = '*', Array $tables = NULL)
    {
        $path = MODELS_DIR . $this->visionDirectory;

        if( $database === '*' )
        {
            Filesystem::deleteFolder($path);
        }
        else
        {
            $database = ucfirst($database);

            if( $tables === NULL )
            {
                Filesystem::deleteFolder($path.$database);
            }
            else
            {
                foreach( $tables as $table )
                {
                    unlink
                    (
                        $path.$database.DS.INTERNAL_ACCESS.
                        ( strtolower($database) === strtolower($this->defaultDatabaseName) ? NULL : $database ).
                        ucfirst($table).'Vision.php'
                    );
                }
            }
        }
    }

    /**
     * Protected String Array
     * 
     * @param array $data
     * 
     * @return string
     */
    protected function stringArray(Array $data)
    {
        $str = EOL.HT.'['.EOL;
        foreach( $data as $key => $val )
        {
            $str .= HT.HT."'".$key."' => '".$val."',".EOL;
        }
        $str = rtrim($str, ','.EOL);
        $str .= EOL.HT.']';

        return $str;
    }
}
