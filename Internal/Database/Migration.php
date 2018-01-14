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

use ZN\Config;
use ZN\Singleton;
use ZN\Filesystem;

class Migration implements MigrationInterface
{
    /**
     * Migrations path Models/Migrations/
     * 
     * @var string
     */
    private $path = MODELS_DIR . 'Migrations/';

    /**
     * Keeps database config
     * 
     * @var array
     */
    private $config;

    /**
     * Keeps class fix
     * 
     * @var string
     */
    private $classFix = INTERNAL_ACCESS . 'Migrate';

    /**
     * Keeps migration table
     * 
     * @var string
     */
    private $tbl;

    /**
     * Keeps version directory path
     * 
     * @var string
     */
    private $versionDir = 'Version/';

    /**
     * Magic constructor
     * 
     * @param void
     * 
     * @return void
     */
    public function __construct()
    {
        $this->config = Config::get('Database');

        if( ! is_dir($this->path) )
        {
            mkdir($this->path, 0755);
        }

        $this->db    = new DB;
        $this->forge = new DBForge;

        $this->tbl = defined('static::table') ? static::table : false;

        $this->_create();
    }

    /**
     * Up all migrations
     * 
     * @param string ...$migrations
     * 
     * @return bool
     */
    public function upAll(String ...$migrations) : Bool
    {
        $this->_up('up', $migrations);

        return true;
    }

    /**
     * Down all migrations
     * 
     * @param string ...$migrations
     * 
     * @return bool
     */
    public function downAll(String ...$migrations) : Bool
    {
        $this->_up('down', $migrations);

        return true;
    }
    
    /**
     * Create table
     * 
     * @param array $data
     * 
     * @return bool
     */
    public function createTable(Array $data) : Bool
    {
        $this->forge->createTable($this->_tableName(), $data);

        return $this->_action(__FUNCTION__);
    }

    /**
     * Drop table
     * 
     * @param void
     * 
     * @return bool
     */
    public function dropTable() : Bool
    {
        $this->forge->dropTable($this->_tableName());

        return $this->_action(__FUNCTION__);
    }

    /**
     * Add column
     * 
     * @param array $column
     * 
     * @return bool
     */
    public function addColumn(Array $column) : Bool
    {
        $this->forge->addColumn($this->_tableName(), $column);

        return $this->_action(__FUNCTION__);
    }

    /**
     * Drop column
     * 
     * @param mixed $column
     * 
     * @return bool
     */
    public function dropColumn($column) : Bool
    {
        $this->forge->dropColumn($this->_tableName(), $column);

        return $this->_action(__FUNCTION__);
    }

    /**
     * Modify column
     * 
     * @param array $column
     * 
     * @param bool
     */
    public function modifyColumn(Array $column) : Bool
    {
        $this->forge->modifyColumn($this->_tableName(), $column);

        return $this->_action(__FUNCTION__);
    }

    /**
     * Rename column
     * 
     * @param array $column
     * 
     * @return bool
     */
    public function renameColumn(Array $column) : Bool
    {
        $this->forge->renameColumn($this->_tableName(), $column);

        return $this->_action(__FUNCTION__);
    }

    /**
     * Truncate table
     * 
     * @param void
     * 
     * @return bool
     */
    public function truncate() : Bool
    {
        $this->forge->truncate($this->_tableName());

        return $this->_action(__FUNCTION__);
    }

    /**
     * Sets migration path
     * 
     * @param string $path = NULL
     * 
     * @return Migration
     */
    public function path(String $path = NULL) : Migration
    {
        $this->path = suffix($path);

        return $this;
    }

    /**
     * Create migration
     * 
     * @param string $name
     * @param int    $version = 0
     * 
     * @return bool
     */
    public function create(String $name, Int $ver = 0) : Bool
    {
        if( $version = $this->_version($ver) )
        {
            $dir  = $this->path.$name.$this->versionDir;

            if( ! is_dir($dir) )
            {
                mkdir($dir);
            }

            $file = $dir.suffix($version, '.php');
            $name = $name.$version;
        }
        else
        {
            $file = $this->path.suffix($name, '.php');
        }

        if( ! is_file($file) )
        {
            return $this->createMigrateFile($name, $file);
        }
        else
        {
            return false;
        }
    }

    /**
     * Delete migration
     * 
     * @param string $name
     * @param int    $version = 0
     * 
     * @return bool
     */
    public function delete(String $name, Int $ver = 0) : Bool
    {
        if( $version = $this->_version($ver) )
        {
            $dir  = $this->path.$name.$this->versionDir;
            $file = $dir.suffix($version, '.php');

            if( $ver === 'all' && is_dir($this->path.$name.$this->versionDir) )
            {
                Filesystem\Forge::deleteFolder($this->path.$name.$this->versionDir);
            }
        }
        else
        {
            $file = $this->path.suffix($name, '.php');
        }

        return unlink($file);
    }

