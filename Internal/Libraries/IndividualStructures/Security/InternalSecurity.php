<?php namespace ZN\IndividualStructures;

class InternalSecurity extends \FactoryController implements InternalSecurityInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    const factory =
    [
        'methods' =>
        [
            'ncencode'           => 'Security\NastyCode::encode',
            'injectionencode'    => 'Security\Injection::encode',
            'injectiondecode'    => 'Security\Injection::decode',
            'nailencode'         => 'Security\Injection::nailEncode',
            'naildecode'         => 'Security\Injection::nailDecode',
            'escapestringencode' => 'Security\Injection::escapeStringEncode',
            'escapestringdecode' => 'Security\Injection::escapeStringDecode',
            'xssencode'          => 'Security\CrossSiteScripting::encode',
            'csrftoken'          => 'Security\CrossSiteRequestForgery::token',
            'htmlencode'         => 'Security\HTML::encode',
            'htmldecode'         => 'Security\HTML::decode',
            'htmltagclean'       => 'Security\HTML::tagClean',
            'phptagencode'       => 'Security\PHP::encode',
            'phptagdecode'       => 'Security\PHP::decode',
            'phptagclean'        => 'Security\PHP::tagClean',
            'scripttagencode'    => 'Security\Script::encode',
            'scripttagdecode'    => 'Security\Script::decode',
            'foreigncharencode'  => 'Security\ForeignChar::encode',
            'foreignchardecode'  => 'Security\ForeignChar::decode'
        ]
    ];
}
