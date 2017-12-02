<?php namespace ZN\ViewObjects;

class PaginationUnitTest extends \UnitTestController
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
        'class'   => 'Pagination',
        'methods' => 
        [
            'url'               => ['home/main'],
            'start'             => [0],
            'limit'             => [10],
            'type'              => ['classic'],
            'totalRows'         => [150],
            'countLinks'        => [6],
            'linkNames'         => ['<', '>', '<<', '>>'],
            #'css'               => [['current' => 'color:red']],
            #'style'             => [['links' => ['id' => 'id']]],
            'getURI'            => [NULL],
            'settings'          => [[]],
            'create'            => [NULL, []]
        ]
    ];
}
