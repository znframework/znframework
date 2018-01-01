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

class Separator extends \FactoryController
{
    const factory =
    [
        'methods' =>
        [
            'encode'       => 'Separator\Encode::do',
            'decode'       => 'Separator\Decode::do',
            'decodeobject' => 'Separator\Decode::object',
            'decodearray'  => 'Separator\Decode::array'
        ]
    ];
}
