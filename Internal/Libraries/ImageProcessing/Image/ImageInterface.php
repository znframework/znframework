<?php
namespace ZN\ImageProcessing;

interface ImageInterface
{
	/***********************************************************************************/
	/* IMAGE LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	/*
	/* Sınıf Adı: Image
	/* Versiyon: 1.0
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: image::, $this->image, zn::$use->image, uselib('image')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/******************************************************************************************
	* THUMB                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Resmi ölçeklendirip ölçeklenen yeni resmin yolunu verir.  	          |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @fpath => Ölçeklendirilmek istenen resim.	  						      |
	| 2. array var @settings => Resim üzerinde değişiklik yapmayı sağlayan ayarlar.	          |
	|          																				  |
	| Örnek Kullanım: thumb('ornek/resim.jpg', array(Ayarlar));        	  		              |      
	|          																				  |
	| 2. Ayarlar Parametresinin Kullanılabilir Parametreleri.         						  |
	|																						  |
	| 1. x => Resmi yatay düzlemde kaçıncı pixelden kırpmaya başlayacağını ifade eder.        |
	| 2. y => Resmi dikey düzlemde kaçıncı pixelden kırpmaya başlayacağı ifade eder.          |
	| 3. width => Resmin kırpma genişliğini belirlemek için kullanılır.                       |
	| 4. height => Resmin kırpma yüksekliğini belirlemek için kullanılır.                     |
	| 5. rewidth => Resmin yeni genişlik değer ayarlanır.                                     |
	| 6. reheight => Resmin yeni yükseklik değer ayarlanır.                                   |
	| 7. prowidth  => Eğer genişlik fazla ise bu ayara göre resmin yükseklik değeri otomatik  |
	| olarak orantılı ayarlanır.                                  							  |
	| 8. proheight => Eğer yükseklik fazla ise bu ayara göre resmin genişlik değeri otomatik  |
	| olarak orantılı ayarlanır.                                   				              |
	| 9. quality  => Resmin kalitesini ayarlamak için kullanılır.                             |
	|          																				  |
	******************************************************************************************/	
	public function thumb($fpath, $set);
	
	/******************************************************************************************
	* SIZE                                                                                    *
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
	public function getProsize($path, $width, $height);
	
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