<?php
class __USE_STATIC_ACCESS__DB implements DBInterface, DatabaseInterface
{	
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	/* Select Değişkeni
	 *  
	 * SELECT bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $select = '*';
	
	/* From Değişkeni
	 *  
	 * FROM bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $from;
	
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
	
	/* Max Statement Time Değişkeni
	 *  
	 * MAX_STATEMENT_TIME bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $maxStatementTime;
	
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
	
	/* Low Priority Değişkeni
	 *  
	 * LOW PRIORITY bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $lowPriority;
	
	/* Delayed Değişkeni
	 *  
	 * DELAYED bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $delayed;
	
	/* Procedure Değişkeni
	 *  
	 * PROCEDURE bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $procedure;
	
	/* Into Out File Değişkeni
	 *  
	 * INTO OUTFILE bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $outFile;
	
	/* Into Dump File Değişkeni
	 *  
	 * INTO DUMPFILE bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $dumpFile;
	
	/* Characted Set File Değişkeni
	 *  
	 * CHARACTER SET bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $characterSet;
	
	/* Into Değişkeni
	 *  
	 * INTO bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $into;
	
	/* For Update Değişkeni
	 *  
	 * FOR UPDATE bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $forUpdate;
	
	/* Lock In Share Mode Değişkeni
	 *  
	 * LOCK IN SHARE MODE bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $lockInShareMode;
	
	/* Quick Değişkeni
	 *  
	 * QUICK bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $quick;
	
	/* Ignore Değişkeni
	 *  
	 * IGNORE bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $ignore;
	
	/* Partition Değişkeni
	 *  
	 * PARTITION bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $partition;
	
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
	
	/* Pagination Değişkeni
	 *  
	 * Sayfalama ayar bilgilerini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $pagination = array('start' => 0, 'limit' => 0);
	
	/* Unlimited Query Değişkeni
	 *  
	 * Limit değerine rağmen toplam kayıt sayısını
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $unlimitedQuery;
	
	//----------------------------------------------------------------------------------------------------
	// Common
	//----------------------------------------------------------------------------------------------------
	// 
	// $config
	// $prefix
	// $secure
	// $table
	// $tableName
	// $stringQuery
	// $unlimitedStringQuery
	//
	// run()
	// table()
	// stringQuery()
	// differentConnection()
	// secure()
	// error()
	// close()
	// version()
	//
	//----------------------------------------------------------------------------------------------------
	use DatabaseTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Select Deyimleri Başlangıç
	//----------------------------------------------------------------------------------------------------
	
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
		
		$args = func_get_args();
		
		if( count($args) > 1 )
		{
			$condition = rtrim(implode(',', $args), ',');
		}
		
		$this->select = ' '.$condition.' ';
		
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
			$this->from      = ' '.$this->prefix.$table.' ';
			$this->tableName = $this->prefix.$table;
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
		if( ! is_string($column) || ! is_scalar($value) || ! is_string($logical) ) 
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
		if( ! is_string($column) || ! is_scalar($value) || ! is_string($logical) ) 
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
	public function limit($start = 0, $limit = 0)
	{ 
		if( $start === NULL )
		{
			$start = URI::segment(-1);
		}
		
		if( ! empty($limit) ) 
		{
			$comma = ' , '; 
		}
		else 
		{
			$comma = '';
		}
		
		$this->pagination['start'] = (int)$start;
		$this->pagination['limit'] = (int)$limit;
		$this->limit = ' LIMIT '.(int)$start.$comma.(int)$limit.' ';
	
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
				
		if( ! empty($table) ) 
		{
			$this->tableName = $this->prefix.$table;
			$this->table     = ' '.$this->tableName.' ';			
			
		}
		elseif( ! empty($this->from) )
		{
			$this->table = $this->from;
		}
		
		if( ! empty($this->selectFunctions) )
		{
			$this->select = rtrim(implode(',', $this->selectFunctions), ',');	
		}
		
		// Sorgu yöntemlerinden gelen değeler birleştiriliyor.		
		$paginationQueryBuilder = 'SELECT '.
								  $this->all.
								  $this->distinct.
								  $this->distinctRow.
							 	  $this->highPriority.
								  $this->maxStatementTime.
								  $this->straightJoin.
								  $this->smallResult.
								  $this->bigResult.
								  $this->bufferResult.
								  $this->cache.
								  $this->noCache.
								  $this->calcFoundRows.					 
								  $this->select.
								  ' FROM '.
								  $this->table.
								  $this->join.
								  $this->_where().
								  $this->groupBy.
								  $this->_having().
								  $this->orderBy;
		
		$extras = $this->procedure.
		          $this->outFile.
				  $this->characterSet.
				  $this->dumpFile.
				  $this->into.
				  $this->forUpdate.
				  $this->lockInShareMode;
			
		// Limitsiz Sorgu
		$queryBuilder = $paginationQueryBuilder.$this->limit.$extras;
		
		// Limitsiz sorgu 
		$this->unlimitedQuery = $paginationQueryBuilder.$extras;
		
		// Sorguyu Temizle
		$this->_resetSelectQuery();
		
		// Sorgu
		$this->db->query($this->_querySecurity($queryBuilder), $this->secure);
		
		// Sorguyu Dizesini Döndür.
		return $this;
	}
	
	/******************************************************************************************
	* WHERE                                                                                   *
	******************************************************************************************/
	protected function _where()
	{
		if( ! empty($this->where) )
		{
			if( strtolower(substr(trim($this->where), -2)) === 'or' )
			{
				$this->where = substr(trim($this->where), 0, -2);
			}
			
			if( strtolower(substr(trim($this->where), -3)) === 'and' )
			{
				$this->where = substr(trim($this->where), 0, -3);		
			}
				
			$return = ' WHERE '.$this->where; 
			
			$this->where = NULL;
			
			return $return;
		}	
	}
	
