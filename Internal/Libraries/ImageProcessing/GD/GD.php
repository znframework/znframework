<?php
namespace ZN\ImageProcessing;

class InternalGD implements GDInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	/*
	 * Tuval oluşturmak için kullanılır.
	 *
	 * @var resource
	 */
	protected $canvas;
	
	/*
	 * Resmin kaydedileceği dosyayı belirtmek kullanılır.
	 *
	 * @var string
	 */
	protected $save;
	
	/*
	 * Resim kalite bilgisini tutması için kullanılır.
	 *
	 * @var numeric
	 */
	protected $quality = 0;
	
	/*
	 * Oluşturulacak resim türü.
	 *
	 * @var string
	 */
	protected $type = 'jpeg';
	
	/*
	 * Çıktı.
	 *
	 * @var bool
	 */
	protected $output = true;
	
	/*
	 * Sonuç.
	 *
	 * @var array
	 */
	protected $result = [];
	
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
	
	/******************************************************************************************
	* INFO                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Kurulu GD kütüphanesi hakkında bilgi verir.							  |
	
	  @param  void 
	  @return array
	|          																				  |
	******************************************************************************************/
	public function info()
	{
		return gd_info();	
	}
	
	/******************************************************************************************
	* THUMB                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Image kütüphanesinin thumb() işlevini uygular.     					  |
	
	  @param  string $filePath 
	  @param  array  $settings
	  @return string
	|          																				  |
	******************************************************************************************/
	public function thumb($filePath = '', $settings = [])
	{
		return \Image::thumb($filePath, $settings);	
	}
	
	/******************************************************************************************
	* CANVAS                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Yeni bir paletli resim oluşturur.										  |
	
	  @param  numeric  $width
	  @param  numeric  $height
	  @param  numeric  $rgb transparent
	  @param  numeric  $real false -> false:create, true:createtruecolor
	   
	  @return resource
	|          																				  |
	******************************************************************************************/
	public function canvas($width = '', $height = '', $rgb = 'transparent', $real = false, $p1 = 0)
	{
		if( is_file($width) )
		{
			$this->type   = extension($width);
			$this->canvas = $this->createFrom($this->type, $width, $height, $rgb, $real, $p1);
			
			return $this;
		}
		
		if( ! is_numeric($width) || ! is_numeric($height) )
		{
			\Errors::set('Error', 'numericParameter', '1.(width) & 2.(height)');
			
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
	
	/******************************************************************************************
	* CREATE FROM                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen türe göre kaynaktan resim oluşturulur. 					  |
	
	  @param  string  $type -> gd2, gd2p, gd, gif, jpeg, png, string, wbmp, webp, xbm, xpm
	  @param  string  $source
	   
	  @return resource
	|          																				  |
	******************************************************************************************/
	public function createFrom($type = '', $source = '', $x = '', $y = '', $width = '', $height = '')
	{
		if( ! is_string($type) || ! is_string($source) )
		{
			return \Errors::set('Error', 'stringParameter', '1.(type) & 2.(source)');
		}
		
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
			case 'gd2p'   : $return = imagecreatefromgd2part($source, $x, $y, $width, $height);
		}
		
		return $return;
	}
	
	/******************************************************************************************
	* SIZE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Bir resmin boyutlarını döndürür.										  |
	
	  @param  string $fileName 
	  @return object
	|          																				  |
	******************************************************************************************/
	public function size($fileName = '')
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
			return \Errors::set('Error', 'fileParameter', '1.(fileName)');	
		}
		
		$newData['width'] 		= $data[0];
		$newData['height'] 		= $data[1]; 
		$newData['extension'] 	= $this->extension($data[2]);
		$newData['img']			= $data['3'];
		$newData['bits']		= $data['bits'];
		$newData['mime']		= $data['mime'];
		
		return (object)$newData;
	}
	
	/******************************************************************************************
	* TYPE EXTENSION                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Resim türüne göre uzantısını verir.				        			  |
	
	  @param  mixed $type
	  @param  bool  $dote true 
	  @return string
	|          																				  |
	******************************************************************************************/
	public function extension($type = 'jpeg', $dote = true)
	{
		return image_type_to_extension(\Convert::toConstant($type, 'IMAGETYPE_'), $dote);	
	}
	
	/******************************************************************************************
	* TYPE MIME                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Resim türüne göre mime türünü verir.				        			  |
	
	  @param  mixed $type
	  @return string
	|          																				  |
	******************************************************************************************/
	public function mime($type = 'jpeg')
	{
		return image_type_to_mime_type(\Convert::toConstant($type, 'IMAGETYPE_'));	
	}
	
	/******************************************************************************************
	* TO WBMP                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Bir dosyaya veya tarayıcıya bir WBMP resmi çıktılar.	      			  |
	
	  @param  string   $fileName
	  @param  numeric  $threshold
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function toWbmp($fileName = '', $threshold = NULL)
	{
		if( is_string($fileName) )
		{
			image2wbmp($this->canvas, $fileName, $threshold);
		}
		else
		{
			\Errors::set('Error', 'stringParameter', '1.(fileName)');	
		}
		
		return $this; 	
	}
	
	/******************************************************************************************
	* JPEG TO WBMP                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Jpeg formatlı resmi wbmp formatına çevirir.			      			  |
	
	  @param  string   $jpegFile
	  @param  string   $wbmpFile
	  @param  array	   $settings -> width, height, threshold
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function jpegToWbmp($jpegFile = '', $wbmpFile = '', $settings = [])
	{
		if( is_file($jpegFile) && is_string($wbmpFile))
		{
			$height    = isset($settings['height'])    ? $settings['height']    : 0;
			$width     = isset($settings['width'])     ? $settings['width']     : 0;
			$threshold = isset($settings['threshold']) ? $settings['threshold'] : 0;
			
			return jpeg2wbmp($jpegFile, $wbmpFile, $height, $width, $threshold);
		}
		else
		{
			\Errors::set('Error', 'fileParameter', '1.(jpegFile)');	
			\Errors::set('Error', 'stringParameter', '2.(wbmpFile)');	
			
			return false;
		}
	}
	
	/******************************************************************************************
	* PNG TO WBMP                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Png formatlı resmi wbmp formatına çevirir.			      			  |
	
	  @param  string   $jpegFile
	  @param  string   $wbmpFile
	  @param  array	   $settings -> width, height, threshold
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function pngToWbmp($pngFile = '', $wbmpFile = '', $settings = [])
	{
		if( is_file($pngFile) && is_string($wbmpFile))
		{
			$height    = isset($settings['height'])    ? $settings['height']    : 0;
			$width     = isset($settings['width'])     ? $settings['width']     : 0;
			$threshold = isset($settings['threshold']) ? $settings['threshold'] : 0;
			
			return png2wbmp($pngFile, $wbmpFile, $height, $width, $threshold);
		}
		else
		{
			\Errors::set('Error', 'fileParameter', '1.(jpegFile)');	
			\Errors::set('Error', 'stringParameter', '2.(wbmpFile)');
			
			return false;	
		}	
	}
	
	/******************************************************************************************
	* ALPHA BLENDING                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Bir resim için harmanlama kipini etkinleştirir.		      			  |
	
	  @param  bool     $blendMode false
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function alphaBlending($blendMode = false)
	{
		if( ! is_bool($blendMode) )
		{
			\Errors::set('Error', 'booleanParameter', '1.(blendMode)');
			
			return $this;
		}
		
		imagealphablending($this->canvas, $blendMode);
		
		return $this;	
	}
	
	/******************************************************************************************
	* SAVE ALPHA                                                                              *
	*******************************************************************************************
	| Genel Kullanım: PNG resimleri kaydederken (tek renkli şeffaflığın tersine) alfa kanalı  |
	  bilgisinin kaydedilip kaydedilmeyeceğini belirtir.		      			 
	
	  @param  bool     $save true
	  @return object
	|          																				  |
	******************************************************************************************/
	public function saveAlpha($save = true)
	{
		imagesavealpha($this->canvas, $save);
		
		return $this;	
	}
	
	/******************************************************************************************
	* SMOOTH	                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Resmin kenarlarına yumuşatma uygular .	        	      			  |

	  @param  bool     $mode true
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function smooth($mode = true)
	{
		if( ! is_bool($mode) )
		{
			\Errors::set('Error', 'booleanParameter', '1.(mode)');
			
			return $this;
		}
		
		imageantialias($this->canvas, $mode);	
		
		return $this;
	}
	
	/******************************************************************************************
	* ARC                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Yay çizer.	  								      	      			  |
	
	  @param  array    $settings
				       $settings['type'] = pie, chord, nofill, edged
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function arc($settings = [])
	{
		if( ! is_array($settings) )
		{
			\Errors::set('Error', 'arrayParameter', '1.(settings)');
			
			return $this;
		}
		
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
	
	/******************************************************************************************
	* ELLIPSE                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Bir elips çizer.	 							      	      			  |
	
	  @param  array    $settings
	  				   $settings['type'] fill veya NULL
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function ellipse($settings = [])
	{
		if( ! is_array($settings) )
		{
			\Errors::set('Error', 'arrayParameter', '1.(settings)');
			
			return $this;
		}
		
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
	
	/******************************************************************************************
	* POLYGON                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Çokgen çizer.	 								      	      			  |
	
	  @param  array    $settings
	  				   $settings['type'] fill ve NULL
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function polygon($settings = [])
	{
		if( ! is_array($settings) )
		{
			\Errors::set('Error', 'arrayParameter', '1.(settings)');
			
			return $this;
		}
		
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
	
	/******************************************************************************************
	* RECTANGLE                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Dörtgen çizer.								      	      			  |
	
	  @param  array    $settings
	  				   $settings['type'] fill ve NULL
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function rectangle($settings = [])
	{
		if( ! is_array($settings) )
		{
			\Errors::set('Error', 'arrayParameter', '1.(settings)');
			
			return $this;
		}
		
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
	
	
	/******************************************************************************************
	* FILL                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Resmi boyar.	 								      	      			  |

	  @param  array    $settings
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function fill($settings = [])
	{
		if( ! is_array($settings) )
		{
			\Errors::set('Error', 'arrayParameter', '2.(settings)');
			
			return $this;
		}
		
		$x 		= isset($settings['x'])      ? $settings['x']		: 0;
		$y 		= isset($settings['y']) 	 ? $settings['y']		: 0;
		$color 	= isset($settings['color'])  ? $settings['color']   : '0|0|0';
				
		imagefill($this->canvas, $x, $y, $this->allocate($color));	
		
		return $this;
	}
	
	/******************************************************************************************
	* FILL AREA                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Resmin belirli bir alanını boyamak için kullanılır.					  |
	
	  @param  array    $settings
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function fillArea($settings = [])
	{
		if( ! is_array($settings) )
		{
			\Errors::set('Error', 'arrayParameter', '1.(settings)');
			
			return $this;
		}
		
		$x 			 = isset($settings['x'])      		? $settings['x']			: 0;
		$y 			 = isset($settings['y']) 	 		? $settings['y']			: 0;
		$borderColor = isset($settings['borderColor'])  ? $settings['borderColor']  : '0|0|0';
		$color 	     = isset($settings['color'])  		? $settings['color']   		: '255|255|255';
				
		imagefilltoborder($this->canvas, $x, $y, $this->allocate($borderColor), $this->allocate($color));
		
		return $this;	
	}
	
	/******************************************************************************************
	* FILTER                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Bir resme bir süzgeç uygular.											  |
	
	  @param  mixed    $filter negate, grayscale, brigthness, contrast, colorize, edgedetect
	  						   emboss, gaussian_blur, selective_blur, mean_removel, smooth
							   pixelate
	  [ @param  mixed    $arg1 ]
	  [ @param  mixed    $arg2 ]
	  [ @param  mixed    $arg3 ]
	  [ @param  mixed    $arg4 ]
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function filter($filter = '', $arg1 = 0, $arg2 = 0, $arg3 = 0, $arg4 = 0)
	{			
		imagefilter($this->canvas, \Convert::toConstant($filter, 'IMG_FILTER_'), $arg1, $arg2, $arg3, $arg4);
		
		return $this;	
	}
	
	/******************************************************************************************
	* FLIP                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Belirli bir modunu kullanarak görüntüyü çevirir.						  |
	
	  @param  mixed    $type both, horizontal, vertical
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function flip($type = 'both')
	{	
		imageflip($this->canvas, \Convert::toConstant($type, 'IMG_FLIP_'));
		
		return $this;	
	}
	
	/******************************************************************************************
	* CHAR                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Yatay olarak bir karakter çizer.				      	      			  |
	
	  @param  string   $char
	  @param  array    $settings
	  				   $settings['type'] horizontal, vertical
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function char($char = '', $settings = [])
	{
		if( ! is_scalar($char) || ! is_array($settings) )
		{
			\Errors::set('Error', 'scalarParameter', '1.(char)');
			\Errors::set('Error', 'arrayParameter', '2.(settings)');
			
			return $this;
		}
		
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
	
	/******************************************************************************************
	* TEXT                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Yatay olarak bir metin çizer.		     		      	      			  |
	
	  @param  string   $text
	  @param  array    $settings
	  				   $settings['type'] horizontal, vertical
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function text($text = '', $settings = [])
	{
		if( ! is_scalar($text) || ! is_array($settings) )
		{
			\Errors::set('Error', 'scalarParameter', '1.(text)');
			\Errors::set('Error', 'arrayParameter', '2.(settings)');
			
			return $this;
		}
		
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
	
	/******************************************************************************************
	* CLOSEST                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Alfası ile birlikte belirtilen rengin en yakın benzerinin renk 		  |
	  indisini verir.	     	      			 
	
	  @param  numeric  $alpha 0
	  @param  string   $rgb
	  
	  @return int
	|          																				  |
	******************************************************************************************/
	public function closest($rgb = '')
	{
		if( ! is_string($rgb) )
		{
			\Errors::set('Error', 'stringParameter', '1.(rgb)');
			
			return false;
		}
	
		$rgb = explode('|', $rgb);
		
		$red   = isset($rgb[0]) ? $rgb[0] : 0;
		$green = isset($rgb[1]) ? $rgb[1] : 0;
		$blue  = isset($rgb[2]) ? $rgb[2] : 0;
		$alpha = isset($rgb[3]) ? $rgb[3] : 0;
		
		return imagecolorclosestalpha($this->canvas, $red, $green, $blue, $alpha);
	} 
	
	/******************************************************************************************
	* ALPHA RESOLVE                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Alfası ile birlikte belirtilen rengin en yakın benzerinin renk 		  |
	  indisini verir.	     	      			 
	
	  @param  numeric  $alpha 0
	  @param  string   $rgb
	  
	  @return int
	|          																				  |
	******************************************************************************************/
	public function resolve($rgb = '')
	{
		if( !! is_string($rgb) )
		{
			\Errors::set('Error', 'stringParameter', '1.(rgb)');
			
			return false;
		}

		$rgb = explode('|', $rgb);
		
		$red   = isset($rgb[0]) ? $rgb[0] : 0;
		$green = isset($rgb[1]) ? $rgb[1] : 0;
		$blue  = isset($rgb[2]) ? $rgb[2] : 0;
		$alpha = isset($rgb[3]) ? $rgb[3] : 0;
		
		return imagecolorresolvealpha($this->canvas, $red, $green, $blue, $alpha);
	} 
	
	/******************************************************************************************
	* ALPHA INDEX                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Alfası ile birlikte belirtilen rengin indisini verir.					  |	     	      			 
	
	  @param  numeric  $alpha 0
	  @param  string   $rgb
	  
	  @return int
	|          																				  |
	******************************************************************************************/
	public function index($rgb = '')
	{
		if( ! is_string($rgb) )
		{
			return \Errors::set('Error', 'stringParameter', '1.(rgb)');
		}
		
		$rgb = explode('|', $rgb);
		
		$red   = isset($rgb[0]) ? $rgb[0] : 0;
		$green = isset($rgb[1]) ? $rgb[1] : 0;
		$blue  = isset($rgb[2]) ? $rgb[2] : 0;
		$alpha = isset($rgb[3]) ? $rgb[3] : 0;
		
		return imagecolorexactalpha($this->canvas, $red, $green, $blue, $alpha);
	} 
	
	/******************************************************************************************
	* PIXEL INDEX                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Bir pikselin renk indisini döndürür.	    		 	      			  |
	
	  @param  numeric  $x 0
	  @param  numeric  $y 0
	  
	  @return int
	|          																				  |
	******************************************************************************************/
	public function pixelIndex($x = 0, $y = 0)
	{
		if( ! is_numeric($x) || ! is_numeric($y) )
		{
			\Errors::set('Error', 'resourceParameter', '1.(image)');
			\Errors::set('Error', 'numericParameter', '2.(x) & 3.(y)');
			
			return false;
		}
		
		return imagecolorat($this->canvas, $x, $y);
	} 
	
	/******************************************************************************************
	* CLOSEST HWB	             		                                                      *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen En yakın renk sıcaklığına, beyaz ve siyahlığa sahip renk	  | 
	  indisini verir.	  			

	  @param  string   $rgb
	  
	  @return int
	|          																				  |
	******************************************************************************************/
	public function closestHwb($rgb = '')
	{
		if( ! is_string($rgb) )
		{
			\Errors::set('Error', 'stringParameter', '1.(rgb)');
			
			return false;
		}
		
		$rgb = explode('|', $rgb);
		
		$red   = isset($rgb[0]) ? $rgb[0] : 0;
		$green = isset($rgb[1]) ? $rgb[1] : 0;
		$blue  = isset($rgb[2]) ? $rgb[2] : 0;
		
		return imagecolorclosesthwb($this->canvas, $red, $green, $blue);
	} 
	
	/******************************************************************************************
	* MATCH         	         		                                                      *
	*******************************************************************************************
	| Genel Kullanım: Bir resmin paletli sürümünün renklerini gerçek renkli sürümünün 		  |	
	| renkleriyle aynı yapar.	  								  						
	
	  @param  resource $sourceImage
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function match($sourceImage = '')
	{
		if( ! is_resource($sourceImage) )
		{
			return \Errors::set('Error', 'resourceParameter', '1.(sourceImage)');
		}

		imagecolormatch($this->canvas, $sourceImage);
		
		return $this;
	}
	
	/******************************************************************************************
	* SET		       	         		                                                      *
	*******************************************************************************************
	| Genel Kullanım: Bir palet indisi için renk tanımlar.	  								  |		
	
	  @param  numeric  $index 0
	  @param  string   $rgb
	  
	  @return void
	|          																				  |
	******************************************************************************************/
	public function set($index = 0, $rgb = '')
	{
		if( ! is_numeric($index) || ! is_string($rgb) )
		{
			\Errors::set('Error', 'numericParameter', '1.(index)');
			\Errors::set('Error', 'stringParameter', '2.(rgb)');
			
			return $this;
		}
		
		$rgb = explode('|', $rgb);
		
		$red   = isset($rgb[0]) ? $rgb[0] : 0;
		$green = isset($rgb[1]) ? $rgb[1] : 0;
		$blue  = isset($rgb[2]) ? $rgb[2] : 0;
		
		imagecolorset($this->canvas, $index, $red, $green, $blue);
		
		return $this;
	}
	
	/******************************************************************************************
	* TOTAL		    	         		                                                      *
	*******************************************************************************************
	| Genel Kullanım: Bir resim paletindeki renk sayısını döndürür.							  |		
	
	  @return int
	|          																				  |
	******************************************************************************************/
	public function total()
	{	
		return imagecolorstotal($this->canvas);
	}
	
	/******************************************************************************************
	* TRANSPARENT     	         		                                                      *
	*******************************************************************************************
	| Genel Kullanım: Bir rengi şeffaflaştırır.	 			 								  |		
	
	  @param  string   $rgb
	  
	  @return int
	|          																				  |
	******************************************************************************************/
	public function transparent($rgb = '')
	{
		if( ! is_string($rgb) )
		{
			\Errors::set('Error', 'stringParameter', '1.(rgb)');
			
			return $this;
		}
	
		imagecolortransparent($this->canvas, $this->allocate($rgb));
		
		return $this;
	}
	
	/******************************************************************************************
	* CONVOLUTION     	         		                                                      *
	*******************************************************************************************
	| Genel Kullanım: Bir konum ve katsayı ile 3x3'lük bir kıvrım matrisini uygular.		  |		
	
	  @param  array    $matrix
	  @param  float    $div
	  @param  float    $offset
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function convolution($matrix = [], $div = 0, $offset = 0)
	{
		if( ! is_array($matrix) )
		{
			\Errors::set('Error', 'arrayParameter', '1.(matrix)');
			
			return $this;
		}
	
		imageconvolution($this->canvas, $matrix, $div, $offset);
		
		return $this;
	}
	
	/******************************************************************************************
	* INTERLACE     	         		                                                      *
	*******************************************************************************************
	| Genel Kullanım: Karışımlılığı açıp kapar.		 										  |		
	
	  @param  numeric $interlace 0
	  
	  @return int
	|          																				  |
	******************************************************************************************/
	public function interlace($interlace = 0)
	{
		if( ! is_numeric($interlace) )
		{
			\Errors::set('Error', 'numericParameter', '1.(interlace)');
			
			return $this;
		}
	
		imageinterlace($this->canvas, $interlace);
		
		return $this;
	}
	
	/******************************************************************************************
	* COPY                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Bir resim parçasını kopyalar.					      	      			  |
	
	  @param  resource $target
	  @param  array    $settings -> xt, yt, xs, ys, width, height
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function copy($source = '', $settings = [])
	{
		if( ! is_resource($source) )
		{
			\Errors::set('Error', 'resourceParameter', '1.(source)');
			
			return $this;
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
	
	/******************************************************************************************
	* MIX                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Bir resmi kopyalar ve karıştırır.				      	      			  |

	  @param  resource $target
	  @param  array    $settings -> xt, yt, xs, ys, width, height, percent
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function mix($source = '', $settings = [])
	{
		if( ! is_resource($source) )
		{
			\Errors::set('Error', 'resourceParameter', '1.(source)');
			
			return $this;
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
	
	/******************************************************************************************
	* MIX GRAY                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Bir resmi kopyalar ve VE gri ile karıştırır.	     	      			  |
	
	  @param  resource $source
	  @param  resource $target
	  @param  array    $settings -> xt, yt, xs, ys, width, height, percent
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function mixGray($source = '', $settings = [])
	{
		if( ! is_resource($source) )
		{
			\Errors::set('Error', 'resourceParameter', '1.(source)');
			
			return $this;
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
	
	/******************************************************************************************
	* RESAPMPLE                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Resmin bir parçasını örnekleyerek kopyalar ve boyutlandırır. 			  |
	
	  @param  resource $source
	  @param  array    $settings -> xt, yt, xs, ys, wt, ht, ws, hs
	
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function resample($source = '', $settings = [])
	{
		if( ! is_resource($source) )
		{
			\Errors::set('Error', 'resourceParameter', '1.(source)');
			
			return $this;
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
	
	/******************************************************************************************
	* RESIZE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Resmin bir parçasını kopyalar ve boyutlandırır. 		             	  |
	
	  @param  resource $source
	  @param  array    $settings -> xt, yt, xs, ys, wt, ht, ws, hs
	
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function resize($source = '', $settings = [])
	{
		if( ! is_resource($source) )
		{
			\Errors::set('Error', 'resourceParameter', '1.(source)');
			
			return $this;
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
	
	/******************************************************************************************
	* CROP                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Resmin bellir bir parçasını alır.				 		             	  |
	
	  @param  array    $settings -> x, y, width, height
	
	  @return resource
	|          																				  |
	******************************************************************************************/
	public function crop($settings = [])
	{
		if( ! is_array($settings) )
		{
			\Errors::set('Error', 'arrayParameter', '2.(settings)');
			
			return $this;
		}

		imagecrop($this->canvas, $settings);	
		
		return $this;
	}
	
	/******************************************************************************************
	* AUTO CROP                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Resmin belli bir parçasını alır.				 		             	  |
	
	  @param  mixed    $mode default, transparent, black, white, threshold, sides
	  @param  numeric  $threshold
	  @param  numeric  $color   
	
	  @return resource
	|          																				  |
	******************************************************************************************/
	public function autoCrop($mode = 'default', $threshold = .5, $color = -1)
	{
		imagecropauto($this->canvas, \Convert::toConstant($mode, 'IMG_CROP_'), $threshold, $color);	
		
		return $this;
	}
	
	/******************************************************************************************
	* LINE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Çizgi çizmek için kullanılır. 						             	  |
	
	  @param  array    $settings -> x1, y1, x2, y2, color, type -> solid, dashed
	
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function line($settings = [])
	{
		if( ! is_array($settings) )
		{
			\Errors::set('Error', 'arrayParameter', '1.(settings)');
			
			return $this;
		}
		
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
	
	/******************************************************************************************
	* FONT HEIGHT                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Font yüksekliğini döndürür.											  |
	
	  @param  numeric $height = 0
	  
	  @return int
	|          																				  |
	******************************************************************************************/
	public function fontHeight($height = 0)
	{	
		if( ! is_numeric($height) )
		{
			return \Errors::set('Error', 'numericParameter', '1.(height)');
		}
		
		return imagefontheight($height);	
	}
	
	/******************************************************************************************
	* FONT WIDTH                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Font genişliğini döndürür.											  |
	
	  @param  numeric $width = 0
	  
	  @return int
	|          																				  |
	******************************************************************************************/
	public function fontWidth($width = 0)
	{	
		if( ! is_numeric($width) )
		{
			return \Errors::set('Error', 'numericParameter', '1.(width)');
		}
		
		return imagefontwidth($width);	
	}
	
	/******************************************************************************************
	* QUALITY                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Resim kalitesini ayarlar.												  |
	
	  @param  numeric $quality
	  
	  @return numeric
	|          																				  |
	******************************************************************************************/
	public function quality($quality = 0)
	{
		$this->quality = $quality;
		return $this;
	}
	
	/******************************************************************************************
	* SAVE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Resmin hangi dosyaya kaydedileceği.									  |
	
	  @param  string $file NULL
	  
	  @return object
	|          																				  |
	******************************************************************************************/
	public function save($file = NULL)
	{
		$this->save = $file;
		return $this;
	}
	
	/******************************************************************************************
	* TYPE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Resmin hangi türde olacağı ayarlanır.									  |
	
	  @param  string $type jpeg
	  
	  @return object
	|          																				  |
	******************************************************************************************/
	public function type($type = 'jpeg')
	{
		$this->type = $type;
		return $this;
	}
	
	/******************************************************************************************
	* OUTPUT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Resim çıktısı oluşturulsun mu?.										  |
	
	  @param  bool $output true
	  
	  @return object
	|          																				  |
	******************************************************************************************/
	public function output($output = true)
	{
		$this->output = $output;
		return $this;
	}
	
	/******************************************************************************************
	* SCREEN SHOT                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Ekran görüntüsünü alır.												  |
	
	  @param  void
	  
	  @return object
	|          																				  |
	******************************************************************************************/
	public function screenshot()
	{
		$this->canvas = imagegrabscreen();
		return $this;
	}
	
	/******************************************************************************************
	* ROTATE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Resmi döndürür.	    												  |
	
	  @param  numeric $angle 0
	  [ @param string $spaceColor 0|0|0 ]
	  [ @param numeric $ignoreTransparent 0 ]
	  
	  @return resource
	|          																				  |
	******************************************************************************************/
	public function rotate($angle = 0, $spaceColor = '0|0|0', $ignoreTransparent = 0)
	{
		$this->canvas = imagerotate($this->canvas, $angle, $this->allocate($spaceColor), $ignoreTransparent);
		
		if( $spaceColor === 'transparent' )
		{
			$this->saveAlpha();
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* SCALE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Resmin ölçülendirmek için kullanılır.									  |
	
	  @param  numeric $width
	  [ @param numeric $height -1 ]
	  [ @param numeric $mode bilinear_fixed, nearest_neightbour, bicubic, bicubic_fixed ]
	  
	  @return resource
	|          																				  |
	******************************************************************************************/
	public function scale($width = 0, $height = -1, $mode = 'bilinear_fixed')
	{
		$this->canvas = imagescale($this->canvas, $width, $height, \Convert::toConstant($mode, 'IMG_'));
		
		return $this;
	}
	
	/******************************************************************************************
	* INTERPOLATION                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Interpolation değeri ayarlanır.		     							  |
	
	  [ @param numeric $height bilinear_fixed, bell, bessel, bicubic, hamming, hanning ... ]
	  
	  @return object
	|          																				  |
	******************************************************************************************/
	public function interpolation($method = 'bilinear_fixed')
	{
		imagesetinterpolation($this->canvas, \Convert::toConstant($method, 'IMG_'));
		
		return $this;
	}
	
	/******************************************************************************************
	* PIXEL                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Bir pikselin rengini değiştirir.		     							  |
	
	  @param array $settings
	  
	  @return object
	|          																				  |
	******************************************************************************************/
	public function pixel($settings = [])
	{
		$x   = isset($settings['x'])     ? $settings['x'] : 0;
		$y   = isset($settings['y'])     ? $settings['y'] : 0;
		$rgb = isset($settings['color']) ? $settings['color'] : '0|0|0';
		
		imagesetpixel($this->canvas, $x, $y, $this->allocate($rgb));
		
		return $this;
	}
	
	/******************************************************************************************
	* STYLE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Çizgi tarzını ayarlar.				     							  |
	
	  @param array $style
	  
	  @return object
	|          																				  |
	******************************************************************************************/
	public function style($style = [])
	{
		imagesetstyle($this->canvas, $style);
		
		return $this;
	}
	
	/******************************************************************************************
	* THICKNESS                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Çizgi kalınlığını ayarlar.			     							  |
	
	  @param numeric $thickness
	  
	  @return object
	|          																				  |
	******************************************************************************************/
	public function thickness($thickness = 1)
	{
		imagesetthickness($this->canvas, $thickness);
		
		return $this;
	}
	
	/******************************************************************************************
	* TILE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Resmi doldurmak için döşemeyi etkin kılar.							  |
	
	  @param resource $tile
	  
	  @return object
	|          																				  |
	******************************************************************************************/
	public function tile($tile = '')
	{
		if( ! is_resource($tile) )
		{
			return \Errors::set('Error', 'resourceParameter', '1.(tile)');	
		}
		
		imagesettile($this->canvas, $tile);
		
		return $this;
	}
	
	/******************************************************************************************
	* WINDOW DISPLAY                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Bir pencereyi yakalar.												  |
	
	  @param  numeric $window 0
	  @param  numeric $clientArea 0
	  
	  @return object
	|          																				  |
	******************************************************************************************/
	public function windowDisplay($window = 0, $clientArea = 0)
	{
		$this->canvas = imagegrabwindow($window, $clientArea);
		return $this;
	}
	
	/******************************************************************************************
	* LAYER EFFECT                                                                            *
	*******************************************************************************************
	| Genel Kullanım:  PHP ile gelen libgd'nin katmanlama etkisini kullanmak için alfa		  | 
	  harmanlama seçeneğini ayarlar.											 	
	
	  @param  mixed $effect normal, replace, overlay
	  
	  @return int
	|          																				  |
	******************************************************************************************/
	public function layerEffect($effect = 'normal')
	{	
		imagelayereffect($this->canvas, \Convert::toConstant($effect, 'IMG_EFFECT_'));	
		
		return $this;
	}
	
	/******************************************************************************************
	* LOAD FONT                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Yeni bir bit eşlemli yazı tipi yükler.								  |											 	
	
	  @param  mixed $effect normal, replace, overlay
	  
	  @return int
	|          																				  |
	******************************************************************************************/
	public function loadFont($file = '')
	{	
		if( ! is_file($file) )
		{
			return \Errors::set('Error', 'fileParameter', '1.(file)');	
		}
		
		return imageloadfont($file);	
	}
	
	/******************************************************************************************
	* COPY PALETTE                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Paleti bir resimden diğerine kopyalar.								  |											 	
	
	  @param  resource $source
	  
	  @return void
	|          																				  |
	******************************************************************************************/
	public function copyPalette($source = '')
	{	
		if( ! is_resource($source) )
		{
			return \Errors::set('Error', 'resourceParameter', '1.(source)');	
		}
		
		return imagepalettecopy($this->canvas, $source);	
	}
	
	/******************************************************************************************
	* CANVAS WIDTH                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Resmin genişliğini verir.												  |											 	
	
	  @param  void
	  
	  @return numeric
	|          																				  |
	******************************************************************************************/
	public function canvasWidth()
	{	
		return imagesx($this->canvas);	
	}
	
	/******************************************************************************************
	* CANVAS HEIGHT                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Resmin yüksekliğini verir.											  |											 	
	
	  @param  void
	  
	  @return numeric
	|          																				  |
	******************************************************************************************/
	public function canvasHeight()
	{	
		return imagesy($this->canvas);	
	}
	
	/******************************************************************************************
	* TYPES                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Kurulu PHP'nin desteklediği resim türlerini döndürür.					  |											 	
	
	  @param  void
	  
	  @return numeric
	|          																				  |
	******************************************************************************************/
	public function types()
	{	
		return imagetypes();	
	}
	
	/******************************************************************************************
	* GENERATE                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Resmi oluşturur.														  |
	
	  @param  void
	  
	  @return resource
	|          																				  |
	******************************************************************************************/
	public function generate($type = '', $save = '')
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
	
	/******************************************************************************************
	* RESULT         				                                                          *
	*******************************************************************************************
	| Genel Kullanım: Kaydedilen resmi çıktısını görüntülemek için kullanılır.				  |
	
	  @param void
	  
	  @retur string
	|          																				  |
	******************************************************************************************/
	public function result()
	{
		if( empty($this->result['path']) )
		{
			return 'No Result!';
		}
		
		return \Html::image($this->result['path']);	
	}
	
	/******************************************************************************************
	* PROTECTED COLORS				                                                          *
	*******************************************************************************************
	| Genel Kullanım: Renk isimlerine göre 0-255 lik değerleri ayarlanıyor.					  |
	|          																				  |
	******************************************************************************************/
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
	
	/******************************************************************************************
	* PROTECTED ALLOCATE                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Bir resim için alfa kanallı bir renk ayırır.	     	      			  |
	
	  @param  numeric  $alpha 0
	  @param  string   $rgb
	  
	  @return int
	|          																				  |
	******************************************************************************************/
	protected function allocate($rgb = '')
	{
		if( ! is_string($rgb) )
		{
			\Errors::set('Error', 'stringParameter', '1(rgb)');
			
			return $this;
		}
		
		$rgb = explode('|', $this->_colors($rgb));
		
		$red   = isset($rgb[0]) ? $rgb[0] : 0;
		$green = isset($rgb[1]) ? $rgb[1] : 0;
		$blue  = isset($rgb[2]) ? $rgb[2] : 0;
		$alpha = isset($rgb[3]) ? $rgb[3] : 0;
		
		return imagecolorallocatealpha($this->canvas, $red, $green, $blue, $alpha);
	} 
		
	/******************************************************************************************
	* DESTROY                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Bir resmi bellekten siler. 							             	  |
	
	  @param  resource $source
	
	  @return bool
	|          																				  |
	******************************************************************************************/
	protected function _destroy()
	{
		imagedestroy($this->canvas);
		
		return $this;
	}
	
	/******************************************************************************************
	* CONTENT                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Dosya içerik türünü ayarlar.											  |
	
	  @param  string  $type jpeg
	   
	  @return void
	|          																				  |
	******************************************************************************************/
	protected function _content()
	{
		header("Content-type: image/".$this->type);
	}
	
	/******************************************************************************************
	* PROTECTED DEFAULT VARIABLES                                                             *
	*******************************************************************************************
	| Genel Kullanım: Değişken değerleri sıfırlanıyor.										  |
	|          																				  |
	******************************************************************************************/
	protected function _defaultVariables()
	{
		$this->canvas  = NULL;
		$this->save    = NULL;
		$this->type    = 'jpeg';
		$this->quality = 0;
		$this->output  = true;
	}
	
	/******************************************************************************************
	* TYPES                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Resim oluşturma türleri.												  |
	
	  @param  string $type jpeg, gif, png, gd, gd2 
	  [ @param  string $file NULL ]
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
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