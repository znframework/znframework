<?php
class Home extends Controller
{	
	// Çalıştırma Linki: http://test.com/index.php/home/index/[p1]...	
	public function index($params = "")
	{	
		/******************************************************************************************
		* Gönderilen Veriler                                                                      *
		*******************************************************************************************
		| 1. title => ZN FRAMEWORK					          									  |
		| 2. style => Views/Styles/style.css					          						  |
		| 3. font => Views/Fonts/textfont.ttf					          						  |
		| 4. welcome_message => ZN KOD ÇATISINA HOŞ GELDİNİZ				          			  |
		******************************************************************************************/
		$data["title"] 			 = "ZN FRAMEWORK";
		$data["style"] 			 = Import::style("style", true);
		$data["font"]			 = Import::font("textfont", true);
		$data["welcome_message"] = "PHP Web Framework <b>Made In Turkey</b>";

		/******************************************************************************************
		* Dahil Edilen Welcome.php Görünüm Sayfası                                                *
		*******************************************************************************************
		| 1. welcome => Views/Pages/welcome.php sayfası dahil ediliyor.					          |
		| 2. data => Yukarıdaki verileri tutan data dizisi dahil edilen sayfaya gönderiliyor.	  |
		| 3. false => Sayfa doğrudan görüntüleniyor.				          			  		  |
		| NOT: Bu işlem için view() ya da page() yöntemlerinden her ikiside kullanılabilir.		  |
		******************************************************************************************/
		Import::view("welcome", $data);
	}
	
	// Çalıştırma Linki : http://test.com/index.php/home/test/[p1]...	
	public function test($p1 = 'Controller: home, Method: test')
	{
		echo $p1;	
	}
}