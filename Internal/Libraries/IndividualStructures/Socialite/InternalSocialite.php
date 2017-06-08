<?php namespace ZN\IndividualStructures;

use CLController;

class InternalSocialite extends CLController implements InternalSocialiteInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    const config = 'IndividualStructures:socialite';

    //--------------------------------------------------------------------------------------------------------
    // Magic Call
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $method
    // @param array  $parameters
    //
    //--------------------------------------------------------------------------------------------------------
    public function __call($method, $parameters)
    {
        $social = '\Hybridauth\Provider\\' . $method;

        if( ($param = INDIVIDUALSTRUCTURES_SOCIALITE_CONFIG[strtolower($method)] ?? NULL) && empty($parameters) )
        {
            $parameters = $param;
        }

        return new $social($parameters);
    }
}
