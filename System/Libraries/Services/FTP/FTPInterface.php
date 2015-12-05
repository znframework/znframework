<?php
interface FTPInterface
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
	* CONNECT                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Ftp bağlantısını gerçekleştirmek için kullanılır.    				      |
	|															                              |
	| Parametreler: Tek dizi parametresi vardır.		                                      |
	| 1. array var @con => Bağlantı parametrelerini içeren dizi parametresidir.	  			  |
	| Bu yöntem kullanılmazsa bağlantı Config/Ftp.php dosyasındaki ayarlara göre yapılacaktır.|
	| Bu nedenle kullanımı zorunlu değildir.         										  |
	|          																				  |
	| Örnek Kullanım: connect(array('host' => 'localhost', 'user' => 'zntr' ...));        	  |
	| 																			       		  |
	| Bağlantı Dizisi Parametreleri         												  |
	| 1.host         																		  |
	| 2.user         																		  |
	| 3.password         																	  |
	| 4.port = 21        																	  |
	| 5.timeout = 90         																  |
	| 6.ssl_connect = false         														  |
	|         																		          |
	******************************************************************************************/	
	public function connect($con);
	
	/******************************************************************************************
	* CLOSE                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Ftp bağlantısını kapatmak için kullanılır.    				          |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.		                                  |
	|          																				  |
	| Örnek Kullanım: close();        	  												      |
	|         																		          |
	******************************************************************************************/	
	public function close();
	
	/******************************************************************************************
	* CREATE FOLDER                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Dizin oluşturmak için kullanılır.    				     			      |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @name => Oluşturulacak dizinin adı veya yolu.							  |
	| 2. string var @permission => Oluşturulacak dizinin yetki kodu							  |
	|          											  									  |
	| Örnek Kullanım: createFolder('dizin/yeniDizin');        						          |
	|          																				  |
	******************************************************************************************/
	public function createFolder($path);
	
	/******************************************************************************************
	* DELETE FOLDER                                                                           *
	*******************************************************************************************
	| Genel Kullanım: İçi boş dizini silmek için kullanılır.    	 			     		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @name => Silinecek boş dizinin adı veya yolu.							  |
	|          											  									  |
	| Örnek Kullanım: deleteFolder('dizin/yeniDizin');        					              |
	|          																				  |
	******************************************************************************************/
	public function deleteFolder($path);
	
	/******************************************************************************************
	* CHANGE FOLDER                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Çalışma dizini değiştirmek için kullanılır.    	 		     		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @name => Değiştirilecek çalışma dizininin adı veya yolu.				  |
	|          											  									  |
	| Örnek Kullanım: changeFolder('dizin/yeniDizin');        				         	      |
	|          																				  |
	******************************************************************************************/	
	public function changeFolder($path);
	
	/******************************************************************************************
	* RENAME                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dizi veya dosyanın adını değiştirmek için kullanılır.    				  |
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
	* DELETE  FILE                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Dosya silmek için kullanılır.    	 			     			          |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @name => Silinecek dosyanın adı veya yolu.							      |
	|          											  									  |
	| Örnek Kullanım: deleteFile('dizin/yeniDosya.txt');        			     	          |
	|          																				  |
	******************************************************************************************/
	public function deleteFile($path);
	
	/******************************************************************************************
	* UPLOAD                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Sunucuya dosya yüklemek için kullanılır.    	 			     		  |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @local_path => Yerelden sunucuya yüklenecek dosya yolu.					  |
	| 2. string var @remote_path => Dosyanın yükleneceği sunucudaki dizinin yolu              |
	| 3. string var @type => Veri aktarım tipi. Varsayılan:ascii. ascii veya binary           |
	|          											  									  |
	| Örnek Kullanım: upload('yerel/yeniDosya.txt', 'sunucu/dizin', 'binary');                |
	|          																				  |
	******************************************************************************************/
	public function upload($localPath, $remotePath, $type);
	
	/******************************************************************************************
	* DOWNLOAD                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Sunucudan dosya indirmek için kullanılır.    	 			     		  |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @remote_path => Dosyanın indirileceği sunucudaki dosyanın yolu            |
	| 2. string var @local_path => Dosyanın indirileceği yereldeki dizin yolu.			      |
	| 3. string var @type => Veri aktarım tipi. Varsayılan:ascii. ascii veya binary           |
	|          											  									  |
	| Örnek Kullanım: download('sunucu/yeniDosya.txt', 'yerel/dizin', 'binary');              |
	|          																				  |
	******************************************************************************************/
	public function download($remotePath, $localPath, $type);
	
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
	public function permission($path, $type);
	
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
	* FILE SIZE		                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Dosyanın boyutunu öğrenmek için kullanılır.							  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @file => Boyutu öğrenilecek dosyanın yolu.			  		              |
	| 2. string var @type => Boyutun ne şekilde gösterileceğidir.         	                  |
	|          																				  |
	| Örnek Kullanım: fileSize('dizin/dosya.txt', 'b');        						      |
	|          																				  |
	| Type parametresi için kullanılabilir değerler        									  |
	| 1. b => byte cinsinden         														  |
	| 2. kb => kilo byte cinsinden değer döndürür.       									  |
	| 3. mb => mega byte cinsinden değer döndürür.          								  |
	| 4. gb => giga byte cinsinden değer döndürür.          								  |
	|          																				  |
	******************************************************************************************/
	public function fileSize($path, $type, $decimal);
}