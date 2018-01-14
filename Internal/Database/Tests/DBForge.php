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

class DBForge extends UnitTest
{
    const unit =
    [
        'class'   => 'DBForge',
        'methods' =>
        [
            'extras'           => ['p1'],
            'extras:2'         => [['p1', 'p2']],
            'createDatabase'   => ['p1', 'p2'],
            'dropDatabase'     => ['p1'],
            'createTable'      => ['p1', [], 'p2'],
            'dropTable'        => ['p1'],
            //'alterTable'     => ['p1', ['p1']],
            'renameTable'      => ['p1', 'p2'],
            'truncate'         => ['p1'],
            'addColumn'        => ['p1', ['p1']],
            'dropColumn'       => ['p1', ['p1']],
            'modifyColumn'     => ['p1', ['p1']],
            'renameColumn'     => ['p1', ['p1']]
        ]
    ];
}
