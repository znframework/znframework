<?php namespace ZN\Image;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use stdClass;
use ZN\Base;
use ZN\Helper;
use ZN\Singleton;
use ZN\Ability\Revolving;
use ZN\Image\Exception\InvalidArgumentException;

class GD implements GDInterface
{
    use Revolving;

    /**
     * Keeps canvas settings
     * 
     * @var resource
     */
    protected $canvas;

    /**
     * Output status
     * 
     * @var bool
     */
    protected $output = true;

    /**
     * Keeps result
     * 
     * @var array
     */
    protected $result = [];

    /**
     * Magic Constructor
     */
    public function __construct()
    {
        $this->mime = Singleton::class('ZN\Helpers\Mime');
    }

    /**
     * Get info
     * 
     * @return array
     */
    public function info() : Array
    {
        return gd_info();
    }

    /**
     * Sets canvas
     * 
     * @param mixed $width
     * @param mixed $height = NULL
     * @param mixed $rgb    = 'transparent'
     * @param mixed $real   = false
     * @param mixed $p1     = 0
     * 
     * @return GD
     */
    public function canvas($width, $height = NULL, $rgb = 'transparent', $real = false, $p1 = 0) : GD
    {   
        if( $this->mime->type($width, 0) === 'image' )
        {
            $this->type   = $this->mime->type($width, 1);
            
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

    /**
     * Creates form
     * 
     * @param string $source
     * @param array  $settings = []
     * 
     * @return resource
     */
    public function createFrom(String $source, Array $settings = [])
    {
        $type = $this->mime->type($source, 1);

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

    /**
     * Set size
     * 
     * @param string $fileName
     * 
     * @return object
     */
    public function size(String $fileName) : stdClass
    {
        if( $this->mime->type($fileName, 0) === 'image' )
        {
            $data = getimagesize($fileName);
        }
        elseif( is_string($fileName) )
        {
            $data = getimagesizefromstring($fileName);
        }
        else
        {
            throw new InvalidArgumentException(NULL, '[file]');
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

    /**
     * Get file extension
     * 
     * @param string $type = 'jpeg'
     * @param bool   $dot  = true
     * 
     * @return string
     */
    public function extension(String $type = 'jpeg', Bool $dot = true) : String
    {
        return image_type_to_extension(Helper::toConstant($type, 'IMAGETYPE_'), $dot);
    }

    /**
     * Get mime type
     * 
     * @param string $type = 'jpeg'
     * 
     * @return string
     */
    public function mime(String $type = 'jpeg') : String
    {
        return image_type_to_mime_type(Helper::toConstant($type, 'IMAGETYPE_'));
    }

    /**
     * To WBMP
     * 
     * @param string $fileName
     * @param int    $threshold = NULL
     * 
     * @return GD
     */
    public function toWbmp(String $fileName = NULL, Int $threshold = NULL) : GD
    {
        image2wbmp($this->canvas, $fileName, $threshold);

        return $this;
    }

    /**
     * JPEG to WBMP
     * 
     * @param string $pngFile
     * @param string $wbmpFile
     * @param array  $settings = []
     * 
     * @return bool
     */
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

    /**
     * PNG to WBMP
     * 
     * @param string $pngFile
     * @param string $wbmpFile
     * @param array  $settings = []
     * 
     * @return bool
     */
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

    /**
     * Sets alpha blending
     * 
     * @param bool $blendMode = NULL
     * 
     * @return GD
     */
    public function alphaBlending(Bool $blendMode = NULL) : GD
    {
        imagealphablending($this->canvas, (bool) $blendMode);

        return $this;
    }

    /**
     * Sets save alpha
     * 
     * @param bool $save = true
     * 
     * @return GD
     */
    public function saveAlpha(Bool $save = true) : GD
    {
        imagesavealpha($this->canvas, $save);

        return $this;
    }

    /**
     * Sets smooth
     * 
     * @param bool $mode = true
     * 
     * @return GD
     */
    public function smooth(Bool $mode = true) : GD
    {
        imageantialias($this->canvas, $mode);

        return $this;
    }

    /**
     * Creates Arc
     * 
     * @param array $settings []
     * 
     * @return GD
     */
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
                Helper::toConstant($style, 'IMG_ARC_')
            );
        }
        
        $this->defaultRevolvingVariables();

        return $this;
    }

    /**
     * Creates Ellipse
     * 
     * @param array $settings []
     * 
     * @return GD
     */
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

    /**
     * Creates Polygon
     * 
     * @param array $settings []
     * 
     * @return GD
     */
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

    /**
     * Creates Rectangle
     * 
     * @param array $settings []
     * 
     * @return GD
     */
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


    /**
     * Fill
     * 
     * @param array $settings []
     * 
     * @return GD
     */
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

    /**
     * Filter
     * 
     * @param string $filter
     * @param int    $arg1 = NULL
     * @param int    $arg2 = NULL
     * @param int    $arg3 = NULL
     * @param int    $arg4 = NULL
     * 
     * @return GD
     */
    public function filter(String $filter, Int $arg1 = NULL, Int $arg2 = NULL, Int $arg3 = NULL, Int $arg4 = NULL) : GD
    {
        $filters = Singleton::class('ZN\DataTypes\Collection')->data(func_get_args())
                                                              ->removeFirst()
                                                              ->deleteElement(NULL)
                                                              ->get();
        
        imagefilter($this->canvas, Helper::toConstant($filter, 'IMG_FILTER_'), ...$filters);

        return $this;
    }

    /**
     * Flip
     * 
     * @param string $type = 'both'
     * 
     * @return GD
     */
    public function flip(String $type = 'both') : GD
    {
        imageflip($this->canvas, Helper::toConstant($type, 'IMG_FLIP_'));

        return $this;
    }

    /**
     * Creates char
     * 
     * @param string $text
     * @param array  $settings = []
     * 
     * @return GD
     */
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

    /**
     * Creates text
     * 
     * @param string $text
     * @param array  $settings = []
     * 
     * @return GD
     */
    public function text(String $text, Array $settings = []) : GD
    {
        return $this->char($text, $settings, 'string');
    }

    /**
     * Set closest
     * 
     * @param string $rgb
     * 
     * @return int
     */
    protected function closest(String $rgb) : Int
    {
        return $this->_imageColor($rgb, 'imagecolorclosestalpha');
    }

    /**
     * Set resolve
     * 
     * @param string $rgb
     * 
     * @return int
     */
    public function resolve(String $rgb) : Int
    {
        return $this->_imageColor($rgb, 'imagecolorresolvealpha');
    }

    /**
     * Set index
     * 
     * @param string $rgb
     * 
     * @return int
     */
    public function index(String $rgb) : Int
    {
        return $this->_imageColor($rgb, 'imagecolorexactalpha');
    }

    /**
     * Set pixel index
     * 
     * @param int $x
     * @param int $y
     * 
     * @return int
     */
    public function pixelIndex(Int $x, Int $y) : Int
    {
        return imagecolorat($this->canvas, $x, $y);
    }

    /**
     * Set closest hwb
     * 
     * @param string $rgb
     * 
     * @return int
     */
    public function closestHwb(String $rgb) : Int
    {
        return $this->_imageColor($rgb, 'imagecolorclosesthwb');
    }

    /**
     * Match
     * 
     * @param resource $sourceImage
     * 
     * @return GD
     */
    public function match($sourceImage) : GD
    {
        if( ! is_resource($sourceImage) )
        {
            throw new InvalidArgumentException(NULL, '[resource]');
        }

        imagecolormatch($this->canvas, $sourceImage);

        return $this;
    }

    /**
     * Set
     * 
     * @param int    $index
     * @param string $rgb = NULL
     * 
     * @return GD
     */
    public function set(Int $index, String $rgb = NULL) : GD
    {
        $rgb = $index . '|' . ($this->_colors($this->color ?? $rgb));

        $this->_imageColor($rgb, 'imagecolorset');

        return $this;
    }

    /**
     * Total
     * 
     * @return int
     */
    public function total() : Int
    {
        return imagecolorstotal($this->canvas);
    }

    /**
     * Set transparent
     * 
     * @param string $rgb
     * 
     * @return GD
     */
    public function transparent(String $rgb) : GD
    {
        imagecolortransparent($this->canvas, $this->allocate($rgb));

        return $this;
    }

    /**
     * Set convolution
     * 
     * @param array $matrix
     * @param float $div    = 0
     * @param float $offset = 0
     * 
     * @return GD
     */
    public function convolution(Array $matrix, Float $div = 0, Float $offset = 0) : GD
    {
        imageconvolution($this->canvas, $matrix, $div, $offset);

        return $this;
    }

    /**
     * Set interlace
     * 
     * @param int $interlace = 0
     * 
     * @return GD
     */
    public function interlace(Int $interlace = 0) : GD
    {
        imageinterlace($this->canvas, $interlace);

        return $this;
    }

    /**
     * Copy
     * 
     * @param string|resource $source
     * @param array           $settings = []
     * 
     * @return GD
     */
    public function copy($source, Array $settings = []) : GD
    {
        if( is_file($source) )
        {
            $source = $this->createFrom($source);
        }

        if( ! is_resource($source) )
        {
            throw new InvalidArgumentException(NULL, '[resource]');
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

    /**
     * Mix
     * 
     * @param string|resource $source
     * @param array           $settings = []
     * 
     * @return GD
     */
    public function mix($source, Array $settings = [], $function = 'imagecopymerge') : GD
    {
        if( is_file($source) )
        {
            $source = $this->createFrom($source);
        }

        if( ! is_resource($source) )
        {
            throw new InvalidArgumentException(NULL, '[resource]');
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

    /**
     * Mixgray
     * 
     * @param string|resource $source
     * @param array           $settings = []
     * 
     * @return GD
     */
    public function mixGray($source, Array $settings = []) : GD
    {
        $this->mix($source, $settings, 'imagecopymergegray');

        return $this;
    }

    /**
     * Resize / Resample
     * 
     * @param string|resource $source
     * @param array           $settings = []
     * 
     * @return GD
     */
    public function resample($source, Array $settings = [], $function = 'imagecopyresampled') : GD
    {
        if( is_file($source) )
        {
            $source = $this->createFrom($source);
        }

        if( ! is_resource($source) )
        {
            throw new InvalidArgumentException(NULL, '[resource]');
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

    /**
     * Resize
     * 
     * @param string|resource $source
     * @param array           $settings = []
     * 
     * @return GD
     */
    public function resize($source, Array $settings = []) : GD
    {
        $this->resample($source, $settings, 'imagecopyresized');

        return $this;
    }

    /**
     * Crop
     * 
     * @param array $settings = []
     * 
     * @return GD
     */
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

    /**
     * Auto crop
     * 
     * @param string $mode      = 'default'
     * @param int    $threshold = .5
     * @param int    $color     = -1
     * 
     * @return GD 
     */
    public function autoCrop(String $mode = 'default', $threshold = .5, $color = -1) : GD
    {
        $this->canvas = imagecropauto
        (
            $this->canvas, Helper::toConstant($mode, 'IMG_CROP_'), 
            $this->threshold ?? $threshold, 
            $this->color ?? $color
        );

        $this->defaultRevolvingVariables();

        return $this;
    }

    /**
     * Creates a line
     * 
     * @param array $settings = []
     * 
     * @return GD
     */
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

    /**
     * Set font height
     * 
     * @param int $height
     * 
     * @return int
     */
    public function fontHeight(Int $height) : Int
    {
        return imagefontheight($height);
    }

    /**
     * Set font width
     * 
     * @param int $width
     * 
     * @return int
     */
    public function fontWidth(Int $width) : Int
    {
        return imagefontwidth($width);
    }

    /**
     * Get screenshot
     * 
     * @return GD
     */
    public function screenshot() : GD
    {
        $this->canvas = imagegrabscreen();
        return $this;
    }

    /**
     * Set rotate
     * 
     * @param float  $angle
     * @param string $spaceColor        = '0|0|0'
     * @param int    $ignoreTransparent = 0
     * 
     * @return GD
     */
    public function rotate(Float $angle, String $spaceColor = '0|0|0', Int $ignoreTransparent = 0) : GD
    {
        $this->canvas = imagerotate($this->canvas, $angle, $this->allocate($spaceColor), $ignoreTransparent);

        if( $spaceColor === 'transparent' )
        {
            $this->saveAlpha();
        }

        return $this;
    }

    /**
     * Set scale
     * 
     * @param int    $width
     * @param int    $height = -1
     * @param string $method = 'bilinearFixed'
     * 
     * @return GD
     */
    public function scale(Int $width, Int $height = -1, String $mode = 'bilinearFixed') : GD
    {
        $this->canvas = imagescale($this->canvas, $width, $height, Helper::toConstant($mode, 'IMG_'));

        return $this;
    }

    /**
     * Set interpolation
     * 
     * @param string $method = 'bilinearFixed'
     * 
     * @return GD
     */
    public function interpolation(String $method = 'bilinearFixed') : GD
    {
        imagesetinterpolation($this->canvas, Helper::toConstant($method, 'IMG_'));

        return $this;
    }

    /**
     * Set pixed
     * 
     * @param array $settings = []
     * 
     * @return GD
     */
    public function pixel(Array $settings = []) : GD
    {
        $x   = $settings['x']     ?? $this->x     ?? 0;
        $y   = $settings['y']     ?? $this->y     ?? 0;
        $rgb = $settings['color'] ?? $this->color ?? '0|0|0';

        imagesetpixel($this->canvas, $x, $y, $this->allocate($rgb));

        $this->defaultRevolvingVariables();

        return $this;
    }

    /**
     * Set style
     * 
     * @param array $style
     * 
     * @return GD
     */
    public function style(Array $style) : GD
    {
        imagesetstyle($this->canvas, $style);

        return $this;
    }

    /**
     * Set thickness
     * 
     * @param int $thickness = 1
     * 
     * @return GD
     */
    public function thickness(Int $thickness = 1) : GD
    {
        imagesetthickness($this->canvas, $thickness);

        return $this;
    }

    /**
     * Set tile
     * 
     * @param resource $tile
     * 
     * @return GD
     */
    public function tile($tile) : GD
    {
        if( ! is_resource($tile) )
        {
            throw new InvalidArgumentException(NULL, '[resource]');
        }

        imagesettile($this->canvas, $tile);

        return $this;
    }

    /**
     * Set window display
     * 
     * @param int $window
     * @param int $clientArea = 0
     * 
     * @return GD
     */
    public function windowDisplay(Int $window, Int $clientArea = 0) : GD
    {
        $this->canvas = imagegrabwindow($window, $clientArea);

        return $this;
    }

    /**
     * Set layer effect
     * 
     * @param string $effect = 'normal'
     * 
     * @return GD
     */
    public function layerEffect(String $effect = 'normal') : GD
    {
        imagelayereffect($this->canvas, Helper::toConstant($effect, 'IMG_EFFECT_'));

        return $this;
    }

    /**
     * Set load font
     * 
     * @param string $file
     * 
     * @return int
     */
    public function loadFont(String $file) : Int
    {
        if( ! is_file($file) )
        {
            throw new InvalidArgumentException(NULL, '[file]');
        }

        return imageloadfont($file);
    }

    /**
     * Get copy palette
     * 
     * @param resource $source
     * 
     * @return resource
     */
    public function copyPalette($source)
    {
        if( ! is_resource($source) )
        {
            throw new InvalidArgumentException(NULL, '[resource]');
        }

        imagepalettecopy($this->canvas, $source);
    }

    /**
     * Get canvas width
     * 
     * @return int
     */
    public function canvasWidth() : Int
    {
        return imagesx($this->canvas);
    }

    /**
     * Get canvas height
     * 
     * @return int
     */
    public function canvasHeight() : Int
    {
        return imagesy($this->canvas);
    }

    /**
     * Get types
     * 
     * @return int
     */
    public function types() : Int
    {
        return imagetypes();
    }

    /**
     * Generate Image
     * 
     * @param string $type = NULL
     * @param string $save = NULL
     * 
     * @return resource
     */
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

    /**
     * Get result
     * 
     * @return string
     */
    public function result() : String
    {
        if( empty($this->result['path']) )
        {
            return 'No Result!';
        }

        return Singleton::class('ZN\Hypertext\Html')->image($this->result['path']);
    }

    /**
     * Protected Colors
     */
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

    /**
     * Protected Allocate
     */
    protected function allocate($rgb)
    {
        $rgb = explode('|', $this->_colors($rgb));

        $red   = $rgb[0] ?? 0;
        $green = $rgb[1] ?? 0;
        $blue  = $rgb[2] ?? 0;
        $alpha = $rgb[3] ?? 0;

        return imagecolorallocatealpha($this->canvas, $red, $green, $blue, $alpha);
    }

    /**
     * Protected Image Color
     */
    public function _imageColor($rgb, $function)
    {
        $rgb = explode('|', $rgb);

        $red   = $rgb[0] ?? 0;
        $green = $rgb[1] ?? 0;
        $blue  = $rgb[2] ?? 0;
        $alpha = $rgb[3] ?? 0;

        return $function($this->canvas, $red, $green, $blue, $alpha);
    }

    /**
     * Protected Destroy
     */
    protected function _destroy()
    {
        imagedestroy($this->canvas);

        return $this;
    }

    /**
     * Protected Content
     */
    protected function _content()
    {
        header("Content-type: image/".($this->type ?? 'jpeg'));
    }

    /**
     * Protected Default Variables
     */
    protected function _defaultVariables()
    {
        $this->canvas  = NULL;
        $this->save    = NULL;
        $this->output  = true;
        $this->quality = NULL;
    }

    /**
     * Protected Types
     */
    protected function _types()
    {
        $type = strtolower($this->type ?? 'jpeg');

        if( ! empty($this->save) )
        {
            $save = Base::suffix($this->save, '.'.($type === 'jpeg' ? 'jpg' : $type));
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
