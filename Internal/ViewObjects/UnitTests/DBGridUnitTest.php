<?php namespace ZN\ViewObjects;

class DBGridUnitTest extends \UnitTestController
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    const unit =
    [
        'class'   => 'DBGrid',
        'methods' => 
        [
            'add'               => ['ADD'],
            'processColumn'     => ['id'],
            'limit'             => [5],
            #'inputs'            => [[]],
            #'outputs'           => [[]],
            'columns'           => ['id', 'name'],
            #'joins'             => [[]],
            #'orderBy'           => ['id', 'desc'],
            #'groupBy'           => [],
            #'where'             => [],
            #'whereGroup'        => [],
            #'table'             => ['example'],
            #'hide'              => ['addButton'],
            #'exclude'           => ['name'],
            'create'            => ['example']
        ]
    ];
}
