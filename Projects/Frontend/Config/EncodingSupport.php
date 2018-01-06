<?php $lang = Lang::select('EncodingSupport'); return
[
    /*
    |--------------------------------------------------------------------------
    | ML
    |--------------------------------------------------------------------------
    |
    | It edits the table created by the ML::table() method.
    |
    | labels      : It arranges the names of the labels on the table.
    | buttonNames : It arranges the names of the buttons on the table.
    | placeHolders: It arranges the placeholder of the text fields on the table.
    | styleElement: Used to give built-in style to the table.
    | attributes  : Used to add attributes to objects in the table.
    | pagination  : It arranges the pagination bar on the table.
    |
    */

    'ml' =>
    [
        'table' =>
        [
            'labels' =>
            [
                'title'    => $lang['ml:titleLabel'],
                'confirm'  => $lang['ml:confirmLabel'],
                'process'  => $lang['ml:processLabel'],
                'keywords' => $lang['ml:keywordsLabel'],
            ],
            'buttonNames' =>
            [
                'add'    => $lang['ml:addButton'],
                'update' => $lang['ml:updateButton'],
                'delete' => $lang['ml:deleteButton'],
                'clear'  => $lang['ml:clearButton'],
                'search' => $lang['ml:searchButton']
            ],
            'placeHolders' =>
            [
                'keyword'     => $lang['ml:keywordPlaceHolder'],
                'addLanguage' => $lang['ml:addLanguagePlaceHolder'],
                'search'      => $lang['ml:searchPlaceHolder']
            ],
            'styleElement' =>
            [
                #'#ML_TABLE tr:nth-child(even)' => ['background' => '#E6F9FF'],
                #'#ML_TABLE tr:nth-child(odd)'  => ['background' => '#FFF']
            ],
            'attributes'    =>
            [
                'table'   => ['class' => 'table table-bordered table-hover table-striped'],
                'add'     => ['style' => 'height:30px; color:#0085B2; background:none; border:solid 1px #ccc; cursor:pointer; border-radius:4px'],
                'update'  => ['style' => 'height:30px; color:#0085B2; background:none; border:solid 1px #ccc; cursor:pointer; border-radius:4px'],
                'delete'  => ['style' => 'height:30px; color:#0085B2; background:none; border:solid 1px #ccc; cursor:pointer; border-radius:4px'],
                'clear'   => ['style' => 'height:30px; color:#0085B2; background:none; border:solid 1px #ccc; cursor:pointer; border-radius:4px'],
                'textbox' => ['style' => 'height:30px; color:#0085B2; border:solid 1px #ccc; text-indent:10px; border-radius:4px']
            ],
            'pagination' =>
            [
                'style' =>
                [
                    'links' => 'color:#0085B2; width:30px; height:30px; text-align:center; padding-top:4px;
                                display:inline-block; background:white; border:solid 1px #ddd; border-radius: 4px;
                                -webkit-border-radius: 4px; -moz-border-radius: 4px;text-decoration:none;',

                    'current' => 'font-weight:bold;'
                ],
                'class' => []
            ]
        ]
    ]
];
