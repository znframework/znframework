<?php namespace ZN\IndividualStructures\User;
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
    //--------------------------------------------------------------------------------------------------------
    // Error
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    public function error()
    {
        return Properties::$error;
    }

    //--------------------------------------------------------------------------------------------------------
    // Success
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    public function success()
    {
        return Properties::$success;
    }
}
