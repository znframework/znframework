<?php
//----------------------------------------------------------------------------------------------------
// Components 
//----------------------------------------------------------------------------------------------------
//
// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.zntr.net
// Lisans     : The MIT License
// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
//
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Pagination
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: Ön tanımlı sayfalama ayarı yapmak için kullanılır.			  	  					  						
//
//----------------------------------------------------------------------------------------------------
$config['Components']['pagination'] = array
(
	'prevName' 		=> '<', 
	'nextName' 		=> '>',
	'firstName'		=> '<<',
	'lastName'		=> '>>',
	
	'totalRows' 	=> 50,
	'start'			=> NULL,
	'limit'			=> 10,
	'countLinks' 	=> 10,
	'type'			=> 'classic', // classic, ajax
	
	'class' => array
	(
		'current' 	=> '',
		'links' 	=> '',
		'prev'		=> '',
		'next'		=> '',
		'last'		=> '',
		'first'		=> ''
	),
	
	'style' => array
	(
		'current' 	=> '',
		'links' 	=> '',
		'prev'		=> '',
		'next'		=> '',
		'last'		=> '',
		'first'		=> ''
	),
);

//----------------------------------------------------------------------------------------------------
// Captcha
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: Ön tanımlı güvenlik kodu ayarı yapmak için kullanılır.			  	  					  						
//
//----------------------------------------------------------------------------------------------------
$config['Components']['captcha'] = array
(
	'charLength' 	=> '6',  
	'bgColor' 		=>'80|80|80',
	'background'	=> array(),
	'textColor'		=> '255|255|255',
	'border' 		=> false,
	'borderColor' 	=> '0|0|0',
	'width' 		=> '180',
	'height' 		=> '40',
	'imageString' 	=> array('size' => '5', 'x' => '65', 'y' => '13'),
	'grid' 			=> true, 
	'gridSpace' 	=> array('x' => 12, 'y' => 4),
	'gridColor' 	=> '50|50|50'
);

//----------------------------------------------------------------------------------------------------
// Calendar
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: Ön tanımlı takvim ayarı yapmak için kullanılır.			  	  					  						
//
//----------------------------------------------------------------------------------------------------
$config['Components']['calendar'] = array
(
	
	'prevName' 		=> '<<', 
	'nextName' 		=> '>>',
	
	'dayType'   	=> 'short',
	'monthType' 	=> 'long',	
	'type'			=> 'classic', // classic, ajax

	'class' => array
	(
		'table' 	=> '',
		'monthName' => '',
		'dayName' 	=> '',
		'days' 		=> '',
		'links' 	=> '',
		'current' 	=> '',
	),
	
	'style' => array
	(
		'table' 	=> '',
		'monthName' => '',
		'dayName' 	=> '',
		'days' 		=> '',
		'links' 	=> '',
		'current' 	=> '',
	),
	
	'monthNames' => array
	(
		'tr' => array
				(
					'Ocak' 		=> 'Oca', 
					'Şubat' 	=> 'Şub', 
					'Mart' 		=> 'Mar', 
					'Nisan' 	=> 'Nis', 
					'Mayıs' 	=> 'May', 
					'Haziran' 	=> 'Haz', 
					'Temmuz' 	=> 'Tem', 
					'Ağustos' 	=> 'Ağu', 
					'Eylül' 	=> 'Eyl', 
					'Ekim' 		=> 'Eki', 
					'Kasım'		=> 'Kas', 
					'Aralık' 	=> 'Ara'
				),
					
		'en' => array
				(
					'Janury'	=> 'Jan', 
					'February'	=> 'Feb', 
					'March'		=> 'Mar', 
					'April'		=> 'Apr', 
					'May'		=> 'May', 
					'June'		=> 'Jun', 
					'July'		=> 'Jul', 
					'August'	=> 'Aug', 
					'September'	=> 'Sep', 
					'October'	=> 'Oct', 
					'November'	=> 'Nov', 
					'December'	=> 'Dec'
				)
	),
	
	'dayNames' => array
	(
		'tr' => array
				(
					'Pazartesi' => 'Pzt', 
					'Salı'		=> 'Sal',	 	
					'Çarşamba'	=> 'Çar', 
					'Perşembe'	=> 'Per', 
					'Cuma'		=> 'Cum', 
					'Cumartesi'	=> 'Cts', 
					'Pazar'		=> 'Paz'
				),
					
		'en' => array
				(
					'Monday'	=> 'Mon', 
					'Tuesday'	=> 'Tue', 
					'Wednesday'	=> 'Wed', 
					'Thursday'	=> 'Thu', 
					'Friday'	=> 'Fri', 
					'Saturday'	=> 'Sat', 
					'Sunday'	=> 'Sun'
				)
	)
);	

