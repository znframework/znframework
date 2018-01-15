<?php namespace ZN\DataTypes\Tests;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Controller\UnitTest;

class Strings extends UnitTest
{
    const unit =
    [
        'class'   => 'Strings',
        'methods' =>
        [
            'mtrim'             => ['p1'],
            'trimSlashes'       => ['p1'],
            'casing'            => ['p1', 'upper'],
            'lowerCase'         => ['P1'],
            'upperCase'         => ['p1'],
            'titleCase'         => ['p1'],
            'pascalCase'        => ['p1 p2 p3'],
            'camelCase'         => ['p1 p2 p3'],
            'search'            => ['p1', '1'],
            'searchPosition'    => ['p1', '1'],
            'searchString'      => ['p1', '1'],
            'reshuffle'         => ['p1 p2 p3', 'p2', 'p3'],
            'placement'         => ['p1?p2?p3', '?', ['+', '-']],
            'replace'           => ['p1 p2 p3', 'p2', 'p4'],
            'replace:2'         => ['p1 p2 p3', ['p2'], ['p4']],
            'toArray'           => ['p1 p2 p3'],
            'addSlashes'        => ['p1"p2'],
            'removeSlashes'     => ['p1\"p2'],
            'section'           => ['p1 p2 p3'],
            'recurrentCount'    => ['p1 p1 p1 p2 p3', 'p1'],
            'length'            => ['p1 p2 p3'],
            'repeat'            => ['p1', 5],
            'pad'               => ['p1 p2 p3'],
            'apportion'         => ['p1 p2 p3', 2],
            'divide'            => ['p1|p2']
        ]
    ];
}
