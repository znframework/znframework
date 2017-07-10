<?php namespace ZN\Database\DB\Traits;

trait VariableTypesTrait
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
        'int'       ,
        'smallint'  ,
        'tinyint'   ,
        'mediumint' ,
        'bigint'    ,
        'decimal'   ,
        'double'    ,
        'float'     ,
        'char'      ,
        'varchar'   ,
        'tinytext'  ,
        'text'      ,
        'mediumtext',
        'longtext'  ,
        'date'      ,
        'time'      ,
        'timestamp' ,
        'datetime'  ,
        'integer' => 'int'
    ];

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
}
