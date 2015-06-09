<?php
/************************************************************/
/*                   FBSQL DRIVER LIBRARY                   */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* FBSQL DRIVER		                                                                      *
*******************************************************************************************
| Dahil(Import) Edilirken : Dahil Edilemez.  							                  |
| Sınıfı Kullanırken      :	Kullanılamaz.												  |
| 																						  |
| NOT: Veritabanı kütüphaneler için oluşturulmuş yardımcı sınıftır.                       |
******************************************************************************************/	
class FbsqlDriver
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
		$this->config  = $config;
	    $this->connect = ( $this->config['pconnect'] === true )
						 ? @fbsql_pconnect($this->config['host'], $this->config['user'], $this->config['password'])
						 : @fbsql_connect($this->config['host'], $this->config['user'], $this->config['password']);
		
		if( empty($this->connect) ) 
		{
			die(get_message('Database', 'db_mysql_connect_error'));
		}
		
		fbsql_select_db($this->config['database'], $this->connect);
	}
	
	/******************************************************************************************
	* EXEC                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki exec yönteminin kullanımıdır.  			  |
	|          																				  |
	******************************************************************************************/
	public function exec($query)
	{
		return fbsql_query($this->connect, $query);
	}
	
	/******************************************************************************************
	* QUERY                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki query yönteminin kullanımıdır.  			  |
	|          																				  |
	******************************************************************************************/
	public function query($query, $security = array())
	{
		$this->query = fbsql_query($query, $this->connect);
		return $this->query;
	}
	
	/******************************************************************************************
	* TRANS START                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki autocommit özelliğinin kullanımıdır.  		  |
	|          																				  |
	******************************************************************************************/
	public function trans_start()
	{
		if( fbsql_autocommit($this->connect) )
		{
			fbsql_autocommit($this->connect, false);
		}
		
		return true;	
	}
	
	/******************************************************************************************
	* TRANS ROLLBACK                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki rollback özelliğinin kullanımıdır.  		  |
	|          																				  |
	******************************************************************************************/
	public function trans_rollback()
	{
		fbsql_rollback($this->connect);
		
		if ( ! fbsql_autocommit($this->connect) )
		{
			fbsql_autocommit($this->connect, true);
		}
		
		return true;
	}
	
	/******************************************************************************************
	* TRANS COMMIT                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki autocommits özelliğinin kullanımıdır.        |
	|          																				  |
	******************************************************************************************/
	public function trans_commit()
	{
		fbsql_commit($this->connect);
		
		if ( ! fbsql_autocommit($this->connect) )
		{
			fbsql_autocommit($this->connect, true);
		}
		
		return true;
	}
	
	/******************************************************************************************
	* LIST DATABASES                                                                          *
	*******************************************************************************************
	| Genel Kullanım: DbTool sınıfında kullanımı için oluşturulmuş yöntemdir.                 | 
	|          																				  |
	******************************************************************************************/
	public function list_databases()
	{
		if( ! empty($this->connect) )
		{
			return fbsql_list_dbs($this->connect);
		}
		else
		{
			return false;
		}
	}
	
	/******************************************************************************************
	* LIST TABLES                                                                             *
	*******************************************************************************************
	| Genel Kullanım: DbTool sınıfında kullanımı için oluşturulmuş yöntemdir.                 | 
	|          																				  |
	******************************************************************************************/
	public function list_tables()
	{
		if( ! empty($this->connect) )
		{
			return fbsql_list_tables($this->config['database'], $this->connect);
		}
		else
		{
			return false;
		}
	}
	
	/******************************************************************************************
	* INSERT ID                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Db sınıfında kullanımı için oluşturulmuş yöntemdir.                	  | 
	|          																				  |
	******************************************************************************************/
	public function insert_id()
	{
		if( ! empty($this->connect) )
		{
			return fbsql_insert_id($this->connect);
		}
		else
		{
			return false;
		}
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
		
		for ($i = 0, $c = $this->num_fields(); $i < $c; $i++)
		{
			$columns[$i]				= new stdClass();
			$columns[$i]->name			= fbsql_field_name($this->query, $i);
			$columns[$i]->type			= fbsql_field_type($this->query, $i);
			$columns[$i]->max_length	= fbsql_field_len($this->query, $i);
			$columns[$i]->primary_key	= (int) (strpos(fbsql_field_flags($this->query, $i), 'primary_key') !== false);
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
	| Genel Kullanım: Bu sürücü için rename column yönteminin kullanımıdır.   				  | 
	|          																				  |
	******************************************************************************************/
	public function rename_column()
	{ 
		return 'RENAME COLUMN ';
	}
	
	/******************************************************************************************
	* MODIFY COLUMN                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü bu yöntemi desteklememektedir.                				  | 
	|          																				  |
	******************************************************************************************/
	public function modify_column()
	{ 
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
			return fbsql_num_rows($this->query);
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
			$columns[] = fbsql_field_name($this->query, $i);
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
			return fbsql_num_fields($this->query);
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
		
		while($data = fbsql_fetch_assoc($this->query))
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
		
		while($data = fbsql_fetch_assoc($this->query))
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
		
		$data = fbsql_fetch_assoc($this->query);
		
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
			return fbsql_error($this->connect);
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
			return fbsql_fetch_array($this->query);
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
			return fbsql_fetch_assoc($this->query);
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
			return fbsql_fetch_row($this->query);
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
			return fbsql_affected_rows($this->connect);
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
			@fbsql_close($this->connect); 
		}
		else 
		{
			return false;
		}
	}	
	
	/******************************************************************************************
	* VERSION                                                                         		  *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için bu kullanım desteklenmemektedir. 		                  | 
	|          																				  |
	******************************************************************************************/
	public function version()
	{	
		// Ön tanımlı sorgu kullanıyor.
		if( ! empty($this->connect) ) 
		{
			return false;
		}
	}
}