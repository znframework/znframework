<?php return
[
    //--------------------------------------------------------------------------------------------------
    // Robots
    //--------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : Copyright (c) 2012-2016, ZN Framework
    //
    //--------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------
    // Create File
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Ana dizine robots.txt dosyası oluşturmak içindir.
    //
    //--------------------------------------------------------------------------------------------------
    'createFile' => false,

    //--------------------------------------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Kurallar oluşturmak için kullanılır. Rules dizisi içerisinde sınırsız sayıda
    // dizilerden oluşan kurallar kullanılabilir. Her bir dizi elemanı için user-agent, allow ve
    // disallow ayarlanabilir. Birden fazla user-agent kullanılacaksa eleman sayısı artırılabilir.
    //
    // Çoklu Kullanım: array( array('userAgent' => '*', ...), array('userAgent' => '*') ) Dizi türü
    // Tekli Kullanım: array( 'userAgent' => '*' ) Dizge türü
    //
    //--------------------------------------------------------------------------------------------------
    'rules' =>
    [
        'userAgent' => '*',
        'allow'     => [],
        'disallow'  =>
        [
            '/External/',
            '/Internal/',
            '/Projects/',
            '/Settings/'
        ]
    ]
];
