<?php namespace ZN\IndividualStructures;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Security extends \FactoryController
{
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
            'csrfpost'           => 'Security\CrossSiteRequestForgery::token',
            'csrfget'            => 'Security\CrossSiteRequestForgery::get',
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
