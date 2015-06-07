<?php
/************************************************************/
/*                    DB FORGE LIBRARY                      */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* DbForge                                                                           	  *
*******************************************************************************************
| Dahil(Import) Edilirken : DbForge							                              |
| Sınıfı Kullanırken      :	$this->dbforge->										      |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/	
class DbForge
{
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
		require_once(SYSTEM_LIBRARIES_DIR.'Db/DbCommon.php');
		
		$this->db = dbcommon();
		
		$this->prefix = config::get('Database', 'prefix');
			
		if( empty($config) ) 
		{
			$config = config::get('Database');
		}
		
		$this->db->connect($config);
	}
	
	/******************************************************************************************
	* CREATE DATABASE                                                                         *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde CREATE DATABASE kullanımı için oluşturulmuştur.	  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @dbname => Oluşturulacak veritabanı ismi.                                 |
	|          																				  |
	| Örnek Kullanım: $this->dbforge->create_database('OrnekVeritabani')        			  |
	|          																				  |
	******************************************************************************************/
	public function create_database($dbname = '')
	{
		if( ! is_string($dbname) || empty($dbname) ) 
		{
			return false;
		}
		
		return $this->db->exec('CREATE DATABASE '.$dbname);
	}
	
	/******************************************************************************************
	* DROP DATABASE                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde DROP DATABASE kullanımı için oluşturulmuştur.	      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @dbname => Kaldırılacak veritabanı ismi.                                  |
	|          																				  |
	| Örnek Kullanım: $this->dbforge->drop_database('OrnekVeritabani')        			      |
	|          																				  |
	******************************************************************************************/
	public function drop_database($dbname = '')
	{
		if( ! is_string($dbname) || empty($dbname) ) 
		{
			return false;
		}
		
		return $this->db->exec('DROP DATABASE '.$dbname);
	}
	
	/******************************************************************************************
	* CREATE TABLE                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde CREATE TABLE kullanımı için oluşturulmuştur.	      |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @table => Oluşturulacak tablo ismi.                                  	  |
	| 2. array var @condition => Sütun isimler ve özellikleri bilgisini içerir.               |
	|          																				  |
	| Örnek Kullanım: $this->dbforge->create_table('OrnekTablo', array('id' => 'int(11)'));   |
	|          																				  |
	******************************************************************************************/
	public function create_table($table = '', $condition = array())
	{
		if( ! is_string($table) || empty($table) ) 
		{
			return false;
		}
		if( ! is_array($condition) ) 
		{
			return false;
		}
		
		$keys = array_keys($condition);
		
		$column = "";
		
		foreach($condition as $key => $value)
		{
			$column .= $key.' '.$value.',';
		}
		
		return $this->db->exec('CREATE TABLE '.$this->prefix.$table.'('.substr($column,0,-1).')');
	}
	
	/******************************************************************************************
	* DROP TABLE                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde DROP TABLE kullanımı için oluşturulmuştur.	          |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @table => Kaldırılacak tablo ismi.                                  	  |
	|          																				  |
	| Örnek Kullanım: $this->dbforge->drop_table('OrnekTablo');   							  |
	|          																				  |
	******************************************************************************************/
	public function drop_table($table = '')
	{
		if( ! is_string($table) || empty($table) ) 
		{
			return false;
		}
		
		return $this->db->exec('DROP TABLE '.$this->prefix.$table);
	}
	
	/******************************************************************************************
	* ALTER TABLE                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde ALTER TABLE kullanımı için oluşturulmuştur.	      |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @table => Düzenlenecek tablo ismi.                                  	  |
	| 2. array var @condition => Sütun isimler ve özellikleri bilgisini içerir.               |
	|          																				  |
	| Örnek Kullanım: $this->dbforge->alter_table('OrnekTablo', array('işlemler'));   		  |
	|          																				  |
	| >>>>>>>>>>>>>>>>>>>>>>>>>>>Detaylı kullanım için zntr.net<<<<<<<<<<<<<<<<<<<<<<<<<<  	  |
	|          																				  |
	******************************************************************************************/
	public function alter_table($table = '', $condition = array())
	{
		if( key($condition) === 'rename_table' ) 			
		{
			return $this->rename_table($table, $condition['rename_table']);
		}
		elseif( key($condition) === 'add_column' ) 		
		{
			return $this->add_column($table, $condition['add_column']);
		}
		elseif( key($condition) === 'drop_column' ) 		
		{
			return $this->drop_column($table, $condition['drop_column']);	
		}
		elseif( key($condition) === 'modify_column' ) 	
		{
			return $this->modify_column($table, $condition['modify_column']);
		}
		elseif( key($condition) === 'rename_column' ) 	
		{
			return $this->rename_column($table, $condition['rename_column']);
		}
	}
	
	/******************************************************************************************
	* RENAME TABLE                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde ALTER TABLE kullanımına alternatif olarak kullanılır.|
	| daha basit bir şekilde tablo ismini değiştirmek için kullanılır.               	      |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @name => Eski tablo ismi.                                  	  		      |
	| 1. string var @new_name => Yeni tablo ismi.                                  	  		  |
	|          																				  |
	| Örnek Kullanım: $this->dbforge->rename_table('OrnekTablo', 'YeniTablo');   		      |
	|          																				  |
	******************************************************************************************/	
	public function rename_table($name = '', $new_name = '')
	{
		if( ! is_string($name) || ! is_string($new_name) ) 
		{
			return false;
		}
		
		if( empty($name) || empty($new_name) ) 
		{
			return false;
		}
		
		return $this->db->exec('ALTER TABLE '.$this->prefix.$name.' RENAME TO '.$this->prefix.$new_name);
	}
	
	/******************************************************************************************
	* ADD COLUMN                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde ALTER TABLE kullanımına alternatif olarak kullanılır.|
	| daha basit bir şekilde sütun eklemek için kullanılır.               	                  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @table => Sütun eklenecek tablo ismi.                                     |
	| 1. array var @condition => Sütun ismi ve özellikleri.                                   |
	|          																				  |
	| Örnek Kullanım: $this->dbforge->add_column('OrnekTablo', array('sütun işlemleri'));     |
	|          																				  |
	| >>>>>>>>>>>>>>>>>>>>>>>>>>>Detaylı kullanım için zntr.net<<<<<<<<<<<<<<<<<<<<<<<<<<  	  |
	|          																				  |
	******************************************************************************************/	
	public function add_column($table = '', $condition = array())
	{
		if( ! is_string($table) || empty($table) ) 
		{
			return false;
		}
		
		if( ! is_array($condition) ) 
		{
			return false;
		}
		
		if( $this->db->add_column() !== false )
		{
			$add_column = $this->db->add_column();
		}
		else
		{
			$add_column = 'ADD ';
		}
		
		$con = NULL;
		
		foreach($condition as $column => $values)
		{
			$colvals = '';
			
			if( is_array($values) )
			{	
				foreach($values as $val)
				{
					$colvals .= ' '.$val;
				}
			}
			else
			{
				$colvals .= ' '.$values;
			}
			
			$con .= $add_column.$column.$colvals.',';
		}		
			
		$con = substr($con, 0 , -1);
		
		return $this->db->exec('ALTER TABLE '.$table.' '.$con.';'); 
	}
	
	/******************************************************************************************
	* DROP COLUMN                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde ALTER TABLE kullanımına alternatif olarak kullanılır.|
	| daha basit bir şekilde sütun kaldırmak için kullanılır.               	              |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @table => Sütun kaldırılacak tablo ismi.                                  |
	| 1. string/array var @column => Sütun ismi.                                              |
	|          																				  |
	| Örnek Kullanım: $this->dbforge->drop_column('OrnekTablo', 'col1');   			          |
	|          																				  |
	| >>>>>>>>>>>>>>>>>>>>>>>>>>>Detaylı kullanım için zntr.net<<<<<<<<<<<<<<<<<<<<<<<<<<  	  |
	|          																				  |
	******************************************************************************************/	
	public function drop_column($table = '', $column = '')
	{
		if( ! is_string($table) || empty($table) ) 
		{
			return false;
		}
		
		if( ! ( is_string($column) || is_array($column) ) || empty($column) ) 
		{
			return false;
		}
		
		if( $this->db->drop_column() !== false )
		{
			$drop_column = $this->db->drop_column();
		}
		else
		{
			$drop_column = 'DROP ';
		}
		
		if( ! is_array($column) )
		{
			return $this->db->exec('ALTER TABLE '.$this->prefix.$table.' '.$drop_column.$column.';');		
		}
		else
		{
			foreach($column as $col)
			{
				$this->db->exec('ALTER TABLE '.$this->prefix.$table.' '.$drop_column.$col.';');
			}
		}
	}
	
	/******************************************************************************************
	* MODIFY COLUMN                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde ALTER TABLE kullanımına alternatif olarak kullanılır.|
	| daha basit bir şekilde sütun düzenlemek için kullanılır.               	              |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @table => Sütun kaldırılacak tablo ismi.                                  |
	| 1. string/array var @condition => Sütun ismi ve özellikleri.                            |
	|          																				  |
	| Örnek Kullanım: $this->dbforge->modify_column('OrnekTablo', array('sütun işlemleri'));  |
	|          																				  |
	| >>>>>>>>>>>>>>>>>>>>>>>>>>>Detaylı kullanım için zntr.net<<<<<<<<<<<<<<<<<<<<<<<<<<  	  |
	|          																				  |
	******************************************************************************************/	
	public function modify_column($table = '', $condition = array())
	{
		if( ! is_string($table) || empty($table) ) 
		{
			return false;
		}
		
		if( ! is_array($condition) ) 
		{
			return false;
		}
		
		if( $this->db->modify_column() !== false )
		{
			$modify_column = $this->db->modify_column();
		}
		else
		{
			$modify_column = 'MODIFY ';
		}
		
		$con = NULL;
			
		foreach($condition as $column => $values)
		{
			$colvals = '';
			
			if( is_array($values) )
			{	
				foreach($values as $val)
				{
					$colvals .= ' '.$val;
				}
			}
			else
			{
				$colvals .= ' '.$values;
			}
			
			$con .= $modify_column.$column.$colvals.',';
		}		
		
		$con = substr($con, 0 , -1);
		
		return $this->db->exec('ALTER TABLE '.$this->prefix.$table.' '.$con.';');
	}
	
	/******************************************************************************************
	* RENAME COLUMN                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde ALTER TABLE kullanımına alternatif olarak kullanılır.|
	| daha basit bir şekilde sütun ismini değiştirmek için kullanılır.               	      |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @table => Sütun kaldırılacak tablo ismi.                                  |
	| 1. string/array var @condition => Sütun ismi ve özellikleri.                            |
	|          																				  |
	| Örnek Kullanım: $this->dbforge->rename_column('OrnekTablo', array('sütun işlemleri'));  |
	|          																				  |
	| >>>>>>>>>>>>>>>>>>>>>>>>>>>Detaylı kullanım için zntr.net<<<<<<<<<<<<<<<<<<<<<<<<<<  	  |
	|          																				  |
	******************************************************************************************/
	public function rename_column($table = '', $condition = array())
	{
		if( ! is_string($table) || empty($table) ) 
		{
			return false;
		}
		
		if( ! is_array($condition) ) 
		{
			return false;
		}
		
		if( $this->db->rename_column() !== false )
		{
			$rename_column = $this->db->rename_column();
		}
		else
		{
			$rename_column = 'CHANGE COLUMN ';
		}
		
		$con = NULL;
		
		foreach($condition as $column => $values)
		{
			$colvals = '';
			
			if( is_array($values) )
			{	
				foreach($values as $val)
				{
					$colvals .= ' '.$val;
				}
			}
			else
			{
				$colvals .= ' '.$values;
			}
			
			$con .= $rename_column.$column.$colvals.',';
		}		
		
		$con = substr($con, 0 , -1);
		
		return $this->db->exec('ALTER TABLE '.$this->prefix.$table.' '.$con.';');
	}
	
	/******************************************************************************************
	* TRUNCATE                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde TRUNCATE kullanımı için oluşturulmuştur.			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @table => İçi boşaltılacak tablo ismi.                                    |
	|          																				  |
	| Örnek Kullanım: $this->dbforge->truncate('OrnekTablo');       						  |
	|          																				  |
	| >>>>>>>>>>>>>>>>>>>>>>>>>>>Detaylı kullanım için zntr.net<<<<<<<<<<<<<<<<<<<<<<<<<<  	  |
	|          																				  |
	******************************************************************************************/
	public function truncate($table = '')
	{
		if( ! is_string($table) || empty($table) ) 
		{
			return false;
		}
		
		if($this->db->truncate() !== false)
		{
			$truncate = $this->db->truncate();
		}
		else
		{
			$truncate = 'TRUNCATE TABLE ';
		}
		
		return $this->db->exec($truncate.$this->prefix.$table);
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
	public function different_connection($connect_name = '')
	{
		if( ! is_string($connect_name) ) 
		{
			return false;
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
		
		return new DbForge($config_different[$connect_name]);
	}
	
	public function error(){ return $this->db->error(); }
	
	/******************************************************************************************
	* DESTRUCT                                                                                *
	******************************************************************************************/
	public function __destruct()
	{
		$this->db->close();	
	}
}