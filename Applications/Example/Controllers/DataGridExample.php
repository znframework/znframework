<?php
class DataGridExample extends Controller
{	
    public function main($params = '')
    {	
		$data['title']        = str_replace('Example', ' Example', __CLASS__);
		$data['subtitle']     = __CLASS__;
		$data['examples']     = 
		[
			'singleDataGrid',
			'relatedDataGrid',
			'createTable'
		];
		
		$data['requirements'] = 
		[
			'İlişkili DataGrid kullanabilmeniz için "example/DataGridExample/createTable" yöntemini çalıştırarak "user_example" tablosu ile ilişkili "user_profile_example" tablosunu oluşturun.'
		];
		
       	Import::view('main', $data); 
    }	
	
	public function singleDataGrid()
	{
		$title = 'Single DataGrid Component';
		
		// Metnin kaç karakter olacağı ayarlanıyor.
		// Kullanımı zorunlu değildir. Varsayılan: 6
		$datagrid =  DataGrid::table('user_example')
					 ->limit(10)
					 ->columns
					 ([ 
						 'id'      	=> ['title' => 'ID'], 
						 'username' => ['title' => 'Username'], 
						 'password' => ['title' => 'Password'] 
					 ]) 
					 ->create();
					 
		Import::view('components-example', 
		[
			'component'	=> $datagrid,
			'title' 	=> $title
		]);
	}
	
	public function relatedDataGrid()
	{
		
		$title = 'Related DataGrid Component';
		
		// İlişkili tablolarda
		// 1 - alias yani takma isim kullanılmak zorundadır.
		// 2 - processColumn() olarak takma isimli birleştirme sütunu kullanılır.
		// 3 - Birleştirme soldan yapılmaktadır.
		$datagrid =  DataGrid::table('user_example')
					 ->limit(10)
					 ->joins(['user_profile_example.user_id' => 'id'])
					 ->columns
					 ([
						 'user_example.id'          	=> ['alias' => 'userId', 'title' => 'ID'], 
						 'user_example.username'    	=> ['alias' => 'username', 'title' => 'Username'], 
						 'user_profile_example.name' 	=> ['alias' => 'profileName', 'title' => 'Name'],
						 'user_profile_example.phone' 	=> ['alias' => 'profilePhone', 'title' => 'Phone'],
					 ])
					 // İlişkili tablolarda kullanılmak zorundadır.
					 // Ortak sütunun takma isimli hali kullanılır.
					 ->processColumn('userId')
					 ->create();
					 
		Import::view('components-example', 
		[
			'component'	=> $datagrid,
			'title' 	=> $title
		]);
	}
	
	public function createTable()
	{
		DBForge::createTable('user_profile_example', 
		[
			'id' 		=> [DB::int(11), DB::notNull(), DB::autoIncrement(), DB::primaryKey()],
			'user_id' 	=> [DB::int(11)],
			'name'  	=> [DB::varchar(255)],
			'phone'  	=> [DB::varchar(18)]
		], DB::encoding('utf8', 'utf8_general_ci'));	
		
		echo DBForge::error();
	}
}