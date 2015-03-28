<?php
/************************************************************/
/*                       CLASS  CSS3                        */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Css3
{
	private static $browsers = array("","-o-","-ms-","-moz-","-webkit-");
	
	public static function open()
	{
		$str  = "<style type='text/css'>\n";
		return $str;	
	}
	
	
	public static function close()
	{
		$str = "</style>\n";	
		return $str;
	}

	
	public static function transform($element = '', $property = array())
	{
		if( ! is_string($element) || empty($element)) return false;
		
		$str  = "";
		$str .= $element."{\n";
		
		foreach(self::$browsers as $val)
		{
			if( ! is_array($property))
			{
				$str .= $val."transform:".$property.";\n";
			}
			else
			{
				$str .= $val."transform:";
				foreach($property as $k => $v)
				{
					$str .= $k."(".$v.") ";	
				}
				$str = substr($str, 0, -1);
				$str .= ";\n";
			}
		}
		
		$str .= "}\n";
		
		return $str;
		
	}
	
	
	public static function transition($element = '', $param = array())
	{
		if( ! is_string($element) || empty($element)) return false;
		if( ! is_array($param)) $param = array();
		
		$str  = "";
		$str .= $element."{\n";
		
		if(isset($param["property"]))
		{
			$property_ex = explode(":",$param["property"]);
			$property = $property_ex[0];
			
			$str .= $param["property"].";\n";
			
			foreach(self::$browsers as $val)
			{
				$str .= $val."transition-property:$property;\n";
			}
		}
		
		if(isset($param["duration"]))
		{
			foreach(self::$browsers as $val)
			{
				$str .= $val."transition-duration:".$param["duration"].";\n";
			}
		}
		
		if(isset($param["delay"]))
		{
			foreach(self::$browsers as $val)
			{
				$str .= $val."transition-delay:".$param["delay"].";\n";
			}
		}
		
		if(isset($param["animation"]))
		{
			foreach(self::$browsers as $val)
			{
				$str .= $val."transition-timing-function:".$param["animation"].";\n";
			}
		}
			
		$str .= "}\n";
		
		return $str;
	}
	
	// SHADOW = Gölge Verir, x = yatayda, y = dikeyde, blur = gölgenin netliği, color = gölgenin rengi
	
	public static function box_shadow($element = '', $param = array("x" => 0, "y" => 0, "blur" => "0", "diffusion" => "0", "color" => "#000"))
	{
		if( ! is_string($element) || empty($element)) return false;
		if( ! is_array($param)) $param = array();
		
		$str  = "";
		$str .= $element."{\n";
		
		foreach(self::$browsers as $val)
		{
			$str .= $val."box-shadow:".$param["x"]." ".$param["y"]." ".$param["blur"]." ".$param["diffusion"]." ".$param["color"].";\n";
		}
				
		$str .= "}\n";
		return $str;
	} 
	
	
	public static function border_radius($element = '', $param = array())
	{
		if( ! is_string($element) || empty($element)) return false;
		if( ! is_array($param)) $param = array();
		
		$str  = "";
		$str .= $element."{\n";
		
		if(isset($param["radius"]))
		{
			foreach(self::$browsers as $val)
			{
				$str .= $val."border-radius:".$param["radius"].";\n";
			}
			
		}
		if(isset($param["top-left-radius"]))
		{
			foreach(self::$browsers as $val)
			{
				$str .= $val."border-top-left-radius:".$param["top-left-radius"].";\n";
			}
		}
		if(isset($param["top-right-radius"]))
		{
			foreach(self::$browsers as $val)
			{
				$str .= $val."border-top-right-radius:".$param["top-right-radius"].";\n";
			}

		}
		if(isset($param["bottom-left-radius"]))
		{
			foreach(self::$browsers as $val)
			{
				$str .= $val."border-bottom-left-radius:".$param["bottom-left-radius"].";\n";
			}
		}
		
		if(isset($param["bottom-right-radius"]))
		{
			foreach(self::$browsers as $val)
			{
				$str .= $val."border-bottom-right-radius:".$param["bottom-right-radius"].";\n";
			}
		
		}
		
		$str .= "}\n";
	
		return $str;
	}
	
	
	public static function code($element = '', $code = '', $property = '')
	{
		if( ! is_string($element) || empty($element)) return false;
		if( ! is_string($code)) $code = '';
		if( ! is_string($property)) $property = '';
	
		$str  = "";
		$str .= $element."{\n";
		
		foreach(self::$browsers as $val)
		{
			$str .= $val.$code.":".$property.";\n";
		}
		
		$str .= "}\n";
		
		return $str;
	}
}