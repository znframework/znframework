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

class ValidationUnitTest extends \UnitTestController
{
    const unit =
    [
        'class'   => 'Validation',
        'methods' => 
        [
            'rules'         => ['name', ['required'], 'Name'],
            'check'         => [NULL],
            'error'         => ['string'],
            'postBack'      => ['p1', 'post']
        ]
    ];
}
