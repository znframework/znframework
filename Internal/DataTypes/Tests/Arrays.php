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

class Arrays extends UnitTest
{
    const unit =
    [
        'class'   => 'Arrays',
        'methods' =>
        [
            'casing'           => [['p1' => 'p2'], 'upper', 'all'],
            'lowerCase'        => [['p1' => 'p2']],
            'upperCase'        => [['p1' => 'p2']],
            'titleCase'        => [['p1' => 'p2']],
            'lowerKeys'        => [['p1' => 'p2']],
            'upperKeys'        => [['p1' => 'p2']],
            'titleKeys'        => [['p1' => 'p2']],
            'lowerValues'      => [['p1' => 'p2']],
            'upperValues'      => [['p1' => 'p2']],
            'titleValues'      => [['p1' => 'p2']],
            'getFirst'         => [['p1', 'p2'], 1, false],
            'getLast'          => [['p1', 'p2'], 1, false],
            'addFirst'         => [['p1'], 'p2'],
            'addLast'          => [['p1'], 'p2'],
            'removeKey'        => [['p1' => 'p2'], 'p1'],
            'removeValue'      => [['p1' => 'p2'], 'p2'],
            'remove'           => [['p1' => 'p2', 'p3'], 'p1', 'p3'],
            'removeLast'       => [['p1', 'p2']],
            'removeFirst'      => [['p1', 'p2']],
            'deleteElement'    => [['p1', 'p2'], 'p1'],
            //'order'          => [['p1', 'p2'], 'asc', 'regular'],
            'sort'             => [['p1', 'p2']],
            'descending'       => [['p1', 'p2']],
            'ascending'        => [['p1', 'p2']],
            'ascendingKey'     => [['p1', 'p2']],
            'descendingKey'    => [['p1', 'p2']],
            //'userAssocSort'  => [['p1', 'p2']],
            //'userKeySort'    => [['p1', 'p2']],
            //'userSort'       => [['p1', 'p2']],
            'insensitiveSort'  => [['p1', 'p2']],
            'naturalSort'      => [['p1', 'p2']],
            'shuffle'          => [['p1', 'p2']],
            'including'        => [['p1', 'p2'], ['p1']],
            'excluding'        => [['p1', 'p2'], ['p1']],
            //'each'           => [['p1', 'p2']],
            'multikey'         => [['p1|p2|p3' => 'p4']],
            'keyval'           => [['p1' => 'p2']],
            'key'              => [['p1' => 'p2']],
            'value'            => [['p1' => 'p2']],
            'keys'             => [['p1' => 'p2']],
            'values'           => [['p1' => 'p2']],
            'length'           => [['p1' => 'p2']],
            'apportion'        => [['p1' => 'p2'], 1],
            'combine'          => [['p1', 'p2'], ['p1', 'p2']],
            'countSameValues'  => [['p1' => 'p2']],
            'flip'             => [['p1' => 'p2']],
            //'map'            => [['p1' => 'p2']],
            'recursiveMerge'   => [['p1' => 'p2'], ['p1' => 'p2']],
            'merge'            => [['p1' => 'p2'], ['p1' => 'p2']],
            'intersect'        => [['p1' => 'p2'], ['p1' => 'p2']],
            'reverse'          => [['p1' => 'p2']],
            'product'          => [['p1' => 'p2']],
            'sum'              => [['p1' => 'p2']],
            'random'           => [['p1' => 'p2']],
            'search'           => [['p1' => 'p2'], 'p2'],
            'values'           => [['p1' => 'p2']],
            'valueExists'      => [['p1' => 'p2'], 'p2'],
            'keyExists'        => [['p1' => 'p2'], 'p1'],
            'section'          => [['p1' => 'p2'], 0],
            'resection'        => [['p1' => 'p2'], 0],
            'deleteRecurrent'  => [['p1' => 'p2']],
            'series'           => [1, 5, 1],
            'column'           => [['p1' => 'p2'], 1]
        ]
    ];
}
