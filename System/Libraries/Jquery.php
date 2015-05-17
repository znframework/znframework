<?php
/************************************************************/
/*                     CLASS JQUERY                         */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Jquery
{	

	/* Type Değişkeni
	 *  
	 * Text tipi bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $type      = 'text/javascript';
	
	/* Jquery Path Değişkeni
	 *  
	 * Jquery kütüphanesinin yol bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $j_path    = 'System/References/Jquery/Jquery.js';
	
	/* JqueryUi Path Değişkeni
	 *  
	 * JqueryUi kütüphanesinin yol bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $jui_path  = 'System/References/Jquery/JqueryUi.js';
	
	/* Ready Değişkeni
	 *  
	 * $(document).ready({ }) eklenip eklenmeyeceğinin
	 * bilgisini tutması için oluşturulmuştur.
	 *
	 */
	private static $keywords = array('this', 'document', 'window');
	
	/* Keyword Değişkeni
	 *  
	 * Tırnak içersinde yazılmaması gereken anathar ifadelerin
	 * bilgisini tutması için oluşturulmuştur.
	 *
	 */
	private static $ready;
	
	/******************************************************************************************
	* OPEN                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Html <script> tagının kullanımıdır. Yani Script tagını açmak içindir.   |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. boolean var @jquery_library => Jquery kütüphanesi dahil edilsin mi ?.	  			  |
	| 2. boolean var @jquery_ui_library => JqueryUi kütüphanesi dahil edilsin mi ?.	          |
	| 3. boolean var @ready => $(document).ready({ }) kodu eklensin mi ?.	                  |
	|          																				  |
	| Örnek Kullanım: open();        	  					                                  |
	|          																				  |
	******************************************************************************************/	
	public static function open($jquery_library = true, $jquery_ui_library = false, $ready = true)
	{
		// Parametre kontrolleri yapılıyor. -------------------------------------------
		if( ! is_bool($jquery_library) ) 
		{
			$jquery_library = true;
		}
		
		if( ! is_bool($jquery_ui_library) ) 
		{
			$jquery_ui_library = false;
		}
		if( ! is_bool($ready) )
		{
			$ready = true;
		}
		// ----------------------------------------------------------------------------
		
		self::$ready = $ready;
		
		$script = '';
		
		// True ise Jquery kütüphanesini dahil et.
		if( $jquery_library === true )
		{
			$script  .= '<script type="'.self::$type.'" src="'.base_url(self::$j_path).'"></script>'.ln();
		}
		
		// True ise JqueryUi kütüphanesini dahil et.
		if( $jquery_ui_library === true )
		{
			$script  .= '<script type="'.self::$type.'" src="'.base_url(self::$jui_path).'"></script>'.ln();
		}
		
		$script .= '<script type="'.self::$type.'">'.ln();
		
		// True ise $(document).ready({ }) kodunu dahil et.
		if( $ready === true )
		{
			$script .= '$(document).ready(function()'.ln().'{'.ln();
		}
		
		return $script;
	}
	
	/******************************************************************************************
	* CLOSE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Html </script> tagının kullanımıdır. Yani Script tagını kapatmak için.  |
	|															                              |
	| Parametreler: Herhangi parametresi yoktur.                                              |
	|          																				  |
	| Örnek Kullanım: close();        	  					                                  |
	|          																				  |
	******************************************************************************************/	
	public static function close()
	{	
		$script = "";
		
		// True ise ready kodunun devamını sona 
		// eklemek için bu kontrol yapılıyor.
		if( self::$ready === true )
		{
			self::$ready = NULL;
			$script .= ln().'});'.ln();
		}
		
		$script .=  '</script>'.ln();
		
		return $script;
	}
	
	/******************************************************************************************
	* READY                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: open() yöntemini kullanırken zaten ready satırlar ilave ediliyor. Fakat |
	| bunun dışında extra kullanımına ihtiyaç duyabilmeniz ihtimaline karşın oluşturulmuştur. |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string var @codes => $(document).ready(function(){}) kodu içine yazılacak kodlar.	  |
	|          																				  |
	| Örnek Kullanım: ready('alert(1);');        	  					                      |
	| $(document).ready(function(){ alert(1); });         									  |
	|															                              |
	******************************************************************************************/	
	public static function ready($codes = '')
	{
		if( ! is_string($codes) ) 
		{
			return false;
		}
		
		$ready = '$(document).ready(function()'.ln().'{'.ln().$codes.ln().'});'.ln();
		
		return $ready;
	}
	
	/******************************************************************************************
	* EVENT                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Jquery olay nesnesi oluşturmak için kullanılır.                         |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @element => Olayın uygulanacağı seçici nesnesidir. Örnek: this, '.nesne'  |
	| 2. string var @event_type => Olayın türü. Varsayılan:click  				              |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: event('#nesne', 'mouseover', 'alert(1);');        	  				  |
	| $('#nesne').bind('mouseover', function(e){ alert(1); });         						  |
	|															                              |
	******************************************************************************************/	
	public static function event($element = 'this', $event_type = 'click', $callback = '')
	{	
		if( ! is_string($element) )
		{
			$element = 'this';
		}
		if( ! is_string($event_type) ) 
		{
			$event_type = 'click';
		}
		if( ! is_string($callback) ) 
		{
			$callback = '';
		}
		
		$element = ( in_array($element, self::$keywords) )
				   ? $element
				   : "\"$element\"";
		
		$event = '$('.$element.').bind("'.$event_type.'", function(e)'.ln().'{'.ln().$callback.ln().'});'.ln();
		
		return $event;
	}	
	
	// Jquery nesneleri için.
	protected static function _object($type = '', $element = "this", $speed = "", $easing = "",$callback = "")
	{
		if( ! is_string($element) ) 
		{
			$element = 'this';
		}
		
		if( ! is_char($speed) ) 
		{
			$speed = '';
		}
		
		if( ! is_string($callback) )
		{
			$callback = '';
		}
		
		if( ! empty($callback) )
		{
			$callback = ", function(){".ln().$callback.ln()."}";
		}
		if( ! empty($easing)) 
		{
			$easing = ", '".$easing."'"; 
		}
		
		$element = ( in_array($element, self::$keywords) )
				   ? $element
				   : "\"$element\"";
		
		$speed = ( is_numeric($speed) )
				 ? $speed
				 : "\"$speed\"";
		
		$str  = "$($element).$type({$speed}{$easing}{$callback});".ln();
		
		return $str;
	}
	
	/******************************************************************************************
	* FADE IN                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Jquery Fade animasyonu eklemek için kullanılır.                         |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @element => Animasyonun uygulanacağı seçici nesnesidir. Örnek: this       |
	| 2. mixed var @speed => Animasyonun hızı. Örnek: slow, fast, 1000 				          |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: fadein('#nesne', 1000, 'alert(1);');        	  				          |
	| $('#nesne').fadeIn(1000, function(e){ alert(1); });         						      |
	|															                              |
	******************************************************************************************/	
	public static function fadein($element = 'this', $speed = '', $callback = '')
	{
		return self::_object('fadeIn', $element, $speed, NULL, $callback);
	}
	
	/******************************************************************************************
	* FADE OUT                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Jquery Fade animasyonu eklemek için kullanılır.                         |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @element => Animasyonun uygulanacağı seçici nesnesidir. Örnek: this       |
	| 2. mixed var @speed => Animasyonun hızı. Örnek: slow, fast, 1000 				          |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: fadeout('#nesne', 1000, 'alert(1);');        	  				          |
	| $('#nesne').fadeOut(1000, function(e){ alert(1); });         						      |
	|															                              |
	******************************************************************************************/	
	public static function fadeout($element = 'this', $speed = '', $callback = '')
	{
		return self::_object('fadeOut', $element, $speed, NULL, $callback);
	}
	
	/******************************************************************************************
	* SLIDE UP                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Jquery Slide animasyonu eklemek için kullanılır.                        |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @element => Animasyonun uygulanacağı seçici nesnesidir. Örnek: this       |
	| 2. mixed var @speed => Animasyonun hızı. Örnek: slow, fast, 1000 				          |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: slideup('#nesne', 1000, 'alert(1);');        	  				          |
	| $('#nesne').slideUp(1000, function(e){ alert(1); });         						      |
	|															                              |
	******************************************************************************************/	
	public static function slideup($element = 'this', $speed = '', $callback = '')
	{
		return self::_object('slideUp', $element, $speed, NULL, $callback);
	}
	
	/******************************************************************************************
	* SLIDE DOWN                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Jquery Slide animasyonu eklemek için kullanılır.                        |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @element => Animasyonun uygulanacağı seçici nesnesidir. Örnek: this       |
	| 2. mixed var @speed => Animasyonun hızı. Örnek: slow, fast, 1000 				          |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: slidedown('#nesne', 1000, 'alert(1);');        	  				      |
	| $('#nesne').slideDown(1000, function(e){ alert(1); });         						  |
	|															                              |
	******************************************************************************************/	
	public static function slidedown($element = 'this', $speed = '', $callback = '')
	{
		return self::_object('slideDown', $element, $speed, NULL, $callback);
	}
	
	/******************************************************************************************
	* SLIDE TOGGLE                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Jquery Slide animasyonu eklemek için kullanılır.                        |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @element => Animasyonun uygulanacağı seçici nesnesidir. Örnek: this       |
	| 2. mixed var @speed => Animasyonun hızı. Örnek: slow, fast, 1000 				          |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: slidetoggle('#nesne', 1000, 'alert(1);');        	  				      |
	| $('#nesne').slideToggle(1000, function(e){ alert(1); });         						  |
	|															                              |
	******************************************************************************************/	
	public static function slidetoggle($element = 'this', $speed = '', $callback = '')
	{
		return self::_object('slideToggle', $element, $speed, NULL, $callback);
	}
	
	/******************************************************************************************
	* TOGGLE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Jquery Toggle olayını eklemek için kullanılır.                          |
	|															                              |
	| Parametreler: 4 parametresi vardır.                                              	      |
	| 1. string var @element => Animasyonun uygulanacağı seçici nesnesidir. Örnek: this       |
	| 2. mixed var @speed => Animasyonun hızı. Örnek: slow, fast, 1000 				          |
	| 3. string var @easing => Geçiş animasyonu eklemek içindir.  				              |
	| 4. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: toggle('#nesne', 'up', 1000, 'alert(1);');        	  				  |
	| $('#nesne').toggle(1000, "easeInOut", function(e){ alert(1); });         				  |
	|															                              |
	******************************************************************************************/	
	public static function toggle($element = "this", $speed = "", $easing = "", $callback = "")
	{
		return self::_object('toggle', $element, $speed, $easing, $callback);
	}
	
	/******************************************************************************************
	* HIDE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Jquery Hide animasyonu eklemek için kullanılır.                         |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @element => Animasyonun uygulanacağı seçici nesnesidir. Örnek: this       |
	| 2. mixed var @speed => Animasyonun hızı. Örnek: slow, fast, 1000 				          |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: hide('#nesne', 'up', 1000, 'alert(1);');        	  				      |
	| $('#nesne').hide(1000, function(e){ alert(1); });         						      |
	|															                              |
	******************************************************************************************/	
	public static function hide($element = 'this', $speed = '', $callback = '')
	{
		return self::_object('hide', $element, $speed, NULL, $callback);
	}
	
	/******************************************************************************************
	* SHOW                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Jquery Hide animasyonu eklemek için kullanılır.                         |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @element => Animasyonun uygulanacağı seçici nesnesidir. Örnek: this       |
	| 2. mixed var @speed => Animasyonun hızı. Örnek: slow, fast, 1000 				          |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: show('#nesne', 'up', 1000, 'alert(1);');        	  				      |
	| $('#nesne').show(1000, function(e){ alert(1); });         						      |
	|															                              |
	******************************************************************************************/	
	public static function show($element = 'this', $speed = '', $callback = '')
	{
		return self::_object('show', $element, $speed, NULL, $callback);
	}	
	
	/******************************************************************************************
	* ANIMATE                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Jquery animate nesnesini kullanarak animasyon oluşturmak için kullanılır|
	|															                              |
	| Parametreler: 5 parametresi vardır.                                              	      |
	| 1. string var @element => Animasyonun uygulanacağı seçici nesnesidir. Örnek: this       |
	| 2. array var @params => Animasyona öğe eklemek için kullanılır.                         |
	| 3. mixed var @speed => Animasyonun hızı. Örnek: slow, fast, 1000 				          |
	| 4. string var @easing => Geçiş animasyonu eklemek içindir.  				              |
	| 5. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| $anismasyon_nesneleri = array															  |
	| (																						  |		
	|  	  'width' => '400px', 																  |
	|  	  'height' => '300px',                                                                |
	|  	  'opacity' => '.5',                                                                  |
	|  	  'boderWidth' => '10px'                                                              |
	| );																					  |
	|  																						  |
	| $mili_salise = '';																      |
	|  																						  |
	| $efektler = array																		  |
	| (																						  |
	|  	  'duration' => '1000', 															  |		
	|	  'specialEasing' => array('width' => 'easeOutBounce', 'height' => 'easeOutBounce')   |
	| );																					  |
	|																						  |
	| $kodlar = 'alert("Animasyon Tamamlandı")';                                              |
	|          																			      |
    | jquery::animate('#nesne', $anismasyon_nesneleri, $mili_salise, $efektler, $kodlar );    |
	|															                              |
	******************************************************************************************/	
	public static function animate($element = 'this', $params = array(), $speed = '', $easing = '', $complete = '')
	{
		if( ! is_string($element) ) 
		{
			$element = 'this';
		}
		
		if( ! is_array($params) ) 
		{
			$params = array();
		}
		
		if( ! is_char($speed))  
		{
			$speed = '';
		}
		
		if( ! is_string($complete) ) 
		{
			$complete = '';
		}
		
		$js_animate = '';
		
		$animate = "\t\t{";
		
		if( ! empty($params) )foreach($params as $key => $val)
		{
			if( is_numeric($val) )
			{
				$animate .= $key.':'.$val.',';
			}
			else 
			{
				$animate .= $key.':"'.$val.'",';
			}
		}
		$animate = substr($animate,0,-1);
		
		$animate .= "}";
		
		if( ! empty($speed) )
		{
			if( is_numeric($speed ) )    
			{
				$speed = ",".ln()."\t\t$speed";
			}
			else
			{
				$speed = ",".ln()."\t\t'".$speed."'";
			}
		}
	
		if( is_array($easing) )
		{
			$ease = ",".ln()."\t\t{";
			foreach($easing as $key => $val)
			{
				if( ! is_array($val) )
				{
					if( is_numeric($val)) 
					{
						$ease .= $key.':'.$val.',';
					}
					else 
					{
						$ease .= $key.':"'.$val.'",';
					}
				}
				else
				{
					$ease_control = true;
					$ease .= $key.":{";
					foreach($val as $k => $v)
					{
						if( is_numeric($val) ) 
						{
							$ease .= $k.':'.$v.',';
						}
						else 
						{
							$ease .= $k.':"'.$v.'",';
						}
					}
					$ease = substr($ease,0,-1);
					$ease .= "}";
				}
				
			}
			if( ! isset($ease_control) )
			{
				$ease = substr($ease,0,-1);
			}
			
			$ease .= "}";
			
			$easing = $ease;
	
		}
		else if( ! empty($easing) ) 
		{
			$easing   = ",".ln()."\t\t'".$easing."'";
		}
		
		if( ! empty($complete) )
		{
			$complete = ",".ln()."\t\tfunction(){".$complete."}";
		}
		
		$element = ( in_array($element, self::$keywords) )
				   ? $element
				   : "\"$element\"";
		
		$js_animate = "\t$($element).animate(".ln().$animate.$speed.$easing.$complete.ln()."\t);".ln();
		
		return $js_animate;
		
	}
	
	/******************************************************************************************
	* AJAX                                                                               	  *
	*******************************************************************************************
	| Genel Kullanım: Ajax ile veri gönderimi için kullanılır.								  |
	|															                              |
	| Parametreler: Tek dizi parametresi vardır.                                              |
	| 1. array var @methods => Ajax işlemleri için gerekli veriler.							  |
	|          																				  |
	| @methods parametresinin alabileceği değerler:											  |
	| type, url, dataType, error, success, complete, beforeSend, done ve diğer özellikler	  |
	******************************************************************************************/	
	public static function ajax($methods = array())
	{
		import::library('Ajax');
		
		return ajax::send($methods);
	}
	
	// Jquery css class yapısı eklemek için.
	protected static function _class($classType = '', $element = 'this', $class = '')
	{
		if( ! is_string($element) ) 
		{
			$element = 'this';
		}
		
		if( ! is_string($type) ) 
		{
			$type = '';
		}
		
		if( ! is_string($class) ) 
		{
			$class = '';
		}
		
		$element = ( in_array($element, self::$keywords) )
				   ? $element
				   : "\"$element\"";
		
		$str  = "\t$($element).$classType(\"$class\");".ln();
		
		return $str;
	}
	
	/******************************************************************************************
	* ADD CLASS                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Jquery addClass nesnesinden yararlanmak için kullanılır.                |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @element => Kodun uygulanacağı seçici nesnesidir. Örnek: this             |
	| 3. string var @class => Eklenecek css sınıfları.                                        |
	|          																				  |
	| Örnek Kullanım: addclass('#nesne', 'red-color, bold');        	  				      |
	| $('#nesne').addClass('red-color, bold');         						                  |
	|															                              |
	******************************************************************************************/	
	public static function addclass($element = '', $class = '')
	{
		return self::_class('addClass', $element, $class);
	}
	
	/******************************************************************************************
	* REMOVE CLASS                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Jquery removeClass nesnesinden yararlanmak için kullanılır.             |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @element => Kodun uygulanacağı seçici nesnesidir. Örnek: this             |
	| 3. string var @class => Kaldırılacak css sınıfları.                                     |
	|          																				  |
	| Örnek Kullanım: removeclass('#nesne', 'red-color, bold');        	  				      |
	| $('#nesne').removeClass('red-color, bold');         						              |
	|															                              |
	******************************************************************************************/	
	public static function removeclass($element = '', $class = '')
	{
		return self::_class('removeClass', $element, $class);
	}
	
	/******************************************************************************************
	* TOGGLE CLASS                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Jquery toggleClass nesnesinden yararlanmak için kullanılır.             |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @element => Kodun uygulanacağı seçici nesnesidir. Örnek: this             |
	| 3. string var @class => Kaldırılacak css sınıfları.                                     |
	|          																				  |
	| Örnek Kullanım: toggleclass('#nesne', 'red-color, bold');        	  				      |
	| $('#nesne').toggleClass('red-color, bold');         						              |
	|															                              |
	******************************************************************************************/	
	public static function toggleclass($element = '', $class = '')
	{
		return self::_class('toggleClass', $element, $class);
	}
	
	// Jquery attr yapısı eklemek için. 
	protected static function _attr($type = '', $element = "this", $attrs = "")
	{
		if( ! is_string($element) ) 
		{
			$element = 'this';
		}
		
		if( ! is_string($type) ) 
		{
			$type = 'attr';
		}
		
		$attr = '';
		
		if( is_array($attrs) )foreach($attrs as $key => $val)
		{
			if( is_numeric($val))
			{
				$attr .= $key.':'.$val.',';
			}
			else 
			{
				$attr .= $key.':"'.$val.'",';
			}
			
			$attr = substr($attr, 0, -1);
		}
		else
		{
			$attr = "\"$attr\"";	
		}
			
		$element = ( in_array($element, self::$keywords) )
				   ? $element
				   : "\"$element\"";
		
		$str  = "\t$($element).$type($attr);".ln();
		
		return $str;
	}
	
	/******************************************************************************************
	* ATTR                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Jquery attr nesnesinden yararlanmak için kullanılır.                    |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @element => Kodun uygulanacağı seçici nesnesidir. Örnek: this             |
	| 3. string/array var @attr => Özellik eklemek için kullanılır. 2 tip parametre kullanır. |
	| Tek bir özellik ve değer eklenecekse string tipte parametre girilebilir ancak birden    |
	|  fazla özellik değer çiftli eklenecekse parametreye dizi tipi veri girilmelidir.        |
	|          																				  |
	| Örnek Kullanım: attr('#nesne', 'name, isim');        	  				                  |
	| $('#nesne').attr("name", "isim");         						                      |
	|															                              |
	| Örnek Kullanım: attr('#nesne', array('name' => 'isim', 'id' => 'nesne'));        	  	  |
	| $('#nesne').attr({"name":"isim", "id":"nesne"});         	                              |
	|															                              |
	******************************************************************************************/	
	public static function attr($element = '', $attr = '')
	{
		return self::_class('attr', $element, $attr);
	}
	
	/******************************************************************************************
	* REMOVE ATTR                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Jquery removeAttr nesnesinden yararlanmak için kullanılır.              |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @element => Kodun uygulanacağı seçici nesnesidir. Örnek: this             |
	| 3. string/array var @attr => Özellik kaldırmak için kullanılır. 2 tip parametre kullanır|
	| Tek bir özellik kaldırılacaksa string tipte parametre girilebilir ancak birden          |
	|  fazla özellik kaldırılacaksa parametreye dizi tipi veri girilmelidir.                  |
	|          																				  |
	| Örnek Kullanım: removeattr('#nesne', 'name');        	  				                  |
	| $('#nesne').removeAttr("name");         						                          |
	|															                              |
	| Örnek Kullanım: removeattr('#nesne', array('name', 'id'));        	  	              |
	| $('#nesne').removeAttr({"name", "id"});         	                                      |
	|															                              |
	******************************************************************************************/	
	public static function removeattr($element = '', $attr = '')
	{
		return self::_class('removeAttr', $element, $attr);
	}
	
	/******************************************************************************************
	* FUNC                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Jquery fonksiyon nesnesinden yararlanmak için kullanılır.               |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @property => Fonksiyonun propertisidir. Örnek: attr, class, bind          |
	| 2. string var @params => Fonksiyonun parametreleri belirtilir.                          |
	| 3. string var @code => Fonksiyonun çalıştıracağı kodlar yazılır.                        |
	|          																				  |
	| Örnek Kullanım: func('success', 'e1, e2', 'alert(1);');        	  				      |
	| :function(e1, e2){ alert(1); }         						                          |
	|															                              |
	******************************************************************************************/	
	public static function func($property = 'this', $params = 'e', $code = '')
	{
		if( ! is_string($property) ) 
		{
			$element = NULL;
		}
		
		if( ! is_string($params) ) 
		{
			$params = 'e';
		}
		
		if( ! is_string($code) )
		{
			$code = '';
		}
		
		$func = '';
		
		if( ! empty($property) )
		{
			$func = "\t".$property.":";	
		}
		$func .= 'function('.$params.'){'.ln()."\t\t".$code.ln()."\t".'}'.ln();
		
		return $func;
	}
	
	/******************************************************************************************
	* CALLBACK / FUNC                                                                         *
	*******************************************************************************************
	| Genel Kullanım: Jquery fonksiyon nesnesinden yararlanmak için kullanılır.               |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @property => Fonksiyonun propertisidir. Örnek: attr, class, bind          |
	| 2. string var @params => Fonksiyonun parametreleri belirtilir.                          |
	| 3. string var @code => Fonksiyonun çalıştıracağı kodlar yazılır.                        |
	|          																				  |
	| Örnek Kullanım: callback('success', 'e1, e2', 'alert(1);');        	  				  |
	| :function(e1, e2){ alert(1); }         						                          |
	|															                              |
	******************************************************************************************/	
	public static function callback($element = 'this', $params = 'e', $code = '')
	{
		return self::func($element, $params, $code);	
	}
	
	/******************************************************************************************
	* OBJECT DATA                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Parametre olarak girilen dizi verilerini object veri türüne çevirir.    |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. array var @data => Object türe çevrilecek dizi bilgisi.                              |
	|          																				  |
	| Örnek Kullanım: object_data(array(1 => 'a', 2 => 'b'));        	  				      |  
	| {1:'a', 2:'b'}        						                                          |
	|															                              |
	******************************************************************************************/	
	public static function object_data($data = array())
	{
		import::tool('Array');
		
		return array_object($data);
	}
	
	/******************************************************************************************
	* CODE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Jquery tipi kod yazmak için kullanılır.                                 |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @element => Fonksiyonun yazılacağı erişim nesnesi. this .nesne #nesne     |
    | 2. string var @property => Fonksiyonun propertisidir. Örnek: attr, class, bind          |
	| 3. string var @code => Fonksiyonun çalıştıracağı kodlar yazılır.                        |
	|          																				  |
	| Örnek Kullanım: code('#nesne', 'bind' '"click", function(e){alert("1")}');        	  |
	| $("$nesne").bind("click", function(e){alert("1")});       						      |                       
	|															                              |
	******************************************************************************************/	
	public static function code($element = 'this', $property = '', $code = '')
	{
		if( ! is_string($element) ) 
		{
			$element = 'this';
		}
		
		if( ! is_string($code) ) 
		{
			$code = '';
		}
		
		$element = ( in_array($element, self::$keywords) )
				   ? $element
				   : "\"$element\"";
		
		$code = "$($element).$property($code);".ln();
		
		return $code;
	}
	
}
