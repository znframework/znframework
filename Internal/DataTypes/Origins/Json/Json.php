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

class Json extends \FactoryController
{
    const factory =
    [
        'methods' =>
        [
            'encode'       => 'Json\Encode::do',
            'decode'       => 'Json\Decode::do',
            'decodeobject' => 'Json\Decode::object',
            'decodearray'  => 'Json\Decode::array',
            'error'        => 'Json\ErrorInfo::message',
            'errval'       => 'Json\ErrorInfo::message',
            'errno'        => 'Json\ErrorInfo::no',
            'check'        => 'Json\ErrorInfo::check'
        ]
    ];
}
