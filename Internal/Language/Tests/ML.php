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

class ML extends UnitTest
{
    const unit =
    [
        'class'   => 'ML',
        'methods' => 
        [
            'select'       => ['example'],
            'selectall'    => [],
            'insert'       => ['en', 'example2', 'Example Value2'],
            'update'       => ['en', 'example2', 'Example Value'],
            'delete'       => ['en', 'example2'],
            'deleteall'    => [],
            'grid'         => []
        ]
    ];
}
