<?php
namespace ZN\FileSystem;

interface FolderInterface
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
	* CREATE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dizin oluşturmak için kullanılır.    				     			      |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @name => Oluşturulacak dizinin adı veya yolu.							  |
	| 2. string var @permission => Oluşturulacak dizinin yetki kodu							  |
	|          											  									  |
	| Örnek Kullanım: create('dizin/yeniDizin');        						              |
	|          																				  |
	******************************************************************************************/
	public function create($name, $permission, $recursive);
	
	/******************************************************************************************
	* CHANGE                                                                           		  *
	*******************************************************************************************
	| Genel Kullanım: Çalışma dizini değiştirmek için kullanılır.    	 		     		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @name => Değiştirilecek çalışma dizininin adı veya yolu.				  |
	|          											  									  |
	| Örnek Kullanım: $veri = changer('dizin/yeniDizin');        					          |
	|          																				  |
	******************************************************************************************/	
	public function change($name);
	
	/******************************************************************************************
	* RENAME                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dizinin adını değiştirmek için kullanılır.    				     	  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @oldname => Dizinin eski ismi.							  				  |
	| 2. string var @newname => Dizinin yeni ismi.							  				  |
	|          											  									  |
	| Örnek Kullanım: rename('dizin/eskiIsim', 'dizin/yeniIsim');        				      |
	|          																				  |
	******************************************************************************************/
	public function rename($oldName, $newName);
	
	/******************************************************************************************
	* DELETE EMPTY                                                                            *
	*******************************************************************************************
	| Genel Kullanım: İçi boş dizini silmek için kullanılır.    	 			     		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @name => Silinecek boş dizinin adı veya yolu.							  |
	|          											  									  |
	| Örnek Kullanım: $veri = deleteEmpty('dizin/yeniDizin');        					      |
	|          																				  |
	******************************************************************************************/
	public function deleteEmpty($name);
	
	/******************************************************************************************
	* COPY                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: İçi boş veya dolu bir dizini kopyalamak için kullanılır.    	 		  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @source => Hangi dizinin kopyalanacağını belirtir.			  		      |
	| 2. string var @target => Kopyalanan dizinin hangi yola yapıştırılacağı belirtir.        |
	|          											  									  |
	| Örnek Kullanım: $veri = copy('dizin/kaynakDizin', 'dizin/hedefDizin');        		  |
	|          																				  |
	******************************************************************************************/
	public function copy($source, $target);
	
	/******************************************************************************************
	* DELETE	                                                                              *
	*******************************************************************************************
	| Genel Kullanım: İçi dolu veya boş dizini silmek için kullanılır.    	 			      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @name => Silinecek dizinin adı veya yolu.							      |
	|          											  									  |
	| Örnek Kullanım: $veri = delete('dizin/yeniDizin');        					          |
	|          																				  |
	| Not: Bu yöntem bir dizinin içindeki diğer tüm verileride dizin ile birlikte silecektir. |
	|          																				  |
	******************************************************************************************/
	public function delete($name);
	
	/******************************************************************************************
	* FILES	                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Bir dizin içindeki dosya ve dizin listesini almak için kullanılır.      |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @path => Listesi alınacak dizinin adı veya yolu.						  |
	| 2. string var @extension => Listede hangi uzantılı dosyaların yer alacağıdır. Bu 		  |
	| parametre boş bırakılırsa tüm dosya ve dizinler listeye alınacaktır.         			  |
	|          											  									  |
	| Örnek Kullanım: $veri = files('dizin/', 'php'); // php uzantılı dosyaları listeler.     |
	| Örnek Kullanım: $veri = files('dizin/', 'dir'); // sadece dizinleri listeler.           |
	| Örnek Kullanım: $veri = files('dizin/'); // tüm dosya ve dizinleri listeler.            |
	|          																				  |
	******************************************************************************************/
	public function files($path, $extension);
	
	/******************************************************************************************
	* FILE INFO	                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Bir dizinin içerisinde yer alan dosyalar hakkında bilgi edinmek için	  |
	| kullanılır.																			  |
	|															                              |
	******************************************************************************************/
	public function fileInfo($dir, $extension);
	
	/******************************************************************************************
	* ALL FILES	                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Bir dizin içindeki dosya ve dizin listesini almak için kullanılır.      |
	| Bu yöntemin files() yönteminden farkı herhangi bir uzantı parametresinin olmamasıdır.	  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @pattern => Listesi alınacak dizinin adı veya yolu.	Varsayılan:*		  |
	|          											  									  |
	| Örnek Kullanım: $veri = allFiles('dizin/'); // tüm dosya ve dizinleri listeler.        |
	|          																				  |
	******************************************************************************************/
	public function allFiles($pattern, $allFiles);
	
	/******************************************************************************************
	* PERMISSION                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Dosya ve dizin yetkilerini düzenlemek için kullanılır.		     	  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @name => Yetki verilecek dosyanın ismi veya yolu.						  |
	| 2. numeric var @name => Dosyaya verilecek yetki kodu. Varsayılan:0755  	     	      |
	|          																				  |
	| Örnek Kullanım: permission('dizin/dosya.txt', 0755);        							  |
	|          																				  |
	******************************************************************************************/
	public function permission($name, $permission);
}