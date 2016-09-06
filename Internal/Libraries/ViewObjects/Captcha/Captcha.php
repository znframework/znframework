<?php namespace ZN\ViewObjects;

use Config, Session, Requirements;

class InternalCaptcha extends Requirements implements CaptchaInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Sets
    //--------------------------------------------------------------------------------------------------------
    //
    // Güvenlik kodu nesnesine ait ayarlar
    //
    // @var  array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $sets = [];

    //--------------------------------------------------------------------------------------------------------
    // Construct
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct()
    {
         $this->config = config('ViewObjects', 'captcha');
    }

    //--------------------------------------------------------------------------------------------------------
    // Width
    //--------------------------------------------------------------------------------------------------------
    //
    // Güvenlik kodu nesnesinin genişlik değeri belirtilir.
    //
    // @param  numeric $param
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function width(Int $param) : InternalCaptcha
    {
        $this->sets['size']['width'] = $param;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Height
    //--------------------------------------------------------------------------------------------------------
    //
    // Güvenlik kodu nesnesinin yükseklik değeri belirtilir.
    //
    // @param  numeric $param
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function height(Int $param) : InternalCaptcha
    {
        $this->sets['size']['height'] = $param;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Size
    //--------------------------------------------------------------------------------------------------------
    //
    // Güvenlik kodu nesnesinin genişlikk ve yükseklik değeri belirtilir.
    //
    // @param  numeric $width
    // @param  numeric $height
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function size(Int $width, Int $height) : InternalCaptcha
    {
        $this->width($width);
        $this->height($height);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Length
    //--------------------------------------------------------------------------------------------------------
    //
    // Güvenlik kodu nesnesinin kaç karakterden olacağı belirtilir.
    //
    // @param  numeric $param
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function length(Int $param) : InternalCaptcha
    {
        $this->sets['text']['length'] = $param;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Border
    //--------------------------------------------------------------------------------------------------------
    //
    // Güvenlik kodu nesnesinin çerçevesinin olup olmayacağı olacaksa da hangi.
    // hangi renkte olacağı belirtilir.
    //
    // @param  boolean $is
    // @param  string  $color
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function border(Bool $is = true, String $color = NULL) : InternalCaptcha
    {
        $this->sets['border']['status'] = $is;

        if( ! empty($color) )
        {
            $this->sets['border']['color'] = $this->_convertColor($color);
        }

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Border Color
    //--------------------------------------------------------------------------------------------------------
    //
    // Güvenlik kodu çerçeve rengini ayarlamak için kullanılır.
    //
    // @param  string $color
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function borderColor(String $color) : InternalCaptcha
    {
        $this->sets['border']['color'] = $this->_convertColor($color);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Bg Color
    //--------------------------------------------------------------------------------------------------------
    //
    // Güvenlik kodu arkaplan rengini ayarlamak için kullanılır.
    //
    // @param  string $color
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function bgColor(String $color) : InternalCaptcha
    {
        $this->sets['background']['color'] = $this->_convertColor($color);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Background Color
    //--------------------------------------------------------------------------------------------------------
    //
    // Güvenlik kodu arkaplan resimleri ayarlamak için kullanılır.
    //
    // @param  mixed $image
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function bgImage($image) : InternalCaptcha
    {
        if( ! empty($image) )
        {
            if( is_string($image) )
            {
                $this->sets['background']['image'] = [$image];
            }
            elseif( is_array($image) )
            {
                $this->sets['background']['image'] = $image;
            }
        }

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Background
    //--------------------------------------------------------------------------------------------------------
    //
    // Güvenlik kodu arkaplan rengini veya resimlerini ayarlamak için
    // kullanılır. Bgimage ve bgcolor yöntemlerinin alternatifidir.
    //
    // @param  mixed $background
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function background(String $background) : InternalCaptcha
    {
        if( is_file($background) )
        {
            $this->bgImage($background);
        }
        else
        {
            $this->bgColor($background);
        }

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Text Size
    //--------------------------------------------------------------------------------------------------------
    //
    // Güvenlik kodu metninin boyutunu ayarlamak içindir.
    //
    // @param  numeric $size
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function textSize(Int $size) : InternalCaptcha
    {
        $this->sets['text']['size'] = $size;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Text Coordinate
    //--------------------------------------------------------------------------------------------------------
    //
    // Güvenlik kodu metninin boyutunu ayarlamak içindir.
    //
    // @param  numeric $x
    // @param  numeric $y
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function textCoordinate(Int $x = 0, Int $y = 0) : InternalCaptcha
    {
        $this->sets['text']['x'] = $x;
        $this->sets['text']['y'] = $y;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Text Color
    //--------------------------------------------------------------------------------------------------------
    //
    // Güvenlik kodu metninin rengini ayarlamak için kullanılır.
    //
    // @param  string $color
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function textColor(String $color) : InternalCaptcha
    {
        $this->sets['text']['color'] = $this->_convertColor($color);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Text
    //--------------------------------------------------------------------------------------------------------
    //
    // Güvenlik kodu metninin boyutu x ve ye değerlerini ayarlamak içindir.
    //
    // @param  numeric $size
    // @param  numeric $x
    // @param  numeric $y
    // @param  string  $color
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function text(Int $size, Int $x = 0, Int $y = 0, String $color = NULL) : InternalCaptcha
    {
        $this->textSize($size);

        if( ! empty($x) && ! empty($y) )
        {
            $this->textCoordinate($x, $y);
        }

        if( ! empty($color) )
        {
            $this->textColor($color);
        }

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Grid
    //--------------------------------------------------------------------------------------------------------
    //
    // Güvenlik kodu nesnesinin ızgarasının olup olmayacağı olacaksa da hangi.
    // hangi renkte olacağı belirtilir.
    //
    // @param  boolean $is
    // @param  string  $color
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function grid(Bool $is = true, String $color = NULL) : InternalCaptcha
    {
        $this->sets['grid']['status'] = $is;

        if( ! empty($color) )
        {
            $this->sets['grid']['color'] = $this->_convertColor($color);
        }

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Grid Color
    //--------------------------------------------------------------------------------------------------------
    //
    // Güvenlik kodu ızgara rengini ayarlamak için kullanılır.
    //
    // @param  string $color
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function gridColor(String $color) : InternalCaptcha
    {
        $this->sets['grid']['color'] = $this->_convertColor($color);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Grid Space
    //--------------------------------------------------------------------------------------------------------
    //
    // Güvenlik kodu ızgara boşluklarını ayarlamak için kullanılır.
    //
    // @param  numeric $x
    // @param  numeric $y
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function gridSpace(Int $x = 0, Int $y = 0) : InternalCaptcha
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

    //--------------------------------------------------------------------------------------------------------
    // Create
    //--------------------------------------------------------------------------------------------------------
    //
    // Güvenlik kodu ızgara boşluklarını ayarlamak için kullanılır.
    //
    // @param  boolean $img
    // @param  array   $configs
    // @return midex
    //
    //--------------------------------------------------------------------------------------------------------
    public function create(Bool $img = false, Array $configs = []) : String
    {
        $configs = array_merge($this->config, $this->sets, $configs);

        if( ! empty($configs) )
        {
            Config::set('ViewObjects', 'captcha', $configs);
        }

        $set = Config::get('ViewObjects', 'captcha');

        $systemCaptchaCodeData = md5('SystemCaptchaCodeData');

        $textLengthC = $set['text']['length'];

        Session::insert($systemCaptchaCodeData, substr(md5(rand(0, 999999999)), -($textLengthC)));

        if( $sessionCaptchaCode = Session::select($systemCaptchaCodeData) )
        {
            $sizeWidthC       = $set['size']['width']       ?? 100;
            $sizeHeightC      = $set['size']['height']      ?? 30;
            $textColorC       = $set['text']['color']       ?? '0|0|0';
            $backgroundColorC = $set['background']['color'] ?? '255|255|255';
            $borderStatusC    = $set['border']['status']    ?? rue;
            $bordercolorC     = $set['border']['color']     ?? '200|200|200';
            $textSizeC        = $set['text']['size']        ?? 5;
            $textXC           = $set['text']['x']           ?? 23;
            $textYC           = $set['text']['y']           ?? 9;
            $gridStatusC      = $set['grid']['status']      ??false;
            $gridSpaceXC      = $set['grid']['spaceX']      ?? 12;
            $gridSpaceYC      = $set['grid']['spaceY']      ?? 4;
            $gridColorC       = $set['grid']['color']       ?? '240|240|240';
            $backgroundImageC = $set['background']['image'] ?? [];

            // 0-255 arasında değer alacak renk kodları için
            // 0|20|155 gibi bir kullanım için aşağıda
            // explode ile ayırma işlemleri yapılmaktadır.

            // SET FONT COLOR
            $setFontColor   = explode('|', $textColorC);

            // SET BG COLOR
            $setBgColor     = explode('|', $backgroundColorC);

            // SET BORDER COLOR
            $setBorderColor = explode('|', $bordercolorC);

            // SET GRID COLOR
            $setGridColor   = explode('|', $gridColorC);


            $file       = @imagecreatetruecolor($sizeWidthC, $sizeHeightC);
            $fontColor  = @imagecolorallocate($file, $setFontColor[0], $setFontColor[1], $setFontColor[2]);
            $color      = @imagecolorallocate($file, $setBgColor[0], $setBgColor[1], $setBgColor[2]);

            // ARKAPLAN RESMI--------------------------------------------------------------------------------------
            if( ! empty($backgroundImageC) )
            {
                if( is_array($backgroundImageC) )
                {
                    $backgroundImageC = $backgroundImageC[rand(0, count($backgroundImageC) - 1)];
                }

                /***************************************************************************/
                // Arkaplan resmi için geçerli olabilecek uzantıların kontrolü yapılıyor.
                /***************************************************************************/
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
            else
            {
                // Arkaplan olarak resim belirtilmemiş ise arkaplan rengini ayarlar.
                @imagefill($file, 0, 0, $color);
            }
            //--------------------------------------------------------------------------------------------------------------------------

            // Resim üzerinde görüntülenecek kod bilgisi.
            @imagestring($file, $textSizeC, $textXC, $textYC, $sessionCaptchaCode, $fontColor);

            // GRID --------------------------------------------------------------------------------------
            if( $gridStatusC === true )
            {
                $gridIntervalX  = $sizeWidthC / $gridSpaceXC;

                if( ! isset($gridSpaceYC))
                {
                    $gridIntervalY  = (($sizeHeightC / $gridSpaceXC) * $gridIntervalX / 2);

                } else $gridIntervalY  = $sizeHeightC / $gridSpaceYC;

                $gridColor  = @imagecolorallocate($file, $setGridColor[0], $setGridColor[1], $setGridColor[2]);

                for($x = 0 ; $x <= $sizeWidthC ; $x += $gridIntervalX)
                {
                    @imageline($file,$x,0,$x,$sizeHeightC - 1,$gridColor);
                }

                for($y = 0 ; $y <= $sizeWidthC ; $y += $gridIntervalY)
                {
                    @imageline($file,0,$y,$sizeWidthC,$y,$gridColor);
                }

            }
            // ---------------------------------------------------------------------------------------------

            // BORDER --------------------------------------------------------------------------------------
            if( $borderStatusC === true )
            {
                $borderColor    = @imagecolorallocate($file, $setBorderColor[0], $setBorderColor[1], $setBorderColor[2]);

                @imageline($file, 0, 0, $sizeWidthC, 0, $borderColor); // UST
                @imageline($file, $sizeWidthC - 1, 0, $sizeWidthC - 1, $sizeHeightC, $borderColor); // SAG
                @imageline($file, 0, $sizeHeightC - 1, $sizeWidthC, $sizeHeightC - 1, $borderColor); // ALT
                @imageline($file, 0, 0, 0, $sizeHeightC - 1, $borderColor); // SOL
            }
            // ---------------------------------------------------------------------------------------------

            $filePath = FILES_DIR.'capcha';

            if( function_exists('imagepng') )
            {
                $extension = '.png';
                imagepng($file, $filePath.$extension);
            }
            elseif( function_exists('imagejpg'))
            {
                $extension = '.jpg';
                imagepng($file, $filePath.$extension);
            }
            else
            {
                return false;
            }

            $filePath .= $extension;
            
            if( $img === true )
            {
                $captcha = '<img src="'.baseUrl($filePath).'">';
            }
            else
            {
                $captcha = baseUrl($filePath);
            }

            imagedestroy($file);

            return $captcha;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Get Code
    //--------------------------------------------------------------------------------------------------------
    //
    // Daha önce oluşturulan güvenlik uygulamasının kod bilgini verir.
    //
    // @param  void
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function getCode() : String
    {
        return Session::select(md5('SystemCaptchaCodeData'));
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Color
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _convertColor($color)
    {
        if( $convert = Config::get('Colors', $color) )
        {
            return $convert;
        }

        return $color;
    }
}
