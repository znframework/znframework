<?php namespace ZN\Database;

class DBTriggerUnitTest extends \UnitTestController
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
        'class'   => 'DBTrigger',
        'methods' =>
        [
            'user'          => ['p1'],
            'when'          => ['p1'],
            'event'         => ['p1'],
            'order'         => ['p1', 'p2'],
            'body'          => ['p1', 'p2', 'pn'],
            'createTrigger' => ['p1'],
            'dropTrigger'   => ['p1']
        ]
    ];
}
