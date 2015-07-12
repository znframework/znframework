<?php
class CSS3
{
	/***********************************************************************************/
	/* CSS3 LIBRARY						                   	                           */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: CSS3
	/* Versiyon: 1.0
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: css3::, $this->css3, zn::$use->css3, uselib('css3')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/******************************************************************************************
	* OPEN                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Html <style> tagı açmak için kullanılır.								  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	******************************************************************************************/
	public static function open()
	{
		$str  = "<style type='text/css'>".eol();
		return $str;	
	}
	
	/******************************************************************************************
	* CLOSE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Html </style> tagı açmak için kullanılır.	Yani açılan style tagını      |
	| kapatmak için kullanılır							  									  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	******************************************************************************************/
	public static function close()
	{
		$str = "</style>".eol();	
		return $str;
	}

	/******************************************************************************************
	* TRANSFORM                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Css3 ile birlikte gelen  transform nesnesini kullanmak için oluşturldu. |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @element => seçici nesnesinin adıdır. Örnek: .element, #nesne 			  |
	| 2. array var @propery => hangi transform nesneleri uygulanacaksa onlar belirtirlir. 	  |
	| 																					      |
	| Örnek Kullanım: transform('#nesne', array('skew' => '10, 4', 'rotate' => '10deg'))	  |
	| Not: 2. parametre için birden fazla özellik ve değer ekleyebilirsiniz.			      |
	| 																					      |
	| Transform Nesneleri																	  |
	| 1-rotate       																		  |
	| 2-scale, scaleX, scaleY																  |
	| 3-skey, skewX, skewY																	  |
	| 4-translate, translateX, translateY													  |
	| 5-matrix																				  |
	| 																					      |
	******************************************************************************************/
	public static function transform($element = '', $property = array())
	{
		if( ! is_string($element) || empty($element) ) 
		{
			return false;
		}
		
		$str  = '';
		$str .= $element."{".eol();
		
		// Config dosyasındaki desteklenen tarayıcıların listesi alınıyor.
		$browsers = Config::get('Css3', 'browsers');	
		
		foreach($browsers as $val)
		{
			if( ! is_array($property) )
			{
				$str .= $val."transform:".$property.";".eol();
			}
			else
			{
				$str .= $val."transform:";
				foreach($property as $k => $v)
				{
					$str .= $k."(".$v.") ";	
				}
				$str = substr($str, 0, -1);
				$str .= ";".eol();
			}
		}
		
		$str .= "}".eol();
		
		return $str;
		
	}
	
