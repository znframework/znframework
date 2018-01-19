<?php namespace ZN\Email\Tests;
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

class Email extends UnitTest
{
    const unit =
    [
        'class'   => 'Email',
        'methods' => 
        [
            'from'    => ['example@example.com'],
            'to'      => ['example@example.com'],
            'subject' => ['Example Subject'],
            'message' => ['Example Message'],
            'send'    => []
        ]
    ];
}
