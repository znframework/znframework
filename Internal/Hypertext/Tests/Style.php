<?php namespace ZN\Hypertext\Tests;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Controllers\UnitTestController;

class Style extends UnitTestController
{
    const unit =
    [
        'class'   => 'Style',
        'methods' => 
        [
            'type'              => ['text/plain'],
            'library'           => ['jquery', 'angular'],
            'open'              => [],
            'close'             => [] 
        ]
    ];
}
