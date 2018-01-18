<?php namespace ZN\Inclusion;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Script extends BootstrapExtends
{
    /**
     * HTML Element
     * 
     * @param string $src = NULL
     * 
     * @return string
     */
    public static function tag(String $src = NULL) : String
    {
        return '<script type="text/javascript" src="'.$src.'"></script>' . EOL;
    }

    /**
     * Get scripts
     * 
     * @param string ...$scripts
     * 
     * @return mixed
     */
    public static function use(...$scripts)
    {
        return self::gettype('script', $scripts);
    }
}
