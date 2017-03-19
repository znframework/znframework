<?php return
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
                'title'     => lang('EncodingSupport', 'ml:titleLabel'),
                'confirm'   => lang('EncodingSupport', 'ml:confirmLabel'),
                'process'   => lang('EncodingSupport', 'ml:processLabel'),
                'keywords'  => lang('EncodingSupport', 'ml:keywordsLabel'),
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
                'add'           => lang('EncodingSupport', 'ml:addButton'),
                'update'        => lang('EncodingSupport', 'ml:updateButton'),
                'delete'        => lang('EncodingSupport', 'ml:deleteButton'),
                'clear'         => lang('EncodingSupport', 'ml:clearButton'),
                'search'        => lang('EncodingSupport', 'ml:searchButton')
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
                'keyword'     => lang('EncodingSupport', 'ml:keywordPlaceHolder'),
                'addLanguage' => lang('EncodingSupport', 'ml:addLanguagePlaceHolder'),
                'search'      => lang('EncodingSupport', 'ml:searchPlaceHolder')
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
                '#ML_TABLE tr:nth-child(even)' => ['background' => '#E6F9FF'],
                '#ML_TABLE tr:nth-child(odd)'  => ['background' => '#FFF']
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
                'table'         => ['width' => '100%', 'cellspacing' => 0, 'cellpadding' => 10, 'style' => 'border:solid 1px #ddd; font-family:Arial; color:#888; font-size:14px;'],
                'add'           => ['style' => 'height:30px; color:#0085B2; background:none; border:solid 1px #0085B2; cursor:pointer'],
                'update'        => ['style' => 'height:30px; color:#0085B2; background:none; border:solid 1px #0085B2; cursor:pointer'],
                'delete'        => ['style' => 'height:30px; color:#0085B2; background:none; border:solid 1px #0085B2; cursor:pointer'],
                'clear'         => ['style' => 'height:30px; color:#0085B2; background:none; border:solid 1px #0085B2; cursor:pointer'],
                'textbox'       => ['style' => 'height:30px; color:#0085B2; border:solid 1px #0085B2; text-indent:10px']

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
                                width:20px; height:20px;
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
