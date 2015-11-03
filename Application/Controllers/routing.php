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

// Construct yapıcısı gibi tüm sayfa için çalışmasını istediğiniz
// kodlarını bu fonksiyon ismi ile kullanabilirsiniz.
Route::run('construct', function()
{
	// Başlangıçta çalıştırılmasını istediğiniz kodlar
});

// Çalıştırma Linki: http://test.com/index.php/routing/index/[p1]...	
Route::run('index', function($params = '')
{	
	$data['font']  = Import::font('textfont', true);
	$data['style'] = Import::style('style', true);	
	$data['title'] = 'ZERONEED PHP WEB FRAMEWORK';

	Import::view('welcome', $data);
});

// Destruct yıkıcısı gibi tüm sayfa sonunda çalışmasını istediğiniz
// kodlarını bu fonksiyon ismi ile kullanabilirsiniz.
Route::run('destruct', function()
{
	// Sonda çalıştırılmasını istediğiniz kodlar
});
