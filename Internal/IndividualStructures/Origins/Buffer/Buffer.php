<?php namespace ZN\IndividualStructures;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Buffer extends \FactoryController
{
    const factory =
    [
        'methods' =>
        [
            'file'     => 'Buffer\File::do',
            'func'     => 'Buffer\Callback::do',
            'function' => 'Buffer\Callback::do',
            'callback' => 'Buffer\Callback::do',
            'closure'  => 'Buffer\Callback::do',
            'code'     => 'Buffer\Callback::code',
            'insert'   => 'Buffer\Insert::do',
            'select'   => 'Buffer\Select::do',
            'delete'   => 'Buffer\Delete::do'
        ]
    ];
}
