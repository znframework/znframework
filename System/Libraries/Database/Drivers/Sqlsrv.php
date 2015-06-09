<?php
/************************************************************/
/*                 SQL SERVER DRIVER LIBRARY                */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* SQLSRV DRIVER		                                                                      *
*******************************************************************************************
| Dahil(Import) Edilirken : Dahil Edilemez.  							                  |
| Sınıfı Kullanırken      :	Kullanılamaz.												  |
| 																						  |
| NOT: Veritabanı kütüphaneler için oluşturulmuş yardımcı sınıftır.                       |
******************************************************************************************/
class SqlsrvDriver
{
	/* Config Değişkeni
	 *  
	 * Veritabanı ayarlar bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $config;
	
	/* Connect Değişkeni
	 *  
	 * Veritabanı bağlantı bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $connect;
	
	/* Query Değişkeni
	 *  
	 * Veritabanı sorgu bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $query;
	
	/******************************************************************************************
	* CONNECT                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Nesne tanımlaması ve veritabanı ayarları çalıştırılıyor.				  |
	|          																				  |
	******************************************************************************************/
	public function connect($config = array())
	{
		$this->config = $config;
		
		$server = 	( ! empty($this->config['server']) )
					? $this->config['server']
					: $this->config['host'];
					
		if( ! empty($this->config['port']) ) 
		{
			$server .= ', '.$this->config['port'];
		}
		
		$connection = array
		(
			'UID'					=> $this->config['user'],
			'PWD'					=> $this->config['password'],
			'Database'				=> $this->config['database'],
			'ConnectionPooling'		=> 0,
			'CharacterSet'			=> $this->config['charset'],
			'Encrypt'				=> $this->config['encode'],
			'ReturnDatesAsStrings'	=> 1
		);
		
		$this->connect = @sqlsrv_connect($server, $connection);
		
		if( empty($this->connect) ) 
		{
			die(get_message('Database', 'db_mysql_connect_error'));
		}
	}
	
	/******************************************************************************************
	* EXEC                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki exec yönteminin kullanımıdır.  			  |
	|          																				  |
	******************************************************************************************/
	public function exec($query)
	{
		return sqlsrv_query($this->connect, $query);
	}
	
	/******************************************************************************************
	* QUERY                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki query yönteminin kullanımıdır.  			  |
	|          																				  |
	******************************************************************************************/
	public function query($query)
	{
		$this->query = sqlsrv_query($this->connect, $query);
		return $this->query;
	}
	
	/******************************************************************************************
	* TRANS START                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki begin transaction özelliğinin kullanımıdır.  |		
	|          																				  |
	******************************************************************************************/
	public function trans_start()
	{
		return sqlsrv_begin_transaction($this->connect);
	}
	
	/******************************************************************************************
	* TRANS ROLLBACK                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki rollback özelliğinin kullanımıdır.  	  	  |
	|          																				  |
	******************************************************************************************/
	public function trans_rollback()
	{
		return sqlsrv_rollback($this->connect);		 
	}
	
	/******************************************************************************************
	* TRANS COMMIT                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki commit özelliğinin kullanımıdır.        	  |
	|          																				  |
	******************************************************************************************/
	public function trans_commit()
	{
		return sqlsrv_commit($this->connect);
	}
	
	/******************************************************************************************
	* LIST DATABASES                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için bu yöntem desteklenmemektedir.                 		  | 
	|          																				  |
	******************************************************************************************/
	public function list_databases()
	{
		// Ön tanımlı sorgu kullanıyor.
		return false;
	}
	
	/******************************************************************************************
	* LIST TABLES                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için bu yöntem desteklenmemektedir.                 		  | 
	|          																				  |
	******************************************************************************************/
	public function list_tables()
	{
		// Ön tanımlı sorgu kullanıyor.
		return false;
	}
	
	/******************************************************************************************
	* INSERT ID                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için insert id kullanımıdır.                 		          |
	|          																				  |
	******************************************************************************************/
	public function insert_id()
	{
		$this->query('SELECT @@IDENTITY AS insert_id');
		$row = $query->row();
		return $row->insert_id;
	}
	
