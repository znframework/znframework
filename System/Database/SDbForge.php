<?php
/************************************************************/
/*                  STATIC DB FORGE LIBRARY                 */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* SDbForge                                                                           	  *
*******************************************************************************************
| Dahil(Import) Edilirken : SDbForge						                              |
| Sınıfı Kullanırken      :	sdbforge::	   												  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/	
class SDbForge
{
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
	* CREATE DATABASE                                                                         *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde CREATE DATABASE kullanımı için oluşturulmuştur.	  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @dbname => Oluşturulacak veritabanı ismi.                                 |
	|          																				  |
	| Örnek Kullanım: sdbforge::create_database('OrnekVeritabani')        			  		  |
	|          																				  |
	******************************************************************************************/
	public static function create_database($dbname = '')
	{
		if( ! is_string($dbname) || empty($dbname) ) 
		{
			return false;
		}
		
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		return self::$db->exec('CREATE DATABASE '.$dbname);
	}
	
	/******************************************************************************************
	* DROP DATABASE                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde DROP DATABASE kullanımı için oluşturulmuştur.	      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @dbname => Kaldırılacak veritabanı ismi.                                  |
	|          																				  |
	| Örnek Kullanım: sdbforge::drop_database('OrnekVeritabani')        			          |
	|          																				  |
	******************************************************************************************/
	public static function drop_database($dbname = '')
	{
		if( ! is_string($dbname) || empty($dbname) ) 
		{
			return false;
		}
		
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		return self::$db->exec('DROP DATABASE '.$dbname);
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
	| Örnek Kullanım: sdbforge::create_table('OrnekTablo', array('id' => 'int(11)'));         |
	|          																				  |
	******************************************************************************************/
	public static function create_table($table = '', $condition = array())
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
		
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		return self::$db->exec('CREATE TABLE '.self::$prefix.$table.'('.substr($column,0,-1).')');
	}
	
