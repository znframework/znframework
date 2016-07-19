<?php
class DateTimeExample extends Controller
{	
    public function main($params = '')
    {	
		$data['title']        = str_replace('Example', ' Example', __CLASS__);
		$data['subtitle']     = __CLASS__;
		$data['examples']     = 
		[
			'example'
		];
		
		$data['requirements'] = [];
		
       	Import::view('main', $data); 
    }	
	
	public function example()
	{
		// Date ve Time sınıflar current() yöntemi dışında aynıdır.
		// Date farklı bir karakter grubu içerirken
		// Time farklı bir karakter grubu içerir.
		// Time sınıfına ait yöntemlerin çıktılarını dili
		// Internal/Config/DateTime.php dosyasından değiştirebilirsiniz.

		echo Table::size(800, 100)
				  ->cell(5, 5)
				  ->border(1, 'red')
				  ->content
				  (
					   ['th:Method', 'th:Date', 'th:Time'],
					   // Aktif tarih ve zaman bilgisi elde edilir.
					   ['currrent()', Date::current(), Time::current()],			   
					   // Standart tarih ve zaman biçimi verilir.
					   ['standart()', Date::standart(), Time::standart()],
					   // {xxx}'li kullanım yerine standart karakterlerde kullanabilirsiniz.
					   // Bu dönüşümle ilgili veriler Internal/Config/DateTime.php dosyasındadır.
					   // Tarihi veya saati istenilen forma sokmak için kullanılır.
					   // p1: tarih veya saat bilgisi
					   // p2: p1 in hangi formatta görüntüleneceği.
					   ['convert()', Date::convert('19.01.2012', '{year}-{monthNumber0}-{dayNumber0}'), Time::convert('20:04', '{minute}-{hour}')],
					   // Tarih veya saati karşılaştırmak için kullanılır.
					   // p1: 1. değer
					   // p2: karşılaştırma koşulu
					   // p3: 2. değer
					   ['compare()', Date::compare('19.01.2012', '<', '20.01.2012'), Time::compare('20:03', '<', '20:04')],
					   // Girilen tarih veya saat bilgisini sayıya çevirir.
					   ['toNumeric()', Date::toNumeric('20.12.2012'), Time::toNumeric('20:05')],
					   // Tarih veya saate ekleme ve çıkarma yapmak için kullanılır.
					   // p1: işlem yapılacak tarih veya saat.
					   // p2: ekleme veya çıkarma yapılacak miktar.
					   // p3: tarih veya saatin hangi formatta işleme alınacağı. 
					   // bu parametre p1'in tarih saat formatı ile aynı olmalıdır.
					   ['calculate()', Date::calculate('20.12.2012', '-30 day'), Time::calculate('20:05', '-20 minute', '{hour}:{minute}')],
					   // Tarih veya saat formatı oluşturmak için kullanılır.
					   ['set()', Date::set('{year}/{month}/{day} - {hour}:{minute}'), Time::set('{year}/{month}/{day} - {hour}:{minute}')]
				  )
				  ->create(); 
	}
}