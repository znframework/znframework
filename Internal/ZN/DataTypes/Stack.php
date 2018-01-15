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

use ZN\Ability\Serialization;

class Stack
{
    use Serialization;
    
    const serialization = 
    [
        'class' => 'Strings',
        'start' => 'data',
        'end'   => 'get'
    ];
}
