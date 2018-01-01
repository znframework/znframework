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

class Logout extends UserExtends
{
    //--------------------------------------------------------------------------------------------------------
    // Logout
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $redirectUrl
    // @param  numeric $time
    // @return void
    //
    //--------------------------------------------------------------------------------------------------------
    public function do(String $redirectUrl = NULL, Int $time = 0)
    {
        $getColumns  = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['columns'];
        $tableName   = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['table'];
        $username    = $getColumns['username'];
        $password    = $getColumns['password'];
        $active      = $getColumns['active'];
        $getUserData = (new Data)->get($tableName)->$username ?? NULL;

        if( $getUserData !== NULL )
        {
            if( ! empty($active) )
            {
                \DB::where($username, $getUserData)
                  ->update($tableName, [$active => 0]);
            }

            \Cookie::delete($username);
            \Cookie::delete($password );
            \Session::delete($username);

            redirect((string) $redirectUrl, $time);
        }
    }
}
