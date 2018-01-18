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

use ZN\Base;
use ZN\Logger;
use ZN\Config;
use ZN\Support;
use ZN\DataTypes\Arrays;
use ZN\Database\Exception\InvalidArgumentException;

class Connection
{
    /**
     * Keeps results
     * 
     * @var array
     */
    protected $results;

    /**
     * Keeps database drivers
     * 
     * @var array
     */
    protected $drivers =
    [
        'odbc'      => 'ODBC', 
        'mysqli'    => 'MySQLi',
        'pdo'       => 'PDO',
        'pdo:mysql' => 'PDO',
        'oracle'    => 'Oracle',
        'postgres'  => 'Postgres',
        'sqlite'    => 'SQLite',
        'sqlserver' => 'SQLServer'
    ];

    /**
     * Keeps database config
     * 
     * @var array
     */
    protected $config;

    /**
     * Keeps database default config
     * 
     * @var array
     */
    protected $defaultConfig;

    /**
     * Keeps table prefix
     * 
     * @var string
     */
    protected $prefix;

    /**
     * Keeps secure data
     * 
     * @var array
     */
    protected $secure = [];

    /**
     * Select table name
     * 
     * @var string
     */
    protected $table;

    /**
     * Keeps table name
     * 
     * @var string
     */
    protected $tableName;

    /**
     * Get string query
     * 
     * @var string
     */
    protected $stringQuery;

    /**
     * Keeps select functions
     * 
     * @var array
     */
    protected $selectFunctions;

    /**
     * Keeps column
     * 
     * @var array
     */
    protected $column;

    /**
     * Keep database driver
     * 
     * @var string
     */
    protected $driver;

    /**
     * Keeps string query
     * 
     * @var string
     */
    protected $string;

    /**
     * Magic construtor
     * 
     * @param array $config
     * 
     * @return void
     */
    public function __construct(Array $config = [])
    {
        $this->defaultConfig = Config::default(new DatabaseDefaultConfiguration)::get('Database', 'database');
        $this->config        = array_merge($this->defaultConfig, $config);
        $this->db            = $this->_run();
        $this->prefix        = $this->config['prefix'];
        Properties::$prefix  = $this->prefix;

        $this->db->connect($this->config);
    }

    /**
     * Creates different connection
     * 
     * @param mixed $connectName = NULL
     * 
     * @return Connection
     */
    public function differentConnection($connectName = NULL) : Connection
    {
        $getCalledClass = get_called_class();

        if( empty($connectName) )
        {
            return new $getCalledClass;
        }

        $config          = $this->defaultConfig;
        $configDifferent = $config['differentConnection'];

        if( is_string($connectName) && isset($configDifferent[$connectName]) )
        {
            $connection = $configDifferent[$connectName];
        }
        elseif( is_array($connectName) )
        {
            $connection = $connectName;
        }
        else
        {
            throw new InvalidArgumentException('Error', 'invalidInput', 'Mixed $connectName');
        }

        foreach( $config as $key => $val )
        {
            if( $key !== 'differentConnection' )
            {
                if( ! isset($connection[$key]) )
                {
                    $connection[$key] = $val;
                }
            }
        }

        return new $getCalledClass($connection);
    }

    /**
     * Get var types
     * 
     * @param void
     * 
     * @return array
     */
    public function vartypes() : Array
    {
        return $this->db->vartypes();
    }

    /**
     * Sets table name
     * 
     * @param string $table
     * 
     * @return Connection
     */
    public function table(String $table) : Connection
    {
        $this->table       = ' '.$this->prefix.$table.' ';
        $this->tableName   = $this->prefix.$table;
        Properties::$table = $this->tableName;

        return $this;
    }

    /**
     * Sets column
     * 
     * @param string $col
     * @param mixed  $val = NULL
     * 
     * @return Connection
     */
    public function column(String $col, $val = NULL) : Connection
    {
        $this->column[$col] = $val;

        return $this;
    }

    /**
     * Converts string query
     * 
     * @param void
     * 
     * @return Connection
     */
    public function string() : Connection
    {
        $this->string = true;

        return $this;
    }

    /**
     * Get string query
     * 
     * @param void
     * 
     * @return string
     */
    public function stringQuery() : String
    {
        if( ! empty($this->stringQuery) )
        {
            return $this->stringQuery;
        }

        return false;
    }

    /**
     * Sets query security
     * 
     * @param array $data
     * 
     * @return Connection
     */
    public function secure(Array $data) : Connection
    {
        $this->secure = $data;

        return $this;
    }

    /**
     * Defines function
     * 
     * @param string ...$args
     * 
     * @return mixed
     */
    public function func(...$args)
    {
        $array = $args;

        array_shift($array);

        $math  = $this->_math(isset($args[0]) ? strtoupper($args[0]) : false, $array);

        if( $math->return === true )
        {
            return $math->args;
        }
        else
        {
            $this->selectFunctions[] = $math->args;

            return $this;
        }
    }

    /**
     * Get database query error
     * 
     * @param void
     * 
     * @return string
     */
    public function error()
    {
        return $this->db->error();
    }

    /**
     * Close database connection
     * 
     * @param void
     * 
     * @return bool
     */
    public function close()
    {
        return $this->db->close();
    }

    /**
     * Get database version
     * 
     * @param void
     * 
     * @return string
     */
    public function version()
    {
        return $this->db->version();
    }

    /**
     * protected escape string add nail
     * 
     * @param mixed $value
     * @param mixed $numeric = false
     * 
     * @return string
     */
    protected function _escapeStringAddNail($value, $numeric = false)
    {
        if( $numeric === true && is_numeric($value) )
        {
            return $value;
        }

        return Base::presuffix($this->db->realEscapeString($value), "'");
    }