	/******************************************************************************************
	* HAVING                                                                                  *
	******************************************************************************************/
	protected function _having()
	{
		if( ! empty($this->having) ) 
		{
			if( strtolower(substr(trim($this->having), -2)) === 'or' )
			{
				$this->having = substr(trim($this->having), 0, -2);
			}
			
			if( strtolower(substr(trim($this->having), -3)) === 'and' )
			{
				$this->having = substr(trim($this->having), 0, -3);	
			}
			
			$return = ' HAVING '.$this->having;
			
			$this->having = NULL;
			
			return $return;
		}
	}
	
	/******************************************************************************************
	* SELECT                                                                                  *
	******************************************************************************************/
	protected function _resetSelectQuery()
	{
		$this->all 			   = NULL;
		$this->distinct 	   = NULL;
		$this->distinctRow 	   = NULL;
		$this->highPriority    = NULL;
		$this->straightJoin    = NULL;
		$this->smallResult 	   = NULL;
		$this->bigResult 	   = NULL;
		$this->bufferResult    = NULL;
		$this->cache 		   = NULL;
		$this->noCache 		   = NULL;
		$this->calcFoundRows   = NULL;
		$this->select 		   = NULL;
		$this->from 		   = NULL;
		$this->table 	 	   = NULL;
		$this->where 		   = NULL;
		$this->groupBy 		   = NULL;
		$this->having 		   = NULL;
		$this->orderBy 		   = NULL;
		$this->limit 		   = NULL;
		$this->join 		   = NULL;
		$this->selectFunctions = NULL;
		$this->table 		   = NULL;
		$this->procedure	   = NULL;
		$this->outFile         = NULL;
		$this->dumpFile		   = NULL;
		$this->characterSet	   = NULL;
		$this->into			   = NULL;
		$this->forUpdate	   = NULL;
		$this->lockInShareMode = NULL;
		$this->maxStatementTime= NULL;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Select Deyimleri Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Select Fonksiyonları Başlangıç
	//----------------------------------------------------------------------------------------------------
	
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
	* MAX_STATEMENT_TIME                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki DISTINCT komutunun kullanımıdır.	      		  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->distinct();                     			                          |
	|          																				  |
	******************************************************************************************/
	public function maxStatementTime($time = '')
	{ 
		$this->maxStatementTime = ' MAX_STATEMENT_TIME '.$time.' '; 
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
	* LOW PRIORITY                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki LOW_PRIORITY komutunun kullanımıdır.	      	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->highPriority();                     	                              |
	|          																				  |
	******************************************************************************************/
	public function lowPriority()
	{ 
		$this->lowPriority = ' LOW_PRIORITY '; 
		return $this; 
	}
	
	/******************************************************************************************
	* QUICK                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki QUICK komutunun kullanımıdır.	      	          |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->highPriority();                     	                              |
	|          																				  |
	******************************************************************************************/
	public function quick()
	{ 
		$this->quick = ' QUICK '; 
		return $this; 
	}
	
	/******************************************************************************************
	* DELAYED                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki DELAYED komutunun kullanımıdır.	         	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->highPriority();                     	                              |
	|          																				  |
	******************************************************************************************/
	public function delayed()
	{ 
		$this->delayed = ' DELAYED '; 
		return $this; 
	}
	
	/******************************************************************************************
	* IGNORE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki LOW_PRIORITY komutunun kullanımıdır.	      	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->highPriority();                     	                              |
	|          																				  |
	******************************************************************************************/
	public function ignore()
	{ 
		$this->ignore = ' IGNORE '; 
		return $this; 
	}
	
	/******************************************************************************************
	* PARTITION                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki LOW_PRIORITY komutunun kullanımıdır.	      	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	******************************************************************************************/
	public function partition()
	{ 
		$this->partition = $this->_math(__FUNCTION__, func_get_args())->args;
		return $this; 
	}
	
	/******************************************************************************************
	* PROCEDURE                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki PROCEDURE komutunun kullanımıdır.	         	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	******************************************************************************************/
	public function procedure()
	{ 
		$this->procedure = $this->_math(__FUNCTION__, func_get_args())->args;
		return $this; 
	}
	
	/******************************************************************************************
	* INTO OUTFILE                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki INTO OUTFILE komutunun kullanımıdır.	         	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	******************************************************************************************/
	public function outFile($file = '')
	{ 
		$this->outFile = 'INTO OUTFILE '."'".$file."'".' ';
		return $this; 
	}
	
	/******************************************************************************************
	* INTO DUMPFILE                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki INTO OUTFILE komutunun kullanımıdır.	         	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	******************************************************************************************/
	public function dumpFile($file = '')
	{ 
		$this->dumpFile = 'INTO DUMPFILE '."'".$file."'".' ';
		return $this; 
	}
	
	/******************************************************************************************
	* CHARACTER SET                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki CHARACTER SET komutunun kullanımıdır.	         	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	******************************************************************************************/
	public function characterSet($set = '')
	{ 
		$this->characterSet = 'CHARACTER SET '.$set.' ';
		return $this; 
	}
	
	/******************************************************************************************
	* INTO                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki CHARACTER SET komutunun kullanımıdır.	         	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	******************************************************************************************/
	public function into($varname1 = '', $varname2 = '')
	{ 
		$this->into = 'INTO '.$varname1.' ';
		
		if( ! empty($varname2) ) 
		{
			$this->into .= ', '.$varname2.' ';  
		}
		return $this; 
	}
	
	/******************************************************************************************
	* FOR UPDATE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki FOR UPDATE komutunun kullanımıdır.	         	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	******************************************************************************************/
	public function forUpdate()
	{ 
		$this->forUpdate = ' FOR UPDATE '; 
		return $this;
	}
	
	/******************************************************************************************
	* LOCK IN SHARE MODE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki LOCK IN SHARE MODE komutunun kullanımıdır.	         	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	******************************************************************************************/
	public function lockInShareMode()
	{ 
		$this->lockInShareMode = ' LOCK IN SHARE MODE '; 
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
	
	//----------------------------------------------------------------------------------------------------
	// Select Fonksiyonları Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Simple Query Başlangıç
	//----------------------------------------------------------------------------------------------------
	
	/******************************************************************************************
	* QUERY                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Standart veritabanı sorgusu kullanmak için oluşturulmuştur.			  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @query  => SQL SORGULARI yazılır.							              |
	| 2. string var @secure  => Sorgu güvenliği içindir.						              |
	|          																				  |
	| Örnek Kullanım: $this->db->query('SELECT * FROM OrnekTablo');        					  |
	|          																				  |
	******************************************************************************************/
	public function query($query = '', $secure = array())
	{
		if( ! is_string($query) || empty($query) ) 
		{
			Error::set(lang('Error', 'stringParameter', 'query'));
			Error::set(lang('Error', 'emptyParameter', 'query'));
		}
		else
		{
			if( isset($this->secure) )
			{
				$secure = $this->secure;
			}
			
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
	| 2. string var @secure  => Sorgu güvenliği içindir.						              |
	|          																				  |
	| Örnek Kullanım: $this->db->execQuery('DROP TABLE OrnekTablo');        			      |
	|          																				  |
	******************************************************************************************/
	public function execQuery($query = '', $secure = array())
	{
		if( ! is_string($query) || empty($query) ) 
		{
			Error::set(lang('Error', 'stringParameter', 'query'));
			Error::set(lang('Error', 'emptyParameter', 'query'));
			
			return false;	
		}
		
		if( isset($this->secure) )
		{
			$secure = $this->secure;	
		}
		
		return $this->db->exec($this->_querySecurity($query), $secure);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Simple Query Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Transaction Query Başlangıç
	//----------------------------------------------------------------------------------------------------
	
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
	
	//----------------------------------------------------------------------------------------------------
	// Transaction Query Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Other Methods Başlangıç
	//----------------------------------------------------------------------------------------------------
	
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
	
	//----------------------------------------------------------------------------------------------------
	// Other Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Insert Method Başlangıç
	//----------------------------------------------------------------------------------------------------

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
		}
		else
		{
			$table = $this->prefix.$table;	
		}
		
		if( ! empty($this->column) )
		{
			$datas = $this->column;
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
		
		foreach( $datas as $key => $value )
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
			
		$insertQuery = 'INSERT '.
					    $this->lowPriority.
						$this->delayed.
						$this->highPriority.
						$this->ignore.
					    ' INTO '.
		                $table.
						$this->partition.
		               ' ('.substr($data, 0, -1).') VALUES ('.substr($values, 0, -1).')';

		$this->_resetInsertQuery();
		
		return $this->db->query($this->_querySecurity($insertQuery), $this->secure);
	}
	
	/******************************************************************************************
	* INSERT                                                                                  *
	******************************************************************************************/
	protected function _resetInsertQuery()
	{
		$this->column 		   = NULL;
		$this->table 		   = NULL;
		$this->highPriority    = NULL;
		$this->lowPriority     = NULL;
		$this->partition       = NULL;
		$this->ignore     	   = NULL;
		$this->delayed		   = NULL;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Insert Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Update Method Başlangıç
	//----------------------------------------------------------------------------------------------------

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
		}
		else
		{
			$table = $this->prefix.$table;	
		}
		
		if( ! empty($this->column) )
		{
			$set = $this->column;
		}
		
		if( ! is_string($table) || empty($table) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'table'));
		}
		
		if( ! is_array($set) || empty($set) ) 
		{
			return Error::set(lang('Error', 'arrayParameter', 'set'));
		}

		$data = '';
		
		foreach( $set as $key => $value )
		{
			$data .= $key.'='."'".$value."'".',';
		}
		
		$set = ' SET '.substr($data,0,-1);
	
		$updateQuery = 'UPDATE '.
					    $this->lowPriority.
					    $this->ignore.
		                $table.
						$set.
						$this->_where().
						$this->orderBy.
						$this->limit;
		
		$this->_resetUpdateQuery();
		
		return $this->db->query($this->_querySecurity($updateQuery), $this->secure);	
	}
	
	/******************************************************************************************
	* UPDATE                                                                                  *
	******************************************************************************************/
	protected function _resetUpdateQuery()
	{
		$this->where 		   = NULL;
		$this->lowPriority     = NULL;
		$this->ignore     	   = NULL;
		$this->orderBy 		   = NULL;
		$this->limit 		   = NULL;
		$this->table 		   = NULL;
		$this->column 		   = NULL;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Update Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Delete Method Başlangıç
	//----------------------------------------------------------------------------------------------------
	
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
		if( ! empty($table) ) 
		{
			$this->table = $this->prefix.$table; 
		}
		
		if( ! is_string($this->table) || empty($this->table) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'table'));
		}
		
		$deleteQuery = 'DELETE '.
		               $this->lowPriority.
					   $this->quick.
					   $this->ignore.
					   ' FROM '.
					   $this->table.
					   $this->partition.
					   $this->_where().
					   $this->orderBy.
					   $this->limit;
	
		$this->_resetDeleteQuery();
		
		return $this->db->query($this->_querySecurity($deleteQuery), $this->secure);
	}
	
