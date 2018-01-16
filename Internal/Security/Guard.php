<?php namespace ZN\Security;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Controller\Factory;

class Guard extends Factory
{
    const factory =
    [
        'methods' =>
        [
            'ncencode'           => 'NastyCode::encode',
            'injectionencode'    => 'Injection::encode',
            'injectiondecode'    => 'Injection::decode',
            'nailencode'         => 'Injection::nailEncode',
            'naildecode'         => 'Injection::nailDecode',
            'escapestringencode' => 'Injection::escapeStringEncode',
            'escapestringdecode' => 'Injection::escapeStringDecode',
            'xssencode'          => 'CrossSiteScripting::encode',
            'csrftoken'          => 'CrossSiteRequestForgery::token',
            'csrfpost'           => 'CrossSiteRequestForgery::token',
            'csrfget'            => 'CrossSiteRequestForgery::get',
            'htmlencode'         => 'Html::encode',
            'htmldecode'         => 'Html::decode',
            'htmltagclean'       => 'Html::tagClean',
            'phptagencode'       => 'PHP::encode',
            'phptagdecode'       => 'PHP::decode',
            'phptagclean'        => 'PHP::tagClean',
            'scripttagencode'    => 'Script::encode',
            'scripttagdecode'    => 'Script::decode',
            'foreigncharencode'  => 'ForeignChar::encode',
            'foreignchardecode'  => 'ForeignChar::decode'
        ]
    ];
}
