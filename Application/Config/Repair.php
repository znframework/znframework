 <?php
/************************************************************/
/*                          REPAIR                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

1-mode
2-machines
3-pages
4-route_page

*/

/*
*-------------------------------------------------------------
*/

/*
*-------------------------------------------------------------------------------
*	İşlev: Düzenleme yapılan bilgisayar/bilgisayarların, kullanıcılardan 
	ayırt edilmesini sağlar. System Repair moda alındığında aktif olur, 
	sistem çalışırken sistemde düzenleme yapma olanağı sağlar.
*	Not: Sistem repair moda alınmadan önce bu değer ip'nize göre ayarlanmalıdır.
* 	Varsayılan: 127.0.0.1.
*-------------------------------------------------------------------------------
*/
// aşağıdaki özelliklerin çalışması için bu özelliğin true yapılması gerekmektedir.
$config['Repair']['mode'] = false; 
// array()local ip 127.0.0.1
$config['Repair']['machines'] = array(); 
// array() veya string Onarım işlemi yapılan sayfalar belirtiliyor.
// tüm sayfalar için onarım modu ayarlanmak isteniyorsa "all" parametresi kullanılır.
$config['Repair']['pages'] = array();
// Onarım işlemini ifade eden onarım sayfasına yönlendiriyor.
$config['Repair']['route_page'] = ''; 