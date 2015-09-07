<?php
class __USE_STATIC_ACCESS__DB
{	
	/***********************************************************************************/
	/* DB LIBRARY						                   	                           */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: DB
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: $this->db, zn::$use->db, uselib('db')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* Select Değişkeni
	 *  
	 * SELECT bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $select;
	
	/* Select Column Değişkeni
	 *  
	 * col1, col2 ... bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $selectColumn;
	
	/* From Değişkeni
	 *  
	 * FROM bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $from;
	
	/* Table Değişkeni
	 *  
	 * TABLE bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $table;
	
	/* Where Değişkeni
	 *  
	 * WHERE bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $where;
	
	/* All Değişkeni
	 *  
	 * ALL bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $all;
	
	/* Distinct Değişkeni
	 *  
	 * DISTINCT bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $distinct;
	
	/* Distinct Row Değişkeni
	 *  
	 * DISTINCTROW bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $distinctRow;
	
	/* High Priority Değişkeni
	 *  
	 * HIGH PRIORITY bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $highPriority;
	
	/* Straight Join Değişkeni
	 *  
	 * STRAIGHT JOIN bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $straightJoin;
	
	/* Small Result Değişkeni
	 *  
	 * SMALL RESULT bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $smallResult;	
	
	/* Big Result Değişkeni
	 *  
	 * BIG RESULT bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */	
	private $bigResult;
	
	/* Buffer Result Değişkeni
	 *  
	 * BUFFER RESULT bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */			
	private $bufferResult;	
	
	/* Cache Değişkeni
	 *  
	 * CACHE bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */	
	private $cache;	
	
	/* No Cache Değişkeni
	 *  
	 * NO CACHE bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */	
	private $noCache;
	
	/* Calc Found Rows Değişkeni
	 *  
	 * CALC FOUND ROWS bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */	
	private $calcFoundRows;	
	
	/* Math Değişkeni
	 *  
	 * Matemetiksel işlem bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $math;
	
	/* Group By Değişkeni
	 *  
	 * GROUP BY bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $groupBy;
	
	/* Having Değişkeni
	 *  
	 * HAVING bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $having;
	
	/* Order By Değişkeni
	 *  
	 * ORDER BY bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $orderBy;
	
	/* Limit Değişkeni
	 *  
	 * LIMIT bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $limit;
	
	/* Secure Değişkeni
	 *  
	 * Güvenlik işlem bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $secure;
	
	/* Join Değişkeni
	 *  
	 * JOIN bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $join;
	
	/* Trans Start Değişkeni
	 *  
	 * Çoklu sorgu işlem bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $transStart;
	
	/* Trans Error Değişkeni
	 *  
	 * Çoklu sorgu işlem hata bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $transError;
	
	/* Prefix Değişkeni
	 *  
	 * Tablo ön eki bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $prefix;
	
	/* Config Değişkeni
	 *  
	 * Tablo ayar bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $config;
	
	/******************************************************************************************
	* CONSTRUCT                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Nesne tanımlaması ve veritabanı ayarları çalıştırılıyor.				  |
	|          																				  |
	******************************************************************************************/
	public function __construct($config = array())
	{
		$this->db = DBCommon::run();
		
		$this->config = Config::get('Database');
		
		$this->prefix = $this->config['prefix'];
		
		if( empty($config) ) 
		{
			$config = $this->config;
		}
		
		$this->db->connect($config);
	}
	
	/******************************************************************************************
	* CALL                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Geçersiz fonksiyon girildiğinde çağrılması için.						  |
	|          																				  |
	******************************************************************************************/
	public function __call($method = '', $param = '')
	{	
		die(getErrorMessage('Error', 'undefinedFunction', "DB::$method()"));	
	}
	
	/******************************************************************************************
	* SELECT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde SELECT kullanımı için oluşturulmuştur.				  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @condition => Sütun bilgileri parametresidir. Varsayılan:*		    	  |
	|          																				  |
	| Örnek Kullanım: ->select('col1, col2 ...')        									  |
	|          																				  |
	******************************************************************************************/
	public function select($condition = '*')
	{
		if( ! is_string($condition) ) 
		{
			$condition = '*';
		}
		
		$this->selectColumn = ' '.$condition.' ';
		$this->select = 'SELECT';
		
		return $this;
	}
	
