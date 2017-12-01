<?php namespace ZN\IndividualStructures\User;

use DB, Session, Cookie;
use ZN\Services\Method;
use ZN\CryptoGraphy\Encode;
use ZN\IndividualStructures\Lang;

class Login extends UserExtends
{
    //--------------------------------------------------------------------------------------------------------
    // Username
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $username
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function username(String $username) : Login
    {
        Properties::$parameters['username'] = $username;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Password
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $password
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function password(String $password) : Login
    {
        Properties::$parameters['password'] = $password;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Remember
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  bool $remember
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function remember(Bool $remember = true) : Login
    {
        Properties::$parameters['remember'] = $remember;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Login
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $un
    // @param  string $pw
    // @param  bool   $rememberMe
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
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
        $encodeType = INDIVIDUALSTRUCTURES_USER_CONFIG['encode'];

        $password   = ! empty($encodeType) ? Encode\Type::create($pw, $encodeType) : $pw;

        // ------------------------------------------------------------------------------
        // Settings
        // ------------------------------------------------------------------------------
        $tableName          = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['table'];
        $getColumns         = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['columns'];
        $passwordColumn     = $getColumns['password'];
        $usernameColumn     = $getColumns['username'];
        $emailColumn        = $getColumns['email'];
        $bannedColumn       = $getColumns['banned'];
        $activeColumn       = $getColumns['active'];
        $activationColumn   = $getColumns['activation'];
        // ------------------------------------------------------------------------------

        $this->_multiUsernameColumns($username);

        $r = DB::where($usernameColumn, $username)
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

            Session::insert($usernameColumn, $username);
            Session::insert($passwordColumn, $password);

            if( Method::post($rememberMe) || ! empty($rememberMe) )
            {
                if( Cookie::select($usernameColumn) !== $username )
                {
                    Cookie::insert($usernameColumn, $username);
                    Cookie::insert($passwordColumn, $password);
                }
            }

            if( ! empty($activeColumn) )
            {
                DB::where($usernameColumn, $username)->update($tableName, [$activeColumn  => 1]);
            }

            return Properties::$success = Lang::select('IndividualStructures', 'user:loginSuccess');
        }
        else
        {
            return ! Properties::$error = Lang::select('IndividualStructures', 'user:loginError');
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Is Login
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function is() : Bool
    {
        $getColumns  = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['columns'];
        $tableName   = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['table'];
        $username    = $getColumns['username'];
        $password    = $getColumns['password'];
        $getUserData = (new Data)->get($tableName);

        if( ! empty($getColumns['banned']) && ! empty($getUserData->{$getColumns['banned']}) )
        {
             (new Logout)->do();
        }

        $cUsername  = Cookie::select($username);
        $cPassword  = Cookie::select($password);
        $result     = NULL;

        if( ! empty($cUsername) && ! empty($cPassword) )
        {
            $result = DB::where($username, $cUsername, 'and')
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
            Session::insert($username, $cUsername);
            Session::insert($password, $cPassword);

            $isLogin = true;
        }
        else
        {
            $isLogin = false;
        }

        return $isLogin;
    }
}
