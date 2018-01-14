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

class Migration extends UnitTest
{
    const unit =
    [
        'class'   => 'Migration',
        'methods' =>
        [
            'createTable'       => [['p1' => 'p2']],
            'dropTable'         => [],
            'addColumn'         => [[]],
            'dropColumn'        => ['p1'],
            'modifyColumn'      => [[]],
            'truncate'          => [],
            'path'              => ['p1'],
            //'create'          => ['p1', 0],
            //'delete'          => ['p1', 0],
            'truncate'          => [],
            //'deleteAll'       => [],
            'version'           => [0]
        ]
    ];
}
