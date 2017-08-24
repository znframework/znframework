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
    ]
];
