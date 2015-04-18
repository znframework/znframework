<?php
/************************************************************/
/*                     CLASS IMAGE                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Image
{
	
	private static $dir_name = 'thumbs';
	private static $file;
	private static $thumb_path;
	private static $error;

	private static function new_path($file_path)
	{
		$file_ex = explode("/", $file_path);
		
		self::$file = $file_ex[count($file_ex) - 1];
	
		self::$thumb_path = substr($file_path,0,strlen($file_path) - strlen(self::$file)).self::$dir_name;
	
		self::$thumb_path = suffix(self::$thumb_path);	
		
		self::$thumb_path = str_replace(base_url(), "", self::$thumb_path);
	}
	
	private static function from_file_type($paths)
	{
		
		if(strtolower(extension(self::$file)) == "jpg")  	  return imagecreatefromjpeg($paths);
		else if(strtolower(extension(self::$file)) == "jpeg") return imagecreatefromjpeg($paths);
		else if(strtolower(extension(self::$file)) == "png")  return imagecreatefrompng($paths);
		else if(strtolower(extension(self::$file)) == "gif")  return imagecreatefromgif($paths);
		else return false;
	}
	
	private static function is_image_file($file)
	{
		
		if(strtolower(extension($file)) == "jpg")  	  return true;
		else if(strtolower(extension($file)) == "jpeg") return true;
		else if(strtolower(extension($file)) == "png")  return true;
		else if(strtolower(extension($file)) == "gif")  return true;
		else return false;
	}
	
	private static function create_file_type($files, $paths, $quality = 0)
	{
	
		if(strtolower(extension(self::$file)) == "jpg")
		{
			if($quality == 0) $quality = 80;
			return imagejpeg($files, $paths, $quality);
		}
		else if(strtolower(extension(self::$file)) == "jpeg")
		{
			if($quality == 0) $quality = 80;
			return imagejpeg($files, $paths, $quality);
		}
		else if(strtolower(extension(self::$file)) == "png")
		{
			if($quality == 0) $quality = 8;
			return imagepng($files, $paths, $quality);
		}
		else if(strtolower(extension(self::$file)) == "gif")  return imagegif($files, $paths);
		else return false;
	}
	
	public static function thumb($fpath = '', $set = array())
	{
		if( ! is_string($fpath)) return false;
		if( ! is_array($set)) $set = array();
		
		$file_path 		= (isset($fpath)) ? trim($fpath) : "";
		
		if(strstr($file_path, base_url()) != "") $file_path = str_replace(base_url(),"",$file_path);
		
		if( ! file_exists($file_path) )
		{
			self::$error = get_message('Image', 'image_file_not_found_error', $file_path);
			report('Error', self::$error, 'ImageLibrary');
			return false;	
		}
		
		if( ! self::is_image_file($file_path) )
		{
			self::$error = get_message('Image', 'image_not_image_file_error', $file_path);
			report('Error', self::$error, 'ImageLibrary');
			return false;	
		}
		
		
		list($current_width, $current_height) = getimagesize($file_path);
		
		$width 			= (isset($set["width"])) 		? $set["width"] 		: $current_width;
		$height 		= (isset($set["height"])) 		? $set["height"] 		: $current_height;
		$rewidth 		= (isset($set["rewidth"])) 		? $set["rewidth"] 		: 0;
		$reheight 		= (isset($set["reheight"])) 	? $set["reheight"]		: 0;
		$x				= (isset($set["x"])) 			? $set["x"] 			: 0;
		$y				= (isset($set["y"])) 			? $set["y"] 			: 0;
		$quality 		= (isset($set["quality"])) 		? $set["quality"] 		: 0;
		
		if(isset($set["prowidth"]) || isset($set["proheight"]))
		{
		
			if(isset($set["proheight"]))
			{
				if($set["proheight"] < $current_height )
				{
					/* resmi ölçeklemek istediğimiz yükseklik ve genişlik */
					$height = $set["proheight"];
					 
					/* resmin yeni genişliği buluyoruz */
					$width = round(($current_width * $height) / $current_height);
				}
			}
			if(isset($set["prowidth"]))
			{
				if($set["prowidth"] < $current_width )
				{
					/* resmi ölçeklemek istediğimiz yükseklik ve genişlik */
					$width = $set["prowidth"];
					 
					/* resmin yeni genişliği buluyoruz */
					$height = round(($current_height * $width) / $current_width);
				}
			}
			
		}
		
		$r_width = $width; $r_height = $height;
		
		if( $rewidth ) $width = $rewidth;
		if( $reheight ) $height = $reheight;
		
		$prefix = "-".$x."x".$y."px-".$width."x".$height."size";
		
		self::new_path($file_path);
		
		if( ! is_dir(self::$thumb_path) ) 
		{ 
			import::library('Folder'); 
			
			folder::create(self::$thumb_path);
			
		}
		$exten_clean = str_replace(extension(self::$file, true),"",self::$file);
		
		$new_file = $exten_clean.$prefix.extension(self::$file, true);
		
		if( file_exists(self::$thumb_path.$new_file) ) return base_url(self::$thumb_path.$new_file);
					
	
		$r_file   = self::from_file_type($file_path);

		
		$n_file   = imagecreatetruecolor($width, $height);
		
		if(isset($set["prowidth"]) || isset($set["proheight"]))
		{
			$r_width = $current_width; $r_height = $current_height;
		}
	
		
		if(strtolower(extension($file_path)) == "png")
		{
			imagealphablending($n_file, false);
			imagesavealpha($n_file,true);
			$transparent = imagecolorallocatealpha($n_file, 255, 255, 255, 127);
			imagefilledrectangle($n_file, 0, 0, $width, $height, $transparent);
		}
		
		@imagecopyresampled($n_file, $r_file,  0, 0, $x, $y, $width, $height, $r_width, $r_height);
			
		self::create_file_type($n_file ,self::$thumb_path.$new_file, $quality);
		
		imagedestroy($r_file); imagedestroy($n_file);	
		
		return base_url(self::$thumb_path.$new_file);
		
	}
	
	
	public static function size($path = '', $width = 0, $height = 0)
	{
		if( ! is_string($path)) return false;
		if( ! is_numeric($width)) $width = 0;
		if( ! is_numeric($height)) $height = 0;
		
		if(empty($path))
		{
			self::$error = get_message('Image', 'image_file_not_found_error', $path);
			report('Error', self::$error, 'ImageLibrary');
			return false;	
		}
		
		$g = @getimagesize($path);
		
		if(empty($g))
		{
			self::$error = get_message('Image', 'image_file_not_found_error', $path);
			report('Error', self::$error, 'ImageLibrary');
			return false;	
		}
		
		$x = $g[0]; $y = $g[1];
		
		if($width > 0)
		{
			if($width <= $x)
			{
				$o = $x / $width;
				
				$x = $width;
				
				$y = $y / $o;
			}
			else
			{
				$o = $width / $x;
				
				$x = $width;
				
				$y = $y * $o;	
			}
		}
		
		if($height > 0)
		{
			if($height <= $y)
			{
				$o = $y / $height;
				
				$y = $height;
				
				$x = $x / $o;
			}
			else
			{
				$o = $height / $y;
				
				$y = $height;
				
				$x = $x * $o;	
			}
		}
		$array["width"] = round($x); $array["height"] = round($y);
		
		return (object)$array;
	}
	
	public static function error()
	{
		if(isset(self::$error))
			return self::$error;
		else
			return false;
	}
	
}
