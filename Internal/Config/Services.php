<?php return
[
    //--------------------------------------------------------------------------------------------------
    // Services
    //--------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : Copyright (c) 2012-2016, ZN Framework
    //
    //--------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------
    // Http
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Http mesaj listesi yer alır.
    //
    //--------------------------------------------------------------------------------------------------
    'http' =>
    [
        'messages' =>
        [
            //1XX Information
            '100|continue'              => '100 Continue',
            '101|switchProtocols'       => '101 Switching Protocols',
            '103|checkpoint'            => '103 Checkpoint',

            //2XX Successful
            '200|ok'                    => '200 OK',
            '201|created'               => '201 Created',
            '202|accepted'              => '202 Accepted',
            '203|nonAuthInfo'           => '203 Non-Authoritative Information',
            '204|noContent'             => '204 No Content',
            '205|resetContent'          => '205 Reset Content',
            '206|partialContent'        => '206 Partial Content',

            // 3XX Redirection
            '300|multipleChoices'       => '300 Multiple Choices',
            '301|movedPermanent'        => '301 Moved Permanently',
            '302|found'                 => '301 Found',
            '303|seeOther'              => '303 See Other',
            '304|notModified'           => '304 Not Modified',
            '306|switchProxy'           => '306 Switch Proxy',
            '307|temporaryRedirect'     => '307 Temporary Redirect',
            '308|resumeIncomplete'      => '308 Resume Incomplete',

            // 4XX Client Error
            '400|badRequest'            => '400 Bad Request',
            '401|unauth'                => '401 Unauthorized',
            '402|paymentRequired'       => '402 Payment Required',
            '403|forbidden'             => '403 Forbidden',
            '404|notFound'              => '404 Not Found',
            '405|methodNotAllowed'      => '405 Method Not Allowed',
            '406|notAccept'             => '406 Not Acceptable',
            '407|proxyAuth'             => '407 Proxy Authentication Required',
            '408|requestTimeout'        => '408 Request Timeout',
            '409|conflict'              => '409 Conflict',
            '410|gone'                  => '410 Gone',
            '411|lengthRequired'        => '411 Length Required',
            '412|preconditionFailed'    => '412 Precondition Failed',
            '413|requestEntity'         => '413 Request Entity Too Large',
            '414|requestUri'            => '414 Request-URI Too Long',
            '415|unsupportedMedia'      => '415 Unsupported Media Type',
            '416|requestedRange'        => '416 Requested Range Not Satisfiable',
            '417|expectFailed'          => '417 Expectation Failed',

            // 5XX Server Error
            '500|internalServerError'   => '500 Internal Server Error',
            '501|notImplement'          => '501 Not Implemented',
            '502|badGateway'            => '502 Bad Gateway',
            '503|serviceUnavailable'    => '503 Service Unavailable',
            '504|gatewayTimeout'        => '504 Gateway Timeout',
            '505|versionNotSupported'   => '505 HTTP Version Not Supported',
            '511|authRequired'          => '511 Network Authentication Required'
        ]
    ]
];
