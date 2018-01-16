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

use ZN\IS;
use ZN\Base;
use ZN\Inclusion;
use ZN\Singleton;
use ZN\Request\URL;
use ZN\Request\URI;
use ZN\Response\Redirect;
use ZN\Cryptography\Encode;
use ZN\Authentication\Exception\ActivationColumnException;

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
        $getColumns         = $this->getConfig['matching']['columns'];
        $getJoining         = $this->getConfig['joining'];
        $tableName          = $this->getConfig['matching']['table'];
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
            return ! Properties::$error = $this->getLang['registerUsernameError'];
        }

        $loginUsername   = $data[$usernameColumn];
        $loginPassword   = $data[$passwordColumn];
        $encodeType      = $this->getConfig['encode'];
        $encodePassword  = ! empty($encodeType) ? Encode\Type::create($loginPassword, $encodeType) : $loginPassword;

        $usernameControl = $this->dbClass->where($usernameColumn, $loginUsername)
                                ->get($tableName)
                                ->totalRows();

        if( empty($usernameControl) )
        {
            $data[$passwordColumn] = $encodePassword;

            if( ! $this->dbClass->insert($tableName , $data) )
            {
                return ! Properties::$error = $this->getLang['registerUnknownError'];
            }

            if( ! empty($joinTables) )
            {
                $joinCol = $this->dbClass->where($usernameColumn, $loginUsername)->get($tableName)->row()->$joinColumn;

                foreach( $joinTables as $table => $joinColumn )
                {
                    $joinData[$table][$joinTables[$table]] = $joinCol;

                    $this->dbClass->insert($table, $joinData[$table]);
                }
            }

            Properties::$success = $this->getLang['registerSuccess'];

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
                    new Redirect($autoLogin);
                }
            }

            return true;
        }
        else
        {
            return ! Properties::$error = $this->getLang['registerError'];
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
        $getColumns         = $this->getConfig['matching']['columns'];
        $tableName          = $this->getConfig['matching']['table'];
        $usernameColumn     = $getColumns['username'];
        $passwordColumn     = $getColumns['password'];
        $activationColumn   = $getColumns['activation'];

        # Return link values.
        $user = URI::get('user');
        $pass = URI::get('pass');

        if( ! empty($user) && ! empty($pass) )
        {
            $row = $this->dbClass->where($usernameColumn, $user, 'and')
                        ->where($passwordColumn, $pass)
                        ->get($tableName)
                        ->row();

            if( ! empty($row) )
            {
                $this->dbClass->where($usernameColumn, $user)
                              ->update($tableName, [$activationColumn => '1']);

                return Properties::$success = $this->getLang['activationComplete'];
            }
            else
            {
                return ! Properties::$error = $this->getLang['activationCompleteError'];
            }
        }
        else
        {
            return ! Properties::$error = $this->getLang['activationCompleteError'];
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
        $getColumns = $this->getConfig['matching']['columns'];
        $tableName  = $this->getConfig['matching']['table'];

        if( empty($getColumns['activation']) )
        {
            throw new ActivationColumnException();
        }

        $data = $this->dbClass->where($getColumns['username'], $email ?? $username, 'and')
                     ->where($getColumns['activation'], '0')
                     ->get($tableName)
                     ->row();
        
        if( empty($data) )
        {
            return ! Properties::$error = $this->getLang['resendActivationError'];
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
        $url = Base::suffix($activationReturnLink);

        if( ! IS::url($url) )
        {
            $url = URL::site($url);
        }

        $senderInfo = $this->getConfig['emailSenderInfo'];

        $templateData =
        [
            'url'  => $url,
            'user' => $user,
            'pass' => $pass
        ];

        $message = Inclusion\Template::use('UserEmail/Activation', $templateData, true);

        $user = $email ?? $user;

        $emailclass = Singleton::class('ZN\Email\Sender');

        $emailclass->sender($senderInfo['mail'], $senderInfo['name'])
                   ->receiver($user, $user)
                   ->subject($this->getLang['activationProcess'])
                   ->content($message);

        if( $emailclass->send() )
        {
            return Properties::$success = $this->getLang['activationEmail'];
        }
        else
        {
            return ! Properties::$error = $this->getLang['emailError'];
        }
    }
}
