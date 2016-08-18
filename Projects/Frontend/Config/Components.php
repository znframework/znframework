<?php return
[
    //--------------------------------------------------------------------------------------------------
    // Components 
    //--------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : Copyright (c) 2012-2016, ZN Framework
    //
    //--------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------
    // Pagination
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanımı: Ön tanımlı sayfalama ayarı yapmak için kullanılır.                                                          
    //
    //--------------------------------------------------------------------------------------------------
    'pagination' =>
    [
        'prevName'      => '<', 
        'nextName'      => '>',
        'firstName'     => '<<',
        'lastName'      => '>>',
        
        'totalRows'     => 50,
        'start'         => NULL,
        'limit'         => 10,
        'countLinks'    => 10,
        'type'          => 'classic', // classic, ajax
        
        'class' =>
        [
            'current'   => '',
            'links'     => '',
            'prev'      => '',
            'next'      => '',
            'last'      => '',
            'first'     => ''
        ],
        
        'style' => 
        [
            'current'   => '',
            'links'     => '',
            'prev'      => '',
            'next'      => '',
            'last'      => '',
            'first'     => ''
        ]
    ],

    //--------------------------------------------------------------------------------------------------
    // Captcha
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanımı: Ön tanımlı güvenlik kodu ayarı yapmak için kullanılır.                                                          
    //
    //--------------------------------------------------------------------------------------------------
    'captcha' =>
    [
        'charLength'    => '6',  
        'bgColor'       =>'80|80|80',
        'background'    => [],
        'textColor'     => '255|255|255',
        'border'        => false,
        'borderColor'   => '0|0|0',
        'width'         => '180',
        'height'        => '40',
        'imageString'   => ['size' => '5', 'x' => '65', 'y' => '13'],
        'grid'          => true, 
        'gridSpace'     => ['x' => 12, 'y' => 4],
        'gridColor'     => '50|50|50'
    ],

    //--------------------------------------------------------------------------------------------------
    // Calendar
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanımı: Ön tanımlı takvim ayarı yapmak için kullanılır.                                                         
    //
    //--------------------------------------------------------------------------------------------------
    'calendar' =>
    [   
        'prevName'      => '<<', 
        'nextName'      => '>>',
        
        'dayType'       => 'short',
        'monthType'     => 'long',  
        'type'          => 'classic', // classic, ajax

        'class' => 
        [
            'table'     => '',
            'monthName' => '',
            'dayName'   => '',
            'days'      => '',
            'links'     => '',
            'current'   => '',
        ],
        
        'style' => 
        [
            'table'     => '',
            'monthName' => '',
            'dayName'   => '',
            'days'      => '',
            'links'     => '',
            'current'   => '',
        ],
        
        'monthNames' => 
        [
            'tr' => 
            [
                'Ocak'      => 'Oca', 
                'Şubat'     => 'Şub', 
                'Mart'      => 'Mar', 
                'Nisan'     => 'Nis', 
                'Mayıs'     => 'May', 
                'Haziran'   => 'Haz', 
                'Temmuz'    => 'Tem', 
                'Ağustos'   => 'Ağu', 
                'Eylül'     => 'Eyl', 
                'Ekim'      => 'Eki', 
                'Kasım'     => 'Kas', 
                'Aralık'    => 'Ara'
            ],
                        
            'en' => 
            [
                'Janury'    => 'Jan', 
                'February'  => 'Feb', 
                'March'     => 'Mar', 
                'April'     => 'Apr', 
                'May'       => 'May', 
                'June'      => 'Jun', 
                'July'      => 'Jul', 
                'August'    => 'Aug', 
                'September' => 'Sep', 
                'October'   => 'Oct', 
                'November'  => 'Nov', 
                'December'  => 'Dec'
            ]
        ],
        
        'dayNames' =>
        [
            'tr' => 
            [
                'Pazartesi' => 'Pzt', 
                'Salı'      => 'Sal',       
                'Çarşamba'  => 'Çar', 
                'Perşembe'  => 'Per', 
                'Cuma'      => 'Cum', 
                'Cumartesi' => 'Cts', 
                'Pazar'     => 'Paz'
            ],
                        
            'en' => 
            [
                'Monday'    => 'Mon', 
                'Tuesday'   => 'Tue', 
                'Wednesday' => 'Wed', 
                'Thursday'  => 'Thu', 
                'Friday'    => 'Fri', 
                'Saturday'  => 'Sat', 
                'Sunday'    => 'Sun'
            ]
        ]
    ],

    //--------------------------------------------------------------------------------------------------
    // Terminal
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanımı: Ön tanımlı konsol ayarı yapmak için kullanılır.                                                         
    //
    //--------------------------------------------------------------------------------------------------
    'terminal' =>
    [
        'width'         => '800px', 
        'height'        => '350px', 
        'bgColor'       => '#000', 
        'barBgColor'    => '#222', 
        'textColor'     => '#ccc', 
        'textType'      => 'Consolas, monospace', 
        'textSize'      => '12px'
    ],

    //--------------------------------------------------------------------------------------------------
    // DataGrid
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanımı: Ön tanımlı grid ayarı yapmak için kullanılır.                                                           
    //
    //--------------------------------------------------------------------------------------------------
    'datagrid' =>
    [
        //----------------------------------------------------------------------------------------------
        // Button Names
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanımı: DataGrid'de yer alan butonların isimlerini düzenlemek için kullanılır.                                                  
        //
        //----------------------------------------------------------------------------------------------
        'buttonNames' =>
        [
            'add'           => lang('Components', 'dbgrid:addButton'),
            'edit'          => lang('Components', 'dbgrid:editButton'),
            'update'        => lang('Components', 'dbgrid:updateButton'),
            'save'          => lang('Components', 'dbgrid:saveButton'),
            'delete'        => lang('Components', 'dbgrid:deleteButton'),
            'deleteSelected'=> lang('Components', 'dbgrid:deleteSelectedName'),
            'deleteAll'     => lang('Components', 'dbgrid:deleteAllName')
        ],
        
        //----------------------------------------------------------------------------------------------
        // Button Names
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanımı: DataGrid'de yer Arama ve yeni ekle veri kutularının var sayılan input
        // bilgisini değiştirmek için kullanılır.                                               
        //
        //----------------------------------------------------------------------------------------------
        'placeHolders' =>
        [
            'search'    => lang('Components', 'dbgrid:searchHolder'),
            'inputs'    => lang('Components', 'dbgrid:inputsHolder'),
        ],
        
        //----------------------------------------------------------------------------------------------
        // Attributes
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanımı: Grid'de yer alan buton ve linklere ait attibute yani özellik eklemek
        // için kullanılır.                                                 
        //
        //----------------------------------------------------------------------------------------------
        'attributes'    => 
        [
            'table'         => ['width' => '100%', 'cellspacing' => 0, 'cellpadding' => 10, 'style' => 'margin-top:15px; margin-bottom:15px; border:solid 1px #ddd; font-family:Arial; color:#888; font-size:14px;'],
            'editTables'    => ['style' => 'font-family:Arial; color:#888; font-size:14px;'],
            'columns'       => ['style' => 'text-decoration:none; color:#0085B2'],
            'search'        => ['style' => 'height:34px; color:#0085B2; border:solid 1px #0085B2; text-indent:10px'],
            'add'           => ['style' => 'height:34px; color:#0085B2; background:none; border:solid 1px #0085B2; cursor:pointer'],
            'deleteSelected'=> ['style' => 'height:34px; color:#0085B2; background:none; border:solid 1px #0085B2; cursor:pointer'],
            'deleteAll'     => ['style' => 'height:34px; color:#0085B2; background:none; border:solid 1px #0085B2; cursor:pointer'],
            'save'          => ['style' => 'height:34px; color:#0085B2; background:none; border:solid 1px #0085B2; cursor:pointer'],
            'update'        => ['style' => 'height:34px; color:#0085B2; background:none; border:solid 1px #0085B2; cursor:pointer'],
            'delete'        => ['style' => 'height:34px; color:#0085B2; background:none; border:solid 1px #0085B2; cursor:pointer'],
            'edit'          => ['style' => 'height:34px; color:#0085B2; background:none; border:solid 1px #0085B2; cursor:pointer'],
            'listTables'    => [],
            'inputs'        => 
            [
                'text'      => ['style' => 'height:34px; color:#0085B2; border:solid 1px #0085B2; text-indent:10px'],
                'textarea'  => ['style' => 'height:60px; width:250px; color:#0085B2; border:solid 1px #0085B2; text-indent:10px'],
                'radio'     => [],
                'checkbox'  => [],
                'select'    => []
            ]
        ],
        
        //----------------------------------------------------------------------------------------------
        // Colors
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanımı: Grid'de yer alan yapıların renklerini düzenlemek için kullanılır.                                                   
        //
        //----------------------------------------------------------------------------------------------
        'colors' =>
        [
            'rowOrder' => ['single' => '#fff', 'double' => '#E6F9FF']
        ],
        
        //----------------------------------------------------------------------------------------------
        // Pagination
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanımı: Yukardaki ayarlar aynen geçerlidir. Sadece Datagrid için farklı bir.
        // sayfalama görünümü dizayn edilmek istenirse yukarıdaki ayarların kullanımı değişmeyecek
        // şekilde kullanılabilir. Ortak bir sayfalama tasarımı kullanıyorsa zaten sayfalama 
        // ayarlarının yukarıdaki mevcut ayarlarından yapılması tavsiye edilir.                                                 
        //
        //----------------------------------------------------------------------------------------------
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
            ]
        ]
    ]
];