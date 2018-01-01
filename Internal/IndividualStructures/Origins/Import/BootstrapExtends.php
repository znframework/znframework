<?php namespace ZN\IndividualStructures\Import;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\DataTypes\Arrays;

class BootstrapExtends
{
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
            'cdnLinks'  => array_change_key_case(\Config::get('CDNLinks', $cdn))
        ];
    }
}
