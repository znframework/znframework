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
            'jquery'                     => 'https://code.jquery.com/jquery-latest.js',
            'jqueryUi'                   => 'https://code.jquery.com/ui/1.11.3/jquery-ui.js',
            'jqueryValidator'            => 'https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js',
            'bootstrap'                  => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',
            'bootlint'                   => 'https://maxcdn.bootstrapcdn.com/bootlint/0.14.1/bootlint.min.js',
            'angular'                    => 'https://ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular.min.js',
            'react'                      => 'https://cdnjs.cloudflare.com/ajax/libs/react/15.5.4/react.min.js',
            'vue'                        => 'https://cdnjs.cloudflare.com/ajax/libs/vue/2.3.3/vue.min.js',
            'datatables'                 => 'https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js',
            'autoFillDatatables'         => 'https://cdn.datatables.net/autofill/2.2.0/js/dataTables.autoFill.min.js',
            'buttonsDatatables'          => 'https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js',
            'columnVisibilityDatatables' => 'https://cdn.datatables.net/buttons/1.3.1/js/buttons.colVis.min.js',
            'flashButtonsDatatables'     => 'https://cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js',
            'html5ButtonsDatatables'     => 'https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js',
            'printButtonDatatables'      => 'https://cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js',
            'columnReorderDatatables'    => 'https://cdn.datatables.net/colreorder/1.3.3/js/dataTables.colReorder.min.js',
            'fixedColumnsDatatables'     => 'https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js',
            'fixedHeaderDatatables'      => 'https://cdn.datatables.net/fixedheader/3.1.2/js/dataTables.fixedHeader.min.js',
            'keyTableDatatables'         => 'https://cdn.datatables.net/keytable/2.2.1/js/dataTables.keyTable.min.js',
            'responsiveDatatables'       => 'https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js',
            'rowGroupDatatables'         => 'https://cdn.datatables.net/rowgroup/1.0.0/js/dataTables.rowGroup.min.js',
            'rowReorderDatatables'       => 'https://cdn.datatables.net/rowreorder/1.2.0/js/dataTables.rowReorder.min.js',
            'scrollerDatatables'         => 'https://cdn.datatables.net/scroller/1.4.2/js/dataTables.scroller.min.js',
            'selectDatatables'           => 'https://cdn.datatables.net/select/1.2.2/js/dataTables.select.min.js',
            'morris'                     => 'https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js',
            'raphael'                    => 'https://cdnjs.cloudflare.com/ajax/libs/raphael/2.2.7/raphael.js',
            'select2'                    => 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
            'flexSlider'                 => 'https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.3/jquery.flexslider.js',
            'ace'                        => 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/ace.js',
            'sweetAlert'                 => 'https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js'
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
            'bootstrap'               => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
            'awesome'                 => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css',
            'datatables'              => 'https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css',
            'autoFillDatatables'      => 'https://cdn.datatables.net/autofill/2.2.0/css/autoFill.dataTables.min.css',
            'buttonsDatatables'       => 'https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css',
            'columnReorderDatatables' => 'https://cdn.datatables.net/colreorder/1.3.3/css/colReorder.dataTables.min.css',
            'fixedColumnsDatatables'  => 'https://cdn.datatables.net/fixedcolumns/3.2.2/css/fixedColumns.dataTables.min.css',
            'fixedHeaderDatatables'   => 'https://cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.dataTables.min.css',
            'keyTableDatatables'      => 'https://cdn.datatables.net/keytable/2.2.1/css/keyTable.dataTables.min.css',
            'responsiveDatatables'    => 'https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css',
            'rowGroupDatatables'      => 'https://cdn.datatables.net/rowgroup/1.0.0/css/rowGroup.dataTables.min.css',
            'rowReorderDatatables'    => 'https://cdn.datatables.net/rowreorder/1.2.0/css/rowReorder.dataTables.min.css',
            'scrollerDatatables'      => 'https://cdn.datatables.net/scroller/1.4.2/css/scroller.dataTables.min.css',
            'selectDatatables'        => 'https://cdn.datatables.net/select/1.2.2/css/select.dataTables.min.css',
            'morris'                  => 'https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css',
            'datepicker'              => 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
            'select2'                 => 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css',
            'flexSlider'              => 'https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.3/flexslider.css',
            'sweetAlert'              => 'https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css'
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
