<?php namespace ZN\TemplateEngine;
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

class Theme
{
    /**
     * Theme integration.
     * 
     * @param string $themeName
     * @param string &$data
     * 
     * @return void
     */
    public static function integration(String $themeName, String &$data)
    {
        $data = preg_replace_callback
        (
            '/<(link|img|script|div)\s(.*?)(href|src)\=\"(.*?)\"(.*?)\>/i', 
            function($selector) use ($themeName)
            {
                $orig = $selector[0];
                $path = $selector[4];

                if( ! IS::url($path) && ! is_file($path) )
                {
                    $suffix = Base::suffix($themeName) . $path;

                    if( is_file(THEMES_DIR . $suffix) )
                    {
                        return str_replace($path, THEMES_URL . $suffix, $orig);
                    }
                }     

                return $selector[0];
                
            }, $data
        );
    }
}
