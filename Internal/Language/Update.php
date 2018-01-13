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

class Update
{
    /**
     * Updates language key
     * 
     * @param string $app  = NULL
     * @param mixed  $key
     * @param string $data = NULL
     * 
     * @return bool
     */
    public function do(String $app = NULL, $key, String $data = NULL) : Bool
    {
        return (new Insert)->do($app, $key, $data);
    }
}
