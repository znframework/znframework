<?php
class CacheExample extends Controller
{	
    public function main($params = '')
    {	
		$data['title']        = str_replace('Example', ' Example', __CLASS__);
		$data['subtitle']     = __CLASS__;
		$data['examples']     = 
		[
			'insert',
			'select',
			'delete',
			'clean',
			'info',
			'getMetaData'
		];
		
		$data['requirements'] = 
		[
			'File sürücüsü dışındaki diğer tüm sürücülerin sunucunuza yüklenmesi gerekmektedir.'
		];
		
       	Import::view('main', $data); 
    }	
	
	public function insert()
	{
		// p1: Storage/Cache/ dizini içine hangi isimle kaydedileceği.
		// p2: Hangi değerin kaydedileceği.
		// p3: Saniye cinsinden ne kadar süre ile tutulacağı.
		// p4: Sıkıştırma olup olmayacağı. Varsayılan false.
		// Eğer sıkıştıma olacakca ZN'de yer alan sıkıştırma sürücülerinden biri belirtilebilir.
		Cache::insert('welcomeExample', 'Saklanacak Değer', 60, 'gz');
	}
	
	public function select()
	{
		// p1: Oluşturulan bellek dosyası kaydedilen değer okunuyor.
		// p2: Sıkıştırma hangi sürücü ile yapılmışsa o sıkıştırma sürücüsü belirtilir.
		echo Cache::select('welcomeExample', 'gz');
	}
	
	public function delete()
	{
		// Oluşturulan bellek dosyası siliniyor.
		Cache::delete('welcomeExample');	
	}
	
	public function clean()
	{
		// Tüm değerler silinir.
		Cache::clean();	
	}
	
	public function info()
	{
		// Belleklenen dosyalara ilişkin değer dizisi döndürür.
		output(Cache::info());	
	}
	
	public function getMetaData()
	{
		// Başlama süresi ve bitiş süresi gibi verileri döndürür.
		output(Cache::getMetaData('welcomeExample'));	
	}
}