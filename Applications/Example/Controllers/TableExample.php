<?php
class TableExample extends Controller
{	
    public function main($params = '')
    {	
		$data['title']        = str_replace('Example', ' Example', __CLASS__);
		$data['subtitle']     = __CLASS__;
		$data['examples']     = 
		[
			'table'
		];
		
		$data['requirements'] = [];
		
       	Import::view('main', $data); 
    }	
	
	public function table()
	{
		$title = 'Table Component';
		
		$table =  Table::size(300, 100)
				  ->cell(5, 5)
				  ->border(1, 'blue')
				  ->content
				  (
					   ['Username', 'Password'],
					   [Form::text(), Form::password()],
					   [Form::button('login', 'Login') => ['colspan' => 2]]
				  )
				  ->create(); 
					 
		Import::view('components-example', 
		[
			'component'	=> $table,
			'title' 	=> $title
		]);
	}
}