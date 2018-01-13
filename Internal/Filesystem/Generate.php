<?php namespace ZN\Filesystem;
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
use ZN\Request\Post;
use ZN\DataTypes\Strings;
use ZN\DataTypes\Arrays;
use ZN\ErrorHandling\Errors;
use ZN\Filesystem\Exception\InvalidTypeException;

class Generate implements GenerateInterface
{
    /**
     * Keeps Settings
     * 
     * @var array
     */
    protected $settings = [];

    /**
     * Generate Types
     * 
     * @var array
     */
    protected $types = 
    [
        'controller',
        'library',
        'command',
        'model'
    ];

    /**
     * Magic Call
     * 
     * @param string $method
     * @param array  $parameters
     * 
     * @return mixed
     */
    public function __call($method, $parameters)
    {  
        if( in_array($method, $this->types) )
        {
            $name = $parameters[0];

            return $this->_object($name, $method, $parameters[1] ?? []);
        }   
        
        throw new InvalidTypeException(NULL, implode(', ', $this->types)); 
    }

    /**
     * Magic Constructor
     */
    public function __construct()
    {
        $this->db    = Singleton::class('ZN\Database\DB');
        $this->tool  = Singleton::class('ZN\Database\DBTool');
        $this->forge = Singleton::class('ZN\Database\DBForge');    
    }

    /**
     * Select project name
     * 
     * @param string $name
     * 
     * @return bool
     */
    public function project($name)
    {
        Post::project($name);

        $validation = Singleton::class('ZN\ViewObjects\Validation');

        $validation->rules('project', ['alpha'], 'Project Name');

        if( ! $error = $validation->error('string') )
        {
            $source = EXTERNAL_FILES_DIR . 'DefaultProject.zip';
            $target = PROJECTS_DIR . Post::project();

            Forge::zipExtract($source, $target);

            return true;
        }

        return false;
    }

    /**
     * Process databases
     */
    public function databases()
    {
        $this->_addDatabases();
        $this->_archivesDatabases();
    }

    /**
     * Grand Vision
     * 
     * @param mixed ...$database
     */
    public function grandVision(...$database)
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

        $visionPath = 'Visions/';
        $defaultDB  = Config::get('Database', 'database')['database'];

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

            Forge::createFolder(MODELS_DIR.$filePath);

