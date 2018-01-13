<?php namespace ZN\Buffering;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Process extends \FactoryController
{
    const factory =
    [
        'methods' =>
        [
            'file'     => 'File::do',
            'func'     => 'Callback::do',
            'function' => 'Callback::do',
            'callback' => 'Callback::do',
            'closure'  => 'Callback::do',
            'code'     => 'Callback::code',
            'insert'   => 'Insert::do',
            'select'   => 'Select::do',
            'delete'   => 'Delete::do'
        ]
    ];
}
