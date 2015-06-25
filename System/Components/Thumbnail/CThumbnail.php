<?php
/************************************************************/
/*                   THUMBNAIL COMPONENT                    */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
namespace Thumbnail;

use Image;
/******************************************************************************************
* THUMBNAIL                                                                               *
*******************************************************************************************
| Sınıfı Kullanırken      :	$this->cthumbnail->     					     			  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/
class CThumbnail
{
	/* Setingss Değişkeni
	 *  
	 * Resim işlemeleri ayar bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	 protected $sets;
	
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
	public function path($file = '')
	{
		if( ! is_string($file) )
		{
			return $this;	
		}
	
		if( ! empty($file) )
		{
			$this->sets['filepath'] = $file;
		}
		
		return $this;
	}
	
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
	public function quality($quality = 0)
	{
		if( ! is_numeric($quality) )
		{
			return $this;	
		}
	
		if( ! empty($quality) )
		{
			$this->sets['quality'] = $quality;
		}
		
		return $this;
	}
	
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
	public function crop($x = 0, $y = 0)
	{
		if( ! ( is_numeric($x) && is_numeric($y) ) )
		{
			return $this;	
		}
	
		if( ! empty($x) )
		{
			$this->sets['x'] = $x;
		}
		
		if( ! empty($y) )
		{
			$this->sets['y'] = $y;
		}
		
		return $this;
	}
	
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
	public function size($width = 0, $height = 0)
	{
		if( ! ( is_numeric($width) && is_numeric($height) ) )
		{
			return $this;	
		}
	
		if( ! empty($width) )
		{
			$this->sets['width'] = $width;
		}
		
		if( ! empty($height) )
		{
			$this->sets['height'] = $height;
		}
		
		return $this;
	}
	
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
	public function resize($width = 0, $height = 0)
	{
		if( ! ( is_numeric($width) && is_numeric($height) ) )
		{
			return $this;	
		}
	
		if( ! empty($width) )
		{
			$this->sets['rewidth'] = $width;
		}
		
		if( ! empty($height) )
		{
			$this->sets['reheight'] = $height;
		}
		
		return $this;
	}
	
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
	public function prosize($width = 0, $height = 0)
	{
		if( ! ( is_numeric($width) && is_numeric($height) ) )
		{
			return $this;	
		}
	
		if( ! empty($width) )
		{
			$this->sets['prowidth'] = $width;
		}
		
		if( ! empty($height) )
		{
			$this->sets['proheight'] = $height;
		}
		
		return $this;
	}
	
	
	/******************************************************************************************
	* CREATE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Resmi ölçeklendirip ölçeklenen yeni resmin yolunu verir.  	          |
	|															                              |
	| Parametreler: tek parametresi vardır.                                              	  |
	| 1. string var @fpath => Ölçeklendirilmek istenen resim.	  						      |
	|          																				  |
	******************************************************************************************/	
	public function create($fpath = '')
	{
		if( isset($this->sets['filepath']) )
		{
			$path = $this->sets['filepath'];	
		}
		
		return Image::thumb($path, $this->sets);
	}
	
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
	public function getProsize($width = 0, $height = 0)
	{
		return Image::getProsize($width, $height);
	}
	
	/******************************************************************************************
	* ERROR                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Image işlemlerinde oluşan hata bilgilerini tutması için oluşturulmuştur.|
	|     														                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|     														                              |
	******************************************************************************************/
	public function error()
	{
		return Image::error();
	}
}
