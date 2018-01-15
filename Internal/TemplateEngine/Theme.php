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
use ZN\Request\URL;

class Theme
{
    /**
     * Keeps themes directory path
     * 
     * @var string
     */
    protected static $path = THEMES_DIR;

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

                    if( is_file(self::$path . $suffix) )
                    {
                        return str_replace($path, URL::base(self::$path) . $suffix, $orig);
                    }
                }     

                return $selector[0];
                
            }, $data
        );
    }
}
