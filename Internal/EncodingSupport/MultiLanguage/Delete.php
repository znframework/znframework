<?php namespace ZN\EncodingSupport\MultiLanguage;

use ZN\DataTypes\Json\Encode;
use ZN\DataTypes\Json\Decode;
use ZN\FileSystem\File\Content;
use ZN\FileSystem\File\Info;
use ZN\FileSystem\File\Forge;
use ZN\FileSystem\Folder\FileList;

class Delete extends MLExtends
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
    // Delete
    //--------------------------------------------------------------------------------------------------------
    //
    // Silinecek dil dosyası.
    // @param string $app
    // @param mixed  $key
    //
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function do(String $app, $key) : Bool
    {
        $datas = [];

        $createFile = $this->_langFile($app);

        // Dosya mevcutsa verileri al.
        if( Info::exists($createFile) )
        {
            $datas = Decode::array(Content::read($createFile));
        }

        if( ! empty($datas) )
        {
            $json = $datas;
        }

        // Yine anahtar parametresinin ver türüne göre
        // işlemleri gerçekleştirmesi sağlanıyor.
        if( ! is_array($key) )
        {
            unset($json[$key]);
        }
        else
        {
            foreach($key as $v)
            {
                unset($json[$v]);
            }
        }

        // Dosyayı yeniden yaz.
        return Content::write($createFile, Encode::do($json));
    }

    //--------------------------------------------------------------------------------------------------------
    // Delete All
    //--------------------------------------------------------------------------------------------------------
    //
    // Silinecek dil dosyası.
    // @param string $app
    //
    //--------------------------------------------------------------------------------------------------------
    public function all($app = NULL) : Bool
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
                $this->all($removeExtension);
            }

            return true;
        }
        else
        {
            $createFile = $this->_langFile($app);
            // Dosya mevcutsa verileri al.
            if( Info::exists($createFile) )
            {
                return Forge::delete($createFile);
            }

            return false;
        }
    }
}
