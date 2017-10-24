<?php return
[
    //--------------------------------------------------------------------------------------------------
    // Expressions -> 5.3.1
    //--------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : Copyright (c) 2012-2016, ZN Framework
    //
    //--------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------
    // Regular Expression
    //--------------------------------------------------------------------------------------------------
    //
    // Rota için kullanmak istediğiniz özel düzenli ifadelerinizi belirtebilirsiniz. Bu ifadeleri
    // Routes/ dizini içindeki dosyalarda Rota değşimi yaparken kullanabilirsiniz. Kendinize özel
    // kullanımlar oluşturmanız içindir.
    //
    // {anahtar} => Düzenli İfade
    //
    //--------------------------------------------------------------------------------------------------
    'regex' =>
    [
        '{id}' => '[0-9]+'
    ],

    //--------------------------------------------------------------------------------------------------
    // Symbols -> 5.3.11[edit]
    //--------------------------------------------------------------------------------------------------
    //
    // Symbol kütüphanesi ile kullanılabilir ifadeler oluşturmanız içindir. Genellikle bir çok
    // özel ifadenin kodu unutulduğu için bu kullanımlarınızı buradan tanımlayarak işleri kolay Hale
    // getirebilirsiniz.
    //
    // 'euro' => '&#8364;'
    //
    // Yukarıdaki gibi tanımlamadan sonra Symbol::euro() şeklinde kullanabilirsiniz.
    //
    //--------------------------------------------------------------------------------------------------
    'symbols' =>
    [
        'sum'   => '&#8721;', // ∑
        'empty' => '&#8709;'  // ∅
    ],

    //--------------------------------------------------------------------------------------------------
    // Mimes Types -> 5.4.1[added]
    //--------------------------------------------------------------------------------------------------
    //
    // Mime kütüphanesine ön tanımlı mime listesinde yer alan ifadeler dışında yeni türler tanımlamak
    // için kulanabilirsiniz..
    //
    // 'png' => 'image/png'
    //
    // Yukarıdaki gibi tanımlamadan sonra Mime::png() şeklinde kullanabilirsiniz.
    //
    //--------------------------------------------------------------------------------------------------
    'mimeTypes' =>[],

    //--------------------------------------------------------------------------------------------------
    // Accent Chars -> 5.3.11[edit]
    //--------------------------------------------------------------------------------------------------
    //
    // Converter::accent() yöntemi ile süzülmesini istediğiniz sistemde öngörülmemiş karakterleri
    // belirtebilirsiniz.
    //
    // Aksanlı İfade => Karşılığı
    //
    // Aşağıdaki kullanımlar örnek amaçlı verilmiştir.
    //
    //--------------------------------------------------------------------------------------------------
    'accentChars' =>
    [
        'œ' => 'oe',
        'ü' => 'u'
    ],

    //----------------------------------------------------------------------------------------------
    // Different Font Extensions -> 5.3.11
    //----------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: SVG, WOFF, EOT, OTF, TTF uzantılı fontlar dışında başka bir uzantılı
    // font kullanacaksınız aşağıdaki diziye eklemeniz gerekmektedir. Uzantı başında (.) nokta
    // karakteri kullanmanıza gerek yoktur.
    //
    // ['ufo', fon]
    //
    //----------------------------------------------------------------------------------------------
    'differentFontExtensions' => [],

    //----------------------------------------------------------------------------------------------
    // Document Types -> 5.3.11
    //----------------------------------------------------------------------------------------------
    //
    // Dahili doküman türü dışında kendinizde döküman türü ekleyebilirsiniz. Bu tanımlamaları
    // Masterpage ile birlikte kullanabilirsiniz. Aşağıda basit bir örnek verilmiştir.
    //
    // 'html5' => '<!DOCTYPE html>'
    //
    //----------------------------------------------------------------------------------------------
    'doctypes' => []
];
