<?php namespace ZN\Buffering\Tests;
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

class Buffer extends UnitTest
{
    const unit =
    [
        'class'   => 'Buffer',
        'methods' => 
        [
            'file'     => ['example.txt'],
            'closure'  => ['strtolower', ['example']],
            'code'     => ['echo 1;'],
            'insert'   => ['key', 'value'],
            'select'   => ['key'],
            'delete'   => ['key']
        ]
    ];
}
