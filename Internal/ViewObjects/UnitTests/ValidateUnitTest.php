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

class ValidateUnitTest extends \UnitTestController
{
    const unit =
    [
        'class'   => 'Validate',
        'methods' => 
        [
            'data'          => ['Example Data'],
            'numeric'       => [],
            'maxchar'       => [10],
            'minchar'       => [4],
            'get'           => [],
            'status'        => []
        ]
    ];
}