	/******************************************************************************************
	* COLUMN DATA                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Db sınıfında kullanımı için oluşturulmuş yöntemdir.                	  | 
	|          																				  |
	******************************************************************************************/
	public function column_data()
	{
		if( empty($this->query) ) 
		{
			return false;
		}
		
		$columns = array();
		
		foreach (sqlsrv_field_metadata($this->query) as $i => $field)
		{
			$columns[$i]				= new stdClass();
			$columns[$i]->name			= $field['Name'];
			$columns[$i]->type			= $field['Type'];
			$columns[$i]->max_length	= $field['Size'];
		}
		
		return $columns;
	}
	
	/******************************************************************************************
	* BACKUP                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü bu yöntemi desteklememektedir.                				  | 
	|          																				  |
	******************************************************************************************/
	public function backup($filename = '')
	{ 
		// Ön tanımlı sorgu kullanıyor.
		return false; 
	}
	
	/******************************************************************************************
	* TRUNCATE                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü bu yöntemi desteklememektedir.                				  |
	|          																				  |
	******************************************************************************************/		
	public function truncate($table = '')
	{ 
		// Ön tanımlı sorgu kullanıyor.
		return false; 
	}
	
	/******************************************************************************************
	* ADD COLUMN                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü bu yöntemi desteklememektedir.                				  | 
	|          																				  |
	******************************************************************************************/
	public function add_column()
	{ 
		// Ön tanımlı sorgu kullanıyor.
		return false; 
	}
	
	/******************************************************************************************
	* DROP COLUMN                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü bu yöntemi desteklememektedir.                				  | 
	|          																				  |
	******************************************************************************************/
	public function drop_column()
	{
		// Ön tanımlı sorgu kullanıyor. 
		return false; 
	}
	
	/******************************************************************************************
	* RENAME COLUMN                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için rename column kullanımıdır. 				  			  | 
	|          																				  |
	******************************************************************************************/
	public function rename_column()
	{ 
		return 'RENAME COLUMN '; 
	}
	
	/******************************************************************************************
	* MODIFY COLUMN                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü bu yöntemi desteklememektedir.			    				  | 
	|          																				  |
	******************************************************************************************/
	public function modify_column()
	{ 
		// Ön tanımlı sorgu kullanıyor.
		return false; 
	}
	
	/******************************************************************************************
	* NUM ROWS                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için toplam kayıt sayısı bilgisini verir.                	  | 
	|          																				  |
	******************************************************************************************/
	public function num_rows()
	{
		if( ! empty($this->query) )
		{
			return sqlsrv_num_rows($this->query);
		}
		else
		{
			return 0;	
		}
	}
	
	/******************************************************************************************
	* COLUMNS                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için sütun özellikleri bilgisini verir.                	      | 
	|          																				  |
	******************************************************************************************/
	public function columns()
	{
		if( empty($this->query) ) 
		{
			return false;
		}
		
		$columns = array();
		$num_fields = $this->num_fields();
		
		for($i=0; $i < $num_fields; $i++)
		{		
			$columns[] = sqlsrv_get_field($this->query, $i);
		}
		
		return $columns;
	}
	
	/******************************************************************************************
	* NUM FIEDLS                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için toplam sütun sayısı bilgisini verir.                	  | 
	|          																				  |
	******************************************************************************************/
	public function num_fields()
	{
		if( ! empty($this->query) )
		{
			return sqlsrv_num_fields($this->query);
		}
		else
		{
			return 0;	
		}
	}
	
	/******************************************************************************************
	* RESULT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için sorgu sonucu kayıtlar bilgisini verir.                	  | 
	|          																				  |
	******************************************************************************************/
	public function result()
	{
		if( empty($this->query) ) 
		{
			return false;
		}
		
		$rows = array();
		
		while($data = sqlsrv_fetch_array($this->query))
		{
			$rows[] = (object)$data;
		}
		
		return $rows;
	}
	
