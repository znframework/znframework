<?php namespace ZN\Database\Tests;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Controller\UnitTest;

class DB extends UnitTest
{
    const unit =
    [
        'class'   => 'DB',
        'methods' =>
        [
            'select'           => ['p1', 'p2', 'pn'],
            'where'            => ['p1', 'p2', 'p3'],
            'where:2'          => [[['p1', 'p2', 'p3'], ['p1', 'p2', 'p3']]],
            'having'           => ['p1', 'p2', 'p3'],
            'having:2'         => [[['p1', 'p2', 'p3'], ['p1', 'p2', 'p3']]],
            'whereGroup'       => [['p1', 'p2', 'p3'], ['p1', 'p2', 'p3']],
            'whereGroup:2'     => [[['p1', 'p2', 'p3'], ['p1', 'p2', 'p3']]],
            'havingGroup'      => [['p1', 'p2', 'p3'], ['p1', 'p2', 'p3']],
            'havingGroup:2'    => [[['p1', 'p2', 'p3'], ['p1', 'p2', 'p3']]],
            'join'             => ['p1', 'p2', 'p3'],
            'innerJoin'        => ['p1', 'p2', '='],
            'groupBy'          => ['p2'],
            'orderBy'          => ['p1', 'p2'],
            'orderBy:2'        => [['p1', 'p2']],
            'limit'            => [1, 0],
            'get'              => ['p1', 'object'],
            'duplicateCheck'   => ['p1', 'p2'],
            'realEscapeString' => ['p1'],
            'getString'        => ['p1'],
            'alias'            => ['p1', 'p2', false],
            'brackets'         => ['p1'],
            'all'              => [],
            'distinct'         => [],
            'maxStatementTime' => ['p1'],
            'distinctRow'      => [],
            'straightJoin'     => [],
            'highPriority'     => [],
            'lowPriority'      => [],
            'quick'            => [],
            'delayed'          => [],
            'ignore'           => [],
            'partition'        => ['p1', 'p2', 'pn'],
            'procedure'        => ['p1', 'p2', 'pn'],
            'outFile'          => ['p1'],
            'dumpFile'         => ['p1'],
            'characterSet'     => ['p1', false],
            'cset'             => ['p1'],
            'collate'          => ['p1'],
            'encoding'         => ['utf8', 'utf8_general_ci'],
            'into'             => ['p1', 'p2'],
            'forUpdate'        => [],
            'lockInShareMode'  => [],
            'smallResult'      => [],
            'bigResult'        => [],
            'bufferResult'     => [],
            'cache'            => [],
            'noCache'          => [],
            'calcFoundRows'    => [],
            'query'            => ['p1', []],
            'execQuery'        => ['p1', []],
            'multiQuery'       => ['p1', []],
            'transStart'       => [],
            'transEnd'         => [],
            'insertID'         => [],
            'status'           => ['p1'],
            'increment'        => ['p1', [], 1],
            'decrement'        => ['p1', [], 1],
            'insert'           => ['p1', []],
            #'update'           => ['p1', []],
            #'delete'           => ['p1'],
            'totalRows'        => [false],
            'totalColumns'     => [],
            'columns'          => [],
            'result'           => ['object'],
            'resultJson'       => [],
            'resultArray'      => [],
            //'fetchArray'     => [],
            //'fetchAssoc'     => [],
            //'fetch'          => ['assoc'],
            //'fetchRow'       => [false],
            'row'              => [false],
            'row:2'            => [-1],
            'row:3'            => [1],
            'row:4'            => [true],
            'value'            => [],
            'affectedRows'     => [],
            'columnData'       => ['p1'],
            'tableName'        => [],
            'pagination'       => ['p1', [], true]
        ]
    ];
}
