<?php namespace ZN\EncodingSupport\MultiLanguage;

use ZN\DataTypes\Json\Encode;
use ZN\DataTypes\Json\Decode;
use ZN\FileSystem\File\Content;
use ZN\FileSystem\File\Info;

class Insert extends MLExtends
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
    // Insert
    //--------------------------------------------------------------------------------------------------------
    //
    // Dil dosyasına kelime eklemek için kullanılır.
    // @param string $app
    // @param mixed  $key
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function do(String $app, $key, String $data = NULL) : Bool
    {
        $datas = [];

        $createFile = $this->_langFile($app);

        if( ! Info::exists($createFile) )
        {
            Content::write($createFile, Encode::do([]));
        }

        $datas = Decode::array(Content::read($createFile));

        if( ! empty($datas) )
        {
            $json = $datas;
        }

        if( ! is_array($key) )
        {
            $json[$key] = $data;
        }
        else
        {
            foreach( $key as $k => $v )
            {
                $json[$k] = $v;
            }
        }

        if( $json !== $datas )
        {
            return Content::write($createFile, Encode::do($json));
        }
        else
        {
            return false;
        }
    }
}
