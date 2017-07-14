<?php $lang = Lang::select('EncodingSupport'); return
[
    //--------------------------------------------------------------------------------------------------
    // Encoding Support
    //--------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : Copyright (c) 2012-2016, ZN Framework
    //
    //--------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------
    // Multi Language
    //--------------------------------------------------------------------------------------------------
    //
    // Multi language config.
    //
    //--------------------------------------------------------------------------------------------------
    'ml' =>
    [
        //----------------------------------------------------------------------------------------------
        // Table
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanımı: ML::table() yöntemine ait ayarlar yer alır.
        //
        //----------------------------------------------------------------------------------------------
        'table' =>
        [
            //------------------------------------------------------------------------------------------
            // Labels
            //------------------------------------------------------------------------------------------
            //
            // Genel Kullanımı: Tabloda yer alan açıklamaları düzenler.
            //
            //------------------------------------------------------------------------------------------
            'labels' =>
            [
                'title'     => $lang['ml:titleLabel'],
                'confirm'   => $lang['ml:confirmLabel'],
                'process'   => $lang['ml:processLabel'],
                'keywords'  => $lang['ml:keywordsLabel'],
            ],

            //------------------------------------------------------------------------------------------
            // Button Names
            //------------------------------------------------------------------------------------------
            //
            // Genel Kullanımı: Tabloda yer alan butonların isimlerini düzenlemek için kullanılır.
            //
            //------------------------------------------------------------------------------------------
            'buttonNames' =>
            [
                'add'           => $lang['ml:addButton'],
                'update'        => $lang['ml:updateButton'],
                'delete'        => $lang['ml:deleteButton'],
                'clear'         => $lang['ml:clearButton'],
                'search'        => $lang['ml:searchButton']
            ],

            //------------------------------------------------------------------------------------------
            // Button Names
            //------------------------------------------------------------------------------------------
            //
            // Genel Kullanımı: Tabloda yer Arama ve yeni ekle veri kutularının var sayılan input
            // bilgisini değiştirmek için kullanılır.
            //
            //------------------------------------------------------------------------------------------
            'placeHolders' =>
            [
                'keyword'     => $lang['ml:keywordPlaceHolder'],
                'addLanguage' => $lang['ml:addLanguagePlaceHolder'],
                'search'      => $lang['ml:searchPlaceHolder']
            ],

            //----------------------------------------------------------------------------------------------
            // Style Element
            //----------------------------------------------------------------------------------------------
            //
            // Bu ayar değer alırsa gridin bulunduğu sayfada dahili <style> kullanımı aktif hale gelir.
            //
            //----------------------------------------------------------------------------------------------
            'styleElement' =>
            [
                //'#ML_TABLE tr:nth-child(even)' => ['background' => '#E6F9FF'],
                //'#ML_TABLE tr:nth-child(odd)'  => ['background' => '#FFF']
            ],

            //------------------------------------------------------------------------------------------
            // Attributes
            //------------------------------------------------------------------------------------------
            //
            // Genel Kullanımı: Grid'de yer alan buton ve linklere ait attibute yani özellik eklemek
            // için kullanılır.
            //
            //------------------------------------------------------------------------------------------
            'attributes'    =>
            [
                'table'         => ['class' => 'table table-bordered table-hover table-striped'],
                'add'           => ['style' => 'height:30px; color:#0085B2; background:none; border:solid 1px #ccc; cursor:pointer; border-radius:4px'],
                'update'        => ['style' => 'height:30px; color:#0085B2; background:none; border:solid 1px #ccc; cursor:pointer; border-radius:4px'],
                'delete'        => ['style' => 'height:30px; color:#0085B2; background:none; border:solid 1px #ccc; cursor:pointer; border-radius:4px'],
                'clear'         => ['style' => 'height:30px; color:#0085B2; background:none; border:solid 1px #ccc; cursor:pointer; border-radius:4px'],
                'textbox'       => ['style' => 'height:30px; color:#0085B2; border:solid 1px #ccc; text-indent:10px; border-radius:4px']
            ],

            //------------------------------------------------------------------------------------------
            // Pagination
            //------------------------------------------------------------------------------------------
            //
            // Genel Kullanımı: Class ve Style gönderimi için kullanılır.
            //
            //------------------------------------------------------------------------------------------
            'pagination' =>
            [
                'style' =>
                [
                    'links' => 'color:#0085B2;
                                width:30px; height:30px;
                                text-align:center;
                                padding-top:4px;
                                display:inline-block;
                                background:white;
                                border:solid 1px #ddd;
                                border-radius: 4px;
                                -webkit-border-radius: 4px;
                                -moz-border-radius: 4px;
                                text-decoration:none;',

                    'current' => 'font-weight:bold;'
                ],

                'class' => []
            ]
        ]
    ]
];
