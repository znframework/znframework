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

class DBTool extends \UnitTestController
{
    const unit =
    [
        'class'   => 'DBTool',
        'methods' =>
        [
            'listDatabases'    => [],
            'listTables'       => [],
            #'statusTables'     => ['*'],
            #'optimizeTables'   => ['*'],
            #'repairTables'     => ['*'],
            #'backup'           => []
        ]
    ];
}
