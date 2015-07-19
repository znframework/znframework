<?php
class __USE_STATIC_ACCESS__CCaptcha
{
	/***********************************************************************************/
	/* CAPTCHA COMPONENT         		                   	                           */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: CCaptcha
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: $this->ccaptcha, zn::$use->ccaptcha, uselib('ccaptcha')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* Settings Değişkeni
	 *  
	 * Güvenlik kodu nesnesine ait
	 * ayarlar bilgilerini tutması
	 * için oluşturulumuştur.
	 */
	protected $sets = array();
	
	/******************************************************************************************
	* WIDTH                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Güvenlik kodu nesnesinin genişlik değeri belirtilir.					  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @param => Güvenlik kod nesnesinin genişliği.					          |
	|          																				  |
	| Örnek Kullanım: ->width(100)         													  |
	|          																				  |
	******************************************************************************************/
	public function width($param = 0)
	{
		if( ! is_numeric($param) )
		{
			return $this;	
		}
		
		if( ! empty($param) )
		{
			$this->sets['width'] = $param;
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* HEIGHT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Güvenlik kodu nesnesinin yükseklik değeri belirtilir.					  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @param => Güvenlik kod nesnesinin yüksekliği.					          |
	|          																				  |
	| Örnek Kullanım: ->height(20)         													  |
	|          																				  |
	******************************************************************************************/
	public function height($param = 0)
	{
		if( ! is_numeric($param) )
		{
			return $this;	
		}
		
		if( ! empty($param) )
		{
			$this->sets['height'] = $param;
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* SIZE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Güvenlik kodu nesnesinin genişlikk ve yükseklik değeri belirtilir.      |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. numeric var @width => Güvenlik kod nesnesinin genişliği.					          |
	| 2. numeric var @height => Güvenlik kod nesnesinin yüksekliği.					          |
	|          																				  |
	| Örnek Kullanım: ->size(100, 20)         												  |
	|          																				  |
	******************************************************************************************/
	public function size($width = 0, $height = 0)
	{
		$this->width($width);
		$this->height($height);
		
		return $this;
	}
	
	/******************************************************************************************
	* LENGTH                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Güvenlik kodu nesnesinin kaç karakterden olacağı belirtilir.		      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @param => Güvenlik kod nesnesinin karakter uzunluğu.	     	          |
	|          																				  |
	| Örnek Kullanım: ->length(6)            												  |
	|          																				  |
	******************************************************************************************/
	public function length($param = 0)
	{
		if( ! is_numeric($param) )
		{
			return $this;	
		}
		
		if( ! empty($param) )
		{
			$this->sets['charLength'] = $param;
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* BORDER                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Güvenlik kodu nesnesinin çerçevesinin olup olmayacağı olacaksa da hangi.|		      
	| hangi renkte olacağı belirtilir.												          |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. boolean var @is => Çerçeve olsun mu? True ayarlanması durumunda çerçeve oluşturulur. |
	| 2. string var @color => Çerçeve rengi belirtilir. RGB standartına uygun renk değerleri 
	| yazılır. Örnek 255|10|180 gibi renkler yazılırken aralarına dik çizgi(|) ilave edilir.  |
	|          																				  |
	| Örnek Kullanım: ->border(true, '255|10|180')            								  |
	|          																				  |
	******************************************************************************************/
	public function border($is = true, $color = '')
	{
		if( ! ( is_bool($is) && is_string($color) ) )
		{
			return $this;	
		}
		
		$this->sets['border'] = $is;
		
		if( ! empty($color) )
		{
			$this->sets['borderColor'] = $color;
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* BORDER COLOR                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Güvenlik kodu çerçeve rengini ayarlamak için kullanılır.				  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 2. string var @color => Çerçeve rengi belirtilir. RGB standartına uygun renk değerleri  |
	| yazılır. Örnek 255|10|180 gibi renkler yazılırken aralarına dik çizgi(|) ilave edilir.  |
	|          																				  |
	| Örnek Kullanım: ->border_color('255|10|180')            								  |
	|          																				  |
	******************************************************************************************/
	public function borderColor($color = '')
	{
		if( ! is_string($color) )
		{
			return $this;	
		}

		if( ! empty($color) )
		{
			$this->sets['borderColor'] = $color;
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* BACKGROUND COLOR                                                                        *
	*******************************************************************************************
	| Genel Kullanım: Güvenlik kodu arkaplan rengini ayarlamak için kullanılır.				  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @color => Arkaplan rengi belirtilir. RGB standartına uygun renk değerleri |
	| yazılır. Örnek 255|10|180 gibi renkler yazılırken aralarına dik çizgi(|) ilave edilir.  |
	|          																				  |
	| Örnek Kullanım: ->bgColor('255|10|180')            								      |
	|          																				  |
	******************************************************************************************/
	public function bgColor($color = '')
	{
		if( ! is_string($color) )
		{
			return $this;	
		}
		
		if( ! empty($color) )
		{
			$this->sets['bgColor'] = $color;
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* BACKGROUND IMAGE                                                                        *
	*******************************************************************************************
	| Genel Kullanım: Güvenlik kodu arkaplan resimleri ayarlamak için kullanılır.			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 2. string/array var @image => Arkplana resimler eklemek için kullanılır. Tek bir resim  |
	| resim eklenecekse string türde parametre girilebilir. Ancak çoklu resim eklenmesi       |
	| isteniyorsa bu durumda dizi türünde parametre girilir.  								  |
	|          																				  |
	| Örnek Kullanım: ->bgImage('255|10|180')            								      |
	|          																				  |
	******************************************************************************************/
	public function bgImage($image = array())
	{
		if( ! empty($image) )
		{
			if( is_string($image) )
			{
				$this->sets['background'] = array($image);
			}
			elseif( is_array($image) )
			{
				$this->sets['background'] = $image;	
			}
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* BACKGROUND                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Güvenlik kodu arkaplan rengini veya resimlerini ayarlamak için 		  |
	| kullanılır. Bgimage ve bgcolor yöntemlerinin alternatifidir.					  		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 2. string/array var @image => Arkplana resimler eklemek için kullanılır. Tek bir resim  |
	| resim eklenecekse string türde parametre girilebilir. Ancak çoklu resim eklenmesi       |
	| isteniyorsa bu durumda dizi türünde parametre girilir.  								  |
	|          																				  |
	| Örnek Kullanım: ->background('255|10|180') // Arkplan rengi          					  |
	| Örnek Kullanım: ->background('a/b.jpg') // Arkaplan resmi          					  |
	| Örnek Kullanım: ->background(array('a/b1.jpg', 'a/b2.jpg')) // Arkaplan resimleri       |
	|          																				  |
	******************************************************************************************/
	public function background($background = '')
	{
		if( is_string($background) && ! is_file($background) )
		{
			$this->bgColor($background);
		}
		else
		{
			$this->bgImage($background);	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* TEXT SIZE                                                                   			  *
	*******************************************************************************************
	| Genel Kullanım: Güvenlik kodu metninin boyutunu ayarlamak içindir.	 				  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @size => Metnin boyutudur.  								  			  |
	|          																				  |
	| Örnek Kullanım: ->textSize(5)            								      			  |
	|          																				  |
	******************************************************************************************/
	public function textSize($size = 0)
	{
		if( ! is_numeric($size) )
		{
			return $this;
		}
		
		if( ! empty($size) )
		{
			$this->sets['imageString']['size'] = $size;
		}
		
		return $this;
	}
		
	/******************************************************************************************
	* CORDINATE                                                                        		  *
	*******************************************************************************************
	| Genel Kullanım: Güvenlik kodu metninin koordinatlarını ayarlamak için kullanılır.	      |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. numeric var @x => Metnin yatay düzlemdeki değeri.  								  |
	| 2. numeric var @y => Metnin dikey düzlemdeki değeri.  								  |
	|          																				  |
	| Örnek Kullanım: ->textCoordinate(60, 10)            								      |
	|          																				  |
	******************************************************************************************/
	public function textCoordinate($x = 0, $y)
	{
		if( ! is_numeric($x) || ! is_numeric($y) )
		{
			return $this;
		}

		if( ! empty($x) ) 
		{
			$this->sets['imageString']['x'] = $x;
		}
		
		if( ! empty($y) )
		{ 
		 	$this->sets['imageString']['y'] = $y;
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* TEXT COLOR                                                                      		  *
	*******************************************************************************************
	| Genel Kullanım: Güvenlik kodu metninin rengini ayarlamak için kullanılır.	              |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @color => Yazının rengi belirtilir. RGB standartına uygun renk değerleri  |
	| yazılır. Örnek 255|10|180 gibi renkler yazılırken aralarına dik çizgi(|) ilave edilir.  |
	| Örnek Kullanım: ->textColor('90|10|30')            								      |
	|          																				  |
	******************************************************************************************/
	public function textColor($color = '')
	{
		if( ! is_string($color) )
		{
			return $this;	
		}
		
		if( ! empty($color) )
		{
			$this->sets['textColor'] = $color;
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* TEXT                                                                        			  *
	*******************************************************************************************
	| Genel Kullanım: Güvenlik kodu metninin boyutu x ve ye değerlerini ayarlamak içindir.	  |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. numeric var @size => Metnin boyutudur.  								  			  |
	| 2. numeric var @x => Metnin yatay düzlemdeki değeri.  								  |
	| 3. numeric var @y => Metnin dikey düzlemdeki değeri.  								  |
	| 4. string var @color => Metnin rengi.  								 			      |
	|          																				  |
	| Örnek Kullanım: ->text(5, 60, 10)            								      		  |
	|          																				  |
	******************************************************************************************/
	public function text($size = 0, $x = 0, $y = 0, $color = '')
	{
		if( ! is_numeric($size) || ! is_numeric($x) || ! is_numeric($y) )
		{
			return $this;
		}
		
		if( ! empty($size) )
		{
			$this->textSize($size);
		}
		
		if( ! empty($x) && ! empty($y) )
		{
			$this->textCoordinate($x, $y);
		}
		
		if( ! empty($color) )
		{
			$this->textColor($color);
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* GRID                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Güvenlik kodu nesnesinin ızgarasının olup olmayacağı olacaksa da hangi. |		      
	| hangi renkte olacağı belirtilir.												          |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. boolean var @is => Izgara olsun mu? True ayarlanması durumunda ızgara oluşturulur.   |
	| 2. string var @color => Izgara rengi belirtilir. RGB standartına uygun renk değerleri   |
	| yazılır. Örnek 255|10|180 gibi renkler yazılırken aralarına dik çizgi(|) ilave edilir.  |
	|          																				  |
	| Örnek Kullanım: ->grid(true, '255|10|180')            								  |
	|          																				  |
	******************************************************************************************/
	public function grid($is = true, $color = '')
	{
		if( ! ( is_bool($is) && is_string($color) ) )
		{
			return $this;	
		}

		$this->sets['grid'] = $is;
		
		if( ! empty($color) )
		{
			$this->sets['gridColor'] = $color;
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* GRID COLOR                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Güvenlik kodu ızgara rengini ayarlamak için kullanılır.				  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 2. string var @color => Izgara rengi belirtilir. RGB standartına uygun renk değerleri   |
	| yazılır. Örnek 255|10|180 gibi renkler yazılırken aralarına dik çizgi(|) ilave edilir.  |
	|          																				  |
	| Örnek Kullanım: ->gridColor('255|10|180')            								  	  |
	|          																				  |
	******************************************************************************************/
	public function gridColor($color = '')
	{
		if( ! is_string($color) )
		{
			return $this;	
		}

		if( ! empty($color) )
		{		
			$this->sets['gridColor'] = $color;
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* GRID SPACE                                                                      		  *
	*******************************************************************************************
	| Genel Kullanım: Güvenlik kodu ızgara boşluklarını ayarlamak için kullanılır.	          |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. numeric var @x => Izgaranın yatay düzlemdeki sayısı.  								  |
	| 2. numeric var @y => Izgaranın dikey düzlemdeki sayısı.  								  |
	|          																				  |
	| Örnek Kullanım: ->gridSpace(4, 12)	            								      |
	|          																				  |
	******************************************************************************************/
	public function gridSpace($x = 0, $y = 0)
	{
		if( ! is_numeric($x) || ! is_numeric($y) )
		{
			return $this;
		}

		if( ! empty($x) ) 
		{
			$this->sets['gridSpace']['x'] = $x;
		}
		
		if( ! empty($y) )
		{ 
		 	$this->sets['gridSpace']['y'] = $y;
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* CREATE                                                                        		  *
	*******************************************************************************************
	| Genel Kullanım: Güvenlik kodunu oluşturma yöntemidir.	Zincirin en son halkasıdır.		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. boolean var @img => Kod bir <img> nesnesi ile mi kullanılsın yoksa sadece url mi?	  |
	| üretsin? True olması durumunda img nesnesi içerisinde bir resim olarak görüntülenecektir|
	|          																				  |
	| Örnek Kullanım: ->create();	            								     		  |
	|          																				  |
	******************************************************************************************/
	public function create($img = false)
	{
		return Captcha::create($img, $this->sets);
	}
	
	/******************************************************************************************
	* GET CODE                                                                        		  *
	*******************************************************************************************
	| Genel Kullanım: Oluşturulan güvenlik kodunu öğrenmek için kullanılır.		 		      |															       
	|          																				  |
	| Örnek Kullanım: ->getCode();	//f923f5            								      |
	|          																				  |
	******************************************************************************************/
	public function getCode()
	{
		return Captcha::getCode();
	}
}