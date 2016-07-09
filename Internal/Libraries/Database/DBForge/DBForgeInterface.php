<?php
namespace ZN\Database;

interface DBForgeInterface
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
	public function createDatabase($dbname);
	
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
	public function dropDatabase($dbname);
	
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
	public function createTable($table, $condition, $extras);
	
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
	public function dropTable($table);
	
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
	public function alterTable($table, $condition);
	
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
	public function renameTable($name, $newName);
	
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
	public function addColumn($table, $condition);
	
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
	public function dropColumn($table, $column);
	
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
	public function modifyColumn($table, $condition);
	
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
	public function renameColumn($table, $condition);
	
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
	public function truncate($table);
}