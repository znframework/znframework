<?php namespace ZN\ViewObjects;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Services\URL;
use ZN\DataTypes\Arrays;
use ZN\CryptoGraphy\Encode;
use ZN\FileSystem\File;
use ZN\FileSystem\Folder;
use ZN\ImageProcessing;

class Captcha implements CaptchaInterface
{
    /**
     * Keeps settings.
     * 
     * @var array
     */
    protected $sets = [];

    /**
     * Get path.
     * 
     * @var string
     */
    protected $path = FILES_DIR;

    /**
     * Magic constructor
     * 
     * @param void
     * 
     * @return void
     */
    public function __construct()
    {
        $this->_clean();
    }

    /**
     * Adjust the size of the captcha.
     * 
     * @param int $width
     * @param int $height
     * 
     * @return Captcha
     */
    public function size(Int $width, Int $height) : Captcha
    {
        $this->sets['size']['width']  = $width;
        $this->sets['size']['height'] = $height;

        return $this;
    }

    /**
     * Sets the character width.
     * 
     * @param int $param
     * 
     * @return Captcha
     */
    public function length(Int $param) : Captcha
    {
        $this->sets['text']['length'] = $param;

        return $this;
    }

    /**
     * Sets the character angle.
     * 
     * @param int $param
     * 
     * @return Captcha
     */
    public function angle(Float $param) : Captcha
    {
        $this->sets['text']['angle'] = $param;

        return $this;
    }

    /**
     * Add ttf fonts.
     * 
     * @param array $fonts
     * 
     * @return Captcha
     */
    public function ttf(Array $fonts) : Captcha
    {
        $this->sets['text']['ttf'] = $fonts;

        return $this;
    }

    /**
     * Sets the border color.
     * 
     * @param string $color = NULL
     * 
     * @return Captcha
     */
    public function borderColor(String $color = NULL) : Captcha
    {
        $this->sets['border']['status'] = true;

        if( ! empty($color) )
        {
            $this->sets['border']['color'] = $this->_convertColor($color);
        }

        return $this;
    }

    /**
     * Sets the background color.
     * 
     * @param string $color = NULL
     * 
     * @return Captcha
     */
    public function bgColor(String $color) : Captcha
    {
        $this->sets['background']['color'] = $this->_convertColor($color);

        return $this;
    }

    /**
     * Add background pictures.
     * 
     * @param array $image
     * 
     * @return Captcha
     */
    public function bgImage(Array $image) : Captcha
    {
        $this->sets['background']['image'] = $image;

        return $this;
    }

    /**
     * Sets the text size.
     * 
     * @param int $size
     * 
     * @return Captcha
     */
    public function textSize(Int $size) : Captcha
    {
        $this->sets['text']['size'] = $size;

        return $this;
    }

    /**
     * Sets the text coordiante.
     * 
     * @param int $x
     * @param int $y
     * 
     * @return Captcha
     */
    public function textCoordinate(Int $x = 0, Int $y = 0) : Captcha
    {
        $this->sets['text']['x'] = $x;
        $this->sets['text']['y'] = $y;

        return $this;
    }

    /**
     * Sets the text color.
     * 
     * @param string $color
     * 
     * @return Captcha
     */
    public function textColor(String $color) : Captcha
    {
        $this->sets['text']['color'] = $this->_convertColor($color);

        return $this;
    }

    /**
     * Sets the grid color.
     * 
     * @param string $color
     * 
     * @return Captcha
     */
    public function gridColor(String $color = NULL) : Captcha
    {
        $this->sets['grid']['status'] = true;

        if( ! empty($color) )
        {
            $this->sets['grid']['color'] = $this->_convertColor($color);
        }

        return $this;
    }

    /**
     * Sets the grid space.
     * 
     * @param int $x = 0
     * @param int $y = 0
     * 
     * @return Captcha
     */
    public function gridSpace(Int $x = 0, Int $y = 0) : Captcha
    {
        if( ! empty($x) )
        {
            $this->sets['grid']['spaceX'] = $x;
        }

        if( ! empty($y) )
        {
            $this->sets['grid']['spaceY'] = $y;
        }

        return $this;
    }

