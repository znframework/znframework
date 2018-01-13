<?php namespace ZN\ViewObjects;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class DBGridUnitTest extends \UnitTestController
{
    const unit =
    [
        'class'   => 'DBGrid',
        'methods' => 
        [
            #'add'               => ['ADD'],
            #'processColumn'     => ['id'],
            #'limit'             => [5],
            #'inputs'            => [[]],
            #'outputs'           => [[]],
            #'columns'           => ['id', 'name'],
            #'joins'             => [[]],
            #'orderBy'           => ['id', 'desc'],
            #'groupBy'           => [],
            #'where'             => [],
            #'whereGroup'        => [],
            #'table'             => ['example'],
            #'hide'              => ['addButton'],
            #'exclude'           => ['name'],
            #'create'            => ['example']
        ]
    ];
}
