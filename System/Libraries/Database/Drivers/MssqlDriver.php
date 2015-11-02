<?php
class MssqlDriver
{
	/***********************************************************************************/
	/* MSSQL DRIVER LIBRARY		     			                   	                   */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: MssqlDriver
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: Database kütüphanesi tarafından kullanılmaktadır.
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
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
	
	/* Operators Değişkeni
	 *  
	 * Farklı platformlardaki operator farklılıklar bilgisi
	 * tutmak için oluşturulmuştur.
	 *
	 */
	public $operators = array
	(
		'like' => '%'
	);
	
	protected function cvartype($type = '', $len = '')
	{
	 	if( $len === '' )
		{
			return " $type ";	
		}
		else
		{
			return " $type($len) ";	
		}
	}
	
	protected function ctimetype($type = '', $chars = array('/', '.'), $change = '-')
	{
	 	return str_replace($chars, $change, $type);
	}
	
	public function autoIncrement()
	{
		return ' AUTO INCREMENT ';
	}
	
	public function primaryKey($col = '')
	{
		return $this->cvartype('PRIMARY KEY', $col);
	}
	
	public function foreignKey($col = '')
	{
		return $this->cvartype('FOREIGN KEY', $col);
	}
	
	public function unique($col = '')
	{
		return $this->cvartype('UNIQUE', $col);
	}
	
	public function null($type = true)
	{
		return $type === true ? ' NULL ' : ' NOT NULL ';
	}
	
	public function notNull()
	{
		return ' NOT NULL ';
	}
	
	 // NUMERICAL
	public function int($len = '')
	{
		return $this->cvartype('INT', $len);
	}
	
	public function smallInt($len = '')
	{
		return $this->cvartype('SMALLINT', $len);
	}
	
	public function tinyInt($len = '')
	{
		return $this->cvartype('SMALLINT', $len);
	}
	
	public function mediumInt($len = '')
	{
		return $this->cvartype('INT', $len);
	}
	
	public function bigInt($len = '')
	{
		return $this->cvartype('BIGINT', $len);
	}
	
	public function decimal($len = '')
	{
		return $this->cvartype('DECIMAL', $len);
	}
	
	public function double($len = '')
	{
		return $this->cvartype('FLOAT', $len);
	}
	
	public function float($len = '')
	{
		return $this->cvartype('FLOAT', $len);
	}
	
	// STRING
	public function char($len = '')
	{
		return $this->cvartype('CHAR', $len);
	}
	
	public function varChar($len = '')
	{
		return $this->cvartype('VARCHAR', $len);
	}
	
	// max.255 karakter
	public function tinyText()
	{
		return $this->cvartype('VARCHAR(255)');
	}
	
	// max. 65535 karakter 
	public function text()
	{
		return $this->cvartype('VARCHAR(65535)');
	}
	
	// max. 16777215 karakter 
	public function mediumText()
	{
		return $this->cvartype('VARCHAR(16277215)');
	}
	
	// max. 4294967295 karakter
	public function longText()
	{
		return $this->cvartype('VARCHAR(16277215)');
	}
	
	// DATETIME
	// yyyy-mm-dd
	public function date($len = '')
	{
		return $this->cvartype('DATETIME', $this->ctimetype($len));
	}
	
	// yyyy-mm-dd hh:mm:ss
	public function datetime($len = '')
	{
		return $this->cvartype('DATETIME', $this->ctimetype($len));
	}
	
	// hh:mm:ss
	public function time($len = '')
	{
		return $this->cvartype('TIMESTAMP', $this->ctimetype($len), array('/', '.', '-'), ':');
	}
	
	// yyyymmddhhmmss
	public function timeStamp($len = '')
	{
		return $this->cvartype('TIMESTAMP', $this->ctimetype($len));
	}
	
	// ENUM ENUMERATED listesinin kisaltılmış halidir. () içinde 65535 değer tutabilir
	public function enum()
	{
		return false;
	}
	
	// ENUM ENUMERATED listesinin kisaltılmış halidir. () içinde 65535 değer tutabilir
	public function set()
	{
		return false;
	}
	
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
		
		$this->connect = 	( $this->config['pconnect'] === true )
							? @mssql_pconnect($server, $this->config['user'], $this->config['password'])
							: @mssql_connect($server, $this->config['user'], $this->config['password']);
		
		if( empty($this->connect) ) 
		{
			die(getErrorMessage('Database', 'mysqlConnectError'));
		}
		
