<?php namespace ZN\Validation\Tests;
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

class Validation extends UnitTest
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
