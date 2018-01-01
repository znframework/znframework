<?php namespace ZN\IndividualStructures\Security;
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
    //----------------------------------------------------------------------------------------------
    // Nc Encode
    //----------------------------------------------------------------------------------------------
    //
    // Genel Kullanımı: Security sınıfında kullanılan ncEncode() yönteminin temizlemesi
    // istenilen kelimeler. Temizlenen kelimelerin yerini alacak yeni kelime.
    //
    //----------------------------------------------------------------------------------------------
    public static $ncEncode =
    [
        'badChars' =>
        [
            '<!--',
            '-->',
            '<?',
            '?>',
            '<',
            '>'
        ], // string veya array

        'changeBadChars' => '[badchars]' // string veya array
    ];

    //----------------------------------------------------------------------------------------------
    // Injection Bad Chars
    //----------------------------------------------------------------------------------------------
    //
    // Genel Kullanımı: Script saldırılarına neden olacak karater listesi.
    //
    //----------------------------------------------------------------------------------------------
    public static $injectionBadChars =
    [
        'or.+\=' => '',
    ];
}
