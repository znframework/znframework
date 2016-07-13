<?php
namespace ZN\Database;

class InternalDB implements DBInterface, DatabaseInterface
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
	private $select;
	
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
	private $pagination = ['start' => 0, 'limit' => 0];
	
	/* Unlimited Query Değişkeni
	 *  
	 * Limit değerine rağmen toplam kayıt sayısını
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $unlimitedQuery;
	
	/* Duplicate Check Değişkeni
	 *  
	 * Ekleme yapılacak verilerin kontrolünü
	 * yapmak için oluşturulmuştur.
	 *
	 */
	private $duplicateCheck;
	
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
	// Variable Types
	//----------------------------------------------------------------------------------------------------
	// 
	// int()
	// varchar()
	// ...
	//
	//----------------------------------------------------------------------------------------------------
	use DB\Traits\VariableTypesTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Statements
	//----------------------------------------------------------------------------------------------------
	// 
	// autoIncrement()
	// notNull()
	// ...
	//
	//----------------------------------------------------------------------------------------------------
	use DB\Traits\StatementsTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Functions
	//----------------------------------------------------------------------------------------------------
	// 
	// abs()
	// mod()
	// ...
	//
	//----------------------------------------------------------------------------------------------------
	use DB\Traits\FunctionsTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Triggers
	//----------------------------------------------------------------------------------------------------
	// 
	// createTrigger()
	// order()
	// event()
	// when()
	// body()
	//
	//----------------------------------------------------------------------------------------------------
	use DB\Traits\TriggerTrait;
	
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
	public function select(...$condition)
	{
		if( empty($condition[0]) )
		{
			$condition[0] = '*';
		}
		
		$condition = rtrim(implode(',', $condition), ',');
		
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
			\Errors::set('Error', 'stringParameter', 'table');	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* Protedted Where Having                                                                  *
	******************************************************************************************/
	protected function _whereHaving($column, $value, $logical)
	{
		if( ! is_string($column) || ! is_scalar($value) || ! is_string($logical) ) 
		{
			\Errors::set('Error', 'stringParameter', 'column, value, logical');
		}
		else
		{
			if( $value !== '' )
			{
				$value = presuffix($this->db->realEscapeString($value), "'");
			}
			
			if( preg_match('/^\w+$/', trim($column)) )
			{
				$column .= ' = ';	
			}
			
			return ' '.$column.' '.$value.' '.$logical.' ';
		}
		
		return '';
	}
	
	/******************************************************************************************
	* Protedted Where Having                                                                  *
	******************************************************************************************/
	public function _wh($column = '', $value = '', $logical = '', $type = 'where')
	{
		if( isArray($column) )
		{
			$columns = func_get_args();
			
			if( isset($columns[0][0]) && is_array($columns[0][0]) )
			{
				$columns = $columns[0];	
			}
			
			foreach( $columns as $col )
			{
				if( is_array($col) )
				{
					$c = isset($col[0]) ? $col[0] : '';
					$v = isset($col[1]) ? $col[1] : '';
					$l = isset($col[2]) ? $col[2] : '';
				
					$this->$type .= $this->_whereHaving($c, $v, $l);	
				}
			}
		}
		else
		{
			$this->$type .= $this->_whereHaving($column, $value, $logical);
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
		$this->_wh($column, $value, $logical, __FUNCTION__);
		
		return $this;
	}
	
	/******************************************************************************************
	* WHERE GROUP                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde WHERE kullanımı için oluşturulmuştur.				  |
	|															                              |
	| Parametreler: Tek array parametresi vardır.                                             |
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
	protected function _whereHavingGroup($conditions = [])
	{
		$con = [];
		
		if( isset($conditions[0][0]) && is_array($conditions[0][0]) )
		{
			$con         = \Arrays::getLast($conditions);
			$conditions  = $conditions[0];	
		}
		
		$getLast = \Arrays::getLast($conditions);
			
		if( is_string($con) )
		{
			$conjunction = $con;	
		}
		else
		{
			if( is_string($getLast) )
			{
				$conjunction = $getLast;
				$conditions  = \Arrays::removeLast($conditions);
			}
			else
			{
				$conjunction = '';	
			}
		}
				
		$whereGroup = '';
		
		if( is_array($conditions) ) foreach( $conditions as $column )
		{
			$col     = isset( $column[0] ) ? $column[0] : '';
			$value   = isset( $column[1] ) ? $column[1] : '';
			$logical = isset( $column[2] ) ? $column[2] : '';
			
			$whereGroup .= $this->_whereHaving($col, $value, $logical);
		}
		
		return ' ( '.$this->_whereHavingConjuctionClean($whereGroup).' ) '.$conjunction.' ';
	}
	
	/******************************************************************************************
	* WHERE  GROUP                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde WHERE kullanımı için oluşturulmuştur.				  |
	|															                              |
	| Parametreler: Tek array parametresi vardır.                                             |
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
	public function whereGroup(...$args)
	{
		$this->where .= $this->_whereHavingGroup($args);
		
		return $this;
	}
	
	/******************************************************************************************
	* WHERE  GROUP                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde WHERE kullanımı için oluşturulmuştur.				  |
	|															                              |
	| Parametreler: Tek array parametresi vardır.                                             |
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
	public function havingGroup(...$args)
	{
		$this->having .= $this->_whereHavingGroup($args);
		
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
		$this->_wh($column, $value, $logical, __FUNCTION__);
		
		return $this;
	}
	
	/******************************************************************************************
	* PROTECTED                                                                               *
	******************************************************************************************/
	protected function _whereHavingConjuctionControl($type)
	{
		if( ! empty($this->$type) )
		{
			$trim  = trim($this->$type);
			$lower = strtolower($trim);
			
			switch( substr($lower, -3) )
			{
				case 'and' :
				case 'xor' :
				case 'not' :
				$this->$type = substr($trim, 0, -3);		
			}
			
			switch( substr($lower, -2) )
			{
				case 'or' :
				case '||' :
				case '&&' :
				$this->$type = substr($trim, 0, -2);
			}
			
			switch( substr($lower, -1) )
			{
				case '!' :
				$this->$type = substr($trim, 0, -1);
			}		
				
			$return = ' '.strtoupper($type).' '.$this->$type; 
			
			$this->$type = NULL;
			
			return $return;
		}	
	}
	
	/******************************************************************************************
	* PROTECTED                                                                               *
	******************************************************************************************/
	protected function _whereHavingConjuctionClean($str)
	{
		if( ! empty($str) )
		{
			$str = strtolower(trim($str));
			
			switch( substr($str, -3) )
			{
				case 'and' :
				case 'xor' :
				case 'not' :
				return substr($str, 0, -3);		
			}
			
			switch( substr($str, -2) )
			{
				case 'or' :
				case '||' :
				case '&&' :
				return substr($str, 0, -2);
			}
			
			switch( substr($str, -1) )
			{
				case '!' :
				return substr($str, 0, -1);
			}		
		}	
		
		return $str;
	}
	
	/******************************************************************************************
	* WHERE                                                                                   *
	******************************************************************************************/
	protected function _where()
	{
		return $this->_whereHavingConjuctionControl('where');
	}
	
	/******************************************************************************************
	* HAVING                                                                                  *
	******************************************************************************************/
	protected function _having()
	{
		return $this->_whereHavingConjuctionControl('having');
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
			\Errors::set('Error', 'stringParameter', 'table, condition, type');
		}
		else
		{
			$table = $this->prefix.$table;
			$type  = strtoupper($type);
			
			$this->join .= ' '.$type.' JOIN '.$table.' ON '.$condition.' ';
		}
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Join
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $table
	// @param string $column
	// @param string $otherColumn
	// @param string $operator
	// @param string $type
	//
	//----------------------------------------------------------------------------------------------------
	protected function _join($tableAndColumn = '', $otherColumn = '', $operator = '=', $type = 'INNER')
	{
		$tableAndColumn = explode('.', $tableAndColumn);
		
		$table     = isset($tableAndColumn[0]) ? $this->prefix.$tableAndColumn[0] : '';
		$column    = isset($tableAndColumn[1]) ? $this->prefix.$tableAndColumn[1] : '';	
		$condition = $table.'.'.$column.' '.$operator.' '.$this->prefix.$otherColumn.' ';
		
		if( empty($table) )
		{
			\Errors::set('Error', 'emptyVariable', 'table');	
		}
		
		if( empty($column) )
		{
			\Errors::set('Error', 'emptyVariable', 'column');	
		}
		
		$this->join($table, $condition, $type);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Inner Join
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $table
	// @param string $column
	// @param string $otherColumn
	//
	//----------------------------------------------------------------------------------------------------
	public function innerJoin($table = '', $otherColumn = '', $operator = '=')
	{
		$this->_join($table, $otherColumn, $operator, 'INNER');
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Outer Join
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $table
	// @param string $column
	// @param string $otherColumn
	//
	//----------------------------------------------------------------------------------------------------
	public function outerJoin($table = '', $otherColumn = '', $operator = '=')
	{
		$this->_join($table, $otherColumn, $operator, 'OUTER');
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Left Join
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $table
	// @param string $column
	// @param string $otherColumn
	//
	//----------------------------------------------------------------------------------------------------
	public function leftJoin($table = '', $otherColumn = '', $operator = '=')
	{
		$this->_join($table, $otherColumn, $operator, 'LEFT');
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Right Join
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $table
	// @param string $column
	// @param string $otherColumn
	//
	//----------------------------------------------------------------------------------------------------
	public function rightJoin($table = '', $otherColumn = '', $operator = '=')
	{
		$this->_join($table, $otherColumn, $operator, 'RIGHT');
		
		return $this;
	}
	
	/******************************************************************************************
	* GROUP BY                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde GROUP BY kullanımıdır.			                	  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. args var @condition => Kümelemeyi oluşturacak veri parametresi.                      |
	|          																				  |
	| Örnek Kullanım: ->groupBy('id')  // GROUP BY id								          |
	|          																				  |
	******************************************************************************************/
	public function groupBy(...$args)
	{ 
		$this->groupBy .= implode(',', $args).', ';	
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Group By
	//----------------------------------------------------------------------------------------------------
	//
	// @param  void
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	protected function _groupBy()
	{
		if( ! empty($this->groupBy) )
		{
			return ' GROUP BY '.rtrim($this->groupBy, ', ');	
		}
		
		return false;
	}
	
	/******************************************************************************************
	* ORDER BY                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde ORDER BY kullanımıdır.			                	  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. mixed  var @condition => Kümelemeyi oluşturacak veri parametresi.                    |
	| 1. string var @type => Sıralama türü.                    								  |
	|          																				  |
	| Örnek Kullanım: ->orderBy('id', 'desc')  // ORDER BY id DESC							  |
	|          																				  |
	******************************************************************************************/
	public function orderBy($condition = '', $type = '')
	{ 
		if( is_string($condition) ) 
		{
			$this->orderBy .= $condition.' '.$type.', ';  
		}
		else
		{
			if( ! empty($condition) ) foreach( $condition as $key => $val )
			{
				$this->orderBy .= $key.' '.$val.', ';	
			}	
		}
		
		return $this; 
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Order By
	//----------------------------------------------------------------------------------------------------
	//
	// @param  void
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	protected function _orderBy()
	{
		if( ! empty($this->orderBy) )
		{
			return ' ORDER BY '.rtrim($this->orderBy, ', ');	
		}
		
		return false;
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
			$start = \URI::segment(-1);
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
		
		$this->limit = ' LIMIT '.(int)$start.( ! empty($limit) ? $comma.(int)$limit.' ' : '' );
	
		return $this; 
	}
	
	//----------------------------------------------------------------------------------------------------
	// Get
	//----------------------------------------------------------------------------------------------------
	//
	// Sorguyu tamamlamak için kullanılır.
	//
	// @param  string $table  -> Tablo adı.
	// @return string $return -> Sorgunun dönüş türü. object, string
	//
	//----------------------------------------------------------------------------------------------------
	public function get($table = '', $return = 'object')
	{
		if( ! is_string($table) ) 
		{
			\Errors::set('Error', 'stringParameter', 'table');
			
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
			$selectFunctions = rtrim(implode(',', $this->selectFunctions), ',');
			
			if( empty($this->select) )
			{
				$this->select = $selectFunctions;
			}
			else
			{
				$this->select .= ','.$selectFunctions;
			}
		}
		
		if( empty($this->select) )
		{
			$this->select = ' * ';	
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
								  $this->_groupBy().
								  $this->_having().
								  $this->_orderBy();
		
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
		
		$secureQueryBuilder = $this->_querySecurity($queryBuilder);
		
		if( $return === 'string' )
		{
			return $secureQueryBuilder;	
		}
		
		// Sorgu
		$this->db->query($secureQueryBuilder, $this->secure);
		
		// Sorguyu Dizesini Döndür.
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Duplicate Check
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $table
	// @param string $column
	// @param string $otherColumn
	//
	//----------------------------------------------------------------------------------------------------
	public function duplicateCheck(...$args)
	{
		$this->duplicateCheck = $args;
		
		if( empty($this->duplicateCheck) )
		{
			$this->duplicateCheck[0] = '*';
		}
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Escape String
	//----------------------------------------------------------------------------------------------------
	//
	// Tırnak işaretlerinin başına \ işareti ekler.
	//
	// @param  string $data
	// @return string 
	//
	//----------------------------------------------------------------------------------------------------
	public function escapeString($data = '')
	{
		return $this->db->realEscapeString($data);	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Real Escape String
	//----------------------------------------------------------------------------------------------------
	//
	// Tırnak işaretlerinin başına \ işareti ekler.
	//
	// @param  string $data
	// @return string 
	//
	//----------------------------------------------------------------------------------------------------
	public function realEscapeString($data = '')
	{
		return $this->db->realEscapeString($data);	
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
	// Get String
	//----------------------------------------------------------------------------------------------------
	//
	// Sorguyunun çalıştırılmadan metinsel çıktısını almak için kullanılır.
	//
	// @param  string $table -> Tablo adı.
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function getString($table = '')
	{
		return $this->get($table, 'string');	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Alias
	//----------------------------------------------------------------------------------------------------
	//
	// Veriye takma ad vermek için kullanılır.
	//
	// @param  string $string   -> Metin.
	// @param  string $alias    -> Takma ad.
	// @param  bool   $brackets -> Parantezlerin olup olmayacağı.
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function alias($string = '', $alias = '', $brackets = false)
	{
		if( $brackets === true)
		{
			$string = $this->brackets($string);
		}
		
		return $string.' AS '.$alias;	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Brackets
	//----------------------------------------------------------------------------------------------------
	//
	// Verinin başına ve sonuna parantez eklemek için kullanılır.
	//
	// @param  string $string   -> Metin.
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function brackets($string = '')
	{
		return ' ( '.$string.' ) ';
	}
	
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
	public function partition(...$args)
	{ 
		$this->partition = $this->_math(__FUNCTION__, $args)->args;
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
	public function procedure(...$args)
	{ 
		$this->procedure = $this->_math(__FUNCTION__, $args)->args;
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
	public function characterSet($set = '', $return = false)
	{ 
		$string = 'CHARACTER SET '.$set.' ';
		
		if( $return === false )
		{
			$this->characterSet = $string;
			return $this; 
		}
		else
		{
			return $string;	
		}
	}
	
	/******************************************************************************************
	* CHARACTER SET                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki CHARACTER SET komutunun kullanımıdır.	         	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	******************************************************************************************/
	public function cset($set = '')
	{ 
		if( empty($set) )
		{
			$set = $this->config['charset'];
		}
		
		return $this->characterSet($set, true);
	}
	
	/******************************************************************************************
	* CHARACTER SET                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki CHARACTER SET komutunun kullanımıdır.	         	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	******************************************************************************************/
	public function collate($set = '')
	{ 
		if( empty($set) )
		{
			$set = $this->config['collation'];
		}
		
		return 'COLLATE '.$set.' ';
	}
	
	
	/******************************************************************************************
	* CHARACTER SET                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki CHARACTER SET komutunun kullanımıdır.	         	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	******************************************************************************************/
	public function encoding($charset = 'utf8', $collate = 'utf8_general_ci')
	{ 
		$encoding = '';
		
		if( ! empty($charset) )
		{
			$encoding .= $this->cset($charset);
		}
		
		if( ! empty($collate) )
		{
			$encoding .= $this->collate($collate);
		}
		
		return $encoding;
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
	public function query($query = '', $secure = [])
	{
		if( ! is_string($query) || empty($query) ) 
		{
			\Errors::set('Error', 'stringParameter', 'query');
			\Errors::set('Error', 'emptyParameter', 'query');
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
	public function execQuery($query = '', $secure = [])
	{
		if( ! is_string($query) || empty($query) ) 
		{
			\Errors::set('Error', 'stringParameter', 'query');
			\Errors::set('Error', 'emptyParameter', 'query');
			
			return false;	
		}
		
		if( isset($this->secure) )
		{
			$secure = $this->secure;	
		}
		
		return $this->db->exec($this->_querySecurity($query), $secure);
	}
	
	/******************************************************************************************
	* MULTI QUERY                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Standart veritabanı sorgusu kullanmak için oluşturulmuştur.			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @query  => SQL SORGULARI yazılır.							              |
	| 2. string var @secure  => Sorgu güvenliği içindir.						              |
	|          																				  |
	| Örnek Kullanım: $this->db->multiQuery('DROP TABLE OrnekTablo');        			      |
	|          																				  |
	******************************************************************************************/
	public function multiQuery($query = '', $secure = [])
	{
		if( ! is_string($query) || empty($query) ) 
		{
			\Errors::set('Error', 'stringParameter', 'query');
			\Errors::set('Error', 'emptyParameter', 'query');
			
			return false;	
		}
		
		if( isset($this->secure) )
		{
			$secure = $this->secure;	
		}
		
		return $this->db->multiQuery($this->_querySecurity($query), $secure);
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
			\Errors::set('Error', 'stringParameter', 'table');
			\Errors::set('Error', 'emptyParameter', 'table');
		}
		else
		{
			$table = "'".$this->prefix.trim($table)."'";
	
			$query = "SHOW TABLE STATUS FROM ".$this->config['database']." LIKE $table";
		
			$this->_runQuery($query);
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
	public function increment($table = '', $columns = [], $increment = 1)
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
	public function decrement($table = '', $columns = [], $decrement = 1)
	{
		return $this->_incdec($table, $columns, $decrement, 'decrement');
	}
	
	/******************************************************************************************
	* PROTECTED INCREMENT VE DECREMENT                                                        *
	******************************************************************************************/
	protected function _incdec($table = '', $columns = [], $incdec = 0, $type = '')
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
			\Errors::set('Error', 'stringParameter', 'table');
			\Errors::set('Error', 'emptyParameter', 'columns');
			\Errors::set('Error', 'numericParameter', 'incdec');
			
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
			$newColumns = [$columns => "$columns + $incdec"];	
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
	public function insert($table = '', $datas = [])
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
			return \Errors::set('Error', 'stringParameter', 'table');
		}
		
		if( ! is_array($datas) || empty($datas) ) 
		{
			return \Errors::set('Error', 'arrayParameter', 'datas');
		}
		
		$data = ""; $values = "";
		
		$duplicateCheckWhere = [];
		
		foreach( $datas as $key => $value )
		{
			$data .= $key.",";
			
			if( ! empty($this->duplicateCheck) )
			{
				if( $this->duplicateCheck[0] !== '*' )
				{
					if( in_array($key, $this->duplicateCheck) )	
					{
						$duplicateCheckWhere[] = [$key.' = ', $value, 'and'];	
					}
				}
				else
				{
					$duplicateCheckWhere[] = [$key.' = ', $value, 'and'];	
				}
			
			}
					
			$value = $this->nailEncode($value);
			
			if( $value !== '?' )
			{
				$values .= "'".$value."'".",";
			}
			else
			{
				$values .= $value.",";
			}
		}
		
		if( ! empty($duplicateCheckWhere) )
		{
			$duplicateCheckColumn = $this->duplicateCheck; 
			
			if( $this->where($duplicateCheckWhere)->get($table)->totalRows() )
			{
				$this->duplicateCheck = NULL;
				return \Errors::set('Database', 'duplicateCheckError', implode(',', $duplicateCheckColumn));	
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

		return $this->_runQuery($insertQuery);
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
		$this->duplicateCheck  = NULL;
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
	public function update($table = '', $set = [])
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
			return \Errors::set('Error', 'stringParameter', 'table');
		}
		
		if( ! is_array($set) || empty($set) ) 
		{
			return \Errors::set('Error', 'arrayParameter', 'set');
		}

		$data = '';
		
		foreach( $set as $key => $value )
		{
			$value = $this->nailEncode($value);
			
			$data .= $key.'='."'".$value."'".',';
		}
		
		$set = ' SET '.substr($data,0,-1);
	
		$updateQuery = 'UPDATE '.
					    $this->lowPriority.
					    $this->ignore.
		                $table.
						$set.
						$this->_where().
						$this->_orderBy().
						$this->limit;
		
		$this->_resetUpdateQuery();
		
		return $this->_runQuery($updateQuery);	
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
			return \Errors::set('Error', 'stringParameter', 'table');
		}
		
		$deleteQuery = 'DELETE '.
		               $this->lowPriority.
					   $this->quick.
					   $this->ignore.
					   ' FROM '.
					   $this->table.
					   $this->partition.
					   $this->_where().
					   $this->_orderBy().
					   $this->limit;
	
		$this->_resetDeleteQuery();
		
		return $this->_runQuery($deleteQuery);
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
		elseif( $type === 'json' )
		{
			return json_encode($this->db->result());	
		}
		else
		{
			return $this->db->resultArray();
		}
	}
	
	/******************************************************************************************
	* JSON                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Sorgu sonucu kayıt bilgilerini verir.     			   		          |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->resultJson();              			                                  |
	|          																				  |
	******************************************************************************************/
	public function resultJson( $type = 'object' )
	{ 
		return json_encode($this->db->result());	
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
					   ? (object) $result[count($result) + $printable]
					   : false;
			}
			else
			{
				return isset( $result[$printable] )
				       ? (object) $result[$printable]
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
	* VALUE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Sorgu sonucu tek satır veriyi elde etmek için kullanılır.     	  	  |

	  @param bool $printable: false
	  @return object/string
	|          																				  |
	******************************************************************************************/
	public function value()
	{ 
		return current((array)$this->db->row());
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
	| Parametreler: Tek parametresi vardır. İsteğe bağlıdır.                                  |
	|          																				  |
	| Örnek Kullanım: ->columnData();                			                              |
	|          																				  |
	******************************************************************************************/
	public function columnData($col = '')
	{ 
		return $this->db->columnData($col); 
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
	  
	  @param  string $url
	  @param  array  $settings
	  @param  bool   $output
	  @return array veya object
	|          																				  |
	******************************************************************************************/
	public function pagination($url = '', $settings = [], $output = true)
	{ 
		if( ! is_array($settings) )
		{
			\Errors::set('Error', 'arrayParameter', '1.(settings)');	
		} 
	
		$limit = $this->pagination['limit'];
		$start = $this->pagination['start'];
		
		$settings['totalRows'] = $this->totalRows(true);
		$settings['limit']     = isset($limit) ? $limit : 10;
		$settings['start']     = isset($start) ? $start : NULL;
		
		if( ! empty($url) )
		{
			$settings['url'] = $url;	
		}
		
		$return = $output === true
		        ? \Pagination::create(NULL, $settings) 
				: $settings;
		
		$this->pagination = ['start' => 0, 'limit' => 0];
		
		return $return;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Result Methods Bitiş
	//----------------------------------------------------------------------------------------------------
}