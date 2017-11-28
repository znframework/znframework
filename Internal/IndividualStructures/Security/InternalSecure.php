<?php namespace ZN\IndividualStructures;

use SerializationAbility;

class InternalSecure implements InternalSecureInterface
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
        'class' => 'Security',
        'start' => 'data',
        'end'   => 'get'
    ];
}
