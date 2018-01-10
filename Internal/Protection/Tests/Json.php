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

class JsonUnitTest extends \UnitTestController
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
