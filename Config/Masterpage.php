<?php
/************************************************************/
/*                  MASTERPAGE(ANASAYFA)                    */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

//--------------------------------------------------------------------------------------------------------------------------
SETTINGS
//--------------------------------------------------------------------------------------------------------------------------
1-content_charset
2-content_language
3-doctype
4-logo
5-bg_image
6-font
7-style
8-script
9-title
10-description
11-author
12-designer
13-distribution
14-keywords
15-cache
16-refresh
17-abstract
18-copyright
19-expires
20-pragma
21-revisit
22-robots
23-meta
24-data
//--------------------------------------------------------------------------------------------------------------------------

/* HEAD PAGE  */
// İşlev:Masterpage olarak belirlen sayfanın head etiketleri arasına harici kod yazmak için sayfa belirlemek için kullanlır.
// Parametre:Metinsel türde Designer/Pages/ dizininden tüm sayfalar için geçerli olacak bir head sayfası belirlenir. 
// Örnek: "head";
$config['Masterpage']['head_page'] = ''; // Designer/Pages/head_page.php

/* BODY PAGE  */
// İşlev:Masterpage olacak sayfayı ayarlamak için kullanılır.
// Parametre:Metinsel türde Designer/Pages/ dizininden masterpage olarak düşünülen sayfa adı bilgisi girilir. 
// Örnek: "body";
$config['Masterpage']['body_page'] = ''; // Designer/Pages/body_page.php

/* Sayfanın döküman türü varsayılan:xhtml1-trans*/
$config['Masterpage']['doctype'] = 'xhtml1_transitional';

/* Sayfanın dil kodlaması varsayılarn:utf-8*/
$config['Masterpage']['content_charset'] = array('utf-8');

/* Sayfanın dil içeriği varsayılan:tr*/
$config['Masterpage']['content_language'] = 'tr';

/* Web sitesinin tarayıcıda görünen logo eklemek için logonun yolunu yazınız varsayılan:*/
$config['Masterpage']['logo'] = '';

/* Web sitesinin arkaplan resmi varsayılan=*/
$config['Masterpage']['bg_image'] = '';

/* Harici font kullanımı kullanmak istediğiniz özel fontları Designer/Fonts/ dizinine atıp bu dizin içindek dosyanın adını yazarak kullanabilirsiniz varsayılan:*/
/* Aşağıdaki dizi içerisine Designer/Fonts/ dizinindeki dosya/dosyaların isimlerini yazmanız yeterlidir*/
$config['Masterpage']['font'] 	= array();

/* SVG, WOFF, EOT, OTF, TTF uzantılı fontlar dışında başka bir uzantılı font kullanacaksınız aşağıdaki diziye eklemeniz gerekmektedir.*/
/* Uzantı başında (.) nokta karakteri kullanmanıza yoktur. Örnek array('ufo', 'fon') şeklinde yazmanı yeterlidir.*/
$config['Masterpage']['different_font_extensions'] 	= array();

/* Harici css dosyası kullanımı kullanmak istediğiniz sitil dosyalarını Designer/Styles/ dizinine atmanız gerekmektedir*/
/* Aşağıdaki dizi içerisine Designer/Styles/ dizinindeki dosya/dosyaların isimlerini yazmanız yeterlidir*/
$config['Masterpage']['style'] 	= array();

/* Harici javascript dosyası kullanımı*/
/* Aşağıdaki dizi içerisine Designer/Scripts/ dizinindeki dosya/dosyaların isimlerini yazmanız yeterlidir*/
$config['Masterpage']['script'] 	= array();

/* Tüm sayfalar için varsayılan başlık bilgisi*/
$config['Masterpage']['title'] 	= '';

/* Tüm sayfalar için varsayılan açıklama bilgisi*/
$config['Masterpage']['description'] = '';

/* Tüm sayfalar için varsayılan sayfa yazarı bilgisi*/
$config['Masterpage']['author'] = '';

/* Tüm sayfalar için varsayılan sayfa tasarımcı bilgisi*/
$config['Masterpage']['designer'] = '';

/* Tüm sayfalar için varsayılan sayfanın hitap bilgisi*/
$config['Masterpage']['distribution'] = '';

/* Tüm sayfalar için varsayılan site anahtar kelimeler bilgisi*/
$config['Masterpage']['keywords'] = '';

/* Tüm sayfalar için varsayılan ilgili sayfayı ön bellekleme bilgisi*/
$config['Masterpage']['cache'] 	= '';

/* Tüm sayfalar için varsayılan sayfa yenilenme bilgisi*/
$config['Masterpage']['refresh'] = '';

/* Tüm sayfalar için varsayılan site bilgisi*/
$config['Masterpage']['abstract'] = '';

/* Tüm sayfalar için varsayılan telif hakkı bilgisi*/
$config['Masterpage']['copyright'] = '';

/* Tüm sayfalar için varsayılan zaman aşımı bilgisi*/
$config['Masterpage']['expires'] = '';

/* Tüm sayfalar için varsayılan sistem bilgilerini arama motoruna gösterme bilgisi*/
$config['Masterpage']['pragma'] = '';

/* Tüm sayfalar için varsayılan güncellenme bilgisi*/
$config['Masterpage']['revisit'] = '';

/* Tüm sayfalar için varsayılan arama motoru takip linkleri bilgisi*/
$config['Masterpage']['robots'] = array();

/*Farklı bir meta tagı veya tagları kullanmak istiyorsanız dizi içerisine name => content tipi anahtar => değer bilgiler girin.*/
$config['Masterpage']['meta']['name'] = array();

/*Farklı bir meta tagı veya tagları kullanmak istiyorsanız dizi içerisine http-equiv => content tipi anahtar => değer bilgiler girin.*/
$config['Masterpage']['meta']['http'] = array();

/*Head tagları arasına farklı bir bilgi veya bilgiler eklenmek isteniyorsa dizi elemanı olarak yazmanız yeterlidir.*/
$config['Masterpage']['data'] = array();
//--------------------------------------------------------------------------------------------------------------------------