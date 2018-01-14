<?php namespace ZN\Language\Tests;
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

class Lang extends UnitTest
{
    const unit =
    [
        'class'   => 'Lang',
        'methods' => 
        [
            'current'   => [],
            'select'    => ['Database'],
            'select:2'  => ['Error', 'error'],
            'select:3'  => ['Error', 'classError', 'Example'],
            'set'       => ['en'],
            'get'       => []
        ]
    ];
}
