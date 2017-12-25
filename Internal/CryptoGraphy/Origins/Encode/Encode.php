<?php namespace ZN\CryptoGraphy;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Encode extends \FactoryController
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
