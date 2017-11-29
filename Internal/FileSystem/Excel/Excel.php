<?php namespace ZN\FileSystem;

class Excel extends \FactoryController
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
            'arraytoxls' => 'Excel\ArrayToXLS::do',
            'csvtoarray' => 'Excel\CSVToArray::do',
        ]
    ];
}
