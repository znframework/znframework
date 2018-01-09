<?php namespace ZN;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Inclusion\Import;

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
        return Import\View::use($file, [], $usable);
    }
}

# Alias View
class_alias('ZN\View', 'Project\Controllers\View');
