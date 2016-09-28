<?php namespace ZN\Helpers;

class InternalLimiter extends \FactoryController implements InternalLimiterInterface
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
            'word' => 'Limiter\Word::do',
            'char' => 'Limiter\Char::do'
        ]
    ];
}
