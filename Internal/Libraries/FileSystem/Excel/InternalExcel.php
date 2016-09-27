<?php namespace ZN\FileSystem;

class InternalExcel extends \FactoryController implements InternalExcelInterface
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
