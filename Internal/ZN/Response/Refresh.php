<?php namespace ZN\Response;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Refresh extends Redirect
{
    /**
     * Magic Constructor
     *
     * @param string $url  = NULL
     * @param int    $time = 0
     * @param array  $data = NULL
     * @param bool   $exit = false
     */
    public function __construct(String $url = NULL, Int $time = 0, Array $data = NULL, Bool $exit = false)
    {
        if( $url !== NULL )
        {
            $this->refresh($url, $time, $data, $exit);
        }
    }
}
