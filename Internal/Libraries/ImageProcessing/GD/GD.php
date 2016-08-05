<?php
namespace ZN\ImageProcessing;

class InternalGD extends \CallController implements GDInterface
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
	// Canvas
	//----------------------------------------------------------------------------------------------------
	// 
	// @var string
	//
	//----------------------------------------------------------------------------------------------------
	protected $canvas;
	
	//----------------------------------------------------------------------------------------------------
	// Save
	//----------------------------------------------------------------------------------------------------
	// 
	// @var string
	//
	//----------------------------------------------------------------------------------------------------
	protected $save;
	
	//----------------------------------------------------------------------------------------------------
	// Quality
	//----------------------------------------------------------------------------------------------------
	// 
	// @var string
	//
	//----------------------------------------------------------------------------------------------------
	protected $quality = 0;
	
	//----------------------------------------------------------------------------------------------------
	// Type
	//----------------------------------------------------------------------------------------------------
	// 
	// @var string
	//
	//----------------------------------------------------------------------------------------------------
	protected $type = 'jpeg';
	
	//----------------------------------------------------------------------------------------------------
	// Output
	//----------------------------------------------------------------------------------------------------
	// 
	// @var string
	//
	//----------------------------------------------------------------------------------------------------
	protected $output = true;
	
	//----------------------------------------------------------------------------------------------------
	// Result
	//----------------------------------------------------------------------------------------------------
	// 
	// @var array
	//
	//----------------------------------------------------------------------------------------------------
	protected $result = [];
	
	//----------------------------------------------------------------------------------------------------
	// Info
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function info()
	{
		return gd_info();	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Thumb
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $filePath
	// @param array  $settings
	//
	//----------------------------------------------------------------------------------------------------
	public function thumb(String $filePath, Array $settings)
	{
		return \Image::thumb($filePath, $settings);	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Canvas
	//----------------------------------------------------------------------------------------------------
	// 
	// @param mixed  $width
	// @param int    $height
	// @param string $rgb
	// @param bool   $real
	// @param int    $p1
	//
	//----------------------------------------------------------------------------------------------------
	public function canvas($width, $height, $rgb = 'transparent', $real = false, $p1 = 0)
	{
		if( is_file($width) )
		{
			$this->type   = extension($width);
			$this->canvas = $this->createFrom($this->type, $width, $height, $rgb, $real, $p1);
			
			return $this;
		}
		
		if( $real === false )
		{
			$this->canvas = imagecreate($width, $height);	
		}
		else
		{
			$this->canvas = imagecreatetruecolor($width, $height);
		}
		
		if( ! empty($rgb) )
		{
			$this->allocate($rgb);
		}
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Create Form
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $type
	// @param string $source
	// @param array  $settings
	//
	//----------------------------------------------------------------------------------------------------
	public function createFrom(String $type, String $source, Array $settings = NULL)
	{
		$type = strtolower($type);
		
		switch( $type )	
		{
			case 'gd2' 	  : $return = imagecreatefromgd2($source); 		break;
			case 'gd'     : $return = imagecreatefromgd($source);  		break;	
			case 'gif'    : $return = imagecreatefromgif($source); 		break;
			case 'jpeg'   : $return = imagecreatefromjpeg($source); 	break;
			case 'png'    : $return = imagecreatefrompng($source); 		break;	
			case 'string' : $return = imagecreatefromstring($source); 	break;	
			case 'wbmp'   : $return = imagecreatefromwbmp($source); 	break;	
			case 'webp'   : $return = imagecreatefromwebp($source);	 	break;
			case 'xbm'    : $return = imagecreatefromxbm($source); 		break;
			case 'xpm'    : $return = imagecreatefromxpm($source); 		break;
			case 'gd2p'   : $return = imagecreatefromgd2part
			(
				$source, 
				isset($settings['x'])      ? $settings['x']      : NULL, 
				isset($settings['y'])      ? $settings['y']      : NULL, 
				isset($settings['width'])  ? $settings['width']  : NULL, 
				isset($settings['height']) ? $settings['height'] : NULL
			);
		}
		
		return $return;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Size
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $fileName
	//
	//----------------------------------------------------------------------------------------------------
	public function size(String $fileName)
	{
		if( extension($fileName) && is_file($fileName) )
		{
			$data = getimagesize($fileName);	
		}
		elseif( is_string($fileName) )
		{
			$data = getimagesizefromstring($fileName);	
		}
		else
		{
			return \Exceptions::throws('Error', 'fileParameter', '1.(fileName)');	
		}
		
		$newData['width'] 		= $data[0];
		$newData['height'] 		= $data[1]; 
		$newData['extension'] 	= $this->extension($data[2]);
		$newData['img']			= $data['3'];
		$newData['bits']		= $data['bits'];
		$newData['mime']		= $data['mime'];
		
		return (object) $newData;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Extension
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $type
	// @param bool   $dote
	//
	//----------------------------------------------------------------------------------------------------
	public function extension(String $type = NULL, Boolean $dote = NULL)
	{
		nullCoalesce($type, 'jpeg');
		nullCoalesce($dote, true);

		return image_type_to_extension(\Convert::toConstant($type, 'IMAGETYPE_'), $dote);	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Mime
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $type
	//
	//----------------------------------------------------------------------------------------------------
	public function mime(String $type = NULL)
	{
		nullCoalesce($type, 'jpeg');

		return image_type_to_mime_type(\Convert::toConstant($type, 'IMAGETYPE_'));	
	}
	
	//----------------------------------------------------------------------------------------------------
	// To Wbmp
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $fileName
	// @param int    $threshold
	//
	//----------------------------------------------------------------------------------------------------
	public function toWbmp(String $fileName, $threshold = NULL)
	{
		image2wbmp($this->canvas, $fileName, $threshold);

		return $this; 	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Jpep To Wbmp
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $jpegFile
	// @param string $wbmpFile
	// @param array  $setings
	//
	//----------------------------------------------------------------------------------------------------
	public function jpegToWbmp(String $jpegFile, String $wbmpFile, Array $settings = NULL)
	{
		if( is_file($jpegFile) )
		{
			$height    = isset($settings['height'])    ? $settings['height']    : 0;
			$width     = isset($settings['width'])     ? $settings['width']     : 0;
			$threshold = isset($settings['threshold']) ? $settings['threshold'] : 0;
			
			return jpeg2wbmp($jpegFile, $wbmpFile, $height, $width, $threshold);
		}
		else
		{
			return false;
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Png To Wbmp
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $pngFile
	// @param string $wbmpFile
	// @param array  $setings
	//
	//----------------------------------------------------------------------------------------------------
	public function pngToWbmp(String $pngFile, String $wbmpFile, Array $settings = NULL)
	{
		if( is_file($pngFile) )
		{
			$height    = isset($settings['height'])    ? $settings['height']    : 0;
			$width     = isset($settings['width'])     ? $settings['width']     : 0;
			$threshold = isset($settings['threshold']) ? $settings['threshold'] : 0;
			
			return png2wbmp($pngFile, $wbmpFile, $height, $width, $threshold);
		}
		else
		{
			return false;	
		}	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Alpha Blending
	//----------------------------------------------------------------------------------------------------
	// 
	// @param bool $blendMode
	//
	//----------------------------------------------------------------------------------------------------
	public function alphaBlending(Boolean $blendMode = NULL)
	{
		imagealphablending($this->canvas, (bool) $blendMode);
		
		return $this;	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Save Alpha
	//----------------------------------------------------------------------------------------------------
	// 
	// @param bool $save
	//
	//----------------------------------------------------------------------------------------------------
	public function saveAlpha(Boolean $save = NULL)
	{
		nullCoalesce($save, true);

		imagesavealpha($this->canvas, $save);
		
		return $this;	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Smooth
	//----------------------------------------------------------------------------------------------------
	// 
	// @param bool $mode
	//
	//----------------------------------------------------------------------------------------------------
	public function smooth(Boolean $mode = NULL)
	{
		nullCoalesce($mode, true);

		imageantialias($this->canvas, $mode);	
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Arc
	//----------------------------------------------------------------------------------------------------
	// 
	// @param array $settings
	//
	//----------------------------------------------------------------------------------------------------
	public function arc(Array $settings)
	{
		$x 		= isset($settings['x'])      ? $settings['x']		: 0;
		$y 		= isset($settings['y']) 	 ? $settings['y']		: 0;
		$width 	= isset($settings['width'])  ? $settings['width']   : 100;
		$height = isset($settings['height']) ? $settings['height']  : 100;
		$start 	= isset($settings['start'])  ? $settings['start']   : 0;
		$end 	= isset($settings['end'])    ? $settings['end']     : 360;
		$color 	= isset($settings['color'])  ? $settings['color']   : '0|0|0';
		$style 	= isset($settings['type'])   ? $settings['type']    : NULL;
		
		if( $style === NULL )
		{
			imagearc($this->canvas, $x, $y, $width, $height, $start, $end, $this->allocate($color));	
		}
		else
		{
			imagefilledarc
			(
				$this->canvas, $x, $y, $width, $height, $start, $end, 
				$this->allocate($color), 
				\Convert::toConstant($style, 'IMG_ARC_')
			);
		}
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Ellipse
	//----------------------------------------------------------------------------------------------------
	// 
	// @param array $settings
	//
	//----------------------------------------------------------------------------------------------------
	public function ellipse(Array $settings)
	{
		$x 		= isset($settings['x'])      ? $settings['x']		: 0;
		$y 		= isset($settings['y']) 	 ? $settings['y']		: 0;
		$width 	= isset($settings['width'])  ? $settings['width']   : 100;
		$height = isset($settings['height']) ? $settings['height']  : 100;
		$color 	= isset($settings['color'])  ? $settings['color']   : '0|0|0';
		$style 	= isset($settings['type'])   ? $settings['type']    : NULL;
			
		if( $style === NULL )
		{	
			imageellipse($this->canvas, $x, $y, $width, $height, $this->allocate($color));	
		}
		else
		{
			imagefilledellipse($this->canvas, $x, $y, $width, $height, $this->allocate($color));
		}
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Polygon
	//----------------------------------------------------------------------------------------------------
	// 
	// @param array $settings
	//
	//----------------------------------------------------------------------------------------------------
	public function polygon(Array $settings)
	{
		$points 	= isset($settings['points'])     ? $settings['points']	   : 0;
		$pointCount = isset($settings['pointCount']) ? $settings['pointCount'] : ceil(count($points) / 2);
		$color 		= isset($settings['color'])      ? $settings['color']  	   : '0|0|0';
		$style 		= isset($settings['type'])       ? $settings['type']       : NULL;
			
		if( $style === NULL )
		{	
			imagepolygon($this->canvas, $points, $pointCount, $this->allocate($color));	
		}
		else
		{
			imagefilledpolygon($this->canvas, $points, $pointCount, $this->allocate($color));	
		}
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Rectangle
	//----------------------------------------------------------------------------------------------------
	// 
	// @param array $settings
	//
	//----------------------------------------------------------------------------------------------------
	public function rectangle(Array $settings)
	{
		$x      = isset($settings['x'])      ? $settings['x']	   : 0;
		$y      = isset($settings['y'])      ? $settings['y']      : 0;
		$width  = isset($settings['width'])  ? $settings['width']  : 100;
		$height = isset($settings['height']) ? $settings['height'] : 100;
		$color  = isset($settings['color'])  ? $settings['color']  : '0|0|0';
		$style  = isset($settings['type'])   ? $settings['type']   : NULL;
		
		$width  += $x;
		$height += $y;
 			
		if( $style === NULL )
		{	
			imagerectangle($this->canvas, $x, $y, $width, $height, $this->allocate($color));	
		}
		else
		{
			imagefilledrectangle($this->canvas, $x, $y, $width, $height, $this->allocate($color));	
		}
		
		return $this;
	}
	
	
	//----------------------------------------------------------------------------------------------------
	// Fill
	//----------------------------------------------------------------------------------------------------
	// 
	// @param array $settings
	//
	//----------------------------------------------------------------------------------------------------
	public function fill(Array $settings)
	{
		$x 		= isset($settings['x'])      ? $settings['x']		: 0;
		$y 		= isset($settings['y']) 	 ? $settings['y']		: 0;
		$color 	= isset($settings['color'])  ? $settings['color']   : '0|0|0';
				
		imagefill($this->canvas, $x, $y, $this->allocate($color));	
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Fill Area
	//----------------------------------------------------------------------------------------------------
	// 
	// @param array $settings
	//
	//----------------------------------------------------------------------------------------------------
	public function fillArea(Array $settings)
	{
		$x 			 = isset($settings['x'])      		? $settings['x']			: 0;
		$y 			 = isset($settings['y']) 	 		? $settings['y']			: 0;
		$borderColor = isset($settings['borderColor'])  ? $settings['borderColor']  : '0|0|0';
		$color 	     = isset($settings['color'])  		? $settings['color']   		: '255|255|255';
				
		imagefilltoborder($this->canvas, $x, $y, $this->allocate($borderColor), $this->allocate($color));
		
		return $this;	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Filter
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $filter
	//
	//----------------------------------------------------------------------------------------------------
	public function filter(String $filter, $arg1 = 0, $arg2 = 0, $arg3 = 0, $arg4 = 0)
	{			
		imagefilter($this->canvas, \Convert::toConstant($filter, 'IMG_FILTER_'), $arg1, $arg2, $arg3, $arg4);
		
		return $this;	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Flip
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $type
	//
	//----------------------------------------------------------------------------------------------------
	public function flip(String $type = NULL)
	{	
		nullCoalesce($type, 'both');

		imageflip($this->canvas, \Convert::toConstant($type, 'IMG_FLIP_'));
		
		return $this;	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Char
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $char
	// @param array  $settings
	//
	//----------------------------------------------------------------------------------------------------
	public function char(String $char, Array $settings)
	{
		$x 		= isset($settings['x'])      ? $settings['x']		: 0;
		$y 		= isset($settings['y']) 	 ? $settings['y']		: 0;
		$font 	= isset($settings['font'])   ? $settings['font']    : 1;
		$color 	= isset($settings['color'])  ? $settings['color']   : '0|0|0';
		$type   = isset($settings['type'])   ? $settings['type']    : NULL;
		
		if( $type === 'vertical')
		{
			imagecharup($this->canvas, $font, $x, $y, $char, $this->allocate($color));	
		}
		else
		{
			imagechar($this->canvas, $font, $x, $y, $char, $this->allocate($color));	
		}
		
		return $this;
	}  
	
	//----------------------------------------------------------------------------------------------------
	// Text
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $text
	// @param array  $settings
	//
	//----------------------------------------------------------------------------------------------------
	public function text(String $text, Array $settings)
	{
		$x 		= isset($settings['x'])      ? $settings['x']		: 0;
		$y 		= isset($settings['y']) 	 ? $settings['y']		: 0;
		$font 	= isset($settings['font'])   ? $settings['font']    : 1;
		$color 	= isset($settings['color'])  ? $settings['color']   : '0|0|0';
		$type   = isset($settings['type'])   ? $settings['type']    : NULL;
		
		if( $type === 'vertical')
		{
			imagestringup($this->canvas, $font, $x, $y, $text, $this->allocate($color));	
		}
		else
		{
			imagestring($this->canvas, $font, $x, $y, $text, $this->allocate($color));	
		}
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Closest
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $rgb
	//
	//----------------------------------------------------------------------------------------------------
	public function closest(String $rgb)
	{
		$rgb = explode('|', $rgb);
		
		$red   = isset($rgb[0]) ? $rgb[0] : 0;
		$green = isset($rgb[1]) ? $rgb[1] : 0;
		$blue  = isset($rgb[2]) ? $rgb[2] : 0;
		$alpha = isset($rgb[3]) ? $rgb[3] : 0;
		
		return imagecolorclosestalpha($this->canvas, $red, $green, $blue, $alpha);
	} 
	
	//----------------------------------------------------------------------------------------------------
	// Resolve
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $rgb
	//
	//----------------------------------------------------------------------------------------------------
	public function resolve(String $rgb)
	{
		$rgb = explode('|', $rgb);
		
		$red   = isset($rgb[0]) ? $rgb[0] : 0;
		$green = isset($rgb[1]) ? $rgb[1] : 0;
		$blue  = isset($rgb[2]) ? $rgb[2] : 0;
		$alpha = isset($rgb[3]) ? $rgb[3] : 0;
		
		return imagecolorresolvealpha($this->canvas, $red, $green, $blue, $alpha);
	} 
	
	//----------------------------------------------------------------------------------------------------
	// Index
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $rgb
	//
	//----------------------------------------------------------------------------------------------------
	public function index(String $rgb)
	{
		$rgb = explode('|', $rgb);
		
		$red   = isset($rgb[0]) ? $rgb[0] : 0;
		$green = isset($rgb[1]) ? $rgb[1] : 0;
		$blue  = isset($rgb[2]) ? $rgb[2] : 0;
		$alpha = isset($rgb[3]) ? $rgb[3] : 0;
		
		return imagecolorexactalpha($this->canvas, $red, $green, $blue, $alpha);
	} 
	
	//----------------------------------------------------------------------------------------------------
	// Pixel Index
	//----------------------------------------------------------------------------------------------------
	// 
	// @param int $x
	// @param int $y
	//
	//----------------------------------------------------------------------------------------------------
	public function pixelIndex($x, $y)
	{
		return imagecolorat($this->canvas, (int) $x, (int) $y);
	} 
	
	//----------------------------------------------------------------------------------------------------
	// Closest Hwb
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $rgb
	//
	//----------------------------------------------------------------------------------------------------
	public function closestHwb(String $rgb)
	{
		$rgb = explode('|', $rgb);
		
		$red   = isset($rgb[0]) ? $rgb[0] : 0;
		$green = isset($rgb[1]) ? $rgb[1] : 0;
		$blue  = isset($rgb[2]) ? $rgb[2] : 0;
		
		return imagecolorclosesthwb($this->canvas, $red, $green, $blue);
	} 
	
	//----------------------------------------------------------------------------------------------------
	// Match
	//----------------------------------------------------------------------------------------------------
	// 
	// @param resource $sourceImage
	//
	//----------------------------------------------------------------------------------------------------
	public function match($sourceImage)
	{
		if( ! is_resource($sourceImage) )
		{
			return \Exceptions::throws('Error', 'resourceParameter', '1.(sourceImage)');
		}

		imagecolormatch($this->canvas, $sourceImage);
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Set
	//----------------------------------------------------------------------------------------------------
	// 
	// @param int    $index
	// @param string $rgb
	//
	//----------------------------------------------------------------------------------------------------
	public function set($index = 0, String $rgb)
	{	
		$rgb = explode('|', $rgb);
		
		$red   = isset($rgb[0]) ? $rgb[0] : 0;
		$green = isset($rgb[1]) ? $rgb[1] : 0;
		$blue  = isset($rgb[2]) ? $rgb[2] : 0;
		
		imagecolorset($this->canvas, $index, $red, $green, $blue);
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Total
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function total()
	{	
		return imagecolorstotal($this->canvas);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Transparent
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $rgb
	//
	//----------------------------------------------------------------------------------------------------
	public function transparent(String $rgb)
	{
		imagecolortransparent($this->canvas, $this->allocate($rgb));
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Convolution
	//----------------------------------------------------------------------------------------------------
	// 
	// @param array $matrix
	// @param int   $div
	// @param int   $offset
	//
	//----------------------------------------------------------------------------------------------------
	public function convolution(Array $matrix, $div = 0, $offset = 0)
	{
		imageconvolution($this->canvas, $matrix, $div, $offset);
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Interlace
	//----------------------------------------------------------------------------------------------------
	// 
	// @param int $interlace
	//
	//----------------------------------------------------------------------------------------------------
	public function interlace($interlace = 0)
	{
		imageinterlace($this->canvas, (int) $interlace);
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Copy
	//----------------------------------------------------------------------------------------------------
	// 
	// @param resource $source
	// @param array    $settings
	//
	//----------------------------------------------------------------------------------------------------
	public function copy($source, Array $settings)
	{
		if( ! is_resource($source) )
		{
			return \Exceptions::throws('Error', 'resourceParameter', '1.(source)');
		}
		
		$xt 	= isset($settings['xt'])     ? $settings['xt']	   : 0;
		$yt 	= isset($settings['yt']) 	 ? $settings['yt']	   : 0;
		$xs 	= isset($settings['xs'])  	 ? $settings['xs']     : 0;
		$ys 	= isset($settings['ys']) 	 ? $settings['ys']     : 0;
		$width 	= isset($settings['width'])  ? $settings['width']  : 0;
		$height = isset($settings['height']) ? $settings['height'] : 0;
				
		imagecopy($this->canvas, $source, $xt, $yt, $xs, $ys, $width, $height);	
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Mix
	//----------------------------------------------------------------------------------------------------
	// 
	// @param resource $source
	// @param array    $settings
	//
	//----------------------------------------------------------------------------------------------------
	public function mix($source, Array $settings)
	{
		if( ! is_resource($source) )
		{
			return \Exceptions::throws('Error', 'resourceParameter', '1.(source)');
		}
		
		$xt 	 = isset($settings['xt'])      ? $settings['xt']	  : 0;
		$yt 	 = isset($settings['yt']) 	   ? $settings['yt']	  : 0;
		$xs 	 = isset($settings['xs'])  	   ? $settings['xs']      : 0;
		$ys 	 = isset($settings['ys']) 	   ? $settings['ys']      : 0;
		$width 	 = isset($settings['width'])   ? $settings['width']   : 0;
		$height  = isset($settings['height'])  ? $settings['height']  : 0;
		$percent = isset($settings['percent']) ? $settings['percent'] : 0;
				
		imagecopymerge($this->canvas, $source, $xt, $yt, $xs, $ys, $width, $height, $percent);	
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Mix Gray
	//----------------------------------------------------------------------------------------------------
	// 
	// @param resource $source
	// @param array    $settings
	//
	//----------------------------------------------------------------------------------------------------
	public function mixGray($source, Array $settings)
	{
		if( ! is_resource($source) )
		{
			return \Exceptions::throws('Error', 'resourceParameter', '1.(source)');
		}
		
		$xt 	 = isset($settings['xt'])      ? $settings['xt']	  : 0;
		$yt 	 = isset($settings['yt']) 	   ? $settings['yt']	  : 0;
		$xs 	 = isset($settings['xs'])  	   ? $settings['xs']      : 0;
		$ys 	 = isset($settings['ys']) 	   ? $settings['ys']      : 0;
		$width 	 = isset($settings['width'])   ? $settings['width']   : 0;
		$height  = isset($settings['height'])  ? $settings['height']  : 0;
		$percent = isset($settings['percent']) ? $settings['percent'] : 0;
				
		imagecopymergegray($this->canvas, $source, $xt, $yt, $xs, $ys, $width, $height, $percent);	
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Resample
	//----------------------------------------------------------------------------------------------------
	// 
	// @param resource $source
	// @param array    $settings
	//
	//----------------------------------------------------------------------------------------------------
	public function resample($source, Array $settings)
	{
		if( ! is_resource($source) )
		{
			return \Exceptions::throws('Error', 'resourceParameter', '1.(source)');
		}
		
		$xt = isset($settings['xt']) ? $settings['xt'] : 0;
		$yt = isset($settings['yt']) ? $settings['yt'] : 0;
		$xs	= isset($settings['xs']) ? $settings['xs'] : 0;
		$ys	= isset($settings['ys']) ? $settings['ys'] : 0;
		$wt = isset($settings['wt']) ? $settings['wt'] : 0;
		$ht = isset($settings['ht']) ? $settings['ht'] : 0;
		$ws = isset($settings['ws']) ? $settings['ws'] : 0;
		$hs = isset($settings['hs']) ? $settings['hs'] : 0;
				
		imagecopyresampled($this->canvas, $source, $xt, $yt, $xs, $ys, $wt, $yt, $ws, $hs);
		
		return $this;	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Resize
	//----------------------------------------------------------------------------------------------------
	// 
	// @param resource $source
	// @param array    $settings
	//
	//----------------------------------------------------------------------------------------------------
	public function resize($source, Array $settings)
	{
		if( ! is_resource($source) )
		{
			return \Exceptions::throws('Error', 'resourceParameter', '1.(source)');
		}
		
		$xt = isset($settings['xt']) ? $settings['xt'] : 0;
		$yt = isset($settings['yt']) ? $settings['yt'] : 0;
		$xs	= isset($settings['xs']) ? $settings['xs'] : 0;
		$ys	= isset($settings['ys']) ? $settings['ys'] : 0;
		$wt = isset($settings['wt']) ? $settings['wt'] : 0;
		$ht = isset($settings['ht']) ? $settings['ht'] : 0;
		$ws = isset($settings['ws']) ? $settings['ws'] : 0;
		$hs = isset($settings['hs']) ? $settings['hs'] : 0;
				
		imagecopyresized($this->canvas, $source, $xt, $yt, $xs, $ys, $wt, $yt, $ws, $hs);
		
		return $this;	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Crop
	//----------------------------------------------------------------------------------------------------
	// 
	// @param array $settings
	//
	//----------------------------------------------------------------------------------------------------
	public function crop(Array $settings)
	{
		imagecrop($this->canvas, $settings);	
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Auto Crop
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string  $mode
	// @param numeric $threshold
	// @param numeric $color
	//
	//----------------------------------------------------------------------------------------------------
	public function autoCrop(String $mode = NULL, $threshold = .5, $color = -1)
	{
		nullCoalesce($mode, 'default');

		imagecropauto($this->canvas, \Convert::toConstant($mode, 'IMG_CROP_'), $threshold, $color);	
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Line
	//----------------------------------------------------------------------------------------------------
	// 
	// @param array $settings
	//
	//----------------------------------------------------------------------------------------------------
	public function line(Array $settings)
	{
		$x1   = isset($settings['x1']) ? $settings['x1'] : 0;
		$y1   = isset($settings['y1']) ? $settings['y1'] : 0;
		$x2	  = isset($settings['x2']) ? $settings['x2'] : 0;
		$y2	  = isset($settings['y2']) ? $settings['y2'] : 0;
		$rgb  = isset($settings['color']) ? $settings['color'] : '0|0|0';
		$type = isset($settings['type']) ? $settings['type'] : 'solid';
		
		$type = strtolower($type);
		
		if( $type === 'solid' )	
		{
			imageline($this->canvas, $x1, $y1, $x2, $y2, $this->allocate($rgb));
		}
		elseif( $type === 'dashed' )
		{
			imagedashedline($this->canvas, $x1, $y1, $x2, $y2, $this->allocate($rgb));
		}
	
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Font Height
	//----------------------------------------------------------------------------------------------------
	// 
	// @param int $height
	//
	//----------------------------------------------------------------------------------------------------
	public function fontHeight($height)
	{	
		return imagefontheight((int) $height);	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Font Width
	//----------------------------------------------------------------------------------------------------
	// 
	// @param int $width
	//
	//----------------------------------------------------------------------------------------------------
	public function fontWidth($width)
	{	
		return imagefontwidth((int) $width);	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Quality
	//----------------------------------------------------------------------------------------------------
	// 
	// @param int $quality
	//
	//----------------------------------------------------------------------------------------------------
	public function quality($quality)
	{
		$this->quality = (int) $quality;
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Save
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $file
	//
	//----------------------------------------------------------------------------------------------------
	public function save(String $file)
	{
		$this->save = $file;
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Type
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $type
	//
	//----------------------------------------------------------------------------------------------------
	public function type(String $type)
	{
		$this->type = $type;
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Output
	//----------------------------------------------------------------------------------------------------
	// 
	// @param boolean $output
	//
	//----------------------------------------------------------------------------------------------------
	public function output(Boolean $output)
	{
		$this->output = $output;
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Screenshot
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function screenshot()
	{
		$this->canvas = imagegrabscreen();
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Rotate
	//----------------------------------------------------------------------------------------------------
	// 
	// @param int    $angle
	// @param string $spaceColor
	// @param int    $ignoreTransparent
	//
	//----------------------------------------------------------------------------------------------------
	public function rotate($angle, $spaceColor = '0|0|0', $ignoreTransparent = 0)
	{
		$this->canvas = imagerotate($this->canvas, $angle, $this->allocate($spaceColor), $ignoreTransparent);
		
		if( $spaceColor === 'transparent' )
		{
			$this->saveAlpha();
		}
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Scale
	//----------------------------------------------------------------------------------------------------
	// 
	// @param int    $width
	// @param int    $height
	// @param string $mode
	//
	//----------------------------------------------------------------------------------------------------
	public function scale($width, $height = -1, $mode = 'bilinear_fixed')
	{
		$this->canvas = imagescale($this->canvas, $width, $height, \Convert::toConstant($mode, 'IMG_'));
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Interpolation
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $method
	//
	//----------------------------------------------------------------------------------------------------
	public function interpolation(String $method = NULL)
	{
		nullCoalesce($method, 'bilinear_fixed');

		imagesetinterpolation($this->canvas, \Convert::toConstant($method, 'IMG_'));
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Pixel
	//----------------------------------------------------------------------------------------------------
	// 
	// @param array $settings
	//
	//----------------------------------------------------------------------------------------------------
	public function pixel(Array $settings)
	{
		$x   = isset($settings['x'])     ? $settings['x'] : 0;
		$y   = isset($settings['y'])     ? $settings['y'] : 0;
		$rgb = isset($settings['color']) ? $settings['color'] : '0|0|0';
		
		imagesetpixel($this->canvas, $x, $y, $this->allocate($rgb));
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Style
	//----------------------------------------------------------------------------------------------------
	// 
	// @param array $style
	//
	//----------------------------------------------------------------------------------------------------
	public function style(Array $style)
	{
		imagesetstyle($this->canvas, $style);
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Thickness
	//----------------------------------------------------------------------------------------------------
	// 
	// @param int $thickness
	//
	//----------------------------------------------------------------------------------------------------
	public function thickness($thickness = 1)
	{
		imagesetthickness($this->canvas, $thickness);
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Tile
	//----------------------------------------------------------------------------------------------------
	// 
	// @param resources $tile
	//
	//----------------------------------------------------------------------------------------------------
	public function tile($tile)
	{
		if( ! is_resource($tile) )
		{
			return \Exceptions::throws('Error', 'resourceParameter', '1.(tile)');	
		}
		
		imagesettile($this->canvas, $tile);
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Window Display
	//----------------------------------------------------------------------------------------------------
	// 
	// @param int $window
	// @param int $clientArea
	//
	//----------------------------------------------------------------------------------------------------
	public function windowDisplay($window, $clientArea = 0)
	{
		$this->canvas = imagegrabwindow($window, $clientArea);
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Layer Effect
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $effect
	//
	//----------------------------------------------------------------------------------------------------
	public function layerEffect(String $effect = NULL)
	{	
		nullCoalesce($effect, 'normal');

		imagelayereffect($this->canvas, \Convert::toConstant($effect, 'IMG_EFFECT_'));	
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Load Font
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $file
	//
	//----------------------------------------------------------------------------------------------------
	public function loadFont(String $file)
	{	
		if( ! is_file($file) )
		{
			return \Exceptions::throws('Error', 'fileParameter', '1.(file)');	
		}
		
		return imageloadfont($file);	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Copy Palette
	//----------------------------------------------------------------------------------------------------
	// 
	// @param resource $source
	//
	//----------------------------------------------------------------------------------------------------
	public function copyPalette($source)
	{	
		if( ! is_resource($source) )
		{
			return \Exceptions::throws('Error', 'resourceParameter', '1.(source)');	
		}
		
		return imagepalettecopy($this->canvas, $source);	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Canvas Width
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function canvasWidth()
	{	
		return imagesx($this->canvas);	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Canvas Height
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function canvasHeight()
	{	
		return imagesy($this->canvas);	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Types
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function types()
	{	
		return imagetypes();	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Generate
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $type
	// @param string $save
	//
	//----------------------------------------------------------------------------------------------------
	public function generate(String $type = NULL, String $save = NULL)
	{	
		$canvas = $this->canvas;
		
		if( ! empty($type) )
		{
			$this->type = $type;	
		}
		
		if( ! empty($save) )
		{
			$this->save = $save;	
		}
	
		if( empty($this->save) && $this->output === true )
		{
			$this->_content();
		}
		
		$this->_types();
		$this->_destroy();
		$this->_defaultVariables();
		
		return $canvas;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Result
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function result()
	{
		if( empty($this->result['path']) )
		{
			return 'No Result!';
		}
		
		return \Html::image($this->result['path']);	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Colors
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $rgb
	//
	//----------------------------------------------------------------------------------------------------
	protected function _colors($rgb)
	{
		// Renkler küçük isimlerle yazılmıştır.
		$rgb    = strtolower($rgb);
		$colors = \Config::get('Colors');
		
		if( isset($colors[$rgb]) )
		{
			return $colors[$rgb];
		}
		else
		{
			return '0|0|0|127';	
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Allocate
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $rgb
	//
	//----------------------------------------------------------------------------------------------------
	protected function allocate($rgb)
	{
		$rgb = explode('|', $this->_colors($rgb));
		
		$red   = isset($rgb[0]) ? $rgb[0] : 0;
		$green = isset($rgb[1]) ? $rgb[1] : 0;
		$blue  = isset($rgb[2]) ? $rgb[2] : 0;
		$alpha = isset($rgb[3]) ? $rgb[3] : 0;
		
		return imagecolorallocatealpha($this->canvas, $red, $green, $blue, $alpha);
	} 
		
	//----------------------------------------------------------------------------------------------------
	// Protected Destroy
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	protected function _destroy()
	{
		imagedestroy($this->canvas);
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Content
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	protected function _content()
	{
		header("Content-type: image/".$this->type);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Default Variables
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	protected function _defaultVariables()
	{
		$this->canvas  = NULL;
		$this->save    = NULL;
		$this->type    = 'jpeg';
		$this->quality = 0;
		$this->output  = true;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Types
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	protected function _types()
	{
		$type = strtolower($this->type);
		
		if( ! empty($this->save) )
		{
			$save = suffix($this->save, '.'.$type);
			$this->result['path'] = $save;
		}
		else
		{
			$save = NULL;	
		}
		
		if( $type === 'jpeg' )
		{
			if( $this->quality === 0 ) 
			{
				$this->quality = 80;
			}
			
			imagejpeg($this->canvas, $save, $this->quality);
		}
		elseif( $type === 'png' )
		{
			if( $this->quality === 0 )
			{
				$this->quality = 8;
			}
			
			imagepng($this->canvas, $save, $this->quality);
		}
		elseif( $type === 'gif' )
		{
			imagegif($this->canvas, $save);
		}
		elseif( $type === 'gd' )
		{
			imagegd($this->canvas, $save);
		}
		elseif( $type === 'gd2' )
		{
			imagegd2($this->canvas, $save, $this->quality);
		}
		elseif( $type === 'wbmp' )
		{
			imagewbmp($this->canvas, $save, $this->quality);
		}
		elseif( $type === 'xbm' )
		{
			imagexbm($this->canvas, $save, $this->quality);
		}
		elseif( $type === 'xpm' )
		{
			imagexpm($this->canvas, $save, $this->quality);
		}
		elseif( $type === 'webp' )
		{
			imagewebp($this->canvas, $save, $this->quality);
		}
		
		return $this;
	}
}