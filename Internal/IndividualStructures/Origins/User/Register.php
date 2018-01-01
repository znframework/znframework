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

use ZN\Services\URL;
use ZN\Services\URI;
use ZN\CryptoGraphy\Encode;
use ZN\IndividualStructures\IS;
use ZN\IndividualStructures\Lang;
use ZN\IndividualStructures\Import;
use ZN\IndividualStructures\Exception\ActivationColumnException;

class Register extends UserExtends
{
    /**
     * Auto login.
     * 
     * @param mixed $autoLogin = true
     * 
     * @return Register
     */
    public function autoLogin($autoLogin = true) : Register
    {
        Properties::$parameters['autoLogin'] = $autoLogin;

        return $this;
    }

    /**
     * Do register.
     * 
     * @param array  $data                 = NULL
     * @param mixed  $autoLogin            = false
     * @param string $activationReturnLink = ''
     * 
     * @return Bool
     */
    public function do(Array $data = NULL, $autoLogin = false, String $activationReturnLink = '') : Bool
    {
        $data                   = Properties::$parameters['column']     ?? $data;
        $autoLogin              = Properties::$parameters['autoLogin']  ?? $autoLogin;
        $activationReturnLink   = Properties::$parameters['returnLink'] ?? $activationReturnLink;
        Properties::$parameters = [];

        # Settings
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

        if( ! empty($joinTables) )
        {
            $joinData = $data;
            $data     = $data[$tableName] ?? [$tableName];
        }

        if( ! isset($data[$usernameColumn]) ||  ! isset($data[$passwordColumn]) )
        {
            return ! Properties::$error = Lang::select('IndividualStructures', 'user:registerUsernameError');
        }

        $loginUsername   = $data[$usernameColumn];
        $loginPassword   = $data[$passwordColumn];
        $encodeType      = INDIVIDUALSTRUCTURES_USER_CONFIG['encode'];
        $encodePassword  = ! empty($encodeType) ? Encode\Type::create($loginPassword, $encodeType) : $loginPassword;

        $usernameControl = \DB::where($usernameColumn, $loginUsername)
                             ->get($tableName)
                             ->totalRows();

        if( empty($usernameControl) )
        {
            $data[$passwordColumn] = $encodePassword;

            if( ! \DB::insert($tableName , $data) )
            {
                return ! Properties::$error = Lang::select('IndividualStructures', 'user:registerUnknownError');
            }

            if( ! empty($joinTables) )
            {
                $joinCol = \DB::where($usernameColumn, $loginUsername)->get($tableName)->row()->$joinColumn;

                foreach( $joinTables as $table => $joinColumn )
                {
                    $joinData[$table][$joinTables[$table]] = $joinCol;

                    \DB::insert($table, $joinData[$table]);
                }
            }

            Properties::$success = Lang::select('IndividualStructures', 'user:registerSuccess');

            if( ! empty($activationColumn) )
            {
                if( ! IS::email($loginUsername) )
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
                    (new Login)->do($loginUsername, $loginPassword);
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
            return ! Properties::$error = Lang::select('IndividualStructures', 'user:registerError');
        }
    }

    /**
     * Activation complete.
     * 
     * @param void
     * 
     * @return bool
     */
    public function activationComplete() : Bool
    {
        # Settings
        $getColumns         = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['columns'];
        $tableName          = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['table'];
        $usernameColumn     = $getColumns['username'];
        $passwordColumn     = $getColumns['password'];
        $activationColumn   = $getColumns['activation'];

        # Return link values.
        $user = URI::get('user');
        $pass = URI::get('pass');

        if( ! empty($user) && ! empty($pass) )
        {
            $row = \DB::where($usernameColumn, $user, 'and')
                     ->where($passwordColumn, $pass)
                     ->get($tableName)
                     ->row();

            if( ! empty($row) )
            {
                \DB::where($usernameColumn, $user)
                  ->update($tableName, [$activationColumn => '1']);

                return Properties::$success = Lang::select('IndividualStructures', 'user:activationComplete');
            }
            else
            {
                return ! Properties::$error = Lang::select('IndividualStructures', 'user:activationCompleteError');
            }
        }
        else
        {
            return ! Properties::$error = Lang::select('IndividualStructures', 'user:activationCompleteError');
        }
    }

    /**
     * Resend activation e-mail.
     * 
     * @param string $username
     * @param string $returnLink
     * @param string $email = NULL
     * 
     * @return bool
     */
    public function resendActivationEmail(String $username, String $returnLink, String $email = NULL) : Bool
    {
        # Settings
        $getColumns = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['columns'];
        $tableName  = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['table'];

        if( empty($getColumns['activation']) )
        {
            throw new ActivationColumnException();
        }

        $data = \DB::where($getColumns['username'], $email ?? $username, 'and')
                   ->where($getColumns['activation'], '0')
                   ->get($tableName)
                   ->row();
        
        if( empty($data) )
        {
            return ! Properties::$error = Lang::select('IndividualStructures', 'user:resendActivationError');
        }
        
        return $this->_activation($username, $data->{$getColumns['password']}, $returnLink, $email);
    }

    /**
     * protected activation
     * 
     * @param string $user
     * @param string $pass 
     * @param string $activationReturnLink
     * @param string $email
     * 
     * @return bool
     */
    protected function _activation($user, $pass, $activationReturnLink, $email)
    {
        $url = suffix($activationReturnLink);

        if( ! IS::url($url) )
        {
            $url = URL::site($url);
        }

        $senderInfo = INDIVIDUALSTRUCTURES_USER_CONFIG['emailSenderInfo'];

        $templateData =
        [
            'url'  => $url,
            'user' => $user,
            'pass' => $pass
        ];

        $message = Import\Template::use('UserEmail/Activation', $templateData, true);

        $user = $email ?? $user;

        \Email::sender($senderInfo['mail'], $senderInfo['name'])
             ->receiver($user, $user)
             ->subject(Lang::select('IndividualStructures', 'user:activationProcess'))
             ->content($message);

        if( \Email::send() )
        {
            return Properties::$success = Lang::select('IndividualStructures', 'user:activationEmail');
        }
        else
        {
            return ! Properties::$error = Lang::select('IndividualStructures', 'user:emailError');
        }
    }
}
