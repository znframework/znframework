<?php namespace ZN\IndividualStructures;

class InternalPermission extends \FactoryController
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
            'start'   => 'Permission\Process::start',
            'end'     => 'Permission\Process::end',
            'process' => 'Permission\Process::use',
            'page'    => 'Permission\Page::use'
        ]
    ];
}
