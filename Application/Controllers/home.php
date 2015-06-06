<?php
/************************************************************/
/*                  CONTROLLER  HOME PAGE                   */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Home extends Controller
{	
	/******************************************************************\
	|																   | 
	|					    ZN DYNAMIC FRAMEWORK				       |
	|																   |
	|------------------------------------------------------------------|
	|																   |
	|  ZN Framework, nesne erişimi için Controller çağrısını zorunlu   |
	|  tutmuyor. Bu yüzden yukarıda açıklama satırlarına alınmıştır.   |
	|																   |
	|  Aşağıdaki kodları çalıştırmak için takip etmeniz gereken yol;   |
	|																   |
	|  Çalıştırma Link: http://test.com/index.php/home/index		   |
    |																   |
	|  http://siteadi/[index.php]/[sınıf-ismi]/[metot-ismi]/[p1]/...   | 
	|                                                                  |
	|  Daha detaylı kullanım için: http://www.zntr.net	   			   |
	|                                                                  |
	\******************************************************************/

	function index($params = "")
	{		
		/******************************************************************************************
		* Gönderilen Veriler                                                                      *
		*******************************************************************************************
		| 1. title => ZN FRAMEWORK					          									  |
		| 2. style => Views/Styles/style.css					          						  |
		| 3. welcome_message => ZN KOD ÇATISINA HOŞ GELDİNİZ				          			  |
		******************************************************************************************/
		$data["title"] 			 = "ZN FRAMEWORK";
		$data["style"] 			 = $this->import->style("style", true);
		$data["welcome_message"] = "ZN KOD ÇATISINA HOŞ GELDİNİZ";
		
		/******************************************************************************************
		* Dahil Edilen Welcome.php Görünüm Sayfası                                                *
		*******************************************************************************************
		| 1. welcome => Views/Pages/welcome.php sayfası dahil ediliyor.					          |
		| 2. data => Yukarıdaki verileri tutan data dizisi dahil edilen sayfaya gönderiliyor.	  |
		| 3. false => Sayfa doğrudan görüntüleniyor.				          			  		  |
		| NOT: Bu işlem için view() ya da page() yöntemlerinden her ikiside kullanılabilir.		  |
		******************************************************************************************/
		$this->import->view("welcome", $data);
	}	
}