<?php namespace ZN\IndividualStructures\Import;

use Config;
use ZN\DataTypes\Arrays;

class BootstrapExtends
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Protected Parameters
    //--------------------------------------------------------------------------------------------------------
    //
    // @params
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _parameters($arguments, $cdn)
    {
        if( ! empty(Properties::$parameters['usable']) )
        {
            $lastParam = Properties::$parameters['usable'];

            Properties::$parameters = [];
        }
        else
        {
            $argumentCount = count($arguments) - 1;
            $lastParam     = $arguments[$argumentCount] ?? false;
        }

        $arguments = array_unique($arguments);

        if( $lastParam === true )
        {
            array_pop($arguments);
        }

        return (object)
        [
            'arguments' => $arguments,
            'lastParam' => $lastParam,
            'cdnLinks'  => array_change_key_case(Config::get('CDNLinks', $cdn))
        ];
    }
}
