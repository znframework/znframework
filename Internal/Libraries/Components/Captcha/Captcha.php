<?php
namespace ZN\Components;

class InternalCaptcha implements CaptchaInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Const CONFIG_NAME
	//----------------------------------------------------------------------------------------------------
	// 
	// @const string
	//
	//----------------------------------------------------------------------------------------------------
	const CONFIG_NAME  = 'Components:captcha';
	
	//----------------------------------------------------------------------------------------------------
	// Sets
	//----------------------------------------------------------------------------------------------------
	//
	// Güvenlik kodu nesnesine ait ayarlar
	//
	// @var  array
	//
	//----------------------------------------------------------------------------------------------------
	protected $sets = [];
	
	//----------------------------------------------------------------------------------------------------
	// Construct
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  void
	// @return bool
	//
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Construct
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  void
	// @return bool
	//
	//----------------------------------------------------------------------------------------------------
	public function __construct()
	{
		$this->config();
	}
	
	//----------------------------------------------------------------------------------------------------
	// Config Method
	//----------------------------------------------------------------------------------------------------
	// 
	// config()
	//
	//----------------------------------------------------------------------------------------------------
	use \ConfigMethodTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Call Method
	//----------------------------------------------------------------------------------------------------
	// 
	// __call()
	//
	//----------------------------------------------------------------------------------------------------
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
	
	//----------------------------------------------------------------------------------------------------
	// Designer Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

	//----------------------------------------------------------------------------------------------------
	// Width
	//----------------------------------------------------------------------------------------------------
	//
	// Güvenlik kodu nesnesinin genişlik değeri belirtilir.
	//
	// @param  numeric $param
	// @return this
	//
	//----------------------------------------------------------------------------------------------------
	public function width($param = 0)
	{
		if( ! is_numeric($param) )
		{
			\Errors::set('Error', 'numericParameter', 'param');
			return $this;	
		}
		
		if( ! empty($param) )
		{
			$this->sets['width'] = $param;
		}
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Height
	//----------------------------------------------------------------------------------------------------
	//
	// Güvenlik kodu nesnesinin yükseklik değeri belirtilir.
	//
	// @param  numeric $param
	// @return this
	//
	//----------------------------------------------------------------------------------------------------
	public function height($param = 0)
	{
		if( ! is_numeric($param) )
		{
			\Errors::set('Error', 'numericParameter', 'param');
			return $this;	
		}
		
		if( ! empty($param) )
		{
			$this->sets['height'] = $param;
		}
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Size
	//----------------------------------------------------------------------------------------------------
	//
	// Güvenlik kodu nesnesinin genişlikk ve yükseklik değeri belirtilir.
	//
	// @param  numeric $width
	// @param  numeric $height
	// @return this
	//
	//----------------------------------------------------------------------------------------------------
	public function size($width = 0, $height = 0)
	{
		$this->width($width);
		$this->height($height);
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Length
	//----------------------------------------------------------------------------------------------------
	//
	// Güvenlik kodu nesnesinin kaç karakterden olacağı belirtilir.
	//
	// @param  numeric $param
	// @return this
	//
	//----------------------------------------------------------------------------------------------------
	public function length($param = 0)
	{
		if( ! is_numeric($param) )
		{
			\Errors::set('Error', 'numericParameter', 'param');
			return $this;	
		}
		
		if( ! empty($param) )
		{
			$this->sets['charLength'] = $param;
		}
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Border
	//----------------------------------------------------------------------------------------------------
	//
	// Güvenlik kodu nesnesinin çerçevesinin olup olmayacağı olacaksa da hangi.		      
	// hangi renkte olacağı belirtilir.
	//
	// @param  boolean $is
	// @param  string  $color
	// @return this
	//
	//----------------------------------------------------------------------------------------------------
	public function border($is = true, $color = '')
	{
		if( ! is_bool($is) || ! is_string($color) )
		{
			\Errors::set('Error', 'booleanParameter', 'is');
			\Errors::set('Error', 'stringParameter', 'color');
			
			return $this;	
		}
		
		$this->sets['border'] = $is;
		
		if( ! empty($color) )
		{
			$this->sets['borderColor'] = $this->_convertColor($color);
		}
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Border Color
	//----------------------------------------------------------------------------------------------------
	//
	// Güvenlik kodu çerçeve rengini ayarlamak için kullanılır.
	//
	// @param  string $color
	// @return this
	//
	//----------------------------------------------------------------------------------------------------
	public function borderColor($color = '')
	{
		if( ! is_string($color) )
		{
			\Errors::set('Error', 'stringParameter', 'color');
			return $this;	
		}

		if( ! empty($color) )
		{
			$this->sets['borderColor'] = $this->_convertColor($color);
		}
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Bg Color
	//----------------------------------------------------------------------------------------------------
	//
	// Güvenlik kodu arkaplan rengini ayarlamak için kullanılır.
	//
	// @param  string $color
	// @return this
	//
	//----------------------------------------------------------------------------------------------------
	public function bgColor($color = '')
	{
		if( ! is_string($color) )
		{
			\Errors::set('Error', 'stringParameter', 'color');
			return $this;	
		}
		
		if( ! empty($color) )
		{
			$this->sets['bgColor'] = $this->_convertColor($color);
		}
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Background Color
	//----------------------------------------------------------------------------------------------------
	//
	// Güvenlik kodu arkaplan resimleri ayarlamak için kullanılır.
	//
	// @param  mixed $image
	// @return this
	//
	//----------------------------------------------------------------------------------------------------
	public function bgImage($image = [])
	{
		if( ! empty($image) )
		{
			if( is_string($image) )
			{
				$this->sets['background'] = [$image];
			}
			elseif( is_array($image) )
			{
				$this->sets['background'] = $image;	
			}
		}
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Background
	//----------------------------------------------------------------------------------------------------
	//
	// Güvenlik kodu arkaplan rengini veya resimlerini ayarlamak için 		 
	// kullanılır. Bgimage ve bgcolor yöntemlerinin alternatifidir.
	//
	// @param  mixed $background
	// @return this
	//
	//----------------------------------------------------------------------------------------------------
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
	
	//----------------------------------------------------------------------------------------------------
	// Text Size
	//----------------------------------------------------------------------------------------------------
	//
	// Güvenlik kodu metninin boyutunu ayarlamak içindir.
	//
	// @param  numeric $size
	// @return this
	//
	//----------------------------------------------------------------------------------------------------
	public function textSize($size = 0)
	{
		if( ! is_numeric($size) )
		{
			\Errors::set('Error', 'numericParameter', 'size');
			return $this;
		}
		
		if( ! empty($size) )
		{
			$this->sets['imageString']['size'] = $size;
		}
		
		return $this;
	}
		
	//----------------------------------------------------------------------------------------------------
	// Text Coordinate
	//----------------------------------------------------------------------------------------------------
	//
	// Güvenlik kodu metninin boyutunu ayarlamak içindir.
	//
	// @param  numeric $x
	// @param  numeric $y
	// @return this
	//
	//----------------------------------------------------------------------------------------------------
	public function textCoordinate($x = 0, $y = 0)
	{
		if( ! is_numeric($x) || ! is_numeric($y) )
		{
			\Errors::set('Error', 'numericParameter', 'x | y');
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
	
	//----------------------------------------------------------------------------------------------------
	// Text Color
	//----------------------------------------------------------------------------------------------------
	//
	// Güvenlik kodu metninin rengini ayarlamak için kullanılır.
	//
	// @param  string $color
	// @return this
	//
	//----------------------------------------------------------------------------------------------------
	public function textColor($color = '')
	{
		if( ! is_string($color) )
		{
			\Errors::set('Error', 'stringParameter', 'color');
			return $this;	
		}
		
		if( ! empty($color) )
		{
			$this->sets['textColor'] = $this->_convertColor($color);
		}
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Text
	//----------------------------------------------------------------------------------------------------
	//
	// Güvenlik kodu metninin boyutu x ve ye değerlerini ayarlamak içindir.
	//
	// @param  numeric $size
	// @param  numeric $x
	// @param  numeric $y
	// @param  string  $color
	// @return this
	//
	//----------------------------------------------------------------------------------------------------
	public function text($size = 0, $x = 0, $y = 0, $color = '')
	{
		if( ! is_numeric($size) || ! is_numeric($x) || ! is_numeric($y) )
		{
			\Errors::set('Error', 'numericParameter', 'size | x | y');
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
	
	//----------------------------------------------------------------------------------------------------
	// Grid
	//----------------------------------------------------------------------------------------------------
	//
	// Güvenlik kodu nesnesinin ızgarasının olup olmayacağı olacaksa da hangi. 	      
	// hangi renkte olacağı belirtilir.
	//
	// @param  boolean $is
	// @param  string  $color
	// @return this
	//
	//----------------------------------------------------------------------------------------------------
	public function grid($is = true, $color = '')
	{
		if( ! is_bool($is) || ! is_string($color) )
		{
			\Errors::set('Error', 'booleanParameter', 'is');
			\Errors::set('Error', 'stringParameter', 'color');
			
			return $this;	
		}

		$this->sets['grid'] = $is;
		
		if( ! empty($color) )
		{
			$this->sets['gridColor'] = $this->_convertColor($color);
		}
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Grid Color
	//----------------------------------------------------------------------------------------------------
	//
	// Güvenlik kodu ızgara rengini ayarlamak için kullanılır.	      
	//
	// @param  string $color
	// @return this
	//
	//----------------------------------------------------------------------------------------------------
	public function gridColor($color = '')
	{
		if( ! is_string($color) )
		{
			\Errors::set('Error', 'stringParameter', 'color');
			return $this;	
		}

		if( ! empty($color) )
		{		
			$this->sets['gridColor'] = $this->_convertColor($color);
		}
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Grid Space
	//----------------------------------------------------------------------------------------------------
	//
	// Güvenlik kodu ızgara boşluklarını ayarlamak için kullanılır.	      
	//
	// @param  numeric $x
	// @param  numeric $y
	// @return this
	//
	//----------------------------------------------------------------------------------------------------
	public function gridSpace($x = 0, $y = 0)
	{
		if( ! is_numeric($x) || ! is_numeric($y) )
		{
			\Errors::set('Error', 'numericParameter', 'x | y');
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
	
	//----------------------------------------------------------------------------------------------------
	// Designer Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Create Method Başlangıç
	//----------------------------------------------------------------------------------------------------

	//----------------------------------------------------------------------------------------------------
	// Create
	//----------------------------------------------------------------------------------------------------
	//
	// Güvenlik kodu ızgara boşluklarını ayarlamak için kullanılır.	      
	//
	// @param  boolean $img
	// @param  array   $configs
	// @return midex
	//
	//----------------------------------------------------------------------------------------------------
	public function create($img = false, $configs = [])
	{	
		$config  = $this->config;
		
		$configs = array_merge($config, $this->sets, $configs);
		
		if( ! empty($configs) )
		{
			\Config::set('Components', 'captcha', $configs);
		}
		
		$set = \Config::get('Components', 'captcha');
		
		$systemCaptchaCodeData = md5('SystemCaptchaCodeData');
	
		\Session::insert($systemCaptchaCodeData, substr(md5(rand(0,999999999999999)), -($set['charLength'])));	
		
		if( $sessionCaptchaCode = \Session::select($systemCaptchaCodeData) )
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
			if( ! isset($set["background"]) ) $set["background"]					= [];
			
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
			
			
			$file       = @imagecreatetruecolor($set["width"], $set["height"]);	  	  
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
				$infoExtension = strtolower(pathinfo($set["background"], PATHINFO_EXTENSION));
					
				switch( $infoExtension )
				{
					case 'jpeg':
					case 'jpg' : $file = imagecreatefromjpeg($set["background"]); break;
					case 'png' : $file = imagecreatefrompng($set["background"]);  break;
					case 'gif' : $file = imagecreatefromgif($set["background"]);  break;
					default    : $file = imagecreatefromjpeg($set["background"]); 
				}	
			}
			else
			{
				// Arkaplan olarak resim belirtilmemiş ise arkaplan rengini ayarlar.
				@imagefill($file, 0, 0, $color);
			}
			//----------------------------------------------------------------------------------------------------------------------
			
			// Resim üzerinde görüntülenecek kod bilgisi.
			@imagestring($file, $set['imageString']["size"], $set['imageString']["x"], $set['imageString']["y"], $sessionCaptchaCode, $fontColor);
			
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
	
	//----------------------------------------------------------------------------------------------------
	// Create Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Get Code Method Başlangıç
	//----------------------------------------------------------------------------------------------------

	//----------------------------------------------------------------------------------------------------
	// Get Code
	//----------------------------------------------------------------------------------------------------
	//
	// Daha önce oluşturulan güvenlik uygulamasının kod bilgini verir.       
	//
	// @param  void
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function getCode()
	{
		return \Session::select(md5('SystemCaptchaCodeData'));
	}
	
	//----------------------------------------------------------------------------------------------------
	// Get Code Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Protected Color
	//----------------------------------------------------------------------------------------------------
	//
	// @param string
	//
	//----------------------------------------------------------------------------------------------------
	protected function _convertColor($color = '')
	{
		if( $convert = \Config::get('Colors', $color) )
		{
			return $convert;	
		}
		
		return $color;
	}
}