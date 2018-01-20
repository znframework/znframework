<?php namespace ZN\Language;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Insert extends MLExtends
{
    /**
     * Insert language key
     * 
     * @param string $app  = NULL
     * @param mixed  $key
     * @param string $data = NULL
     * 
     * @return bool
     */
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
