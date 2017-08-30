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
    // Symbol
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
    'symbol' =>
    [
        'sum'   => '&#8721;', // ∑
        'empty' => '&#8709;'  // ∅
    ],

    //--------------------------------------------------------------------------------------------------
    // Accent
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
    'accent' =>
    [
        'œ' => 'oe',
        'ü' => 'u'
    ]
];
