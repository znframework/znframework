<?php
/************************************************************/
/*                       CLASS  CSS3                        */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* CSS3                                                                                	  *
*******************************************************************************************
| Sınıfı Kullanırken      :	css3:: , $this->css3 , uselib('css3') , zn::$use->css3        |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/
class Css3
{
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
		$str  = "<style type='text/css'>".eof();
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
		$str = "</style>".eof();	
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
		$str .= $element."{".eof();
		
		// Config dosyasındaki desteklenen tarayıcıların listesi alınıyor.
		$browsers = config::get('Css3', 'browsers');	
		
		foreach($browsers as $val)
		{
			if( ! is_array($property) )
			{
				$str .= $val."transform:".$property.";".eof();
			}
			else
			{
				$str .= $val."transform:";
				foreach($property as $k => $v)
				{
					$str .= $k."(".$v.") ";	
				}
				$str = substr($str, 0, -1);
				$str .= ";".eof();
			}
		}
		
		$str .= "}".eof();
		
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
		$str .= $element."{".eof();
		
		// Farklı css kodları kullanmanız gerektiğinde 
		// bu parametre kullanılır.
		if( is_array($attr) && ! empty($attr) ) foreach($attr as $k => $v)
		{
			$str .= "$k:$v;".eof();	
		}
		
		$browsers = config::get('Css3', 'browsers');	
		
		if( is_array($param) )
		{
			// Geçiş verilecek özellik belirleniyor.
			if( isset($param["property"]) )
			{
				$property_ex = explode(":",$param["property"]);
				$property = $property_ex[0];
				
				$str .= $param["property"].";".eof();
				
				foreach($browsers as $val)
				{
					$str .= $val."transition-property:$property;".eof();
				}
			}
			
			// Geçiş süresi belirleniyor.
			if( isset($param["duration"]) )
			{
				foreach($browsers as $val)
				{
					$str .= $val."transition-duration:".$param["duration"].";".eof();
				}
			}
			
			// Geçişe başlama süresi belirleniyor.
			if( isset($param["delay"]) )
			{
				foreach($browsers as $val)
				{
					$str .= $val."transition-delay:".$param["delay"].";".eof();
				}
			}
			
			// Geçiş efekti belirleniyor.
			if( isset($param["animation"]) )
			{
				foreach($browsers as $val)
				{
					$str .= $val."transition-timing-function:".$param["animation"].";".eof();
				}
			}			
			elseif( isset($param["easing"]) )
			{
				// Geçiş efekti belirleniyor. animation parametresinin alternatifidir.
				foreach($browsers as $val)
				{
					$str .= $val."transition-timing-function:".$param["easing"].";".eof();
				}
			}
		}
		else
		{
			foreach($browsers as $val)
			{
				$str .= $val."transition:$param;".eof();
			}
		}
		
		$str .= "}".eof();
		
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
		$str .= $element."{".eof();
		
		$browsers = config::get('Css3', 'browsers');	
		
		// Farklı css kodları kullanmanız gerektiğinde 
		// bu parametre kullanılır.
		if( is_array($attr) && ! empty($attr) ) foreach($attr as $k => $v)
		{
			$str .= "$k:$v;".eof();	
		}
		
		if( is_array($param) )
		{
			// Animasyon uygulanacak nesnenin adı.
			if( isset($param["name"]) )
			{
				foreach($browsers as $val)
				{
					$str .= $val."animation-name:".$param["name"].";".eof();
				}
			}
			
			// Animasyon süresi.
			if( isset($param["duration"]) )
			{
				foreach($browsers as $val)
				{
					$str .= $val."animation-duration:".$param["duration"].";".eof();
				}
			}
			
			// Animasyon başlama süresi.
			if( isset($param["delay"]) )
			{
				foreach($browsers as $val)
				{
					$str .= $val."animation-delay:".$param["delay"].";".eof();
				}
			}
			
			// Animasyon efekti.
			if( isset($param["easing"]) )
			{
				foreach($browsers as $val)
				{
					$str .= $val."animation-timing-function:".$param["easing"].";".eof();
				}
			}
			elseif( isset($param["animation"]) )
			{
				// Animasyon efekti. esasing nesnesinin alternatifidir.
				foreach($browsers as $val)
				{
					$str .= $val."animation-timing-function:".$param["animation"].";".eof();
				}
			}
			
			// Animasyon yönü.
			if(isset($param["direction"]))
			{
				foreach($browsers as $val)
				{
					$str .= $val."animation-direction:".$param["direction"].";".eof();
				}
			}
			
			// Animasyon durumu.
			if( isset($param["status"]) )
			{
				foreach($browsers as $val)
				{
					$str .= $val."animation-play-state:".$param["status"].";".eof();
				}
			}
			
			// Animasyon doldurma modu.
			if( isset($param["fill"]) )
			{
				foreach($browsers as $val)
				{
					$str .= $val."animation-fill-mode:".$param["fill"].";".eof();
				}
			}
			
			// Animasyon tekrarı.
			if( isset($param["repeat"]) )
			{
				foreach($browsers as $val)
				{
					$str .= $val."animation-iteration-count:".$param["repeat"].";".eof();
				}
			}
		}
		else
		{
			foreach($browsers as $val)
			{
				$str .= $val."animation:$param;".eof();
			}
		}
		
		$str .= "}".eof();
		
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
		if( ! is_string($element) || empty($element) ) 
		{
			return false;
		}
		if( ! is_array($param) ) 
		{
			$param = array();
		}
		
		$str  = "";
		$str .= $element."{".eof();
		
		$browsers = config::get('Css3', 'browsers');	
		
		foreach($browsers as $val)
		{
			$str .= $val."box-shadow:".$param["x"]." ".$param["y"]." ".$param["blur"]." ".$param["diffusion"]." ".$param["color"].";".eof();
		}
				
		$str .= "}".eof();
		return $str;
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
		$str .= $element."{".eof();
		
		$browsers = config::get('Css3', 'browsers');	
		
		if(isset($param["radius"]))
		{
			foreach($browsers as $val)
			{
				$str .= $val."border-radius:".$param["radius"].";".eof();
			}
			
		}
		if(isset($param["top-left-radius"]))
		{
			foreach($browsers as $val)
			{
				$str .= $val."border-top-left-radius:".$param["top-left-radius"].";".eof();
			}
		}
		if(isset($param["top-right-radius"]))
		{
			foreach($browsers as $val)
			{
				$str .= $val."border-top-right-radius:".$param["top-right-radius"].";".eof();
			}

		}
		if(isset($param["bottom-left-radius"]))
		{
			foreach($browsers as $val)
			{
				$str .= $val."border-bottom-left-radius:".$param["bottom-left-radius"].";".eof();
			}
		}
		
		if(isset($param["bottom-right-radius"]))
		{
			foreach($browsers as $val)
			{
				$str .= $val."border-bottom-right-radius:".$param["bottom-right-radius"].";".eof();
			}
		
		}
		
		$str .= "}".eof();
	
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
		$str .= $element."{".eof();
		
		$browsers = config::get('Css3', 'browsers');	
		
		foreach($browsers as $val)
		{
			$str .= $val.$code.":".$property.";".eof();
		}
		
		$str .= "}".eof();
		
		return $str;
	}
}