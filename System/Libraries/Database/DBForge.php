<?php
class __USE_STATIC_ACCESS__DBForge
{
	/***********************************************************************************/
	/* DB FORGE LIBRARY		    		                   	                           */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: DBForge
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: $this->dbforge, zn::$use->dbforge, uselib('dbforge')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* Prefix Değişkeni
	 *  
	 * Tablo ön eki bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $prefix;
	
	/* Table Değişkeni
	 *  
	 * TABLE bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $table;
	
	/******************************************************************************************
	* CONSTRUCT                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Nesne tanımlaması ve veritabanı ayarları çalıştırılıyor.				  |
	|          																				  |
	******************************************************************************************/
	public function __construct($config = array())
	{
		require_once(SYSTEM_LIBRARIES_DIR.'Database/DBCommon.php');
		
		$this->db = DBCommon();
		
		$this->prefix = Config::get('Database', 'prefix');
			
		if( empty($config) ) 
		{
			$config = Config::get('Database');
		}
		
		$this->db->connect($config);
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
			Error::set(lang('Error', 'stringParameter', 'table'));
		}
		else
		{
			$this->table = ' '.$this->prefix.$table.' ';
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* CREATE DATABASE                                                                         *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde CREATE DATABASE kullanımı için oluşturulmuştur.	  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @dbname => Oluşturulacak veritabanı ismi.                                 |
	|          																				  |
	| Örnek Kullanım: $this->dbforge->createDatabase('OrnekVeritabani')        			  	  |
	|          																				  |
	******************************************************************************************/
	public function createDatabase($dbname = '')
	{
		if( ! is_string($dbname) || empty($dbname) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'dbname'));
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
	| Örnek Kullanım: $this->dbforge->dropDatabase('OrnekVeritabani')        			      |
	|          																				  |
	******************************************************************************************/
	public function dropDatabase($dbname = '')
	{
		if( ! is_string($dbname) || empty($dbname) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'dbname'));
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
	| Örnek Kullanım: $this->dbforge->createTable('OrnekTablo', array('id' => 'int(11)'));   |
	|          																				  |
	******************************************************************************************/
	public function createTable($table = '', $condition = array())
	{
		if( ! empty($this->table) ) 
		{
			// Table yöntemi tanımlanmış ise
			// 1. parametre, 2. parametre olarak kullanılsın
			$condition = $table;
			$table = $this->table; 
			$this->table = NULL;
		}
		
		if( ! is_string($table) || empty($table) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'table'));
		}
		
		if( ! is_array($condition) ) 
		{
			return Error::set(lang('Error', 'arrayParameter', 'condition'));
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
	| Örnek Kullanım: $this->dbforge->dropTable('OrnekTablo');   							  |
	|          																				  |
	******************************************************************************************/
	public function dropTable($table = '')
	{
		if( ! empty($this->table) ) 
		{
			// Table yöntemi tanımlanmış ise
			// 1. parametre, 2. parametre olarak kullanılsın
			$table = $this->table; 
			$this->table = NULL;
		}
		
		if( ! is_string($table) || empty($table) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'table'));
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
	| Örnek Kullanım: $this->dbforge->alterTable('OrnekTablo', array('işlemler'));   		  |
	|          																				  |
	| >>>>>>>>>>>>>>>>>>>>>>>>>>>Detaylı kullanım için zntr.net<<<<<<<<<<<<<<<<<<<<<<<<<<  	  |
	|          																				  |
	******************************************************************************************/
	public function alterTable($table = '', $condition = array())
	{
		if( ! empty($this->table) ) 
		{
			// Table yöntemi tanımlanmış ise
			// 1. parametre, 2. parametre olarak kullanılsın
			$condition = $table;
			$table = $this->table; 
			$this->table = NULL;
		}
		
		if( key($condition) === 'renameTable' ) 			
		{
			return $this->renameTable($table, $condition['renameTable']);
		}
		elseif( key($condition) === 'addColumn' ) 		
		{
			return $this->addColumn($table, $condition['addColumn']);
		}
		elseif( key($condition) === 'dropColumn' ) 		
		{
			return $this->dropColumn($table, $condition['dropColumn']);	
		}
		elseif( key($condition) === 'modifyColumn' ) 	
		{
			return $this->modifyColumn($table, $condition['modifyColumn']);
		}
		elseif( key($condition) === 'renameColumn' ) 	
		{
			return $this->renameColumn($table, $condition['renameColumn']);
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
	| Örnek Kullanım: $this->dbforge->renameTable('OrnekTablo', 'YeniTablo');   		      |
	|          																				  |
	******************************************************************************************/	
	public function renameTable($name = '', $newName = '')
	{
		if( ! empty($this->table) ) 
		{
			// Table yöntemi tanımlanmış ise
			// 1. parametre, 2. parametre olarak kullanılsın
			$newName = $name;
			$name = $this->table; 
			$this->table = NULL;
		}
		
		if( ! is_string($name) || empty($name) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'name'));
		}
		
		if( ! is_string($newName) || empty($newName) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'newName'));
		}
		