	/******************************************************************************************
	* TRANSITION                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Css3 ile birlikte gelen transition nesnesini kullanmak için oluşturldu. |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @element => seçici nesnesinin adıdır. Örnek: .element, #nesne 			  |
	| 2. string/array var @propery => hangi transition nesneleri uygulanacaksa onlar 		  |
	| belirtirlir. Kısa kullanım için bu parametreye metinsel veri girilebilir. 	  		  |
	| 3. array var @attr => Farklı css kodları eklemek için kullanılır 			  			  |
	| 																					      |
	| Örnek Kullanım: transition('#nesne', array(transition nesneleri))	 					  |
	| 																					      |
	| Transition Nesneleri																	  |
	| 1-property       																		  |
	| 2-duration																  			  |
	| 3-delay																 				  |
	| 4-animation veya easing => transtion-timing-function									  |
	| 																					      |
	******************************************************************************************/
	public static function transition($element = '', $param = array(), $attr = array())
	{
		if( ! is_string($element) || empty($element) ) 
		{
			return false;
		}
	
		$str  = "";
		$str .= $element."{".eol();
		
		// Farklı css kodları kullanmanız gerektiğinde 
		// bu parametre kullanılır.
		if( is_array($attr) && ! empty($attr) ) foreach($attr as $k => $v)
		{
			$str .= "$k:$v;".eol();	
		}
		
		$browsers = Config::get('Css3', 'browsers');	
		
		if( is_array($param) )
		{
			// Geçiş verilecek özellik belirleniyor.
			if( isset($param["property"]) )
			{
				$propertyEx = explode(":",$param["property"]);
				$property = $propertyEx[0];
				
				$str .= $param["property"].";".eol();
				
				foreach($browsers as $val)
				{
					$str .= $val."transition-property:$property;".eol();
				}
			}
			
			// Geçiş süresi belirleniyor.
			if( isset($param["duration"]) )
			{
				foreach($browsers as $val)
				{
					$str .= $val."transition-duration:".$param["duration"].";".eol();
				}
			}
			
			// Geçişe başlama süresi belirleniyor.
			if( isset($param["delay"]) )
			{
				foreach($browsers as $val)
				{
					$str .= $val."transition-delay:".$param["delay"].";".eol();
				}
			}
			
			// Geçiş efekti belirleniyor.
			if( isset($param["animation"]) )
			{
				foreach($browsers as $val)
				{
					$str .= $val."transition-timing-function:".$param["animation"].";".eol();
				}
			}			
			elseif( isset($param["easing"]) )
			{
				// Geçiş efekti belirleniyor. animation parametresinin alternatifidir.
				foreach($browsers as $val)
				{
					$str .= $val."transition-timing-function:".$param["easing"].";".eol();
				}
			}
		}
		else
		{
			foreach($browsers as $val)
			{
				$str .= $val."transition:$param;".eol();
			}
		}
		
		$str .= "}".eol();
		
		return $str;
	}
	
	/******************************************************************************************
	* ANIMATION                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Css3 ile birlikte gelen animation nesnesini kullanmak için oluşturldu.  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @element => seçici nesnesinin adıdır. Örnek: .element, #nesne 			  |
	| 2. string/array var @propery => hangi animasyon nesneleri uygulanacaksa onlar 		  |
	| belirtirlir. Kısa kullanım için bu parametreye metinsel veri girilebilir. 	  		  |
	| 3. array var @attr => Farklı css kodları eklemek için kullanılır 			  			  |
	| 																					      |
	| Örnek Kullanım: animation('#nesne', array(animation nesneleri))	 					  |
	| 																					      |
	| Animation Nesneleri																	  |
	| 1-name         																		  |
	| 2-duration																  			  |
	| 3-delay																 				  |
	| 4-animation veya easing => animation-timing-function									  |
	| 5-direction									 								          |
	| 6-status => animation-play-state										 				  |
	| 7-fill => animation-fill-mode  										 				  |
	| 8-repeat => animation-iteration-count  										 		  |
	| 																					      |
	******************************************************************************************/
	public static function animation($element = '', $param = array(), $attr = array())
	{
		if( ! is_string($element) || empty($element) ) 
		{
			return false;
		}
		
		$str  = "";
		$str .= $element."{".eol();
		
		$browsers = Config::get('Css3', 'browsers');	
		
		// Farklı css kodları kullanmanız gerektiğinde 
		// bu parametre kullanılır.
		if( is_array($attr) && ! empty($attr) ) foreach($attr as $k => $v)
		{
			$str .= "$k:$v;".eol();	
		}
		
		if( is_array($param) )
		{
			// Animasyon uygulanacak nesnenin adı.
			if( isset($param["name"]) )
			{
				foreach($browsers as $val)
				{
					$str .= $val."animation-name:".$param["name"].";".eol();
				}
			}
			
			// Animasyon süresi.
			if( isset($param["duration"]) )
			{
				foreach($browsers as $val)
				{
					$str .= $val."animation-duration:".$param["duration"].";".eol();
				}
			}
			
			// Animasyon başlama süresi.
			if( isset($param["delay"]) )
			{
				foreach($browsers as $val)
				{
					$str .= $val."animation-delay:".$param["delay"].";".eol();
				}
			}
			
			// Animasyon efekti.
			if( isset($param["easing"]) )
			{
				foreach($browsers as $val)
				{
					$str .= $val."animation-timing-function:".$param["easing"].";".eol();
				}
			}
			elseif( isset($param["animation"]) )
			{
				// Animasyon efekti. esasing nesnesinin alternatifidir.
				foreach($browsers as $val)
				{
					$str .= $val."animation-timing-function:".$param["animation"].";".eol();
				}
			}
			
			// Animasyon yönü.
			if(isset($param["direction"]))
			{
				foreach($browsers as $val)
				{
					$str .= $val."animation-direction:".$param["direction"].";".eol();
				}
			}
			
			// Animasyon durumu.
			if( isset($param["status"]) )
			{
				foreach($browsers as $val)
				{
					$str .= $val."animation-play-state:".$param["status"].";".eol();
				}
			}
			
			// Animasyon doldurma modu.
			if( isset($param["fill"]) )
			{
				foreach($browsers as $val)
				{
					$str .= $val."animation-fill-mode:".$param["fill"].";".eol();
				}
			}
			
			// Animasyon tekrarı.
			if( isset($param["repeat"]) )
			{
				foreach($browsers as $val)
				{
					$str .= $val."animation-iteration-count:".$param["repeat"].";".eol();
				}
			}
		}
		else
		{
			foreach($browsers as $val)
			{
				$str .= $val."animation:$param;".eol();
			}
		}
		
		$str .= "}".eol();
		
		return $str;
	}
	
