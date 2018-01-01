<?php namespace ZN\ImageProcessing;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\ImageProcessing\Exception\InvalidArgumentException;
use ZN\Helpers\Converter;

class GD implements GDInterface
{
    use \RevolvingAbility;

    //--------------------------------------------------------------------------------------------------------
    // Canvas
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $canvas;

    //--------------------------------------------------------------------------------------------------------
    // Output
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $output = true;

    //--------------------------------------------------------------------------------------------------------
    // Result
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $result = [];

    //--------------------------------------------------------------------------------------------------------
    // Info
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function info() : Array
    {
        return gd_info();
    }

    //--------------------------------------------------------------------------------------------------------
    // Thumb
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $filePath
    // @param array  $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function thumb(String $filePath, Array $settings = []) : String
    {
        return \Image::thumb($filePath, $settings);
    }

    //--------------------------------------------------------------------------------------------------------
    // Canvas
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed  $width
    // @param int    $height
    // @param string $rgb
    // @param bool   $real
    // @param int    $p1
    //
    //--------------------------------------------------------------------------------------------------------
    public function canvas($width, $height = NULL, $rgb = 'transparent', $real = false, $p1 = 0) : GD
    {   
        if( \Mime::type($width, 0) === 'image' )
        {
            $this->type   = \Mime::type($width, 1);
            
            $height = NULL; $rgb = NULL; $real = NULL; $p1 = NULL;

            $this->canvas = $this->createFrom($width,
            [
                // For type gd2p
                'x'      => (int) ($this->x      ?? $height ?? 0),
                'y'      => (int) ($this->y      ?? $rgb    ?? 0),
                'width'  => (int) ($this->width  ?? $real       ),
                'height' => (int) ($this->height ?? $p1         )
            ]);
        }
        else
        {
            $width  = $this->width  ?? $width;
            $height = $this->height ?? $height;
            $rgb    = $this->color  ?? $rgb;
            $real   = $this->real   ?? $real;

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
        }
        
        $this->defaultRevolvingVariables();

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Create Form
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type
    // @param string $source
    // @param array  $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function createFrom(String $source, Array $settings = [])
    {
        $type = \Mime::type($source, 1);

        switch( $type )
        {
            case 'gd2p'   : $return = imagecreatefromgd2part
            (
                $source,
                $settings['x']      ?? NULL,
                $settings['y']      ?? NULL,
                $settings['width']  ?? NULL,
                $settings['height'] ?? NULL
            ); 
            break;

            default: 
                $function = 'imagecreatefrom' . ($type ?? 'jpeg');
                $return   = $function($source);
        }

        return $return;
    }

    //--------------------------------------------------------------------------------------------------------
    // Size
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $fileName
    //
    //--------------------------------------------------------------------------------------------------------
    public function size(String $fileName) : \stdClass
    {
        if( \Mime::type($fileName, 0) === 'image' )
        {
            $data = getimagesize($fileName);
        }
        elseif( is_string($fileName) )
        {
            $data = getimagesizefromstring($fileName);
        }
        else
        {
            throw new InvalidArgumentException('Error', 'fileParameter', '1.($fileName)');
        }

        return (object)
        [
            'width'     => $data[0],
            'height'    => $data[1],
            'extension' => $this->extension($data[2]),
            'img'       => $data[3],
            'bits'      => $data['bits'],
            'mime'      => $data['mime']
        ];
    }

    //--------------------------------------------------------------------------------------------------------
    // Extension
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type
    // @param bool   $dote
    //
    //--------------------------------------------------------------------------------------------------------
    public function extension(String $type = 'jpeg', Bool $dote = true) : String
    {
        return image_type_to_extension(Converter::toConstant($type, 'IMAGETYPE_'), $dote);
    }

    //--------------------------------------------------------------------------------------------------------
    // Mime
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    public function mime(String $type = 'jpeg') : String
    {
        return image_type_to_mime_type(Converter::toConstant($type, 'IMAGETYPE_'));
    }

    //--------------------------------------------------------------------------------------------------------
    // To Wbmp
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $fileName
    // @param int    $threshold
    //
    //--------------------------------------------------------------------------------------------------------
    public function toWbmp(String $fileName = NULL, Int $threshold = NULL) : GD
    {
        image2wbmp($this->canvas, $fileName, $threshold);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Jpep To Wbmp
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $jpegFile
    // @param string $wbmpFile
    // @param array  $setings
    //
    //--------------------------------------------------------------------------------------------------------
    public function jpegToWbmp(String $jpegFile, String $wbmpFile, Array $settings = []) : Bool
    {
        if( is_file($jpegFile) )
        {
            $height    = $settings['height']    ?? $this->height    ?? 0;
            $width     = $settings['width']     ?? $this->width     ?? 0;
            $threshold = $settings['threshold'] ?? $this->threshold ?? 0;

            $this->defaultRevolvingVariables();

            return jpeg2wbmp($jpegFile, $wbmpFile, $height, $width, $threshold);
        }
        else
        {
            return false;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Png To Wbmp
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $pngFile
    // @param string $wbmpFile
    // @param array  $setings
    //
    //--------------------------------------------------------------------------------------------------------
    public function pngToWbmp(String $pngFile, String $wbmpFile, Array $settings = []) : Bool
    {
        if( is_file($pngFile) )
        {
            $height    = $settings['height']    ?? 0;
            $width     = $settings['width']     ?? 0;
            $threshold = $settings['threshold'] ?? 0;

            return png2wbmp($pngFile, $wbmpFile, $height, $width, $threshold);
        }
        else
        {
            return false;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Alpha Blending
    //--------------------------------------------------------------------------------------------------------
    //
    // @param bool $blendMode
    //
    //--------------------------------------------------------------------------------------------------------
    public function alphaBlending(Bool $blendMode = NULL) : GD
    {
        imagealphablending($this->canvas, (bool) $blendMode);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Save Alpha
    //--------------------------------------------------------------------------------------------------------
    //
    // @param bool $save
    //
    //--------------------------------------------------------------------------------------------------------
    public function saveAlpha(Bool $save = true) : GD
    {
        imagesavealpha($this->canvas, $save);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Smooth
    //--------------------------------------------------------------------------------------------------------
    //
    // @param bool $mode
    //
    //--------------------------------------------------------------------------------------------------------
    public function smooth(Bool $mode = true) : GD
    {
        imageantialias($this->canvas, $mode);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Arc
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function arc(Array $settings = []) : GD
    {
        $x      = $settings['x']       ?? $this->x      ?? 0;
        $y      = $settings['y']       ?? $this->y      ?? 0;
        $width  = $settings['width']   ?? $this->width  ?? 100;
        $height = $settings['height']  ?? $this->height ?? 100;
        $start  = $settings['start']   ?? $this->start  ?? 0;
        $end    = $settings['end']     ?? $this->end    ?? 360;
        $color  = $settings['color']   ?? $this->color  ?? '0|0|0';
        $style  = $settings['type']    ?? $this->type   ?? NULL;

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
                Converter::toConstant($style, 'IMG_ARC_')
            );
        }
        
        $this->defaultRevolvingVariables();

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Ellipse
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function ellipse(Array $settings = []) : GD
    {
        $x      = $settings['x']       ?? $this->x      ?? 0;
        $y      = $settings['y']       ?? $this->y      ?? 0;
        $width  = $settings['width']   ?? $this->width  ?? 100;
        $height = $settings['height']  ?? $this->height ?? 100;
        $color  = $settings['color']   ?? $this->color  ?? '0|0|0';
        $style  = $settings['type']    ?? $this->type   ?? NULL;

        if( $style === NULL )
        {
            imageellipse($this->canvas, $x, $y, $width, $height, $this->allocate($color));
        }
        else
        {
            imagefilledellipse($this->canvas, $x, $y, $width, $height, $this->allocate($color));
        }

        $this->defaultRevolvingVariables();

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Polygon
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function polygon(Array $settings = []) : GD
    {
        $points     = $settings['points']     ?? $this->points     ?? 0;
        $pointCount = $settings['pointCount'] ?? $this->pointCount ?? (ceil(count($this->points ?? $points) / 2));
        $color      = $settings['color']      ?? $this->color      ?? '0|0|0';
        $style      = $settings['type']       ?? $this->type       ?? NULL;

        if( $style === NULL )
        {
            imagepolygon($this->canvas, $points, $pointCount, $this->allocate($color));
        }
        else
        {
            imagefilledpolygon($this->canvas, $points, $pointCount, $this->allocate($color));
        }

        $this->defaultRevolvingVariables();

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Rectangle
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function rectangle(Array $settings = []) : GD
    {
        $x      = $settings['x']      ?? $this->x      ?? 0;
        $y      = $settings['y']      ?? $this->y      ?? 0;
        $width  = $settings['width']  ?? $this->width  ?? 100;
        $height = $settings['height'] ?? $this->height ?? 100;
        $color  = $settings['color']  ?? $this->color  ?? '0|0|0';
        $style  = $settings['type']   ?? $this->type   ?? NULL;

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

        $this->defaultRevolvingVariables();

        return $this;
    }


    //--------------------------------------------------------------------------------------------------------
    // Fill
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function fill(Array $settings = []) : GD
    {
        $x           = $settings['x']           ?? $this->x           ?? 0;
        $y           = $settings['y']           ?? $this->y           ?? 0;
        $color       = $settings['color']       ?? $this->color       ?? '0|0|0';
        $borderColor = $settings['borderColor'] ?? $this->borderColor ?? NULL;
        
        if( $borderColor === NULL )
        {
            imagefill($this->canvas, $x, $y, $this->allocate($color));
        }
        else
        {
            imagefilltoborder($this->canvas, $x, $y, $this->allocate($borderColor), $this->allocate($color));
        }

        $this->defaultRevolvingVariables();

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Filter
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $filter
    //
    //--------------------------------------------------------------------------------------------------------
    public function filter(String $filter, Int $arg1 = NULL, Int $arg2 = NULL, Int $arg3 = NULL, Int $arg4 = NULL) : GD
    {
        $filters = \Collection::data(func_get_args())
                             ->removeFirst()
                             ->deleteElement(NULL)
                             ->get();
        
        imagefilter($this->canvas, Converter::toConstant($filter, 'IMG_FILTER_'), ...$filters);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Flip
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    public function flip(String $type = 'both') : GD
    {
        imageflip($this->canvas, Converter::toConstant($type, 'IMG_FLIP_'));

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Char
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $char
    // @param array  $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function char(String $char, Array $settings = [], $function = 'char') : GD
    {
        $x      = $settings['x']     ?? $this->x     ?? 0;
        $y      = $settings['y']     ?? $this->y     ??  0;
        $font   = $settings['font']  ?? $this->font  ??  1;
        $color  = $settings['color'] ?? $this->color ??  '0|0|0';
        $type   = $settings['type']  ?? $this->type  ??  NULL;
        $method = 'image' . $function;
        
        if( $type === 'vertical')
        {
            $method .= 'up';

            $method($this->canvas, $font, $x, $y, $char, $this->allocate($color));
        }
        else
        {
            $method($this->canvas, $font, $x, $y, $char, $this->allocate($color));
        }

        $this->defaultRevolvingVariables();

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Text
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $text
    // @param array  $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function text(String $text, Array $settings = []) : GD
    {
        return $this->char($text, $settings, 'string');
    }

    //--------------------------------------------------------------------------------------------------------
    // Closest
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $rgb
    //
    //--------------------------------------------------------------------------------------------------------
    public function _imageColor($rgb, $function)
    {
        $rgb = explode('|', $rgb);

        $red   = $rgb[0] ?? 0;
        $green = $rgb[1] ?? 0;
        $blue  = $rgb[2] ?? 0;
        $alpha = $rgb[3] ?? 0;

        return $function($this->canvas, $red, $green, $blue, $alpha);
    }

    //--------------------------------------------------------------------------------------------------------
    // Closest
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $rgb
    //
    //--------------------------------------------------------------------------------------------------------
    public function closest(String $rgb) : Int
    {
        return $this->_imageColor($rgb, 'imagecolorclosestalpha');
    }

    //--------------------------------------------------------------------------------------------------------
    // Resolve
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $rgb
    //
    //--------------------------------------------------------------------------------------------------------
    public function resolve(String $rgb) : Int
    {
        return $this->_imageColor($rgb, 'imagecolorresolvealpha');
    }

    //--------------------------------------------------------------------------------------------------------
    // Index
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $rgb
    //
    //--------------------------------------------------------------------------------------------------------
    public function index(String $rgb) : Int
    {
        return $this->_imageColor($rgb, 'imagecolorexactalpha');
    }

    //--------------------------------------------------------------------------------------------------------
    // Pixel Index
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int $x
    // @param int $y
    //
    //--------------------------------------------------------------------------------------------------------
    public function pixelIndex(Int $x, Int $y) : Int
    {
        return imagecolorat($this->canvas, $x, $y);
    }

    //--------------------------------------------------------------------------------------------------------
    // Closest Hwb
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $rgb
    //
    //--------------------------------------------------------------------------------------------------------
    public function closestHwb(String $rgb) : Int
    {
        return $this->_imageColor($rgb, 'imagecolorclosesthwb');
    }

    //--------------------------------------------------------------------------------------------------------
    // Match
    //--------------------------------------------------------------------------------------------------------
    //
    // @param resource $sourceImage
    //
    //--------------------------------------------------------------------------------------------------------
    public function match($sourceImage) : GD
    {
        if( ! is_resource($sourceImage) )
        {
            throw new InvalidArgumentException('Error', 'resourceParameter', '1.($sourceImage)');
        }

        imagecolormatch($this->canvas, $sourceImage);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Set
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int    $index
    // @param string $rgb
    //
    //--------------------------------------------------------------------------------------------------------
    public function set(Int $index, String $rgb = NULL) : GD
    {
        $rgb = $index . '|' . ($this->_colors($this->color ?? $rgb));

        $this->_imageColor($rgb, 'imagecolorset');

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Total
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function total() : Int
    {
        return imagecolorstotal($this->canvas);
    }

    //--------------------------------------------------------------------------------------------------------
    // Transparent
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $rgb
    //
    //--------------------------------------------------------------------------------------------------------
    public function transparent(String $rgb) : GD
    {
        imagecolortransparent($this->canvas, $this->allocate($rgb));

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Convolution
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $matrix
    // @param int   $div
    // @param int   $offset
    //
    //--------------------------------------------------------------------------------------------------------
    public function convolution(Array $matrix, Float $div = 0, Float $offset = 0) : GD
    {
        imageconvolution($this->canvas, $matrix, $div, $offset);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Interlace
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int $interlace
    //
    //--------------------------------------------------------------------------------------------------------
    public function interlace(Int $interlace = 0) : GD
    {
        imageinterlace($this->canvas, $interlace);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Copy
    //--------------------------------------------------------------------------------------------------------
    //
    // @param resource $source
    // @param array    $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function copy($source, Array $settings = []) : GD
    {
        if( is_file($source) )
        {
            $source = $this->createFrom($source);
        }

        if( ! is_resource($source) )
        {
            throw new InvalidArgumentException('Error', 'resourceParameter', '1.($source)');
        }

        $xt     = $settings['xt']     ?? $this->target[0] ?? 0;
        $yt     = $settings['yt']     ?? $this->target[1] ?? 0;
        $xs     = $settings['xs']     ?? $this->source[0] ?? 0;
        $ys     = $settings['ys']     ?? $this->source[1] ?? 0;
        $width  = $settings['width']  ?? $this->width     ?? 0;
        $height = $settings['height'] ?? $this->height    ?? 0;

        imagecopy($this->canvas, $source, $xt, $yt, $xs, $ys, $width, $height);
        
        $this->defaultRevolvingVariables();

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Mix
    //--------------------------------------------------------------------------------------------------------
    //
    // @param resource $source
    // @param array    $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function mix($source, Array $settings = [], $function = 'imagecopymerge') : GD
    {
        if( is_file($source) )
        {
            $source = $this->createFrom($source);
        }

        if( ! is_resource($source) )
        {
            throw new InvalidArgumentException('Error', 'resourceParameter', '1.($source)');
        }

        $xt      = $settings['xt']      ?? $this->target[0] ?? 0;
        $yt      = $settings['yt']      ?? $this->target[1] ?? 0;
        $xs      = $settings['xs']      ?? $this->source[0] ?? 0;
        $ys      = $settings['ys']      ?? $this->source[1] ?? 0;
        $width   = $settings['width']   ?? $this->width     ?? 0;
        $height  = $settings['height']  ?? $this->height    ?? 0;
        $percent = $settings['percent'] ?? $this->percent   ?? 0;

        $function($this->canvas, $source, $xt, $yt, $xs, $ys, $width, $height, $percent);

        $this->defaultRevolvingVariables();

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Mix Gray
    //--------------------------------------------------------------------------------------------------------
    //
    // @param resource $source
    // @param array    $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function mixGray($source, Array $settings = []) : GD
    {
        $this->mix($source, $settings, 'imagecopymergegray');

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Resample
    //--------------------------------------------------------------------------------------------------------
    //
    // @param resource $source
    // @param array    $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function resample($source, Array $settings = [], $function = 'imagecopyresampled') : GD
    {
        if( is_file($source) )
        {
            $source = $this->createFrom($source);
        }

        if( ! is_resource($source) )
        {
            throw new InvalidArgumentException('Error', 'resourceParameter', '1.($source)');
        }

        $xt = $settings['xt'] ?? $this->target[0]    ?? 0;
        $yt = $settings['yt'] ?? $this->target[1]    ?? 0;
        $xs = $settings['xs'] ?? $this->source[0]    ?? 0;
        $ys = $settings['ys'] ?? $this->source[1]    ?? 0;
        $wt = $settings['wt'] ?? $this->width        ?? $this->targetWidth  ?? 0;
        $ht = $settings['ht'] ?? $this->height       ?? $this->targetHeight ?? 0;
        $ws = $settings['ws'] ?? $this->sourceWidth  ?? 0;
        $hs = $settings['hs'] ?? $this->sourceHeight ?? 0;

        $function($this->canvas, $source, $xt, $yt, $xs, $ys, $wt, $ht, $ws, $hs);

        $this->defaultRevolvingVariables();

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Resize
    //--------------------------------------------------------------------------------------------------------
    //
    // @param resource $source
    // @param array    $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function resize($source, Array $settings = []) : GD
    {
        $this->resample($source, $settings, 'imagecopyresized');

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Crop
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function crop(Array $settings = []) : GD
    {
        $sets = 
        [
            'x'      => $settings['x']      ?? $this->x      ?? 0,
            'y'      => $settings['y']      ?? $this->y      ?? 0,
            'width'  => $settings['width']  ?? $this->width  ?? 100,
            'height' => $settings['height'] ?? $this->height ?? 0,

        ];

        $this->canvas = imagecrop($this->canvas, $sets);

        $this->defaultRevolvingVariables();
        
        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Auto Crop
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string  $mode
    // @param numeric $threshold
    // @param numeric $color
    //
    //--------------------------------------------------------------------------------------------------------
    public function autoCrop(String $mode = 'default', $threshold = .5, $color = -1) : GD
    {
        $this->canvas = imagecropauto
        (
            $this->canvas, Converter::toConstant($mode, 'IMG_CROP_'), 
            $this->threshold ?? $threshold, 
            $this->color ?? $color
        );

        $this->defaultRevolvingVariables();

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Line
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function line(Array $settings = []) : GD
    {
        $x1   = $settings['x1']    ?? $this->x1    ?? 0;
        $y1   = $settings['y1']    ?? $this->y1    ?? 0;
        $x2   = $settings['x2']    ?? $this->x2    ?? 0;
        $y2   = $settings['y2']    ?? $this->y2    ?? 0;
        $rgb  = $settings['color'] ?? $this->color ?? '0|0|0';
        $type = $settings['type']  ?? $this->type  ?? 'solid';
        
        if( $type === 'solid' )
        {
            imageline($this->canvas, $x1, $y1, $x2, $y2, $this->allocate($rgb));
        }
        elseif( $type === 'dashed' )
        {
            imagedashedline($this->canvas, $x1, $y1, $x2, $y2, $this->allocate($rgb));
        }

        $this->defaultRevolvingVariables();

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Font Height
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int $height
    //
    //--------------------------------------------------------------------------------------------------------
    public function fontHeight(Int $height) : Int
    {
        return imagefontheight($height);
    }

    //--------------------------------------------------------------------------------------------------------
    // Font Width
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int $width
    //
    //--------------------------------------------------------------------------------------------------------
    public function fontWidth(Int $width) : Int
    {
        return imagefontwidth($width);
    }

    //--------------------------------------------------------------------------------------------------------
    // Screenshot
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function screenshot() : GD
    {
        $this->canvas = imagegrabscreen();
        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Rotate
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int    $angle
    // @param string $spaceColor
    // @param int    $ignoreTransparent
    //
    //--------------------------------------------------------------------------------------------------------
    public function rotate(Float $angle, String $spaceColor = '0|0|0', Int $ignoreTransparent = 0) : GD
    {
        $this->canvas = imagerotate($this->canvas, $angle, $this->allocate($spaceColor), $ignoreTransparent);

        if( $spaceColor === 'transparent' )
        {
            $this->saveAlpha();
        }

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Scale
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int    $width
    // @param int    $height
    // @param string $mode
    //
    //--------------------------------------------------------------------------------------------------------
    public function scale(Int $width, Int $height = -1, String $mode = 'bilinear_fixed') : GD
    {
        $this->canvas = imagescale($this->canvas, $width, $height, Converter::toConstant($mode, 'IMG_'));

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Interpolation
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $method
    //
    //--------------------------------------------------------------------------------------------------------
    public function interpolation(String $method = 'bilinear_fixed') : GD
    {
        imagesetinterpolation($this->canvas, Converter::toConstant($method, 'IMG_'));

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Pixel
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function pixel(Array $settings = []) : GD
    {
        $x   = $settings['x']     ?? $this->x     ?? 0;
        $y   = $settings['y']     ?? $this->y     ?? 0;
        $rgb = $settings['color'] ?? $this->color ?? '0|0|0';

        imagesetpixel($this->canvas, $x, $y, $this->allocate($rgb));

        $this->defaultRevolvingVariables();

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Style
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $style
    //
    //--------------------------------------------------------------------------------------------------------
    public function style(Array $style) : GD
    {
        imagesetstyle($this->canvas, $style);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Thickness
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int $thickness
    //
    //--------------------------------------------------------------------------------------------------------
    public function thickness(Int $thickness = 1) : GD
    {
        imagesetthickness($this->canvas, $thickness);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Tile
    //--------------------------------------------------------------------------------------------------------
    //
    // @param resources $tile
    //
    //--------------------------------------------------------------------------------------------------------
    public function tile($tile) : GD
    {
        if( ! is_resource($tile) )
        {
            throw new InvalidArgumentException('Error', 'resourceParameter', '1.($tile)');
        }

        imagesettile($this->canvas, $tile);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Window Display
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int $window
    // @param int $clientArea
    //
    //--------------------------------------------------------------------------------------------------------
    public function windowDisplay(Int $window, Int $clientArea = 0) : GD
    {
        $this->canvas = imagegrabwindow($window, $clientArea);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Layer Effect
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $effect
    //
    //--------------------------------------------------------------------------------------------------------
    public function layerEffect(String $effect = 'normal') : GD
    {
        imagelayereffect($this->canvas, Converter::toConstant($effect, 'IMG_EFFECT_'));

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Load Font
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    //--------------------------------------------------------------------------------------------------------
    public function loadFont(String $file) : Int
    {
        if( ! is_file($file) )
        {
            throw new InvalidArgumentException('Error', 'fileParameter', '1.($file)');
        }

        return imageloadfont($file);
    }

    //--------------------------------------------------------------------------------------------------------
    // Copy Palette
    //--------------------------------------------------------------------------------------------------------
    //
    // @param resource $source
    //
    //--------------------------------------------------------------------------------------------------------
    public function copyPalette($source)
    {
        if( ! is_resource($source) )
        {
            throw new InvalidArgumentException('Error', 'resourceParameter', '1.($source)');
        }

        imagepalettecopy($this->canvas, $source);
    }

    //--------------------------------------------------------------------------------------------------------
    // Canvas Width
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function canvasWidth() : Int
    {
        return imagesx($this->canvas);
    }

    //--------------------------------------------------------------------------------------------------------
    // Canvas Height
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function canvasHeight() : Int
    {
        return imagesy($this->canvas);
    }

    //--------------------------------------------------------------------------------------------------------
    // Types
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function types() : Int
    {
        return imagetypes();
    }

    //--------------------------------------------------------------------------------------------------------
    // Generate
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $type
    // @param  string $save
    // @return resource
    //
    //--------------------------------------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------------
    // Result
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function result() : String
    {
        if( empty($this->result['path']) )
        {
            return 'No Result!';
        }

        return \Html::image($this->result['path']);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Colors
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $rgb
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _colors($rgb)
    {
        // Renkler küçük isimlerle yazılmıştır.
        $rgb    = strtolower($rgb);
        $colors = Properties::$colors;

        if( isset($colors[$rgb]) )
        {
            return $colors[$rgb];
        }
        else
        {
            return $rgb ?? '0|0|0|127';
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Allocate
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $rgb
    //
    //--------------------------------------------------------------------------------------------------------
    protected function allocate($rgb)
    {
        $rgb = explode('|', $this->_colors($rgb));

        $red   = $rgb[0] ?? 0;
        $green = $rgb[1] ?? 0;
        $blue  = $rgb[2] ?? 0;
        $alpha = $rgb[3] ?? 0;

        return imagecolorallocatealpha($this->canvas, $red, $green, $blue, $alpha);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Destroy
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _destroy()
    {
        imagedestroy($this->canvas);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Content
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _content()
    {
        header("Content-type: image/".($this->type ?? 'jpeg'));
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Default Variables
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _defaultVariables()
    {
        $this->canvas  = NULL;
        $this->save    = NULL;
        $this->output  = true;
        $this->quality = NULL;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Types
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _types()
    {
        $type = strtolower($this->type ?? 'jpeg');

        if( ! empty($this->save) )
        {
            $save = suffix($this->save, '.'.($type === 'jpeg' ? 'jpg' : $type));
            $this->result['path'] = $save;
        }
        else
        {
            $save = NULL;
        }
        
        $function = 'image' . $type;

        $function($this->canvas, $save, $this->quality ?? ($type === 'png' ? 8 : 80));

        return $this;
    }
}
