<?php namespace ZN\Helpers;

class InternalSearcher extends \FactoryController
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    const factory =
    [
        'methods' =>
        [
            'filter'   => 'Searcher\Database::filter:this',
            'orfilter' => 'Searcher\Database::orFilter:this',
            'word'     => 'Searcher\Database::word:this',
            'type'     => 'Searcher\Database::type:this',
            'database' => 'Searcher\Database::do',
            'data'     => 'Searcher\Data::do',
        ]
    ];
}
