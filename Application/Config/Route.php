<?php
/************************************************************/
/*                   ROUTE(YÖNLENDİRME)                     */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

1-open_page
2-show_404
3-change_uri

*/

/*
*-------------------------------------------------------------
*/

// route 404 page
$config['Route']['open_page'] 	= 'home';

// route 404 page
$config['Route']['show_404'] 	= '';

// yeni url değeri => değiştirilecek url değeri
// anahtarlar değerin ters olmasının sebebi url çevirmede birden fazla çevirme imkanı sağlamaktır.
$config['Route']['change_uri'] 	= array();