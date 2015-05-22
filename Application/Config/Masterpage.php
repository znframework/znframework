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
* LOGO                                                             		  	  			  *
*******************************************************************************************
| Genel Kullanım: Web sitesinin tarayıcıda görünen logo eklemek için logonun 			  |
| yolunu yazınız.										  		  			 	          | 
******************************************************************************************/
$config['Masterpage']['logo'] = '';

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
$config['Masterpage']['font'] 	= array();

/******************************************************************************************
* STYLE			                                                		  	  			  *
*******************************************************************************************
| Genel Kullanım: Harici css dosyası kullanımı kullanmak istediğiniz stil dosyalarını     |
| Views/Styles/ dizinine atmanız gerekmektedir. Aşağıdaki dizi içerisine Views/Styles/ 	  |
| dizinindeki dosya/dosyaların isimlerini yazmanız yeterlidir.							  |		
******************************************************************************************/
$config['Masterpage']['style'] 	= array();

/******************************************************************************************
* SCRIPT     	                                                		  	  			  *
*******************************************************************************************
| Genel Kullanım: Harici javascript dosyası kullanımı. Aşağıdaki dizi içerisine 		  |
| Views/Scripts/ dizinindeki dosya/dosyaların isimlerini yazmanız yeterlidir.			  |		
******************************************************************************************/
$config['Masterpage']['script'] 	= array();

/******************************************************************************************
* TITLE     	                                                		  	  			  *
*******************************************************************************************
| Genel Kullanım: Tüm sayfalar için varsayılan başlık bilgisi.					 		  |	
******************************************************************************************/
$config['Masterpage']['title'] 	= '';

/******************************************************************************************
* DESCRIPTION  	                                                		  	  			  *
*******************************************************************************************
| Genel Kullanım: Tüm sayfalar için varsayılan açıklama bilgisi.					 	  |	
******************************************************************************************/
$config['Masterpage']['description'] = '';

/******************************************************************************************
* AUTHOR    	                                                		  	  			  *
*******************************************************************************************
| Genel Kullanım: Tüm sayfalar için varsayılan sayfa yazarı bilgisi.					  |	
******************************************************************************************/
$config['Masterpage']['author'] = '';

/******************************************************************************************
* DESIGNER    	                                                		  	  			  *
*******************************************************************************************
| Genel Kullanım: Tüm sayfalar için varsayılan sayfa tasarımcı bilgisi.					  |	
******************************************************************************************/
$config['Masterpage']['designer'] = '';

/******************************************************************************************
* DISTRIBUTION 	                                                		  	  			  *
*******************************************************************************************
| Genel Kullanım: Tüm sayfalar için varsayılan sayfanın hitap bilgisi.					  |	
******************************************************************************************/
$config['Masterpage']['distribution'] = '';

/******************************************************************************************
* KEYWORDS 	                                                		  	  			  	  *
*******************************************************************************************
| Genel Kullanım: Tüm sayfalar için varsayılan site anahtar kelimeler bilgisi.			  |	
******************************************************************************************/
$config['Masterpage']['keywords'] = '';

/******************************************************************************************
* CACHE 	                                                		  	  			  	  *
*******************************************************************************************
| Genel Kullanım: Tüm sayfalar için varsayılan ilgili sayfayı ön bellekleme bilgisi.	  |	
******************************************************************************************/
$config['Masterpage']['cache'] 	= '';

/******************************************************************************************
* REFRESH 	                                                		  	  			  	  *
*******************************************************************************************
| Genel Kullanım: Tüm sayfalar için varsayılan sayfa yenilenme bilgisi.	  				  |	
******************************************************************************************/
$config['Masterpage']['refresh'] = '';

/******************************************************************************************
* ABSTRACT 	                                                		  	  			  	  *
*******************************************************************************************
| Genel Kullanım: Tüm sayfalar için varsayılan site bilgisi.	  				 		  |	
******************************************************************************************/
$config['Masterpage']['abstract'] = '';

/******************************************************************************************
* COPYRIGHT	                                                		  	  			  	  *
*******************************************************************************************
| Genel Kullanım: Tüm sayfalar için varsayılan telif hakkı bilgisi.	  				 	  |	
******************************************************************************************/
$config['Masterpage']['copyright'] = '';

/******************************************************************************************
* EXPIRES	                                                		  	  			  	  *
*******************************************************************************************
| Genel Kullanım: Tüm sayfalar için varsayılan zaman aşımı bilgisi.	  				 	  |	
******************************************************************************************/
$config['Masterpage']['expires'] = '';

/******************************************************************************************
* PRAGMA	                                                		  	  			  	  *
*******************************************************************************************
| Genel Kullanım: Tüm sayfalar için varsayılan sistem bilgilerini arama motoruna 		  |
| gösterme bilgisi.	  				 	  												  |	
******************************************************************************************/
$config['Masterpage']['pragma'] = '';

/******************************************************************************************
* REVISIT	                                                		  	  			  	  *
*******************************************************************************************
| Genel Kullanım: Tüm sayfalar için varsayılan güncellenme bilgisi 		  				  |
******************************************************************************************/
$config['Masterpage']['revisit'] = '';

/******************************************************************************************
* ROBOTS	                                                		  	  			  	  *
*******************************************************************************************
| Genel Kullanım: Tüm sayfalar için varsayılan arama motoru takip linkleri bilgisi.		  |
******************************************************************************************/
$config['Masterpage']['robots'] = array();

/******************************************************************************************
* META NAME	ve HTTP                                               		  	  			  *
*******************************************************************************************
| Genel Kullanım: Farklı bir meta tagı veya tagları kullanmak istiyorsanız dizi içerisine |
| ve bu veri name içerikli ise name => content tipi anahtar => değer bilgiler girin. Şayet|
| http-equiv içerkli ise http-equiv => content tipi anahtar => değer bilgiler girin.	  |
******************************************************************************************/
$config['Masterpage']['meta'] = array
(
	'name' => array(),
	'http' => array()
);

/******************************************************************************************
* DATA                                               		  	  						  *
*******************************************************************************************
| Genel Kullanım: Head tagları arasına farklı bir bilgi veya bilgiler eklenmek isteniyorsa| 
| dizi elemanı olarak yazmanız yeterlidir.	  											  |
******************************************************************************************/
$config['Masterpage']['data'] = array();