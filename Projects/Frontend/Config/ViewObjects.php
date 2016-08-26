<?php return 
[
    //--------------------------------------------------------------------------------------------------
    // View Objects 
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
            'add'           => lang('ViewObjects', 'dbgrid:addButton'),
            'edit'          => lang('ViewObjects', 'dbgrid:editButton'),
            'update'        => lang('ViewObjects', 'dbgrid:updateButton'),
            'save'          => lang('ViewObjects', 'dbgrid:saveButton'),
            'delete'        => lang('ViewObjects', 'dbgrid:deleteButton'),
            'deleteSelected'=> lang('ViewObjects', 'dbgrid:deleteSelectedName'),
            'deleteAll'     => lang('ViewObjects', 'dbgrid:deleteAllName')
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
            'search'    => lang('ViewObjects', 'dbgrid:searchHolder'),
            'inputs'    => lang('ViewObjects', 'dbgrid:inputsHolder'),
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
            '#DBGRID_TABLE tr:nth-child(even)' => ['background' => '#E6F9FF'],
            '#DBGRID_TABLE tr:nth-child(odd)'  => ['background' => '#FFF']
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
            'columns'       => ['height' => 75, 'style' => 'text-decoration:none; color:#0085B2'],
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
    ],

    //--------------------------------------------------------------------------------------------------
    // Css3                                                                               
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Css3 kütüphanesi ile ilgili gerekli ayarları içerir.                               
    //
    //--------------------------------------------------------------------------------------------------
    'css3' => 
    [
        //----------------------------------------------------------------------------------------------
        // Browser                                                                                
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanım: Css3 kütüphanesi ile ilgili gerekli ayarları içerir.                   
        // Aşağıda css3 komutlarının uygulanacağı tarayıcı listesi mevcuttur.                      
        // Aşağıda boş bir eleman girilmesinin nedeni tarayıcılar dışında standart css3 komutlarını
        // da kullanması içindir.                                                                 
        // Örnek: box-shadow, -ms-box-shadow, -moz-box-shadow, -webkit-box-shadow                 
        //
        //----------------------------------------------------------------------------------------------
        'browsers' => ['', '-o-', '-ms-', '-moz-', '-webkit-']
    ],

    //--------------------------------------------------------------------------------------------------
    // Font
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Fontlarla ilgili ayarlar yer alır.                                                                     
    //
    //--------------------------------------------------------------------------------------------------
    'font' => 
    [
        //----------------------------------------------------------------------------------------------
        // Different Font Extensions
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanım: SVG, WOFF, EOT, OTF, TTF uzantılı fontlar dışında başka bir uzantılı    
        // font kullanacaksınız aşağıdaki diziye eklemeniz gerekmektedir. Uzantı başında (.) nokta 
        // karakteri kullanmanıza gerek yoktur. Örnek array('ufo', 'fon') şeklinde yazmanız        
        // yeterlidir.                                                                            
        //
        //----------------------------------------------------------------------------------------------
        'differentFontExtensions' => []
    ],

    //--------------------------------------------------------------------------------------------------
    // Cdn
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Uzaktan linklerin kullanımına yönelik ayarları içerir.                                                             
    //
    //--------------------------------------------------------------------------------------------------
    'cdn' => 
    [
        //----------------------------------------------------------------------------------------------
        // Script                                                                             
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanım: Script URL bilgilerini tutmak için oluşturulmuştur.                        
        // Bu linkleri güncelleyerek dışardan script dosyaları çağırabilirsiniz.                      
        // Bu stilleri import ederken anahtar ifadeler kullanılarak dahil etme işlemi yapılır.     
        // Örnek Kullanım: Import::script('style');                                               
        //
        //----------------------------------------------------------------------------------------------
        'scripts' => 
        [
            'jquery'    => 'https://code.jquery.com/jquery-latest.js',
            'jqueryUi'  => 'https://code.jquery.com/ui/1.11.3/jquery-ui.js',
            'bootstrap' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js',
            'bootlint'  => 'https://maxcdn.bootstrapcdn.com/bootlint/0.14.1/bootlint.min.js',
            'angular'   => 'https://ajax.googleapis.com/ajax/libs/angularjs/1.2.29/angular.min.js'
        ],
        
        //----------------------------------------------------------------------------------------------
        // Style                                                                              
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanım: Style URL bilgilerini tutmak için oluşturulmuştur.                         
        // Bu linkleri güncelleyerek dışardan style dosyaları çağırabilirsiniz.                   
        // Bu stilleri import ederken anahtar ifadeler kullanılarak dahil etme işlemi yapılır.     
        // Örnek Kullanım: Import::style('style');                                                
        //
        //----------------------------------------------------------------------------------------------
        'styles' => 
        [
            'bootstrap' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css',
            'awesome'   => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'
        ],
        
        //----------------------------------------------------------------------------------------------
        // Font                                                                               
        //----------------------------------------------------------------------------------------------
        //
        // Harici sunuculardan çağırmayı düşündüğünüz fontların anahtar ismi ve url bilgisini eklemek 
        // için. 
        // Import::font('anahtar') ile direk import ettirebilirsiniz.                                     
        //
        //----------------------------------------------------------------------------------------------
        'fonts' => 
        [
            // 'font1' => 'http://xx.xx.xxx/image/font1.ttf'
        ],
        
        //----------------------------------------------------------------------------------------------
        // Image                                                                              
        //----------------------------------------------------------------------------------------------
        //
        // Harici sunuculardan çağırmayı düşündüğünüz resimlerin anahtar ismi ve url bilgisini eklemek
        // için. 
        // CND::image('anahtar') ile anahtarın değerini döndürebilirsiniz.
        // Html::image(CND::image('image1'));                                             
        //
        //----------------------------------------------------------------------------------------------
        'images' => 
        [
            // 'image1' => 'http://xx.xx.xxx/image/image1.jpg'
        ],
        
        //----------------------------------------------------------------------------------------------
        // File                                                                               
        //----------------------------------------------------------------------------------------------
        //
        // Harici sunuculardan çağırmayı düşündüğünüz dosyaların anahtar ismi ve url bilgisini eklemek 
        // için.    
        // CND::file('anahtar') ile anahtarın değerini döndürebilirsiniz.   
        // File::contents(CND::file('anahtar'));                                  
        //
        //----------------------------------------------------------------------------------------------
        'files' => 
        [
            // 'file1' => 'http://xx.xx.xxx/files/file1.txt'
        ]
    ],

    //--------------------------------------------------------------------------------------------------
    // Doctype                                                                                
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Döküman türleri listesi.                                               
    //
    //--------------------------------------------------------------------------------------------------
    'doctype' => 
    [
        'xhtml1Strict'          => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//TR" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',
        'xhtml1Transitional'    => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//TR" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',
        'xhtml1Frameset'        => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//TR" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">',
        'xhtml11'               => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//TR" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">',
        'html4Strict'           => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//TR" "http://www.w3.org/TR/html4/strict.dtd">',
        'html4Transitional'     => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//TR" "http://www.w3.org/TR/html4/loose.dtd">',
        'html4Frameset'         => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//TR" "http://www.w3.org/TR/html4/frameset.dtd">',
        'html5'                 => '<!DOCTYPE html>'
    ]
];