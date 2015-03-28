<?PHP 
/************************************************************/
/*                     CLASS  DATABASE                      */
/************************************************************/

/*
	YAZAR: OZAN UYKUN
	
	1-COPYRIGHT(C) OZAN UYKUN
	2-TÜM HAKLARI SAKLIDIR.
	3-EMEGE SAYGI
*/

class Db
{
	
	//----------------STATIC VARIABLE-----------------
	
	//Static degisken tanimlamalari yapiliyor
	
	private static $select; 			// 1
	private static $distinct;			// 1
	private static $having;				// 1
	private static $all;				// 1
	private static $distinctrow;		// 1
	private static $high_priority;		// 1
	private static $straight_join;		// 1
	private static $small_result;		// 1
	private static $big_result;			// 1
	private static $buffer_result;		// 1
	private static $cache;				// 1
	private static $nocache;			// 1
	private static $calc_found_rows;	// 1
	private static $from;				// 1	
	private static $where;				// 1
	private static $join;				// 1
	private static $order_by;			// 1
	private static $group_by;			// 1
	private static $limit;				// 1
	private static $connect;			// 1
	private static $row;				// 1
	private static $num_rows;			// 1
	private static $total_num_rows;			// 1
	private static $num_fields;			// 1
	private static $result;				// 1
	private static $columns;			// 1	
	private static $use_where_count = 1;
	private static $select_db;	
	private static $simple_query;
	private static $error;

	
	//----------------STATIC VARIABLE-----------------
	
	
	/*
	SELECT
    [ALL | DISTINCT | DISTINCTROW ]
      [HIGH_PRIORITY]
      [STRAIGHT_JOIN]
      [SQL_SMALL_RESULT] [SQL_BIG_RESULT] [SQL_BUFFER_RESULT]
      [SQL_CACHE | SQL_NO_CACHE] [SQL_CALC_FOUND_ROWS]
    select_expr [, select_expr ...]
    [FROM table_references
    [WHERE where_condition]
    [GROUP BY {col_name | expr | position}
      [ASC | DESC], ... [WITH ROLLUP]]
    [HAVING where_condition]
    [ORDER BY {col_name | expr | position}
      [ASC | DESC], ...]
    [LIMIT {[offset,] row_count | row_count OFFSET offset}]
    [PROCEDURE procedure_name(argument_list)]
    [INTO OUTFILE 'file_name' export_options
      | INTO DUMPFILE 'file_name'
      | INTO var_name [, var_name]]
    [FOR UPDATE | LOCK IN SHARE MODE]]
	*/
	
	
	//	settings() ?
	/*
		Database ayarlarinin yapildigi fonksiyondur. host baglantisi, database seçimi ve diger ayarlarin yapildigi fonksiyondur.
		Otomatik olarak ayarlanmaktadir, bu fonksiyon parametre degerlerinin Database config dosyasindan almaktadir.
		Degisiklik yapilmak isteniyor ise o sayfada ayalari düzenlenmelidir.
		
		config YOLU = SYSTEM/config/DATABASE.PHP
	*/
	
	private static function settings()
	{	
		$config = config::get('Database');
		self::$connect = self::connect($config['host'], $config['user'], $config['password'],$config['database']);
		
		if( empty(self::$connect) ) 
		{
			report('Error',self::$error,'DatabaseLibrary');
			die(get_error('Database', 'db_mysql_connect_error'));
		}
		self::$select_db = self::select_db(config::get('Database','database'), self::$connect);
		
		
		if($config['charset'])   
			db::query("SET NAMES '".$config['charset']."'");
		if($config['charset'])   
			db::query('SET CHARACTER SET '.$config['charset']);	
		if($config['collation']) 
			db::query("SET COLLATION_CONNECTION = '".$config['collation']."'");
	
	}
	
	
	
	
	//	select() ?
	/*
		Sorgu olusturulduktan sonra hangi tablo degerlerinin döndürülecegini veren fonsiyondur.
		Örnek: SELECT TBL.*, TBL1.* .......
	*/
	
	public static function select($condition = '*')
	{
		if( ! is_string($condition)) $condition = '*';
		
		self::$select = 'select '.
						self::$distinct.
						self::$all.
						self::$distinctrow.
						self::$high_priority.
						self::$straight_join.
						self::$small_result.
						self::$big_result.
						self::$buffer_result.
						self::$cache.
						self::$nocache.
						self::$calc_found_rows.
						$condition.
						' ';		
	}
	
	//	distinct() ?
	/*
		Sorgu sonucu listenelen verilerden ayni degeri tasiyan iki kayittan sadece birini ekrana verir.
	*/
	
	// Ayni ikitane sonuçtan sadece birisini verir.
	
