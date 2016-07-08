<?php
namespace ZN\ImageProcessing;

interface ThumbInterface
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
	* PATH                                                                           		  *
	*******************************************************************************************
	| Genel Kullanım: İşlem görecek resim dosyasının yolu.	      							  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @file => Resmin yolu.  			  									  	  |
	|          																				  |
	| Örnek Kullanım: ->path(UPLOADS_DIR.'ornek.jpg')            							  |
	|          																				  |
	******************************************************************************************/
	public function path($file);
	
	/******************************************************************************************
	* QUALITY                                                                         		  *
	*******************************************************************************************
	| Genel Kullanım: Resmin kalitesini ayarlamak için kullanılır.	        				  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @quality => Resmin yolu.  			  									  |
	|          																				  |
	| Örnek Kullanım: ->quality(80)            							  					  |
	|          																				  |
	******************************************************************************************/
	public function quality($quality);
	
	/******************************************************************************************
	* CROP                                                                           		  *
	*******************************************************************************************
	| Genel Kullanım: Kırpılacak resimde x ve ye değerlerini belirtmek için kullanılır.	      |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. numeric var @x => Yatay düzlemde kırpmaya kaçıncı pikselden başlanacağı.  			  |
	| 2. numeric var @y => Dikey düzlemde kırpmaya kaçıncı pikselden başlanacağı.  			  |
	|          																				  |
	| Örnek Kullanım: ->crop(60, 10)            								      		  |
	|          																				  |
	******************************************************************************************/
	public function crop($x, $y);
	
	/******************************************************************************************
	* SIZE                                                                           		  *
	*******************************************************************************************
	| Genel Kullanım: Resmin boyutunu ayarlamak için kullanılır.     						  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. numeric var @width => Resmin genişlik değeri.  			  						  |
	| 2. numeric var @height => Resmin yükseklik değeri.  			  						  |
	|          																				  |
	| Örnek Kullanım: ->size(60, 10)            								      		  |
	|          																				  |
	******************************************************************************************/
	public function size($width, $height);
	
	/******************************************************************************************
	* RESIZE                                                                           		  *
	*******************************************************************************************
	| Genel Kullanım: Yeniden boyutlandırılacak resmin genişlik ve yükseklik değelerini 	  |
	| ayarlamak için kullanılır.	      													  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. numeric var @width => Resmin genişlik değeri.  			  						  |
	| 2. numeric var @height => Resmin yükseklik değeri.  			  						  |
	|          																				  |
	| Örnek Kullanım: ->resize(60, 10)            								      		  |
	|          																				  |
	******************************************************************************************/
	public function resize($width, $height);
	
	/******************************************************************************************
	* PROSIZE                                                                           	  *
	*******************************************************************************************
	| Genel Kullanım: Orantılı boyutlandırılacak resmin genişlik ve yükseklik değelerini 	  |
	| ayarlamak için kullanılır.	      													  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. numeric var @width => Resmin genişlik değeri.  			  						  |
	| 2. numeric var @height => Resmin yükseklik değeri.  			  						  |
	|          																				  |
	| Örnek Kullanım: ->prosize(60, 10)            								      		  |
	|          																				  |
	******************************************************************************************/
	public function prosize($width, $height);
	
	/******************************************************************************************
	* CREATE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Resmi ölçeklendirip ölçeklenen yeni resmin yolunu verir.  	          |
	|															                              |
	| Parametreler: tek parametresi vardır.                                              	  |
	| 1. string var @fpath => Ölçeklendirilmek istenen resim.	  						      |
	|          																				  |
	******************************************************************************************/	
	public function create($fpath);
	
	/******************************************************************************************
	* GET PROSIZE                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Yolu belirtilen dosyanın boyutunu verilen genişlik veya yükseklik 	  |
	| değerine göre orantılı şekilde almak için kullanılır.  	                              |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @fpath => Boyutu istenen resim dosyasının yolu.	  						  |
	| 2. numeric var @width => Resmin genişlik ölçüsünün belirlenmesi.	                      |
	| 3. numeric var @height => Resmin yükseklik ölçüsünün belirlenmesi.	                  |
	|          																				  |
	| Örnek Kullanım: size('ornek/resim.jpg', 10);        	  		                          |      
	|          																				  |
	| Not: Genişlik veya yükseklik parametrelerinden sadece bir tanesi kullanılmalıdır.       |
	|          																				  |
	******************************************************************************************/	
	public function getProsize($width, $height);
	
	/******************************************************************************************
	* ERROR                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Image işlemlerinde oluşan hata bilgilerini tutması için oluşturulmuştur.|
	|     														                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|     														                              |
	******************************************************************************************/
	public function error();
}
