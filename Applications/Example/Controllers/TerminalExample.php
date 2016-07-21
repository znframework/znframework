<?php
class TerminalExample extends Controller
{	
    public function main($params = '')
    {	
		$data['title']        = str_replace('Example', ' Example', __CLASS__);
		$data['subtitle']     = __CLASS__;
		$data['examples']     = 
		[
			'terminal'
		];
		
		$data['requirements'] = [];
		
       	Import::view('main', $data); 
    }	
	
	public function terminal()
	{
		$title = 'Terminal Component';
		
		// p1: php veya cmd değerleri alır
		// php: PHP kodları çalıştırmak için kullanılır.
		// cmd: CMD komutları çalıştırmak için kullanılır.
		// p2: Terminalin görünümü ile ilgili ayarlar için kullanılır.
		$terminal = Terminal::run('php', ['width' => 1000]);
					 
		Import::view('components-example', 
		[
			'component'	=> $terminal,
			'title' 	=> $title
		]);
	}
}