<?php
namespace ZN\FileSystem;

interface FileInterface
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
	* READ                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Dosya içeriğini okumak için kullanılır.						          |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @file => Okunacak dosyanın yolu.										  |
	|          																				  |
	******************************************************************************************/
	public function read(String $file);
	
	/******************************************************************************************
	* WRITE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Dosyaya veri yazmak için kullanılır.		     				          |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @file => Veri yazılacak dosyanın yolu.									  |
	| 2. string/numeric var @data => Dosyaya yazılacak veri.         			     	      |
	|          																				  |
	| Örnek Kullanım: write('dizin/dosya.txt', 'a');        								  |
	|          																				  |
	******************************************************************************************/
	public function write(String $file, $data);
	
	/******************************************************************************************
	* CONTENTS                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Dosya içeriğine erişmek için kullanılır.		     				      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @file => Veri okunacak dosyanın yolu.									  |
	|          																				  |
	| Örnek Kullanım: contents('dizin/dosya.txt');        									  |
	|          																				  |
	******************************************************************************************/
	public function contents(String $file);
	
	/******************************************************************************************
	* FIND                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Dosya içerisinde arama yapmak için kullanılır.    				      |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @file => Aranacak dosyanın yolu.									      |
	| 2. string var @data => Aranacak veri.								            	      |
	|          											  									  |
	| Örnek Kullanım: $veri = contents('dizin/dosya.txt', 'a');        						  |
	|          																				  |
	| Dönen Değerler: Object veri türünde 2 değer döner => index, contents        			  |
	| 1. $veri->index => Aranan veri bulunursa bulunan karakterin indeks numarasını verir.    |
	| 2. $veri->contents => Aranan veri bulunursa bulunan içerik döner.                       |
	|          																				  |
	******************************************************************************************/
	public function find(String $file, $data);
	
	/******************************************************************************************
	* CREATE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dosya oluşturmak için kullanılır.    				     			      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @name => Oluşturulacak dosyanın adı veya yolu.							  |
	|          											  									  |
	| Örnek Kullanım: create('dizin/yeniDosya.txt');        						          |
	|          																				  |
	******************************************************************************************/
	public function create(String $name);
	
	/******************************************************************************************
	* DELETE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dosya silmek için kullanılır.    	 			     			          |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @name => Silinecek dosyanın adı veya yolu.							      |
	|          											  									  |
	| Örnek Kullanım: $veri = delete('dizin/yeniDosya.txt');        						  |
	|          																				  |
	******************************************************************************************/
	public function delete(String $name);
	
	/******************************************************************************************
	* APPEND                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dosyaya veri yazmak için kullanılır.		     				          |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @file => Veri yazılacak dosyanın yolu.									  |
	| 2. string/numeric var @data => Dosyaya yazılacak veri.         			     	      |
	|          																				  |
	| Örnek Kullanım: append('dizin/dosya.txt', 'b');        								  |
	|          																				  |
	******************************************************************************************/
	public function append(String $file, $data);

	/******************************************************************************************
	* PERMISSION                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Dosyaya yetkilerini düzenlemek için kullanılır.		     			  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @name => Yetki verilecek dosyanın ismi veya yolu.						  |
	| 2. numeric var @name => Dosyaya verilecek yetki kodu.         			     	      |
	|          																				  |
	| Örnek Kullanım: permission('dizin/dosya.txt', 0755);        							  |
	|          																				  |
	******************************************************************************************/
	public function permission(String $file, Integer $permission);
	
	/******************************************************************************************
	* CREATE DATE                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Dosyanın oluşturulma tarihi bilgisine ulaşmak için kullanılır.		  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @file => Oluşturma bilgisi öğrenilecek dosyanın yolu.			  		  |
	| 2. string var @type => Oluşturulma tarihinin ne şekilde gösterileceğidir.         	  |
	|          																				  |
	| Örnek Kullanım: createDate('dizin/dosya.txt', 'd.m.Y');        						  |
	|          																				  |
	******************************************************************************************/
	public function createDate(String $file, $type);
	
	/******************************************************************************************
	* CHANGE DATE                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Dosyanın değiştirilme tarihi bilgisine ulaşmak için kullanılır.		  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @file => Değiştirme bilgisi öğrenilecek dosyanın yolu.			  		  |
	| 2. string var @type => Değiştirilme tarihinin ne şekilde gösterileceğidir.         	  |
	|          																				  |
	| Örnek Kullanım: changeDate('dizin/dosya.txt', 'd.m.Y');        						  |
	|          																				  |
	******************************************************************************************/
	public function changeDate(String $file, $type);
	
	/******************************************************************************************
	* INFO		                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Dosyanın hakkında bilgi almak için kullanılır.						  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @file => Bilgileri öğrenilecek dosyanın yolu.			  		          |
	|          																				  |
	| Örnek Kullanım: File::info('dizin/dosya.txt');        						          |
	|          																				  |
	| Dönen Değerler: basename, size, date, readable, writable, executable, permission        |
	|          																				  |
	******************************************************************************************/
	public function info(String $file);
	
	/******************************************************************************************
	* SIZE		                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Dosyanın boyutunu öğrenmek için kullanılır.							  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @file => Boyutu öğrenilecek dosyanın yolu.			  		              |
	| 2. string var @type => Boyutun ne şekilde gösterileceğidir.         	                  |
	|          																				  |
	| Örnek Kullanım: size('dizin/dosya.txt', 'b');        						              |
	|          																				  |
	| Type parametresi için kullanılabilir değerler        									  |
	| 1. b => byte cinsinden         														  |
	| 2. kb => kilo byte cinsinden değer döndürür.       									  |
	| 3. mb => mega byte cinsinden değer döndürür.          								  |
	| 4. gb => giga byte cinsinden değer döndürür.          								  |
	|          																				  |
	******************************************************************************************/
	public function size(String $file, $type, $decimal);

	
	/******************************************************************************************
	* ZIP EXTRACT		                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Zip dosyanı çıkarmak için kullanılır.							          |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @source => Çıkartılacak zip dosyasının yolu.			  		          |
	| 2. string var @target => Çıkartma işleminin hangi dizine yapılacağı.         	          |
	|          																				  |
	| Örnek Kullanım: source('kaynak/dosya.zip', 'hedef/dizin');        				      |
	|          																				  |
	******************************************************************************************/
	public function zipExtract(String $source, String $target);
	
	
	//----------------------------------------------------------------------------------------------------
	// createZip()
	//----------------------------------------------------------------------------------------------------
	//
	// @param  string $path empty
	// @param  array  $data empty
	// @return bool
	//
	//----------------------------------------------------------------------------------------------------
	public function createZip(String $path, Array $data);
	
	/******************************************************************************************
	* LIMIT                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Dosyayı boyutlandırmak için kullanılır.		     				      |											
	|          																				  |
	******************************************************************************************/
	public function limit(String $file, $limit, $mode);
	
	/******************************************************************************************
	* RENAME                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dosyanın ismini değiştirmek için kullanılır.	     				      |											
	|          																				  |
	******************************************************************************************/
	public function rename(String $oldName, String $newName);

	/******************************************************************************************
	* CLEAN CACHE                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Silinen dosyanın ön bellekten kaldırılması için oluşturulmuştur.        |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. boolean var @real => Gerçek ön bellekten silinip silinemeyeceği.					  |
	| 1. string var @fileName => Ön bellekten silinmesi istenen dosya.		     			  |
	|          											  									  |
	| Örnek Kullanım: $veri = delete('dizin/yeniDosya.txt');        						  |
	|          																				  |
	******************************************************************************************/
	public function cleanCache(String $fileName, $real);	
	
	/******************************************************************************************
	* FILE OWNER                                                                              *
	*******************************************************************************************
	| Genel Kullanım:  Dosya sahibini döndürür.		  										  |
	|     														                              |
	******************************************************************************************/
	public function owner(String $file);
	
	/******************************************************************************************
	* FILE GROUP                                                                              *
	*******************************************************************************************
	| Genel Kullanım:  Dosya sahib grubunu döndürür.		  								  |
	|     														                              |
	******************************************************************************************/
	public function group(String $file);
	
	//----------------------------------------------------------------------------------------------------
	// rowCount()
	//----------------------------------------------------------------------------------------------------
	//
	// @param  string $file      /
	// @param  bool   $recursive true
	// @return numeric
	//
	//----------------------------------------------------------------------------------------------------
	public function rowCount(String $file, $recursive);
}