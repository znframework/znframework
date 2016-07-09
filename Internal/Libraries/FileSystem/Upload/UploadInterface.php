<?php
namespace ZN\FileSystem;

interface UploadInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	public function settings($set);

	/******************************************************************************************
	* EXTENSIONS                                                                      		  *
	*******************************************************************************************
	| Genel Kullanım: Yüklenecek dosya uzantılarını ayarlamak için kullanılır.  			  |
	|															                              |
	| Parametreler: Argüment parametresi vardır.                                              |
	| 1. argumentts var @extensions => Belirtilecek uzantılar.  			  			      |
	|          																				  |
	| Örnek Kullanım: ->extension('exe', 'jpg', 'gif')            							  |
	|          																				  |
	******************************************************************************************/
	public function extensions();
	
	/******************************************************************************************
	* CONVERT NAME                                                                    		  *
	*******************************************************************************************
	| Genel Kullanım: Dosya isminde yer alan yabancı karaketerleri çevirsin mi?.  			  |
	|															                              |
	| Parametreler: Mantıksal parametresi vardır.                                             |
	| 1. boolean var @convert => Dçnüştürmenin uygulanıp uygulanmayacağı.   			      |
	|          																				  |
	| Örnek Kullanım: ->extension('exe', 'jpg', 'gif')            							  |
	|          																				  |
	******************************************************************************************/
	public function convertName($convert);
	
	/******************************************************************************************
	* ENCODE                                                                           		  *
	*******************************************************************************************
	| Genel Kullanım: Dosya ismi şifrelenmesi için kullanılır.	      						  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @hash => Şifreleme algoritmalarından biri. Varsayılan:md5    		  	  |
	|          																				  |
	| Örnek Kullanım: ->encode(UPLOADS_DIR.'ornek.jpg')            							  |
	|          																				  |
	******************************************************************************************/
	public function encode($hash);
	
	/******************************************************************************************
	* PREFIX                                                                           		  *
	*******************************************************************************************
	| Genel Kullanım: Dosya isminin başına ön ek getirilmesi için kullanılır.   			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @prefix => Ön ek.									         		  	  |
	|          																				  |
	| Örnek Kullanım: ->prefix('onek_')				            							  |
	|          																				  |
	******************************************************************************************/
	public function prefix($prefix);
	
	/******************************************************************************************
	* MAXSIZE                                                                         		  *
	*******************************************************************************************
	| Genel Kullanım: Dosyanın yüklenebilir maksimum boyutunu ayarlamak için kullanılır.      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @maxsize => Byte cinsinden boyut değeri.			         		  	  |
	|          																				  |
	| Örnek Kullanım: ->maxsize(2048) // 2048 Bytes	            						      |    
	|          																				  |
	******************************************************************************************/
	public function maxsize($maxsize);
	
	/******************************************************************************************
	* ENCODE LENGTH                                                               		  *
	*******************************************************************************************
	| Genel Kullanım: Şifrelenmiş ön ekin karakter uzunluğunu ayarlamak için kullanılır.      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @encodeLength => Karakter uzunluğu.			         		  	  |
	|          																				  |
	| Örnek Kullanım: ->encodeLength(20)	            						      |    
	|          																				  |
	******************************************************************************************/
	public function encodeLength($encodeLength);
	
	/******************************************************************************************
	* TARGET                                                                         		  *
	*******************************************************************************************
	| Genel Kullanım: Dosyanın nereye yükleneceğini belirtmek için kullanılır.		          |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @target => Dosyaların yükleneceği dizin. Varsayılan:UPLOADS_DIR	  	      |
	|          																				  |
	| Örnek Kullanım: ->target('Uploads/') // 2048 Bytes	            					  |    
	|          																				  |
	******************************************************************************************/
	public function target($target);
	
	/******************************************************************************************
	* SOURCE                                                                         		  *
	*******************************************************************************************
	| Genel Kullanım: Dosyaların yükleneceği input file nesnesinin ismi.      				  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @target => Dosyaların alınacağı input file nesnesinin ismi.			      |
	|          																				  |
	| Örnek Kullanım: ->source('FILEUPLOAD') // <input type="file" name="FILEUPLOAD">	      |    
	|          																				  |
	******************************************************************************************/
	public function source($source);
	
	/******************************************************************************************
	* START                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Dosya yükleme işlemini başlatmak için kullanılır.				          |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @filename => Yükleme yapılacak <input="file"> nesnesinin name değeri.	  |
	| 2. [ string var @rootdir ] => Dosyanın kaydedileceği dizin. Varsayılan:Uploads/	      |
	|          																				  |
	| Örnek Kullanım: start('fileupload', 'Aplication/Uploads');       		                  |
	|          																				  |
	******************************************************************************************/
	public  function start($fileName, $rootDir);
	
	/******************************************************************************************
	* INFO                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Dosya yükleme işlemleri hakkında bilgi almak için kullanılır.			  |
	| Object veri türünde çıktı üretir.												          |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: $info = info();       		                  						  |
	| $info->name -> dosyanın adı      														  |  
	| $info->type -> dosyanın tipi        													  |
	| $info->size -> dosyanın boyutu      													  |
	| $info->error -> dosya yükleme sırasında hata var ise 1 değeri alır.        			  |
	| $info->tmpName -> dosyanın tmp dizinindeki ismi.        								  |
	| $info->encodeName -> şifrelenen ismi.      											  |
	|          																				  |
	******************************************************************************************/
	public function info($info);
	
	/******************************************************************************************
	* ERROR                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Dosya işlemlerinde oluşan hata bilgilerini tutması için oluşturulmuştur.|
	|     														                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|     														                              |
	******************************************************************************************/
	public function error();
}