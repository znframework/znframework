<?php
class DatabaseExample extends Controller
{	
	protected $table = 'database_example_table';
	
    public function main($params = '')
    {	
		$data['title']        = str_replace('Example', ' Example', __CLASS__);
		$data['subtitle']     = __CLASS__;
		$data['examples']     = 
		[
			'createTable',
			'insert',
			'select',
			'delete',
			'truncate',
			'dropTable',
			'backup'
		];
		
		$data['requirements'] = ['"createTable" linkini çalıştırıp ilgili örnek için gereken tablonun oluşturumasını sağlayın.'];
		
       	Import::view('main', $data); 
    }
	
	public function createTable()
	{
		DBForge::createTable($this->table, 
		[
			'id' 		=> [DB::int(11), DB::notNull(), DB::autoIncrement(), DB::primaryKey()],
			'name'  	=> [DB::varchar(255)],
			'phone'  	=> [DB::varchar(18)],
			'address'	=> [DB::text()]
		], DB::encoding('utf8', 'utf8_general_ci'));	
		
		echo DBForge::error();	
	}
	
	public function insert()
	{
		// DB Sınıfına ait genel kullanımlara yönelik örnekler yer alacaktır.
		
		// Veri Ekleme		
		$type = DB::insert($this->table, 
		[
			'name'    => substr(uniqid(rand()), 0, 5),
			'phone'   => substr(uniqid(rand()), 0, 10),
			'address' => substr(uniqid(rand()), 0, 20)
		]);	
		
		echo $type === true ? 'Insert Data.' : 'Not Insert Data!';
	}
	
	public function select()
	{
		// Veri Çekme		
		$get = DB::limit(NULL, 10)->get($this->table);
	
		Import::view('database-example', 
		[
			'title'  		=> 'Database Example',
			'result' 		=> $get->result(),
			'columns'		=> $get->columns(),
			'limitTotalRows'=> $get->totalRows(),
			'realTotalRows'	=> $get->totalRows(true),
			'pagination' 	=> $get->pagination('example/DatabaseExample/select')
		]);	
	}
	
	public function delete()
	{
		// 3.0.4 sürümünden sonra eşitlik gerektiren where() 
		// yapısı için 'id =' yerine 'id' kullanılabilir. 
		// yani 1. parametre için herhangi bir operatör 
		// belirtilmezse = operatörü kabul edilir.
		// ancak önceki kullanım hala geçerlidir.
		DB::where('id', URI::get('id'))->delete($this->table);

		// Gelinen sayfadaki geçerli kayıt sayfasına geri döndürülüyor.
		redirect('example/DatabaseExample/select/'.URI::get('row'));
	}
	
	public function truncate()
	{
		DBForge::truncate($this->table);	
	}
	
	public function dropTable()
	{
		DBForge::dropTable($this->table);	
	}
	
	public function backup()
	{
		DBTool::backup($this->table);	
	}
}