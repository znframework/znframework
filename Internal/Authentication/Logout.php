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

use ZN\Singleton;

class Logout extends UserExtends
{
    /**
     * Do Logout
     * 
     * @param string $redirectUrl = NULL
     * @param int    $time        = 0
     * 
     * @return void
     */
    public function do(String $redirectUrl = NULL, Int $time = 0)
    {
        $getColumns  = $this->getConfig['matching']['columns'];
        $tableName   = $this->getConfig['matching']['table'];
        $username    = $getColumns['username'];
        $password    = $getColumns['password'];
        $active      = $getColumns['active'];
        $getUserData = (new Data)->get($tableName)->$username ?? NULL;

        if( $getUserData !== NULL )
        {
            if( ! empty($active) )
            {
                $this->dbClass->where($username, $getUserData)
                     ->update($tableName, [$active => 0]);
            }

            $cookie  = Singleton::class('ZN\Storage\Cookie');
            $session = Singleton::class('ZN\Storage\Session');

            $cookie ->delete($username);
            $cookie ->delete($password);
            $session->delete($username);

            Singleton::class('ZN\Response\Redirect')->location((string) $redirectUrl, $time);
        }
    }
}
