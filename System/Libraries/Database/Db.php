<?php
/************************************************************/
/*                       DB LIBRARY                         */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
namespace Database;

use Config;
/******************************************************************************************
* Db		                                                                           	  *
*******************************************************************************************
| Sınıfı Kullanırken      :	$this->db->													  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/	
class Db
{
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
	private $select_column;
	
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
	private $distinctrow;
	
	/* High Priority Değişkeni
	 *  
	 * HIGH PRIORITY bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $high_priority;
	
	/* Straight Join Değişkeni
	 *  
	 * STRAIGHT JOIN bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $straight_join;
	
	/* Small Result Değişkeni
	 *  
	 * SMALL RESULT bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $small_result;	
	
	/* Big Result Değişkeni
	 *  
	 * BIG RESULT bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */	
	private $big_result;
	
	/* Buffer Result Değişkeni
	 *  
	 * BUFFER RESULT bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */			
	private $buffer_result;	
	
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
	private $no_cache;
	
	/* Calc Found Rows Değişkeni
	 *  
	 * CALC FOUND ROWS bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */	
	private $calc_found_rows;	
	
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
	private $group_by;
	
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
	private $order_by;
	
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
	private $trans_start;
	
	/* Trans Error Değişkeni
	 *  
	 * Çoklu sorgu işlem hata bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $trans_error;
	
	/* Prefix Değişkeni
	 *  
	 * Tablo ön eki bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $prefix;
	
	/******************************************************************************************
	* CONSTRUCT                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Nesne tanımlaması ve veritabanı ayarları çalıştırılıyor.				  |
	|          																				  |
	******************************************************************************************/
	public function __construct($config = array())
	{
		require_once(SYSTEM_LIBRARIES_DIR.'Database/DbCommon.php');
		
		$this->db = dbcommon();
		
		$this->prefix = Config::get('Database', 'prefix');
		
		if( empty($config) ) 
		{
			$config = Config::get('Database');
		}
		
		$this->db->connect($config);
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
		
		$this->select_column = ' '.$condition.' ';
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
		if( ! is_string($table) ) 
		{
			return false;
		}
		
		$this->from = ' FROM '.$this->prefix.$table.' ';
		
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
		if( ! is_string($table) ) 
		{
			return false;
		}
		
		$this->table = ' '.$this->prefix.$table.' ';
		
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
		if( ! ( is_string($column) || is_string($value) || is_string($logical) ) ) 
		{
			return false;
		}
		
		$value = "'".$this->db->real_escape_string($value)."'";
		
		$this->where .= ' '.$column.' '.$value.' '.$logical.' ';
		
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
		if( ! ( is_string($column) || is_string($value) || is_string($logical) ) ) 
		{
			return false;
		}
		
		$value = "'".$this->db->real_escape_string($value)."'";

		$this->having .= ' '.$column.' '.$value.' '.$logical.' ';
		
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
		if( ! ( is_string($table) || is_string($condition) || is_string($type) ) ) 
		{
			return false;
		}
		
		$this->join .= ' '.$type.' JOIN '.$table.' ON '.$condition.' ';
		
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
			return false;
		}
		
		if( empty($this->select) )
		{ 
			$this->select = 'SELECT'; $this->select_column = ' * ';
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
		$query_builder = $this->select.
						 $this->all.
						 $this->distinct.
						 $this->distinctrow.
						 $this->high_priority.
						 $this->straight_join.
						 $this->small_result.
						 $this->big_result.
						 $this->buffer_result.
						 $this->cache.
						 $this->no_cache.
						 $this->calc_found_rows.					 
						 $this->select_column.
						 $this->math.
						 $this->from.
						 $this->join.
						 $where.$this->where.
						 $this->group_by.
						 $having.$this->having.
						 $this->order_by.
						 $this->limit;	
		
		$this->_reset_query();
		
		$secure = $this->secure;
		
		$this->db->query($this->_query_security($query_builder), $secure);
		
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
			return false;
		}
		
		$secure = $this->secure;

		$this->db->query($this->_query_security($query), $secure);
		
		if( ! empty($this->trans_start) ) 
		{
			$trans_error = $this->db->error();
			if( ! empty($trans_error) ) 
			{
				$this->trans_error = $trans_error; 
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
			return false;	
		}
		
		$secure = $this->secure;
		
		return $this->db->exec($this->_query_security($query), $secure);
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
		$this->trans_start = $this->db->transStart();
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
		if( ! empty($this->trans_error) )
		{
			$this->db->transRollback();
		}
		else
		{
			$this->db->transCommit();
		}
		
		$this->trans_start = NULL;	
		$this->trans_error = NULL;
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
		return $this->db->num_rows(); 
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
		return $this->db->num_fields(); 
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
		return $this->db->result_array(); 
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
		return $this->db->fetch_array(); 
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
		return $this->db->fetch_assoc(); 
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
		return $this->db->fetch_row(); 
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
		return $this->db->affected_rows();
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
		return $this->db->insert_id(); 
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
		return $this->db->column_data(); 
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
		$this->distinctrow = ' DISTINCTROW '; 
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
		$this->straight_join = ' STRAIGHT_JOIN '; 
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
		$this->high_priority = ' HIGH_PRIORITY '; 
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
		$this->small_result = ' SQL_SMALL_RESULT '; 
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
		$this->big_result = ' SQL_BIG_RESULT '; 
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
		$this->buffer_result = ' SQL_BUFFER_RESULT '; 
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
		$this->no_cache = ' SQL_NO_CACHE '; 
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
		$this->calc_found_rows = ' SQL_CALC_FOUND_ROWS '; 
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
		
		if( ! empty($expresion) ) foreach($expresion as $mf => $val)
		{
			$exp .= $mf.'(';
			
			if( ! empty($val) && is_array($val) ) foreach($val as $v)
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
			return false; 
		}
		
		$this->group_by = ' GROUP BY '.$condition.' ' ;
		
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
		if( ! ( is_string($condition) || is_string($type)) ) 
		{
			return false; 
		}
		
		$this->order_by = ' ORDER BY '.$condition.' '.$type.' ';  
		
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
			return false; 
		}
		
		if( ! empty($limit) ) 
		{
			$comma = ' , '; 
		}
		else 
		{
			$comma = '';
		}
		
		$this->limit = ' LIMIT '.$start.$comma.$limit.' ';
		
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
			return false;
		}
		
		$this->secure = $data;
		
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
			$columns = $type === 'inc'	
					 ? abs($columns)
					 : -abs($columns);
			
			$incdec  = $columns;
			$columns = $table;
			$table   = $this->table; 
			$this->table = NULL;
		}
		
		if( ! is_string($table) || empty($columns) || ! is_numeric($incdec) )
		{
			return false;
		}
		
		$incdec = $type === 'inc'	
				 ? abs($incdec)
				 : -abs($incdec);
		
		if( is_array($columns) ) foreach($columns as $v)
		{
			$newcolumns[$v] = "$v + $incdec";	
		}
		else
		{
			$newcolumns = array($columns => "$columns + $incdec");	
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
		
		foreach($newcolumns as $key => $value)
		{
			$data .= $key.'='.$value.',';
		}
		$set = ' SET '.substr($data,0,-1);
		
		$update_query = 'UPDATE '.$this->prefix.$table.$set.$where.$this->where;
		
		$this->where = NULL;
		
		return $this->db->query($update_query);
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
		return $this->_incdec($table, $columns, $increment, 'inc');
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
		return $this->_incdec($table, $columns, $decrement, 'dec');
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
			return false;
		}
		if( ! is_array($datas) || empty($datas) ) 
		{
			return false;
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
			
		$insert_query = 'INSERT INTO '.$this->prefix.$table.' ('.substr($data,0,-1).') VALUES ('.substr($values,0,-1).')';
		
		$secure = $this->secure;
		
		return $this->db->query($this->_query_security($insert_query), $secure);
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
			return false;
		}
		
		if( ! is_array($set) || empty($set) ) 
		{
			return false;
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
		
		foreach($set as $key => $value)
		{
			$data .= $key.'='."'".$value."'".',';
		}
		$set = ' SET '.substr($data,0,-1);
		
		$update_query = 'UPDATE '.$this->prefix.$table.$set.$where.$this->where;
		
		$this->where = NULL;
		$secure = $this->secure;
		return $this->db->query($this->_query_security($update_query), $secure);	
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
		if( ! is_string($table) || empty($table) ) 
		{
			return false;
		}
		
		if( ! empty($this->where) ) 
		{
			$where = ' WHERE '; 
		}
		else 
		{
			$where = '';
		}
		
		if( ! empty($this->table) ) 
		{
			$table = $this->table; 
			$this->table = NULL;
		}
		
		$delete_query = 'DELETE FROM '.$this->prefix.$table.$where.$this->where;
		
		$this->where = NULL;
			
		$secure = $this->secure;
		
		return $this->db->query($this->_query_security($delete_query), $secure);
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
	public function differentConnection($connect_name = '')
	{
		if( ! is_string($connect_name) ) 
		{
			return false;
		}
		
		$config = Config::get('Database');
		$config_different = $config['differentConnection'];
		
		if( ! isset($config_different[$connect_name]) ) 
		{
			return false;
		}
		
		foreach($config as $key => $val)
		{
			if( $key !== 'differentConnection' )
			{
				if( ! isset($config_different[$connect_name][$key]) )
				{
					$config_different[$connect_name][$key] = $val;
				}
			}
		}
		
		return new Db($config_different[$connect_name]);
	}
	
	/******************************************************************************************
	// PRIVATE QUERY SECURITY																  *
	// Sorgu güvenliği için oluşturulmuş 													  *
	// Sınıf içi güvenlik yeöntemi.                                                           *
	******************************************************************************************/	
	private function _query_security($query = '')
	{	
		
		if( isset($this->secure) ) 
		{
			$secure = $this->secure;
			$secure_params = array();
			
			if( is_numeric(key($secure)) )
			{	
				$strex = explode('?', $query);	
				$newstr = '';
				
				if( ! empty($strex) ) for($i = 0; $i < count($strex); $i++)
				{
					$sec = isset($secure[$i])
							  ? $secure[$i]
							  : NULL;
							  
					$newstr .= $strex[$i].$this->db->real_escape_string($sec);
				}

				$query = $newstr;
			}
			else
			{
				foreach($this->secure as $k => $v)
				{
					$secure_params[$k] = $this->db->real_escape_string($v);
				}
			}
			
			$query = str_replace(array_keys($secure_params), array_values($secure_params), $query);
		}
		
		$this->secure = NULL;

		return $query;
	}
	
	/******************************************************************************************
	* DEĞİŞKENLERİ SIFIRLA                                                                    *
	******************************************************************************************/
	private function _reset_query()
	{
		$this->all = NULL;
		$this->distinct = NULL;
		$this->distinctrow = NULL;
		$this->high_priority = NULL;
		$this->straight_join = NULL;
		$this->small_result = NULL;
		$this->big_result = NULL;
		$this->buffer_result = NULL;
		$this->cache = NULL;
		$this->no_cache = NULL;
		$this->calc_found_rows = NULL;
		$this->select = NULL;
		$this->select_column = NULL;
		$this->math = NULL;
		$this->from = NULL;
		$this->table = NULL;
		$this->where = NULL;
		$this->group_by = NULL;
		$this->having = NULL;
		$this->order_by = NULL;
		$this->limit = NULL;
	}
	
	/******************************************************************************************
	* DESTRUCT                                                                                *
	******************************************************************************************/
	public function __destruct()
	{
		@$this->db->close();	
	}
}