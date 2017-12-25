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

class MLGridUnitTest extends \UnitTestController
{
    const unit =
    [
        'class'   => 'MLGrid',
        'methods' => 
        [
            'url'           => ['home/main'],
            'limit'         => [10],
            'create'        => [NULL]
        ]
    ];
}
