<?php return
[
    //--------------------------------------------------------------------------------------------------
    // Individual Structures
    //--------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : Copyright (c) 2012-2016, ZN Framework
    //
    //--------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------
    // Security
    //--------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : Copyright (c) 2012-2016, ZN Framework
    //
    //--------------------------------------------------------------------------------------------------
    'security' =>
    [
        //----------------------------------------------------------------------------------------------
        // Nc Encode
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanımı: Security sınıfında kullanılan ncEncode() yönteminin temizlemesi
        // istenilen kelimeler. Temizlenen kelimelerin yerini alacak yeni kelime.
        //
        //----------------------------------------------------------------------------------------------
        'ncEncode' =>
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
        ],

        //----------------------------------------------------------------------------------------------
        // Url Change Chars
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanımı: URL saldırılarına karşı tehlike arz edeceğini düşündüğünüz ve
        // değiştirilmesini istediğiniz kelimeler veya imgeler. Anahtar ifade olarak değişmesini
        // istediğiniz karakterler, değer olarak değişecek karakterlerin yerini
        // alacak yeni karakterler.
        // NOT: Küçük-Büyük harf duyarlılığı yoktur.
        //
        // Değişmesini istediğiniz karaketer özel karakter ise özel karaketerin başına \ karakteri
        // koymanız gereklidir. Örnek \. Değiştirme işlemi için preg_replace() yöntemi kullanıldığı
        // için özel karakterlerin başına \ karaketeri getirmelisiniz. Sınırlayıcı karakterler
        // olan / / karakterleri kullanmanıza gerek yoktur.
        // Örnek: Yanlış kullanım: /ab\./, doğru kullanım: ab\.
        //
        //----------------------------------------------------------------------------------------------
        'urlChangeChars' =>
        [
            '<' => '',
            '>' => ''
            // 'old_chars' => 'change_new_chars'
        ],

        //----------------------------------------------------------------------------------------------
        // Url Bad Chars
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanımı: URL adresinde tehlike yaratacak karater listesi.
        //
        //----------------------------------------------------------------------------------------------
        'urlBadChars' =>
        [
            '"', "'", '<', '>', "?", '&',
            ':', '=', '{', '}', '[', '/',
            ']', '(', ')', ';', '$', '#',
            '\\', '../', '%20', '&22'
        ],

        //----------------------------------------------------------------------------------------------
        // Injection Bad Chars
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanımı: Script saldırılarına neden olacak karater listesi.
        //
        //----------------------------------------------------------------------------------------------
        'injectionBadChars' =>
        [
            'or.+\=' => '',
        ],

        //----------------------------------------------------------------------------------------------
        // Script Bad Chars
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanımı: Script saldırılarına neden olacak karater listesi.
        //
        //----------------------------------------------------------------------------------------------
        'scriptBadChars' =>
        [
            'document\.cookie' => 'document&#46;cookie',
            'document\.write'  => 'document&#46;write',
            '\.parentNode'     => '&#46;parentNode',
            '\.innerHTML'      => '&#46;innerHTML',
            '\-moz\-binding'   => '&#150;moz&#150;binding',
            '<'                => '&#60;',
            '>'                => '&#62;',
        ]
    ]
];
