<?php
/************************************************************/
/*                    STATIC DB LIBRARY                     */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* SDB		                                                                           	  *
*******************************************************************************************
| Dahil(Import) Edilirken : SDb  							                              |
| Sınıfı Kullanırken      :	sdb::	   													  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/	
class SDb
{
	/* Select Değişkeni
	 *  
	 * SELECT bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private static $select;
	
	/* Select Column Değişkeni
	 *  
	 * col1, col2 ... bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private static $select_column;
	
	/* From Değişkeni
	 *  
	 * FROM bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private static $from;
	
	/* Where Değişkeni
	 *  
	 * WHERE bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private static $where;
	
	/* All Değişkeni
	 *  
	 * ALL bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private static $all;
	
	/* Distinct Değişkeni
	 *  
	 * DISTINCT bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private static $distinct;
	
	/* Distinct Row Değişkeni
	 *  
	 * DISTINCTROW bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private static $distinctrow;
	
	/* High Priority Değişkeni
	 *  
	 * HIGH PRIORITY bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private static $high_priority;
	
	/* Straight Join Değişkeni
	 *  
	 * STRAIGHT JOIN bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private static $straight_join;
	
	/* Small Result Değişkeni
	 *  
	 * SMALL RESULT bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private static $small_result;	
	
	/* Big Result Değişkeni
	 *  
	 * BIG RESULT bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */		
	private static $big_result;	
	
	/* Buffer Result Değişkeni
	 *  
	 * BUFFER RESULT bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */			
	private static $buffer_result;	
	
	/* Cache Değişkeni
	 *  
	 * CACHE bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */	
	private static $cache;	
	
	/* No Cache Değişkeni
	 *  
	 * NO CACHE bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */	
	private static $no_cache;
	
	/* Calc Found Rows Değişkeni
	 *  
	 * CALC FOUND ROWS bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */	
	private static $calc_found_rows;	
	
