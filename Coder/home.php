<?php
class Home
{
	function index($params = "")
	{	
		// Aşağıda çağrılan Designer/Pages/welcome.php sayfasına veriler gönderiliyor.	
		$data["title"] = "ZN FRAMEWORK";
		$data["welcome_message"] = "ZN KOD ÇATISINA HOŞ GELDİNİZ";
		
		// Parametre1: Çağrılan Sayfanın Yolu: Designer/Pages/welcome.php
		// Parametre2: Çağrılan Sayfaya Gönderilen Veriler: $data
		import::page("welcome", $data); 	
	}
}