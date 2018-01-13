<?php namespace ZN\ViewObjects;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class SheetUnitTest extends \UnitTestController
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