	/* Math Değişkeni
	 *  
	 * Matemetiksel işlem bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private static $math;
	
	/* Group By Değişkeni
	 *  
	 * GROUP BY bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private static $group_by;
	
	/* Having Değişkeni
	 *  
	 * HAVING bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private static $having;
	
	/* Order By Değişkeni
	 *  
	 * ORDER BY bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private static $order_by;
	
	/* Limit Değişkeni
	 *  
	 * LIMIT bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private static $limit;
	
	/* Secure Değişkeni
	 *  
	 * Güvenlik işlem bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private static $secure;
	
	/* Join Değişkeni
	 *  
	 * JOIN bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private static $join;
	
	/* Trans Start Değişkeni
	 *  
	 * Çoklu sorgu işlem bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private static $trans_start;
	
	/* Trans Error Değişkeni
	 *  
	 * Çoklu sorgu işlem hata bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private static $trans_error;
	
	/* Prefix Değişkeni
	 *  
	 * Tablo ön eki bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private static $prefix;
	
	/* Db Değişkeni
	 *  
	 * Veritabanı referans bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private static $db;
	
	/* Connect Değişkeni
	 *  
	 * Veritabanı bağlantı bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private static $connect;
	
	/******************************************************************************************
	* CONNECT                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Nesne tanımlaması ve veritabanı ayarları çalıştırılıyor.				  |
	|          																				  |
	******************************************************************************************/
	public static function connect($config = array())
	{
		require_once(DB_DIR.'DbCommon.php');
		
		self::$db = dbcommon();
		
		self::$prefix = config::get('Database', 'prefix');
		
		if( empty($config) ) 
		{
			$config = config::get('Database');
		}
		
		self::$db->connect($config);
		
		self::$connect = true;
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
	public static function select($condition = '*')
	{
		if( ! is_string($condition))  
		{
			$condition = '*';
		}
		
		self::$select_column = ' '.$condition.' ';
		self::$select = 'SELECT';
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
	public static function from($table = '')
	{
		if( ! is_string($table) ) 
		{
			return false;
		}
		
		self::$from = ' FROM '.self::$prefix.$table.' ';
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
	public static function where($column = '', $value = '', $logical = '')
	{
		if( ! (is_string($column) || is_string($value)) ) 
		{
			return false;
		}
		
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		$value = "'".self::$db->real_escape_string($value)."'";

		self::$where .= ' '.$column.' '.$value.' '.$logical.' ';
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
	public static function having($column = '', $value = '', $logical = '')
	{
		if( ! (is_string($column) || is_string($value))) return false;
		
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		$value = "'".self::$db->real_escape_string($value)."'";

		self::$having = ' '.$column.' '.$value.' '.$logical.' ';
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
	public static function join($table = '', $condition = '', $type = '')
	{
		if( ! is_string($table) ||  ! is_string($condition) ||  ! is_string($type) ) 
		{
			return false;
		}
		
		self::$join .= ' '.$type.' JOIN '.$table.' ON '.$condition.' ';
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
	public static function get($table = '')
	{
		if( ! is_string($table) ) 
		{
			return false;
		}
		
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		if( empty(self::$select) ) 
		{ 
			self::$select = 'SELECT'; 
			self::$select_column = ' * '; 
		}
				
		if( ! empty($table) ) 
		{
			self::$from = ' FROM '.self::$prefix.$table.' ';
		}
		
		if( ! empty(self::$where) ) 
		{
			$where = ' WHERE '; 
	
			if( strtolower(substr(trim(self::$where),-2)) === 'or' )
			{
				self::$where = substr(trim(self::$where),0,-2);
			}
			
			if( strtolower(substr(trim(self::$where),-3)) === 'and' )
			{
				self::$where = substr(trim(self::$where),0,-3);		
			}
		}
		else 
		{
			$where = '';
		}
		
		if( ! empty(self::$having) )
		{
			$having = ' HAVING '; 
			
			if( strtolower(substr(trim(self::$having),-2)) === 'or' )
			{
				self::$having = substr(trim(self::$having),0,-2);
			}
			
			if( strtolower(substr(trim(self::$having),-3)) === 'and' )
			{
				self::$having = substr(trim(self::$having),0,-3);		
			}
		}
		else 
		{
			$having = '';
		}
		
		$query_builder = self::$select.
						 self::$all.
						 self::$distinct.
						 self::$distinctrow.
						 self::$high_priority.
						 self::$straight_join.
						 self::$small_result.
						 self::$big_result.
						 self::$buffer_result.
						 self::$cache.
						 self::$no_cache.
						 self::$calc_found_rows.
						 self::$select_column.
						 self::$math.
						 self::$from.
						 self::$join.
						 $where.self::$where.
						 self::$group_by.
						 $having.self::$having.
						 self::$order_by.
						 self::$limit;	
		
		self::_reset_query();
		
		$secure = self::$secure;
		
		return self::$db->query(self::_query_security($query_builder), $secure);
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
	public static function query($query = '')
	{
		if( ! is_string($query) || empty($query) ) 
		{
			return false;
		}
		
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		$secure = self::$secure;

		self::$db->query(self::_query_security($query), $secure);
		
		if( ! empty(self::$trans_start) ) 
		{
			$trans_error = self::$db->error();
			
			if( ! empty($trans_error) ) 
			{
				self::$trans_error = $trans_error; 
			}
		}
	}
	
	/******************************************************************************************
	* EXEC QUERY                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Standart veritabanı sorgusu kullanmak için oluşturulmuştur.			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @query  => SQL SORGULARI yazılır.							              |
	|          																				  |
	| Örnek Kullanım: $this->db->exec_query('DROP TABLE OrnekTablo');        			      |
	|          																				  |
	******************************************************************************************/
	public static function exec_query($query = '')
	{
		if( ! is_string($query) || empty($query) ) 
		{
			return false;	
		}
		
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		$secure = self::$secure;
		
		return self::$db->exec(self::_query_security($query), $secure);
	}
	
	/******************************************************************************************
	* TRANS START                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Çoklu sorgu oluşturmak için sorgu başlangıç yöntemidir.     			  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: $this->db->trans_start();        			                              |
	|          																				  |
	******************************************************************************************/
	public static function trans_start()
	{
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		self::$trans_start = self::$db->trans_start();
	}
	
	/******************************************************************************************
	* TRANS END                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Çoklu sorgu oluşturmak için sorgu bitiş yöntemidir.     			      |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: $this->db->trans_end();        			                              |
	|          																				  |
	******************************************************************************************/
	public static function trans_end()
	{
		if( empty(self::$connect) ) 
		{
			return false;
		}
		
		if( ! empty(self::$trans_error) )
		{
			self::$db->trans_rollback();
		}
		else
		{
			self::$db->trans_commit();
		}
		
		self::$trans_start = NULL;	
		self::$trans_error = NULL;
	}
	
	/******************************************************************************************
	* TOTAL ROWS                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Tablodaki toplam kayıt sayısını verir.     			   		          |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->total_rows();        			                                      |
	|          																				  |
	******************************************************************************************/
	public static function total_rows()
	{
		if( empty(self::$connect) ) 
		{
			return false; 
		}
		
		return self::$db->num_rows();
	}
	
	/******************************************************************************************
	* TOTAL COLUMNS                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Tablodaki toplam sütun sayısını verir.     			   		          |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->total_columns();      			                              		  |
	|          																				  |
	******************************************************************************************/
	public static function total_columns()
	{
		if( empty(self::$connect) ) 
		{
			return false; 
		}
		
		return self::$db->num_fields(); 
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
	public static function columns()
	{
		if( empty(self::$connect) ) 
		{
			return false; 
		} 
		
		return self::$db->columns(); 
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
	public static function result()
	{
		if( empty(self::$connect) ) 
		{
			return false; 
		} 
		
		return self::$db->result(); 
	}
	
	/******************************************************************************************
	* RESULT ARRAY                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Sorgu sonucu kayıt bilgilerini dizi veri türünde elde edilir.     	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->result();                			                                  |
	|          																				  |
	******************************************************************************************/
	public static function result_array()
	{
		if( empty(self::$connect) ) 
		{
			return false; 
		} 
		
		return self::$db->result_array();
	}
	
	/******************************************************************************************
	* FETCH ARRAY                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Sorgu sonucu verileri dizi türünde verir.     	  					  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->fetch_array();                			                              |
	|          																				  |
	******************************************************************************************/
	public static function fetch_array()
	{
		if( empty(self::$connect) ) 
		{
			return false; 
		} 
		
		return self::$db->fetch_array(); 
	}
	
	/******************************************************************************************
	* FETCH ASSOC                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Sorgu sonucu verileri object veri türünde verir.     	  				  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->fetch_assoc();                			                              |
	|          																				  |
	******************************************************************************************/
	public static function fetch_assoc()
	{
		if( empty(self::$connect) ) 
		{
			return false; 
		} 
		
		return self::$db->fetch_assoc(); 
	}
	
	/******************************************************************************************
	* FETCH ROW                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Sorgu sonucu tek satır veriyi object veri türünde verir.     	  		  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->fetch_row();                			                              |
	|          																				  |
	******************************************************************************************/
	public static function fetch_row()
	{
		if( empty(self::$connect) ) 
		{
			return false; 
		} 
		
		return self::$db->fetch_row(); 
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
	public static function row()
	{
		if( empty(self::$connect) ) 
		{
			return false; 
		}  
		
		return self::$db->row(); 
	}
	
	/******************************************************************************************
	* AFFECTED ROWS                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinden etkilenen satır sayısını verir.		     	  	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->affected_rows();                			                          |
	|          																				  |
	******************************************************************************************/
	public static function affected_rows()
	{
		if( empty(self::$connect) ) 
		{
			return false; 
		}  
		
		return self::$db->affected_rows(); 
	}
	
	/******************************************************************************************
	* INSERT ID                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde INSERT ID kullanımı içindir.		     	  	      |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->insert_id();                			                              |
	|          																				  |
	******************************************************************************************/
	public static function insert_id()
	{
		if( empty(self::$connect) ) 
		{
			return false; 
		} 
		
		return self::$db->insert_id(); 
	}
	
	/******************************************************************************************
	* COLUMN DATA                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Sorgu sonucunda tabloya ait sütun bilgilerini almak için kullanılır.	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->column_data();                			                              |
	|          																				  |
	******************************************************************************************/
	public static function column_data()
	{
		if( empty(self::$connect) ) 
		{
			return false; 
		}  
		
		return self::$db->column_data(); 
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
	public static function error()
	{
		if( empty(self::$connect) ) 
		{
			return false; 
		}  
		
		return self::$db->error(); 
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
	public static function close()
	{
		if( empty(self::$connect) ) 
		{
			return false; 
		}  
		
		self::$db->close(); 
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
	public static function all()
	{ 
		self::$all = ' ALL '; 
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
	public static function distinct()
	{ 
		self::$distinct = ' DISTINCT '; 
	}
	
	/******************************************************************************************
	* DISTINCTROW                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki DISTINCTROW komutunun kullanımıdır.	      	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->distinctrow();                     			                          |
	|          																				  |
	******************************************************************************************/
	public static function distinctrow()
	{
		self::$distinctrow = ' DISTINCTROW '; 
	}
	
	/******************************************************************************************
	* STRAIGHT JOIN                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki STRAIGHT_JOIN komutunun kullanımıdır.	      	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->straight_join();                     	                              |
	|          																				  |
	******************************************************************************************/
	public static function straight_join()
	{ 
		self::$straight_join = ' STRAIGHT_JOIN '; 
	}	
		
	/******************************************************************************************
	* HIGH PRIORITY                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki HIGH_PRIORITY komutunun kullanımıdır.	      	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->high_priority();                     	                              |
	|          																				  |
	******************************************************************************************/
	public static function high_priority()
	{ 
		self::$high_priority = ' HIGH_PRIORITY '; 
	}
	
	/******************************************************************************************
	* SQL SMALL RESULT                                                                        *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki SQL_SMALL_RESULT komutunun kullanımıdır.	      |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->small_result();                     	                              |
	|          																				  |
	******************************************************************************************/
	public static function small_result()
	{
		self::$small_result = ' SQL_SMALL_RESULT ';
	}
	
	/******************************************************************************************
	* SQL BIG RESULT                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki SQL_BIG_RESULT komutunun kullanımıdır.	      |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->big_result();                        	                              |
	|          																				  |
	******************************************************************************************/
	public static function big_result()
	{ 
		self::$big_result = ' SQL_BIG_RESULT '; 
	}
	
	/******************************************************************************************
	* SQL BUFFER RESULT                                                                       *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki SQL_BUFFER_RESULT komutunun kullanımıdır.	      |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->buffer_result();                        	                          |
	|          																				  |
	******************************************************************************************/
	public static function buffer_result()
	{ 
		self::$buffer_result = ' SQL_BUFFER_RESULT '; 
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
	public static function cache()
	{ 
		self::$cache = ' SQL_CACHE '; 
	}
	
	/******************************************************************************************
	* SQL NO CACHE                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki SQL_NO_CACHE komutunun kullanımıdır.	  	      |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->no_cache();                        	                                  |
	|          																				  |
	******************************************************************************************/
	public static function no_cache()
	{ 
		self::$no_cache = ' SQL_NO_CACHE '; 
	}
	
	/******************************************************************************************
	* SQL CALC FOUND ROWS                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki SQL_CALC_FOUND_ROWS komutunun kullanımıdır.	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->calc_found_rows();                        	                          |
	|          																				  |
	******************************************************************************************/
	public static function calc_found_rows()
	{ 
		self::$calc_found_rows = ' SQL_CALC_FOUND_ROWS '; 
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
	public static function math($expresion = array())
	{ 
		if( ! is_array($expresion) ) 
		{
			if( is_string($expression) )
			{
				self::$math = $expresion;
			}
			
			return false;
		}
		
		$exp = ''; $vals = '';
		
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
		
		self::$math = $math; 
	}
	
	/******************************************************************************************
	* GROUP BY                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde GROUP BY kullanımıdır.			                	  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @condition => Kümelemeyi oluşturacak veri parametresi.                    |
	|          																				  |
	| Örnek Kullanım: ->group_by('id')  // GROUP BY id								          |
	|          																				  |
	******************************************************************************************/
	public static function group_by($condition = '')
	{ 
		if( ! is_string($condition) )
		{ 
			return false; 
		}
		
		self::$group_by = ' GROUP BY '.$condition.' ';
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
	| Örnek Kullanım: ->order_by('id', 'desc')  // ORDER BY id DESC							  |
	|          																				  |
	******************************************************************************************/
	public static function order_by($condition = '', $type = '')
	{ 
		if( ! (is_string($condition) || is_string($type)) ) 
		{
			return false; 
		}
		
		self::$order_by = ' ORDER BY '.$condition.' '.$type.' ';  
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
	public static function limit($start = '', $limit = '')
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
		
		self::$limit = ' LIMIT '.$start.$comma.$limit.' ';
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
	public static function secure($data = array())
	{
		if( ! is_array($data) ) 
		{
			return false;
		}
		
		self::$secure = $data;
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
	public static function insert($table = '', $datas = array())
	{
		if( ! is_string($table) || empty($table) ) 
		{
			return false;
		}
		if( ! is_array($datas) || empty($datas) ) 
		{
			return false;
		}
		
		if( empty(self::$connect) ) 
		{
			self::connect();
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
			
		$insert_query = 'INSERT INTO '.self::$prefix.$table.' ('.substr($data,0,-1).') VALUES ('.substr($values,0,-1).')';
		
		$secure = self::$secure;
		
		return self::$db->query(self::_query_security($insert_query), $secure);
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
	public static function update($table = '', $set = array())
	{
		if( ! is_string($table) || empty($table) ) 
		{
			return false;
		}
		
		if( ! is_array($set) || empty($set) ) 
		{
			return false;
		}
		
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		if( ! empty(self::$where) ) 
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
		
		$update_query = 'UPDATE '.self::$prefix.$table.$set.$where.self::$where;
		
		self::$where = NULL;
		
		$secure = self::$secure;
		
		return self::$db->query(self::_query_security($update_query), $secure);	
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
	public static function delete($table = '')
	{
		if( ! is_string($table) || empty($table) ) 
		{
			return false;
		}
		
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		if( ! empty(self::$where) ) 
		{
			$where = ' WHERE '; 
		}
		else 
		{
			$where = '';
		}
		
		$delete_query = 'DELETE FROM '.self::$prefix.$table.$where.self::$where;
		
		self::$where = NULL;
		
		$secure = self::$secure;
		
		return self::$db->query(self::_query_security($delete_query), $secure);
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
	public static function version()
	{
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		return self::$db->version();	
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
	public static function different_connection($connect_name = '')
	{
		if( ! is_string($connect_name) ) 
		{
			return false;
		}
		
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		$config = config::get('Database');
		$config_different = $config['different_connection'];
		
		if( ! isset($config_different[$connect_name]) ) 
		{
			return false;
		}
		
		foreach($config as $key => $val)
		{
			if( $key !== 'different_connection' )
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
	private static function _query_security($query = '')
	{	
		
		if( isset(self::$secure) ) 
		{
			$secure = self::$secure;
			$secure_params = array();
			
			if( is_numeric(key($secure)) )
			{	
				$strex = explode('?', $query);	
				$newstr = '';
				
				for($i = 0; $i < count($secure); $i++)
				{
					$newstr .= $strex[$i].self::$db->real_escape_string($secure[$i]);
				}
			
				$query = $newstr;
			}
			else
			{
				foreach(self::$secure as $k => $v)
				{
					$secure_params[$k] = self::$db->real_escape_string($v);
				}
			}
			
			$query = str_replace(array_keys($secure_params), array_values($secure_params), $query);
		}
		self::$secure = NULL;

		return $query;
	}
	
	/******************************************************************************************
	* DEĞİŞKENLERİ SIFIRLA                                                                    *
	******************************************************************************************/
	private static function _reset_query()
	{
		self::$all = NULL;
		self::$distinct = NULL;
		self::$distinctrow = NULL;
		self::$high_priority = NULL;
		self::$straight_join = NULL;
		self::$small_result = NULL;
		self::$big_result = NULL;
		self::$buffer_result = NULL;
		self::$cache = NULL;
		self::$no_cache = NULL;
		self::$calc_found_rows = NULL;
		self::$select = NULL;
		self::$select_column = NULL;
		self::$math = NULL;
		self::$from = NULL;
		self::$where = NULL;
		self::$group_by = NULL;
		self::$having = NULL;
		self::$order_by = NULL;
		self::$limit = NULL;
	}	
}