	/******************************************************************************************
	* FROM                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde FROM kullanımı için oluşturulmuştur.				  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @table => Tablo adı parametresidir.                                       |
	|          																				  |
	| Örnek Kullanım: ->from('OrnekTablo')		        									  |
	|          																				  |
	******************************************************************************************/
	public function from($table = '')
	{
		if( is_string($table) ) 
		{
			$this->from = ' FROM '.$this->prefix.$table.' ';
		}
		else
		{
			Error::set(lang('Error', 'stringParameter', 'table'));	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* TABLE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde Tablo ismi belirtmek için oluşturulmuştur.			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @table => Tablo adı parametresidir.                                       |
	|          																				  |
	| Örnek Kullanım: ->table('OrnekTablo')		        									  |
	|          																				  |
	******************************************************************************************/
	public function table($table = '')
	{
		if( is_string($table) ) 
		{
			$this->table = ' '.$this->prefix.$table.' ';
		}
		else
		{
			Error::set(lang('Error', 'stringParameter', 'table'));	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* WHERE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde WHERE kullanımı için oluşturulmuştur.				  |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @column => Sütun ve operatör parametresidir.                              |
	| 2. string var @value => Karşılaştırılacak sütun değeri.                                 |
	| 3. [ string var @logical ] => Bağlaç bilgisi. AND, OR                                   |
	|          																				  |
	| 3. Parametre çoklu koşul gerektiğinde kullanılır.             						  |
	|          																				  |
	| Örnek Kullanım: ->where('id >', 2, 'and')->where('id <', 20);		        			  |
	| Örnek Kullanım: ->where('isim =', 'zntr', 'or')->where('isim = ', 'zn')		          |
	|          																				  |
	******************************************************************************************/
	public function where($column = '', $value = '', $logical = '')
	{
		// Parametrelerin string kontrolü yapılıyor.
		if( ! is_string($column) || ! isValue($value) || ! is_string($logical) ) 
		{
			Error::set(lang('Error', 'stringParameter', 'column, value, logical'));
		}
		else
		{
			$value = presuffix($this->db->realEscapeString($value), "'");
		
			$this->where .= ' '.$column.' '.$value.' '.$logical.' ';
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* HAVING                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde HAVING kullanımı için oluşturulmuştur.				  |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @column => Sütun ve operatör parametresidir.                              |
	| 2. string var @value => Karşılaştırılacak sütun değeri.                                 |
	| 3. [ string var @logical ] => Bağlaç bilgisi. AND, OR                                   |
	|          																				  |
	| 3. Parametre çoklu kullanım gerektiğinde kullanılır.             						  |
	|          																				  |
	| Örnek Kullanım: ->having('count(*) >', 1)                   		        		      |
	|          																				  |
	******************************************************************************************/
	public function having($column = '', $value = '', $logical = '')
	{
		// Parametrelerin string kontrolü yapılıyor.
		if( ! is_string($column) || ! isValue($value) || ! is_string($logical) ) 
		{
			Error::set(lang('Error', 'stringParameter', 'column, value, logical'));
		}
		else
		{
			$value = presuffix($this->db->realEscapeString($value), "'");

			$this->having .= ' '.$column.' '.$value.' '.$logical.' ';
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* JOIN                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde JOIN kullanımı için oluşturulmuştur.				  |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @table => Birleştirme yapılacak tablo ismi.                               |
	| 2. string var @condition => Karşılaştırılacak sütun değerleri.                          |
	| 3. string var @logical => Birleştirme türü. LEFT, RIGHT, INNER                          |
	|          																				  |
	| Örnek Kullanım: ->join('OrnekTablo', 'DenemeTablo.id = OrnekTablo.id', 'inner')         |
	|          																				  |
	******************************************************************************************/
	public function join($table = '', $condition = '', $type = '')
	{
		// Parametrelerin string kontrolü yapılıyor.
		if( ! is_string($table) || ! is_string($condition) || ! is_string($type) ) 
		{
			Error::set(lang('Error', 'stringParameter', 'table, condition, type'));
		}
		else
		{
			$this->join .= ' '.$type.' JOIN '.$table.' ON '.$condition.' ';
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* GET                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerini tamamlamak için oluşturulmuştur.				      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. [ string var @table ] => Tablo ismi.form() yöntemine alternatif olarak kullanılabilir|
	|          																				  |
	| Örnek Kullanım: ->get('OrnekTablo');        											  |
	|          																				  |
	******************************************************************************************/
	public function get($table = '')
	{
		if( ! is_string($table) ) 
		{
			Error::set(lang('Error', 'stringParameter', 'table'));
			
			return $this;
		}
		
		if( empty($this->select) )
		{ 
			$this->select = 'SELECT'; $this->selectColumn = ' * ';
		}
				
		if( ! empty($table) ) 
		{
			$this->from = ' FROM '.$this->prefix.$table.' ';
		}
		elseif( ! empty($this->table) )
		{
			$this->from = ' FROM '.$this->prefix.$this->table.' ';
		}
		
		// Çoklu WHERE kullanımından dolayı
		// Son ek kontrolü yapılıyor.
		if( ! empty($this->where) )
		{
			 $where = ' WHERE '; 
			
			if( strtolower(substr(trim($this->where), -2)) === 'or' )
			{
				$this->where = substr(trim($this->where), 0, -2);
			}
			
			if( strtolower(substr(trim($this->where), -3)) === 'and' )
			{
				$this->where = substr(trim($this->where), 0, -3);		
			}
		}
		else 
		{
			$where = '';
		}
		
		// Çoklu HAVING kullanımından dolayı
		// Son ek kontrolü yapılıyor.
		if( ! empty($this->having) ) 
		{
			$having = ' HAVING '; 
			
			if( strtolower(substr(trim($this->having), -2)) === 'or' )
			{
				$this->having = substr(trim($this->having), 0, -2);
			}
			
			if( strtolower(substr(trim($this->having), -3)) === 'and' )
			{
				$this->having = substr(trim($this->having), 0, -3);	
			}
		}
		else 
		{
			$having = '';
		}
		
		// Sorgu yöntemlerinden gelen değeler birleştiriliyor.
		$queryBuilder = $this->select.
						 $this->all.
						 $this->distinct.
						 $this->distinctRow.
						 $this->highPriority.
						 $this->straightJoin.
						 $this->smallResult.
						 $this->bigResult.
						 $this->bufferResult.
						 $this->cache.
						 $this->noCache.
						 $this->calcFoundRows.					 
						 $this->selectColumn.
						 $this->math.
						 $this->from.
						 $this->join.
						 $where.$this->where.
						 $this->groupBy.
						 $having.$this->having.
						 $this->orderBy.
						 $this->limit;	
		
		$this->_resetQuery();
		
		$secure = $this->secure;

		$this->db->query($this->_querySecurity($queryBuilder), $secure);
		
		return $this;
	}
	
	/******************************************************************************************
	* QUERY                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Standart veritabanı sorgusu kullanmak için oluşturulmuştur.			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @query  => SQL SORGULARI yazılır.							              |
	|          																				  |
	| Örnek Kullanım: $this->db->query('SELECT * FROM OrnekTablo');        					  |
	|          																				  |
	******************************************************************************************/
	public function query($query = '')
	{
		if( ! is_string($query) || empty($query) ) 
		{
			Error::set(lang('Error', 'stringParameter', 'query'));
			Error::set(lang('Error', 'emptyParameter', 'query'));
		}
		else
		{
			$secure = $this->secure;
	
			$this->db->query($this->_querySecurity($query), $secure);
			
			if( ! empty($this->transStart) ) 
			{
				$transError = $this->db->error();
				if( ! empty($transError) ) 
				{
					$this->transError = $transError; 
				}
			}
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* EXEC QUERY                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Standart veritabanı sorgusu kullanmak için oluşturulmuştur.			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @query  => SQL SORGULARI yazılır.							              |
	|          																				  |
	| Örnek Kullanım: $this->db->execQuery('DROP TABLE OrnekTablo');        			      |
	|          																				  |
	******************************************************************************************/
	public function execQuery($query = '')
	{
		if( ! is_string($query) || empty($query) ) 
		{
			Error::set(lang('Error', 'stringParameter', 'query'));
			Error::set(lang('Error', 'emptyParameter', 'query'));
			
			return false;	
		}
		
		$secure = $this->secure;
		
		return $this->db->exec($this->_querySecurity($query), $secure);
	}
	
	/******************************************************************************************
	* TRANS START                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Çoklu sorgu oluşturmak için sorgu başlangıç yöntemidir.     			  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: $this->db->transStart();        			                              |
	|          																				  |
	******************************************************************************************/
	public function transStart()
	{
		$this->transStart = $this->db->transStart();
	}
	
	/******************************************************************************************
	* TRANS END                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Çoklu sorgu oluşturmak için sorgu bitiş yöntemidir.     			      |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: $this->db->transEnd();        			                              |
	|          																				  |
	******************************************************************************************/
	public function transEnd()
	{
		if( ! empty($this->transError) )
		{
			$this->db->transRollback();
		}
		else
		{
			$this->db->transCommit();
		}
		
		$this->transStart = NULL;	
		$this->transError = NULL;
	}
	
	/******************************************************************************************
	* TOTAL ROWS                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Tablodaki toplam kayıt sayısını verir.     			   		          |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->totalRows();        			                                      |
	|          																				  |
	******************************************************************************************/
	public function totalRows()
	{ 
		return $this->db->numRows(); 
	}
	
	/******************************************************************************************
	* TOTAL COLUMNS                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Tablodaki toplam sütun sayısını verir.     			   		          |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->totalColumns();      			                              		  |
	|          																				  |
	******************************************************************************************/
	public function totalColumns()
	{
		return $this->db->numFields(); 
	}
	
	/******************************************************************************************
	* COLUMNS                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Tablodaki sütun bilgilerini verir.     			   		              |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->columns();      			                                          |
	|          																				  |
	******************************************************************************************/
	public function columns()
	{ 
		return $this->db->columns(); 
	}
	
	/******************************************************************************************
	* RESULT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Sorgu sonucu kayıt bilgilerini verir.     			   		          |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->result();                			                                  |
	|          																				  |
	******************************************************************************************/
	public function result()
	{ 
		return $this->db->result(); 
	}
	
	/******************************************************************************************
	* RESULT ARRAY                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Sorgu sonucu kayıt bilgilerini dizi veri türünde elde edilir.     	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->resultArray();                			                              |
	|          																				  |
	******************************************************************************************/
	public function resultArray()
	{ 
		return $this->db->resultArray(); 
	}
	
	/******************************************************************************************
	* FETCH ARRAY                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Sorgu sonucu verileri dizi türünde verir.     	  					  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->fetchArray();                			                              |
	|          																				  |
	******************************************************************************************/
	public function fetchArray()
	{ 
		return $this->db->fetchArray(); 
	}
	
	/******************************************************************************************
	* FETCH ASSOC                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Sorgu sonucu verileri object veri türünde verir.     	  				  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->fetchAssoc();                			                              |
	|          																				  |
	******************************************************************************************/
	public function fetchAssoc()
	{ 
		return $this->db->fetchAssoc(); 
	}
	
	/******************************************************************************************
	* FETCH ROW                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Sorgu sonucu tek satır veriyi object veri türünde verir.     	  		  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->fetchRow();                			                              |
	|          																				  |
	******************************************************************************************/
	public function fetchRow()
	{ 
		return $this->db->fetchRow(); 
	}
	
	/******************************************************************************************
	* ROW                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Sorgu sonucu tek satır veriyi elde etmek için kullanılır.     	  	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->row();                			                                      |
	|          																				  |
	******************************************************************************************/
	public function row()
	{ 
		return $this->db->row(); 
	}
	
	/******************************************************************************************
	* AFFECTED ROWS                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinden etkilenen satır sayısını verir.		     	  	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->affectedRows();                			                          |
	|          																				  |
	******************************************************************************************/
	public function affectedRows()
	{ 
		return $this->db->affectedRows();
	}
	
	/******************************************************************************************
	* INSERT ID                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde INSERT ID kullanımı içindir.		     	  	      |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->insertId();                			                              |
	|          																				  |
	******************************************************************************************/
	public function insertId()
	{ 
		return $this->db->insertId(); 
	}
	
	/******************************************************************************************
	* COLUMN DATA                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Sorgu sonucunda tabloya ait sütun bilgilerini almak için kullanılır.	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->columnData();                			                              |
	|          																				  |
	******************************************************************************************/
	public function columnData()
	{ 
		return $this->db->columnData(); 
	}
	
	/******************************************************************************************
	* ERROR                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Sorgu sonucunda oluşan hata hakkında bilgi almak için kullanılır.	      |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->error();                     			                              |
	|          																				  |
	******************************************************************************************/
	public function error()
	{ 
		Error::set($this->db->error()); 
		return $this->db->error(); 
	}
	
	/******************************************************************************************
	* CLOSE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı bağlantısını kapatmak için kullanılır.	      			      |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->close();                     			                              |
	|          																				  |
	******************************************************************************************/
	public function close()
	{ 
		return $this->db->close(); 
	}
	
	/******************************************************************************************
	* ALL                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki ALL komutunun kullanımıdır.	      			  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->all();                     			                                  |
	|          																				  |
	******************************************************************************************/
	public function all()
	{ 
		$this->all = ' ALL '; 
		return $this; 
	}
	
	/******************************************************************************************
	* DISTINCT                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki DISTINCT komutunun kullanımıdır.	      		  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->distinct();                     			                          |
	|          																				  |
	******************************************************************************************/
	public function distinct()
	{ 
		$this->distinct = ' DISTINCT '; 
		return $this; 
	}
	
	/******************************************************************************************
	* DISTINCTROW                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki DISTINCTROW komutunun kullanımıdır.	      	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->distinctRow();                     			                          |
	|          																				  |
	******************************************************************************************/
	public function distinctRow()
	{ 
		$this->distinctRow = ' DISTINCTROW '; 
		return $this; 
	}
	
	/******************************************************************************************
	* STRAIGHT JOIN                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki STRAIGHT_JOIN komutunun kullanımıdır.	      	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->straightJoin();                     	                              |
	|          																				  |
	******************************************************************************************/
	public function straightJoin()
	{ 
		$this->straightJoin = ' STRAIGHT_JOIN '; 
		return $this; 
	}	
		
	/******************************************************************************************
	* HIGH PRIORITY                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki HIGH_PRIORITY komutunun kullanımıdır.	      	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->highPriority();                     	                              |
	|          																				  |
	******************************************************************************************/
	public function highPriority()
	{ 
		$this->highPriority = ' HIGH_PRIORITY '; 
		return $this; 
	}
	
	/******************************************************************************************
	* SQL SMALL RESULT                                                                        *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki SQL_SMALL_RESULT komutunun kullanımıdır.	      |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->smallResult();                     	                              |
	|          																				  |
	******************************************************************************************/
	public function smallResult()
	{ 
		$this->smallResult = ' SQL_SMALL_RESULT '; 
		return $this; 
	}
	
	/******************************************************************************************
	* SQL BIG RESULT                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki SQL_BIG_RESULT komutunun kullanımıdır.	      |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->bigResult();                        	                              |
	|          																				  |
	******************************************************************************************/
	public function bigResult()
	{ 
		$this->bigResult = ' SQL_BIG_RESULT '; 
		return $this; 
	}
	
	/******************************************************************************************
	* SQL BUFFER RESULT                                                                       *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki SQL_BUFFER_RESULT komutunun kullanımıdır.	      |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->bufferResult();                        	                          |
	|          																				  |
	******************************************************************************************/
	public function bufferResult()
	{ 
		$this->bufferResult = ' SQL_BUFFER_RESULT '; 
		return $this; 
	}
	
	/******************************************************************************************
	* SQL CACHE                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki SQL_CACHE komutunun kullanımıdır.	      	      |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->cache();                        	                                  |
	|          																				  |
	******************************************************************************************/
	public function cache()
	{ 
		$this->cache = ' SQL_CACHE '; 
		return $this; 
	}
	
	/******************************************************************************************
	* SQL NO CACHE                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki SQL_NO_CACHE komutunun kullanımıdır.	  	      |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->noCache();                        	                                  |
	|          																				  |
	******************************************************************************************/
	public function noCache()
	{ 
		$this->noCache = ' SQL_NO_CACHE '; 
		return $this; 
	}
	
	/******************************************************************************************
	* SQL CALC FOUND ROWS                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki SQL_CALC_FOUND_ROWS komutunun kullanımıdır.	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->calcFoundRows();                        	                          |
	|          																				  |
	******************************************************************************************/
	public function calcFoundRows()
	{ 
		$this->calcFoundRows = ' SQL_CALC_FOUND_ROWS '; 
		return $this; 
	}
	
	/******************************************************************************************
	* MATH                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde matematiksel yöntemlerin kullanılması içindir.		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. array/string var @expression => Matematiksel yöntemlerin yazımı için kullanılır.     |
	|          																				  |
	| Örnek Kullanım: ->math( array('avg' => array('sayi', 'id')) );  // Dizi olarak          |
	| Örnek Kullanım: ->math('AVG(sayi, id)') // Metin olarak                                 |
	|          																				  |
	******************************************************************************************/
	public function math($expresion = array())
	{ 
		if( ! is_array($expresion) ) 
		{
			if( is_string($expression) )
			{
				$this->math = $expresion;
			}
			
			return $this;
		}
		
		$exp  = ''; 
		$vals = '';
		
		if( ! empty($expresion) ) foreach( $expresion as $mf => $val )
		{
			$exp .= $mf.'(';
			
			if( ! empty($val) && is_array($val) ) foreach( $val as $v )
			{
				if( ! is_numeric($v) ) 
				{
					$v = "'".$v."'";
				}
				
				$vals .= $v.',';
			}
			
			$vals = substr($vals, 0, -1);
			$exp .= $vals.'),';
		}
		
		$math = substr($exp, 0, -1);
		
		$this->math = $math; 
		
		return $this; 
	}
	
	/******************************************************************************************
	* GROUP BY                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde GROUP BY kullanımıdır.			                	  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @condition => Kümelemeyi oluşturacak veri parametresi.                    |
	|          																				  |
	| Örnek Kullanım: ->groupBy('id')  // GROUP BY id								          |
	|          																				  |
	******************************************************************************************/
	public function groupBy($condition = '')
	{ 
		if( ! is_string($condition) ) 
		{
			Error::set(lang('Error', 'stringParameter', 'condition')); 
		}
		else
		{
			$this->groupBy = ' GROUP BY '.$condition.' ' ;
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* ORDER BY                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde ORDER BY kullanımıdır.			                	  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @condition => Kümelemeyi oluşturacak veri parametresi.                    |
	| 1. string var @type => Sıralama türü.                    								  |
	|          																				  |
	| Örnek Kullanım: ->orderBy('id', 'desc')  // ORDER BY id DESC							  |
	|          																				  |
	******************************************************************************************/
	public function orderBy($condition = '', $type = '')
	{ 
		if( ! is_string($condition) || ! is_string($type) ) 
		{
			Error::set(lang('Error', 'stringParameter', 'condition, type')); 
		}
		else
		{
			$this->orderBy = ' ORDER BY '.$condition.' '.$type.' ';  
		}
		
		return $this; 
	}
	
	/******************************************************************************************
	* LIMIT                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde LIMIT kullanımıdır.			                	  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @start => Limitlemeye kaçıncı kayıttan başlanacak.                        |
	| 1. string var @limit => Kaç kayıt limitlenecek.                    					  |
	|          																				  |
	| Örnek Kullanım: ->limit(0, 5)  // LIMIT 0, 5											  |
	|          																				  |
	******************************************************************************************/
	public function limit($start = '', $limit = '')
	{ 
		if( ! is_numeric($start) || ! is_numeric($limit) ) 
		{
			Error::set(lang('Error', 'numericParameter', 'start, limit')); 
		}
		else
		{
			if( ! empty($limit) ) 
			{
				$comma = ' , '; 
			}
			else 
			{
				$comma = '';
			}
			
			$this->limit = ' LIMIT '.$start.$comma.$limit.' ';
		}
		
		return $this; 
	}
	
	/******************************************************************************************
	* STATUS                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Tablo hakkında bilgi almak için kullanılır.					  		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @table => Verilerin alınacağı tablo ismi.                                 |
	|          																				  |
	| Örnek Kullanım: $this->db->status('OrnekTablo');  									  |
	|          																				  |
	******************************************************************************************/
	public function status($table = '')
	{
		if( ! empty($this->table) ) 
		{
			$table = $this->table; 
			$this->table = NULL;
		}

		if( ! is_string($table) || empty($table) ) 
		{
			Error::set(lang('Error', 'stringParameter', 'table'));
			Error::set(lang('Error', 'emptyParameter', 'table'));
		}
		else
		{
			$table = "'".$this->prefix.trim($table)."'";
	
			$query = "SHOW TABLE STATUS FROM ".$this->config['database']." LIKE $table";
			
			$secure = $this->secure;
			
			$this->db->query($this->_querySecurity($query), $secure);
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* SECURE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde veri güvenliğini sağlaması için oluşturulmuştur.	  |
	|															                              |
	| Parametreler: Tek dizi parametresi vardır.                                              |
	| 1. array var @data => Güvenlik işlemine dahil edilecek veriler.                         |
	|          																				  |
	| Örnek Kullanım: ->secure(array(':x' => '1', ':y' => 2))				  				  |
	|          																				  |
	******************************************************************************************/
	public function secure($data = array())
	{
		if( ! is_array($data) ) 
		{
			Error::set(lang('Error', 'arrayParameter', 'data'));
		}
		else
		{
			$this->secure = $data;
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* PROTECTED INCREMENT VE DECREMENT                                                        *
	******************************************************************************************/
	protected function _incdec($table = '', $columns = array(), $incdec = 0, $type = '')
	{
		if( ! empty($this->table) ) 
		{
			// Table yöntemi tanımlanmış ise
			// 1. parametre, 2. parametre olarak kullanılsın
			$columns = $type === 'increment'	
					 ? abs($columns)
					 : -abs($columns);
			
			$incdec  = $columns;
			$columns = $table;
			$table   = $this->table; 
			$this->table = NULL;
		}
		
		if( ! is_string($table) || empty($columns) || ! is_numeric($incdec) )
		{
			Error::set(lang('Error', 'stringParameter', 'table'));
			Error::set(lang('Error', 'emptyParameter', 'columns'));
			Error::set(lang('Error', 'numericParameter', 'incdec'));
			
			return false;
		}
		
		$incdec = $type === 'increment'	
				 ? abs($incdec)
				 : -abs($incdec);
		
		if( is_array($columns) ) foreach( $columns as $v )
		{
			$newColumns[$v] = "$v + $incdec";	
		}
		else
		{
			$newColumns = array($columns => "$columns + $incdec");	
		}

		if( ! empty($this->where) ) 
		{
			$where = ' WHERE '; 
		}
		else 
		{
			$where = '';
		}
		
		$data = '';
		
		foreach( $newColumns as $key => $value )
		{
			$data .= $key.'='.$value.',';
		}
		
		$set = ' SET '.substr($data,0,-1);
		
		$updateQuery = 'UPDATE '.$this->prefix.$table.$set.$where.$this->where;
		
		$this->where = NULL;
		
		return $this->db->query($updateQuery);
	}
	
	/******************************************************************************************
	* INCREMENT                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen sütunların değerini 1 artırır.	  							  |
	|															                              |
	| Parametreler: 2 dizi parametresi vardır.                                                |
	| 1. string var @table => Tablo Adı.					 			                      |
	| 2. string/array var @columns => Bir bir artırılacak sütun veya sütunlar.                |
	| 3. numeric var @increment => Artış miktarı.               							  |
	|          																				  |
	| Örnek Kullanım: ->increment('OrnekTablo', 'Hit')				  				          |
	|          																				  |
	******************************************************************************************/
	public function increment($table = '', $columns = array(), $increment = 1)
	{
		return $this->_incdec($table, $columns, $increment, 'increment');
	}
	
	/******************************************************************************************
	* DECREMENT                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen sütunların değerini istenilen miktarda azaltır.	  		  |
	|															                              |
	| Parametreler: 2 dizi parametresi vardır.                                                |
	| 1. string var @table => Tablo Adı.					 			                      |
	| 2. string/array var @columns => Bir bir azaltılacak sütun veya sütunlar.                |
	| 3. numeric var @decrement => Azalış miktarı.               							  |
	|          																				  |
	| Örnek Kullanım: ->decrement('OrnekTablo', 'Hit')				  				          |
	|          																				  |
	******************************************************************************************/
	public function decrement($table = '', $columns = array(), $decrement = 1)
	{
		return $this->_incdec($table, $columns, $decrement, 'decrement');
	}
	
	/******************************************************************************************
	* INSERT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde veri eklemek için INSERT işlemini gerçekleştirir.	  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @table => Verilerin ekleneceği tablo ismi.                                |
	| 2. array var @datas => Tabloya eklenecek veri dizisi.                                   |
	|          																				  |
	| Örnek Kullanım: $this->db->insert('OrnekTablo', array('id' => '1', 'name' => 'zntr'));  |
	|          																				  |
	******************************************************************************************/
	public function insert($table = '', $datas = array())
	{
		if( ! empty($this->table) ) 
		{
			// Table yöntemi tanımlanmış ise
			// 1. parametre, 2. parametre olarak kullanılsın
			$datas = $table;
			$table = $this->table; 
			$this->table = NULL;
		}
		
		if( ! is_string($table) || empty($table) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'table'));
		}
		
		if( ! is_array($datas) || empty($datas) ) 
		{
			return Error::set(lang('Error', 'arrayParameter', 'datas'));
		}
		
		$data = ""; $values = "";
		
		foreach($datas as $key => $value)
		{
			$data .= $key.",";
			
			if( $value !== '?' )
			{
				$values .= "'".$value."'".",";
			}
			else
			{
				$values .= $value.",";
			}
		}
			
		$insertQuery = 'INSERT INTO '.$this->prefix.$table.' ('.substr($data,0,-1).') VALUES ('.substr($values,0,-1).')';
		
		$secure = $this->secure;
		
		return $this->db->query($this->_querySecurity($insertQuery), $secure);
	}
	
	/******************************************************************************************
	* UPDATE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde veri güncellemek için UPDATE işlemini gerçekleştirir.|
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @table => Verilerin güncelleneceği tablo ismi.                            |
	| 2. array var @datas => Güncellenecek veri dizisi.                                       |
	|          																				  |
	| Örnek Kullanım: $this->db->update('OrnekTablo', array('id' => '1', 'name' => 'zntr'));  |
	|          																				  |
	******************************************************************************************/
	public function update($table = '', $set = array())
	{
		if( ! empty($this->table) ) 
		{
			// Table yöntemi tanımlanmış ise
			// 1. parametre, 2. parametre olarak kullanılsın
			$set   = $table;
			$table = $this->table; 
			$this->table = NULL;
		}
		
		if( ! is_string($table) || empty($table) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'table'));
		}
		
		if( ! is_array($set) || empty($set) ) 
		{
			return Error::set(lang('Error', 'arrayParameter', 'set'));
		}
		
		if( ! empty($this->where) ) 
		{
			$where = ' WHERE '; 
		}
		else 
		{
			$where = '';
		}
		
		$data = '';
		
		foreach( $set as $key => $value )
		{
			$data .= $key.'='."'".$value."'".',';
		}
		
		$set = ' SET '.substr($data,0,-1);
		
		$updateQuery = 'UPDATE '.$this->prefix.$table.$set.$where.$this->where;
	
		$this->where = NULL;
		$secure = $this->secure;
		
		return $this->db->query($this->_querySecurity($updateQuery), $secure);	
	}
	
	/******************************************************************************************
	* DELETE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde veri güncellemek için DELETE işlemini gerçekleştirir.|
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @table => Verilerin silineceği tablo ismi.       	                      |
	|          																				  |
	| Örnek Kullanım: $this->db->delete('OrnekTablo');  									  |
	|          																				  |
	******************************************************************************************/
	public function delete($table = '')
	{
		if( ! empty($this->table) ) 
		{
			$table = $this->table; 
			$this->table = NULL;
		}
		
		if( ! is_string($table) || empty($table) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'table'));
		}
		
		if( ! empty($this->where) ) 
		{
			$where = ' WHERE '; 
		}
		else 
		{
			$where = '';
		}
		
		$deleteQuery = 'DELETE FROM '.$this->prefix.$table.$where.$this->where;
		
		$this->where = NULL;
			
		$secure = $this->secure;
		
		return $this->db->query($this->_querySecurity($deleteQuery), $secure);
	}
	
	/******************************************************************************************
	* VERSION                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücüsünün sürüm bilgisini verir.							  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: $this->db->version();  									 			  |
	|          																				  |
	******************************************************************************************/
	public function version()
	{
		return $this->db->version();	
	}
	
	/******************************************************************************************
	* DIFFERENT CONNECTION                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Birden fazla ve birden farklı veritabanı bağlantısı yapmak içindir.	  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @connect_name => Bağlantı veri dizisi ismi.       	                      |
	|          																				  |
	| >>>>>>>>>>>>>>>>>>>>>>>>>>>Detaylı kullanım için zntr.net<<<<<<<<<<<<<<<<<<<<<<<<<<  	  |
	|          																				  |
	******************************************************************************************/
	public function differentConnection($connectName = '')
	{
		if( ! is_string($connectName) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'connectName'));
		}
		
		$config = $this->config;
		$configDifferent = $config['differentConnection'];
		
		if( ! isset($configDifferent[$connectName]) ) 
		{
			return Error::set(lang('Error', 'emptyParameter', 'connectName'));
		}
		
		foreach($config as $key => $val)
		{
			if( $key !== 'differentConnection' )
			{
				if( ! isset($configDifferent[$connectName][$key]) )
				{
					$configDifferent[$connectName][$key] = $val;
				}
			}
		}
		
		return new self($configDifferent[$connectName]);
	}
	
	/******************************************************************************************
	// PRIVATE QUERY SECURITY																  *
	// Sorgu güvenliği için oluşturulmuş 													  *
	// Sınıf içi güvenlik yeöntemi.                                                           *
	******************************************************************************************/	
	private function _querySecurity($query = '')
	{	
		if( isset($this->secure) ) 
		{
			$secure = $this->secure;
			
			$secureParams = array();
			
			if( is_numeric(key($secure)) )
			{	
				$strex  = explode('?', $query);	
				$newstr = '';
				
				if( ! empty($strex) ) for($i = 0; $i < count($strex); $i++)
				{
					$sec = isset($secure[$i])
					     ? $secure[$i]
					     : NULL;
							  
					$newstr .= $strex[$i].$this->db->realEscapeString($sec);
				}

				$query = $newstr;
			}
			else
			{
				foreach($this->secure as $k => $v)
				{
					$secureParams[$k] = $this->db->realEscapeString($v);
				}
			}
			
			$query = str_replace(array_keys($secureParams), array_values($secureParams), $query);
		}
		
		$this->secure = NULL;

		return $query;
	}
	
	/******************************************************************************************
	* DEĞİŞKENLERİ SIFIRLA                                                                    *
	******************************************************************************************/
	private function _resetQuery()
	{
		$this->all = NULL;
		$this->distinct = NULL;
		$this->distinctRow = NULL;
		$this->highPriority = NULL;
		$this->straightJoin = NULL;
		$this->smallResult = NULL;
		$this->bigResult = NULL;
		$this->bufferResult = NULL;
		$this->cache = NULL;
		$this->noCache = NULL;
		$this->calcFoundRows = NULL;
		$this->select = NULL;
		$this->selectColumn = NULL;
		$this->math = NULL;
		$this->from = NULL;
		$this->table = NULL;
		$this->where = NULL;
		$this->groupBy = NULL;
		$this->having = NULL;
		$this->orderBy = NULL;
		$this->limit = NULL;
		$this->join = NULL;
		$this->config = array();
	}
	
	/******************************************************************************************
	* DESTRUCT                                                                                *
	******************************************************************************************/
	public function __destruct()
	{
		@$this->db->close();	
	}
}