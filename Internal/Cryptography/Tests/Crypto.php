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

class Crypto extends \UnitTestController
{
    const unit =
    [
        'class'   => 'Crypto',
        'methods' =>
        [
            'encrypt' => ['string', []],
            'decrypt' => ['string', []],
            'keygen'  => [10]
        ]
    ];
}
