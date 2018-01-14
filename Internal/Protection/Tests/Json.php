<?php namespace ZN\Protection\Tests;
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

class Json extends UnitTest
{
    const unit =
    [
        'class'   => 'Json',
        'methods' =>
        [
            'encode' => [['p1' => 'p2']],
            'decode' => ['{"p1":"p1"}'],
            'error'  => [],
            'errno'  => []
        ]
    ];
}
