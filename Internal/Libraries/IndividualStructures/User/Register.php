<?php namespace ZN\IndividualStructures\User;

use Encode, DB, Email, Import, URI;

class Register extends UserExtends implements RegisterInterface
{
    //--------------------------------------------------------------------------------------------------------
    // Auto Login
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  mixed $autoLogin
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function autoLogin($autoLogin = true) : Register
    {
        Properties::$parameters['autoLogin'] = $autoLogin;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Register
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  array       $data
    // @param  bool/string $autoLogin
    // @param  string      $activationReturnLink
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function do(Array $data = NULL, $autoLogin = false, String $activationReturnLink = NULL) : Bool
    {
        $data                   = Properties::$parameters['column']     ?? $data;
        $autoLogin              = Properties::$parameters['autoLogin']  ?? $autoLogin;
        $activationReturnLink   = Properties::$parameters['returnLink'] ?? $activationReturnLink;
        Properties::$parameters = [];

        // ------------------------------------------------------------------------------
        // Settings
        // ------------------------------------------------------------------------------
        $getColumns         = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['columns'];
        $getJoining         = INDIVIDUALSTRUCTURES_USER_CONFIG['joining'];
        $tableName          = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['table'];
        $joinTables         = $getJoining['tables'];
        $joinColumn         = $getJoining['column'];
        $usernameColumn     = $getColumns['username'];
        $passwordColumn     = $getColumns['password'];
        $emailColumn        = $getColumns['email'];
        $activeColumn       = $getColumns['active'];
        $activationColumn   = $getColumns['activation'];
        // ------------------------------------------------------------------------------

        if( ! empty($joinTables) )
        {
            $joinData = $data;
            $data     = isset($data[$tableName])
                      ? $data[$tableName]
                      : [$tableName];
        }

        if( ! isset($data[$usernameColumn]) ||  ! isset($data[$passwordColumn]) )
        {
            return ! $this->error = lang('IndividualStructures', 'user:registerUsernameError');
        }

        $loginUsername   = $data[$usernameColumn];
        $loginPassword   = $data[$passwordColumn];
        $encodeType      = INDIVIDUALSTRUCTURES_USER_CONFIG['encode'];
        $encodePassword  = ! empty($encodeType) ? Encode::type($loginPassword, $encodeType) : $loginPassword;

        $usernameControl = DB::where($usernameColumn, $loginUsername)
                             ->get($tableName)
                             ->totalRows();

        // Daha önce böyle bir kullanıcı
        // yoksa kullanıcı kaydetme işlemini başlat.
        if( empty($usernameControl) )
        {
            $data[$passwordColumn] = $encodePassword;

            if( ! DB::insert($tableName , $data) )
            {
                return ! $this->error = lang('IndividualStructures', 'user:registerUnknownError');
            }

            if( ! empty($joinTables) )
            {
                $joinCol = DB::where($usernameColumn, $loginUsername)->get($tableName)->row()->$joinColumn;

                foreach( $joinTables as $table => $joinColumn )
                {
                    $joinData[$table][$joinTables[$table]] = $joinCol;

                    DB::insert($table, $joinData[$table]);
                }
            }

            $this->success = lang('IndividualStructures', 'user:registerSuccess');

            if( ! empty($activationColumn) )
            {
                if( ! isEmail($loginUsername) )
                {
                    $email = $data[$emailColumn];
                }
                else
                {
                    $email = NULL;
                }

                $this->_activation($loginUsername, $encodePassword, $activationReturnLink, $email);
            }
            else
            {
                if( $autoLogin === true )
                {
                    Factory::class('Login')->do($loginUsername, $loginPassword);
                }
                elseif( is_string($autoLogin) )
                {
                    redirect($autoLogin);
                }
            }

            return true;
        }
        else
        {
            return ! $this->error = lang('IndividualStructures', 'user:registerError');
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Activation Complete
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    //
    //--------------------------------------------------------------------------------------------------------
    public function activationComplete() : Bool
    {
        // ------------------------------------------------------------------------------
        // Settings
        // ------------------------------------------------------------------------------
        $getColumns         = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['columns'];
        $tableName          = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['table'];
        $usernameColumn     = $getColumns['username'];
        $passwordColumn     = $getColumns['password'];
        $activationColumn   = $getColumns['activation'];
        // ------------------------------------------------------------------------------

        // Aktivasyon dönüş linkinde yer alan segmentler -------------------------------
        $user = URI::get('user');
        $pass = URI::get('pass');
        // ------------------------------------------------------------------------------

        if( ! empty($user) && ! empty($pass) )
        {
            $row = DB::where($usernameColumn, $user, 'and')
                     ->where($passwordColumn, $pass)
                     ->get($tableName)
                     ->row();

            if( ! empty($row) )
            {
                DB::where($usernameColumn, $user)
                  ->update($tableName, [$activationColumn => '1']);

                return $this->success = lang('IndividualStructures', 'user:activationComplete');
            }
            else
            {
                return ! $this->error = lang('IndividualStructures', 'user:activationCompleteError');
            }
        }
        else
        {
            return ! $this->error = lang('IndividualStructures', 'user:activationCompleteError');
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Activation
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $user
    // @param  string $pass
    // @param  string $activationReturnLink
    // @param  string $email
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _activation($user, $pass, $activationReturnLink, $email)
    {
        $url = suffix($activationReturnLink);

        if( ! isUrl($url) )
        {
            $url = siteUrl($url);
        }

        $senderInfo = INDIVIDUALSTRUCTURES_USER_CONFIG['emailSenderInfo'];

        $templateData =
        [
            'url'  => $url,
            'user' => $user,
            'pass' => $pass
        ];

        $message = Import::template('UserEmail/Activation', $templateData, true);

        $user = $email ?? $user;

        Email::sender($senderInfo['mail'], $senderInfo['name'])
             ->receiver($user, $user)
             ->subject(lang('IndividualStructures', 'user:activationProcess'))
             ->content($message);

        if( Email::send() )
        {
            return $this->success = lang('IndividualStructures', 'user:activationEmail');
        }
        else
        {
            return ! $this->error = lang('IndividualStructures', 'user:emailError');
        }
    }
}
