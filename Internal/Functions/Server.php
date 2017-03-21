<?php
//--------------------------------------------------------------------------------------------------
// Server
//--------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// ipv4()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function ipv4() : String
{
    if( isset($_SERVER['HTTP_CLIENT_IP']) )
    {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    elseif( isset($_SERVER['HTTP_X_FORWARDED_FOR']) )
    {
        $ip = divide($_SERVER['HTTP_X_FORWARDED_FOR'], ',');
    }
    else
    {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    if( $ip === '::1')
    {
        $ip = '127.0.0.1';
    }

    return $ip;
}

//--------------------------------------------------------------------------------------------------
// server()
//--------------------------------------------------------------------------------------------------
//
// @param string $type = ''
//
// @return mixed
//
//--------------------------------------------------------------------------------------------------
function server(String $type = NULL)
{
    $server =
    [
        NULL                         => $_SERVER,
        'name'                       => $_SERVER['SERVER_NAME']           ?? false,
        'admin'                      => $_SERVER['SERVER_ADMIN']          ?? false,
        'protocol'                   => $_SERVER['SERVER_PROTOCOL']       ?? false,
        'signature'                  => $_SERVER['SERVER_SIGNATURE']      ?? false,
        'software'                   => $_SERVER['SERVER_SOFTWARE']       ?? false,
        'remoteAddr'                 => $_SERVER['REMOTE_ADDR']           ?? false,
        'remotePort'                 => $_SERVER['REMOTE_PORT']           ?? false,
        'requestMethod'              => $_SERVER['REQUEST_METHOD']        ?? false,
        'requestUri'                 => $_SERVER['REQUEST_URI']           ?? false,
        'requestScheme'              => $_SERVER['REQUEST_SCHEME']        ?? false,
        'requestTime'                => $_SERVER['REQUEST_TIME']          ?? false,
        'requestTimeFloat'           => $_SERVER['REQUEST_TIME_FLOAT']    ?? false,
        'accept'                     => $_SERVER['HTTP_ACCEPT']           ?? false,
        'acceptCharset'              => $_SERVER['HTTP_ACCEPT_CHARSET']   ?? false,
        'acceptEncoding'             => $_SERVER['HTTP_ACCEPT_ENCODING']  ?? false,
        'acceptLanguage'             => $_SERVER['HTTP_ACCEPT_LANGUAGE']  ?? false,
        'clientIp'                   => $_SERVER['HTTP_CLIENT_IP']        ?? false,
        'xForwardedHost'             => $_SERVER['HTTP_X_FORWARDED_HOST'] ?? false,
        'xForwardedFor'              => $_SERVER['HTTP_X_FORWARDED_FOR']  ?? false,
        'xOriginalUrl'               => $_SERVER['HTTP_X_ORIGINAL_URL']   ?? false,
        'xRequestedWith'             => $_SERVER['HTTP_X_REQUESTED_WITH'] ?? false,
        'connection'                 => $_SERVER['HTTP_CONNECTION']       ?? false,
        'host'                       => $_SERVER['HTTP_HOST']             ?? false,
        'referer'                    => $_SERVER['HTTP_REFERER']          ?? false,
        'userAgent'                  => $_SERVER['HTTP_USER_AGENT']       ?? false,
        'cookie'                     => $_SERVER['HTTP_COOKIE']           ?? false,
        'cacheControl'               => $_SERVER['HTTP_CACHE_CONTROL']    ?? false,
        'https'                      => $_SERVER['HTTPS']                 ?? false,
        'scriptFileName'             => $_SERVER['SCRIPT_FILENAME']       ?? false,
        'scriptName'                 => $_SERVER['SCRIPT_NAME']           ?? false,
        'path'                       => $_SERVER['PATH']                  ?? false,
        'pathInfo'                   => $_SERVER['PATH_INFO']             ?? false,
        'currentPath'                => $_SERVER['PATH_INFO']             ?? $_SERVER['QUERY_STRING'] ?? false,
        'pathTranslated'             => $_SERVER['PATH_TRANSLATED']       ?? false,
        'pathext'                    => $_SERVER['PATHEXT']               ?? false,
        'redirectQueryString'        => $_SERVER['REDIRECT_QUERY_STRING'] ?? false,
        'redirectUrl'                => $_SERVER['REDIRECT_URL']          ?? false,
        'redirectStatus'             => $_SERVER['REDIRECT_STATUS']       ?? false,
        'phpSelf'                    => $_SERVER['PHP_SELF']              ?? false,
        'queryString'                => $_SERVER['QUERY_STRING']          ?? false,
        'documentRoot'               => $_SERVER['DOCUMENT_ROOT']         ?? false,
        'windir'                     => $_SERVER['WINDIR']                ?? false,
        'comspec'                    => $_SERVER['COMSPEC']               ?? false,
        'systemRoot'                 => $_SERVER['SystemRoot']            ?? false,
        'gatewayInterface'           => $_SERVER['GATEWAY_INTERFACE']     ?? false
    ];

    if( isset($server[$type]) )
    {
        if( is_array($server[$type]) )
        {
            return $server[$type];
        }
        else
        {
            return htmlspecialchars($server[$type], ENT_QUOTES, "utf-8");
        }
    }
    elseif( isset($_SERVER[$type]) )
    {
        return htmlspecialchars($_SERVER[$type], ENT_QUOTES, "utf-8");
    }

    return false;
}
