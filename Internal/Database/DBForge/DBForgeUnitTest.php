<?php namespace ZN\Database;

class DBForgeUnitTest extends \UnitTestController
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
