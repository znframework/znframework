<?php namespace ZN\EncodingSupport\MultiLanguage;

use ZN\FileSystem\File;

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

        if( ! is_file($createFile) )
        {
            file_put_contents($createFile, json_encode([]));
        }

        $datas = json_decode(file_get_contents($createFile), true);

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
            return file_put_contents($createFile, json_encode($json, JSON_UNESCAPED_UNICODE));
        }
        else
        {
            return false;
        }
    }
}