		mssql_select_db($this->config['database'], $this->connect);
	}
	
	/******************************************************************************************
	* EXEC                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki exec yönteminin kullanımıdır.  			  |
	|          																				  |
	******************************************************************************************/
	public function exec($query)
	{
		return mssql_query($query, $this->connect);
	}
	
	/******************************************************************************************
	* QUERY                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki query yönteminin kullanımıdır.  			  |
	|          																				  |
	******************************************************************************************/
	public function query($query, $security = array())
	{
		$this->query = mssql_query($query, $this->connect);
		
		return $this->query;
	}
	
	/******************************************************************************************
	* TRANS START                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki begin tran özelliğinin kullanımıdır.  		  |
	|          																				  |
	******************************************************************************************/
	public function transStart()
	{
		return $this->query('BEGIN TRAN');
	}
	
	/******************************************************************************************
	* TRANS ROLLBACK                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki rollback tran özelliğinin kullanımıdır.  	  |
	|          																				  |
	******************************************************************************************/
	public function transRollback()
	{
		return $this->query('ROLLBACK TRAN');
	}
	
	/******************************************************************************************
	* TRANS COMMIT                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki commit tran özelliğinin kullanımıdır.        |
	|          																				  |
	******************************************************************************************/
	public function transCommit()
	{
		return $this->query('COMMIT TRAN');
	}
	
	/******************************************************************************************
	* LIST DATABASES                                                                          *
	*******************************************************************************************
	| Genel Kullanım: DbTool sınıfında kullanımı için oluşturulmuş yöntemdir.                 | 
	|          																				  |
	******************************************************************************************/
	public function listDatabases()
	{
		// Ön tanımlı sorgu kullanıyor.
		return false;
	}
	
	/******************************************************************************************
	* LIST TABLES                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü bu yöntemi desteklememektedir.                				  | 
	|          																				  |
	******************************************************************************************/
	public function listTables()
	{
		// Ön tanımlı sorgu kullanıyor.
		return false;
	}
	
	/******************************************************************************************
	* INSERT ID                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Db sınıfında kullanımı için oluşturulmuş yöntemdir.                	  | 
	|          																				  |
	******************************************************************************************/
	public function insertId()
	{
		if( ! empty($this->connect))
		{
			$query = ( version_compare($this->version(), '8', '>=') )
				     ? 'SELECT SCOPE_IDENTITY() AS last_id'
				     : 'SELECT @@IDENTITY AS last_id';
			
			$this->query($query);
			$row = $this->row();
			
			return $row->last_id;
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
	public function columnData()
	{
		if( empty($this->query) ) 
		{
			return false;
		}
		
		$columns = array();
		
		for ($i = 0, $c = $this->num_fields(); $i < $c; $i++)
		{
			$field = mssql_fetch_field($this->query, $i);
			$columns[$i]				= new stdClass();
			$columns[$i]->name			= $field->name;
			$columns[$i]->type			= $field->type;
			$columns[$i]->maxLength		= $field->max_length;
			$columns[$i]->primaryKey	= false;
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
		return false;
	}
	
	/******************************************************************************************
	* ADD COLUMN                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü bu yöntemi desteklememektedir.                				  | 
	|          																				  |
	******************************************************************************************/
	public function addColumn()
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
	public function dropColumn()
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
	public function renameColumn()
	{ 
		return 'ALTER COLUMN '; 
	}
	
	/******************************************************************************************
	* MODIFY COLUMN                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için alter column yönteminin kullanımıdır.     				  | 
	|          																				  |
	******************************************************************************************/
	public function modifyColumn()
	{ 
		return 'ALTER COLUMN '; 
	}
	
	/******************************************************************************************
	* NUM ROWS                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için toplam kayıt sayısı bilgisini verir.                	  | 
	|          																				  |
	******************************************************************************************/
	public function numRows()
	{
		if( ! empty($this->query) )
		{
			return mssql_num_rows($this->query);
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
		$num_fields = $this->numFields();
		
		for($i=0; $i < $num_fields; $i++)
		{		
			$columns[] = mssql_field_name($this->query, $i);
		}
		
		return $columns;
	}
	
	/******************************************************************************************
	* NUM FIEDLS                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için toplam sütun sayısı bilgisini verir.                	  | 
	|          																				  |
	******************************************************************************************/
	public function numFields()
	{
		if( ! empty($this->query) )
		{
			return mssql_num_fields($this->query);
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
		
		while($data = mssql_fetch_assoc($this->query))
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
	public function resultArray()
	{
		if( empty($this->query) ) 
		{
			return false;
		}
		
		$rows = array();
		
		while($data = mssql_fetch_assoc($this->query))
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
		
		$data = mssql_fetch_assoc($this->query);
		
		return (object)$data;
	}
	
	/******************************************************************************************
	* REAL STRING ESCAPE                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için bu kullanım desteklenmediği için. aşağıdaki yöntemden	  |
	| yararlanılmıştır.												 			              | 
	|          																				  |
	******************************************************************************************/
	public function realEscapeString($data = '')
	{
		return Security::escapeStringEncode($data);
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
			return mssql_get_last_message();
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
	public function fetchArray()
	{
		if( ! empty($this->query) )
		{
			return mssql_fetch_array($this->query);
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
	public function fetchAssoc()
	{
		if( ! empty($this->query) )
		{
			return mssql_fetch_assoc($this->query);
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
	public function fetchRow()
	{
		if( ! empty($this->query) )
		{
			return mssql_fetch_row($this->query);
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
	public function affectedRows()
	{
		if( ! empty($this->connect) )
		{
			return mssql_rows_affected($this->connect);
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
			@mssql_close($this->connect); 
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
			$this->query('SELECT @@VERSION AS ver;');
			
			return $this->row()->ver;
		}
	}	
}