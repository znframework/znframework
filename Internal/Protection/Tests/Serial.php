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

class Serial extends UnitTest
{
    const unit =
    [
        'class'   => 'Serial',
        'methods' =>
        [
            'encode' => [['p1' => 'p2']],
            'decode' => ['a:1:{s:2:"p1";s:2:"p2";}']
        ]
    ];
}