    /**
     * Completes the captcha creation process.
     * 
     * @param bool  $img     = false
     * @param array $configs = []
     * 
     * @return string
     */
    public function create(Bool $img = false, Array $configs = []) : String
    {
        $configs = array_merge(\Config::viewObjects('captcha'), $this->sets, $configs);

        if( ! empty($configs) )
        {
            \Config::set('ViewObjects', 'captcha', $configs);
        }

        $set = \Config::get('ViewObjects', 'captcha');

        $systemCaptchaCodeData = md5('SystemCaptchaCodeData');

        $textLengthC = $set['text']['length'];

        \Session::insert($systemCaptchaCodeData, substr(md5(rand(0, 999999999)), -($textLengthC)));

        if( $sessionCaptchaCode = \Session::select($systemCaptchaCodeData) )
        {
            if( ! is_dir($this->path) )
            {
                mkdir($this->path);
            }

            $sizeWidthC       = $set['size']['width']       ?? 100;
            $sizeHeightC      = $set['size']['height']      ?? 30;
            $textColorC       = $set['text']['color']       ?? '0|0|0';
            $backgroundColorC = $set['background']['color'] ?? '255|255|255';
            $borderStatusC    = $set['border']['status']    ?? rue;
            $bordercolorC     = $set['border']['color']     ?? '200|200|200';
            $textSizeC        = $set['text']['size']        ?? 10;
            $textXC           = $set['text']['x']           ?? 23;
            $textYC           = $set['text']['y']           ?? 9;
            $textAngleC       = $set['text']['angle']       ?? 0;
            $textTTFC         = $set['text']['ttf']         ?? [];
            $gridStatusC      = $set['grid']['status']      ?? false;
            $gridSpaceXC      = $set['grid']['spaceX']      ?? 12;
            $gridSpaceYC      = $set['grid']['spaceY']      ?? 4;
            $gridColorC       = $set['grid']['color']       ?? '240|240|240';
            $backgroundImageC = $set['background']['image'] ?? [];

            $setFontColor   = explode('|', $textColorC);
            $setBgColor     = explode('|', $backgroundColorC);
            $setBorderColor = explode('|', $bordercolorC);
            $setGridColor   = explode('|', $gridColorC);

            $file       = imagecreatetruecolor($sizeWidthC, $sizeHeightC);
            $fontColor  = imagecolorallocate($file, $setFontColor[0], $setFontColor[1], $setFontColor[2]);
            $color      = imagecolorallocate($file, $setBgColor[0], $setBgColor[1], $setBgColor[2]);

            # Background Image
            if( ! empty($backgroundImageC) )
            {
                if( is_array($backgroundImageC) )
                {
                    $backgroundImageC = $backgroundImageC[rand(0, count($backgroundImageC) - 1)];
                }

                if( is_file($backgroundImageC) )
                {
                    $infoExtension = strtolower(pathinfo($backgroundImageC, PATHINFO_EXTENSION));

                    switch( $infoExtension )
                    {
                        case 'jpeg':
                        case 'jpg' : $file = imagecreatefromjpeg($backgroundImageC); break;
                        case 'png' : $file = imagecreatefrompng($backgroundImageC);  break;
                        case 'gif' : $file = imagecreatefromgif($backgroundImageC);  break;
                        default    : $file = imagecreatefromjpeg($backgroundImageC);
                    }
                }
            }
            else
            {
                imagefill($file, 0, 0, $color);
            }

            if( ! empty($textTTFC) )
            {
                $textTTFC = $textTTFC[rand(0, count($textTTFC) - 1)];

                $textTTFC = suffix($textTTFC, '.ttf');

                if( is_file($textTTFC) )
                {
                    imagettftext($file, $textSizeC, $textAngleC, $textXC, $textYC + $textSizeC, $fontColor, $textTTFC, $sessionCaptchaCode);
                }
            }
            else
            {
                imagestring($file, $textSizeC, $textXC, $textYC, $sessionCaptchaCode, $fontColor);
            }

            # Grid
            if( $gridStatusC === true )
            {
                $gridIntervalX  = $sizeWidthC / $gridSpaceXC;

                if( ! isset($gridSpaceYC))
                {
                    $gridIntervalY  = (($sizeHeightC / $gridSpaceXC) * $gridIntervalX / 2);

                } else $gridIntervalY  = $sizeHeightC / $gridSpaceYC;

                $gridColor  = imagecolorallocate($file, $setGridColor[0], $setGridColor[1], $setGridColor[2]);

                for($x = 0 ; $x <= $sizeWidthC ; $x += $gridIntervalX)
                {
                    imageline($file,$x,0,$x,$sizeHeightC - 1,$gridColor);
                }

                for($y = 0 ; $y <= $sizeWidthC ; $y += $gridIntervalY)
                {
                    imageline($file,0,$y,$sizeWidthC,$y,$gridColor);
                }

            }

            # Border
            if( $borderStatusC === true )
            {
                $borderColor = imagecolorallocate($file, $setBorderColor[0], $setBorderColor[1], $setBorderColor[2]);

                imageline($file, 0, 0, $sizeWidthC, 0, $borderColor); // UST
                imageline($file, $sizeWidthC - 1, 0, $sizeWidthC - 1, $sizeHeightC, $borderColor); // SAG
                imageline($file, 0, $sizeHeightC - 1, $sizeWidthC, $sizeHeightC - 1, $borderColor); // ALT
                imageline($file, 0, 0, 0, $sizeHeightC - 1, $borderColor); // SOL
            }

            $captchaPathEncode = md5('captchaPathEncode');

            $filePath = $this->path . $this->_name();

            imagepng($file, $filePath);

            $baseUrl = URL::base($filePath);

            if( $img === true )
            {
                $captcha = '<img src="'.$baseUrl.'">';
            }
            else
            {
                $captcha = $baseUrl;
            }

            imagedestroy($file);

            return $captcha;
        }
    }

    /**
     * Returns the current captcha code.
     * 
     * @param void
     * 
     * @return string
     */
    public function getCode() : String
    {
        return \Session::select(md5('SystemCaptchaCodeData'));
    }

    /**
     * protected clean captcha
     * 
     * @param void
     * 
     * @return void
     */
    protected function _clean()
    {
        $files   = Folder\FileList::files($this->path, 'png');
        $match   = Arrays\GetElement::first(preg_grep('/captcha\-([a-z]|[0-9])+\.png/i', $files));
        $captcha = $this->path . $match;

        if( is_file($captcha) )
        {
            unlink($captcha);
        }
    }

    /**
     * protected captcha name
     * 
     * @param void
     * 
     * @return string
     */
    protected function _name()
    {
        return 'captcha-' . Encode\RandomPassword::create(16) . '.png';
    }

    /**
     * protected conver color
     * 
     * @param string $color
     * 
     * @return string
     */
    protected function _convertColor($color)
    {
        if( $convert = (ImageProcessing\Properties::$colors[$color] ?? NULL) )
        {
            return $convert;
        }

        return $color;
    }
}
