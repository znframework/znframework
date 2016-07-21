<?php
//----------------------------------------------------------------------------------------------------
// Components 
//----------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Table
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: Ön tanımlı grid ayarı yapmak için kullanılır.			  	  					  						
//
//----------------------------------------------------------------------------------------------------
$config['EncodingSupport']['ml'] =
[
	//------------------------------------------------------------------------------------------------
	// Table
	//------------------------------------------------------------------------------------------------
	//
	// Genel Kullanımı: ML::table() yöntemine ait ayarlar yer alır.  	  					  						
	//
	//------------------------------------------------------------------------------------------------
	'table' => 
	[
		//--------------------------------------------------------------------------------------------
		// Labels
		//--------------------------------------------------------------------------------------------
		//
		// Genel Kullanımı: Tabloda yer alan açıklamaları düzenler.	  					  						
		//
		//--------------------------------------------------------------------------------------------
		'labels' => 
		[
			'title' 	=> lang('ML', 'titleLabel'),
			'confirm' 	=> lang('ML', 'confirmLabel'),
			'process'	=> lang('ML', 'processLabel'),
			'keywords'	=> lang('ML', 'keywordsLabel'),
		],
		
		//--------------------------------------------------------------------------------------------
		// Button Names
		//--------------------------------------------------------------------------------------------
		//
		// Genel Kullanımı: Tabloda yer alan butonların isimlerini düzenlemek için kullanılır.  	  					  						
		//
		//--------------------------------------------------------------------------------------------
		'buttonNames' =>
		[
			'add'    		=> lang('ML', 'addButton'),
			'update'   		=> lang('ML', 'updateButton'),
			'delete'   		=> lang('ML', 'deleteButton'),
			'clear'   		=> lang('ML', 'clearButton'),
			'search'		=> lang('ML', 'searchButton')
		],
		
		//--------------------------------------------------------------------------------------------
		// Button Names
		//--------------------------------------------------------------------------------------------
		//
		// Genel Kullanımı: Tabloda yer Arama ve yeni ekle veri kutularının var sayılan input
		// bilgisini değiştirmek için kullanılır.  	  					  						
		//
		//--------------------------------------------------------------------------------------------
		'placeHolders' =>
		[
			'keyword'     => lang('ML', 'keywordPlaceHolder'),
			'addLanguage' => lang('ML', 'addLanguagePlaceHolder'),
			'search'	  => lang('ML', 'searchPlaceHolder')
		],
		
		//--------------------------------------------------------------------------------------------
		// Attributes
		//--------------------------------------------------------------------------------------------
		//
		// Genel Kullanımı: Grid'de yer alan buton ve linklere ait attibute yani özellik eklemek
		// için kullanılır.	  	  					  						
		//
		//--------------------------------------------------------------------------------------------
		'attributes' 	=> 
		[
			'table'  		=> ['width' => '100%', 'cellspacing' => 0, 'cellpadding' => 10, 'style' => 'border:solid 1px #ddd; font-family:Arial; color:#888; font-size:14px;'],
			'add'	 		=> ['style' => 'height:30px; color:#0085B2; background:none; border:solid 1px #0085B2; cursor:pointer'],
			'update'	 	=> ['style' => 'height:30px; color:#0085B2; background:none; border:solid 1px #0085B2; cursor:pointer'],
			'delete'	 	=> ['style' => 'height:30px; color:#0085B2; background:none; border:solid 1px #0085B2; cursor:pointer'],
			'clear'	 		=> ['style' => 'height:30px; color:#0085B2; background:none; border:solid 1px #0085B2; cursor:pointer'],
			'textbox' 		=> ['style' => 'height:30px; color:#0085B2; border:solid 1px #0085B2; text-indent:10px']

		],
		
		//--------------------------------------------------------------------------------------------
		// Colors
		//--------------------------------------------------------------------------------------------
		//
		// Genel Kullanımı: Grid'de yer alan yapıların renklerini düzenlemek için kullanılır.	  	  					  						
		//
		//--------------------------------------------------------------------------------------------
		'colors' =>
		[
			'rowOrder' => ['single' => '#fff', 'double' => '#E6F9FF']
		],
		
		//--------------------------------------------------------------------------------------------
		// Pagination
		//--------------------------------------------------------------------------------------------
		//
		// Genel Kullanımı: Class ve Style gönderimi için kullanılır.	  					  						
		//
		//--------------------------------------------------------------------------------------------
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
];