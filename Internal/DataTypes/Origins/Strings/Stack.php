<?php namespace ZN\DataTypes;

use SerializationAbility;

class Stack
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    use SerializationAbility;
    
    const serialization = 
    [
        'class' => 'Strings',
        'start' => 'data',
        'end'   => 'get'
    ];
}
