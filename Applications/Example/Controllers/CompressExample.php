<?php
class CompressExample extends Controller
{	
    public function main($params = '')
    {	
		$data['title']        = str_replace('Example', ' Example', __CLASS__);
		$data['subtitle']     = __CLASS__;
		$data['examples']     = 
		[
			'extract',
			'write',
			'read',
			'compressUncompress',
			'encodeDecode',
			'deflateInflate'
		];
		
		$data['requirements'] = [];
		
       	Import::view('main', $data); 
    }	
	
	public function extract()
	{
		// zip ve rar sürücüleri destekler.
		// p1: Kaynak zip dosyası
		// p2: Çılarılacak hedef dizin
		Compress::driver('zip')->extract(FILES_DIR.'example.zip', FILES_DIR.'example/');	
	}
	
	public function write()
	{
		// bz ve gz sürücüleri destekler.
		// p1: oluşturulacak dosya.
		// p1: yazılacak veri.
		Compress::write(FILES_DIR.'example.txt', 'Example Data!');
	}
	
	public function read()
	{
		// bz ve gz sürücüleri destekler.
		// p1: verinin okunacağı dosya.
		echo Compress::read(FILES_DIR.'example.txt');	
	}
	
	public function compressUncompress()
	{
		// bz, gz, lzf sürücüleri destekler.
		$compress = Compress::compress('Compress Example');
		
		writeLine('Compress Data:'.$compress);
		
		$uncompress = Compress::uncompress($compress);
		
		writeLine('Uncompress Data:'. $uncompress);
	}
	
	public function encodeDecode()
	{
		// gz, zlib sürücüleri destekler.
		$encode = Compress::encode('Compress Example');
		
		writeLine('Encode Data:'.$encode);
		
		$decode = Compress::decode($encode);
		
		writeLine('Decode Data:'. $decode);	
	}
	
	public function deflateInflate()
	{
		// gz, zlib sürücüleri destekler.
		$deflate = Compress::deflate('Compress Example');
		
		writeLine('Deflate Data:'.$deflate);
		
		$inflate = Compress::inflate($deflate);
		
		writeLine('Inflate Data:'. $inflate);	
	}
}