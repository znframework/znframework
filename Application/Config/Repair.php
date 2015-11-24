 <?php
//----------------------------------------------------------------------------------------------------
// REPAIR 
//----------------------------------------------------------------------------------------------------
//
// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.zntr.net
// Lisans     : The MIT License
// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
//
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Repair
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: Web sitenizde onarım işlemleri ile ilgili ayarları içerir.			  
// Düzenleme yapılan bilgisayar/bilgisayarların, kullanıcılardan 						  
// ayırt edilmesini sağlar. System Repair moda alındığında aktif olur, 					  
// sistem çalışırken sistemde düzenleme yapma olanağı sağlar.							  
// Not: Sistem repair moda alınmadan önce bu değer ip'nize göre ayarlanmalıdır.			  
// Varsayılan: 127.0.0.1			  												  
//
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Mode
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: Sistemi onarmak için modu true olarak ayarlamalısınız.				 
//
//----------------------------------------------------------------------------------------------------
$config['Repair']['mode'] = false; 

//----------------------------------------------------------------------------------------------------
// Machines
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: Sistem üzerinde onarım yapılırken diğer kullanıcıların bu onarımdan	  
// etkilenmemesi için ip ayırt etme yönteminden yayarlanılmıştır. Aşağıdaki diziye 		  
// gireceğiz ip bilgisine sahip bilgisayarlarda onarım sayfası görüntülenirken diğer		  
// kullanıcılarda bu sayfada onarım olduğuna dair bir mesaj görünecektir. Böylece		  
// geliştiriciler sitelerini onarmaya devam ederken kullanıcılar sitenizi kullanmaya		  
// devam edebilecekler.							  	 				     				  
//
//----------------------------------------------------------------------------------------------------
$config['Repair']['machines'] = array(); 

//----------------------------------------------------------------------------------------------------
// Pages
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: Onarım işlemi yapılan sayfalar belirtiliyor. Tek bir sayfa ise 		  
// string atama yapabirsiniz. Birden çok sayfa belirtilecekse dizi içerisinde sırası ile	  
// onarım yapılan sayfalar belirtilir. Eğer tüm sayfalarda onarım yapılıyorsa string 	  
// "all" ataması kullanılır.						  	 				     				  
// Örnek Kullanımlar: 'all' // tüm sayfaları routePage ayarına yönlendirir. 				  
// Örnek Kullanımlar: array('home', 'test') // Belirtilen sayfalar routePage'e yönlenir.   
// Örnek Kullanımlar: array('home' => 'repairHome') // home, repairHome sayfasına yönlenir.
//
//----------------------------------------------------------------------------------------------------
$config['Repair']['pages'] = array();

//----------------------------------------------------------------------------------------------------
// Route Page
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: Onarıma alınan sayfa ziyaret edildiğinde kullanıcıların hangi sayfaya  
// yönlenmesi isteniyorsa o sayfanın yolu belirtilir.						  	 		  
//
//----------------------------------------------------------------------------------------------------
$config['Repair']['routePage'] = ''; 