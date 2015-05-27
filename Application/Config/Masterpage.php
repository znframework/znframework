<?php
/************************************************************/
/*                  MASTERPAGE(ANASAYFA)                    */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

/******************************************************************************************
* MASTERPAGE                                                                   		  	  *
*******************************************************************************************
| Genel Kullanım: Masterpage ile ilgili ayarlar yer almaktadır.	     					  |
******************************************************************************************/

/******************************************************************************************
* MASTERPAGE                                                                   		  	  *
*******************************************************************************************
| Genel Kullanım: Masterpage olarak belirlen sayfanın head etiketleri arasına harici kod  |
| yazmak için sayfa belirlemek için kullanlır.											  |
| Parametre:Metinsel türde Views/Pages/ dizininden tüm sayfalar için geçerli olacak bir   |
| head sayfası belirlenir. Örnek: "head";  												  |  
******************************************************************************************/
$config['Masterpage']['head_page'] = '';

/******************************************************************************************
* BODY PAGE                                                                   		  	  *
*******************************************************************************************
| Genel Kullanım: Masterpage olacak sayfayı ayarlamak için kullanılır.					  |
| Parametre:Metinsel türde Views/Pages/ dizininden masterpage olarak düşünülen sayfa 	  |
| adı bilgisi girilir. Örnek: "body";											  		  |  
******************************************************************************************/
$config['Masterpage']['body_page'] = '';

/******************************************************************************************
* DOCTYPE                                                                   		  	  *
*******************************************************************************************
| Genel Kullanım: Sayfanın döküman türü varsayılan:xhtml1-trans.			  			  | 
******************************************************************************************/
$config['Masterpage']['doctype'] = 'xhtml1_transitional';

/******************************************************************************************
* CONTENT CHARSET                                                             		  	  *
*******************************************************************************************
| Genel Kullanım: Sayfanın dil kodlaması varsayılarn:utf-8.			  			 	      | 
******************************************************************************************/
$config['Masterpage']['content_charset'] = array('utf-8');

/******************************************************************************************
* CONTENT LANGUAGE                                                             		  	  *
*******************************************************************************************
| Genel Kullanım: Sayfanın dil içeriği varsayılan:tr.			  			 	          | 
******************************************************************************************/
$config['Masterpage']['content_language'] = 'tr';

/******************************************************************************************
* BROWSER/SHORTCUT ICON                                                             	  *
*******************************************************************************************
| Genel Kullanım: Web sitesinin tarayıcıda görünen ikon eklemek için ikonun 			  |
| yolunu yazınız.										  		  			 	          | 
******************************************************************************************/
$config['Masterpage']['browser_icon'] = '';

/******************************************************************************************
* BACKGROUND IMAGE                                                		  	  			  *
*******************************************************************************************
| Genel Kullanım: Web sitesinin arkaplan resmi.								  			  |
******************************************************************************************/
$config['Masterpage']['bg_image'] = '';

/******************************************************************************************
* FONT			                                                		  	  			  *
*******************************************************************************************
| Genel Kullanım: Harici font kullanımı kullanmak istediğiniz özel fontları Views/Fonts/  |
|dizinine atıp bu dizin içindek dosyanın adını yazarak kullanabilirsiniz.				  |
| Aşağıdaki dizi içerisine Views/Fonts/ dizinindeki dosya/dosyaların isimlerini 		  |
| yazmanız yeterlidir.								  			 					 	  |		
******************************************************************************************/
$config['Masterpage']['font'] = array();

/******************************************************************************************
* STYLE			                                                		  	  			  *
*******************************************************************************************
| Genel Kullanım: Harici css dosyası kullanımı kullanmak istediğiniz stil dosyalarını     |
| Views/Styles/ dizinine atmanız gerekmektedir. Aşağıdaki dizi içerisine Views/Styles/ 	  |
| dizinindeki dosya/dosyaların isimlerini yazmanız yeterlidir.							  |		
******************************************************************************************/
$config['Masterpage']['style'] = array();

/******************************************************************************************
* SCRIPT     	                                                		  	  			  *
*******************************************************************************************
| Genel Kullanım: Harici javascript dosyası kullanımı. Aşağıdaki dizi içerisine 		  |
| Views/Scripts/ dizinindeki dosya/dosyaların isimlerini yazmanız yeterlidir.			  |		
******************************************************************************************/
$config['Masterpage']['script'] = array();

/******************************************************************************************
* TITLE     	                                                		  	  			  *
*******************************************************************************************
| Genel Kullanım: Tüm sayfalar için varsayılan başlık bilgisi.					 		  |	
******************************************************************************************/
$config['Masterpage']['title'] 	= '';

/******************************************************************************************
* META DATAS             	                                                		  	  *
*******************************************************************************************
| Genel Kullanım: Standart olarak kullanılan meta verilerini kullanmak için oluşturuldu.  |	
| Meta içeri name ise name-> ayracı, http-equiv ise http-> ayracı kullanılarak 			  |
| meta tagları ekleyebilirsiniz.														  |
|																					      |
| Aşağıdaki taglar ön tanımlı meta taglarıdır.  									      |
|																					      |
******************************************************************************************/
$config['Masterpage']['meta'] = array
(
	'name->description'		=> '', 
	'name->author'			=> '',
	'name->designer'		=> '',
	'name->distribution'	=> '',
	'name->keywords'		=> '',
	'http->cache-control' 	=> '',
	'http->refresh'			=> '',
	'name->abstract'		=> '',
	'name->copyright'		=> '',
	'name->expires'			=> '',
	'name->pragma'			=> '',
	'name->revisit-after'	=> '',
	'name->robots'			=> array()
);

/******************************************************************************************
* DATA                                               		  	  						  *
*******************************************************************************************
| Genel Kullanım: Head tagları arasına farklı bir bilgi veya bilgiler eklenmek isteniyorsa| 
| dizi elemanı olarak yazmanız yeterlidir.	  											  |
******************************************************************************************/
$config['Masterpage']['data'] = array();