	protected static function _shadow($element = '', $type = 'box', $param = array("x" => 0, "y" => 0, "blur" => "0", "diffusion" => "0", "color" => "#000"))
	{
		if( ! is_string($element) || empty($element) ) 
		{
			return false;
		}
		if( ! is_array($param) ) 
		{
			$param = array();
		}
		
		$str  = "";
		$str .= $element."{".eol();
		
		$browsers = Config::get('Css3', 'browsers');	
		
		$x 			= ! isset($param['x']) ? 0 : $param['x'];	
		$y 			= ! isset($param['y']) ? 0 : $param['y'];	
		$blur 		= ! isset($param['blur']) ? 0 : $param['blur'];
		$diffusion 	= ! isset($param['diffusion']) ? 0 : $param['diffusion'];	
		$color 		= ! isset($param['color']) ? 0 : $param['color'];
		
		if( $type === 'box' )
		{ 
			$shadow = "$type-shadow:$x $y $blur $diffusion $color;".eol();
		}
		else
		{
			$shadow = "$type-shadow:$x $y $blur $color;".eol();	
		}
		
		foreach($browsers as $val)
		{
			$str .= $val.$shadow;
		}
				
		$str .= "}".eol();
		return $str;
	}
	
	/******************************************************************************************
	* BOX SHADOW                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Css3 ile birlikte gelen box-shadow nesnesini kullanmak için oluşturldu. |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @element => seçici nesnesinin adıdır. Örnek: .element, #nesne 			  |
	| 2. array var @propery => hangi shadow nesneleri uygulanacaksa onlar belirtirlir. 	      |
	| 																					      |
	| Örnek Kullanım: boxShadow('#nesne', array(shadow nesneleri))	 					      |
	| 																					      |
	| Box Shadow Nesneleri																	  |
	| 1-x         																		  	  |
	| 2-y																  			  		  |
	| 3-blur																 				  |
	| 4-diffusion									  										  |
	| 5-color									 								              |
	| 																					      |
	******************************************************************************************/
	public static function boxShadow($element = '', $param = array("x" => 0, "y" => 0, "blur" => "0", "diffusion" => "0", "color" => "#000"))
	{
		return self::_shadow($element, $type = 'box', $param);
	} 
	
