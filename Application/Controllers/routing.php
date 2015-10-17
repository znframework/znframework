<?php	
/******************************************************************************************
* Route Kütüphanesi ile Sayfa Kontrolleri                                                 *
*******************************************************************************************
|                                                                                         |
  Nesne yönelimli bir kontrolcü sayfası yerine bir kütüphaneye ait fonksiyonun
  çalıştırılmasına dayalı kontrolcülerde oluşturabilirsiniz. Nesne yönelimli 
  programlama konusunda çok fazla bilgisi olmayan kullanıcıların oldukça işine
  yarayacağını umuyoruz. 
  
  Klasik kontrolcüler ile tamamen aynı mantıktadır. Ancak sayfa bir class yapısında
  olmadığı için $this nesnesinin kullanımı mümkün değildir. Böyle bir kullanımda
  sınıflara statik çağrı ile erişim sağlanmalıdır. 
  
  Parametreler
  
  1. Parametre: Fonksiyon ismi.
  2. Parametre: Çalıştırılacak Fonksiyon.
  
  NOT: Alternatif bir kullanım amacıyla oluşturulmuştur.
|                                                                                         |
******************************************************************************************/

// Çalıştırma Linki: http://test.com/index.php/routing/index/[p1]...	
Route::run('index', function($params = '')
{	
	$data['font']			= Import::font('textfont', true);
	$data['style'] 			= Import::style('style', true);	
	$data['title'] 			= 'ZN FRAMEWORK';
	$data['welcomeMessage'] = 'PHP Web Framework <b>Made In Turkey</b>';

	Import::view('welcome', $data);
});

Route::run('test', function()
{
	
});