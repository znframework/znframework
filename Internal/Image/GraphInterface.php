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

interface GDInterface
{
    /**
     * Get info
     * 
     * @return array
     */
    public function info() : Array;

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
    public function canvas($width, $height, $rgb, $real, $p1) : GD;

    /**
     * Creates form
     * 
     * @param string $source
     * @param array  $settings = []
     * 
     * @return resource
     */
    public function createFrom(String $source, Array $settings = []);

    /**
     * Set size
     * 
     * @param string $fileName
     * 
     * @return object
     */
    public function size(String $fileName) : \stdClass;

    /**
     * Get file extension
     * 
     * @param string $type = 'jpeg'
     * @param bool   $dot  = true
     * 
     * @return string
     */
    public function extension(String $type = 'jpeg', Bool $dot = true) : String;

    /**
     * Get mime type
     * 
     * @param string $type = 'jpeg'
     * 
     * @return string
     */
    public function mime(String $type = 'jpeg') : String;

    /**
     * To WBMP
     * 
     * @param string $fileName
     * @param int    $threshold = NULL
     * 
     * @return GD
     */
    public function toWbmp(String $fileName = NULL, Int $threshold = NULL) : GD;

    /**
     * JPEG to WBMP
     * 
     * @param string $pngFile
     * @param string $wbmpFile
     * @param array  $settings = []
     * 
     * @return bool
     */
    public function jpegToWbmp(String $jpegFile, String $wbmpFile, Array $settings = []) : Bool;

    /**
     * PNG to WBMP
     * 
     * @param string $pngFile
     * @param string $wbmpFile
     * @param array  $settings = []
     * 
     * @return bool
     */
    public function pngToWbmp(String $pngFile, String $wbmpFile, Array $settings = []) : Bool;

    /**
     * Sets alpha blending
     * 
     * @param bool $blendMode = NULL
     * 
     * @return GD
     */
    public function alphaBlending(Bool $blendMode = NULL) : GD;

    /**
     * Sets save alpha
     * 
     * @param bool $save = true
     * 
     * @return GD
     */
    public function saveAlpha(Bool $save = true) : GD;

    /**
     * Sets smooth
     * 
     * @param bool $mode = true
     * 
     * @return GD
     */
    public function smooth(Bool $mode = true) : GD;

    /**
     * Creates Arc
     * 
     * @param array $settings []
     * 
     * @return GD
     */
    public function arc(Array $settings = []) : GD;

    /**
     * Creates Ellipse
     * 
     * @param array $settings []
     * 
     * @return GD
     */
    public function ellipse(Array $settings = []) : GD;

    /**
     * Creates Polygon
     * 
     * @param array $settings []
     * 
     * @return GD
     */
    public function polygon(Array $settings = []) : GD;

    /**
     * Creates Rectangle
     * 
     * @param array $settings []
     * 
     * @return GD
     */
    public function rectangle(Array $settings = []) : GD;

    /**
     * Fill
     * 
     * @param array $settings []
     * 
     * @return GD
     */
    public function fill(Array $settings = []) : GD;

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
    public function filter(String $filter, Int $arg1 = NULL, Int $arg2 = NULL, Int $arg3 = NULL, Int $arg4 = NULL) : GD;

    /**
     * Flip
     * 
     * @param string $type = 'both'
     * 
     * @return GD
     */
    public function flip(String $type) : GD;

    /**
     * Creates char
     * 
     * @param string $text
     * @param array  $settings = []
     * 
     * @return GD
     */
    public function char(String $char, Array $settings = []) : GD;

    /**
     * Creates text
     * 
     * @param string $text
     * @param array  $settings = []
     * 
     * @return GD
     */
    public function text(String $text, Array $settings = []) : GD;

    /**
     * Set closest
     * 
     * @param string $rgb
     * 
     * @return int
     */
    public function closest(String $rgb) : Int;

    /**
     * Set resolve
     * 
     * @param string $rgb
     * 
     * @return int
     */
    public function resolve(String $rgb) : Int;

    /**
     * Set index
     * 
     * @param string $rgb
     * 
     * @return int
     */
    public function index(String $rgb) : Int;

    /**
     * Set pixel index
     * 
     * @param int $x
     * @param int $y
     * 
     * @return int
     */
    public function pixelIndex(Int $x, Int $y) : Int;

    /**
     * Set closest hwb
     * 
     * @param string $rgb
     * 
     * @return int
     */
    public function closestHwb(String $rgb) : Int;

    /**
     * Match
     * 
     * @param resource $sourceImage
     * 
     * @return GD
     */
    public function match($sourceImage) : GD;

    /**
     * Set
     * 
     * @param int    $index
     * @param string $rgb = NULL
     * 
     * @return GD
     */
    public function set(Int $index, String $rgb = NULL) : GD;

    /**
     * Total
     * 
     * @return int
     */
    public function total() : Int;

