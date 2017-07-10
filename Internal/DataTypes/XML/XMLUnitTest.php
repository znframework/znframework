<?php namespace ZN\DataTypes;

class XMLUnitTest extends \UnitTestController
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
        'class'   => 'XML',
        'methods' =>
        [
            'version'  => [],
            'encoding' => [],
            'build'    => [['name' => 'media', 'attr' => ['id' => 1]]],
            'save'     => ['p1', 'p2'],
            'load'     => ['p1'],
            'parse'    => ['<media id="1"></media>']
        ]
    ];
}
