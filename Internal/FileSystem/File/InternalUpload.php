<?php namespace ZN\FileSystem;

use Config, Folder, File, Converter, Encode, CallController, IS;

class InternalUpload extends CallController implements InternalUploadInterface
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
    // Settings
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    private $settings = [];

    //--------------------------------------------------------------------------------------------------------
    // File
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $file;

    //--------------------------------------------------------------------------------------------------------
    // Extension Control
    //--------------------------------------------------------------------------------------------------------
    //
    // @var bool
    //
    //--------------------------------------------------------------------------------------------------------
    protected $extensionControl;

    //--------------------------------------------------------------------------------------------------------
    // Setting Status
    //--------------------------------------------------------------------------------------------------------
    //
    // @var bool
    //
    //--------------------------------------------------------------------------------------------------------
    protected $settingStatus = false;

    //--------------------------------------------------------------------------------------------------------
    // Errors
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $errors;

    //--------------------------------------------------------------------------------------------------------
    // Manuel Error
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $manuelError;

    //--------------------------------------------------------------------------------------------------------
    // Encode Name
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $encodeName;

    //--------------------------------------------------------------------------------------------------------
    // Path
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $path;

    //--------------------------------------------------------------------------------------------------------
    // Construct
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct()
    {
        Config::iniSet(Config::get('Htaccess', 'upload')['settings']);
    }

    //--------------------------------------------------------------------------------------------------------
    // Settings
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $set
    //
    //--------------------------------------------------------------------------------------------------------
    public function settings(Array $set = []) : InternalUpload
    {
        $this->settingStatus = true;

        // 1-extensions -> Dosyanın uzantısı
        if( isset($set['extensions']) )
        {
            $this->settings['extensions']   = $set['extensions'];
        }

        // 2-encode -> Dosyanın şifrelenmesi
        if( isset($set['encode']) )
        {
            $this->settings['encryption']   = $set['encode'];
        }
        else
        {
            $this->settings['encryption']   = 'md5';
        }

        // 3-prefix -> Yüklenen dosyaların önüne ön ek koymak
        if( isset($set['prefix']) )
        {
            $this->settings['prefix']       = $set['prefix'];
        }

        // 4-mazsize -> Yükselenecebilecek maksimum dosya boyutu
        if( isset($set['maxsize']) )
        {
            $this->settings['maxsize']      = $set['maxsize'];
        }

        // 5-encodeLength -> Şifrenin karakter uzunluğu
        if( isset($set['encodeLength']) )
        {
            $this->settings['encodeLength'] = $set['encodeLength'];
        }
        else
        {
            $this->settings['encodeLength'] = 8;
        }

        // 4-mazsize -> Yükselenecebilecek maksimum dosya boyutu
        if( isset($set['convertName']) )
        {
            $this->settings['convertName']  = $set['convertName'];
        }
        else
        {
            $this->settings['convertName']  = true;
        }

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Extension
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string variadic $args
    //
    //--------------------------------------------------------------------------------------------------------
    public function extensions(...$args) : InternalUpload
    {
        if( ! empty($args ) )
        {
            $this->settings['extensions'] = implode('|', $args);
        }

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Convert Name
    //--------------------------------------------------------------------------------------------------------
    //
    // @param bool $convert
    //
    //--------------------------------------------------------------------------------------------------------
    public function convertName(Bool $convert = true) : InternalUpload
    {
        $this->settings['convertName'] = $convert;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Encode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $hash
    //
    //--------------------------------------------------------------------------------------------------------
    public function encode(String $hash = 'md5') : InternalUpload
    {
        if( IS::hash($hash) )
        {
            $this->settings['encryption'] = $hash;
        }
        else
        {
            $this->settings['encryption'] = 'md5';
        }

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Prefix
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $prefix
    //
    //--------------------------------------------------------------------------------------------------------
    public function prefix(String $prefix) : InternalUpload
    {
        $this->settings['prefix'] = $prefix;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Maxsize
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int $maxsize
    //
    //--------------------------------------------------------------------------------------------------------
    public function maxsize(Int $maxsize = 0) : InternalUpload
    {
        $this->settings['maxsize'] = $maxsize;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Encode Length
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int $encodeLength
    //
    //--------------------------------------------------------------------------------------------------------
    public function encodeLength(Int $encodeLength = 8) : InternalUpload
    {
        $this->settings['encodeLength'] = $encodeLength;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Target
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $target
    //
    //--------------------------------------------------------------------------------------------------------
    public function target(String $target = UPLOADS_DIR) : InternalUpload
    {
        $this->settings['target'] = $target;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Source
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $source
    //
    //--------------------------------------------------------------------------------------------------------
    public function source(String $source = 'upload') : InternalUpload
    {
        $this->settings['source'] = $source;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Start
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $fileName
    // @param string $rootDir
    //
    //--------------------------------------------------------------------------------------------------------
    public  function start(String $fileName = 'upload', String $rootDir = UPLOADS_DIR) : Bool
    {
        if( isset($this->settings['source']) )
        {
            $fileName = $this->settings['source'];
        }

        if( isset($this->settings['target']) )
        {
            $rootDir = $this->settings['target'];
        }

        if( ! is_string($rootDir) )
        {
            $rootDir = UPLOADS_DIR;
        }

        if( ! Folder::exists($rootDir) )
        {
            Folder::create($rootDir);
        }

        if( $this->settingStatus === false )
        {
            $this->settings();
        }

        $this->file = $fileName;

        $root = suffix($rootDir, '/');

        if( ! isset($_FILES[$fileName]['name']) )
        {
            $this->manuelError = 4;
            return false;
        }

        $name = $_FILES[$fileName]['name'];

        $encryption = '';

        if( isset($this->settings['prefix']) )
        {
            $encryption = $this->settings['prefix'];
        }

        if( isset($this->settings['extensions']) )
        {
            $extensions = explode("|", $this->settings['extensions']);
        }

        $source = $_FILES[$fileName]['tmp_name'];

        // Çoklu yükleme yapılıyorsa.
        if( is_array($name) )
        {
            if( empty($name[0]) )
            {
                return ! $this->manuelError = 4;
            }

            for( $index = 0; $index < count($name); $index++ )
            {
                $src = $source[$index];
                $nm  = $name[$index];

                if( $this->settings['convertName'] === true )
                {
                    $nm = $this->_convertName($nm);
                }

                if( $this->settings['encryption'] )
                {
                    $encryption = $this->_encode();
                }
                else
                {
                    if( is_file($root.$nm) )
                    {
                        $encryption = $this->_encode();
                    }
                }

                $encryptionName     = $encryption.$nm;
                $target             = $root . $encryptionName;
                $this->encodeName[] = $encryptionName;
                $this->path[]       = $target;

                if( isset($this->settings['extensions']) && ! in_array(File::extension($nm), $extensions) )
                {
                    $this->extensionControl = \Lang::select('FileSystem', 'upload:extensionError');
                }
                elseif( isset($this->settings['maxsize']) && $this->settings['maxsize'] < filesize($src) )
                {
                    $this->manuelError = 10;
                }
                else
                {
                    if( ! is_file($rootDir) )
                    {
                        move_uploaded_file($src, $target);
                    }
                    else
                    {
                        $this->manuelError = 9;
                    }
                }
            }

            return true;
        }
        else
        {
            if( $this->settings['convertName'] === true )
            {
                 $name = $this->_convertName($name);
            }

            if( empty($_FILES[$fileName]['name']) )
            {
                $this->manuelError = 4;
                return false;
            }

            if( isset($this->settings['maxsize']) && $this->settings['maxsize'] < filesize($source) )
            {
                $this->manuelError = 10;
                return false;
            }

            if( $this->settings['encryption'] )
            {
                $encryption = $this->_encode();
            }
            else
            {
                if( is_file($root.$name) )
                {
                    $encryption = $this->_encode();
                }
            }

            $encryptionName   = $encryption . $name;
            $target           = $root . $encryptionName;
            $this->encodeName = $encryptionName;
            $this->path       = $target;

            if( isset($this->settings['extensions']) && ! in_array(File::extension($name),$extensions) )
            {
                return ! $this->extensionControl = \Lang::select('FileSystem', 'upload:extensionError');
            }
            else
            {
                if( ! is_file($rootDir) )
                {
                    return move_uploaded_file($source, $target);
                }
                else
                {
                    return ! $this->manuelError = 9;
                }
            }
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Info
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $info
    //
    //--------------------------------------------------------------------------------------------------------
    public function info(String $info = NULL)
    {
        if( ! empty($_FILES[$this->file]) )
        {
            $datas = array
            (
                'name'       => $_FILES[$this->file]['name'],
                'type'       => $_FILES[$this->file]['type'],
                'size'       => $_FILES[$this->file]['size'],
                'tmpName'    => $_FILES[$this->file]['tmp_name'],
                'error'      => $_FILES[$this->file]['error'],
                'path'       => $this->path,
                'encodeName' => $this->encodeName
            );

            $values = [];

            if( ! is_array($_FILES[$this->file]['name']) ) foreach( $datas as $key => $val )
            {
                $values[$key] = $val;
            }
            else
            {
                foreach( $datas as $key => $val )
                {
                    if( ! empty($datas[$key]) )
                    {
                        foreach( $datas[$key] as $v )
                        {
                            $values[$key][] = $v;
                        }
                    }
                }
            }
        }
        else
        {
            return false;
        }

        if( ! empty($values[$info]) )
        {
            return $values[$info];
        }

        return (object) $values;
    }

    //--------------------------------------------------------------------------------------------------------
    // Error
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function error()
    {
        $errorNo = $_FILES[$this->file]['error'] ?? NULL;

        if( $errorNo === NULL )
        {
            return \Lang::select('FileSystem', 'upload:unknownError');
        }

        if( is_array($errorNo) )
        {
            $errno = 0;

            foreach( $errorNo as $no )
            {
                if( ! empty($no) )
                {
                    $errno = $no;
                    break;
                }
            }

            $errorNo = $errno;
        }

        $lang = \Lang::select('FileSystem');

        $this->errors =
        [
            '0'  => "scc",                          // Dosya başarı ile yüklendi.
            '1'  => $lang['upload:1'], // Php.ini dosyasındaki maximum dosya boyutu aşıldı.
            '2'  => $lang['upload:2'], // Formtaki max_file_size direktifindeki dosya boyutu limiti aşıldı.
            '3'  => $lang['upload:3'], // Dosya yükleme işlemi tamamlanmadı.
            '4'  => $lang['upload:4'], // Yüklenecek dosya yok.
            '6'  => $lang['upload:6'], // Dosyaların geçici olarak yükleneceği dizin bulunamadı.
            '7'  => $lang['upload:7'], // Dosya dik üzerine yazılamadı.
            '8'  => $lang['upload:8'], // Dosya yükleme uzantı desteği yok.
            '9'  => $lang['upload:9'], // Dosya yükleme yolu geçerli değil.
            '10' => $lang['upload:10'] // Belirlenen maksimum dosya boyutu aşıldı!
        ];
        // Manuel belirlenen hata oluşmuşsa
        if( ! empty($this->manuelError) )
        {
            return $this->errors[$this->manuelError];
        }
        // Uzantıdan kaynaklı hata oluşmussa
        elseif( ! empty($this->extensionControl) )
        {
            return $this->extensionControl;
        }
        // Hata numarasına göre hata bildir.
        elseif( ! empty($this->errors[$errorNo]) )
        {
            if( $this->errors[$errorNo] === "scc" )
            {
                return false;
            }
            // 0 Dışında herhangi bir hata numarası oluşmussa
            return $this->errors[$errorNo];
        }
        // Bu kontroller dışında hata oluşmussa bilinmeyen
        // hata uyarısı ver.
        else
        {
            return \Lang::select('FileSystem', 'upload:unknownError');
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Convert Name
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _convertName($name = NULL)
    {
        return  Converter::slug(File::removeExtension($name)) . '.' . File::extension($name);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Encode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _encode()
    {
        $encode = $this->settings['encryption'];
        $length = $this->settings['encodeLength'];

        if( ! IS::hash($encode) )
        {
            $encode = 'md5';
        }

        return substr(Encode::type(uniqid(rand()), $encode), 0, $length).'-';
    }
}
