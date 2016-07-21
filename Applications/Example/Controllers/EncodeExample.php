<?php
class EncodeExample extends Controller
{	
    public function main($params = '')
    {	
		$data['title']        = str_replace('Example', ' Example', __CLASS__);
		$data['subtitle']     = __CLASS__;
		$data['examples']     = 
		[
			'create',
			'golden',
			'super',
			'type'
		];
		
		$data['requirements'] = [];
		
       	Import::view('main', $data); 
    }
	
	public function create()
	{
		// Rasgele şifre oluşturmak için kullanılır.
		// p1: kaç karakterli olacağı.
		// p2: hangi karakterlerden olacağı
		// p2: all, alpha/string, numeric değerleri alabilir.
		writeLine('Alpha Numeric:'.Encode::create(6));	
		writeLine('Only Alpha:'.Encode::create(6, 'alpha'));
		writeLine('Only Numeric:'.Encode::create(6, 'numeric'));
	}
	
	public function golden()
	{
		// Veriyi şifrelemek için kullanılır.
		// p1: şifrelenecek veri.
		// p2: şifrelenecek veriye eklenecek ek.
		writeLine(Encode::golden('Example', 'xyz'));
		writeLine(Encode::golden('Example', 'abc123'));
		
		// şifre formatını değiştirebilirsiniz
		writeLine(Encode::config(['type' => 'sha1'])->golden('Example', 'ddx'));
	}
	
	public function super()
	{
		// Veriyi şifrelemek için kullanılır.
		// Config/Encode.php dosyasında yer alan
		// projectKey değerine göre şifre farklılaşır.
		// ön tanımlı md5 olarak şifreler.
		// p1: şifrelenecek veri.
		writeLine(Encode::super('Example'));
		
		// şifre formatını değiştirebilirsiniz
		writeLine(Encode::config(['type' => 'sha1'])->super('Example'));
	}
	
	public function type()
	{
		// İstenilen şifreleme algoritmasına göre veriyi şifreler.
		// p1: şifrelenecek veri.
		// p2: algoritma türü.
		writeLine(Encode::type('Example Data', 'sha1'));
		writeLine(Encode::type('Example Data', 'ripemd160'));
		writeLine(Encode::type('Example Data', 'tiger192,3'));	
	}
}