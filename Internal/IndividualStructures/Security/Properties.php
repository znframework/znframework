<?php namespace ZN\IndividualStructures\Security;

class Properties
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

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
