<?php namespace ZN\ViewObjects;

class ValidatorUnitTest extends \UnitTestController
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
        'class'   => 'Validator',
        'methods' => 
        [
            'between'           => [4, 4, 8],
            'betweenBoth'       => [4, 4, 8],
            'phone'             => ['123', '***'],
            'numeric'           => [10],
            'alnum'             => ['abc123'],
            'alpha'             => ['abc'],
            'identity'          => ['12312312312'],
            'email'             => ['example@example.com'],
            'url'               => ['http://www.znframework.com'],
            'specialChar'       => ['½$'],
            'maxchar'           => ['data', 5],
            'minchar'           => ['data', 2]
        ]
    ];
}
