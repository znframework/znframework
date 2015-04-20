<?php
class Home extends ZNDynamic
{	
	function index($params = "")
	{	
		// Aşağıda çağrılan Designer/Pages/welcome.php sayfasına veriler gönderiliyor.	
		$data["title"] = "ZN FRAMEWORK";
		$data["welcome_message"] = "ZN KOD ÇATISINA HOŞ GELDİNİZ";
		// Stil çağırma yöntemininin son parametresi true olarak ayarlanırsa 
		// doğrudan çıktı üretmek yerine çıktının bir değişkene aktarılması sağlanır.
		$data["style"] = $this->import->style("style", true);
		// Parametre1: Çağrılan Sayfanın Yolu: Designer/Pages/welcome.php
		// Parametre2: Çağrılan Sayfaya Gönderilen Veriler: $data
		// Statik Çağrı
		// import::page("welcome", $data);
		// Dinamik Çağrı
		$this->import->page("welcome", $data);
		// ZNDYNAMIC Sınıfının extends edilmesi ile import edilen araçlara,
		// sınıflara ve diğer nesnelere dinamik erişim sağlanabilir oldu.
		// NOT: Nesnelere ister dinamik isterseniz de statik erişim sağlayabilirsiniz. 
	}
}
