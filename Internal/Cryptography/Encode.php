<?php namespace ZN\Cryptography;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Controller\Factory;

class Encode extends Factory
{
    const factory =
    [
        'methods' =>
        [
            'create' => 'Encode\RandomPassword::create',
            'golden' => 'Encode\GoldenAlgorithm::create',
            'super'  => 'Encode\SuperAlgorithm::create',
            'type'   => 'Encode\Type::create',
            'data'   => 'Encode\Type::create'
        ]
    ];
}
