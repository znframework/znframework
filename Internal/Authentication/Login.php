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
use ZN\Services\Method;
use ZN\Cryptography\Encode;
use ZN\Language\Lang;

class Login extends UserExtends
{
    /**
     * Magic constructor
     * 
     * @param void
     * 
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->sessionClass = Singleton::class('ZN\Storage\Session');
        $this->cookieClass  = Singleton::class('ZN\Storage\Cookie');
    }

    /**
     * Username
     * 
     * @param string $username
     * 
     * @return Login
     */
    public function username(String $username) : Login
    {
        Properties::$parameters['username'] = $username;

        return $this;
    }

    /**
     * Password
     * 
     * @param string $password
     * 
     * @return Login
     */
    public function password(String $password) : Login
    {
        Properties::$parameters['password'] = $password;

        return $this;
    }

    /**
     * Remember
     * 
     * @param bool $remember = true
     * 
     * @return Login
     */
    public function remember(Bool $remember = true) : Login
    {
        Properties::$parameters['remember'] = $remember;

        return $this;
    }

    /**
     * Do Login
     * 
     * @param string $username   = NULL
     * @param string $password   = NULL
     * @param mixed  $rememberMe = false
     * 
     * @return bool
     */
    public function do(String $un = NULL, String $pw = NULL, $rememberMe = false) : Bool
    {
        $un         = Properties::$parameters['username'] ?? $un;
        $pw         = Properties::$parameters['password'] ?? $pw;
        $rememberMe = Properties::$parameters['remember'] ?? $rememberMe;

        Properties::$parameters = [];

        if( ! is_scalar($rememberMe) )
        {
            $rememberMe = false;
        }

        $username   = $un;
        $encodeType = $this->getConfig['encode'];

        $password   = ! empty($encodeType) ? Encode\Type::create($pw, $encodeType) : $pw;

        # Settings
        $tableName          = $this->getConfig['matching']['table'];
        $getColumns         = $this->getConfig['matching']['columns'];
        $passwordColumn     = $getColumns['password'];
        $usernameColumn     = $getColumns['username'];
        $emailColumn        = $getColumns['email'];
        $bannedColumn       = $getColumns['banned'];
        $activeColumn       = $getColumns['active'];
        $activationColumn   = $getColumns['activation'];

        $this->_multiUsernameColumns($username);

        $r = $this->dbClass->where($usernameColumn, $username)
               ->get($tableName)
               ->row();

        if( ! isset($r->$passwordColumn) )
        {
            return ! Properties::$error = Lang::select('IndividualStructures', 'user:loginError');
        }

        $passwordControl   = $r->$passwordColumn;
        $bannedControl     = '';
        $activationControl = '';

        if( ! empty($bannedColumn) )
        {
            $banned = $bannedColumn ;
            $bannedControl = $r->$banned ;
        }

        if( ! empty($activationColumn) )
        {
            $activationControl = $r->$activationColumn ;
        }

        if( ! empty($r->$usernameColumn) && $passwordControl == $password )
        {
            if( ! empty($bannedColumn) && ! empty($bannedControl) )
            {
                return ! Properties::$error = Lang::select('IndividualStructures', 'user:bannedError');
            }

            if( ! empty($activationColumn) && empty($activationControl) )
            {
                return ! Properties::$error = Lang::select('IndividualStructures', 'user:activationError');
            }

            $this->sessionClass->insert($usernameColumn, $username);
            $this->sessionClass->insert($passwordColumn, $password);

            if( Method::post($rememberMe) || ! empty($rememberMe) )
            {
                if( $this->cookieClass->select($usernameColumn) !== $username )
                {
                    $this->cookieClass->insert($usernameColumn, $username);
                    $this->cookieClass->insert($passwordColumn, $password);
                }
            }

            if( ! empty($activeColumn) )
            {
                $this->dbClass->where($usernameColumn, $username)->update($tableName, [$activeColumn  => 1]);
            }

            return Properties::$success = Lang::select('IndividualStructures', 'user:loginSuccess');
        }
        else
        {
            return ! Properties::$error = Lang::select('IndividualStructures', 'user:loginError');
        }
    }

    /**
     * Is Login
     * 
     * @param void
     * 
     * @return bool
     */
    public function is() : Bool
    {
        $getColumns  = $this->getConfig['matching']['columns'];
        $tableName   = $this->getConfig['matching']['table'];
        $username    = $getColumns['username'];
        $password    = $getColumns['password'];
        $getUserData = (new Data)->get($tableName);

        if( ! empty($getColumns['banned']) && ! empty($getUserData->{$getColumns['banned']}) )
        {
             (new Logout)->do();
        }

        $cUsername  = $this->cookieClass->select($username);
        $cPassword  = $this->cookieClass->select($password);
        $result     = NULL;

        if( ! empty($cUsername) && ! empty($cPassword) )
        {
            $result = $this->dbClass->where($username, $cUsername, 'and')
                        ->where($password, $cPassword)
                        ->get($tableName)
                        ->totalRows();
        }

        if( isset($getUserData->$username) )
        {
            $isLogin = true;
        }
        elseif( ! empty($result) )
        {
            $this->sessionClass->insert($username, $cUsername);
            $this->sessionClass->insert($password, $cPassword);

            $isLogin = true;
        }
        else
        {
            $isLogin = false;
        }

        return $isLogin;
    }
}
