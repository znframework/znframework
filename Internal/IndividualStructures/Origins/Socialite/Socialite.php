<?php namespace ZN\IndividualStructures;

use ZN\Services\URL;
use ZN\IndividualStructures\Exception\InvalidArgumentException;
use ZN\DataTypes\Arrays;

class Socialite extends \CLController
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

        $parameters = $parameters[0] ?? NULL;

        if( ($param = INDIVIDUALSTRUCTURES_SOCIALITE_CONFIG[strtolower($method)] ?? NULL) && empty($parameters) )
        {
            $parameters = $param;
        }

        if( is_null($parameters) )
        {
            throw new InvalidArgumentException('Socialite::' . $method . '(Array $config) : 1. parameter can not be empty!');
        }

        $parameters['keys'] =
        [
            'id'     => $parameters['id'],
            'secret' => $parameters['secret']
        ];

        $parameters = Arrays\RemoveElement::key($parameters, ['id', 'secret']);

        // Default Callback Value: Current URL
        if( ! isset($parameters['callback']) )
        {
            $parameters['callback'] = rtrim(URL::current(), '/');
        }
        else
        {
            $parameters['callback'] = IS::url($parameters['callback'])
                                    ? $parameters['callback']
                                    : URL::site($parameters['callback']);
        }

        return new $social($parameters);
    }
}
