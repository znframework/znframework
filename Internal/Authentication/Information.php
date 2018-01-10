<?php namespace ZN\Authentication;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Information
{
    /**
     * Get errors
     * 
     * @param void
     * 
     * @return array
     */
    public function error()
    {
        return Properties::$error;
    }

    /**
     * Get success
     * 
     * @param void
     * 
     * @return array
     */
    public function success()
    {
        return Properties::$success;
    }
}