    /**
     * protected exp
     * 
     * @param string $column = ''
     * @param string $exp    = 'exp'
     * 
     * @return string
     */
    protected function _exp($column = '', $exp = 'exp')
    {
        return stristr($column, $exp . ':');
    }

    /**
     * @param string $column
     * @param string $ext = 'exp'
     * 
     * @return string
     */
    protected function _clearExp($column, $exp = 'exp')
    {
        return str_ireplace($exp . ':', '', $column);
    }

    /**
     * protected clear nail
     * 
     * @param string 
     * 
     * @return string
     */
    protected function _clearNail($value)
    {
        return trim($value, '\'');
    }

    /**
     * protected convert type
     * 
     * @param string &$column
     * @param string &$value 
     * 
     * @param void
     */
    protected function _convertType(&$column = '', &$value = '')
    {
        $clearValue = $this->_clearNail($value);

        if( $this->_exp($column, $type = 'int') )
        {
            $value = (int) $clearValue;
        }
        elseif( $this->_exp($column, $type = 'float') )
        {
            $value = (float) $clearValue;
        }
        else
        {
            $type = 'exp';
        }

        $column = $this->_clearExp($column, $type);
    }

    /**
     * protected query security
     * 
     * @param string $query
     * 
     * @return string
     */
    protected function _querySecurity($query)
    {
        if( ! empty($this->secure) )
        {
            $secure = $this->secure;

            $secureParams = [];

            if( is_numeric(key($secure)) )
            {
                $strex  = explode('?', $query);
                $newstr = '';

                if( ! empty($strex) ) for( $i = 0; $i < count($strex) - 1; $i++ )
                {
                    $sec = $secure[$i] ?? NULL;

                    $newstr .= $strex[$i].$this->db->realEscapeString($sec);
                }

                $query = $newstr;
            }
            else
            {
                foreach( $this->secure as $k => $v )
                {
                    $this->_convertType($k, $v);

                    $secureParams[$k] = $this->db->realEscapeString($v);
                }
            }

            $query = str_replace(array_keys($secureParams), array_values($secureParams), $query);
        }

        if( ($this->config['queryLog'] ?? NULL) === true )
        {
            Logger::report('DatabaseQueries', $query, 'DatabaseQueries');
        }

        $this->stringQuery = $query;

        $this->secure = [];

        return $query;
    }

    /**
     * Sets math functions
     * 
     * @param string $type
     * @param array  $args
     * 
     * @return object
     */
    protected function _math($type, $args)
    {
        $type    = strtoupper($type);
        $getLast = Arrays\GetElement::last($args);
        $asparam = ' ';

        if( $getLast === true )
        {
            array_pop($args);

            $return = true;
            $as     = Arrays\GetElement::last($args);

            if( stripos(trim($as), 'as') === 0 )
            {
                $asparam .= $as;
                array_pop($args);
            }
        }
        else
        {
            $return = false;
        }

        if( stripos(trim($getLast), 'as') === 0 )
        {
            $asparam .= $getLast;
            array_pop($args);
        }

        $args = $type.'('.rtrim(implode(',', $args), ',').')'.$asparam;

        return (object) 
        [
            'args'   => $args,
            'return' => $return
        ];
    }

    /**
     * Run driver
     * 
     * @param array $settings = []
     * 
     * @return object
     */
    protected function _run($settings = [])
    {
        $this->driver = preg_replace('/(\w+)(\:\w+)*/', '$1', $this->config['driver']);

        return $this->_drvlib(NULL, $settings);
    }

    /**
     * protected get driver library
     * 
     * @param string $suffix   = 'Driver'
     * @param array  $settings = []
     * 
     * @return object
     */
    protected function _drvlib($suffix = NULL, $settings = [])
    {
        Support::driver(array_keys($this->drivers), $this->driver);

        $class = 'ZN\Database\\'.$this->drivers[$this->driver].'\\DB'.$suffix;

        return new $class($settings);
    }

    /**
     * protected encode nail
     * 
     * @param string $data
     * 
     * @return string
     */
    protected function nailEncode($data)
    {
        return str_replace(["'", "\&#39;", "\\&#39;"], "&#39;", $data);
    }

    /**
     * protected run exec query
     * 
     * @param string $query
     * @param string $type = 'query'
     * 
     * @return mixed
     */
    protected function _runQuery($query, $type = 'query')
    {
        if( $this->string === true )
        {
            $this->string = NULL;
            return $query;
        }

        $this->db->$type($this->_querySecurity($query), $this->secure);

        return ! (bool) $this->db->error();
    }

    /**
     * protected run exec query
     * 
     * @param string $query
     * 
     * @return string
     */
    protected function _runExecQuery($query)
    {
        return $this->_runQuery($query, 'exec');
    }

    /**
     * Sets table name
     * 
     * @param mixed  $p    = NULL
     * @param string $name = 'table'
     * 
     * @return string
     */
    protected function _p($p = NULL, $name = 'table')
    {
        if( $name === 'prefix' )
        {
            return $this->$name.$p;
        }

        if( $name === 'table' )
        {
            $p = $this->prefix.$p;
        }

        if( ! empty($this->$name) )
        {
            $data = $this->$name;

            $this->$name = NULL;

            return $data;
        }
        else
        {
            return $p;
        }
    }

    /**
     * Magic destructor
     * 
     * @param void
     * 
     * @return void
     */
    public function __destruct()
    {
        $this->results = NULL; $this->db->close(); $this->db->closeConnection();
    }
}
