<?php namespace Project\Controllers;

//------------------------------------------------------------------------------------------------------------
// SYSTEM
//------------------------------------------------------------------------------------------------------------
//
// Author   : ZN Framework
// Site     : www.znframework.com
// License  : The MIT License
// Copyright: Copyright (c) 2012-2016, znframework.com
//
//------------------------------------------------------------------------------------------------------------

use Method, Restful, Json;

class Api extends Controller
{
    public function main()
    {
        if( Method::post('request') )
        {
            $type = Method::post('type');

            if( $data = Method::post('data') )
            {
                $explode = explode(',', $data);
                $newData = [];

                foreach( $explode as $value )
                {
                    $valueEx = explode(':', trim(str_replace(EOL, NULL, $value)));

                    if( isset($valueEx[1]) )
                    {
                        $newData[$valueEx[0]] = $valueEx[1];
                    }
                }

                Restful::data($newData);
            }

            if( $ssl = Method::post('sslVerifyPeer') )
            {
                Restful::sslVerifyPeer((bool) $ssl);
            }

            Masterpage::pdata(['results' => Restful::$type(Method::post('url'))]);


            $infos = Restful::info('all');

            Masterpage::pdata(['infos' => ! empty($infos) ? $infos : Restful::info()]);
        }

        Masterpage::page('rest-api');
    }
}
