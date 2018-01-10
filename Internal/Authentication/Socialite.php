<?php namespace ZN\Authentication;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Config;
use ZN\Services\URL;
use ZN\Authentication\Exception\InvalidArgumentException;
use ZN\DataTypes\Arrays;

class Socialite
{
    /**
     * Magic Call
     * 
     * @param string $method
     * @param array  $parameters;
     * 
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        $social = '\Hybridauth\Provider\\' . $method;

        $parameters = $parameters[0] ?? NULL;

        if( ($param = Config::get('Authentication', 'socialite')[strtolower($method)] ?? NULL) && empty($parameters) )
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

        # Default Callback Value: Current URL
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
