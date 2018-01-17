<?php namespace ZN\Inclusion\Project;
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
use ZN\Request;

class Theme
{
    /**
     * Active status
     * 
     * @var string
     */
    public static $active = NULL;

    /**
     * Active theme.
     * 
     * @param string $active = 'Default'
     * 
     * @return void
     */
    public static function active(String $active = 'Default')
    {
        self::$active = Base::suffix($active);
    }

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
                        return str_replace($path, Request::getBaseURL(THEMES_DIR) . $suffix, $orig);
                    }
                }     

                return $selector[0];
                
            }, $data
        );
    }
}