		return $this->db->exec('ALTER TABLE '.$this->prefix.$name.' RENAME TO '.$this->prefix.$newName);
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
	| Örnek Kullanım: $this->dbforge->addColumn('OrnekTablo', array('sütun işlemleri'));     |
	|          																				  |
	| >>>>>>>>>>>>>>>>>>>>>>>>>>>Detaylı kullanım için zntr.net<<<<<<<<<<<<<<<<<<<<<<<<<<  	  |
	|          																				  |
	******************************************************************************************/	
	public function addColumn($table = '', $condition = array())
	{
		if( ! empty($this->table) ) 
		{
			// Table yöntemi tanımlanmış ise
			// 1. parametre, 2. parametre olarak kullanılsın
			$condition = $table;
			$table = $this->table; 
			$this->table = NULL;
		}
		
		if( ! is_string($table) || empty($table) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'table'));
		}
		
		if( ! is_array($condition) ) 
		{
			return Error::set(lang('Error', 'arrayParameter', 'condition'));
		}
		
		if( $this->db->addColumn() !== false )
		{
			$addColumn = $this->db->addColumn();
		}
		else
		{
			$addColumn = 'ADD ';
		}
		
		$con = NULL;
		
		foreach( $condition as $column => $values )
		{
			$colvals = '';
			
			if( is_array($values) )
			{	
				foreach( $values as $val )
				{
					$colvals .= ' '.$val;
				}
			}
			else
			{
				$colvals .= ' '.$values;
			}
			
			$con .= $addColumn.$column.$colvals.',';
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
	| Örnek Kullanım: $this->dbforge->dropColumn('OrnekTablo', 'col1');   			          |
	|          																				  |
	| >>>>>>>>>>>>>>>>>>>>>>>>>>>Detaylı kullanım için zntr.net<<<<<<<<<<<<<<<<<<<<<<<<<<  	  |
	|          																				  |
	******************************************************************************************/	
	public function dropColumn($table = '', $column = '')
	{
		if( ! empty($this->table) ) 
		{
			// Table yöntemi tanımlanmış ise
			// 1. parametre, 2. parametre olarak kullanılsın
			$column = $table;
			$table = $this->table; 
			$this->table = NULL;
		}
		
		if( ! is_string($table) || empty($table) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'table'));
		}
		
		if( ! ( is_string($column) || is_array($column) ) || empty($column) ) 
		{
			return Error::set(lang('Error', 'stringArrayParameter', 'column'));
		}
		
		if( $this->db->dropColumn() !== false )
		{
			$dropColumn = $this->db->dropColumn();
		}
		else
		{
			$dropColumn = 'DROP ';
		}
		
		if( ! is_array($column) )
		{
			return $this->db->exec('ALTER TABLE '.$this->prefix.$table.' '.$dropColumn.$column.';');		
		}
		else
		{
			foreach($column as $col)
			{
				$this->db->exec('ALTER TABLE '.$this->prefix.$table.' '.$dropColumn.$col.';');
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
	| Örnek Kullanım: $this->dbforge->modifyColumn('OrnekTablo', array('sütun işlemleri'));  |
	|          																				  |
	| >>>>>>>>>>>>>>>>>>>>>>>>>>>Detaylı kullanım için zntr.net<<<<<<<<<<<<<<<<<<<<<<<<<<  	  |
	|          																				  |
	******************************************************************************************/	
	public function modifyColumn($table = '', $condition = array())
	{
		if( ! empty($this->table) ) 
		{
			// Table yöntemi tanımlanmış ise
			// 1. parametre, 2. parametre olarak kullanılsın
			$condition = $table;
			$table = $this->table; 
			$this->table = NULL;
		}
		
		if( ! is_string($table) || empty($table) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'table'));
		}
		
		if( ! is_array($condition) ) 
		{
			return Error::set(lang('Error', 'arrayParameter', 'condition'));
		}
		
		if( $this->db->modifyColumn() !== false )
		{
			$modifyColumn = $this->db->modifyColumn();
		}
		else
		{
			$modifyColumn = 'MODIFY ';
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
			
			$con .= $modifyColumn.$column.$colvals.',';
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
	| Örnek Kullanım: $this->dbforge->renameColumn('OrnekTablo', array('sütun işlemleri'));  |
	|          																				  |
	| >>>>>>>>>>>>>>>>>>>>>>>>>>>Detaylı kullanım için zntr.net<<<<<<<<<<<<<<<<<<<<<<<<<<  	  |
	|          																				  |
	******************************************************************************************/
	public function renameColumn($table = '', $condition = array())
	{
		if( ! empty($this->table) ) 
		{
			// Table yöntemi tanımlanmış ise
			// 1. parametre, 2. parametre olarak kullanılsın
			$condition = $table;
			$table = $this->table; 
			$this->table = NULL;
		}
		
		if( ! is_string($table) || empty($table) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'table'));
		}
		
		if( ! is_array($condition) ) 
		{
			return Error::set(lang('Error', 'arrayParameter', 'condition'));
		}
		
		if( $this->db->renameColumn() !== false )
		{
			$renameColumn = $this->db->renameColumn();
		}
		else
		{
			$renameColumn = 'CHANGE COLUMN ';
		}
		
		$con = NULL;
		
		foreach( $condition as $column => $values )
		{
			$colvals = '';
			
			if( is_array($values) )
			{	
				foreach( $values as $val )
				{
					$colvals .= ' '.$val;
				}
			}
			else
			{
				$colvals .= ' '.$values;
			}
			
			$con .= $renameColumn.$column.$colvals.',';
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
		if( ! empty($this->table) ) 
		{
			// Table yöntemi tanımlanmış ise
			// 1. parametre, 2. parametre olarak kullanılsın
			$table = $this->table; 
			$this->table = NULL;
		}
		
		if( ! is_string($table) || empty($table) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'table'));
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
	public function differentConnection($connectName = '')
	{
		if( ! is_string($connectName) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'connectName'));
		}
		
		$config = Config::get('Database');
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
		
		return new DbForge($configDifferent[$connectName]);
	}
	
	/******************************************************************************************
	* ERROR                                                                                   *
	******************************************************************************************/
	public function error()
	{
		Error::set($this->db->error()); 
		return $this->db->error(); 
	}
	
	/******************************************************************************************
	* DESTRUCT                                                                                *
	******************************************************************************************/
	public function __destruct()
	{
		$this->db->close();	
	}
}