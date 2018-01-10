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

class Properties
{
    /**
     * Encode Nasty Chars
     * 
     * @var array
     */
    public static $ncEncode =
    [
        'badChars' => # string or array
        [
            '<!--',
            '-->',
            '<?',
            '?>',
            '<',
            '>'
        ], 

        'changeBadChars' => '[badchars]' # string veya array
    ];

    /**
     * Indection Bad Chars
     * 
     * @var array
     */
    public static $injectionBadChars =
    [
        'or.+\=' => '',
    ];
}
