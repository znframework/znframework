<?php namespace ZN\Database;

class MigrationUnitTest extends \UnitTestController
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
