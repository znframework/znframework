<?php namespace ZN\DataTypes;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class SeparatorUnitTest extends \UnitTestController
{
    const unit =
    [
        'class'   => 'Separator',
        'methods' =>
        [
            'encode' => [['p1' => 'p2']],
            'decode' => ['p1']
        ]
    ];
}
