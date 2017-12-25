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

class CalendarUnitTest extends \UnitTestController
{
    const unit =
    [
        'class'   => 'Calendar',
        'methods' => 
        [
            'url'           => ['p1'],
            'nameType'      => ['p1', 'p2'],
            'css'           => [['p1']],
            'style'         => [['p1']],
            'type'          => ['p1'],
            'linkNames'     => ['p1', 'p2'],
            'settings'      => [['p1']],
            'create'        => [NULL, NULL]
        ]
    ];
}
