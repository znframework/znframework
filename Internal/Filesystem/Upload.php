<?php namespace ZN\Filesystem;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\IS;
use ZN\Base;
use ZN\Lang;
use ZN\Helpers\Mime;
use ZN\Helpers\Converter;
use ZN\DataTypes\Arrays;
use ZN\Cryptography\Encode;

class Upload implements UploadInterface
{
    /**
     * Keeps settings
     * 
     * @var array
     */
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

    /**
     * Keeps file
     * 
     * @var string
     */
    protected $file;

    /**
     * Extension Control
     * 
     * @var bool
     */
    protected $extensionControl;

    /**
     * Keeps errors
     * 
     * @var array
     */
    protected $errors;

    /**
     * Keeps manuel error
     * 
     * @var string
     */
    protected $manuelError;

    /**
     * Keeps encode name
     * 
     * @var string
     */
    protected $encodeName;

    /**
     * Keeps file path
     * 
     * @var string
     */
    protected $path;

    /**
     * Magic Constructor
     */
    public function __construct()
    {
        $this->getLang = Lang::default(new FilesystemDefaultLanguage)::select('Filesystem');
    }

    /**
     * Settings
     * 
     * @param array $settings = []
     * 
     * @return Upload
     */
    public function settings(Array $settings = []) : Upload
    {
        foreach( $settings as $key => $val )
        {
            $this->settings[$key] = $val;
        }

        return $this;
    }

    /**
     * Sets extensions
     * 
     * @param string ...$args
     * 
     * @return Upload
     */
    public function extensions(...$args) : Upload
    {
        if( ! empty($args ) )
        {
            $this->settings['extensions'] = implode('|', $args);
        }

        return $this;
    }

    /**
     * Sets convert name
     * 
     * @param bool $convert = true
     * 
     * @return Upload
     */
    public function convertName(Bool $convert = true) : Upload
    {
        $this->settings['convertName'] = $convert;

        return $this;
    }

    /**
     * Sets mimes
     * 
     * @param string ...$args
     * 
     * @return Upload
     */
    public function mimes(...$args) : Upload
    {
        if( ! empty($args ) )
        {
            $this->settings['mimes'] = implode('|', $args);
        }

        return $this;
    }

    /**
     * Defines encode type
     * 
     * @param string $hash = 'md5'
     * 
     * @return Upload
     */
    public function encode(String $hash = 'md5') : Upload
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

    /**
     * Sets prefix
     * 
     * @param string $prefix
     * 
     * @return Upload
     */
    public function prefix(String $prefix) : Upload
    {
        $this->settings['prefix'] = $prefix;

        return $this;
    }

    /**
     * Sets maxsize
     * 
     * @param int $maxsize = 0
     * 
     * @return Upload
     */
    public function maxsize(Int $maxsize = 0) : Upload
    {
        $this->settings['maxsize'] = $maxsize;

        return $this;
    }

    /**
     * Sets encode length
     * 
     * @param int $encodeLength = 8
     * 
     * @return Upload
     */
    public function encodeLength(Int $encodeLength = 8) : Upload
    {
        $this->settings['encodeLength'] = $encodeLength;

        return $this;
    }

    /**
     * Sets target
     * 
     * @param string $target
     * 
     * @return Upload
     */
    public function target(String $target) : Upload
    {
        $this->settings['target'] = $target;

        return $this;
    }

    /**
     * Sets source
     * 
     * @param string $source = 'upload'
     * 
     * @return Upload
     */
    public function source(String $source = 'upload') : Upload
    {
        $this->settings['source'] = $source;

        return $this;
    }

    /**
     * Start file upload
     * 
     * @param string $fileName = 'upload'
     * @param string $rootDir  = NULL
     * 
     * @return bool
     */
    public  function start(String $fileName = 'upload', String $rootDir = NULL) : Bool
    {
        $fileName = $this->settings['source'] ?? $fileName;
        $rootDir  = $this->settings['target'] ?? $rootDir ?? UPLOADS_DIR;

        if( ! is_dir($rootDir) ) 
        {
            mkdir($rootDir);
        }

        $extensions = $this->_separator('extensions');
        $mimes      = $this->_separator('mimes');

        $this->file = $fileName;
        $encryption = $this->settings['prefix']      ?? '';
        $name       = $_FILES[$fileName]['name']     ?? NULL;
        $source     = $_FILES[$fileName]['tmp_name'] ?? NULL;
        $root       = Base::suffix($rootDir, '/');     

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

    /**
     * Gets info
     * 
     * @param string $info = NULL
     * 
     * @return object|false
     */
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

    /**
     * Gets error
     * 
     * @return string|false
     */
    public function error()
    {
        $errorNo = $_FILES[$this->file]['error'] ?? NULL;

        if( $errorNo === NULL )
        {
            return $this->getLang['upload:unknownError'];
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

        $lang = $this->getLang;

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
            return $lang['upload:unknownError'];
        }
    }

    /**
     * Protected Separator
     */
    protected function _separator($key)
    {
        if( $set = ($this->settings[$key] ?? NULL) )
        {
            return explode('|', $set);
        }

        return [];
    }

    /**
     * Protected Upload
     */
    protected function _upload($rootDir, $root, $src, $nm, $extensions, $mimes, $encryption)
    {
        if( empty($nm) )
        {
            return ! $this->manuelError = 4;
        }   
        
        if( ($this->settings['convertName'] ?? NULL) === true )
        {
            # 5.4.3[edited] 
            $nm = Converter::slug($nm, true);
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
            $this->encodeName = Arrays\AddElement::last((array) $this->encodeName, $encryptionName);
            $this->path       = Arrays\AddElement::last((array) $this->path      , $target        );     
        }
        else
        {
            $this->encodeName = $encryptionName;
            $this->path       = $target;
        }

        if( ! empty($extensions) && ! in_array(Filesystem\Extension::get($nm), $extensions) )
        {
            return $this->extensionControl = $this->getLang['upload:extensionError'];
        }
        elseif( ! empty($mimes) && ! in_array(Mime::type($nm), $mimes) )
        {
            return $this->extensionControl = $this->getLang['upload:mimeError'];
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

    /**
     * Protected Encode
     */
    protected function _encode()
    {
        $encode = $this->settings['encode'];
        $length = $this->settings['encodeLength'];

        if( ! IS::hash($encode) )
        {
            $encode = 'md5';
        }

        return substr(Encode\Type::create(uniqid(rand()), $encode), 0, $length).'-';
    }

    /**
     * Protected Default
     */
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
