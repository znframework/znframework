<?php
class MultiLanguageExample extends Controller
{	
    public function main($params = '')
    {	
		$data['title']        = str_replace('Example', ' Example', __CLASS__);
		$data['subtitle']     = __CLASS__;
		$data['examples']     = 
		[
			'insert',
			'select',
			'update',
			'delete',
			'changeLang',
			'deleteAll'
		];
		
		$data['requirements'] = [];
		
       	Import::view('main', $data); 
    }	
	
	public function insert()
	{
		// Kelime Eklemek
		// p1: hangi dilde ekleneceği
		// p2: eklenecek kelime veya kelimelere ait anahtar
		// p3: kelimenin karşılığı	
		ML::insert('en', ['example' => 'Example', 'application' => 'Application', 'turkish' => 'Turkish']);
		// İlgili dil dosyası Applications/Example/Storage/MultiLanguage/en.ml olarak oluşturuldu.
		ML::insert('tr', ['example' => 'Örnek', 'application' => 'Uygulama', 'turkish' => 'Türkçe']);		
		// İlgili dil dosyası Applications/Example/Storage/MultiLanguage/tr.ml olarak oluşturuldu.
	}
	
	public function select()
	{
		// Eklenen Kelimeyi Seçmek
		// p1: kullanılacak kelimeyi tutan anahtar.
		echo ML::select('turkish');	
	}
	
	public function update()
	{
		// Kelime Güncellemek
		// p1: hangi dilde güncelleneceği
		// p2: güncellenecek kelime veya kelimelere ait anahtar
		// p3: kelimenin karşılığı	
		ML::update('en', 'example', 'Examples');
		
		echo ML::select('example');	
	}
	
	public function delete()
	{
		// Eklenen Kelimeyi Silmek
		// p1: hangi dilden kelimenin silineceği
		// p2: silinecek kelime veya kelimelere ait anahtar.
		ML::delete('en', 'turkish');
		writeLine(ML::select('turkish'));
		writeLine(ML::select('example'));		
	}
	
	public function changeLang()
	{
		writeLine( HTML::anchor('example/MultiLanguageExample/lang/tr', 'TR').' - '.HTML::anchor('example/MultiLanguageExample/lang/en', 'EN') );
		writeLine( ML::select('application') );
	}
	
	public function lang()
	{
		// Aktif Dili Değiştirmek
		// p1: aktif dil.
		ML::lang(URI::get('lang'));
		
		redirect('example/MultiLanguageExample/changeLang');	
	}
	
	public function deleteAll()
	{
		// Belirtilen Dile Ait Tüm Verileri Silmek
		// p1: silinecek dil.
		ML::deleteAll('en');	
	}
}