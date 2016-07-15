<?php
class BufferExample extends Controller
{	
    public function main($params = '')
    {	
		$data['title']        = 'Buffer Example';
		$data['subtitle']     = __CLASS__;
		$data['examples']     = 
		[
			'file',
			'callback',
			'insert',
			'select',
			'delete'
		];
		
		$data['requirements'] = [];
		
       	Import::view('main', $data); 
    }	
	
	public function file()
	{
		// Herhangi bir dosyayı tampona alır.
		// Dosyanın içeriği bir değişkene aktarılabilir.
		// p1: Dosya adı.
		$content = Buffer::file('robots.txt');	
	
		echo $content;
	}
	
	public function callback()
	{
		// callback() veya func()
		// Bir fonksiyon çıktısını tamponlar.
		// p1: yöntemin adı veya kendisi.
		// p2: varsa gönderilecek parametreler.
		$getRequiredFiles = Buffer::callback('get_required_files');
		
		output($getRequiredFiles);
		
		// Bu örnekte de bir fonksiyon tamponlanıyor.
		$getCallback = Buffer::callback(function($p1, $p2){ writeLine('{0} {1}', [$p1, $p2]); }, ['Buffer', 'Example']);
		
		echo $getCallback;
		
	}
	
	public function insert()
	{
		// Tampona veri eklemek için kullanılır.
		// 1 - Ölçülebilir büyüklükte bir değer
		// 2 - Bir dosya
		// 4 - Veya bir fonksiyon değeri tampona alınabilir.
		
		// 1 - Ölçülebilir büyüklük eklemek
		// p1: veri anatahrının adı.
		// p2: eklenecek değer.
		Buffer::insert('scalar', 'Merhaba');	
		
		// 2 - Bir dosya eklemek
		Buffer::insert('file', 'robots.txt');
		
		// 3 - Bir fonksiyon değeri eklemek;
		Buffer::insert('callback', function(){ return 1; });
	}
	
	public function select()
	{
		// p1: Eklenen veri adı.
		writeLine( '---------------------------------------------------------------------' );
		writeLine( 'Scalar Value' );
		writeLine( '---------------------------------------------------------------------' );
		writeLine( Buffer::select('scalar') );
		writeLine( '---------------------------------------------------------------------' );
		writeLine();
		writeLine( '---------------------------------------------------------------------' );
		writeLine( 'File' );
		writeLine( '---------------------------------------------------------------------' );
		writeLine( Buffer::select('file') );
		writeLine( '---------------------------------------------------------------------' );
		writeLine();
		writeLine( '---------------------------------------------------------------------' );
		writeLine( 'Callback' );
		writeLine( '---------------------------------------------------------------------' );
		writeLine( Buffer::select('callback') );
		write( '---------------------------------------------------------------------' );
	}
	
	public function delete()
	{
		// p1: Eklenen veri adı.
		Buffer::delete('scalar');
		Buffer::delete('file');
		Buffer::delete('callback');
	}
}