	/******************************************************************************************
	* RESULT ARRAY                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için sorgu sonucu kayıtlar bilgisini dizi olarak verir.       | 
	|          																				  |
	******************************************************************************************/
	public function result_array()
	{
		if( empty($this->query) ) 
		{
			return false;
		}
		
		$rows = array();
		
		while($data = sqlsrv_fetch_array($this->query, SQLSRV_FETCH_ASSOC))
		{
			$rows[] = $data;
		}
		
		return $rows;
	}
	
	/******************************************************************************************
	* ROW                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için sorgu sonucu tek bir kayıt bilgisini verir.              | 
	|          																				  |
	******************************************************************************************/
	public function row()
	{
		if( empty($this->query) ) 
		{
			return false;
		}
		
		$data = sqlsrv_fetch_array($this->query, SQLSRV_FETCH_ASSOC);
		
		return (object)$data;
	}
	
	/******************************************************************************************
	* REAL STRING ESCAPE                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için bu kullanım desteklenmediği için. aşağıdaki yöntemden	  |
	| yararlanılmıştır.												 			              | 
	|          																				  |
	******************************************************************************************/
	public function real_escape_string($data = '')
	{
		return str_replace(array("'",'"'), array("\'", '\"'), $data);
	}
	
	/******************************************************************************************
	* ERROR                                                                      			  *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için hata bilgisini verir. 			              			  | 
	|          																				  |
	******************************************************************************************/
	public function error()
	{
		if( ! empty($this->connect) )
		{
			$error = sqlsrv_errors(SQLSRV_ERR_ERRORS);
			return $error['message'];
		}
		else
		{
			return false;
		}
	}
	
	/******************************************************************************************
	* FETCH ARRAY                                                                 			  *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için fetch_array yönteminin kullanımıdır. 		              | 
	|          																				  |
	******************************************************************************************/
	public function fetch_array()
	{
		if( ! empty($this->query) )
		{
			return sqlsrv_fetch_array($this->query, SQLSRV_FETCH_BOTH);
		}
		else
		{
			return false;	
		}
	}
	
	/******************************************************************************************
	* FETCH ASSOC                                                                  			  *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için fetch_array yönteminin kullanımıdır. 		              | 
	|          																				  |
	******************************************************************************************/
	public function fetch_assoc()
	{
		if( ! empty($this->query) )
		{
			return sqlsrv_fetch_array($this->query, SQLSRV_FETCH_ASSOC);
		}
		else
		{
			return false;	
		}
	}
	
	/******************************************************************************************
	* FETCH ROW                                                                  			  *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için fetch_row yönteminin kullanımıdır. 		              | 
	|          																				  |
	******************************************************************************************/
	public function fetch_row()
	{
		if( ! empty($this->query) )
		{
			return sqlsrv_fetch($this->query, SQLSRV_FETCH_ASSOC);
		}
		else
		{
			return 0;	
		}
	}
	
	/******************************************************************************************
	* AFFECTED ROWS                                                                 		  *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için affected_rows yönteminin kullanımıdır. 		          | 
	|          																				  |
	******************************************************************************************/
	public function affected_rows()
	{
		if( ! empty($this->connect) )
		{
			return sqlsrv_rows_affected($this->connect);
		}
		else
		{
			return false;	
		}
	}
	
	/******************************************************************************************
	* CLOSE                                                                         		  *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için close yönteminin kullanımıdır. 		                  | 
	|          																				  |
	******************************************************************************************/
	public function close()
	{
		if( ! empty($this->connect) ) 
		{
			@sqlsrv_close($this->connect); 
		}
		else 
		{
			return false;
		}
	}	
	
	/******************************************************************************************
	* VERSION                                                                         		  *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için version yönteminin kullanımıdır. 		                  | 
	|          																				  |
	******************************************************************************************/
	public function version()
	{
		if( ! empty($this->connect) )
		{
			$info = sqlsrv_server_info($this->connect);
			return $info['SQLServerVersion'];
		}
		else
		{
			return false;
		}
	}
}