            foreach( $tables as $table )
            {
                $table = ucfirst($table);

                $this->model(INTERNAL_ACCESS.( strtolower($database) === strtolower($defaultDB) ? NULL : $database ).$table.'Vision',
                [
                    'path'      => $filePath,
                    'namespace' => 'Visions\\'.$database,
                    'use'       => ['GrandModel'],
                    'extends'   => 'GrandModel',
                    'constants' =>
                    [
                        'table'      => "'".$table."'",
                        'connection' => $this->_stringArray($configs)
                    ]
                ]);
            }
        }
    }

    /**
     * Delete Vision
     * 
     * @param string $database = '*'
     * @param array  $tables   = NULL
     */
    public function deleteVision(String $database = '*', Array $tables = NULL)
    {
        $path = MODELS_DIR.'Visions/';

        if( $database === '*' )
        {
            Forge::deleteFolder($path);
        }
        else
        {
            $database = ucfirst($database);

            if( $tables === NULL )
            {
                Forge::deleteFolder($path.$database);
            }
            else
            {
                $defaultDB = Config::get('Database', 'database')['database'];

                foreach( $tables as $table )
                {
                    unlink
                    (
                        $path.$database.'/'.INTERNAL_ACCESS.
                        ( strtolower($database) === strtolower($defaultDB) ? NULL : $database ).
                        ucfirst($table).'Vision.php'
                    );
                }
            }
        }
    }

    /**
     * Settings
     * 
     * @param array $settings
     * 
     * @return Generate
     */
    public function settings(Array $settings) : Generate
    {
        $this->settings = $settings;

        return $this;
    }

    /**
     * Delete Structure
     * 
     * @param string $name
     * @param string $type = 'controller'
     * @param string $app  = NULL
     * 
     * @return bool
     */
    public function delete(String $name, String $type = 'controller', String $app = NULL) : Bool
    {
        if( ! empty($app) )
        {
            $this->settings['application'] = $app;
        }

        $file = $this->_path($name, $type);

        if( is_file($file) )
        {
            return unlink($file);
        }

        return false;
    }

    /**
     * Protected String Array
     */
    protected function _stringArray($data)
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

    /**
     * Protected Object
     */
    protected function _object($name, $type, $settings)
    {
        if( ! empty($settings) )
        {
            $this->settings = $settings;
        }

        return $this->_contentWrite($name, $type);
    }

    /**
     * Protected Path
     */
    protected function _path($name, $type)
    {
        if( empty($this->settings['application']) )
        {
            $this->settings['application'] = Strings\Split::divide(rtrim(PROJECT_DIR, '/'), '/', -1);
        }

        return PROJECTS_DIR.$this->settings['application'].$this->_type($type).suffix($name, '.php');
    }

    /**
     * Protected Content Write
     */
    protected function _contentWrite($name, $type)
    {
        if( empty($name) )
        {
            $this->error = Errors::message('Error', 'emptyParameter', '1.(name)');
        }
        
        # Start Generate
        $controller = "<?php".EOL;

        # Object Data
        $this->settings['object'] = $this->settings['object'] ?? 'class';

        # Namespace Data
        $this->namespace($controller, $namespace);

        # Uses Data
        $this->uses($controller);

        # Class Name
        if( ! empty($this->settings['name']) )
        {
            $name = $this->settings['name'];
        }

        $controller .= $this->settings['object']." ".$name;

        # Extends Data
        $this->extends($controller);

        # Implements Data
        $this->implements($controller);

        # Start Body
        $controller .= EOL . "{" . EOL;

        # Traits Data
        $this->traits($controller);

        # Constants Data
        $this->constants($controller);

        # Vars Data
        $this->vars($controller);

        # Functions Data
        $this->functions($controller);

        # Finish Class
        $controller = rtrim($controller, EOL) . EOL . "}";

        # Alias Data
        $this->alias($controller, $namespace);
        
        # File Write
        return $this->write($name, $type, $controller);
    }

    /**
     * Protected Write
     * 
     * @param string $name
     * @param string $type
     * @param string $controller
     * 
     * @return bool
     */
    protected function write($name, $type, $controller) : Bool
    {
        if( ! empty($this->settings['path']) )
        {
            $filePath = suffix($this->settings['path'], '/') . $name;
        }
        else
        {
            $filePath = $name;
        }

        $file = $this->_path($filePath, $type);

        output($this->settings);

        if( ! is_file($file) )
        {
            if( file_put_contents($file, $controller) )
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    /**
     * Protected Functions
     * 
     * @param string & $controller
     * @param string   $namespace = NULL
     */
    protected function alias(String & $controller, String $namespace = NULL)
    {
        if( ! empty($this->settings['alias']) )
        {
            $controller .= EOL.EOL.'class_alias("'.suffix($namespace, '\\').$name.'", "'.$this->settings['alias'].'");';
        }
    }

    /**
     * Protected Functions
     * 
     * @param string & $controller
     */
    protected function functions(String & $controller)
    {
        $parameters = NULL;

        if( ! empty($this->settings['functions']) ) foreach( $this->settings['functions'] as $isKey => $function )
        {
            if( ! empty($function) )
            {
                if( ! is_numeric($isKey) )
                {
                    if( is_array($function) )
                    {
                        $subValue = '';

                        foreach( $function as $key => $val )
                        {
                            if( ! is_numeric($key) )
                            {
                                $subValue = $val;
                                $val      = $key;
                            }

                            if( strpos($val, '...') === 0 )
                            {
                                $varprefix = str_replace('...', '...$', $val);
                                $subValue  = '';
                            }
                            else
                            {
                                $varprefix = '$'.$val;
                            }

                            $parameters .= $varprefix.( ! empty($subValue) ? ' = '.$subValue : '').', ';
                        }

                        $parameters = rtrim($parameters, ', ');
                    }

                    $function = $isKey;
                }

                $function = $this->_varType($function);

                $controller .= HT.$function->priority." function {$function->var}({$parameters})".EOL;
                $controller .= HT."{".EOL;
                $controller .= HT.HT."// Your codes...".EOL;
                $controller .= HT."}".EOL.EOL;
            }
        }
    }

    /**
     * Protected Uses
     * 
     * @param string & $controller
     * @param string & $namespace = NULL
     */
    protected function namespace(String & $controller, String & $namespace = NULL)
    {
        if( ! empty($this->settings['namespace']) )
        {
            $namespace   = $this->settings['namespace'];
            $controller .= "namespace ".$namespace.";".EOL.EOL;
        }
    }

    /**
     * Protected Uses
     * 
     * @param string & $controller
     */
    protected function uses(String & $controller)
    {
        if( ! empty($this->settings['use']) )
        {
            foreach( $this->settings['use'] as $key => $use )
            {
                if( is_numeric($key) )
                {
                    $controller .= "use {$use};".EOL;
                }
                else
                {
                    $controller .= "use {$key} as {$use};".EOL;
                }
            }

            $controller .= EOL;
        }
    }

    /**
     * Protected Extends
     * 
     * @param string & $controller
     */
    protected function extends(String & $controller)
    {
        if( ! empty($this->settings['extends']) )
        {
            $controller .= " extends ".$this->settings['extends'];
        }
    }
    
    /**
     * Protected Implements
     * 
     * @param string & $controller
     */
    protected function implements(String & $controller)
    {
        if( ! empty($this->settings['implements']) )
        {
            $controller .= " implements ".( is_array($this->settings['implements'])
                                            ? implode(', ', $this->settings['implements'])
                                            : $this->settings['implements']
                                          );
        }
    }

    /**
     * Protected Traits
     * 
     * @param string & $controller
     */
    protected function traits(String & $controller)
    {
        if( ! empty($this->settings['traits']) )
        {
            if( is_array($this->settings['traits']) ) foreach( $this->settings['traits'] as $trait )
            {
                $controller .= HT."use {$trait};".EOL;
            }
            else
            {
                $controller .= HT."use ".$this->settings['traits'].";".EOL;
            }

            $controller .= EOL;
        }
    }

    /**
     * Protected Contants
     * 
     * @param string & $controller
     */
    protected function constants(String & $controller)
    {
        if( ! empty($this->settings['constants']) )
        {
            foreach( $this->settings['constants'] as $key => $val )
            {
                $controller .= HT."const {$key} = {$val};".EOL;
            }

            $controller .= EOL;
        }
    }

    /**
     * Protected Vars
     * 
     * @param string & $controller
     */
    protected function vars(String & $controller)
    {
        if( ! empty($this->settings['vars']) )
        {
            $var = '';
            foreach( $this->settings['vars'] as $isKey => $var )
            {
                if( ! is_numeric($isKey) )
                {
                    $value = $var;
                    $var   = $isKey;
                }

                $vars = $this->_varType($var);
                $controller .= HT.$vars->priority.' $'.$vars->var.( ! empty($value) ? " = ".$value : '' ).";".EOL;
            }

            $controller .= EOL;
        }
    }

    /**
     * Protected Variable Type
     */
    protected function _varType($var)
    {
        $static = NULL;

        if( strstr($var, 'static') )
        {
            $static = ' static';
        }

        if( stripos($var, 'protected'.$static.':') === 0 )
        {
            $priority = 'protected';
            $var      = str_ireplace('protected'.$static.':', '', $var);
        }
        elseif( stripos($var, 'public'.$static.':') === 0 )
        {
            $priority = 'public';
            $var      = str_ireplace('public'.$static.':', '', $var);
        }
        elseif( stripos($var, 'private'.$static.':') === 0 )
        {
            $priority = 'private';
            $var     = str_ireplace('private'.$static.':', '', $var);
        }
        else
        {
            $priority = 'public';
            $var      = $var;
        }

        return (object)
        [
            'priority' => $priority.$static,
            'var'      => $var
        ];
    }

    /**
     * Protected type
     */
    protected function _type($type)
    {
        switch( $type )
        {
            case 'model'     : $return = 'Models';      break;
            case 'controller': $return = 'Controllers'; break;
            case 'library'   : $return = 'Libraries';   break;
            case 'command'   : $return = 'Commands';    break;
        }

        return presuffix($return ?? NULL, '/');
    }

    /**
     * Protected Add Databases
     */
    protected function _addDatabases()
    {
        $activesPath  = DATABASES_DIR . 'Actives/';
        $archivesPath = DATABASES_DIR . 'Archives/';
        $folders      = FileList::files($activesPath, 'dir');

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

            $tables = FileList::files($databasePath, 'php');

            if( ! empty($tables) )
            {
                $dbForge = $this->forge->differentConnection(['database' => $database]);
                $db      = $this->db->differentConnection(['database' => $database]);

                foreach( $tables as $table )
                {
                    $tableData = import($databasePath . $table);
                    $file      = $table;
                    $table     = Extension::remove($table);

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

                            Forge::createFolder($dbArchivePath);

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
     * Protected Archives Databases
     */
    protected function _archivesDatabases()
    {
        $archivesPath = DATABASES_DIR . 'Archives/';

        $folders = FileList::files($archivesPath, 'dir');

        if( empty($folders) )
        {
            return false;
        }

        foreach( $folders as $database )
        {
            $databasePath = $archivesPath . $database . '/';

            $tables   = FileList::files($databasePath, 'php');
            $pregGrep = preg_grep("/\_[0-9]*\.php/", $tables);
            $tables   = Arrays\RemoveElement::element($tables, $pregGrep);

            if( ! empty($tables) )
            {
                $dbForge  = $this->forge->differentConnection(['database' => $database]);

                foreach( $tables as $table )
                {
                    $dbForge->dropTable(Extension::remove($table));
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