	/******************************************************************************************
	* DROP TABLE                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde DROP TABLE kullanımı için oluşturulmuştur.	          |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @table => Kaldırılacak tablo ismi.                                  	  |
	|          																				  |
	| Örnek Kullanım: sdbforge::drop_table('OrnekTablo');   						     	  |
	|          																				  |
	******************************************************************************************/
	public static function drop_table($table = '')
	{
		if( ! is_string($table) || empty($table) ) 
		{
			return false;
		}
		
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		return self::$db->exec('DROP TABLE '.self::$prefix.$table);
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
	| Örnek Kullanım: sdbforge::alter_table('OrnekTablo', array('işlemler'));   	     	  |
	|          																				  |
	| >>>>>>>>>>>>>>>>>>>>>>>>>>>Detaylı kullanım için zntr.net<<<<<<<<<<<<<<<<<<<<<<<<<<  	  |
	|          																				  |
	******************************************************************************************/
	public static function alter_table($table = '', $condition = array())
	{
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		if( key($condition) === 'rename_table' ) 			
		{
			self::rename_table($table, $condition['rename_table']);
		}
		elseif( key($condition) === 'add_column' ) 		
		{
			self::add_column($table, $condition['add_column']);
		}
		elseif( key($condition) === 'drop_column' ) 		
		{
			self::drop_column($table, $condition['drop_column']);	
		}
		elseif( key($condition) === 'modify_column' ) 	
		{
			self::modify_column($table, $condition['modify_column']);
		}
		elseif( key($condition) === 'rename_column' ) 	
		{
			self::rename_column($table, $condition['rename_column']);
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
	| Örnek Kullanım: sdbforge::rename_table('OrnekTablo', 'YeniTablo');   		              |
	|          																				  |
	******************************************************************************************/		
	public static function rename_table($name = '', $new_name = '')
	{
		if( ! is_string($name) || ! is_string($new_name) ) 
		{
			return false;
		}
		
		if( empty($name) || empty($new_name) ) 
		{
			return false;
		}
		
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		return self::$db->exec('ALTER TABLE '.self::$prefix.$name.' RENAME TO '.self::$prefix.$new_name);
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
	| Örnek Kullanım: sdbforge::rename_table('OrnekTablo', array('sütun işlemleri'));         |
	|          																				  |
	| >>>>>>>>>>>>>>>>>>>>>>>>>>>Detaylı kullanım için zntr.net<<<<<<<<<<<<<<<<<<<<<<<<<<  	  |
	|          																				  |
	******************************************************************************************/	
	public static function add_column($table = '', $condition = array())
	{
		if( ! is_string($table) || empty($table) ) 
		{
			return false;
		}
		
		if( ! is_array($condition) ) 
		{
			return false;
		}
		
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		if( self::$db->add_column() !== false )
		{
			$add_column = self::$db->add_column();
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
		
		return self::$db->exec('ALTER TABLE '.$table.' '.$con.';'); 
	}
	
	/******************************************************************************************
	* DROP COLUMN                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde ALTER TABLE kullanımına alternatif olarak kullanılır.|
	| daha basit bir şekilde sütun kaldırmak için kullanılır.               	              |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @table => Sütun kaldırılacak tablo ismi.                                  |
	| 1. string/array var @column => Sütun ismi.                                              |
	|          																				  |
	| Örnek Kullanım: sdbforge::drop_column('OrnekTablo', 'col1');   			              |
	|          																				  |
	| >>>>>>>>>>>>>>>>>>>>>>>>>>>Detaylı kullanım için zntr.net<<<<<<<<<<<<<<<<<<<<<<<<<<  	  |
	|          																				  |
	******************************************************************************************/	
	public static function drop_column($table = '', $column = '')
	{
		if( ! is_string($table) || empty($table) ) 
		{
			return false;
		}
		
		if( ! ( is_string($column) || is_array($column) ) || empty($column) ) 
		{
			return false;
		}
		
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		if( self::$db->drop_column() !== false )
		{
			$drop_column = self::$db->drop_column();
		}
		else
		{
			$drop_column = 'DROP ';
		}
		
		if( ! is_array($column) )
		{
			self::$db->exec('ALTER TABLE '.self::$prefix.$table.' '.$drop_column.$column.';');		
		}
		else
		{
			foreach($column as $col)
			{
				self::$db->exec('ALTER TABLE '.self::$prefix.$table.' '.$drop_column.$col.';');
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
	| Örnek Kullanım: sdbforge::modify_column('OrnekTablo', array('sütun işlemleri'));        |
	|          																				  |
	| >>>>>>>>>>>>>>>>>>>>>>>>>>>Detaylı kullanım için zntr.net<<<<<<<<<<<<<<<<<<<<<<<<<<  	  |
	|          																				  |
	******************************************************************************************/
	public static function modify_column($table = '', $condition = array())
	{
		if( ! is_string($table) || empty($table) ) 
		{
			return false;
		}
		
		if( ! is_array($condition) ) 
		{
			return false;
		}
		
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		if( self::$db->modify_column() !== false )
		{
			$modify_column = self::$db->modify_column();
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
		
		return self::$db->exec('ALTER TABLE '.self::$prefix.$table.' '.$con.';');
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
	| Örnek Kullanım: sdbforge::rename_column('OrnekTablo', array('sütun işlemleri'));        |
	|          																				  |
	| >>>>>>>>>>>>>>>>>>>>>>>>>>>Detaylı kullanım için zntr.net<<<<<<<<<<<<<<<<<<<<<<<<<<  	  |
	|          																				  |
	******************************************************************************************/
	public static function rename_column($table = '', $condition = array())
	{
		if( ! is_string($table) || empty($table) ) 
		{
			return false;
		}
		
		if( ! is_array($condition) ) 
		{
			return false;
		}
		
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		if( self::$db->rename_column() !== false )
		{
			$rename_column = self::$db->rename_column();
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
		
		return self::$db->exec('ALTER TABLE '.self::$prefix.$table.' '.$con.';');
	}
	
	/******************************************************************************************
	* TRUNCATE                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde TRUNCATE kullanımı için oluşturulmuştur.			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @table => İçi boşaltılacak tablo ismi.                                    |
	|          																				  |
	| Örnek Kullanım: sdbforge::truncate('OrnekTablo');       						  |
	|          																				  |
	| >>>>>>>>>>>>>>>>>>>>>>>>>>>Detaylı kullanım için zntr.net<<<<<<<<<<<<<<<<<<<<<<<<<<  	  |
	|          																				  |
	******************************************************************************************/
	public static function truncate($table = '')
	{
		if( ! is_string($table) || empty($table) ) 
		{
			return false;
		}
		
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		if( self::$db->truncate() !== false )
		{
			$truncate = self::$db->truncate();
		}
		else
		{
			$truncate = 'TRUNCATE TABLE ';
		}
		
		return self::$db->exec($truncate.self::$prefix.$table);
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
		
		return new DbForge($config_different[$connect_name]);
	}
	
	public static function error()
	{ 
		if( empty(self::$connect) ) 
		{
			return false; 
		}
		
		return self::$db->error(); 
	}
}