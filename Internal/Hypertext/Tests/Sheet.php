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

use ZN\Controller\UnitTest;

class Sheet extends UnitTest
{
    const unit =
    [
        'class'   => 'Sheet',
        'methods' => 
        [
            'selector'          => ['#color'],
            'attr'              => [['color' => 'red']],
            #'complete'         => [],
            'create'            => []
        ]
    ];
}
