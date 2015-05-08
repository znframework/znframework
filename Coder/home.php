<?php
class Home
{	
	function index($params = "")
	{		
		$data["title"] = "ZN FRAMEWORK";
		$data["welcome_message"] = "ZN KOD ÇATISINA HOŞ GELDİNİZ";
		$data["style"] = $this->import->style("style", true);
		
		// Statik Çağrı
		// import::page("welcome", $data);
		// Dinamik Çağrı
		// Parametre1: Çağrılan Sayfanın Yolu: Designer/Pages/welcome.php
		// Parametre2: Çağrılan Sayfaya Gönderilen Veriler: $data
		$this->import->page("welcome", $data);
	}
	
	function ex($param = NULL)
	{	
		echo $param;
	}
}
