<?php namespace ZN\DataTypes;

use SerializationAbility;

class Collection
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
        'class' => 'Arrays',
        'start' => 'data',
        'end'   => 'get'
    ];
}