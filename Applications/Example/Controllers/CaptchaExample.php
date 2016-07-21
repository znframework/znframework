<?php
class CaptchaExample extends Controller
{	
    public function main($params = '')
    {	
		$data['title']        = str_replace('Example', ' Example', __CLASS__);
		$data['subtitle']     = __CLASS__;
		$data['examples']     = 
		[
			'captcha',
			'getCode'
		];
		
		$data['requirements'] = [];
		
       	Import::view('main', $data); 
    }	
	
	public function captcha()
	{
		$title = 'Captcha Component';
		
		// Metnin kaç karakter olacağı ayarlanıyor.
		// Kullanımı zorunlu değildir. Varsayılan: 6
		$captcha =  Captcha::length(6) 
					// Metnin rengi ayarlanıyor.
					// Kullanımı zorunlu değildir. Varsayılan: 255|255|255
					->textColor('180|20|10') 
					// Grid ve rengi ayarlanıyor.
					// Kullanımı zorunlu değildir. Varsayılan: true, 50|50|50
					->grid(true, '30|30|30') 
					// Yatayda ve dikeyte ızgara sayısı ayarlanıyor.
					// Kullanımı zorunlu değildir. Varsayılan: 12, 4
					->gridSpace(2, 6) 
					// Güvenlik kodunun arkaplan rengi ayarlanıyor.
					// Kullanımı zorunlu değildir. Varsayılan: 80|80|80
					->background('200|200|200') 
					// Güvenlik kodunu oluşturan nihai yöntemdir.
					->create(true);
					 
		Import::view('components-example', 
		[
			'component'	=> $captcha,
			'title' 	=> $title
		]);
	}
	
	public function getCode()
	{
		// Oluşturulan son güvenlik kod resmine ait kod.
		echo Captcha::getCode();	
	}
}