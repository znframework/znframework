<?php
class __USE_STATIC_ACCESS__Captcha
{
	/***********************************************************************************/
	/* CAPTCHA LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Captcha
	/* Versiyon: 1.4
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: captcha::, $this->captcha, zn::$use->captcha, uselib('captcha')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/******************************************************************************************
	* CREATE CAPTCHA                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Güvenlik kodu oluşturmak için kullanılır. 							  |
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. boolean var @img => <img> nesnesi oluşturulsun mu?.						     	  |
	| 1. array var @configs => Config/Captcha.php dosyasında yer alan ayarlar kullanılır.  	  |
	|																						  |
	******************************************************************************************/	
	public function create($img = false, $configs = array())
	{
		if( ! isset($_SESSION) ) 
		{
			session_start();
		}
		
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
		if( ! isset($_SESSION) ) 
		{
			session_start();
		}
		
		return $_SESSION[md5('captchaCode')];
	}	
}