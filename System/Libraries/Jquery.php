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

	// PATH AND TYPE
	private static $type      = 'text/javascript';
	private static $j_path    = 'System/References/Jquery/Jquery.js';
	private static $jui_path    = 'System/References/Jquery/JqueryUi.js';
	private static $ready;
	// Script Open
	public static function open($jquery_library = true, $jquery_ui_library = false, $ready = true)
	{
		if( ! is_bool($jquery_library)) $jquery_library = true;
		if( ! is_bool($jquery_ui_library)) $jquery_ui_library = false;
		if( ! is_bool($ready)) $ready = true;
		
		self::$ready = $ready;
		
		$script = "";
		if($jquery_library)
		{
			$script  .= '<script type="'.self::$type.'" src="'.base_url(self::$j_path).'"></script>'."\n";
		}
		if($jquery_ui_library)
		{
			$script  .= '<script type="'.self::$type.'" src="'.base_url(self::$jui_path).'"></script>'."\n";
		}
		$script .= '<script type="'.self::$type.'">'."\n";
		if($ready)
		{
			$script .= '$(document).ready(function()'."\n".'{'."\n";
		}
		return $script;
	}
	
	// Script Close
	public static function close()
	{	
		$script = "";
		if(self::$ready)
		{
			self::$ready = NULL;
			$script .= "\n".'});'."\n";
		}
		$script .=  '</script>'."\n";
		return $script;
	}
	
	// Document Ready
	public static function ready($something = '')
	{
		if( ! is_string($something)) return false;
		$ready = '$(document).ready(function()'."\n".'{'."\n".$something."\n".'});'."\n";
		return $ready;
	}
	
	
	
	// Events
	public static function event($element = 'this', $eventType = 'click',$callback = '')
	{	
		if( ! is_string($element)) $element = 'this';
		if( ! is_string($eventType)) $eventType = 'click';
		if( ! is_string($callback)) $callback = '';
		
		$event = '$("'.$element.'").bind("'.$eventType.'", function(e)'."\n".'{'."\n".$callback."\n".'});'."\n";
		return $event;
	}	
	
	public static function fade($element = 'this', $type = 'in', $speed = '', $callback = '')
	{
		if( ! is_string($element)) $element = 'this';
		if( ! is_string($type)) $type = 'in';
		if( ! (is_numeric($speed) || is_string($speed))) $speed = '';
		if( ! is_string($callback)) $callback = '';
		
		if($type == 'in') $fade_type = 'fadeIn'; else $fade_type = 'fadeOut';
		
		if ( ! empty($callback))
		{
			$callback = ", function(){\n".$callback."\n}";
		}
		
		$str  = "$('".$element."').".$fade_type."("."'".$speed."'".$callback.");\n";
		
		return $str;
	}
	
	public static function slide($element = 'this', $type = 'toggle', $speed = '', $callback = '')
	{
		if( ! is_string($element)) $element = 'this';
		if( ! is_string($type)) $type = 'toggle';
		if( ! (is_numeric($speed) || is_string($speed))) $speed = '';
		if( ! is_string($callback)) $callback = '';
		
		if($type == 'up') $slide_type = 'slideUp'; else if($type == "down") $slide_type = 'slideDown'; else $slide_type = "slideToggle";
		
		if ( ! empty($callback))
		{
			$callback = ", function(){\n".$callback."\n}";
		}
		
		$str  = "$('".$element."').".$slide_type."("."'".$speed."'".$callback.");\n";
		
		return $str;
	}
	// easing swing, linear
	public static function toggle($element = "this", $speed = "", $easing = "",$callback = "")
	{
		if( ! is_string($element)) $element = 'this';
		if( ! (is_numeric($speed) || is_string($speed))) $speed = '';
		if( ! is_string($easing)) $easing = '';
		if( ! is_string($callback)) $callback = '';
		
		if( ! empty($callback))
		{
			$callback = ", function(){\n".$callback."\n}";
		}
		if( ! empty($easing)) $easing = ", '".$easing."'"; 
		
		$str  = "$('".$element."').toggle('".$speed."'".$easing.$callback.");\n";
		
		return $str;
	}
	
	
	public static function hide($element = 'this', $speed = '', $callback = '')
	{
		if( ! is_string($element)) $element = 'this';
		if( ! (is_numeric($speed) || is_string($speed))) $speed = '';
		if( ! is_string($callback)) $callback = '';
		
		if( ! empty($callback))
		{
			$callback = ", function(){\n".$callback."\n}";
		}
		
		$str  = "$('".$element."').hide("."'".$speed."'".$callback.");\n";
		
		return $str;
	}
	
	public static function show($element = 'this', $speed = '', $callback = '')
	{
		if( ! is_string($element)) $element = 'this';
		if( ! (is_numeric($speed) || is_string($speed))) $speed = '';
		if( ! is_string($callback)) $callback = '';
		
		if( ! empty($callback))
		{
			$callback = ", function(){\n".$callback."\n}";
		}
		
		$str  = "$('".$element."').show("."'".$speed."'".$callback.");\n";
		
		return $str;
	}

	
	
	// Animates
	public static function animate($element = 'this', $params = array(), $speed = '', $easing = '', $complete = '')
	{
		if( ! is_string($element)) $element = 'this';
		if( ! is_array($params)) $params = array();
		if( ! (is_numeric($speed) || is_string($speed))) $speed = '';
		if( ! is_string($complete)) $complete = '';
		
		$js_animate = "";
		
		$animate = "\t\t{";
		
		if( ! empty($params))foreach($params as $key => $val)
		{
			if( is_numeric($val))$animate .= $key.':'.$val.',';
			else $animate .= $key.':"'.$val.'",';
		}
		$animate = substr($animate,0,-1);
		
		$animate .= "}";
		
		if( ! empty($speed))
		{
			if( is_numeric($speed ))    $speed    = ",\n\t\t$speed";
			else  $speed    = ",\n\t\t'".$speed."'";
		}
	
		if( is_array($easing) )
		{
			$ease = ",\n\t\t{";
			foreach($easing as $key => $val)
			{
				if( ! is_array($val))
				{
					if( is_numeric($val)) $ease .= $key.':'.$val.',';
					else $ease .= $key.':"'.$val.'",';
					
				}
				else
				{
					$ease_control = true;
					$ease .= $key.":{";
					foreach($val as $k => $v)
					{
						if( is_numeric($val)) $ease .= $k.':'.$v.',';
						else $ease .= $k.':"'.$v.'",';
					
					}
					$ease = substr($ease,0,-1);
					$ease .= "}";
				}
				
			}
			if( ! isset($ease_control) )$ease = substr($ease,0,-1);
			$ease .= "}";
			
			$easing = $ease;
	
		}
		else if( ! empty($easing)) 
		{
			$easing   = ",\n\t\t'".$easing."'";
		}
		
		if( ! empty($complete))	$complete = ",\n\t\tfunction(){".$complete."}";
		
		$js_animate = "\t$('".$element."').animate(\n".$animate.$speed.$easing.$complete."\n\t);"."\n";
		
		return $js_animate;
		
	}
	
	public static function ajax($methods = array())
	{
		if( ! is_array($methods)) return false;
		
		$methods['type'] = ''; $method = '';		
		
		$methods['type'] = (!$methods['type']) ? 'post' : $methods['type'];
		
		if(isset($methods['url']))
		{
			$methods['url']  = ( ! is_url($methods['url'])) ? site_url($methods['url']) : $methods['url']; 
		}
		
		foreach($methods as $key => $val)
		{
		
			if($key == "error" || $key == "success" || $key == "complete" || $key == "beforeSend")
			{
				$value = "function(data){".$val."}"; 	
			}
			else
			{
				$value = '"'.$val.'"';
			}
			
			if($key != 'done')
			$method .= "\t\t".$key.':'.$value.','."\n";
		}
		
		$method = substr($method,0,-2);
		
		$ajax = "\t".'$.ajax'."\n\t".'({'."\n".$method."\n\t".'})';
		if(isset($methods['done']))$ajax .= '.done(function(data){'."\n\t\t".$methods['done']."\n\t".'});'."\n";
		else $ajax .= ";\n";
		
		return $ajax;
	}
	
	public static function css($element = 'this', $type = 'add', $class = '')
	{
		if( ! is_string($element)) $element = 'this';
		if( ! is_string($type)) $type = 'add';
		if( ! is_string($class)) $class = '';
		
		switch($type)
		{
			case 'add'    : $classType = 'addClass';    break;
			case 'remove' : $classType = 'removeClass'; break;
			case 'toggle' : $classType = 'toggleClass'; break;
			
			default; $classType = 'addClass';
		}
		$str  = "\t$('".$element."').".$classType."(\"".$class."\");"."\n";
		return $str;
	}
	
	
	public static function attr($element = "this", $type = 'attr', $attrs = "")
	{
		if( ! is_string($element)) $element = 'this';
		if( ! is_string($type)) $type = 'attr';
  
		$attr = "";
		switch($type)
		{
			case 'add'    : $attrType = 'attr';    break;
			case 'remove' : $attrType = 'removeAttr'; break;
			
			default; $attrType = 'attr';
		}
		if(is_array($attrs))foreach($attrs as $key => $val)
		{
			if( is_numeric($val))$attr .= $key.':'.$val.',';
			else $attr .= $key.':"'.$val.'",';
		}
		$attr = substr($attr,0,-1);
		
		$str  = "\t$('".$element."').".$attrType."({".$attr."});"."\n";
		return $str;
	}
	
	
	public static function func($element = 'this', $params = 'e', $code = '')
	{
		if( ! is_string($element)) $element = 'this';
		if( ! is_string($params)) $params = 'e';
		if( ! is_string($code)) $code = '';
		
		$func = "\t".$element.':function('.$params.'){'."\n\t\t".$code."\n\t".'}'."\n";
		return $func;
	}
	

	public static function code($element = 'this', $code = '')
	{
		if( ! is_string($element)) $element = 'this';
		if( ! is_string($code)) $code = '';
		$code = '$("'.$element.'").'.$code."\n";
		return $code;
	}
	
}