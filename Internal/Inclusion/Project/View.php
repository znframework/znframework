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

use ZN\Inclusion;

class View
{
    use ViewTrait;

    /**
     * Load view.
     * 
     * @param string $file   = NULL
     * @param bool   $usable = false
     * 
     * @return mixed
     */
    public static function get(String $file = NULL, $usable = false)
    {
        return Inclusion\View::use($file, [], $usable);
    }
}
