<?php return
[
    //--------------------------------------------------------------------------------------------------
    // Starting
    //--------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : Copyright (c) 2012-2016, ZN Framework
    //
    //--------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------
    // Controller
    //--------------------------------------------------------------------------------------------------
    //
    // Başlangıçta çalıştırılmak istenen kontrolcü varsa kullanılır. Bir veya birden fazla, parametreli
    // veya parametresiz kontrolcü çalıştırılabilir. Bunun için ayar değeri hem dizge hem de dizi
    // olabilir. Dikkat edilmesi gereken nokta kontrolcü ismi ile sınıfı adı aynı olmalıdır.
    // Verinin class bölümü aslında sayfa adıdır.
    //
    // Tekil Kullanım
    // 'file:func'
    //
    // Çoğul Kullanım
    // ['file1:func1', 'file2:func2', ...]
    //
    // Parametreli Kullanım
    // ['file1:func1' => ['p1', 'p2'], ... ]
    //
    //--------------------------------------------------------------------------------------------------
    'controller' => 'initialize',

    //--------------------------------------------------------------------------------------------------
    // Autoload
    //--------------------------------------------------------------------------------------------------
    //
    // Functions/Autoloader/ dizininde bulunan dosyalar otomatik olarak dahil edilir.
    // Bunu kapatmak için aşağıdaki status ayarına ait değer false, açmak için true olarak ayarlanır.
    // Dizin içi dizinlerde de arama yapılması istenirse recursive true olarak ayarlanır.
    //
    //--------------------------------------------------------------------------------------------------
    'autoload' =>
    [
        'status'    => true,
        'recursive' => false
    ],

    //--------------------------------------------------------------------------------------------------
    // Handload
    //--------------------------------------------------------------------------------------------------
    //
    // El ile yüklenmek istenen fonksiyon dosyalarının yol bilgileri belirtilir.
    // Yol bilgisi belirtilirken Functions/Handload/ kök dizin kabul edilir.
    //
    //--------------------------------------------------------------------------------------------------
    'handload' => []
];