	/******************************************************************************************
	* DELETE                                                                                  *
	******************************************************************************************/
	protected function _resetDeleteQuery()
	{
		$this->where 		   = NULL;
		$this->lowPriority     = NULL;
		$this->quick     	   = NULL;
		$this->ignore     	   = NULL;
		$this->partition       = NULL;
		$this->orderBy 		   = NULL;
		$this->limit 		   = NULL;
		$this->table 		   = NULL;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Delete Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Result Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

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
	public function totalRows($total = false)
	{ 
		if( $total === false )
		{
			return $this->db->numRows(); 
		}
		else
		{	
			$query = $this->query($this->_querySecurity($this->unlimitedQuery), $this->secure)->totalRows();
			
			$this->unlimitedQuery = NULL;
			
			return $query;
		}
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
	public function result( $type = 'object' )
	{ 
		if( $type === 'object' )
		{
			return $this->db->result();
		}
		else
		{
			return $this->db->resultArray();
		}
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
	* FETCH                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Sorgu sonucu verileri object veri türünde verir.     	  				  |
		
	  @var string $type: assoc, array veya row
	|          																				  |
	******************************************************************************************/
	public function fetch($type = 'assoc')
	{ 
		if( $type === 'assoc' )
		{
			return $this->db->fetchAssoc(); 
		}
		elseif( $type === 'array')
		{
			return $this->db->fetchArray(); 
		}
		else
		{
			return $this->db->fetchRow();
		}
	}
	
	/******************************************************************************************
	* FETCH ROW                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Sorgu sonucu tek satır veriyi object veri türünde verir.     	  		  |
		
	  @param bool $printable: false
	  @return object/string
	|          																				  |
	******************************************************************************************/
	public function fetchRow($printable = false)
	{ 
		$row = $this->db->fetchRow();
		
		if( $printable === false )
		{
			return $row ; 
		}
		else
		{
			return current($row);	
		}
	}
	
	/******************************************************************************************
	* ROW                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Sorgu sonucu tek satır veriyi elde etmek için kullanılır.     	  	  |

	  @param bool $printable: false
	  @return object/string
	|          																				  |
	******************************************************************************************/
	public function row($printable = false)
	{ 
		if( is_numeric($printable) )
		{
			$result = $this->db->resultArray(); 
			
			if( $printable < 0 )
			{
				return isset( $result[count($result) + $printable] )
					   ? $result[count($result) + $printable]
					   : false;
			}
			else
			{
				return isset( $result[$printable] )
				       ? $result[$printable]
					   : false;
			}
		}
		elseif( $printable === true )
		{
			return current((array)$this->db->row());	
		}
		else
		{
			return $this->db->row();	
		}
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
	* TABLE NAME                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Sorguda kullanılan tablonun bilgisini verir.				     	  	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->tableName();                			                              |
	|          																				  |
	******************************************************************************************/
	public function tableName()
	{ 
		return $this->tableName; 
	}
	
	/******************************************************************************************
	* PAGINATION                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgularına göre sayfalama verilerini oluşturur.	          |
	  
	  @param  array $settings
	  @param  bool $output
	  @return array veya object
	|          																				  |
	******************************************************************************************/
	public function pagination($settings = array(), $output = true)
	{ 
		if( ! is_array($settings) )
		{
			Error::set(lang('Error', 'arrayParameter', '1.(settings)'));	
		} 
	
		$limit = $this->pagination['limit'];
		$start = $this->pagination['start'];
		
		$settings['totalRows'] = $this->totalRows(true);
		$settings['limit']     = isset($limit) ? $limit : 10;
		$settings['start']     = isset($start) ? $start : NULL;
		
		$return = $output === true
		        ? Pagination::create(NULL, $settings) 
				: $settings;
		
		$this->pagination = array('start' => 0, 'limit' => 0);
		
		return $return;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Result Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Control Flow Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* SWITCH CASE                                                                             *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function switchCase($switch = '', $conditions = array(), $return = false)
	{
		$case = ' CASE '.$switch;
		
		if( is_array($conditions) ) foreach( $conditions as $key => $val )
		{
			if( strtolower($key) === 'default' || strtolower($key) === 'else' )
			{
				$key = ' ELSE ';
			}
			else
			{
				$key = ' WHEN '.$key.' THEN ';
			}
			
			$case .= $key.$val;
		}
		
		$case .= ' END; ';
		
		if( $return === true )
		{
			return $case;
		}
		else
		{
			$this->selectFunctions[] = $case;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* IF ELSE                                                                                 *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function ifElse()
	{
		$math = $this->_math('IF', func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* IF NULL                                                                                 *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function ifNull()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* NULL IF                                                                                 *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function nullIf()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Control Flow Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Variable Types Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* VAR TYPE                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Değişken türünü ve uzunluğunu belirtmek için kullanılır.				  |
	
	  @var numeric $len
	  
	  @return INT
	|          																				  |
	******************************************************************************************/
	public function vartype($type = '', $len = '', $output = true)
	{
		return $this->db->variableTypes($type, $len, $output);
	}
	
	/******************************************************************************************
	* PROPERTY                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Sütunlara ait özel ifadelerin kullanımında evrensellik sağlar.		  |
	
	  @var string $col
	  
	  @return UNIQUE
	|          																				  |
	******************************************************************************************/
	public function property($type = '', $col = '', $output = true)
	{
		if( is_array($type) )
		{
			$state = '';
			
			foreach( $type as $key => $val )
			{
				if( ! is_numeric($key) )
				{
					$state .= $this->db->statements($key, $val);
				}
				else
				{
					$state .= $this->db->statements($val);
				}
			}
			
			return $state;
		}
		else
		{
			return $this->db->statements($type, $col, $output);
		}
	}
	
	/******************************************************************************************
	* INT                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: SQL INT kullanımının karşılığıdır.									  |
	
	  @var numeric $len
	  
	  @return INT
	|          																				  |
	******************************************************************************************/
	public function int($len = '', $type = true)
	{
		return $this->db->variableTypes(__FUNCTION__, $len, $type);
	}
	
	/******************************************************************************************
	* INTEGER                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: SQL INT kullanımının karşılığıdır.									  |
	
	  @var numeric $len
	  
	  @return INT
	|          																				  |
	******************************************************************************************/
	public function integer($len = '', $type = true)
	{
		return $this->db->variableTypes('int', $len, $type);
	}
	
	/******************************************************************************************
	* SMALLINT                                                                                *
	*******************************************************************************************
	| Genel Kullanım: SQL SMALLINT kullanımının karşılığıdır.								  |
	
	  @var numeric $len
	  
	  @return SMALLINT
	|          																				  |
	******************************************************************************************/
	public function smallInt($len = '', $type = true)
	{
		return $this->db->variableTypes(__FUNCTION__, $len, $type);
	}
	
	/******************************************************************************************
	* TINYINT                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: SQL TINYINT kullanımının karşılığıdır.								  |
	
	  @var numeric $len
	  
	  @return TINYINT
	|          																				  |
	******************************************************************************************/
	public function tinyInt($len = '', $type = true)
	{
		return $this->db->variableTypes(__FUNCTION__, $len, $type);
	}
	
	/******************************************************************************************
	* MEDIUMINT                                                                               *
	*******************************************************************************************
	| Genel Kullanım: SQL MEDIUMINT kullanımının karşılığıdır.								  |
	
	  @var numeric $len
	  
	  @return MEDIUMINT
	|          																				  |
	******************************************************************************************/
	public function mediumInt($len = '', $type = true)
	{
		return $this->db->variableTypes(__FUNCTION__, $len, $type);
	}
	
	/******************************************************************************************
	* BIGINT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: SQL BIGINT kullanımının karşılığıdır.	     							  |
	
	  @var numeric $len
	  
	  @return BIGINT
	|          																				  |
	******************************************************************************************/
	public function bigInt($len = '', $type = true)
	{
		return $this->db->variableTypes(__FUNCTION__, $len, $type);
	}
	
	/******************************************************************************************
	* DECIMAL                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: SQL DECIMAL kullanımının karşılığıdır.	  							  |
	
	  @var numeric $len
	  
	  @return DECIMAL
	|          																				  |
	******************************************************************************************/
	public function decimal($len = '', $type = true)
	{
		return $this->db->variableTypes(__FUNCTION__, $len, $type);
	}
	
	/******************************************************************************************
	* DOUBLE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: SQL DOUBLE kullanımının karşılığıdır.	  	     						  |
	
	  @var numeric $len
	  
	  @return DOUBLE
	|          																				  |
	******************************************************************************************/
	public function double($len = '', $type = true)
	{
		return $this->db->variableTypes(__FUNCTION__, $len, $type);
	}
	
	/******************************************************************************************
	* FLOAT                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: SQL FLOAT kullanımının karşılığıdır.	  	     						  |
	
	  @var numeric $len
	  
	  @return FLOAT
	|          																				  |
	******************************************************************************************/
	public function float($len = '', $type = true)
	{
		return $this->db->variableTypes(__FUNCTION__, $len, $type);
	}
	
	/******************************************************************************************
	* CHAR                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: SQL CHAR kullanımının karşılığıdır.	  	     						  |
	
	  @var numeric $len
	  
	  @return CHAR
	|          																				  |
	******************************************************************************************/
	public function char($len = '', $type = true)
	{
		return $this->db->variableTypes(__FUNCTION__, $len, $type);
	}
	
	/******************************************************************************************
	* VARCHAR                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: SQL VARCHAR kullanımının karşılığıdır. 	     						  |
	
	  @var numeric $len
	  
	  @return VARCHAR
	|          																				  |
	******************************************************************************************/
	public function varChar($len = '', $type = true)
	{
		return $this->db->variableTypes(__FUNCTION__, $len, $type);
	}
	
	/******************************************************************************************
	* TINYTEXT                                                                                *
	*******************************************************************************************
	| Genel Kullanım: SQL TINYTEXT kullanımının karşılığıdır. 	     						  |
	
	  @return TINYTEXT
	|          																				  |
	******************************************************************************************/
	public function tinyText()
	{
		return $this->db->variableTypes(__FUNCTION__);
	}
	
	/******************************************************************************************
	* TEXT                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: SQL TEXT kullanımının karşılığıdır. 	         						  |
	
	  @return TEXT
	|          																				  |
	******************************************************************************************/
	public function text()
	{
		return $this->db->variableTypes(__FUNCTION__);
	}
	
	/******************************************************************************************
	* MEDIUMTEXT                                                                              *
	*******************************************************************************************
	| Genel Kullanım: SQL MEDIUMTEXT kullanımının karşılığıdır. 	   						  |
	
	  @return MEDIUMTEXT
	|          																				  |
	******************************************************************************************/
	public function mediumText()
	{
		return $this->db->variableTypes(__FUNCTION__);
	}
	
	/******************************************************************************************
	* LONGTEXT                                                                                *
	*******************************************************************************************
	| Genel Kullanım: SQL LONGTEXT kullanımının karşılığıdır. 	     						  |
	
	  @return LONGTEXT
	|          																				  |
	******************************************************************************************/
	public function longText()
	{
		return $this->db->variableTypes(__FUNCTION__);
	}
	
	/******************************************************************************************
	* DATE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: SQL DATE kullanımının karşılığıdır. 	         						  |
	
	  @var numeric $len
	  
	  @return DATE
	|          																				  |
	******************************************************************************************/
	public function date($len = '', $type = true)
	{
		return $this->db->variableTypes(__FUNCTION__, $len, $type);
	}
	
	/******************************************************************************************
	* DATETIME                                                                                *
	*******************************************************************************************
	| Genel Kullanım: SQL DATETIME kullanımının karşılığıdır. 	       						  |
	
	  @var numeric $len
	  
	  @return DATETIME
	|          																				  |
	******************************************************************************************/
	public function dateTime($len = '', $type = true)
	{
		return $this->db->variableTypes(__FUNCTION__, $len, $type);
	}
	
	/******************************************************************************************
	* TIME                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: SQL TIME kullanımının karşılığıdır.    	       						  |
	
	  @var numeric $len
	  
	  @return TIME
	|          																				  |
	******************************************************************************************/
	public function time($len = '', $type = true)
	{
		return $this->db->variableTypes(__FUNCTION__, $len, $type);
	}
	
	/******************************************************************************************
	* TIMESTAMP                                                                               *
	*******************************************************************************************
	| Genel Kullanım: SQL TIMESTAMP kullanımının karşılığıdır.    	  						  |
	
	  @var numeric $len
	  
	  @return TIMESTAMP
	|          																				  |
	******************************************************************************************/
	public function timeStamp($len = '', $type = true)
	{
		return $this->db->variableTypes(__FUNCTION__, $len, $type);
	}
	
	/******************************************************************************************
	* AUTO INCREMENT                                                                          *
	*******************************************************************************************
	| Genel Kullanım: SQL AUTO_INCREMENT  kullanımının karşılığıdır.        	  			  |
	  
	  @return AUTO_INCREMENT
	|          																				  |
	******************************************************************************************/
	public function autoIncrement($col = '', $type = true)
	{
		return $this->db->statements(__FUNCTION__, $col, $type);
	}
	
	/******************************************************************************************
	* PRIMARY KEY                                                                             *
	*******************************************************************************************
	| Genel Kullanım: SQL PRIMARY KEY kullanımının karşılığıdır.   	  						  |
	
	  @var string $col
	  
	  @return PRIMARY KEY
	|          																				  |
	******************************************************************************************/
	public function primaryKey($col = '', $type = true)
	{
		return $this->db->statements(__FUNCTION__, $col, $type);
	}
	
	/******************************************************************************************
	* FOREIGN KEY                                                                             *
	*******************************************************************************************
	| Genel Kullanım: SQL FOREIGN KEY kullanımının karşılığıdır.   	  						  |
	
	  @var string $col
	  
	  @return FOREIGN KEY
	|          																				  |
	******************************************************************************************/
	public function foreignKey($col = '', $type = true)
	{
		return $this->db->statements(__FUNCTION__, $col, $type);
	}
	
	/******************************************************************************************
	* UNIQUE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: SQL UNIQUE kullanımının karşılığıdır.      	  						  |
	
	  @var string $col
	  
	  @return UNIQUE
	|          																				  |
	******************************************************************************************/
	public function unique($col = '', $type = true)
	{
		return $this->db->statements(__FUNCTION__, $col, $type);
	}
	
	/******************************************************************************************
	* NULL                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: SQL NULL kullanımının karşılığıdır.       	  						  |
	
	  @return NULL / NOT NULL
	|          																				  |
	******************************************************************************************/
	public function null()
	{
		return $this->db->statements(__FUNCTION__);
	}
	
	/******************************************************************************************
	* NOT NULL                                                                                *
	*******************************************************************************************
	| Genel Kullanım: SQL NOT NULL kullanımının karşılığıdır.     	  						  |
	
	  @return NOT NULL
	|          																				  |
	******************************************************************************************/
	public function notNull()
	{
		return $this->db->statements(__FUNCTION__);
	}
	
	/******************************************************************************************
	* CONSTRAINT                                                                                *
	*******************************************************************************************
	| Genel Kullanım: CONSTRAINT kullanımının karşılığıdır.     	  						  |
	
	  @return NOT NULL
	|          																				  |
	******************************************************************************************/
	public function constraint($constraint = '', $type = false)
	{
		return $this->db->statements(__FUNCTION__, $constraint, $type);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Variable Types Methods Başlangıç
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Math Functions Başlangıç
	//----------------------------------------------------------------------------------------------------
	
	/******************************************************************************************
	* ABS                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Sayının mutlak değerini alarak pozitif değerini verir.			 	  |
	
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function abs()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
	
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* MOD                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Sayının mutlak değerini alarak pozitif değerini verir.			 	  |
	
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function mod()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* ACOS                                                                                    *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function acos()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* ASIN                                                                                    *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function asin()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* ATAN                                                                                    *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function atan()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* ATAN2                                                                                   *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function atan2()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* CEIL                                                                                   *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function ceil()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* CEILING                                                                                 *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function ceiling()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* COS                                                                                     *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function cos()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* COT                                                                                     *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function cot()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* CRC32                                                                                   *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function crc32()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* DEGREES                                                                                 *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function degrees()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* EXP                                                                                     *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function exp()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* FLOOR                                                                                   *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function floor()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* LN                                                                                      *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function ln()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* LOG10                                                                                   *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function log10()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* LOG2                                                                                   *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function log2()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* LOG                                                                                     *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function log()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* PI                                                                                     *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function pi()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* POW                                                                                     *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function pow()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* POWER                                                                                     *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function power()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* RADIANS                                                                                     *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function radians()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* RAND                                                                                     *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function rand()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* RAUND                                                                                     *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function raund()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* SIGN                                                                                     *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function sign()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* SIN                                                                                     *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function sin()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* SQRT                                                                                    *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function sqrt()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* TAN                                                                                    *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function tan()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Math Functions Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Other Single Functions Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* LIKE                                                                                    *
	*******************************************************************************************
	| 																						  |
		@param string $value
		@param string $type: starting, inside, ending
	|          																				  |
	******************************************************************************************/
	public function like($value = '', $type = 'starting')
	{
		// Parametrelerin string kontrolü yapılıyor.
		if( ! is_scalar($value) || ! is_string($type) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'value, type'));
		}
		
		$operator = $this->db->operator(__FUNCTION__);
		
		if( $type === "inside" ) 
		{
			$value = $operator.$value.$operator;
		}
		
		// İle Başlayan
		if( $type === "starting" ) 
		{
			$value = $value.$operator;
		}
		
		// İle Biten
		if( $type === "ending" ) 
		{
			$value = $operator.$value;
		}
		
		return $value;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Other Single Functions Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// String Functions Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* ASCII                                                                                   *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function ascii()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* CHAR_LENGTH                                                                             *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function charLength()
	{
		$math = $this->_math('CHAR_LENGTH', func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}

	/******************************************************************************************
	* FIELD                                                                                   *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function field()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* FORMAT                                                                                  *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function format()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* LOWER                                                                                   *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function lower()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* UPPER                                                                                   *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function upper()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* LENGTH                                                                                  *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function length()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}

	/******************************************************************************************
	* LTRIM                                                                                   *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function ltrim()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* SUBSTRING                                                                               *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function substring()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* ORD                                                                                     *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function ord()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* POSITION                                                                                *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function position()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* QUOTE                                                                                   *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function quote()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* REPEAT                                                                                   *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function repeat()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* RTRIM                                                                                   *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function rtrim()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* SOUNDEX                                                                                 *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function soundex()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* SPACE                                                                                 *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function space()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* SUBSTR                                                                                 *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function substr()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* SUBSTRING_INDEX                                                                         *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function substringIndex()
	{
		$math = $this->_math('SUBSTRING_INDEX', func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* TRIM                                                                                    *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function trim()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* UCASE                                                                                   *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function ucase()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* LCASE                                                                                   *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function lcase()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// String Functions Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Information Functions Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* BENCHMARK                                                                               *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function benchmark()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* CHARSET                                                                                 *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function charset()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* COERCIBILITY                                                                            *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function coercibility()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* USER                                                                                    *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function user()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* COLLATION                                                                               *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function collation()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* CONNECTION ID                                                                           *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function connectionId()
	{
		$math = $this->_math('CONNECTION_ID', func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* CURRENT USER                                                                            *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function currentUser()
	{
		$math = $this->_math('CURRENT_USER', func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* DATABASE                                                                                *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function database()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* SCHEMA                                                                                *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function schema()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* LAST_INSERT_ID                                                                          *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function lastInsertId()
	{
		$math = $this->_math('LAST_INSERT_ID', func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* SYSTEM_USER                                                                               *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function sytemUser()
	{
		$math = $this->_math('SYSTEM_USER', func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* SESSION_USER                                                                               *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function sessionUser()
	{
		$math = $this->_math('SESSION_USER', func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* ROW_COUNT                                                                               *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function rowCount()
	{
		$math = $this->_math('ROW_COUNT', func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* VERSION                                                                                 *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function versionInfo()
	{
		$math = $this->_math('VERSION', func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Information Functions Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Aggregate Functions Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* AVG                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Tabloya ait kolonların ortamalasını alır.				 				  |
	
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function avg()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
	
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* MIN                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Tabloya ait kolonlardan değeri minimum olanı alır.				 	  |
	
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function min()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* MAX                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Tabloya ait kolonlardan değeri maksimum olanı alır.				 	  |
	
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function max()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* COUNT                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Tabloya ait satır sayısını verir.									 	  |
	
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function count()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* SUM                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Tabloya ait kolonların toplamını alır.				 				  |
	
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function sum()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* VARIANCE                                                                                   *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function variance()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Aggregate Functions Bitiş
	//----------------------------------------------------------------------------------------------------
}