<?php namespace ZN\IndividualStructures\Import;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\IndividualStructures\Exception\FileNotFoundException;

class Template
{
    //--------------------------------------------------------------------------------------------------------
    // template()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $page
    // @param array  $data
    // @param bool   $obGetContents
    //
    //--------------------------------------------------------------------------------------------------------
    public static function use(String $page, Array $data = NULL, Bool $obGetContents = false)
    {
        if( $return = View::use($page, $data, $obGetContents, TEMPLATES_DIR) )
        {
            return $return;
        }
        elseif( $return = View::use($page, $data, $obGetContents, EXTERNAL_TEMPLATES_DIR) )
        {
            return $return;
        }
        else
        {
            return false;
        }
    }
}
