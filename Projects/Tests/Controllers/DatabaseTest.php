<?php class DatabaseTest extends Controller
{
    protected $table = 'example';

    public function createTable()
    {
        DBForge::createTable($this->table, 
        [
            'id'        => [DB::int(11), DB::notNull(), DB::autoIncrement(), DB::primaryKey()],
            'name'      => [DB::varchar(255)],
            'phone'     => [DB::varchar(18)],
            'address'   => [DB::text()]
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

    public function increment()
    {
        DB::where('id', 1)->increment($this->table, 'name');
    }

    public function decrement()
    {
        DB::where('id', 1)->decrement($this->table, 'name');
    }
    
    public function select()
    {   
        $get = DB::limit(NULL, 2)->get($this->table);

        output($get->result()); 

        // Exception
        // $get' e dair sonuç verilerinin pagination() yönteminden
        // önce alınması gerekir. 
        output($get->pagination());
    }

    public function totalRows()
    {
        $get = DB::orderby('id', 'desc')->limit(5)->get($this->table);

        // Exception
        // Aynı anda hem gerçek satır hem limitli satır sayısı alınacaksa 
        // limitli satırın önce alınması gerekir.
        writeLine('Real Total Rows:{0}, Total Rows:{1}', [$get->totalRows(), $get->totalRows(true)]);
    }

    public function status()
    {
        output(DB::status($this->table)->row());
    }

    public function statusTables()
    {
        output(DBTool::statusTables('test'));

        output(DBTool::statusTables(['test', 'example']));

        output(DBTool::statusTables('*'));
    }
    
    public function delete()
    {
        // 3.0.4 sürümünden sonra eşitlik gerektiren where() 
        // yapısı için 'id =' yerine 'id' kullanılabilir. 
        // yani 1. parametre için herhangi bir operatör 
        // belirtilmezse = operatörü kabul edilir.
        // ancak önceki kullanım hala geçerlidir.
        DB::where('id', URI::get('id'))->delete($this->table);
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