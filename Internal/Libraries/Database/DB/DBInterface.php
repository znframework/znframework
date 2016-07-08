<?php
namespace ZN\Database;

interface DBInterface
{	
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
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
	public function select($condition);
	
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
	public function from($table);
	
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
	public function where($column, $value, $logical);
	
	
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
	public function having($column, $value, $logical);
	
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
	public function join($table, $condition, $type);
	
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
	public function get($table);
	
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
	public function query($query, $secure);
	
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
	public function execQuery($query, $secure);
	
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
	public function transStart();
	
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
	public function transEnd();
	
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
	public function totalRows($total);
	
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
	public function totalColumns();
	
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
	public function columns();
	
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
	public function result($type);
	
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
	public function resultArray();
	
	/******************************************************************************************
	* RESULT JSON                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Sorgu sonucu kayıt bilgilerini json veri türünde elde edilir.     	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->resultJson();                			                              |
	|          																				  |
	******************************************************************************************/
	public function resultJson();
	
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
	public function fetchArray();
	
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
	public function fetchAssoc();
	
	/******************************************************************************************
	* FETCH                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Sorgu sonucu verileri object veri türünde verir.     	  				  |
		
	  @var string $type: assoc, array veya row
	|          																				  |
	******************************************************************************************/
	public function fetch($type);
	
	/******************************************************************************************
	* FETCH ROW                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Sorgu sonucu tek satır veriyi object veri türünde verir.     	  		  |
		
	  @param bool $printable: false
	  @return object/string
	|          																				  |
	******************************************************************************************/
	public function fetchRow($printable);
	
	/******************************************************************************************
	* ROW                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Sorgu sonucu tek satır veriyi elde etmek için kullanılır.     	  	  |

	  @param bool $printable: false
	  @return object/string
	|          																				  |
	******************************************************************************************/
	public function row($printable);
	
	/******************************************************************************************
	* VALUE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Sorgu sonucu tek satır veriyi elde etmek için kullanılır.     	  	  |
	|          																				  |
	******************************************************************************************/
	public function value();
	
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
	public function affectedRows();
	
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
	public function insertId();
	
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
	public function columnData();
	
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
	public function tableName();
	
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
	public function pagination($url, $settings, $output);
	
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
	public function groupBy($condition);
	
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
	public function orderBy($condition, $type);
	
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
	public function limit($start, $limit);
	
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
	public function status($table);
	
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
	public function increment($table, $columns, $increment);
	
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
	public function decrement($table, $columns, $decrement);
	
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
	public function insert($table, $datas);
	
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
	public function update($table, $set);
	
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
	public function delete($table);
	
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
	public function escapeString($data);
	
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
	public function realEscapeString($data);
}