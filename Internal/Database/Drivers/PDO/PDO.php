<?php namespace ZN\Database\Drivers;

use ZN\Database\Abstracts\DriverConnectionMappingAbstract;
use Errors, stdClass, Support, PDO, PDOException;

class PDODriver extends DriverConnectionMappingAbstract
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
    // Sub Driver
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $subDriver;

    //--------------------------------------------------------------------------------------------------------
    // Operators
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $operators =
    [
        'like' => '%'
    ];

    //--------------------------------------------------------------------------------------------------------
    // Statements
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $statements =
    [
        'autoincrement' => 'AUTO_INCREMENT',
        'primarykey'    => 'PRIMARY KEY',
        'foreignkey'    => 'FOREIGN KEY',
        'unique'        => 'UNIQUE',
        'null'          => 'NULL',
        'notnull'       => 'NOT NULL',
        'exists'        => 'EXISTS',
        'notexists'     => 'NOT EXISTS',
        'constraint'    => 'CONSTRAINT',
        'default'       => 'DEFAULT'
    ];

    //--------------------------------------------------------------------------------------------------------
    // Variable Types
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $variableTypes =
    [
        'int'           => 'INT',
        'smallint'      => 'SMALLINT',
        'tinyint'       => 'TINYINT',
        'mediumint'     => 'MEDIUMINT',
        'bigint'        => 'BIGINT',
        'decimal'       => 'DECIMAL',
        'double'        => 'DOUBLE',
        'float'         => 'FLOAT',
        'char'          => 'CHAR',
        'varchar'       => 'VARCHAR',
        'tinytext'      => 'TINYTEXT',
        'text'          => 'TEXT',
        'mediumtext'    => 'MEDIUMTEXT',
        'longtext'      => 'LONGTEXT',
        'date'          => 'DATE',
        'datetime'      => 'DATETIME',
        'time'          => 'TIME',
        'timestamp'     => 'TIMESTAMP'
    ];

    //--------------------------------------------------------------------------------------------------------
    // Construct
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct()
    {
        Support::extension('PDO', 'PDO');
    }

    //--------------------------------------------------------------------------------------------------------
    // Connect
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $config
    //
    //--------------------------------------------------------------------------------------------------------
    public function connect($config = [])
    {
        $this->config = $config;
        try
        {
            $this->connect = new PDO($this->_dsn($this->config), $this->config['user'], $this->config['password']);
        }
        catch( PDOException $e )
        {
            die(Errors::message('Database', 'connectError'));
        }

        if( ! empty($this->config['charset']  ) ) $this->connect->exec("SET NAMES '".$this->config['charset']."'");
        if( ! empty($this->config['charset']  ) ) $this->connect->exec('SET CHARACTER SET '.$this->config['charset']);
        if( ! empty($this->config['collation']) ) $this->connect->exec("SET COLLATION_CONNECTION = '".$this->config['collation']."'");     
    }

    //--------------------------------------------------------------------------------------------------------
    // Exec
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $query
    // @param array  $security
    //
    //--------------------------------------------------------------------------------------------------------
    public function exec($query, $security = NULL)
    {
        if( empty($query) )
        {
            return false;
        }

        return $this->connect->exec($query);
    }

    //--------------------------------------------------------------------------------------------------------
    // Multi Query
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $query
    // @param array  $security
    //
    //--------------------------------------------------------------------------------------------------------
    public function multiQuery($query, $security = NULL)
    {
        return $this->query($query, $security);
    }

    //--------------------------------------------------------------------------------------------------------
    // Query
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $query
    // @param array  $security
    //
    //--------------------------------------------------------------------------------------------------------
    public function query($query, $security = [])
    {
        $this->query = $this->connect->prepare($query);
        return $this->query->execute($security);
    }

    //--------------------------------------------------------------------------------------------------------
    // Trans Start
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function transStart()
    {
        return $this->connect->beginTransaction();
    }

    //--------------------------------------------------------------------------------------------------------
    // Trans Roll Back
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function transRollback()
    {
        return $this->connect->rollBack();
    }

    //--------------------------------------------------------------------------------------------------------
    // Trans Commit
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function transCommit()
    {
        return $this->connect->commit();
    }

    //--------------------------------------------------------------------------------------------------------
    // Insert ID
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function insertID()
    {
        if( ! empty($this->connect) )
        {
            return $this->connect->lastInsertId('id');
        }
        else
        {
            return false;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Column Data
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $column
    //
    //--------------------------------------------------------------------------------------------------------
    public function columnData($col = '')
    {
        if( empty($this->query) )
        {
            return false;
        }

        $columns   = [];
        $numFields = $this->numFields();

        for( $i = 0; $i < $numFields; $i++ )
        {
            $field     = $this->query->getColumnMeta($i);
            $fieldName = $field['name'];

            $columns[$fieldName]             = new stdClass();
            $columns[$fieldName]->name       = $fieldName;
            $columns[$fieldName]->type       = $field['native_type'];
            $columns[$fieldName]->maxLength  = ($field['len'] > 0) ? $field['len'] : NULL;
            $columns[$fieldName]->primaryKey = (int) ( ! empty($field['flags']) && in_array('primary_key', $field['flags'], TRUE));
            $columns[$fieldName]->default    = NULL;
        }

        return $columns[$col] ?? $columns;

    }

    //--------------------------------------------------------------------------------------------------------
    // Num Rows
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function numRows()
    {
        if( ! empty($this->query) )
        {
            return $this->query->rowCount();
        }

        return 0;
    }

    //--------------------------------------------------------------------------------------------------------
    // Columns
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function columns()
    {
        if( empty($this->query) )
        {
            return [];
        }

        $columns   = [];
        $numFields = $this->numFields();

        for( $i = 0; $i < $numFields; $i++ )
        {
            $meta = $this->query->getColumnMeta($i);

            if( $meta['name'] !== NULL )
            {
                $columns[] = $meta['name'];
            }
        }

        return $columns;
    }

    //--------------------------------------------------------------------------------------------------------
    // Num Fields
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function numFields()
    {
        if( isset($this->query) )
        {
            return $this->query->columnCount();
        }
        else
        {
            return 0;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Real Escape String
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function realEscapeString($data = '')
    {
        if( empty($this->connect) )
        {
            return false;
        }

        return $this->connect->quote($data);
    }

    //--------------------------------------------------------------------------------------------------------
    // Error
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function error()
    {
        if( isset($this->connect) )
        {
            if( ! empty($this->query) )
            {
                $error = $this->query->errorInfo();
            }
            else
            {
                $error = $this->connect->errorInfo();
            }

            return $error[2];
        }
        else
        {
            return false;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Fetch Array
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function fetchArray()
    {
        if( ! empty($this->query) )
        {
            return $this->query->fetch(PDO::FETCH_BOTH);
        }
        else
        {
            return [];
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Fetch Assoc
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function fetchAssoc()
    {
        if( ! empty($this->query) )
        {
            return $this->query->fetch(PDO::FETCH_ASSOC);
        }
        else
        {
            return [];
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Fetch Row
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function fetchRow()
    {
        if( ! empty($this->query) )
        {
            return $this->query->fetch();
        }
        else
        {
            return [];
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Affected Rows
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function affectedRows()
    {
        if( ! empty($this->query) )
        {
            return $this->query->rowCount();
        }
        else
        {
            return 0;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Close
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function close()
    {
        if( isset($this->connect) )
        {
            $this->connect = NULL;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Version
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function version()
    {
        if( ! empty($this->connect) )
        {
            return $this->connect->getAttribute(PDO::ATTR_SERVER_VERSION);
        }
        else
        {
            return false;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected DNS
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  array $config
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _dsn(Array $config) : String
    {
        $dsn  = 'mysql:';

        $dsn .= ( ! empty($config['host']) )
                ? 'host='.$config['host'].';'
                : '';

        $dsn .= ( ! empty($config['database']) )
                ? 'dbname='.$config['database'].';'
                : '';

        $dsn .= ( ! empty($config['port']) )
                ? 'PORT='.$config['port'].';'
                : '';

        $dsn .= ( ! empty($config['charset']) )
                ? 'charset='.$config['charset']
                : '';

        return rtrim($dsn, ';');
    }
}
