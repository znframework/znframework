<?php
class __USE_STATIC_ACCESS__Captcha
{
	/***********************************************************************************/
	/* CAPTCHA COMPONENT         		                   	                           */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Captcha
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: Captcha::, $this->Captcha, zn::$use->Captcha, uselib('Captcha')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* Settings Değişkeni
	 *  
	 * Güvenlik kodu nesnesine ait
	 * ayarlar bilgilerini tutması
	 * için oluşturulumuştur.
	 */
	protected $sets = array();
	
	public function __construct()
	{
		if( ! isset($_SESSION) ) 
		{
			session_start();
		}
	}
	
	/******************************************************************************************
	* CALL                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Geçersiz fonksiyon girildiğinde çağrılması için.						  |
	|          																				  |
	******************************************************************************************/
	public function __call($method = '', $param = '')
	{	
		die(getErrorMessage('Error', 'undefinedFunction', "Captcha::$method()"));	
	}
	
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
			Error::set(lang('Error', 'numericParameter', 'param'));
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
			Error::set(lang('Error', 'numericParameter', 'param'));
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
			Error::set(lang('Error', 'numericParameter', 'param'));
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
		if( ! is_bool($is) || ! is_string($color) )
		{
			Error::set(lang('Error', 'booleanParameter', 'is'));
			Error::set(lang('Error', 'stringParameter', 'color'));
			
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
			Error::set(lang('Error', 'stringParameter', 'color'));
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
			Error::set(lang('Error', 'stringParameter', 'color'));
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
			Error::set(lang('Error', 'numericParameter', 'size'));
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
			Error::set(lang('Error', 'numericParameter', 'x | y'));
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
			Error::set(lang('Error', 'stringParameter', 'color'));
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
			Error::set(lang('Error', 'numericParameter', 'size | x | y'));
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
		if( ! is_bool($is) || ! is_string($color) )
		{
			Error::set(lang('Error', 'booleanParameter', 'is'));
			Error::set(lang('Error', 'stringParameter', 'color'));
			
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
			Error::set(lang('Error', 'stringParameter', 'color'));
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
			Error::set(lang('Error', 'numericParameter', 'x | y'));
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
	public function create($img = false, $configs = array())
	{
		$configs = array_merge($this->sets, $configs);
		
		if( ! empty($configs) )
		{
			Config::set('Captcha', $configs);
		}
		
		$set = Config::get("Captcha");
		
		$_SESSION[md5('captchaCode')] = substr(md5(rand(0,999999999999999)),-($set['charLength']));	
		
		if( isset($_SESSION[md5('captchaCode')]) )
		{
			if( ! isset($set["width"]) ) $set["width"] 								= 100;
			if( ! isset($set["height"]) ) $set["height"] 							= 30;
			if( ! isset($set['textColor']) ) $set['textColor'] 						= "0|0|0";
			if( ! isset($set['bgColor']) ) $set['bgColor'] 							= "255|255|255";
			if( ! isset($set["border"]) ) $set["border"] 							= true;
			if( ! isset($set['borderColor']) ) $set['borderColor'] 					= "200|200|200";
			if( ! isset($set['imageString']["size"]) ) $set['imageString']["size"] 	= "5";
			if( ! isset($set['imageString']["x"]) ) $set['imageString']["x"] 		= "23";
			if( ! isset($set['imageString']["y"]) ) $set['imageString']["y"] 		= "9";
			if( ! isset($set["grid"]) ) $set["grid"] 								= false; 
			if( ! isset($set['gridSpace']["x"]) ) $set['gridSpace']["x"] 			= 12; 
			if( ! isset($set['gridSpace']["y"]) ) $set['gridSpace']["y"] 			= 4; 
			if( ! isset($set['gridColor']) ) $set['gridColor']						= "240|240|240";
			if( ! isset($set["background"]) ) $set["background"]					= array();
			
			// 0-255 arasında değer alacak renk kodları için
			// 0|20|155 gibi bir kullanım için aşağıda
			// explode ile ayırma işlemleri yapılmaktadır.
			
			// SET FONT COLOR
			$setFontColor   = explode("|",$set['textColor']);
			
			// SET BG COLOR
			$setBgColor	    = explode("|",$set['bgColor']);
			
			// SET BORDER COLOR
			$setBorderColor	= explode("|",$set['borderColor']);
			
			// SET GRID COLOR
			$setGridColor	= explode("|",$set['gridColor']);
			
			
			$file = @imagecreatetruecolor($set["width"], $set["height"]);	  
				  
			$fontColor 	= @imagecolorallocate($file, $setFontColor[0], $setFontColor[1], $setFontColor[2]);
			$color 		= @imagecolorallocate($file, $setBgColor[0], $setBgColor[1], $setBgColor[2]);
			
			// ARKAPLAN RESMI--------------------------------------------------------------------------------------
			if( ! empty($set["background"]) )
			{
				if( is_array($set["background"]) )
				{
					$set["background"] = $set["background"][rand(0, count($set["background"]) - 1)];
				}
				/***************************************************************************/
				// Arkaplan resmi için geçerli olabilecek uzantıların kontrolü yapılıyor.
				/***************************************************************************/	
				if( strtolower(pathinfo($set["background"], PATHINFO_EXTENSION)) === 'png' )
				{
					$file = imagecreatefrompng($set["background"]);
				}
				if( strtolower(pathinfo($set["background"], PATHINFO_EXTENSION)) === 'jpeg' )
				{	
					$file = imagecreatefromjpeg($set["background"]);
				}
				if( strtolower(pathinfo($set["background"], PATHINFO_EXTENSION)) === 'jpg' )
				{	
					$file = imagecreatefromjpeg($set["background"]);
				}
				if( strtolower(pathinfo($set["background"], PATHINFO_EXTENSION)) === 'gif' )
				{	
					$file = imagecreatefromgif($set["background"]);
				}
			}
			else
			{
				// Arkaplan olarak resim belirtilmemiş ise arkaplan rengini ayarlar.
				@imagefill($file, 0, 0, $color);
			}
			//-----------------------------------------------------------------------------------------------------
			
			// Resim üzerinde görüntülenecek kod bilgisi.
			@imagestring($file, $set['imageString']["size"], $set['imageString']["x"], $set['imageString']["y"],  $_SESSION[md5('captchaCode')], $fontColor);
			
			// GRID --------------------------------------------------------------------------------------
			if( $set["grid"] === true )
			{
				$gridIntervalX  = $set["width"] / $set['gridSpace']["x"];
				
				if( ! isset($set['gridSpace']["y"]))
				{
					$gridIntervalY  = (($set["height"] / $set['gridSpace']["x"]) * $gridIntervalX / 2);
					
				} else $gridIntervalY  = $set["height"] / $set['gridSpace']["y"];
				
				$gridColor 	= @imagecolorallocate($file, $setGridColor[0], $setGridColor[1], $setGridColor[2]);
				
				for($x = 0 ; $x <= $set["width"] ; $x += $gridIntervalX)
				{
					@imageline($file,$x,0,$x,$set["height"] - 1,$gridColor);
				}
				
				for($y = 0 ; $y <= $set["width"] ; $y += $gridIntervalY)
				{
					@imageline($file,0,$y,$set["width"],$y,$gridColor);
				}
				
			}
			// ---------------------------------------------------------------------------------------------	
			
			// BORDER --------------------------------------------------------------------------------------
			if( $set["border"] === true )
			{
				$borderColor 	= @imagecolorallocate($file, $setBorderColor[0], $setBorderColor[1], $setBorderColor[2]);
				
				@imageline($file, 0, 0, $set["width"], 0, $borderColor); // UST
				@imageline($file, $set["width"] - 1, 0, $set["width"] - 1, $set["height"], $borderColor); // SAG
				@imageline($file, 0, $set["height"] - 1, $set["width"], $set["height"] - 1, $borderColor); // ALT
				@imageline($file, 0, 0, 0, $set["height"] - 1, $borderColor); // SOL
			}
			// ---------------------------------------------------------------------------------------------
			
			$filePath = FILES_DIR.'capcha';
			
			if( function_exists('imagepng') )
			{
				$extension = '.png';
				imagepng($file, $filePath.$extension);
			}
			elseif( function_exists('imagejpg'))
			{
				$extension = '.jpg';
				imagepng($file, $filePath.$extension);		
			}
			else
			{
				return false;
			}
			
			$filePath .= $extension;
			
			if( $img === true )
			{	
				$captcha = '<img src="'.baseUrl($filePath).'">';
			}
			else
			{
				$captcha = baseUrl($filePath);
			}
			
			imagedestroy($file);
			
			return $captcha;
		}	
	}
	
	/******************************************************************************************
	* GET CAPTCHA CODE                                                                        *
	*******************************************************************************************
	| Genel Kullanım: Daha önce oluşturulan güvenlik uygulamasının kod bilgini verir. 		  |
	|																						  |
	******************************************************************************************/	
	public function getCode()
	{
		if( isset($_SESSION[md5('captchaCode')]) )
		{
			return $_SESSION[md5('captchaCode')];
		}
		else
		{
			return false;	
		}
	}
}