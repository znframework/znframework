<?php
class Home // extends Controller
{	
	/******************************************************************\
	|																   | 
	|					    ZN DYNAMIC FRAMEWORK				       |
	|																   |
	|------------------------------------------------------------------|
	|																   |
	|  ZN Framework, nesne erişimi için Controller çağrısını zorunlu   |
	   tutmuyor. Bu yüzden yukarıda açıklama satırlarına alınmıştır.
	   Aşağıdaki kodlarda da doğrudan @this nesnesi ile erişim sağladığı
	   görülmektedir.
	   
	   ZN Framework bu sürümü ile nesnelere birden fazla sayıda erişim
	   imkanı sağlamıştır. Bu erişim yöntemleri;
	   
	   1-Dinamik Erişim  : $this->sınıf->yontem(); 
	   2-Statik Erişim   : sınıf::yontem()
	   3-Değişken Erişimi: zn::$use->sınıf->yontem();
	   4-Yöntem Erişimi  : this()->sınıf->yontem();
	   
	   Daha detaylı kullanım için aşağıdaki bağlantıdan yararlanınız.
	|                                                                  |
	|  ZN Framewok Web Site: http://www.zntr.net	   				   |
	|                                                                  |
	\******************************************************************/
		
	function index($params = "")
	{		
		$data["title"] 			 = "ZN FRAMEWORK";
		$data["style"] 			 = $this->import->style("style", true);
		$data["welcome_message"] = "ZN KOD ÇATISINA HOŞ GELDİNİZ";
			
		$this->import->page("welcome", $data); // Importing page => Views/Pages/welcome.php
	}
}


