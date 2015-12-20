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