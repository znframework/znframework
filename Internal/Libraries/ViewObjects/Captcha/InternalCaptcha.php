<?php namespace ZN\ViewObjects;

use Config, Session, Cookie, CLController, Encode, File, Folder, Arraysi URL;

class InternalCaptcha extends CLController implements InternalCaptchaInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    const config = 'ViewObjects:captcha';

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
    // Sets
    //--------------------------------------------------------------------------------------------------------
    //
    // Güvenlik kodu nesnesine ait yol bilgisi
    //
    // @var  string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $path = FILES_DIR;

    //--------------------------------------------------------------------------------------------------------
    // Constructor
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct()
    {
        parent::__construct();

        $this->_clean();
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
        $this->sets['size']['width']  = $width;
        $this->sets['size']['height'] = $height;

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
    // Angle
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  numeric $param
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function angle(Float $param) : InternalCaptcha
    {
        $this->sets['text']['angle'] = $param;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // TTF
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  array $fonts
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function ttf(Array $fonts) : InternalCaptcha
    {
        $this->sets['text']['ttf'] = $fonts;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Border Color
    //--------------------------------------------------------------------------------------------------------
    //
    // Güvenlik kodu nesnesinin çerçevesinin olup olmayacağı olacaksa da hangi.
    // hangi renkte olacağı belirtilir.
    //
    // @param  string  $color
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function borderColor(String $color = NULL) : InternalCaptcha
    {
        $this->sets['border']['status'] = true;

        if( ! empty($color) )
        {
            $this->sets['border']['color'] = $this->_convertColor($color);
        }

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
    public function bgImage(Array $image) : InternalCaptcha
    {
        $this->sets['background']['image'] = $image;

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
    // Grid Color
    //--------------------------------------------------------------------------------------------------------
    //
    // Güvenlik kodu nesnesinin ızgarasının olup olmayacağı olacaksa da hangi.
    // hangi renkte olacağı belirtilir.
    //
    // @param  string  $color
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function gridColor(String $color = NULL) : InternalCaptcha
    {
        $this->sets['grid']['status'] = true;

        if( ! empty($color) )
        {
            $this->sets['grid']['color'] = $this->_convertColor($color);
        }

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
        $configs = array_merge(VIEWOBJECTS_CAPTCHA_CONFIG, $this->sets, $configs);

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
            if( ! Folder::exists($this->path) )
            {
                Folder::create($this->path);
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


            $file       = imagecreatetruecolor($sizeWidthC, $sizeHeightC);
            $fontColor  = imagecolorallocate($file, $setFontColor[0], $setFontColor[1], $setFontColor[2]);
            $color      = imagecolorallocate($file, $setBgColor[0], $setBgColor[1], $setBgColor[2]);

            // ARKAPLAN RESMI--------------------------------------------------------------------------------------
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
                // Arkaplan olarak resim belirtilmemiş ise arkaplan rengini ayarlar.
                imagefill($file, 0, 0, $color);
            }
            //--------------------------------------------------------------------------------------------------------------------------

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

            // GRID --------------------------------------------------------------------------------------
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
            // ---------------------------------------------------------------------------------------------

            // BORDER --------------------------------------------------------------------------------------
            if( $borderStatusC === true )
            {
                $borderColor = imagecolorallocate($file, $setBorderColor[0], $setBorderColor[1], $setBorderColor[2]);

                imageline($file, 0, 0, $sizeWidthC, 0, $borderColor); // UST
                imageline($file, $sizeWidthC - 1, 0, $sizeWidthC - 1, $sizeHeightC, $borderColor); // SAG
                imageline($file, 0, $sizeHeightC - 1, $sizeWidthC, $sizeHeightC - 1, $borderColor); // ALT
                imageline($file, 0, 0, 0, $sizeHeightC - 1, $borderColor); // SOL
            }
            // ---------------------------------------------------------------------------------------------

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
    // Protected fuction Clean
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _clean()
    {
        $files   = Folder::files($this->path, 'png');
        $match   = Arrays::getFirst(preg_grep('/captcha\-([a-z]|[0-9])+\.png/i', $files));
        $captcha = $this->path . $match;

        if( File::exists($captcha) )
        {
            File::delete($captcha);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected fuction Name
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _name()
    {
        return 'captcha-' . Encode::create(16) . '.png';
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
