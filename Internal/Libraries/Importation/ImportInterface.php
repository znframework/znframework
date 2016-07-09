<?php
namespace ZN\Importation;

interface ImportInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// usable()
	//----------------------------------------------------------------------------------------------------
	//
	// @var bool $usable
	//
	//----------------------------------------------------------------------------------------------------
	public function usable($usable);
	
	//----------------------------------------------------------------------------------------------------
	// recursive()
	//----------------------------------------------------------------------------------------------------
	//
	// @var bool $recursive
	//
	//----------------------------------------------------------------------------------------------------
	public function recursive($recursive);
	
	//----------------------------------------------------------------------------------------------------
	// data()
	//----------------------------------------------------------------------------------------------------
	//
	// @var array $data
	//
	//----------------------------------------------------------------------------------------------------
	public function data($data);
	
	//----------------------------------------------------------------------------------------------------
	// headData()
	//----------------------------------------------------------------------------------------------------
	//
	// @var string $headData
	//
	//----------------------------------------------------------------------------------------------------
	public function headData($headData);
	
	//----------------------------------------------------------------------------------------------------
	// body()
	//----------------------------------------------------------------------------------------------------
	//
	// @var string $body
	//
	//----------------------------------------------------------------------------------------------------
	public function body($body);
	
	//----------------------------------------------------------------------------------------------------
	// head()
	//----------------------------------------------------------------------------------------------------
	//
	// @var mixed $head
	//
	//----------------------------------------------------------------------------------------------------
	public function head($head);
	
	//----------------------------------------------------------------------------------------------------
	// title()
	//----------------------------------------------------------------------------------------------------
	//
	// @var string $title
	//
	//----------------------------------------------------------------------------------------------------
	public function title($title);
	
	//----------------------------------------------------------------------------------------------------
	// meta()
	//----------------------------------------------------------------------------------------------------
	//
	// @var array $meta
	//
	//----------------------------------------------------------------------------------------------------
	public function meta($meta);
	
	//----------------------------------------------------------------------------------------------------
	// attributes()
	//----------------------------------------------------------------------------------------------------
	//
	// @var array $attributes
	//
	//----------------------------------------------------------------------------------------------------
	public function attributes($attributes);
	
	//----------------------------------------------------------------------------------------------------
	// content()
	//----------------------------------------------------------------------------------------------------
	//
	// @var array $content
	//
	//----------------------------------------------------------------------------------------------------
	public function content($content);
	
	/******************************************************************************************
	* PAGE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Views dosyası dahil etmek için kullanılır.						      |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @page => Dahil edilecek dosyanın yolu.								      |
	| 2. array var @data => Dahil edilecen sayfaya gönderilecek veriler.				      |
	| 3. boolean var @ob_get_contents => İçeriğin kullanımıyla ilgilidir..		              |
	|          																				  |
	| Örnek Kullanım: Import::page('OrnekSayfa');        	  								  |
	|          																				  |
	******************************************************************************************/
	public function page($page, $data, $obGetContents, $randomPageDir);
	
	/******************************************************************************************
	* VIEW                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Views dosyası dahil etmek için kullanılır.						      |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @page => Dahil edilecek dosyanın yolu.								      |
	| 2. array var @data => Dahil edilecen sayfaya gönderilecek veriler.				      |
	| 3. boolean var @ob_get_contents => İçeriğin kullanımıyla ilgilidir..		              |
	|          																				  |
	| Örnek Kullanım: Import::page('OrnekSayfa');        	  								  |
	|          																				  |
	******************************************************************************************/
	public function view($page, $data, $obGetContents, $randomPageDir);
	
	/******************************************************************************************
	* HANDLOAD                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Views dosyası dahil etmek için kullanılır.						      |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @page => Dahil edilecek dosyanın yolu.								      |
	| 2. array var @data => Dahil edilecen sayfaya gönderilecek veriler.				      |
	| 3. boolean var @ob_get_contents => İçeriğin kullanımıyla ilgilidir..		              |
	|          																				  |
	| Örnek Kullanım: Import::page('OrnekSayfa');        	  								  |
	|          																				  |
	******************************************************************************************/
	public function handload();
	
	/******************************************************************************************
	* VIEW                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Views dosyası dahil etmek için kullanılır.						      |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @page => Dahil edilecek dosyanın yolu.								      |
	| 2. array var @data => Dahil edilecen sayfaya gönderilecek veriler.				      |
	| 3. boolean var @ob_get_contents => İçeriğin kullanımıyla ilgilidir..		              |
	|          																				  |
	| Örnek Kullanım: Import::page('OrnekSayfa');        	  								  |
	|          																				  |
	******************************************************************************************/
	public function template($page, $data, $obGetContents);
	
	/******************************************************************************************
	* MASTERPAGE                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Views/ dizini içinde yer alan herhangi bir sayfayı masterpage           |
	| olarak ayarlamak için kullanılır.										  				  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. array var @data => Sayfanın body bölümüne veri göndermek için kullanılır. 		      |
	| 2. array var @head => Sayfanın head bölümüne veri göndermek için kullanılır. 			  |
	|          																				  |
	| Örnek Kullanım: Import::masterpage();        						  					  |
	|          																				  |
	| NOT: Bir sayfayı masterpage olarak ayarlamak için Config/Masterpage.php dosyası		  |
	| kullanılır.	        															      |
	|          																				  |
	******************************************************************************************/
	public function masterPage($randomDataVariable, $head);
	
	/******************************************************************************************
	* FONT                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Harici font yüklemek için kullanılır. Yüklenmek istenen fontlar		  |
	| Resources/Fonts/ dizinine atılır.										  				  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. array/args var @fonts => Parametre olarak sıralı font dosyalarını veya dizi içinde   |
	| eleman olarak kullanılan font dosyalarını dahil etmek için kullanılır.			      |
	|          																				  |
	| Örnek Kullanım: Import::font('f1', 'f2' ... 'fN');        						      |
	| Örnek Kullanım: Import::font(array('f1', 'f2' ... 'fN'));        				          |
	|          																				  |
	******************************************************************************************/
	public function font();
	
	/******************************************************************************************
	* STYLE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Harici stil yüklemek için kullanılır. Yüklenmek istenen stiller		  |
	| Resources/Styles/ dizinine atılır.			     				  				      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. array/args var @styles => Parametre olarak sıralı stil dosyalarını veya dizi içinde  |
	| eleman olarak kullanılan stil dosyalarını dahil etmek için kullanılır.			      |
	|          																				  |
	| Örnek Kullanım: Import::style('s1', 's2' ... 'sN');        						      |
	| Örnek Kullanım: Import::style(array('s1', 's2' ... 'sN'));        				      |
	|          																				  |
	******************************************************************************************/
	public function style();	

	/******************************************************************************************
	* SCRIPT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Harici js dosyası yüklemek için kullanılır. Yüklenmek istenen stiller	  |
	| Resources/Scripts/ dizinine atılır.		    						  				  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. array/args var @scripts => Parametre olarak sıralı js dosyalarını veya dizi içinde   |
	| eleman olarak kullanılan js dosyalarını dahil etmek için kullanılır.			     	  |
	|          																				  |
	| Örnek Kullanım: Import::script('s1', 's2' ... 'sN');        						      |
	| Örnek Kullanım: Import::script(script('s1', 's2' ... 'sN'));        				      |
	|          																				  |
	******************************************************************************************/
	public function script();
	
	/******************************************************************************************
	* SOMETHING                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Herhangi bir dosya dahil etmek için kullanılır.						  |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @page => Dahil edilecek dosyanın yolu.								      |
	| 2. array var @data => Dahil edilecen sayfaya gönderilecek veriler.				      |
	| 3. boolean var @ob_get_contents => İçeriğin kullanımıyla ilgilidir..		              |
	|          																				  |
	| Örnek Kullanım: Import::something('Application/Views/OrnekSayfa.php');             	  |
	| Örnek Kullanım: Import::something('Application/Resources/Styles/Stil.js');  	          |
	|          																				  |
	******************************************************************************************/
	public function something($randomPageVariable, $randomDataVariable, $randomObGetContentsVariable);
	
	//----------------------------------------------------------------------------------------------------
	// Package
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $package
	// @param bool   $recursive  
	// @param bool   $getContents    	              
	//          																				  
	//----------------------------------------------------------------------------------------------------
	public function package($package, $recursive, $getContents);
	
	//----------------------------------------------------------------------------------------------------
	// Theme
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $theme
	// @param bool   $recursive  
	// @param bool   $getContents     	              
	//          																				  
	//----------------------------------------------------------------------------------------------------
	public function theme($theme, $recursive, $getContents);
	
	//----------------------------------------------------------------------------------------------------
	// Plugin
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $plugin
	// @param bool   $recursive  
	// @param bool   $getContents     	              
	//          																				  
	//----------------------------------------------------------------------------------------------------
	public function plugin($plugin, $recursive, $getContents);
}