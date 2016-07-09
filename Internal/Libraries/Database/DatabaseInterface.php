<?php
namespace ZN\Database;

interface DatabaseInterface
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
	public function table($table);
	
	/******************************************************************************************
	* COLUMN                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Sütun ve değerini ayarlamak için kullanılır.		                 	  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @col => Sütun adı.                    				                      |
	| 1. string var @val => Sütun değeri.	  	 	                                          |
	|          																				  |
	| Örnek Kullanım: ->table('OrnekTablo')		        									  |
	|          																				  |
	******************************************************************************************/
	public function column($col, $val);
	
	/******************************************************************************************
	* STRING QUERY                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Sorgunun dizgesini almak için kullanılır.				     			  |
	|          																				  |
	******************************************************************************************/
	public function stringQuery();
	
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
	public function differentConnection($connectName);
	
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
	public function secure($data);
	
	/******************************************************************************************
	* FUNC                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Select ile kullanılan herhangi bir fonksiyon oluşturmak içindir.		  |
	
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function func();
	
	/******************************************************************************************
	* ERROR                                                                                   *
	******************************************************************************************/
	public function error();
	
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
	public function close();
	
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
	public function version();
}