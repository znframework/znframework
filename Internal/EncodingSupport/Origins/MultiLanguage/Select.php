<?php namespace ZN\EncodingSupport\MultiLanguage;

use ZN\DataTypes\Json;
use ZN\FileSystem\File;
use ZN\FileSystem\Folder;

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
        if( is_file($this->lang) )
        {
            $read   = file_get_contents($this->lang);
        }

        if( is_file($this->externalLang) )
        {
            $eread  = file_get_contents($this->externalLang);
        }

        $read   = json_decode($read  ?? '', true);
        $eread  = json_decode($eread ?? '', true);
        $array  = array_merge((array) $eread, (array) $read);

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
                $MLFiles = Folder\FileList::files($this->appdir, 'ml');
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

            $read = file_get_contents($createFile);

            return json_decode($read, true);
        }
    }
}
