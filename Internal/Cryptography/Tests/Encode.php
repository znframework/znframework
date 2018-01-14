<?php namespace ZN\Cryptography\Tests;
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

class Encode extends UnitTest
{
    const unit =
    [
        'class'   => 'Encode',
        'methods' =>
        [
            'create' => [6, 'all'],
            'golden' => ['string', 'default'],
            'super'  => ['string'],
            'type'   => ['string', 'md5'],
            'data'   => ['string', 'md5']
        ]
    ];
}
