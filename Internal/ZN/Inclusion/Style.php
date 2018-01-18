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

class Style extends BootstrapExtends
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
        return '<link href="'.$src.'" rel="stylesheet" type="text/css" />' . EOL;
    }

    /**
     * Get styles
     * 
     * @param string ...$styles
     * 
     * @return mixed
     */
    public static function use(...$styles)
    {
        return self::gettype('style', $styles);
    }
}
