<?php namespace ZN\DataTypes;

use SerialableAbility;

class InternalStack
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    use SerialableAbility;
    
    const serialable = 
    [
        'class' => 'Strings',
        'start' => 'data',
        'end'   => 'get'
    ];
}
