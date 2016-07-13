<?php
namespace ZN\ImageProcessing;

class InternalThumb implements ThumbInterface
{
	/***********************************************************************************/
	/* THUMBNAIL COMPONENT    	     		                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	/*
	/* Sınıf Adı: Thumb
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: Thumb::, $this->Thumb, zn::$use->Thumb, uselib('Thumb')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* Setingss Değişkeni
	 *  
	 * Resim işlemeleri ayar bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $sets;
	 
	use \CallUndefinedMethodTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Error Control
	//----------------------------------------------------------------------------------------------------
	// 
	// $error
	// $success
	//
	// error()
	// success()
	//
	//----------------------------------------------------------------------------------------------------
	use \ErrorControlTrait;
	
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
			\Errors::set('Error', 'stringParameter', 'file');
			return $this;	
		}
	
		if( ! empty($file) )
		{
			$this->sets['filePath'] = $file;
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
			\Errors::set('Error', 'numericParameter', 'quality');
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
		if( ! is_numeric($x) || ! is_numeric($y) )
		{
			\Errors::set('Error', 'numericParameter', 'x & y');
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
		if( ! is_numeric($width) || ! is_numeric($height) )
		{
			\Errors::set('Error', 'numericParameter', 'width & height');
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
		if( ! is_numeric($width) || ! is_numeric($height) )
		{
			\Errors::set('Error', 'numericParameter', 'width & height');
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
		if( ! is_numeric($width) || ! is_numeric($height) )
		{
			\Errors::set('Error', 'numericParameter', 'width & height');
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
		if( isset($this->sets['filePath']) )
		{
			$path = $this->sets['filePath'];	
		}
		
		return \Image::thumb($path, $this->sets);
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
		if( ! isset($this->sets['filePath']) )
		{
			return false;	
		}
		
		return \Image::getProsize($this->sets['filePath'], $width, $height);
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
		return \Image::error();
	}
}