//----------------------------------------------------------------------------------------------------
// Terminal
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: Ön tanımlı konsol ayarı yapmak için kullanılır.			  	  					  						
//
//----------------------------------------------------------------------------------------------------
$config['Components']['terminal'] = array
(
	'width' 		=> '800px', 
	'height' 		=> '350px', 
	'bgColor' 		=> '#000', 
	'barBgColor' 	=> '#222', 
	'textColor' 	=> '#ccc', 
	'textType' 		=> 'Consolas, monospace', 
	'textSize' 		=> '12px'
);

//----------------------------------------------------------------------------------------------------
// DataGrid
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: Ön tanımlı grid ayarı yapmak için kullanılır.			  	  					  						
//
//----------------------------------------------------------------------------------------------------
$config['Components']['datagrid'] = array
(
	//------------------------------------------------------------------------------------------------
	// Button Names
	//------------------------------------------------------------------------------------------------
	//
	// Genel Kullanımı: DataGrid'de yer alan butonların isimlerini düzenlemek için kullanılır.  	  					  						
	//
	//------------------------------------------------------------------------------------------------
	'buttonNames' => array
	(
		'add'    		=> lang('DataGrid', 'addButton'),
		'edit'   		=> lang('DataGrid', 'editButton'),
		'update'   		=> lang('DataGrid', 'updateButton'),
		'save'   		=> lang('DataGrid', 'saveButton'),
		'delete' 		=> lang('DataGrid', 'deleteButton'),
		'deleteCurrent' => lang('DataGrid', 'deleteCurrentName'),
		'deleteAll' 	=> lang('DataGrid', 'deleteAllName')
	),
	
	//------------------------------------------------------------------------------------------------
	// Cdn Links
	//------------------------------------------------------------------------------------------------
	//
	// Genel Kullanımı: Uzaktan jquery, jqueryui ve bootstrap'a ait css dosyalarının kullanım 
	// durumları ayarlanır. Mevcut sayfanızda zaten bir jquery dosyası dahil ediliyorsa aşağıdaki
	// değerler false olarak ayarlanmalıdır.  	  					  						
	//
	//------------------------------------------------------------------------------------------------
	'cdn' => array
	(
		'jquery'    => true,
		'jqueryUi'  => false,
		'bootstrap' => false
	),
	
	//------------------------------------------------------------------------------------------------
	// Attributes
	//------------------------------------------------------------------------------------------------
	//
	// Genel Kullanımı: Grid'de yer alan buton ve linklere ait attibute yani özellik eklemek
	// için kullanılır.	  	  					  						
	//
	//------------------------------------------------------------------------------------------------
	'attributes' 	=> array
	(
		'table'  		=> array('width' => '100%', 'cellspacing' => 0, 'cellpadding' => 10, 'style' => 'border:solid 1px #ddd; font-family:Arial; color:#888; font-size:14px;'),
		'columns'  		=> array('style' => 'text-decoration:none; color:#0085B2'),
		'search' 		=> array('style' => 'height:30px; color:#0085B2; border:solid 1px #0085B2; text-indent:10px'),
		'add'	 		=> array('style' => 'height:30px; color:#0085B2; background:none; border:solid 1px #0085B2;'),
		'deleteCurrent' => array('style' => 'height:30px; color:#0085B2; background:none; border:solid 1px #0085B2;'),
		'deleteAll' 	=> array('style' => 'height:30px; color:#0085B2; background:none; border:solid 1px #0085B2;'),
		'delete' 		=> array('style' => 'text-decoration:none; color:red; font-weight:bold'),
		'edit'	 		=> array('style' => 'text-decoration:none; color:#0085B2; font-weight:bold'),
		'update'	 	=> array('style' => 'height:30px; color:#0085B2; background:none; border:solid 1px #0085B2;'),
		'save'	 	    => array('style' => 'height:30px; color:#0085B2; background:none; border:solid 1px #0085B2;'),
		'listTables'	=> array(),
	),
	
	//------------------------------------------------------------------------------------------------
	// Colors
	//------------------------------------------------------------------------------------------------
	//
	// Genel Kullanımı: Grid'de yer alan yapıların renklerini düzenlemek için kullanılır.	  	  					  						
	//
	//------------------------------------------------------------------------------------------------
	'colors' => array
	(
		'rowOrder' => array('single' => '#fff', 'double' => '#E6F9FF')
	),
	
	//------------------------------------------------------------------------------------------------
	// Pagination
	//------------------------------------------------------------------------------------------------
	//
	// Genel Kullanımı: Yukardaki ayarlar aynen geçerlidir. Sadece Datagrid için farklı bir.
	// sayfalama görünümü dizayn edilmek istenirse yukarıdaki ayarların kullanımı değişmeyecek
	// şekilde kullanılabilir. Ortak bir sayfalama tasarımı kullanıyorsa zaten sayfalama ayarlarının
	// yukarıdaki mevcut ayarlarından yapılması tavsiye edilir.	  	  					  						
	//
	//------------------------------------------------------------------------------------------------
	'pagination' => array
	(
		'style' => array
		(
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
		)
	)
);