	/******************************************************************************************
	* TEXT SHADOW                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Css3 ile birlikte gelen text-shadow nesnesini kullanmak için oluşturldu.|
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @element => seçici nesnesinin adıdır. Örnek: .element, #nesne 			  |
	| 2. array var @propery => hangi text shadow nesneleri uygulanacaksa onlar belirtirlir.   |
	| 																					      |
	| Örnek Kullanım: boxShadow('#text', array(shadow nesneleri))	 					      |
	| 																					      |
	| Box Shadow Nesneleri																	  |
	| 1-x         																		  	  |
	| 2-y																  			  		  |
	| 3-blur																 				  |
	| 4-color									 								              |
	| 																					      |
	******************************************************************************************/
	public static function textShadow($element = '', $param = array("x" => 0, "y" => 0, "blur" => "0", "color" => "#000"))
	{
		return self::_shadow($element, $type = 'text', $param);
	}
	
	/******************************************************************************************
	* BORDER RADIUS                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Css3 ile birlikte gelen border-radius nesnesini kullanımıdır. 		  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @element => seçici nesnesinin adıdır. Örnek: .element, #nesne 			  |
	| 2. array var @propery => hangi radius nesneleri uygulanacaksa onlar belirtirlir. 	      |
	| 																					      |
	| Örnek Kullanım: borderRadius('#nesne', array(shadow nesneleri))	 					  |
	| 																					      |
	| Box Shadow Nesneleri																	  |
	| 1-radius         																		  |
	| 2-top-left-radius																  		  |
	| 3-top-right-radius																 	  |
	| 4-bottom-left-radius									  								  |
	| 5-bottom-right-radius								 								      |
	| 																					      |
	******************************************************************************************/
	public static function borderRadius($element = '', $param = array())
	{
		if( ! is_string($element) || empty($element) ) 
		{
			return false;
		}
		if( ! is_array($param) ) 
		{
			$param = array();
		}
		
		$str  = "";
		$str .= $element."{".eol();
		
		$browsers = Config::get('Css3', 'browsers');	
		
		if(isset($param["radius"]))
		{
			foreach($browsers as $val)
			{
				$str .= $val."border-radius:".$param["radius"].";".eol();
			}
			
		}
		if(isset($param["top-left-radius"]))
		{
			foreach($browsers as $val)
			{
				$str .= $val."border-top-left-radius:".$param["top-left-radius"].";".eol();
			}
		}
		if(isset($param["top-right-radius"]))
		{
			foreach($browsers as $val)
			{
				$str .= $val."border-top-right-radius:".$param["top-right-radius"].";".eol();
			}

		}
		if(isset($param["bottom-left-radius"]))
		{
			foreach($browsers as $val)
			{
				$str .= $val."border-bottom-left-radius:".$param["bottom-left-radius"].";".eol();
			}
		}
		
		if(isset($param["bottom-right-radius"]))
		{
			foreach($browsers as $val)
			{
				$str .= $val."border-bottom-right-radius:".$param["bottom-right-radius"].";".eol();
			}
		
		}
		
		$str .= "}".eol();
	
		return $str;
	}
	
	/******************************************************************************************
	* CODE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Herhangi bir nesneye css3 kodu eklemek için kullanılır. 		          |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @element => seçici nesnesinin adıdır. Örnek: .element, #nesne 			  |
	| 2. array var @propery => hangi radius nesneleri uygulanacaksa onlar belirtirlir. 	      |
	| 																					      |
	| Örnek Kullanım: code('#nesne', 'transform', 'skew(10,5)scale(5,3)')	 				  |
	| 																					      |
	******************************************************************************************/
	public static function code($element = '', $code = '', $property = '')
	{
		if( ! is_string($element) || empty($element)) 
		{
			return false;
		}
		if( ! is_string($code)) 
		{
			$code = '';
		}
		if( ! is_string($property)) 
		{
			$property = '';
		}
		
		$str  = "";
		$str .= $element."{".eol();
		
		$browsers = Config::get('Css3', 'browsers');	
		
		foreach($browsers as $val)
		{
			$str .= $val.$code.":".$property.";".eol();
		}
		
		$str .= "}".eol();
		
		return $str;
	}
}