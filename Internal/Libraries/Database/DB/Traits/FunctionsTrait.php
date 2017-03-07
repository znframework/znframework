<?php namespace ZN\Database\DB\Traits;

trait FunctionsTrait
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
    // Between
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $value1
    // @param string $value2
    //
    //--------------------------------------------------------------------------------------------------------
    public function between(String $value1, String $value2)
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
    public function notIn(String ...$value)
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
    public function in(String ...$value)
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
    public function inTable(String ...$value)
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
    public function inQuery(String ...$value)
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
}
