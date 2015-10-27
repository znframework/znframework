<?php
class Home extends Controller
{	
	// Çalıştırma Linki: http://test.com/index.php/home/index/[p1]...	
	public function index($params = '')
	{	
		/******************************************************************************************
		* Gönderilen Veriler                                                                      *
		*******************************************************************************************	
		| 1. font  => Resources/Fonts/textfont.ttf                                                |
		| 2. style => Resources/Styles/style.css                                                  |
		| 3. title => ZERONEED PHP WEB FRAMEWORK                                                  |
		******************************************************************************************/
		$data['font']  = Import::font('textfont', true);
		$data['style'] = Import::style('style', true);	
		$data['title'] = 'ZERONEED PHP WEB FRAMEWORK';
		
		/******************************************************************************************
		* Dahil Edilen Welcome.php Görünüm Sayfası                                                *
		*******************************************************************************************
		| 1. welcome => Views/welcome.php sayfası dahil ediliyor.                                 |
		| 2. data => Yukarıdaki verileri tutan data dizisi dahil edilen sayfaya gönderiliyor.     |
		| 3. false => Sayfa doğrudan görüntüleniyor.                                              |
		| NOT: Bu işlem için view() ya da page() yöntemlerinden her ikisi de kullanılabilir.      |
		******************************************************************************************/
		Import::view('welcome', $data);
	}	
	
	public function test()
	{
		$data['font']  = Import::font('textfont', true);
		$data['style'] = Import::style('style', true);	
		$data['title'] = 'ZERONEED PHP WEB FRAMEWORK';
		
		Import::view('test.template', $data);
	}
}