    /**
     * Delete all migrations
     * 
     * @param void
     * 
     * @return bool
     */
    public function deleteAll() : Bool
    {
        if( is_dir($this->path) )
        {
            return Filesystem\Forge::deleteFolder($this->path);
        }
        else
        {
            return false;
        }
    }

    /**
     * Selects migration version
     * 
     * @param int $version = 0
     * 
     * @return object
     */
    public function version(Int $version = 0)
    {
        if( empty($this->tbl) )
        {
            return false;
        }

        $name = $this->classFix.$this->_tableName();

        if( $version <= 0 )
        {
            return Singleton::class($name);
        }

        $name .= $this->_version($version);

        return Singleton::class($name);
    }

    /**
     * protected action
     * 
     * @param string $type
     * 
     * @return mixed
     */
    protected function _action($type)
    {
        if( $type === '' )
        {
            $type = 'noAction';
        }

        $table   = $this->_tableName();
        $version = $this->_getVersion();

        if( ! $this->forge->error() )
        {
            return $this->db->insert($this->config['migration']['table'],
            [
                'name'    => $table,
                'type'    => $type,
                'version' => $version,
                'date'    => date('Ymdhis')
            ]);
        }

        return false;
    }

    /**
     * protected create
     * 
     * @param void
     * 
     * @return void
     */
    protected function _create()
    {
        $table   = $this->config['database']['prefix'] . $this->config['migration']['table'];
     
        $this->forge->createTable('IF NOT EXISTS '.$table, array
        (
            'name'    => [$this->db->varchar(512), $this->db->notNull()],
            'type'    => [$this->db->varchar(256), $this->db->notNull()],
            'version' => [$this->db->varchar(3),   $this->db->notNull()],
            'date'    => [$this->db->varchar(15),  $this->db->notNull()]
        ));
    }

    /**
     * Get table name
     * 
     * @param void
     * 
     * @return string
     */
    protected function _tableName()
    {
        $table = preg_replace('/[0-9][0-9][0-9]/', '', $this->tbl);

        return str_replace($this->classFix, '', $table);
    }

    /**
     * Get version
     * 
     * @param void
     * 
     * @return string
     */
    protected function _getVersion()
    {
        preg_match('(\w+([0-9][0-9][0-9]))', $this->tbl, $match);

        return $match[1] ?? '000';
    }

    /**
     * Converts migration version
     * 
     * @param mixed $numeric
     * 
     * @return mixed
     */
    protected function _version($numeric)
    {
        $length = strlen((string)$numeric);

        if( (int)$numeric > 999 || (int)$numeric < 0 )
        {
            return false;
        }

        switch( $length )
        {
            case 1 : $numeric = '00'.$numeric; break;
            case 2 : $numeric = '0' .$numeric; break;
        }

        if( $numeric === '000' )
        {
            return false;
        }

        return $numeric;
    }

    /**
     * protected migration up
     * 
     * @param string $type
     * @param array $migrations
     * 
     * @return void
     */
    protected function _up($type, $migrations)
    {
        foreach( $migrations as $migration )
        {
            $migration = prefix($migration, 'Migrate');
        
            $migration::$type();
        }
    }

    /**
     * protected create migrate file
     * 
     * @param string $name
     * @param string $file
     * 
     * @return bool
     */
    protected function createMigrateFile(String $name, String $file) : Bool
    {
        $eol  = EOL;
        $str  = '<?php'.$eol;
        $str .= 'class '.$this->classFix.$name.' extends '.__CLASS__.$eol;
        $str .= '{'.$eol;
        $str .= "\t".'//--------------------------------------------------------------------------------------------------------'.$eol;
        $str .= "\t".'// Class/Table Name'.$eol;
        $str .= "\t".'//--------------------------------------------------------------------------------------------------------'.$eol;
        $str .= "\t".'const table = __CLASS__;'.$eol.$eol;
        $str .= "\t".'//--------------------------------------------------------------------------------------------------------'.$eol;
        $str .= "\t".'// Up'.$eol;
        $str .= "\t".'//--------------------------------------------------------------------------------------------------------'.$eol;
        $str .= "\t".'public function up()'.$eol;
        $str .= "\t".'{'.$eol;
        $str .= "\t\t".'// Default Query'.$eol;
        $str .= "\t\t".'return $this->createTable([\'id\' => [$this->db->int(11), $this->db->primaryKey(), $this->db->autoIncrement()]]);'.$eol;
        $str .= "\t".'}'.$eol.$eol;
        $str .= "\t".'//--------------------------------------------------------------------------------------------------------'.$eol;
        $str .= "\t".'// Down'.$eol;
        $str .= "\t".'//--------------------------------------------------------------------------------------------------------'.$eol;
        $str .= "\t".'public function down()'.$eol;
        $str .= "\t".'{'.$eol;
        $str .= "\t\t".'// Default Query'.$eol;
        $str .= "\t\t".'return $this->dropTable();'.$eol;
        $str .= "\t".'}'.$eol;
        $str .= '}';

        return file_put_contents($file, $str);
    }
}
