<?php return
[
    /*
    |--------------------------------------------------------------------------
    | Wizard
    |--------------------------------------------------------------------------
    |
    | The template wizard specifies what to compile.
    |
    */

    'wizard' =>
    [
        'keywords'   => true,
        'printable'  => true,
        'functions'  => true,
        'comments'   => true,
        'tags'       => true,
        'jsdata'     => true,
        'callableJS' => true,
        'html'       => false
    ],

    /*
    |--------------------------------------------------------------------------
    | Pagination
    |--------------------------------------------------------------------------
    |
    | Includes default settings for the paging view.
    |
    */
    
    'pagination' =>
    [
        'prevName'      => '&laquo;',
        'nextName'      => '&raquo;',
        'firstName'     => '&laquo;&laquo;',
        'lastName'      => '&raquo;&raquo;',
        'totalRows'     => 50,
        'start'         => NULL,
        'limit'         => 10,
        'countLinks'    => 10,
        'type'          => 'classic', # classic, ajax
        'output'        => 'bootstrap', # classic, bootstrap
        'class'         =>
        [
            'current'   => 'active',
            'links'     => '',
            'prev'      => '',
            'next'      => '',
            'last'      => '',
            'first'     => ''
        ],
        'style'         =>
        [
            'current'   => '',
            'links'     => '',
            'prev'      => '',
            'next'      => '',
            'last'      => '',
            'first'     => ''
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Captcha
    |--------------------------------------------------------------------------
    |
    | Includes default settings for the captcha.
    |
    */

    'captcha' =>
    [
        'text' =>
        [
            'type'   => 'alnum',
            'length' => 6,
            'color'  => '85|85|85',
            'size'   => 10,
            'x'      => 100,
            'y'      => 18,
            'angle'  => 0,
            'ttf'    => []
        ],
        'background' =>
        [
            'color' => '240|240|240',
            'image' => []
        ],
        'border' =>
        [
            'status' => true,
            'color'  => '220|220|220'
        ],
        'size' =>
        [
            'width'  => 254,
            'height' => 52
        ],
        'grid' =>
        [
            'status' => false,
            'color'  => '220|220|220',
            'spaceX' => 12,
            'spaceY' => 4
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | ML Grid
    |--------------------------------------------------------------------------
    |
    | It edits the table created by the ML::table() method.
    |
    | styleElement: Used to give built-in style to the table.
    | attributes  : Used to add attributes to objects in the table.
    | pagination  : It arranges the pagination bar on the table.
    |
    */

    'mlgrid' =>
    [
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
];
