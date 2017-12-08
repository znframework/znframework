<?php namespace ZN\Database;

use Pagination, Config, Cache;
use ZN\Services\URI;
use ZN\Services\Method;
use ZN\DataTypes\Strings;
use ZN\DataTypes\Arrays;
use ZN\FileSystem\Excel;

class DB extends Connection
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
    // Statements
    //--------------------------------------------------------------------------------------------------------
    //
    // @var Array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $vartypeElements =
    [
        'int'     , 'smallint', 'tinyint'   , 'mediumint', 'bigint',
        'decimal' , 'double'  , 'float'     ,
        'char'    , 'varchar' , 
        'tinytext', 'text'    , 'mediumtext', 'longtext' ,
        'date'    , 'time'    , 'timestamp' , 'datetime' ,
        
        'integer' => 'int'
    ];

    //--------------------------------------------------------------------------------------------------------
    // Statements
    //--------------------------------------------------------------------------------------------------------
    //
    // @var Array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $statementElements =
    [
        'autoincrement', 'primarykey', 'foreignkey', 'unique',
        'null'         , 'notnull'   ,
        'exists'       , 'notexists' ,
        'constraint'
    ];

    //--------------------------------------------------------------------------------------------------------
    // Functions
    //--------------------------------------------------------------------------------------------------------
    //
    // @var Array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $functionElements =
    [
        'ifnull' , 'nullif'      , 'abs'      , 'mod'      , 'asin'     ,
        'acos'   , 'atan'        , 'atan2'    , 'ceil'     , 'ceiling'  ,
        'cos'    , 'cot'         , 'crc32'    , 'degrees'  , 'exp'      ,
        'floor'  , 'ln'          , 'log10'    , 'log2'     , 'log'      ,
        'pi'     , 'pow'         , 'power'    , 'radians'  , 'rand'     ,
        'round'  , 'sign'        , 'sin'      , 'sqrt'     , 'tan'      ,
        'ascii'  , 'field'       , 'format'   , 'lower'    , 'upper'    ,
        'length' , 'ltrim'       , 'substring', 'ord'      , 'position' ,
        'quote'  , 'repeat'      , 'rtrim'    , 'soundex'  , 'space'    ,
        'substr' , 'trim'        , 'ucase'    , 'lcase'    , 'benchmark',
        'charset', 'coercibility', 'user'     , 'collation', 'database' ,
        'schema' , 'avg'         , 'min'      , 'max'      , 'count'    ,
        'sum'    , 'variance'    ,
        'ifelse'         => 'IF'             ,
        'charlength'     => 'CHAR_LENGTH'    ,
        'substringindex' => 'SUBSTRING_INDEX',
        'connectionid'   => 'CONNECTION_ID'  ,
        'currentuser'    => 'CURRENT_USER'   ,
        'lastinsertid'   => 'LAST_INSERT_ID' ,
        'systemuser'     => 'SYSTEM_USER'    ,
        'sessionuser'    => 'SESSION_USER'   ,
        'rowcount'       => 'ROW_COUNT'      ,
        'versioninfo'    => 'VERSION'
    ];

    //--------------------------------------------------------------------------------------------------------
    // Scalar Variables
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    private $select     , $where     , $distinct         , $highPriority, $lowPriority  ;
    private $delayed    , $procedure , $outFile          , $characterSet, $into         ;
    private $forUpdate  , $quick     , $ignore           , $partition   , $straightJoin ;
    private $smallResult, $bigResult , $bufferResult     , $cache       , $calcFoundRows;
    private $groupBy    , $having    , $orderBy          , $limit       , $join         ;
    private $transStart , $transError, $duplicateCheck   , $duplicateCheckUpdate        ;
    private $joinType   , $joinTable , $unionQuery = NULL, $caching = [];

    //--------------------------------------------------------------------------------------------------------
    // Magic Call
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $method
    // @param array  $parameters
    //
    //--------------------------------------------------------------------------------------------------------
    public function __call($method, $parameters)
    {
        $method = strtolower($originMethodName = $method);
        $split  = Strings\Split::upperCase($originMethodName);
        $crud   = $split[1] ?? NULL;

        if( in_array($method, $this->functionElements) )
        {
            $functionMethod = $method;
        }
        else
        {
            $functionMethod = $this->functionElements[$method] ?? NULL;
        }

        if( in_array($method, $this->vartypeElements) )
        {
            $vartypeMethod = $method;
        }
        else
        {
            $vartypeMethod  = $this->vartypeElements[$method]  ?? NULL;
        }

        if( $functionMethod !== NULL )
        {
            $math = $this->_math($functionMethod, $parameters);

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
        elseif( $vartypeMethod !== NULL )
        {
            return $this->db->variableTypes($vartypeMethod, ...$parameters);
        }
        elseif( in_array($method, $this->statementElements) )
        {
            return $this->db->statements($method, ...$parameters);
        }
        elseif( ($split[1] ?? NULL) === 'Join')
        {
            $type    = $split[0] ?? 'left';
            $table1  = $split[2] ?? NULL;
            $column1 = strtolower($table1 . '.' . $split[3]);
            $table2  = $split[4] ?? NULL;
            $column2 = strtolower($table2 . '.' . $split[5]);
            $met     = $type . $split[1];

            return $this->$met($column1, $column2, $parameters[0] ?? '=');
        }
        elseif( $split[0] === 'order' || $split[0] === 'group')
        {
            $column = strtolower($split[2] ?? NULL);
            $type   = $split[0] === 'order' ? $split[3] ?? 'asc' : NULL;
            $met    = $split[0] . 'By';

            return $this->$met($column, $type);
        }
        elseif( $split[0] === 'where' || $split[0] === 'having' )
        {
            $met       = $split[0];
            $column    = strtolower($split[1]);
            $condition = $split[2] ?? NULL;
            $operator  = isset($parameters[1]) ? ' ' . $parameters[1] : NULL;

            return $this->$met($column . $operator, $parameters[0], $condition);
        }
        elseif
        (
            $crud === 'Delete' ||
            $crud === 'Update' ||
            $crud === 'Insert'
        )
        {
            $table  = $split[0];
            $method = $split[1];

            if( is_string($parameters[0]) )
            {
                $prefix = $parameters[0] . ':';
                $data   = [];
            }
            else
            {
                $prefix = NULL;
                $data   = $parameters[0];
            }

            return $this->$method($prefix . $table, $data);
        }
        else
        {
            $func = $split[1] ?? NULL;

            if( $func === 'Row' || $func === 'Result' )
            {
                $method = $split[0];
                $result = strtolower($func);
            }

            if( $select = ($split[2] ?? NULL) )
            {
                $result = 'value';

                $this->select($select);
            }

            $return = $this->get($method);

            if( ! isset($result) )
            {
                return $return;
            }

            return $return->$result($parameters[0] ?? ($result === 'row' ? 0 : 'object'));
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Select
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string ...$condition
    //
    //--------------------------------------------------------------------------------------------------------
    public function select(...$condition) : DB
    {
        if( empty($condition[0]) )
        {
            $condition[0] = '*';
        }

        $condition = rtrim(implode(',', $condition), ',');

        $this->select = ' '.$condition.' ';

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Where
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed  $column
    // @param scalar $value
    // @param string $logical
    //
    //--------------------------------------------------------------------------------------------------------
    public function where($column, String $value = '', String $logical = NULL) : DB
    {
        $this->_wh($column, $value, $logical, __FUNCTION__);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Where Group
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array ...$args
    //
    //--------------------------------------------------------------------------------------------------------
    public function whereGroup(...$args) : DB
    {
        $this->where .= $this->_whereHavingGroup($args);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Having Group
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array ...$args
    //
    //--------------------------------------------------------------------------------------------------------
    public function havingGroup(...$args) : DB
    {
        $this->having .= $this->_whereHavingGroup($args);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Having
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed  $column
    // @param scalar $value
    // @param string $logical
    //
    //--------------------------------------------------------------------------------------------------------
    public function having($column, String $value = '', String $logical = NULL) : DB
    {
        $this->_wh($column, $value, $logical, __FUNCTION__);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Caching -> 4.3.6
    //--------------------------------------------------------------------------------------------------------
    //
    // @param scalar $time
    // @param string $driver
    //
    //--------------------------------------------------------------------------------------------------------
    public function caching($time, String $driver = NULL) : DB
    {
        $this->caching['time']   = $time;
        $this->caching['driver'] = $driver ?? $this->config['cacheDriver'] ?? 'file';

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Clean Caching -> 4.3.6
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function cleanCaching(String $driver = 'file') : Bool
    {
        return Cache::driver($this->caching['driver'] ?? $driver)->delete($this->_cacheQuery());
    }

    //--------------------------------------------------------------------------------------------------------
    // Join
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param string $condition
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    public function join(String $table, String $condition, String $type = NULL) : DB
    {
        $tableEx = explode('.', $table);

        switch( count($tableEx) )
        {
            case 2:
                $table = $tableEx[0] . '.' . $this->prefix . $tableEx[1];
            break;

            case 1:
                $table   = $this->prefix.$table;
            break;
        }

        $type = \Autoloader::upper($type);

        $this->joinType  = $type;
        $this->joinTable = $table;

        $this->join .= ' '.$type.' JOIN '.$table.' ON '.$condition.' ';

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Inner Join
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param string $column
    // @param string $otherColumn
    //
    //--------------------------------------------------------------------------------------------------------
    public function innerJoin(String $table, String $otherColumn, String $operator = '=') : DB
    {
        $this->_join($table, $otherColumn, $operator, 'INNER');

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Outer Join
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param string $column
    // @param string $otherColumn
    //
    //--------------------------------------------------------------------------------------------------------
    public function outerJoin(String $table, String $otherColumn, String $operator = '=') : DB
    {
        $this->_join($table, $otherColumn, $operator, 'FULL OUTER');

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Left Join
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param string $column
    // @param string $otherColumn
    //
    //--------------------------------------------------------------------------------------------------------
    public function leftJoin(String $table, String $otherColumn, String $operator = '=') : DB
    {
        $this->_join($table, $otherColumn, $operator, 'LEFT');

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Right Join
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param string $column
    // @param string $otherColumn
    //
    //--------------------------------------------------------------------------------------------------------
    public function rightJoin(String $table, String $otherColumn, String $operator = '=') : DB
    {
        $this->_join($table, $otherColumn, $operator, 'RIGHT');

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Group By
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string ...$args
    //
    //--------------------------------------------------------------------------------------------------------
    public function groupBy(...$args) : DB
    {
        $this->groupBy .= implode(',', $args).', ';

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Order By
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed  $condition
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    public function orderBy($condition, String $type = NULL) : DB
    {
        if( is_string($condition) )
        {
            $this->orderBy .= $condition.' '.$type.', ';
        }
        else
        {
            if( ! empty($condition) ) foreach( $condition as $key => $val )
            {
                $this->orderBy .= $key.' '.$val.', ';
            }
        }

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Limit
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int $start
    // @param int $limit
    //
    //--------------------------------------------------------------------------------------------------------
    public function limit($start = NULL, Int $limit = 0) : DB
    {
        $start = (int) ($start ?? URI::segment(-1));

        $this->limit = ' LIMIT '. ( ! empty($limit) ? $limit . ' OFFSET '.$start.' ' : $start );

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Basic
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $set
    //
    //--------------------------------------------------------------------------------------------------------
    public function basic() : DB
    {
        $this->retunQueryType = 'basicQuery';

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Get
    //--------------------------------------------------------------------------------------------------------
    //
    // Sorguyu tamamlamak için kullanılır.
    //
    // @param  string $table  -> Tablo adı.
    // @return string $return -> Sorgunun dönüş türü. object, string
    //
    //--------------------------------------------------------------------------------------------------------
    public function get(String $table = NULL, String $return = 'object')
    {
        $this->tableName = $table = $this->_p($table, 'table');
     
        $finalQuery =     'SELECT '         . 
                          $this->distinct   . $this->highPriority . $this->straightJoin . 
                          $this->smallResult. $this->bigResult    . $this->bufferResult . 
                          $this->cache      . $this->calcFoundRows. $this->_select()    .
                          ' FROM '          . 
                          $table.' '        . $this->partition    . $this->join         . 
                          $this->_where()   . $this->_groupBy()   . $this->_having()    . 
                          $this->_orderBy() . $this->limit        . $this->procedure    . 
                          $this->outFile    . $this->characterSet . $this->into         .
                          $this->forUpdate;

        if( $this->unionQuery !== NULL )
        {
            $finalQuery       = $this->unionQuery . ' ' . $finalQuery;
            $this->unionQuery = NULL;
        }

        $returnQuery = $this->retunQueryType ?? 'query';

        $this->_resetSelectQuery();
        
        $secureFinalQuery = $this->_querySecurity($finalQuery);

        if( $this->string === true || $return === 'string' )
        {
            $this->string = NULL;

            return $secureFinalQuery;
        }

        return $this->$returnQuery($secureFinalQuery, $this->secure);
    }

    //--------------------------------------------------------------------------------------------------------
    // Duplicate Check
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param string $column
    // @param string $otherColumn
    //
    //--------------------------------------------------------------------------------------------------------
    public function duplicateCheck(...$args) : DB
    {
        $this->duplicateCheck = $args;

        if( empty($this->duplicateCheck) )
        {
            $this->duplicateCheck[0] = '*';
        }

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Duplicate Check Update -> 4.4.7
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param string $column
    // @param string $otherColumn
    //
    //--------------------------------------------------------------------------------------------------------
    public function duplicateCheckUpdate(...$args) : DB
    {
        $this->duplicateCheck(...$args);

        $this->duplicateCheckUpdate = true;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Escape String
    //--------------------------------------------------------------------------------------------------------
    //
    // Tırnak işaretlerinin başına \ işareti ekler.
    //
    // @param  string $data
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function escapeString(String $data) : String
    {
        return $this->db->realEscapeString($data);
    }

    //--------------------------------------------------------------------------------------------------------
    // Real Escape String
    //--------------------------------------------------------------------------------------------------------
    //
    // Tırnak işaretlerinin başına \ işareti ekler.
    //
    // @param  string $data
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function realEscapeString(String $data) : String
    {
        return $this->db->realEscapeString($data);
    }

    //--------------------------------------------------------------------------------------------------------
    // Get String
    //--------------------------------------------------------------------------------------------------------
    //
    // Sorguyunun çalıştırılmadan metinsel çıktısını almak için kullanılır.
    //
    // @param  string $table -> Tablo adı.
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function getString(String $table = NULL) : String
    {
        return $this->get($table, 'string');
    }

    //--------------------------------------------------------------------------------------------------------
    // Alias
    //--------------------------------------------------------------------------------------------------------
    //
    // Veriye takma ad vermek için kullanılır.
    //
    // @param  string $string   -> Metin.
    // @param  string $alias    -> Takma ad.
    // @param  bool   $brackets -> Parantezlerin olup olmayacağı.
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function alias(String $string, String $alias, Bool $brackets = false) : String
    {
        if( $brackets === true)
        {
            $string = $this->brackets($string);
        }

        return $string.' AS '.$alias;
    }

    //--------------------------------------------------------------------------------------------------------
    // Brackets
    //--------------------------------------------------------------------------------------------------------
    //
    // Verinin başına ve sonuna parantez eklemek için kullanılır.
    //
    // @param  string $string   -> Metin.
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function brackets(String $string) : String
    {
        return ' ( '.$string.' ) ';
    }

    //--------------------------------------------------------------------------------------------------------
    // All
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function all() : DB
    {
        $this->dictinct = ' ALL ';
        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Distinct
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function distinct() : DB
    {
        $this->distinct = ' DISTINCT ';
        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Distinct Row
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function distinctRow() : DB
    {
        $this->distinct = ' DISTINCTROW ';
        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Straight Join
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function straightJoin() : DB
    {
        $this->straightJoin = ' STRAIGHT_JOIN ';
        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // High Priority
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function highPriority() : DB
    {
        $this->highPriority = ' HIGH_PRIORITY ';
        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Low Priority
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function lowPriority() : DB
    {
        $this->lowPriority = ' LOW_PRIORITY ';
        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Quick
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function quick() : DB
    {
        $this->quick = ' QUICK ';
        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Delayed
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function delayed() : DB
    {
        $this->delayed = ' DELAYED ';
        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Ignore
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function ignore() : DB
    {
        $this->ignore = ' IGNORE ';
        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Partition
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string ...$args
    //
    //--------------------------------------------------------------------------------------------------------
    public function partition(...$args) : DB
    {
        $this->partition = $this->_math(__FUNCTION__, $args)->args;
        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Procedure
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string ...$args
    //
    //--------------------------------------------------------------------------------------------------------
    public function procedure(...$args) : DB
    {
        $this->procedure = $this->_math(__FUNCTION__, $args)->args;
        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Out File
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string ...$args
    //
    //--------------------------------------------------------------------------------------------------------
    public function outFile(String $file) : DB
    {
        $this->outFile = 'INTO OUTFILE '."'".$file."'".' ';
        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Dump File
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    //--------------------------------------------------------------------------------------------------------
    public function dumpFile(String $file) : DB
    {
        $this->into = 'INTO DUMPFILE '."'".$file."'".' ';

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Character Set
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $set
    // @param bool   $return
    //
    //--------------------------------------------------------------------------------------------------------
    public function characterSet(String $set, Bool $return = false)
    {
        $string = 'CHARACTER SET '.$set.' ';

        if( $return === false )
        {
            $this->characterSet = $string;
            return $this;
        }
        else
        {
            return $string;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Character Set
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $set
    //
    //--------------------------------------------------------------------------------------------------------
    public function cset(String $set) : String
    {
        if( empty($set) )
        {
            $set = $this->config['charset'];
        }

        return $this->characterSet($set, true);
    }

    //--------------------------------------------------------------------------------------------------------
    // Collate
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $set
    //
    //--------------------------------------------------------------------------------------------------------
    public function collate(String $set = NULL) : String
    {
        if( empty($set) )
        {
            $set = $this->config['collation'];
        }

        return 'COLLATE '.$set.' ';
    }


    //--------------------------------------------------------------------------------------------------------
    // Encoding
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $charset
    // @param string $collate
    //
    //--------------------------------------------------------------------------------------------------------
    public function encoding(String $charset = 'utf8', String $collate = 'utf8_general_ci') : String
    {
        $encoding  = $this->cset($charset);
        $encoding .= $this->collate($collate);

        return $encoding;
    }

    //--------------------------------------------------------------------------------------------------------
    // Into
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $varname1
    // @param string $varname2
    //
    //--------------------------------------------------------------------------------------------------------
    public function into(String $varname1, String $varname2 = NULL) : DB
    {
        $this->into = 'INTO '.$varname1.' ';

        if( ! empty($varname2) )
        {
            $this->into .= ', '.$varname2.' ';
        }

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // For Update
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function forUpdate() : DB
    {
        $this->forUpdate = ' FOR UPDATE ';

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Lock In Share Mode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function lockInShareMode() : DB
    {
        $this->forUpdate = ' LOCK IN SHARE MODE ';

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Small Result
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function smallResult() : DB
    {
        $this->smallResult = ' SQL_SMALL_RESULT ';

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Big Result
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function bigResult() : DB
    {
        $this->bigResult = ' SQL_BIG_RESULT ';

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Buffer Result
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function bufferResult() : DB
    {
        $this->bufferResult = ' SQL_BUFFER_RESULT ';

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Cache
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function cache() : DB
    {
        $this->cache = ' SQL_CACHE ';

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // No Cache
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function noCache() : DB
    {
        $this->cache = ' SQL_NO_CACHE ';

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Calc Found Rows
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function calcFoundRows() : DB
    {
        $this->calcFoundRows = ' SQL_CALC_FOUND_ROWS ';

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Union
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    //
    //--------------------------------------------------------------------------------------------------------
    public function union(String $table = NULL, $name = 'UNION') : DB
    {
        $this->unionQuery .= $this->get($table, 'string') . $name;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Union All
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    //
    //--------------------------------------------------------------------------------------------------------
    public function unionAll(String $table = NULL) : DB
    {
        $this->union($table, 'UNION ALL');

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Query
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $query
    // @param array  $secure
    //
    //--------------------------------------------------------------------------------------------------------
    public function query(String $query, Array $secure = [])
    {
        $caching = $this->caching;

        $this->caching = [];

        return (new self($this->config))->_query($query, $secure, ['caching' => $caching]);
    }

    //--------------------------------------------------------------------------------------------------------
    // Exec Query
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $query
    // @param array  $secure
    //
    //--------------------------------------------------------------------------------------------------------
    public function execQuery(String $query, Array $secure = []) : Bool
    {
        $this->secure = $this->secure ?: $secure;

        return $this->db->exec($this->_querySecurity($query), $this->secure);
    }

    //--------------------------------------------------------------------------------------------------------
    // Basic Query
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $query
    // @param array  $secure
    //
    //--------------------------------------------------------------------------------------------------------
    public function basicQuery(String $query, Array $secure = []) : DB
    {
        $this->_query($query, $secure);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Trans Query
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $query
    // @param array  $secure
    //
    //--------------------------------------------------------------------------------------------------------
    public function transQuery(String $query, Array $secure = []) : DB
    {
        $this->_query($query, $secure);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Multi Query
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $query
    // @param array  $secure
    //
    //--------------------------------------------------------------------------------------------------------
    public function multiQuery(String $query, Array $secure = []) : Bool
    {
        $this->secure = $this->secure ?: $secure;

        return $this->db->multiQuery($this->_querySecurity($query), $this->secure);
    }

    //--------------------------------------------------------------------------------------------------------
    // Trans Start
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function transStart() : DB
    {
        $this->transStart = $this->db->transStart();

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Trans End
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function transEnd()
    {
        if( ! empty($this->transError) )
        {
            $this->db->transRollback();
        }
        else
        {
            $this->db->transCommit();
        }

        $status = ! (bool) $this->transError;

        $this->transStart = NULL;
        $this->transError = NULL;

        return $status;
    }

    //--------------------------------------------------------------------------------------------------------
    // Insert ID
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function insertID() : Int
    {
        return $this->db->insertId();
    }

    //--------------------------------------------------------------------------------------------------------
    // Status
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    //
    //--------------------------------------------------------------------------------------------------------
    public function status(String $table = NULL) : DB
    {
        $table = presuffix($this->_p($table), "'");

        $query = "SHOW TABLE STATUS FROM " . $this->config['database'] . " LIKE $table";

        $this->_runQuery($query);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Increment
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string  $table
    // @param mixed   $columns
    // @param numeric $increment
    //
    //--------------------------------------------------------------------------------------------------------
    public function increment(String $table = NULL, $columns = [], Int $increment = 1) : Bool
    {
        return $this->_incdec($table, $columns, $increment, 'increment');
    }

    //--------------------------------------------------------------------------------------------------------
    // Decrement
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string  $table
    // @param mixed   $columns
    // @param numeric $decrement
    //
    //--------------------------------------------------------------------------------------------------------
    public function decrement(String $table = NULL, $columns = [], Int $decrement = 1) : Bool
    {
        return $this->_incdec($table, $columns, $decrement, 'decrement');
    }

    //--------------------------------------------------------------------------------------------------------
    // Insert CSV -> 5.3.9
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $table
    // @param  string $file
    //
    //--------------------------------------------------------------------------------------------------------
    public function insertCSV(String $table, String $file) : Bool
    {
        $this->_csv($file);
        
        array_map(function($data) use($table)
        {
            $this->duplicateCheck()->insert(prefix($table, 'ignore:'), $data);
        }, $file);
        
        return true;
    }

    //--------------------------------------------------------------------------------------------------------
    // Insert
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  mixed $table
    // @param  mixed $datas
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    public function insert(String $table = NULL, Array $datas = [])
    {
        $this->_ignoreData($table, $datas);

        $datas = $this->_p($datas, 'column');
        $data  = NULL; $values = NULL;

        $duplicateCheckWhere = [];

        foreach( $datas as $key => $value )
        {
            if( $this->_exp($key) )
            {
                $key   = $this->_clearExp($key);
                $isExp = true;
            }

            $data .= suffix($key, ',');

            if( ! empty($this->duplicateCheck) )
            {
                if( $this->duplicateCheck[0] !== '*' )
                {
                    if( in_array($key, $this->duplicateCheck) )
                    {
                        $duplicateCheckWhere[] = [$key.' = ', $value, 'and'];
                    }
                }
                else
                {
                    $duplicateCheckWhere[] = [$key.' = ', $value, 'and'];
                }
            }

            $value = $this->nailEncode($value);

            if( isset($isExp) )
            {
                $values .= suffix($value, ',');
                unset($isExp);
            }
            elseif( $value !== '?' )
            {
                $values .= suffix(presuffix($value, "'"), ',');
            }
            else
            {
                $values .= suffix($value, ',');
            }
        }

        if( ! empty($duplicateCheckWhere) )
        {
            $duplicateCheckColumn = $this->duplicateCheck;

            if( $this->where($duplicateCheckWhere)->get($table)->totalRows() )
            {
                $this->duplicateCheck = NULL;

                if( $this->duplicateCheckUpdate === true )
                {
                    $this->duplicateCheckUpdate = NULL;

                    return $this->where($duplicateCheckWhere)->update($table, $datas);
                }

                return false;
            }
        }

        $insertQuery = 'INSERT '.
                        $this->lowPriority.
                        $this->delayed.
                        $this->highPriority.
                        $this->ignore.
                        ' INTO '.
                        $this->_p($table).
                        $this->partition.
                        $this->_values($data, $values);

        $this->_resetInsertQuery();

        return $this->_runQuery($insertQuery);
    }

    //--------------------------------------------------------------------------------------------------------
    // Updated
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  mixed $table
    // @param  mixed $set
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    public function update(String $table = NULL, Array $set = [])
    {
        $this->_ignoreData($table, $set);

        $set  = $this->_p($set, 'column');
        $data = NULL;

        foreach( $set as $key => $value )
        {
            $value = $this->nailEncode($value);

            if( $this->_exp($key) )
            {
                $key = $this->_clearExp($key);
            }
            else
            {
                $value = presuffix($value, "'");
            }

            $data .= $key . '=' . suffix($value, ',');
        }

        $set = ' SET '.substr($data,0,-1);

        $updateQuery = 'UPDATE '.
                        $this->lowPriority.
                        $this->ignore.
                        $this->_p($table).
                        $this->join.
                        $set.
                        $this->_where().
                        $this->_orderBy().
                        $this->limit;

        $this->_resetUpdateQuery();

        return $this->_runQuery($updateQuery);
    }

    //--------------------------------------------------------------------------------------------------------
    // Delete
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $table
    //
    //--------------------------------------------------------------------------------------------------------
    public function delete(String $table = NULL)
    {
        $deleteQuery = 'DELETE '.
                       $this->lowPriority.
                       $this->quick.
                       $this->ignore.
                       $this->_deleteJoinTables($table).
                       ' FROM '.
                       $this->_p($table).
                       $this->join.
                       $this->partition.
                       $this->_where().
                       $this->_orderBy().
                       $this->limit;

        $this->_resetDeleteQuery();

        return $this->_runQuery($deleteQuery);
    }

    //--------------------------------------------------------------------------------------------------------
    // Total Rows
    //--------------------------------------------------------------------------------------------------------
    //
    // @param bool $total
    //
    //--------------------------------------------------------------------------------------------------------
    public function totalRows(Bool $total = false) : Int
    {
        if( $total === true )
        {
            return $this->query($this->_cleanLimit($this->stringQuery()))->totalRows();
        }

        return $this->db->numRows();
    }

    //--------------------------------------------------------------------------------------------------------
    // Total Columns
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function totalColumns() : Int
    {
        return $this->db->numFields();
    }

    //--------------------------------------------------------------------------------------------------------
    // Columns
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function columns() : Array
    {
        return $this->db->columns();
    }

    //--------------------------------------------------------------------------------------------------------
    // Result
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type: object, 'json', 'array'
    //
    //--------------------------------------------------------------------------------------------------------
    public function result(String $type = 'object')
    {
        $this->_resultCache($type);

        if( empty((array) $this->results) )
        {
            $this->results = $this->db->result($type);
        }

        if( $type === 'json' )
        {
            return json_encode($this->results);
        }

        return $this->results;
    }

    //--------------------------------------------------------------------------------------------------------
    // Result Json
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function resultJson() : String
    {
        return $this->result('json');
    }

    //--------------------------------------------------------------------------------------------------------
    // Result Array
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function resultArray() : Array
    {
        return $this->result('array');
    }

    //--------------------------------------------------------------------------------------------------------
    // Fetch Array
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function fetchArray() : Array
    {
        return $this->db->fetchArray();
    }

    //--------------------------------------------------------------------------------------------------------
    // Fetch Assoc
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function fetchAssoc() : Array
    {
        return $this->db->fetchAssoc();
    }

    //--------------------------------------------------------------------------------------------------------
    // Fetch
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type: assoc, array, row
    //
    //--------------------------------------------------------------------------------------------------------
    public function fetch(String $type = 'assoc') : Array
    {
        if( $type === 'assoc' )
        {
            return $this->db->fetchAssoc();
        }
        elseif( $type === 'array')
        {
            return $this->db->fetchArray();
        }
        else
        {
            return $this->db->fetchRow();
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Fetch Row
    //--------------------------------------------------------------------------------------------------------
    //
    // @param boolean $printable
    //
    //--------------------------------------------------------------------------------------------------------
    public function fetchRow(Bool $printable = false)
    {
        $row = $this->db->fetchRow();

        if( $printable === false )
        {
            return $row;
        }
        else
        {
            return current($row);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Row
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $printable
    //
    //--------------------------------------------------------------------------------------------------------
    public function row($printable = 0)
    {
        $result = $this->resultArray();

        if( $printable < 0 )
        {
            return $result[count($result) + $printable] ?? false;
        }
        else
        {
            if( $printable === true )
            {
                return current($result[0] ?? []);
            }

            return isset($result[$printable]) ? (object) $result[$printable] : false;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Value
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function value()
    {
        return $this->row(true);
    }

    //--------------------------------------------------------------------------------------------------------
    // Affected Rows
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function affectedRows() : Int
    {
        return $this->db->affectedRows();
    }

    //--------------------------------------------------------------------------------------------------------
    // Column Data
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $column
    //
    //--------------------------------------------------------------------------------------------------------
    public function columnData(String $column = NULL)
    {
        return $this->db->columnData($column);
    }

    //--------------------------------------------------------------------------------------------------------
    // Table Name
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function tableName() : String
    {
        return $this->tableName;
    }

    //--------------------------------------------------------------------------------------------------------
    // Pagination
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $url
    // @param array  $settigs
    // @param bool   $output
    //
    //--------------------------------------------------------------------------------------------------------
    public function pagination(String $url = NULL, Array $settings = [], Bool $output = true)
    {
        $pagcon   = Config::get('ViewObjects', 'pagination');
        $getLimit = $this->_getLimitValues($this->stringQuery());
        $start    = $getLimit[3] ?? NULL;
        $limit    = $getLimit[1] ?? NULL;

        $settings['totalRows'] = $this->totalRows(true);
        $settings['limit']     = ! empty($limit) ? $limit : $pagcon['limit'];
        $settings['start']     = $start ?? $pagcon['start'];

        if( ! empty($url) )
        {
            $settings['url'] = $url;
        }

        $return = $output === true
                ? Pagination::create(NULL, $settings)
                : $settings;

        return $return;
    }

    //--------------------------------------------------------------------------------------------------------
    // Is Exists
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param string $column
    // @param string $value
    //
    //--------------------------------------------------------------------------------------------------------
    public function isExists(String $table, String $column, String $value) : Bool
    {
        return (bool) $this->where($column, $value)->get($table)->totalRows();
    }

    //--------------------------------------------------------------------------------------------------------
    // Simple Result
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param string $column
    // @param string $value
    //
    //--------------------------------------------------------------------------------------------------------
    public function simpleResult(String $table, String $column = NULL, String $value = NULL, $type = 'result')
    {
        if( $column !== NULL && $value !== NULL )
        {
            $this->where($column, $value);
        }

        return $this->get($table)->$type();
    }

    //--------------------------------------------------------------------------------------------------------
    // Simple Result Array
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param string $column
    // @param string $value
    //
    //--------------------------------------------------------------------------------------------------------
    public function simpleResultArray(String $table, String $column = NULL, String $value = NULL)
    {
        return $this->simpleResult($table, $column, $value, 'resultArray');
    }

    //--------------------------------------------------------------------------------------------------------
    // Simple Row
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param string $column
    // @param string $value
    //
    //--------------------------------------------------------------------------------------------------------
    public function simpleRow(String $table, String $column = NULL, String $value = NULL)
    {
        return $this->simpleResult($table, $column, $value, 'row');
    }

    //--------------------------------------------------------------------------------------------------------
    // Simple Total Rows
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    //
    //--------------------------------------------------------------------------------------------------------
    public function simpleTotalRows(String $table) : Int
    {
        return $this->simpleResult($table, NULL, NULL, 'totalRows');
    }

    //--------------------------------------------------------------------------------------------------------
    // Simple Total Columns
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    //
    //--------------------------------------------------------------------------------------------------------
    public function simpleTotalColumns(String $table) : Int
    {
        return $this->simpleResult($table, NULL, NULL, 'totalColumns');
    }

    //--------------------------------------------------------------------------------------------------------
    // Simple Columns
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    //
    //--------------------------------------------------------------------------------------------------------
    public function simpleColumns(String $table) : Array
    {
        return $this->simpleResult($table, NULL, NULL, 'columns');
    }

    //--------------------------------------------------------------------------------------------------------
    // Simple Column Data
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param string $column
    //
    //--------------------------------------------------------------------------------------------------------
    public function simpleColumnData(String $table, String $column = NULL) : \stdClass
    {
        return $this->get($table)->columnData($column);
    }

    //--------------------------------------------------------------------------------------------------------
    // Simple Update
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param array  $data
    // @param string $column
    // @param string $value
    //
    //--------------------------------------------------------------------------------------------------------
    public function simpleUpdate(String $table, Array $data, String $column, String $value)
    {
        return $this->where($column, $value)->update($table, $data);
    }

    //--------------------------------------------------------------------------------------------------------
    // Simple Delete
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param string $column
    // @param string $value
    //
    //--------------------------------------------------------------------------------------------------------
    public function simpleDelete(String $table, String $column, String $value)
    {
        return $this->where($column, $value)->delete($table);
    }

    //--------------------------------------------------------------------------------------------------------
    // Switch Case
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $switch
    // @param array  $conditions
    // @param bool   $return
    //
    //--------------------------------------------------------------------------------------------------------
    public function switchCase(String $switch, Array $conditions = [], Bool $return = false)
    {
        $case  = ' CASE '.$switch;

        $alias = NULL;

        if( isset($conditions['as']) )
        {
            $alias = ' as '.$conditions['as'].' ';

            unset($conditions['as']);
        }

        if( is_array($conditions) ) foreach( $conditions as $key => $val )
        {
            if( strtolower($key) === 'default' || strtolower($key) === 'else' )
            {
                $key = ' ELSE ';
            }
            else
            {
                $key = ' WHEN '.$key.' THEN ';
            }

            $case .= $key.$val;
        }

        $case .= ' END '.$alias;

        if( $return === true )
        {
            return $case;
        }
        else
        {
            $this->selectFunctions[] = $case;

            return $this;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Vartype
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type
    // @param int    $len
    // @param bool   $output
    //
    //--------------------------------------------------------------------------------------------------------
    public function vartype(String $type, Int $len = NULL, Bool $output = true) : String
    {
        return $this->db->variableTypes($type, $len, $output);
    }

    //--------------------------------------------------------------------------------------------------------
    // Property
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed  $type
    // @param string $col
    // @param bool   $output
    //
    //--------------------------------------------------------------------------------------------------------
    public function property($type, String $col = NULL, Bool $output = true) : String
    {
        if( is_array($type) )
        {
            $state = '';

            foreach( $type as $key => $val )
            {
                if( ! is_numeric($key) )
                {
                    $state .= $this->db->statements($key, $val);
                }
                else
                {
                    $state .= $this->db->statements($val);
                }
            }

            return $state;
        }
        else
        {
            return $this->db->statements($type, $col, $output);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Default Value
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $default
    // @param bool   $type
    //
    //--------------------------------------------------------------------------------------------------------
    public function defaultValue(String $default = NULL, Bool $type = false) : String
    {
        if( ! is_numeric($default) )
        {
            $default = presuffix($default, '"');
        }

        return $this->db->statements('default', $default, $type);
    }

    //--------------------------------------------------------------------------------------------------------
    // Like
    //--------------------------------------------------------------------------------------------------------
    //
    // @param variadic $args
    //
    //--------------------------------------------------------------------------------------------------------
    public function like(String $value, String $type = 'starting') : String
    {
        $operator = $this->db->operator(__FUNCTION__);

        if( $type === "inside" )
        {
            $value = $operator.$value.$operator;
        }

        // İle Başlayan
        if( $type === "starting" )
        {
            $value = $value.$operator;
        }

        // İle Biten
        if( $type === "ending" )
        {
            $value = $operator.$value;
        }

        return $value;
    }

    //--------------------------------------------------------------------------------------------------------
    // Between
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $value1
    // @param string $value2
    //
    //--------------------------------------------------------------------------------------------------------
    public function between(String $value1, String $value2) : String
    {
        return $this->_excapeStringAddNail($value1, true).' AND '.$this->_excapeStringAddNail($value2, true);
    }

    //--------------------------------------------------------------------------------------------------------
    // In
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string ...$value
    //
    //--------------------------------------------------------------------------------------------------------
    public function notIn(String ...$value) : String
    {
        return $this->_in('in', ...$value);
    }

    //--------------------------------------------------------------------------------------------------------
    // In
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string ...$value
    //
    //--------------------------------------------------------------------------------------------------------
    public function in(String ...$value) : String
    {
        return $this->_in(__FUNCTION__, ...$value);
    }

    //--------------------------------------------------------------------------------------------------------
    // In Table
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string ...$value
    //
    //--------------------------------------------------------------------------------------------------------
    public function inTable(String ...$value) : String
    {
        return $this->_in(__FUNCTION__, ...$value);
    }

    //--------------------------------------------------------------------------------------------------------
    // In Query
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string ...$value
    //
    //--------------------------------------------------------------------------------------------------------
    public function inQuery(String ...$value) : String
    {
        return $this->_in(__FUNCTION__, ...$value);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected In
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string ...$value
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _in($type = 'in', ...$value)
    {
        $query = '(';
        $type  = strtolower($type);

        foreach( $value as $val )
        {
            if( $type === 'in' )
            {
                $query .= $this->_excapeStringAddNail($val, true);
            }
            elseif( $type === 'intable' )
            {
                $query .= $this->getString($val);
            }
            else
            {
                $query .= $val;
            }

            $query .= ',';
        }

        return rtrim($query, ',') . ')';
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Select
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _select()
    {
        if( ! empty($this->selectFunctions) )
        {
            $selectFunctions = rtrim(implode(',', $this->selectFunctions), ',');

            if( empty($this->select) )
            {
                $this->select = $selectFunctions;
            }
            else
            {
                $this->select .= ',' . $selectFunctions;
            }
        }

        if( empty($this->select) )
        {
            $this->select = ' * ';
        }

        return $this->select;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Values
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  mixed $table
    // @param  mixed $set
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _values($data, $values)
    {
        return ' ('.rtrim($data, ',').') VALUES ('.rtrim($values, ',').')';
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Result Cache
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string &$table
    // @param array  $datas
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _resultCache($type)
    {
        if( ! empty($this->caching) )
        {
            $driver = $this->caching['driver'] ?? 'file';

            if( $cacheResult = Cache::driver($driver)->select($this->_cacheQuery()) )
            {
                $this->results = $cacheResult;
            }
            else
            {
                Cache::driver($driver)->insert($this->_cacheQuery(), $this->results = $this->db->result($type), (int) ($this->caching['time'] ?? 0));
            }
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Ignore Data
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string &$table
    // @param array  $datas
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _ignoreData(&$table, &$data)
    {
        $methods = ['ignore', 'post', 'get', 'request'];

        if( stristr($table, ':') )
        {
            $tableEx = explode(':', $table);
            $method  = $tableEx[0];
            $table   = $tableEx[1];

            if( in_array($method, $methods) )
            {
                if( $method !== 'ignore' )
                {
                    $data = Method::$method();
                }

                $columns = array_flip($this->_query('SELECT * FROM ' . $table)->columns());
                $data    = array_intersect_key($data, $columns);
            }
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected CSV
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _csv(&$data)
    {
        $csv       = Excel\CSVToArray::do($data);
        $csvColumn = $csv[0];

        array_shift($csv);

        $csvDatas  = $csv;
        $data      = array_map(function($d) use($csvColumn)
        {
            return array_combine($csvColumn, $d);
        }, $csvDatas);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Clean Limit
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _cleanLimit($data)
    {
        return preg_replace('/limit\s+[0-9]+(\s*\OFFSET\s*[0-9]+)*/xi', '', $data);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Get Limit Values
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _getLimitValues($data)
    {
        preg_match('/limit\s+([0-9]+)(\s*\OFFSET\s*([0-9]+))*/xi', $data, $match);

        return $match;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Delete Join Tables
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _deleteJoinTables($table)
    {
        if( $this->join )
        {
            $joinType = strtolower($this->joinType);

            if( $joinType === 'inner' )
            {
                $joinTables = $this->_p($table).', '.$this->joinTable;
            }
            elseif( $joinType === 'right' )
            {
                $joinTables = $this->joinTable;
            }
            else
            {
                $joinTables = $this->_p($table);
            }

            $this->joinType  = NULL;
            $this->joinTable = NULL;

            return presuffix($joinTables, ' ');
        }

        return NULL;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Where Key Control
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $column
    // @param string $value
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _whereKeyControl($column, $value)
    {
        $keys   = ['between', 'in'];
        $column = trim($column);

        if( in_array(strtolower(Strings\Split::divide($column, ' ', -1)), $keys) || $this->_exp($column) )
        {
            return $value;
        }

        return $this->_excapeStringAddNail($value);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Equal Control
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $column
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _equalControl($column)
    {
        $control = trim($column);

        if( strstr($column, '.') )
        {
            $control = str_replace('.', '', $control);
        }

        if( preg_match('/^\w+$/', $control) )
        {
            $column .= ' = ';
        }

        return $column;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Where Having
    //--------------------------------------------------------------------------------------------------------
     //
    // @param string $column
    // @param string $value
    // @param string $logical
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _whereHaving($column, $value, $logical)
    {
        if( $value !== '' )
        {
            $value  = $this->_whereKeyControl($column, $value);
        }

        $this->_convertType($column, $value);

        $column = $this->_equalControl($column);

        return ' '.$column.' '.$value.' '.$logical.' ';
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Where Having
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $column
    // @param string $value
    // @param string $logical
    // @param string $type 
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _wh($column, $value, $logical, $type = 'where')
    {   
        if( is_array($column) )
        {
            $columns = func_get_args();

            if( isset($columns[0][0]) && is_array($columns[0][0]) )
            {
                $columns = $columns[0];
            }

            foreach( $columns as $col )
            {
                if( is_array($col) )
                {
                    $c = $col[0] ?? '';
                    $v = $col[1] ?? '';
                    $l = $col[2] ?? 'and';

                    $this->$type .= $this->_whereHaving($c, $v, $l);
                }
            }
        }
        else
        {
            $this->$type .= $this->_whereHaving($column, $value, $logical ?: 'and');
        }

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Where Having Group
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $conditions
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _whereHavingGroup($conditions = [])
    {
        $con = [];

        if( isset($conditions[0][0]) && is_array($conditions[0][0]) )
        {
            $con         = Arrays\GetElement::last($conditions);
            $conditions  = $conditions[0];
        }

        $getLast = Arrays\GetElement::last($conditions);

        if( is_string($con) )
        {
            $conjunction = $con;
        }
        else
        {
            if( is_string($getLast) )
            {
                $conjunction = $getLast;
                array_pop($conditions);
            }
            else
            {
                $conjunction = 'and';
            }
        }

        $whereGroup = '';

        if( is_array($conditions) ) foreach( $conditions as $column )
        {
            $col     = $column[0] ?? '';
            $value   = $column[1] ?? '';
            $logical = $column[2] ?? 'and';

            $whereGroup .= $this->_whereHaving($col, $value, $logical);
        }

        return ' ( '.$this->_whereHavingConjuctionClean($whereGroup).' ) '.$conjunction.' ';
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Where Having Conjuction Control
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _whereHavingConjuctionControl($type)
    {
        if( ! empty($this->$type) )
        {
            $this->$type = $this->_whereHavingConjuctionClean($this->$type) ?: $this->$type;

            $return = ' '.\Autoloader::upper($type).' '.$this->$type;

            $this->$type = NULL;

            return $return;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Where Having Conjuction Clean
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _whereHavingConjuctionClean($str)
    {
        if( ! empty($str) )
        {
            $str = strtolower($orgstr = trim($str));

            switch( substr($str, -3) )
            {
                case 'and' :
                case 'xor' :
                case 'not' :
                return substr($orgstr, 0, -3);
            }

            switch( substr($str, -2) )
            {
                case 'or' :
                case '||' :
                case '&&' :
                return substr($orgstr, 0, -2);
            }

            switch( substr($str, -1) )
            {
                case '!' :
                return substr($orgstr, 0, -1);
            }
        }

        return $str;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Where
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _where()
    {
        return $this->_whereHavingConjuctionControl('where');
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Having
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _having()
    {
        return $this->_whereHavingConjuctionControl('having');
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Join
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param string $column
    // @param string $otherColumn
    // @param string $operator
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _join($tableAndColumn = '', $otherColumn = '', $operator = '=', $type = 'INNER')
    {
        $tableAndColumn = explode('.', $tableAndColumn);
        $db             = '';

        switch( count($tableAndColumn) )
        {
            case 2 :
                $table  = isset($tableAndColumn[0]) ? $this->prefix.$tableAndColumn[0] : '';
                $column = isset($tableAndColumn[1]) ? $tableAndColumn[1]               : '';
            break;

            case 3 :
                $db     = isset($tableAndColumn[0]) ? $tableAndColumn[0] . '.'         : '';
                $table  = isset($tableAndColumn[1]) ? $this->prefix.$tableAndColumn[1] : '';
                $column = isset($tableAndColumn[2]) ? $tableAndColumn[2]               : '';
            break;

            default:
                $table  = $tableAndColumn[0];
                $column = $otherColumn;
        }



        $condition = $db.$table.'.'.$column.' '.$operator.' '.$this->prefix.$otherColumn.' ';

        $this->join($table, $condition, $type);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Group By
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _groupBy()
    {
        if( ! empty($this->groupBy) )
        {
            return ' GROUP BY '.rtrim($this->groupBy, ', ');
        }

        return false;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Order By
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _orderBy()
    {
        if( ! empty($this->orderBy) )
        {
            return ' ORDER BY '.rtrim($this->orderBy, ', ');
        }

        return false;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Increment & Decrement
    //--------------------------------------------------------------------------------------------------------
    protected function _incdec($table, $columns, $incdec, $type)
    {
        $newColumns = [];

        $table   = $this->_p($table);
        $columns = $this->_p($columns, 'column');
        $incdec  = $type === 'increment' ? abs($incdec) : -abs($incdec);

        if( is_array($columns) ) foreach( $columns as $v )
        {
            $newColumns[$v] = "$v + $incdec";
        }
        else
        {
            $newColumns = [$columns => "$columns + $incdec"];
        }

        if( ! empty($this->where) )
        {
            $where = ' WHERE ';
        }
        else
        {
            $where = '';
        }

        $data = '';

        foreach( $newColumns as $key => $value )
        {
            $data .= $key.'='.$value.',';
        }

        $set = ' SET '.substr($data, 0, -1);

        $updateQuery = 'UPDATE '.$this->prefix.$table.$set.$where.$this->where;

        $this->where = NULL;

        return $this->db->query($updateQuery);
    }

    //--------------------------------------------------------------------------------------------------------
    // _Query
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $query
    // @param array  $secure
    //
    //--------------------------------------------------------------------------------------------------------
    public function _query(String $query, Array $secure = [], $data = NULL)
    {
        $this->stringQuery = $query;

        $this->caching = $data['caching'] ?? [];

        if( empty($this->caching) || ! Cache::select($this->_cacheQuery()) )
        {
            $this->secure = $this->secure ?: $secure;

            $this->db->query($this->_querySecurity($query), $secure);

            if( ! empty($this->transStart) )
            {
                $transError = $this->db->error();

                if( ! empty($transError) )
                {
                    $this->transError = $transError;
                }
            }
        }

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Cache Query
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _cacheQuery()
    {
        return md5(json_encode($this->config) . $this->stringQuery());
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Select Reset Query
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _resetSelectQuery()
    {
        $this->distinct        = NULL;
        $this->highPriority    = NULL;
        $this->straightJoin    = NULL;
        $this->smallResult     = NULL;
        $this->bigResult       = NULL;
        $this->bufferResult    = NULL;
        $this->cache           = NULL;
        $this->calcFoundRows   = NULL;
        $this->select          = NULL;
        $this->from            = NULL;
        $this->table           = NULL;
        $this->where           = NULL;
        $this->groupBy         = NULL;
        $this->having          = NULL;
        $this->orderBy         = NULL;
        $this->limit           = NULL;
        $this->join            = NULL;
        $this->selectFunctions = NULL;
        $this->table           = NULL;
        $this->procedure       = NULL;
        $this->outFile         = NULL;
        $this->characterSet    = NULL;
        $this->into            = NULL;
        $this->forUpdate       = NULL;
        $this->retunQueryType  = NULL;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Reset Insert Query
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _resetInsertQuery()
    {
        $this->column          = NULL;
        $this->table           = NULL;
        $this->highPriority    = NULL;
        $this->lowPriority     = NULL;
        $this->partition       = NULL;
        $this->ignore          = NULL;
        $this->delayed         = NULL;
        $this->duplicateCheck  = NULL;
        $this->duplicateCheckUpdate = NULL;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Reset Update Query
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _resetUpdateQuery()
    {
        $this->where           = NULL;
        $this->lowPriority     = NULL;
        $this->ignore          = NULL;
        $this->orderBy         = NULL;
        $this->limit           = NULL;
        $this->table           = NULL;
        $this->join            = NULL;
        $this->column          = NULL;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Reset Delete Query
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _resetDeleteQuery()
    {
        $this->where           = NULL;
        $this->lowPriority     = NULL;
        $this->quick           = NULL;
        $this->ignore          = NULL;
        $this->join            = NULL;
        $this->partition       = NULL;
        $this->orderBy         = NULL;
        $this->limit           = NULL;
        $this->table           = NULL;
    }
}
