<?php
/************************************************************/
/*                  MASTERPAGE(ANASAYFA)                    */
/************************************************************/
/*

Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
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
| Parametre:Metinsel türde Views/ dizininden tüm sayfalar için geçerli olacak bir         | 
| head sayfası belirlenir. Örnek: "head";  veya array(h1, h2 ....) 						  |  
******************************************************************************************/
$config['Masterpage']['headPage'] = ''; // String veya Array veri türü içerebilir.

/******************************************************************************************
* BODY PAGE                                                                   		  	  *
*******************************************************************************************
| Genel Kullanım: Masterpage olacak sayfayı ayarlamak için kullanılır.					  |
| Parametre:Metinsel türde Views/ dizininden masterpage olarak düşünülen sayfa 	          |
| adı bilgisi girilir. Örnek: "body";											  		  |  
******************************************************************************************/
$config['Masterpage']['bodyPage'] = '';

/******************************************************************************************
* DOCTYPE                                                                   		  	  *
*******************************************************************************************
| Genel Kullanım: Sayfanın döküman türü varsayılan:xhtml1-trans.			  			  | 
******************************************************************************************/
$config['Masterpage']['docType'] = 'xhtml1Transitional';

/******************************************************************************************
* CONTENT CHARSET                                                             		  	  *
*******************************************************************************************
| Genel Kullanım: Sayfanın dil kodlaması varsayılarn:utf-8.			  			 	      | 
******************************************************************************************/
$config['Masterpage']['contentCharset'] = array('utf-8');

/******************************************************************************************
* CONTENT LANGUAGE                                                             		  	  *
*******************************************************************************************
| Genel Kullanım: Sayfanın dil içeriği varsayılan:tr.			  			 	          | 
******************************************************************************************/
$config['Masterpage']['contentLanguage'] = 'tr';

/******************************************************************************************
* BROWSER/SHORTCUT ICON                                                             	  *
*******************************************************************************************
| Genel Kullanım: Web sitesinin tarayıcıda görünen ikon eklemek için ikonun 			  |
| yolunu yazınız.										  		  			 	          | 
******************************************************************************************/
$config['Masterpage']['browserIcon'] = '';

/******************************************************************************************
* BACKGROUND IMAGE                                                		  	  			  *
*******************************************************************************************
| Genel Kullanım: Web sitesinin arkaplan resmi.								  			  |
******************************************************************************************/
$config['Masterpage']['backgroundImage'] = '';

/******************************************************************************************
* FONT			                                                		  	  			  *
*******************************************************************************************
| Genel Kullanım: Harici font kullanımı kullanmak istediğiniz özel fontları 			  |
| Resources/Fonts/																		  |
|dizinine atıp bu dizin içindek dosyanın adını yazarak kullanabilirsiniz.				  |
| Aşağıdaki dizi içerisine Resources/Fonts/ dizinindeki dosya/dosyaların isimlerini       |
| yazmanız yeterlidir.								  			 					 	  |		
******************************************************************************************/
$config['Masterpage']['font'] = array();

/******************************************************************************************
* STYLE			                                                		  	  			  *
*******************************************************************************************
| Genel Kullanım: Harici css dosyası kullanımı kullanmak istediğiniz stil dosyalarını     |
| Resources/Styles/ dizinine atmanız gerekmektedir. Aşağıdaki dizi içerisine              |
| Resources/Styles/                      												  |
| dizinindeki dosya/dosyaların isimlerini yazmanız yeterlidir.							  |		
******************************************************************************************/
$config['Masterpage']['style'] = array();

/******************************************************************************************
* SCRIPT     	                                                		  	  			  *
*******************************************************************************************
| Genel Kullanım: Harici javascript dosyası kullanımı. Aşağıdaki dizi içerisine 		  |
| Resources/Scripts/ dizinindeki dosya/dosyaların isimlerini yazmanız yeterlidir.	      |		
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