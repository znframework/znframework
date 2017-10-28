<?php namespace ZN\FileSystem;

use Config, Folder, File, Converter, Encode, CallController, IS, Mime, Lang;

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
    private $settings = 
    [
        'encode'        => 'md5', 
        'encodeLength'  => 8,
        'extensions'    => [],
        'mimes'         => [],
        'convertName'   => true,
        'prefix'        => NULL,
        'maxsize'       => NULL
    ];

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
    // @param array $settings 
    //
    //--------------------------------------------------------------------------------------------------------
    public function settings(Array $settings = []) : InternalUpload
    {
        foreach( $settings as $key => $val )
        {
            $this->settings[$key] = $val;
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
    // Mimes -> 5.4.1[added]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string variadic $args
    //
    //--------------------------------------------------------------------------------------------------------
    public function mimes(...$args) : InternalUpload
    {
        if( ! empty($args ) )
        {
            $this->settings['mimes'] = implode('|', $args);
        }

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
            $this->settings['encode'] = $hash;
        }
        else
        {
            $this->settings['encode'] = 'md5';
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
        $fileName = $this->settings['source'] ?? $fileName;
        $rootDir  = $this->settings['target'] ?? $rootDir;

        if( ! Folder::exists($rootDir) ) 
        {
            Folder::create($rootDir);
        }

        $extensions = $this->_separator('extensions');
        $mimes      = $this->_separator('mimes');

        $this->file = $fileName;
        $encryption = $this->settings['prefix']      ?? '';
        $name       = $_FILES[$fileName]['name']     ?? NULL;
        $source     = $_FILES[$fileName]['tmp_name'] ?? NULL;
        $root       = suffix($rootDir, '/');     

        if( is_array($name) )
        {
            for( $index = 0; $index < count($name); $index++ )
            {
                $this->_upload($rootDir, $root, $source[$index], $name[$index], $extensions, $mimes, $encryption);
            }

            $return = true;
        }
        else
        {
            $return = $this->_upload($rootDir, $root, $source, $name, $extensions, $mimes, $encryption);
        }

        $this->_default();

        return $return;
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
            $datas = 
            [
                'name'       => $_FILES[$this->file]['name'],
                'type'       => $_FILES[$this->file]['type'],
                'size'       => $_FILES[$this->file]['size'],
                'tmpName'    => $_FILES[$this->file]['tmp_name'],
                'error'      => $_FILES[$this->file]['error'],
                'path'       => $this->path,
                'encodeName' => $this->encodeName
            ];

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
                        foreach( (array) $datas[$key] as $v )
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
            return Lang::select('FileSystem', 'upload:unknownError');
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

        $lang = Lang::select('FileSystem');

        $this->errors =
        [
            '0'  => "scc",            
            '1'  => $lang['upload:1'],
            '2'  => $lang['upload:2'], 
            '3'  => $lang['upload:3'], 
            '4'  => $lang['upload:4'], 
            '6'  => $lang['upload:6'], 
            '7'  => $lang['upload:7'], 
            '8'  => $lang['upload:8'], 
            '9'  => $lang['upload:9'],
            '10' => $lang['upload:10']
        ];
       
        if( ! empty($this->manuelError) )
        {
            return $this->errors[$this->manuelError];
        }
        elseif( ! empty($this->extensionControl) )
        {
            return $this->extensionControl;
        }
        elseif( ! empty($this->errors[$errorNo]) )
        {
            if( $this->errors[$errorNo] === "scc" )
            {
                return false;
            }
            return $this->errors[$errorNo];
        }
        else
        {
            return Lang::select('FileSystem', 'upload:unknownError');
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Separator
    //--------------------------------------------------------------------------------------------------------
    //
    // @params
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _separator($key)
    {
        if( $set = ($this->settings[$key] ?? NULL) )
        {
            return explode('|', $set);
        }

        return [];
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Upload
    //--------------------------------------------------------------------------------------------------------
    //
    // @params
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _upload($rootDir, $root, $src, $nm, $extensions, $mimes, $encryption)
    {
        if( empty($nm) )
        {
            return ! $this->manuelError = 4;
        }   
        
        if( ($this->settings['convertName'] ?? NULL) === true )
        {
             $nm = $this->_convertName($nm);
        }

        if( $this->settings['encode'] ?? NULL )
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

        $encryptionName     = $encryption . $nm;
        $target             = $root . $encryptionName;

        if( is_array($_FILES[$this->file]['name']) )
        {
            $this->encodeName[] = $encryptionName;
            $this->path[]       = $target;
        }
        else
        {
            $this->encodeName = $encryptionName;
            $this->path       = $target;
        }

        if( ! empty($extensions) && ! in_array(File::extension($nm), $extensions) )
        {
            return $this->extensionControl = Lang::select('FileSystem', 'upload:extensionError');
        }
        elseif( ! empty($mimes) && ! in_array(Mime::type($nm), $mimes) )
        {
            return $this->extensionControl = Lang::select('FileSystem', 'upload:mimeError');
        }
        elseif( ! empty($maxsize = ($this->settings['maxsize'] ?? NULL)) && $maxsize < filesize($src) )
        {
            return $this->manuelError = 10;
        }
        else
        {
            if( ! is_file($rootDir) )
            {
                return move_uploaded_file($src, $target);
            }
            else
            {
                return ! $this->manuelError = 9;
            }
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
        $encode = $this->settings['encode'];
        $length = $this->settings['encodeLength'];

        if( ! IS::hash($encode) )
        {
            $encode = 'md5';
        }

        return substr(Encode::type(uniqid(rand()), $encode), 0, $length).'-';
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Default
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _default()
    {
        $this->settings = 
        [
            'encode'        => 'md5', 
            'encodeLength'  => 8,
            'extensions'    => [],
            'mimes'         => [],
            'convertName'   => true,
            'prefix'        => NULL,
            'maxsize'       => NULL
        ];
    }
}
