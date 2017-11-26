<?php namespace ZN\IndividualStructures;

use SerialableAbility;

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

    use SerialableAbility;
    
    const serialable = 
    [
        'class' => 'Security',
        'start' => 'data',
        'end'   => 'get'
    ];
}
