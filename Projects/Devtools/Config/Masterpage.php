<?php return
[
    //--------------------------------------------------------------------------------------------------
    // Masterpage
    //--------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : Copyright (c) 2012-2016, ZN Framework
    //
    //--------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------
    // Head Page
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Masterpage olarak belirlen sayfanın head etiketleri arasına harici kod
    // yazmak için sayfa belirlemek için kullanlır.
    // Parametre:Metinsel türde Views/ dizininden tüm sayfalar için geçerli olacak bir
    // head sayfası belirlenir. Örnek: "head";  veya array(h1, h2 ....)
    //
    //--------------------------------------------------------------------------------------------------
    'headPage' => '', // String veya Array veri türü içerebilir.

    //--------------------------------------------------------------------------------------------------
    // Body Page
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Masterpage olacak sayfayı ayarlamak için kullanılır.
    // Parametre:Metinsel türde Views/ dizininden masterpage olarak düşünülen sayfa
    // adı bilgisi girilir. Örnek: "body";
    //
    //--------------------------------------------------------------------------------------------------
    'bodyPage' => 'masterpage',

    //--------------------------------------------------------------------------------------------------
    // Doctype
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Sayfanın döküman türü varsayılan:xhtml1-trans.
    //
    //--------------------------------------------------------------------------------------------------
    'docType' => 'html5',

    //--------------------------------------------------------------------------------------------------
    // Content Charset
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Sayfanın dil kodlaması varsayılarn:utf-8.
    //
    //--------------------------------------------------------------------------------------------------
    'content' =>
    [
        'language' => Lang::get(),
        'charset'  => ['utf-8']
    ],

    //--------------------------------------------------------------------------------------------------
    // Browser Icon
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Web sitesinin tarayıcıda görünen ikon eklemek için ikonun
    // yolunu yazınız.
    //
    //--------------------------------------------------------------------------------------------------
    'browserIcon' => FILES_DIR . 'ico.png',

    //--------------------------------------------------------------------------------------------------
    // Background Image
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Web sitesinin arkaplan resmi.
    //
    //--------------------------------------------------------------------------------------------------
    'backgroundImage' => '',

    //--------------------------------------------------------------------------------------------------
    // Body Attributes
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: <html>, <head> ve <body> taglarına özellik değer çifti eklemek istediğiniz zaman
    // kullanabilirsiniz.
    //
    // ['id' => 'body', 'name' => 'Body'] -- <body id="body" name="Body">
    //
    //--------------------------------------------------------------------------------------------------
    'attributes' =>
    [
        'html' => [],
        'head' => [],
        'body' => []
    ],

    //--------------------------------------------------------------------------------------------------
    // Theme
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Resources/Themes/ içindeki dahil edilmek istenen tema belirtilir.
    //
    //--------------------------------------------------------------------------------------------------
    'theme' =>
    [
        'name'      => '',
        'recursive' => false
    ],

    //--------------------------------------------------------------------------------------------------
    // Plugin
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Resources/Plugins/ içindeki dahil edilmek istenen eklentiler belirtilir.
    //
    //--------------------------------------------------------------------------------------------------
    'plugin' =>
    [
        'name'      =>
        [
            'Dashboard/css/bootstrap.css',
            'Dashboard/css/sb-admin.css',
            'Dashboard/css/plugins/morris.css',
            'Dashboard/font-awesome/css/font-awesome.min.css',
            'Dashboard/js/jquery.js',
            'Dashboard/js/bootstrap.min.js',
            'Dashboard/js/plugins/morris/raphael.min.js',
            'Dashboard/js/plugins/morris/morris.min.js',
            'Dashboard/js/plugins/morris/morris-data.js',
            'Dashboard/ace/ace.js'
        ],
        'recursive' => false
    ],

    //--------------------------------------------------------------------------------------------------
    // Font
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Harici font kullanımı kullanmak istediğiniz özel fontları
    // Resources/Fonts/
    // dizinine atıp bu dizin içindek dosyanın adını yazarak kullanabilirsiniz.
    // Aşağıdaki dizi içerisine Resources/Fonts/ dizinindeki dosya/dosyaların isimlerini
    // yazmanız yeterlidir.
    //
    //--------------------------------------------------------------------------------------------------
    'font' => [], // string veya array

    //--------------------------------------------------------------------------------------------------
    // Style
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Harici css dosyası kullanımı kullanmak istediğiniz stil dosyalarını
    // Resources/Styles/ dizinine atmanız gerekmektedir. Aşağıdaki dizi içerisine
    // Resources/Styles/
    // dizinindeki dosya/dosyaların isimlerini yazmanız yeterlidir.
    //
    //--------------------------------------------------------------------------------------------------
    'style' => ['style'], // string veya array

    //--------------------------------------------------------------------------------------------------
    // Script
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Harici javascript dosyası kullanımı. Aşağıdaki dizi içerisine
    // Resources/Scripts/ dizinindeki dosya/dosyaların isimlerini yazmanız yeterlidir.
    //
    //--------------------------------------------------------------------------------------------------
    'script' => [], // string veya array

    //--------------------------------------------------------------------------------------------------
    // Title
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Tüm sayfalar için varsayılan başlık bilgisi.
    //
    //--------------------------------------------------------------------------------------------------
    'title' => 'ZN Framework &raquo; Dashboard',

    //--------------------------------------------------------------------------------------------------
    // Meta
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Standart olarak kullanılan meta verilerini kullanmak için oluşturuldu.
    // Meta içeri name ise name: ayracı, http-equiv ise http: ayracı kullanılarak
    // meta tagları ekleyebilirsiniz.
    //
    // Aşağıdaki taglar ön tanımlı meta taglarıdır.
    //
    //--------------------------------------------------------------------------------------------------
    'meta' =>
    [
        'name:description'      => '',
        'name:author'           => '',
        'name:designer'         => '',
        'name:distribution'     => '',
        'name:keywords'         => '',
        'name:abstract'         => '',
        'name:copyright'        => '',
        'name:expires'          => '',
        'name:pragma'           => '',
        'name:revisit-after'    => '',
        'http:cache-control'    => '',
        'http:refresh'          => '',
        'http:X-UA-Compatible'  => 'IE=edge',
        'viewport'              => 'width=device-width, initial-scale=1',
        'name:robots'           => []
    ],

    //--------------------------------------------------------------------------------------------------
    // Data
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Head tagları arasına farklı bir bilgi veya bilgiler eklenmek isteniyorsa
    // dizi elemanı olarak yazmanız yeterlidir.
    //
    //--------------------------------------------------------------------------------------------------
    'data' => []
];
