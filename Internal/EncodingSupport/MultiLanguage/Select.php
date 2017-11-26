<?php namespace ZN\EncodingSupport\MultiLanguage;

use ZN\DataTypes\Json\Decode;
use ZN\FileSystem\File\Content;
use ZN\FileSystem\File\Info;
use ZN\FileSystem\Folder\FileList;

class Select extends MLExtends
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
    // Select
    //--------------------------------------------------------------------------------------------------------
    //
    // Dil dosyasın yer alan istenilen kelimeye erişmek için kullanılır.
    // @param mixed $key
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function do(String $key = NULL, $convert = NULL)
    {
        if( Info::exists($this->lang) )
        {
            $read   = Content::read($this->lang);
        }

        if( Info::exists($this->externalLang) )
        {
            $eread  = Content::read($this->externalLang);
        }

        $read   = Decode::array($read  ?? '');
        $eread  = Decode::array($eread ?? '');
        $array  = array_merge($eread, $read);

        if( $key === NULL )
        {
            return $array;
        }

        $return = '';

        if( isset($array[$key]) )
        {
            if( is_array($convert) )
            {
                $return = str_replace(array_keys($convert), array_values($convert), $array[$key]);
            }
            else
            {
                $return = str_replace('%', $convert, $array[$key]);
            }
        }

        return $return;
    }

    //--------------------------------------------------------------------------------------------------------
    // Select All
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  mixed $app
    // @return array
    //
    //--------------------------------------------------------------------------------------------------------
    public function all($app = NULL) : Array
    {
        if( ! is_string($app) )
        {
            if( $app === NULL )
            {
                $MLFiles = FileList::files($this->appdir, 'ml');
            }
            elseif( is_array($app) )
            {
                $MLFiles = $app;
            }
            else
            {
                return false;
            }

            $allMLFiles = [];

            if( ! empty($MLFiles) ) foreach( $MLFiles as $file )
            {
                $removeExtension = str_replace('.ml', '', $file);
                $allMLFiles[$removeExtension] = $this->all($removeExtension);
            }

            return $allMLFiles;
        }
        else
        {
            $createFile = $this->_langFile($app);

            $read = Content::read($createFile);

            return Decode::array($read);
        }
    }
}