	public static function distinct()
	{
		self::$distinct = ' distinct ';
	}
	
	
	public static function calc_found_rows()
	{
		self::$calc_found_rows = ' sql_calc_found_rows ';
	}
	
	
	public static function small_result()
	{
		self::$small_result = ' sql_small_result ';
	}
	
	
	public static function big_result()
	{
		self::$big_result = ' sql_big_result ';
	}
	
	
	public static function cache()
	{
		self::$cache = ' sql_cache ';
	}
	
	
	public static function no_cache()
	{
		self::$nocache = ' sql_no_cache ';
	}
	
	
	public static function buffer_result()
	{
		self::$buffer_result = ' sql_buffer_result ';
	}
	
	
	public static function straight_join()
	{
		self::$straight_join = ' straight_join ';

	}	
	
	
	public static function high_priority()
	{
		self::$high_priority = ' high_priority ';
	}
	
	
	public static function distinctrow()
	{
		self::$distinctrow = ' distinctrow ';
	}
	
	
	public static function all()
	{
		self::$all = ' all ';
	}
	
	
	public static function having($condition = '')
	{
		if( ! is_string($condition))
		{
			self::$error = get_error('Database', 'db_string_parameter_error', 'having(string) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		self::$having .= ' '.($condition).' ';
	}
	
	// hangi tablodan sorgu yapilacagini ayarlar.
	
	public static function from($condition = '')
	{
		if( ! is_string($condition))
		{
			self::$error = get_error('Database', 'db_string_parameter_error', 'from(string) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		self::$from = ' '.$condition.' ';
	}
	
	// Sorgu yaparken sart eklemek için kullanilir.
	
	public static function where($column = '', $status = '', $value = '')
	{
		if( ! is_string($column) ||  ! (is_string($status) || is_numeric($status)))
		{
			self::$error = get_error('Database', 'db_string_parameter_error', 'where(string, string/int, string/int) 1, 2.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		if(is_array($value))
		{
			self::$error = get_error('Database', 'db_string_parameter_error', 'where(string, string/int, string/int) 3.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		if(empty($column) || empty($status)) return false;
		
		if(empty($value))
		{
			$value = $status;
			$status = '';
		}
		$value = "'".($value)."'";
		
		if(self::$use_where_count > 1) $condition = ' and '; else $condition = ' ';
		
		self::$where .= $condition.($column).' '.($status).' '.$value;
		
		self::$use_where_count++;
	}
	
	
	public static function or_where($column = '', $status = '', $value = '')
	{
		if( ! is_string($column) ||  ! (is_string($status) || is_numeric($status)))
		{
			self::$error = get_error('Database', 'db_string_parameter_error', 'or_where(string, string/int, string/int) 1, 2.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		if(is_array($value))
		{
			self::$error = get_error('Database', 'db_string_parameter_error', 'or_where(string, string,/int string/int) 3.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		if(empty($column) || empty($status)) return false;
		
		if(empty($value))
		{
			$value = $status;
			$status = '';
		}
		
		$value = "'".($value)."'";
		
		if(self::$use_where_count > 1) $condition = ' or '; else $condition = ' ';
		
		self::$where .= $condition.($column).' '.($status).' '.$value;
		
		self::$use_where_count++;
	}
	
	// Tablo birlestirmek için kullanilir.
	
	public static function join($table = '', $condition = '', $type = '')
	{
		if( ! is_string($table) ||  ! is_string($condition) ||  ! is_string($type))
		{
			self::$error = get_error('Database', 'db_string_parameter_error', 'join(string, string, string) 1, 2, 3.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		self::$join .= ' '.$type.' join '.$table.' on '.$condition.' ';
	}
	
	// Veriler içerisinde siralama yapmak için kullanilir.
	
	public static function order_by($condition = '', $type = '')
	{
		if( ! is_string($condition) ||  ! is_string($type))
		{
			self::$error = get_error('Database', 'db_string_parameter_error', 'order_by(string, string)1, 2.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		self::$order_by = ' order by '.($condition).' '.($type).' ';
	}
	
	// Verileri gruplayarak almaya yarar.
	
	public static function group_by($condition = '')
	{
		if( ! is_string($condition))
		{
			self::$error = get_error('Database', 'db_string_parameter_error', 'group_by(string) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		self::$order_by = ' group by '.($condition).' ';
	}
	
	// Dönecek kayit sayini ayarlamaya yarar.
	
	public static function limit($start = '', $limit = '')
	{
		if( ! is_numeric($start) || ! is_numeric($limit) )
		{
			self::$error = get_error('Database', 'db_numeric_parameter_error', 'limit(numeric, numeric) 1, 2.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		if( ! empty($limit) ) $comma = ' , '; else $comma = '';
		
		self::$limit = ' limit '.($start).$comma.($limit).' ';
	}
	
	
	public static function connect($host = '', $user = '', $pw = '', $db = '')
	{		
		if( ! is_string($host) ||  ! is_string($user) ||  ! is_string($pw) ||  ! is_string($db))
		{
			self::$error = get_error('Database', 'db_string_parameter_error', 'connect(string, string, string, string) 1, 2, 3, 4.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		$driver = config::get('Database','driver');
		
		if($driver === 'mysql')
			$connect  = @mysql_connect($host, $user, $pw);
		elseif($driver === 'mysqli')
			$connect  = mysqli_connect($host, $user, $pw, $db);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
			
		if( isset($connect) )
			return $connect;
		else 
		{
			self::$error = get_error('Database', 'db_mysql_connect_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;	
		}
	}
	
	
	public static function select_db($db = '', $connect = '')
	{	
		if( ! is_string($db)) 
		{
			self::$error = get_error('Database', 'db_string_parameter_error', 'select_db(string, resource) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		 
		if(empty(self::$connect)) self::settings();
		
		if( ! empty(self::$connect) && empty($connect)) $connect = self::$connect;
		
		if( ! is_resource($connect))
		{
			self::$error = get_error('Database', 'db_connect_resource_error', 'select_db(string, resource) 2.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		$driver = config::get('Database','driver');
		
		if($driver === 'mysql')
			$select_db  = mysql_select_db($db, $connect);
		else if($driver === 'mysqli')
			$select_db  = mysqli_select_db($connect, $db);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		if($select_db) 
			return $select_db; 
		else 
		{
			if(self::errno() == '1049')
			{
				self::$error = get_error('Database', 'db_unknown_database_error', $db);
			}
			else if(self::errno() == '1046')
			{
				self::$error = get_error('Database', 'db_not_database_selected_error', $db);			
			}
			
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
	}
	
	
	public static function connection_status()
	{
		if(empty(self::$connect)) self::settings();
			
		if(isset(self::$connect) && isset(self::$select_db)) 
			return true; 
		else 
			return false;
	}
	
	
	public static function connection()
	{
		if(empty(self::$connect)) self::settings();
			
		if(isset(self::$connect)) 
			return self::$connect; 
		else 
			return false;
	}
	
	// Sorguyu bitirmek için kullanilir.
	
	public static function query($que = '', $connect = '')
	{
		if( ! is_string($que)) 
		{
			self::$error = get_error('Database', 'db_string_parameter_error', 'query(string, resource) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		if( ! self::$connect) self::settings();
		
		if( ! empty(self::$connect) && empty($connect)) 
			$connect = self::$connect;
			
		if( ! is_resource($connect))
		{
			self::$error = get_error('Database', 'db_connect_resource_error', 'query(string, resource) 2.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		$driver = config::get('Database','driver');
		
		if($driver === 'mysql')
			$query  = mysql_query($que, $connect);
		elseif($driver === 'mysqli')
			$query  = mysqli_query($connect, $que);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		if( ! empty($query))
			return $query;
		else
		{
			if(self::errno() == '1065')
				self::$error = get_error('Database', 'db_query_empty_error');
			else if(self::errno() == '1146')
				self::$error = get_error('Database', 'db_table_not_exists_error', 'Sorgu');
			else if(self::errno() == '1054')
				self::$error = get_error('Database', 'db_unknown_column_error');
			else if(self::errno() == '1064')
				self::$error = get_error('Database', 'db_sql_sytax_error');			
			
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
	}
	
	
	public static function num_rows($que = '')
	{
		if(empty(self::$connect)) self::settings();
		
		if(empty($que))
		{	
			self::$error = get_error('Database', 'db_parameter_error', 'num_rows(resource) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;	
		}
		else if( ! is_resource($que))
		{
			self::$error = get_error('Database', 'db_string_error', 'num_rows(resource) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;			
		}	
		
		$driver = config::get('Database','driver');
		
		if($driver === 'mysql')
			$num_rows  = mysql_num_rows($que);
		elseif($driver === 'mysqli')
			$num_rows  = mysqli_num_rows($que);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		return $num_rows;
	}
	
	
	public static function num_fields($que = '')
	{

		if(empty(self::$connect)) self::settings();
		
		if(empty($que))
		{	
			self::$error = get_error('Database', 'db_parameter_error', 'num_fields(resource) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;	
		}
		elseif( ! is_resource($que))
		{
			self::$error = get_error('Database', 'db_string_error', 'num_fields(resource) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;			
		}	
		
		$driver = config::get('Database','driver');
		
		if($driver === 'mysql')
			$num_fields  = mysql_num_fields($que);
		elseif($driver === 'mysqli')
			$num_fields  = mysqli_num_fields($que);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		return $num_fields;
	}
	
	
	public static function fetch_array($que = '')
	{
		
		if(empty(self::$connect)) self::settings();
	
		if(empty($que))
		{	
			self::$error = get_error('Database', 'db_parameter_error', 'fetch_array(resource) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;	
		}
		else if( ! is_resource($que))
		{
			self::$error = get_error('Database', 'db_string_error', 'fetch_array(resource) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;			
		}	
		
		$driver = config::get('Database','driver');
		
		if($driver === 'mysql')
			$fetch_array  = mysql_fetch_array($que);
		elseif($driver === 'mysqli')
			$fetch_array  = mysqli_fetch_array($que);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		return $fetch_array;
	}
	
	
	public static function fetch_assoc($que = '')
	{
	
		if(empty(self::$connect)) self::settings();
		
		if(empty($que))
		{	
			self::$error = get_error('Database', 'db_parameter_error', 'fetch_assoc(resource) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;	
		}
		else if( ! is_resource($que))
		{
			self::$error = get_error('Database', 'db_string_error', 'fetch_assoc(resource) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;			
		}	
		
		$driver = config::get('Database','driver');
		
		if($driver === 'mysql')
			$fetch_assoc  = mysql_fetch_assoc($que);
		elseif($driver === 'mysqli')
			$fetch_assoc  = mysqli_fetch_assoc($que);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		return $fetch_assoc;
	}
	
	
	public static function affected_rows($connect = '')
	{
		if(empty(self::$connect)) self::settings();
		
		if( ! empty(self::$connect) && empty($connect)) $connect = self::$connect;
		
		if( ! is_resource($connect))
		{
			self::$error = get_error('Database', 'db_connect_resource_error', 'affected_rows(resource) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;			
		}	
		
		$driver = config::get('Database','driver');
				
		if($driver === 'mysql')
			$affected_rows  = mysql_affected_rows($connect);
		elseif($driver === 'mysqli')
			$affected_rows  = mysqli_affected_rows($connect);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		return $affected_rows;
	}
	
	
	public static function client_encoding($connect = '')
	{
		if(empty(self::$connect)) self::settings();
		
		if( ! empty(self::$connect) && empty($connect)) $connect = self::$connect;
		
		if( ! is_resource($connect))
		{
			self::$error = get_error('Database', 'db_connect_resource_error', 'client_encoding(resource) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;			
		}	
		
		$driver = config::get('Database','driver');
		
		if($driver === 'mysql')
			$client_encoding  = mysql_client_encoding($connect);
		elseif($driver === 'mysqli')
			$client_encoding  = mysqli_client_encoding($connect);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		return $client_encoding;
	}
	
	
	public static function data_seek($que = '', $row_number = '0')
	{
		
		if( ! is_numeric($row_number)) 
		{
			self::$error = get_error('Database', 'db_numeric_parameter_error', 'data_seek(resource, numeric) 2.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		
		if(empty($que) || empty($row_number))
		{	
			self::$error = get_error('Database', 'db_parameter_error', 'data_seek(resource, numeric) 1, 2.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;	
		}
		else if( ! is_resource($que))
		{
			self::$error = get_error('Database', 'db_string_error', 'data_seek(resource, numeric) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;			
		}
		
		$driver = config::get('Database','driver');
		
		if(empty(self::$connect)) self::settings();
			
		if($driver === 'mysql')
			$data_seek  = mysql_data_seek($que, $row_number);
		elseif($driver === 'mysqli')
			$data_seek  = mysqli_data_seek($que, $row_number);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		return $data_seek;
	}
	
	
	public static function escape_string($str = '')
	{
		if( ! is_string($str)) 
		{
			self::$error = get_error('Database', 'db_string_parameter_error', 'escape_string(string) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}	
		
		if(empty($str))
		{	
			self::$error = get_error('Database', 'db_parameter_error', 'escape_string(string) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;	
		}
		
		$driver = config::get('Database','driver');
		
		if(empty(self::$connect)) self::settings();

		if($driver === 'mysql')
			$escape_string  = mysql_escape_string($str);
		else if($driver === 'mysqli')
			$escape_string  = mysqli_escape_string($str);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		return $escape_string;
	}
	
	
	public static function fetch_field($que = '', $field_offset = 0)
	{
		if( ! is_numeric($field_offset)) 
		{
			self::$error = get_error('Database', 'db_numeric_parameter_error', 'fetch_field(resource, string) 2.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
			
		if(empty($que))
		{	
			self::$error = get_error('Database', 'db_parameter_error', 'fetch_field(resource, string) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;	
		}
		else if( ! is_resource($que))
		{
			self::$error = get_error('Database', 'db_string_error', 'fetch_field(resource, string) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;			
		}
		
		$driver = config::get('Database','driver');
		
		if(empty(self::$connect)) self::settings();

		if($driver === 'mysql')
			$fetch_field  = mysql_fetch_field($que, $field_offset);
		else if($driver === 'mysqli')
			$fetch_field  = mysqli_fetch_field($que);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		return $fetch_field;
	}
	
	
	public static function fetch_lengths($que = '')
	{	
		if(empty($que))
		{	
			self::$error = get_error('Database', 'db_parameter_error', 'fetch_lengths(resource) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;	
		}
		else if( ! is_resource($que))
		{
			self::$error = get_error('Database', 'db_string_error', 'fetch_lengths(resource) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;			
		}
		
		$driver = config::get('Database','driver');
		
		if(empty(self::$connect)) self::settings();

		if($driver === 'mysql')
			$fetch_lengths  = mysql_fetch_lengths($que);
		else if($driver === 'mysqli')
			$fetch_lengths  = mysqli_fetch_lengths($que);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		return $fetch_lengths;
	}
	
	
	public static function fetch_object($que = '', $class_name = '', $params = array())
	{
		if(is_string($class_name)) 
		{
			self::$error = get_error('Database', 'db_string_parameter_error', 'fetch_object(resource, string, array) 2.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		if(empty($class_name))
		{	
			self::$error = get_error('Database', 'db_parameter_error', 'fetch_object(resource, string, array) 2.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;	
		}
		
		if( ! class_exists($class_name))
		{	
			self::$error = get_error('Database', 'db_class_not_exists_error', 'fetch_object(resource, string, array) 2.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;	
		}
		
		if( ! is_array($params)) 
		{
			self::$error = get_error('Database', 'db_array_parameter_error', 'fetch_object(resource, string, array) 3.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		if(empty($que))
		{	
			self::$error = get_error('Database', 'db_parameter_error', 'fetch_object(resource, string, array) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;	
		}
		else if( ! is_resource($que))
		{
			self::$error = get_error('Database', 'db_string_error', 'fetch_object(resource, string, array) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;			
		}
		
		$driver = config::get('Database','driver');
		
		if(empty(self::$connect)) self::settings();
				
		if($driver === 'mysql')
			$fetch_object  = mysql_fetch_object($que, $class_name, $params);
		else if($driver === 'mysqli')
			$fetch_object  = mysqli_fetch_object($que, $class_name, $params);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		return $fetch_object;
	}
	
	
	public static function fetch_row($que = '')
	{	
		if(empty($que))
		{	
			self::$error = get_error('Database', 'db_parameter_error', 'fetch_row(resource) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;	
		}
		else if( ! is_resource($que))
		{
			self::$error = get_error('Database', 'db_string_error', 'fetch_row(resource) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;			
		}
		
		$driver = config::get('Database','driver');
		
		if(empty(self::$connect)) self::settings();

		if($driver === 'mysql')
			$fetch_row  = mysql_fetch_row($que);
		else if($driver === 'mysqli')
			$fetch_row  = mysqli_fetch_row($que);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		return $fetch_row;
	}
	
	
	public static function field_seek($que = '', $field_number = 0)
	{
		if( ! is_numeric($field_number))
		{	
			self::$error = get_error('Database', 'db_numeric_parameter_error', 'field_seek(resource, numeric) 2.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;	
		}
		
		if(empty($que) || empty($field_number))
		{	
			self::$error = get_error('Database', 'db_parameter_error', 'field_seek(resource, numeric) 1, 2.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;	
		}
		else if( ! is_resource($que))
		{
			self::$error = get_error('Database', 'db_string_error', 'field_seek(resource, numeric) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;			
		}
		
		$driver = config::get('Database','driver');
		
		if(empty(self::$connect)) self::settings();

		if($driver === 'mysql')
			$field_seek  = mysql_field_seek($que,$field_number);
		else if($driver === 'mysqli')
			$field_seek  = mysqli_field_seek($que, $field_number);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		return $field_seek;
	}
	
	
	public static function free_result($que = '')
	{
		if(empty($que))
		{	
			self::$error = get_error('Database', 'db_parameter_error', 'free_result(resource) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;	
		}
		else if( ! is_resource($que))
		{
			self::$error = get_error('Database', 'db_string_error', 'free_result(resource) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;			
		}
		
		$driver = config::get('Database','driver');
		
		if(empty(self::$connect)) self::settings();

		if($driver === 'mysql')
			$free_result  = mysql_field_seek($que);
		else if($driver === 'mysqli')
			$free_result  = mysqli_field_seek($que);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		return $free_result;
	}
	
	
	public static function get_client_info()
	{
		$driver = config::get('Database','driver');
		
		if(empty(self::$connect)) self::settings();

		if($driver === 'mysql')
			$get_client_info  = mysql_get_client_info();
		else if($driver === 'mysqli')
			$get_client_info  = mysqli_get_client_info();
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		return $get_client_info;
	}
	
	
	public static function get_host_info($connect = '')
	{
		if(empty(self::$connect)) self::settings();
		
		if( ! empty(self::$connect) && empty($connect)) $connect = self::$connect;
		
		if( ! is_resource($connect))
		{
			self::$error = get_error('Database', 'db_connect_resource_error', 'get_host_info(resource) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;			
		}
		
		$driver = config::get('Database','driver');
		
		if($driver === 'mysql')
			$get_host_info  = mysql_get_host_info($connect);
		else if($driver === 'mysqli')
			$get_host_info  = mysqli_get_host_info($connect);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		return $get_host_info;
	}
	
	
	public static function get_proto_info($connect = '')
	{
		if(empty(self::$connect)) self::settings();
		
		if( ! empty(self::$connect) && empty($connect)) $connect = self::$connect;
		
		if( ! is_resource($connect))
		{
			self::$error = get_error('Database', 'db_connect_resource_error', 'get_proto_info(resource) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;			
		}
		
		$driver = config::get('Database','driver');

		if($driver === 'mysql')
			$get_proto_info  = mysql_get_proto_info($connect);
		else if($driver === 'mysqli')
			$get_proto_info  = mysqli_get_proto_info($connect);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		return $get_proto_info;
	}
	
	
	public static function get_server_info($connect = '')
	{
		if(empty(self::$connect)) self::settings();
		
		if( ! empty(self::$connect) && empty($connect)) $connect = self::$connect;
		
		if( ! is_resource($connect))
		{
			self::$error = get_error('Database', 'db_connect_resource_error', 'get_server_info(resource) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;			
		}
		
		$driver = config::get('Database','driver');
		
		if($driver === 'mysql')
			$get_server_info  = mysql_get_server_info($connect);
		else if($driver === 'mysqli')
			$get_server_info  = mysqli_get_server_info($connect);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		return $get_server_info;
	}
	
	
	public static function info($connect = '')
	{
		if(empty(self::$connect)) self::settings();
		
		if( ! empty(self::$connect) && empty($connect)) $connect = self::$connect;
		
		if( ! is_resource($connect))
		{
			self::$error = get_error('Database', 'db_connect_resource_error', 'info(resource) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;			
		}
		
		$driver = config::get('Database','driver');

		if($driver === 'mysql')
			$info  = mysql_info($connect);
		else if($driver === 'mysqli')
			$info  = mysqli_info($connect);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		return $info;
	}
	
	
	public static function insert_id($connect = '')
	{
		if(empty(self::$connect)) self::settings();
		
		if( ! empty(self::$connect) && empty($connect)) $connect = self::$connect;
		
		if( ! is_resource($connect))
		{
			self::$error = get_error('Database', 'db_connect_resource_error', 'insert_id(resource) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;			
		}
		
		$driver = config::get('Database','driver');
		
		if($driver === 'mysql')
			$insert_id  = mysql_insert_id($connect);
		else if($driver === 'mysqli')
			$insert_id  = mysqli_insert_id($connect);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		return $insert_id;
	}
	
	
	public static function ping($connect = '')
	{
		if(empty(self::$connect)) self::settings();
		
		if( ! empty(self::$connect) && empty($connect)) $connect = self::$connect;
		
		if( ! is_resource($connect))
		{
			self::$error = get_error('Database', 'db_connect_resource_error', 'ping(resource) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;			
		}
		
		$driver = config::get('Database','driver');

		if($driver === 'mysql')
			$ping  = mysql_ping($connect);
		else if($driver === 'mysqli')
			$ping  = mysqli_ping($connect);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		return $ping;
	}
	
	
	public static function real_escape_string($str = '', $connect = '')
	{
		if( ! is_string($str))
		{
			self::$error = get_error('Database', 'db_string_parameter_error', 'real_escape_string(string, resource) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;	
		}
		
		if(empty(self::$connect)) self::settings();
		
		if( ! empty(self::$connect) && empty($connect)) $connect = self::$connect;
		
		if( ! is_resource($connect))
		{
			self::$error = get_error('Database', 'db_connect_resource_error', 'real_escape_string(string, resource) 2.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;			
		}
		
		$driver = config::get('Database','driver');

		if($driver === 'mysql')
			$real_escape_string  = mysql_real_escape_string($str, $connect);
		else if($driver === 'mysqli')
			$real_escape_string  = mysqli_real_escape_string($connect, $str);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		return $real_escape_string;
	}
	
	
	public static function set_charset($charset = '', $connect = '')
	{
		if(empty(self::$connect)) self::settings();
		
		if( ! empty(self::$connect) && empty($connect)) $connect = self::$connect;
		
		if( ! is_resource($connect))
		{
			self::$error = get_error('Database', 'db_connect_resource_error', 'set_charset(string, resource) 2.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;			
		}
		
		$driver = config::get('Database','driver');

		if($driver === 'mysql')
			$set_charset  = mysql_set_charset($charset, $connect);
		else if($driver === 'mysqli')
			$set_charset  = mysqli_set_charset($connect, $charset);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		if(self::errno() == 2019)
		{
			self::$error = get_error('Database', 'db_invalid_charset_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		return $set_charset;
		
	}
	
	
	public static function stat($connect = '')
	{
		if(empty(self::$connect)) self::settings();
		
		if( ! empty(self::$connect) && empty($connect)) $connect = self::$connect;
		
		if( ! is_resource($connect))
		{
			self::$error = get_error('Database', 'db_connect_resource_error', 'stat(resource) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;			
		}
		
		$driver = config::get('Database','driver');

		if($driver === 'mysql')
			$stat  = mysql_stat($connect);
		else if($driver === 'mysqli')
			$stat  = mysqli_stat($connect);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		return $stat;
	}
	
	
	public static function thread_id($connect = '')
	{
		if(empty(self::$connect)) self::settings();
		
		if( ! empty(self::$connect) && empty($connect)) $connect = self::$connect;
		
		if( ! is_resource($connect))
		{
			self::$error = get_error('Database', 'db_connect_resource_error', 'thread_id(resource) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;			
		}
		
		$driver = config::get('Database','driver');
		
		if($driver === 'mysql')
			$thread_id  = mysql_thread_id($connect);
		else if($driver === 'mysqli')
			$thread_id  = mysql_thread_id($connect);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		return $thread_id;
	}	
	
	
	public static function close($connect = '')
	{
		if(empty(self::$connect)) self::settings();
		
		if( ! empty(self::$connect) && empty($connect)) $connect = self::$connect;
		
		if( ! is_resource($connect))
		{
			self::$error = get_error('Database', 'db_connect_resource_error', 'close(resource) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;			
		}
		
		$driver = config::get('Database','driver');
		
		if($driver === 'mysql')
			mysql_close($connect);
		else if($driver === 'mysqli')
			mysqli_close($connect);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
	}
	
		
	private static function _get($table = '', $wh = '')
	{
		if( ! is_string($table) || ! is_string($wh)) 
		{
			self::$error = get_error('Database', 'db_string_parameter_error', 'get(string, string) 1, 2.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		if(empty(self::$select))
		{
			$select = 
			'select'.
				self::$distinct.self::$all.self::$distinctrow.self::$high_priority.self::$straight_join.
				self::$small_result.self::$big_result.self::$buffer_result.self::$cache.self::$nocache.self::$calc_found_rows.
			' * ';
		} 
		else
		{
			$select = self::$select;
		}
		$prefix = '';
		if(config::get('Database', 'prefix')) $prefix = config::get('Database', 'prefix');
		
		if(empty(self::$from))	
			$from = 'from '.$prefix.$table.' '; 
		else  
			$from = 'from '.$prefix.self::$from;
			
		if(empty(self::$where))	
		{ 
			$where = ''; 
			if( $wh ) $where = ' where '; 
		} 
		else $where = ' where ';
		
		if(empty(self::$having))
			$having = '';
		else 
			$having = ' having ';	
		
		$select_pats = $select.$from.self::$join.$where.$wh.self::$where.self::$group_by.$having.self::$having.self::$order_by;
		
		if( ! empty(self::$simple_query))
		{ 
			$select_pats = self::$simple_query;
		}
		
		if(empty(self::$connect)) self::settings();	
	
		$query = self::query($select_pats.self::$limit);
		
		if(empty($query))  
		{
			if(self::errno() == '1146')
			{
				self::$error = get_error('Database', 'db_table_not_exists_error', $table);
			}
			else if(self::errno() == '1054')
			{
				self::$error = get_error('Database', 'db_unknown_column_error');
			}
			else if(self::errno() == '1064')
			{
				self::$error = get_error('Database', 'db_sql_sytax_error');		
			}
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
			
		if( ! empty(self::$limit) )
		{
			$t_rows = self::query($select_pats);
			
			if( ! $t_rows)  
			{
				if(self::errno() == '1146')
				{
					self::$error = get_error('Database', 'db_table_not_exists_error', $table);
				}
				else if(self::errno() == '1054')
				{
					self::$error = get_error('Database', 'db_unknown_column_error');
				}
				else if(self::errno() == '1064')
				{
					self::$error = get_error('Database', 'db_sql_sytax_error');
				}
				report('Error',self::$error,'DatabaseLibrary');
				return false;
			}
		
			self::$total_num_rows = self::num_rows($t_rows);
		}
		else
		{
			self::$total_num_rows = false;
		}
		
		self::$num_rows  = self::num_rows($query);
		self::$num_fields = self::num_fields($query);

	
		$j = 0;
		$cols = array();
		
		if(config::get('Database','driver') == 'mysqli')
				$fields = @mysqli_fetch_fields($query);
	
		while($data = self::fetch_array($query))
		{
			for($i=0; $i < self::$num_fields; $i++)
			{	
				
				if(config::get('Database','driver') == 'mysql')
					$columns = mysql_field_name($query,$i);
				
				if(config::get('Database','driver') == 'mysqli')			
					$columns = $fields[$i]->name;
			
				if(!in_array($columns,$cols)) array_push($cols, $columns);
				@self::$result[$j]->$columns = $data[$columns]; 
			}
			$j++;
		}
		
		if(isset(self::$result[0])) self::$row = self::$result[0];
		self::$columns = $cols;
	}
	
	// Klasik sorgu yapmak için kullaniyoruz.
	
	public static function simple_query($query = '')
	{
		if( ! is_string($query)) 
		{
			self::$error = get_error('Database', 'db_string_parameter_error', 'simple_query(string) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		self::$simple_query = ' '.$query.' ';
		self::_get();
		$data["result"] = self::result();
		$data["row"] = self::row();
		$data["total_rows"] = self::total_rows();
		$data["limited_total_rows"] = self::total_rows(true);
		$data["total_columns"] = self::total_columns();
		$data["columns"] = self::columns();
		$data["error"] = self::error();
		self::query_end();
		return (object)$data;
			
	}
	
	public static function get($table = '', $wh = '')
	{
		self::_get($table, $wh);
		$data["result"] = self::result();
		$data["row"] = self::row();
		$data["total_rows"] = self::total_rows();
		$data["limited_total_rows"] = self::total_rows(true);
		$data["total_columns"] = self::total_columns();
		$data["columns"] = self::columns();
		$data["error"] = self::error();
		self::query_end();
		return (object)$data;		
	}
	
	
	// Sorgu sonucu dönen degerleri verir.
	
	private static function result()
	{
		$result = self::$result;
	
		return 	$result;
	}
	
	private static function attributes($_attributes = '')
	{
		$attribute = "";
		if(is_array($_attributes))
		{
			foreach($_attributes as $key => $values)
			{
				if(is_numeric($key))
					$key = $values;
				$attribute .= ' '.$key.'="'.$values.'"';
			}	
		}
		
		return $attribute;		
	}
	
	
	public static function result_table($table = '', $wh = '', $att = array())
	{	
		self::_get($table, $wh);
		
		if( ! is_array($att)) $att = array();
		
		$result_table = self::result();
		$columns = self::columns();
		
		$str  = '<table'.self::attributes($att).'>';
		$str .= '<tr>';
		if(is_array($columns)) foreach($columns as $column)
		{
			$str .= '<th>'.$column.'</th>';
		}
		$str .= '</tr>';
		if(is_array($result_table))foreach($result_table as $res)
		{
			$str .= '<tr>';
			foreach($res as $v)
			{
				$str .= '<td>'.$v.'</td>';
			}
			$str .= '</tr>';
		}
		$str .= '</table>';
		
		self::query_end();
		
		return 	$str;
	}
	
	
	private static function query_end()
	{
		if(self::$connect) self::close();
		
		if(isset(self::$join))				self::$join 				= ''; 
		if(isset(self::$select_db))			self::$select_db 			= ''; 
		if(isset(self::$select))			self::$select 				= ''; 
		if(isset(self::$from))				self::$from 				= ''; 
		if(isset(self::$distinct))			self::$distinct 			= ''; 
		if(isset(self::$where))				self::$where 				= ''; 
		if(isset(self::$limit))				self::$limit 				= ''; 
		if(isset(self::$order_by))			self::$order_by 			= '';
		if(isset(self::$group_by))			self::$group_by 			= '';
		if(isset(self::$having))			self::$having 				= '';
		if(isset(self::$use_where_count))	self::$use_where_count 		= 1;
		if(isset(self::$all))				self::$all 					= '';
		if(isset(self::$distinct))			self::$distinct 			= '';
		if(isset(self::$distinctrow))		self::$distinctrow 			= '';
		if(isset(self::$big_result))		self::$big_result 			= '';
		if(isset(self::$buffer_result))		self::$buffer_result 		= '';
		if(isset(self::$small_result))		self::$small_result 		= '';
		if(isset(self::$cache))				self::$cache 				= '';
		if(isset(self::$nocache))			self::$nocache 				= '';
		if(isset(self::$high_priority))		self::$high_priority 		= '';
		if(isset(self::$straight_join))		self::$straight_join 		= '';
		if(isset(self::$calc_found_rows))	self::$calc_found_rows 		= '';
		if(isset(self::$row))				self::$row 					= '';
		if(isset(self::$num_rows))			self::$num_rows 			= '';
		if(isset(self::$total_num_rows))	self::$total_num_rows 		= '';
		if(isset(self::$colums))			self::$colums 				= '';
		if(isset(self::$num_fields))		self::$num_fields 			= '';
		if(isset(self::$connect))			self::$connect 				= '';
		if(isset(self::$result))			self::$result 				= '';	
		if(isset(self::$simple_query))		self::$simple_query 		= '';
	}
	
	// Sadece bir kayit verir.
	
	private static function row()
	{
		return 	self::$row;
	}
	
	// Satir sayisini verir.
	
	private static function total_rows($limit = false)
	{
		if( ! (is_bool($limit) || is_string($limit))) $limit = false;
		
		if(empty($limit) && ! empty(self::$total_num_rows)) 
			return self::$total_num_rows; 
		else 
			return self::$num_rows;
		
	}
	
	
	// Sütun sayisini verir.
	
	private static function total_columns()
	{
		return 	self::$num_fields;
	}
	
	// Tabloya ait sütunlari verir.
	
	private static function columns()
	{
		return 	self::$columns;
	}
	
	
	// Tabloya veri eklemek için kullanilir.
	
	public static function insert($table = '', $datas = array())
	{
		if( ! is_string($table)) 
		{
			self::$error = get_error('Database', 'db_string_parameter_error', 'insert(string, array) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		if(empty($table))
		{
			self::$error = get_error('Database', 'db_parameter_error', 'insert(string, array) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;	
		}
		if( ! is_array($datas))
		{
			self::$error = get_error('Database', 'db_array_parameter_error', 'insert(string, array) 2.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;	
		}	
		if(empty($datas))
		{
			self::$error = get_error('Database', 'db_parameter_error', 'insert(string, array) 2.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;	
		}
		
		if(empty(self::$connect)) self::settings();
		
		$data = ""; $values = "";
		
		foreach($datas as $key => $value)
		{
			$data .= $key.",";
			$values .= "'".self::real_escape_string($value)."'".",";
			
		}
		
		$result = self::query('insert into '.$table.' ('.substr($data,0,-1).') values ('.substr($values,0,-1).')');
		if( ! empty($result))
		{
			if( ! empty(self::$connect)) 
			{	
				self::close();
				self::$connect 	= '';
			} 
			return true; 
		}
		else 
		{
			if(self::errno() == '1146')
			{
				self::$error = get_error('Database', 'db_table_not_exists_error', $table);
			}
			else if(self::errno() == '1054')
			{
				self::$error = get_error('Database', 'db_unknown_column_error');
			}
			else if(self::errno() == '1064')
			{
				self::$error = get_error('Database', 'db_sql_sytax_error');
			}
			report('Error',self::$error,'DatabaseLibrary');	
			return false;
		}
	}
	
	// Tablodan bilgi silmek için kullanilir.
	
	public static function delete($table = '', $where = '')
	{		
		if( ! is_string($table) || ! is_string($where)) 
		{
			self::$error = get_error('Database', 'db_string_parameter_error', 'delete(string, string) 1, 2.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		if(empty(self::$where))
		{
			if( ! empty($where))
			{
				$where = ' where '.($where);
			}
		}
		else
		{
			$where = ' where '.(self::$where);
			self::$where = '';
			self::$use_where_count = 1;
		}
		
		if(empty(self::$connect)) self::settings();
		
		$result = self::query('delete from '.$table.$where);
		if( ! empty($result))
		{
			if( ! empty(self::$connect)) 
			{	
				self::close();
				self::$connect 	= '';
			} 
			return true; 
		}
		else 
		{
			if(self::errno() == '1146')
			{
				self::$error = get_error('Database', 'db_table_not_exists_error', $table);
			}
			else if(self::errno() == '1054')
			{
				self::$error = get_error('Database', 'db_unknown_column_error');
			}
			else if(self::errno() == '1064')
			{
				self::$error = get_error('Database', 'db_sql_sytax_error');
			}
			report('Error',self::$error,'DatabaseLibrary');		
			return false;
		}
		
	}
	
	// Sorgu üzerinden güncelleme yapmak için kallanilir.
	
	public static function update($table = '', $set = array(), $where = '')
	{
		
		if( ! is_string($table) || ! is_string($where)) 
		{
			self::$error = get_error('Database', 'db_string_parameter_error', 'update(string, array, string) 1, 3.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
			
		if(empty($table))
		{
			self::$error = get_error('Database', 'db_parameter_error', 'update(string, array, string) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;	
		}
		
		if( ! is_array($set))
		{
			self::$error = get_error('Database', 'db_array_parameter_error', 'update(string, array, string) 2.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;	
		}	
		
		if(empty($set))
		{
			self::$error = get_error('Database', 'db_parameter_error', 'update(string, array, string) 2.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;	
		}
		
		
		$data = "";
		
		if(empty(self::$where))
		{
			if( ! empty($where))
			{
				$where = ' where '.($where);
			}
		}
		else
		{
			$where = ' where '.(self::$where);
			self::$use_where_count 		= 1;
			self::$where = '';
		}
		
		if(empty(self::$connect)) self::settings();
		
		if(is_array($set)) foreach($set as $key => $value)
		{
			$data .= $key.'='."'".self::real_escape_string($value)."'".',';
		}
		$set = ' set '.substr($data,0,-1);
		
		
		$result = self::query('update '.$table.$set.$where);
		if( ! empty($result))
		{
			if( ! empty(self::$connect)) 
			{	
				self::close();
				self::$connect 	= '';
			} 
			return true; 
		}
		else 
		{
			if(self::errno() == '1146')
			{
				self::$error = get_error('Database', 'db_table_not_exists_error', $table);
			}
			else if(self::errno() == '1054')
			{
				self::$error = get_error('Database', 'db_unknown_column_error');
			}
			else if(self::errno() == '1064')
			{
				self::$error = get_error('Database', 'db_sql_sytax_error');
			}
			report('Error',self::$error,'DatabaseLibrary');		
			return false;
		}
	}
	
	
	public static function create_database($db = '')
	{
		
		if( ! is_string($db)) 
		{
			self::$error = get_error('Database', 'db_string_parameter_error', 'create_database(string) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		if(empty($db))
		{
			self::$error = get_error('Database', 'db_parameter_error', 'create_database(string) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;	
		}
		
		if(empty(self::$connect)) self::settings();		
		
		$result = self::query('create database '.$db);
		if( ! empty($result))
		{
			if( ! empty(self::$connect)) 
			{	
				self::close();
				self::$connect 	= '';
			} 
			return true; 
		}
		else 
		{
			if(self::errno() == '1146')
			{
				self::$error = get_error('Database', 'db_table_not_exists_error', $table);
			}
			else if(self::errno() == '1054')
			{
				self::$error = get_error('Database', 'db_unknown_column_error');
			}
			else if(self::errno() == '1064')
			{
				self::$error = get_error('Database', 'db_sql_sytax_error');
			}
			else if(self::errno() == '1007')
			{
				self::$error = get_error('Database', 'db_db_already_exists_error', $db);
			}
			report('Error',self::$error,'DatabaseLibrary');	
			return false;
		}
	}
	
	
	public static function drop_database($db = '')
	{
		
		if(empty($db))
		{		
			self::$error = get_error('Database', 'db_parameter_error', 'drop_database(string) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;	
		}
		
		if(empty(self::$connect)) self::settings();
		
		if( ! is_array($db))
		{
			$result = self::query('drop database '.$db);
		}
		else
		{
			foreach($db as $v)
			{
				$result = self::query('drop database '.$v);
			}
		}
		if( ! empty($result))
		{
			if( ! empty(self::$connect)) 
			{	
				self::close();
				self::$connect 	= '';
			} 
			return true; 
		}
		else 
		{
			if(self::errno() == '1146')
			{
				self::$error = get_error('Database', 'db_table_not_exists_error', $table);
			}
			else if(self::errno() == '1054')
			{
				self::$error = get_error('Database', 'db_unknown_column_error');
			}
			else if(self::errno() == '1064')
			{
				self::$error = get_error('Database', 'db_sql_sytax_error');
			}
			report('Error',self::$error,'DatabaseLibrary');		
			return false;
		}
	}
	
	// yeni bir tablo olusturmak için kullanilir.
	
	public static function create_table($table = '', $condition = array())
	{	
		if( ! is_string($table)) 
		{
			self::$error = get_error('Database', 'db_string_parameter_error', 'create_table(string, array) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		if(empty($table))
		{
			self::$error = get_error('Database', 'db_parameter_error', 'create_table(string, array) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;	
		}	
		
		if( ! is_array($condition))
		{
			self::$error = get_error('Database', 'db_array_parameter_error', 'create_table(string, array) 2.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;	
		}
		
		$count = count($condition) - 1;
		$keys = array_keys($condition);
		
		$column = "";
		
		foreach($condition as $key => $value)
		{
			$column .= $key.' '.$value.',';
		}
		
		if(empty(self::$connect)) self::settings();
		
		$result = self::query('create table '.$table.'('.substr($column,0,-1).')');
		
		if( ! empty($result))
		{
			if( ! empty(self::$connect)) 
			{	
				self::close();
				self::$connect 	= '';
			} 
			return true; 
		}
		else 
		{
			if(self::errno() == '1146')
			{
				self::$error = get_error('Database', 'db_table_not_exists_error', $table);
			}
			else if(self::errno() == '1054')
			{
				self::$error = get_error('Database', 'db_unknown_column_error');
			}
			else if(self::errno() == '1064')
			{
				self::$error = get_error('Database', 'db_sql_sytax_error');
			}
			else if(self::errno() == '1050')
			{
				self::$error = get_error('Database', 'db_table_already_exists_error', $table);
			
			}
			report('Error',self::$error,'DatabaseLibrary');	
			return false;
		}
	}
	
	//Tabloyu düzenlemek için kullanilir.
	
	public static function alter_table($table = '', $condition = array())
	{
	
		if( ! is_string($table)) 
		{
			self::$error = get_error('Database', 'db_string_parameter_error', 'alter_table(string, array) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		$con = '';
		if(empty($table))
		{
			self::$error = get_error('Database', 'db_parameter_error', 'alter_table(string, array) 1.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;	
		}
		
		if( ! is_array($condition))
		{
			self::$error = get_error('Database', 'db_array_parameter_error', 'alter_table(string, array) 2.');
			report('Error',self::$error,'DatabaseLibrary');
			return false;	
		}
		
		if(key($condition) == 'rename') $con = 'rename to '.$condition["rename"];
		if(key($condition) == 'add_column') 	$con = 'add '.$condition['add_column'];
		if(key($condition) == 'drop_column') 	$con = 'drop '.$condition['drop_column'];		
		
		if(empty(self::$connect)) self::settings();
		
		$result = self::query('alter table '.$table.' '.$con.' ');
		
		if( ! empty($result))
		{
			if( ! empty(self::$connect)) 
			{	
				self::close();
				self::$connect 	= '';
			} 
			return true; 
		}
		else 
		{
			if(self::errno() == '1146')
			{
				self::$error = get_error('Database', 'db_table_not_exists_error', $table);
				
			}
			else if(self::errno() == '1054')
			{
				self::$error = get_error('Database', 'db_unknown_column_error');
				
			}
			else if(self::errno() == '1064')
			{
				self::$error = get_error('Database', 'db_sql_sytax_error');
			
			}
			report('Error',self::$error,'DatabaseLibrary');	
			return false;
		}
	}
	
	// tablo/tablolari siler.
	
	public static function drop_table($table = '')
	{
		if(empty($table))
		{
			self::$error = get_error('Database', 'db_parameter_error', 'drop_table(string/array) 1.');
			report('Error',self::$error,'DatabaseLibrary');	
			return false;	
		}
		
		if(empty(self::$connect)) self::settings();
		
		if(!is_array($table))
		{
			$result = self::query('drop table '.$table);
		}
		else
		{
			foreach($table as $row)
			{
				$result = self::query('drop table '.$row);
			}
		}
		if( ! empty($result))
		{
			if( ! empty(self::$connect)) 
			{	
				self::close();
				self::$connect 	= '';
			} 
			return true; 
		}
		else 
		{
			if(self::errno() == '1146' || self::errno() == '1051')
				self::$error = get_error('Database', 'db_table_not_exists_error', $table);
			else if(self::errno() == '1054')
				self::$error = get_error('Database', 'db_unknown_column_error');
			else if(self::errno() == '1064')
				self::$error = get_error('Database', 'db_sql_sytax_error');
			
			report('Error',self::$error,'DatabaseLibrary');	
			return false;
		}
	}
	
	
	
	// tablonun/tablolarin içerisini temizler.
	// NOT: Tablolari silmez.
	
	public static function truncate($table)
	{
		
		if(empty($table))
		{
			self::$error = get_error('Database', 'db_parameter_error', 'truncate(string) 1.');
			report('Error',self::$error,'DatabaseLibrary');	
			return false;	
		}
		
		if(empty(self::$connect)) self::settings();
		
		if( ! is_array($table))
		{
			$result = self::query('truncate '.$table);
		}
		else
		{
			foreach($table as $row)
			{
				$result = self::query('truncate '.$row);
			}
		}
		if( ! empty($result))
		{
			if( ! empty(self::$connect)) 
			{	
				self::close();
				self::$connect 	= '';
			} 
			return true; 
		}
		else 
		{
			if(self::errno() == '1146' || self::errno() == '1051')
				self::$error = get_error('Database', 'db_table_not_exists_error', $table);
			else if(self::errno() == '1054')
				self::$error = get_error('Database', 'db_unknown_column_error');
			else if(self::errno() == '1064')
				self::$error = get_error('Database', 'db_sql_sytax_error');
			
			report('Error',self::$error,'DatabaseLibrary');	
			return false;
		}
	}
	
	
	public static function errno($connect = '')
	{
		if(empty(self::$connect)) self::settings();
		
		if( ! empty(self::$connect) && empty($connect)) $connect = self::$connect;
		
		if( ! is_resource($connect))
		{
			self::$error = get_error('Database', 'db_connect_resource_error', 'errno(resource) 1.');
			return self::$error;			
		}

		$driver = config::get('Database','driver');
	
		if($driver === 'mysql')
			$errno  = mysql_errno($connect);
		else if($driver === 'mysqli')
			$errno  = mysqli_errno($connect);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		return $errno;
	}
	
	
	public static function error($connect = '')
	{	
		if(empty(self::$connect)) self::settings();
		
		if( ! empty(self::$connect) && empty($connect)) $connect = self::$connect;
		
		if( ! is_resource($connect))
		{
			self::$error = get_error('Database', 'db_connect_resource_error', 'error(resource) 1.');
			return self::$error;			
		}
		
		$driver = config::get('Database','driver');
			
		if($driver === 'mysql')
			$error  = mysql_error($connect);
		else if($driver === 'mysqli')
			$error  = mysqli_error($connect);
		else
		{
			self::$error = get_error('Database', 'db_driver_error');
			report('Error',self::$error,'DatabaseLibrary');
			return false;
		}
		
		if(self::$error) $error = self::$error;
	
		return $error;
	}
}