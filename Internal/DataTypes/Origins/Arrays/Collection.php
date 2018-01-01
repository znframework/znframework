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

use SerializationAbility;

class Collection
{
    use SerializationAbility;

    const serialization = 
    [
        'class' => 'Arrays',
        'start' => 'data',
        'end'   => 'get'
    ];
}