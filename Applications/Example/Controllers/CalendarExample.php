<?php
class CalendarExample extends Controller
{	
    public function main($params = '')
    {	
		$data['title']        = str_replace('Example', ' Example', __CLASS__);
		$data['subtitle']     = __CLASS__;
		$data['examples']     = 
		[
			'calendar'
		];
		
		$data['requirements'] = [];
		
       	Import::view('main', $data); 
    }	
	
	public function calendar()
	{
		$title = 'Calendar Component';
		
		// http://.../example/CalendarExample/calendar/2015/01 
		$calendar =  Calendar::url('example/CalendarExample/calendar')
					 // Gün ve ay isimleri kısaltılmış halleri ile kullanılsın.
					 // Kullanımı zorunlu değildir. Varsayılan: 1.p(gün)sort, 2.p(ay)long
					 ->nameType('short', 'short') 
					 // Tablo geneline ve şimdiki gün hücrelerine stil uygulanıyor.
					 // Kullanımı zorunlu değildir
					 ->style(array('current' => 'background:red; color:white;', 'table' => 'background:white; color:red')) 
					 // İleri geri linklerine isim veriliyor.
					 // Kullanımı zorunlu değildir. Varsayılan: 1.p(önceki)<<, 2.p(sonraki))>>
					 ->linkNames('Önceki', 'Sonraki') 
					 // Takvimi oluşturmak için kullanılan niahi yöntemdir.
					 ->create();
					 
		Import::view('components-example', 
		[
			'component'	=> $calendar,
			'title' 	=> $title
		]);
	}
}