<?php namespace ZN\ImageProcessing;

use Image, Converter, Html, Config, CallController;
use ZN\EncodingSupport\ImageProcessing\GD\Exception\InvalidArgumentException;

class InternalGD extends CallController implements InternalGDInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Canvas
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $canvas;

    //--------------------------------------------------------------------------------------------------------
    // Save
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $save;

    //--------------------------------------------------------------------------------------------------------
    // Quality
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $quality = 0;

    //--------------------------------------------------------------------------------------------------------
    // Type
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $type = 'jpeg';

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
    public function thumb(String $filePath, Array $settings) : String
    {
        return Image::thumb($filePath, $settings);
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
    public function canvas($width, $height = NULL, $rgb = 'transparent', $real = false, $p1 = 0) : InternalGD
    {
        if( is_file($width) )
        {
            $this->type   = File::extension($width);
            $this->canvas = $this->createFrom($this->type, $width,
            [
                'x'      => (int) $height,
                'y'      => (int) $rgb,
                'width'  => (int) $real,
                'height' => (int) $p2
            ]);

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

    //--------------------------------------------------------------------------------------------------------
    // Create Form
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type
    // @param string $source
    // @param array  $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function createFrom(String $type, String $source, Array $settings = NULL)
    {
        $type = strtolower($type);

        switch( $type )
        {
            case 'gd2'    : $return = imagecreatefromgd2($source);      break;
            case 'gd'     : $return = imagecreatefromgd($source);       break;
            case 'gif'    : $return = imagecreatefromgif($source);      break;
            case 'jpeg'   : $return = imagecreatefromjpeg($source);     break;
            case 'png'    : $return = imagecreatefrompng($source);      break;
            case 'string' : $return = imagecreatefromstring($source);   break;
            case 'wbmp'   : $return = imagecreatefromwbmp($source);     break;
            case 'webp'   : $return = imagecreatefromwebp($source);     break;
            case 'xbm'    : $return = imagecreatefromxbm($source);      break;
            case 'xpm'    : $return = imagecreatefromxpm($source);      break;
            case 'gd2p'   : $return = imagecreatefromgd2part
            (
                $source,
                $settings['x']      ?? NULL,
                $settings['y']      ?? NULL,
                $settings['width']  ?? NULL,
                $settings['height'] ?? NULL
            );
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
        if( File::extension($fileName) && is_file($fileName) )
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
    public function toWbmp(String $fileName, Int $threshold = NULL) : InternalGD
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
    public function jpegToWbmp(String $jpegFile, String $wbmpFile, Array $settings = NULL) : Bool
    {
        if( is_file($jpegFile) )
        {
            $height    = $settings['height']    ?? 0;
            $width     = $settings['width']     ?? 0;
            $threshold = $settings['threshold'] ?? 0;

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
    public function pngToWbmp(String $pngFile, String $wbmpFile, Array $settings = NULL) : Bool
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
    public function alphaBlending(Bool $blendMode = NULL) : InternalGD
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
    public function saveAlpha(Bool $save = true) : InternalGD
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
    public function smooth(Bool $mode = true) : InternalGD
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
    public function arc(Array $settings) : InternalGD
    {
        $x      = $settings['x']       ?? 0;
        $y      = $settings['y']       ?? 0;
        $width  = $settings['width']   ?? 100;
        $height = $settings['height']  ?? 100;
        $start  = $settings['start']   ?? 0;
        $end    = $settings['end']     ?? 360;
        $color  = $settings['color']   ?? '0|0|0';
        $style  = $settings['type']    ?? NULL;

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

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Ellipse
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function ellipse(Array $settings) : InternalGD
    {
        $x      = $settings['x']       ?? 0;
        $y      = $settings['y']       ?? 0;
        $width  = $settings['width']   ?? 100;
        $height = $settings['height']  ?? 100;
        $color  = $settings['color']   ?? '0|0|0';
        $style  = $settings['type']    ?? NULL;

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

    //--------------------------------------------------------------------------------------------------------
    // Polygon
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function polygon(Array $settings) : InternalGD
    {
        $points     = $settings['points']     ?? 0;
        $pointCount = $settings['pointCount'] ?? ceil(count($points) / 2);
        $color      = $settings['color']      ?? '0|0|0';
        $style      = $settings['type']       ?? NULL;

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

    //--------------------------------------------------------------------------------------------------------
    // Rectangle
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function rectangle(Array $settings) : InternalGD
    {
        $x      = $settings['x']      ?? 0;
        $y      = $settings['y']      ?? 0;
        $width  = $settings['width']  ?? 100;
        $height = $settings['height'] ?? 100;
        $color  = $settings['color']  ?? '0|0|0';
        $style  = $settings['type']   ?? NULL;

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


    //--------------------------------------------------------------------------------------------------------
    // Fill
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function fill(Array $settings) : InternalGD
    {
        $x      = $settings['x']     ?? 0;
        $y      = $settings['y']     ?? 0;
        $color  = $settings['color'] ?? '0|0|0';

        imagefill($this->canvas, $x, $y, $this->allocate($color));

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Fill Area
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function fillArea(Array $settings) : InternalGD
    {
        $x           = $settings['x']           ?? 0;
        $y           = $settings['y']           ?? 0;
        $borderColor = $settings['borderColor'] ?? '0|0|0';
        $color       = $settings['color']       ?? '255|255|255';

        imagefilltoborder($this->canvas, $x, $y, $this->allocate($borderColor), $this->allocate($color));

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Filter
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $filter
    //
    //--------------------------------------------------------------------------------------------------------
    public function filter(String $filter, Int $arg1 = 0, Int $arg2 = 0, Int $arg3 = 0, Int $arg4 = 0) : InternalGD
    {
        imagefilter($this->canvas, Converter::toConstant($filter, 'IMG_FILTER_'), $arg1, $arg2, $arg3, $arg4);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Flip
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    public function flip(String $type = 'both') : InternalGD
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
    public function char(String $char, Array $settings) : InternalGD
    {
        $x      = $settings['x']     ?? 0;
        $y      = $settings['y']     ?? 0;
        $font   = $settings['font']  ?? 1;
        $color  = $settings['color'] ?? '0|0|0';
        $type   = $settings['type']  ?? NULL;

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

    //--------------------------------------------------------------------------------------------------------
    // Text
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $text
    // @param array  $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function text(String $text, Array $settings) : InternalGD
    {
        $x      = $settings['x']     ?? 0;
        $y      = $settings['y']     ?? 0;
        $font   = $settings['font']  ?? 1;
        $color  = $settings['color'] ?? '0|0|0';
        $type   = $settings['type']  ?? NULL;

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
    public function match($sourceImage) : InternalGD
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
    public function set(Int $index, String $rgb) : InternalGD
    {
        $rgb = $index . '|' . $rgb;

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
    public function transparent(String $rgb) : InternalGD
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
    public function convolution(Array $matrix, Float $div = 0, Float $offset = 0) : InternalGD
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
    public function interlace(Int $interlace = 0) : InternalGD
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
    public function copy($source, Array $settings) : InternalGD
    {
        if( ! is_resource($source) )
        {
            throw new InvalidArgumentException('Error', 'resourceParameter', '1.($source)');
        }

        $xt     = $settings['xt']     ?? 0;
        $yt     = $settings['yt']     ?? 0;
        $xs     = $settings['xs']     ?? 0;
        $ys     = $settings['ys']     ?? 0;
        $width  = $settings['width']  ?? 0;
        $height = $settings['height'] ?? 0;

        imagecopy($this->canvas, $source, $xt, $yt, $xs, $ys, $width, $height);

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
    public function mix($source, Array $settings, $function = 'imagecopymerge') : InternalGD
    {
        if( ! is_resource($source) )
        {
            throw new InvalidArgumentException('Error', 'resourceParameter', '1.($source)');
        }

        $xt      = $settings['xt']      ?? 0;
        $yt      = $settings['yt']      ?? 0;
        $xs      = $settings['xs']      ?? 0;
        $ys      = $settings['ys']      ?? 0;
        $width   = $settings['width']   ?? 0;
        $height  = $settings['height']  ?? 0;
        $percent = $settings['percent'] ?? 0;

        $function($this->canvas, $source, $xt, $yt, $xs, $ys, $width, $height, $percent);

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
    public function mixGray($source, Array $settings) : InternalGD
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
    public function resample($source, Array $settings, $function = 'imagecopyresampled') : InternalGD
    {
        if( ! is_resource($source) )
        {
            throw new InvalidArgumentException('Error', 'resourceParameter', '1.($source)');
        }

        $xt = $settings['xt'] ?? 0;
        $yt = $settings['yt'] ?? 0;
        $xs = $settings['xs'] ?? 0;
        $ys = $settings['ys'] ?? 0;
        $wt = $settings['wt'] ?? 0;
        $ht = $settings['ht'] ?? 0;
        $ws = $settings['ws'] ?? 0;
        $hs = $settings['hs'] ?? 0;

        $function($this->canvas, $source, $xt, $yt, $xs, $ys, $wt, $yt, $ws, $hs);

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
    public function resize($source, Array $settings) : InternalGD
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
    public function crop(Array $settings) : InternalGD
    {
        imagecrop($this->canvas, $settings);

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
    public function autoCrop(String $mode = 'default', Float $threshold = .5, Int $color = -1) : InternalGD
    {
        imagecropauto($this->canvas, Converter::toConstant($mode, 'IMG_CROP_'), $threshold, $color);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Line
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function line(Array $settings) : InternalGD
    {
        $x1   = $settings['x1']    ?? 0;
        $y1   = $settings['y1']    ?? 0;
        $x2   = $settings['x2']    ?? 0;
        $y2   = $settings['y2']    ?? 0;
        $rgb  = $settings['color'] ?? '0|0|0';
        $type = $settings['type']  ?? 'solid';

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
    // Quality
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int $quality
    //
    //--------------------------------------------------------------------------------------------------------
    public function quality(Int $quality) : InternalGD
    {
        $this->quality = $quality;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Save
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    //--------------------------------------------------------------------------------------------------------
    public function save(String $file) : InternalGD
    {
        $this->save = $file;
        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Type
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    public function type(String $type) : InternalGD
    {
        $this->type = $type;
        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Output
    //--------------------------------------------------------------------------------------------------------
    //
    // @param boolean $output
    //
    //--------------------------------------------------------------------------------------------------------
    public function output(Bool $output) : InternalGD
    {
        $this->output = $output;
        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Screenshot
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function screenshot() : InternalGD
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
    public function rotate(Float $angle, String $spaceColor = '0|0|0', Int $ignoreTransparent = 0) : InternalGD
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
    public function scale(Int $width, Int $height = -1, String $mode = 'bilinear_fixed') : InternalGD
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
    public function interpolation(String $method = 'bilinear_fixed') : InternalGD
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
    public function pixel(Array $settings) : InternalGD
    {
        $x   = $settings['x']     ?? 0;
        $y   = $settings['y']     ?? 0;
        $rgb = $settings['color'] ?? '0|0|0';

        imagesetpixel($this->canvas, $x, $y, $this->allocate($rgb));

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Style
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $style
    //
    //--------------------------------------------------------------------------------------------------------
    public function style(Array $style) : InternalGD
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
    public function thickness(Int $thickness = 1) : InternalGD
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
    public function tile($tile) : InternalGD
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
    public function windowDisplay(Int $window, Int $clientArea = 0) : InternalGD
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
    public function layerEffect(String $effect = 'normal') : InternalGD
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

        return Html::image($this->result['path']);
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
        $colors = Config::get('Colors');

        if( isset($colors[$rgb]) )
        {
            return $colors[$rgb];
        }
        else
        {
            return '0|0|0|127';
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
        header("Content-type: image/".$this->type);
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
        $this->type    = 'jpeg';
        $this->quality = 0;
        $this->output  = true;
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