    /**
     * Set transparent
     * 
     * @param string $rgb
     * 
     * @return GD
     */
    public function transparent(String $rgb) : GD;

    /**
     * Set convolution
     * 
     * @param array $matrix
     * @param float $div    = 0
     * @param float $offset = 0
     * 
     * @return GD
     */
    public function convolution(Array $matrix, Float $div = 0, Float $offset = 0) : GD;

    /**
     * Set interlace
     * 
     * @param int $interlace = 0
     * 
     * @return GD
     */
    public function interlace(Int $interlace = 0) : GD;

    /**
     * Copy
     * 
     * @param string|resource $source
     * @param array           $settings = []
     * 
     * @return GD
     */
    public function copy($source, Array $settings = []) : GD;

    /**
     * Mix
     * 
     * @param string|resource $source
     * @param array           $settings = []
     * 
     * @return GD
     */
    public function mix($source, Array $settings = []) : GD;

    /**
     * Mixgray
     * 
     * @param string|resource $source
     * @param array           $settings = []
     * 
     * @return GD
     */
    public function mixGray($source, Array $settings = []) : GD;

    /**
     * Resize / Resample
     * 
     * @param string|resource $source
     * @param array           $settings = []
     * 
     * @return GD
     */
    public function resample($source, Array $settings = []) : GD;

    /**
     * Resize
     * 
     * @param string|resource $source
     * @param array           $settings = []
     * 
     * @return GD
     */
    public function resize($source, Array $settings = []) : GD;

    /**
     * Crop
     * 
     * @param array $settings = []
     * 
     * @return GD
     */
    public function crop(Array $settings = []) : GD;

    /**
     * Auto crop
     * 
     * @param string $mode      = 'default'
     * @param int    $threshold = .5
     * @param int    $color     = -1
     * 
     * @return GD 
     */
    public function autoCrop(String $mode = 'default', $threshold = .5, $color = -1) : GD;

    /**
     * Creates a line
     * 
     * @param array $settings = []
     * 
     * @return GD
     */
    public function line(Array $settings = []) : GD;

    /**
     * Set font height
     * 
     * @param int $height
     * 
     * @return int
     */
    public function fontHeight(Int $height) : Int;

    /**
     * Set font width
     * 
     * @param int $width
     * 
     * @return int
     */
    public function fontWidth(Int $width) : Int;

    /**
     * Get screenshot
     * 
     * @return GD
     */
    public function screenshot() : GD;

    /**
     * Set rotate
     * 
     * @param float  $angle
     * @param string $spaceColor        = '0|0|0'
     * @param int    $ignoreTransparent = 0
     * 
     * @return GD
     */
    public function rotate(Float $angle, String $spaceColor = '0|0|0', Int $ignoreTransparent = 0) : GD;

    /**
     * Set scale
     * 
     * @param int    $width
     * @param int    $height = -1
     * @param string $method = 'bilinearFixed'
     * 
     * @return GD
     */
    public function scale(Int $width, Int $height = -1, String $mode = 'bilinear_fixed') : GD;

    /**
     * Set interpolation
     * 
     * @param string $method = 'bilinearFixed'
     * 
     * @return GD
     */
    public function interpolation(String $method = 'bilinear_fixed') : GD;

    /**
     * Set pixed
     * 
     * @param array $settings = []
     * 
     * @return GD
     */
    public function pixel(Array $settings = []) : GD;

    /**
     * Set style
     * 
     * @param array $style
     * 
     * @return GD
     */
    public function style(Array $style) : GD;

    /**
     * Set thickness
     * 
     * @param int $thickness = 1
     * 
     * @return GD
     */
    public function thickness(Int $thickness = 1) : GD;

    /**
     * Set tile
     * 
     * @param resource $tile
     * 
     * @return GD
     */
    public function tile($tile) : GD;

    /**
     * Set window display
     * 
     * @param int $window
     * @param int $clientArea = 0
     * 
     * @return GD
     */
    public function windowDisplay(Int $window, Int $clientArea = 0) : GD;

    /**
     * Set layer effect
     * 
     * @param string $effect = 'normal'
     * 
     * @return GD
     */
    public function layerEffect(String $effect = 'normal') : GD;

    /**
     * Set load font
     * 
     * @param string $file
     * 
     * @return int
     */
    public function loadFont(String $file) : Int;

    /**
     * Get copy palette
     * 
     * @param resource $source
     * 
     * @return resource
     */
    public function copyPalette($source);

    /**
     * Get canvas width
     * 
     * @return int
     */
    public function canvasWidth() : Int;

    /**
     * Get canvas height
     * 
     * @return int
     */
    public function canvasHeight() : Int;

    /**
     * Get types
     * 
     * @return int
     */
    public function types() : Int;

    /**
     * Generate Image
     * 
     * @param string $type = NULL
     * @param string $save = NULL
     * 
     * @return resource
     */
    public function generate(String $type, String $save);

    /**
     * Get result
     * 
     * @return string
     */
    public function result() : String;
}
