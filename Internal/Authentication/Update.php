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

use ZN\Cryptography\Encode;

class Update extends UserExtends
{
    /**
     * Controls old password
     * 
     * @param string $oldPassword
     * 
     * @return Update
     */
    public function oldPassword(String $oldPassword) : Update
    {
        Properties::$parameters['oldPassword'] = $oldPassword;

        return $this;
    }

    /**
     * New Password
     * 
     * @param string $newPassword
     * 
     * @return Update
     */
    public function newPassword(String $newPassword) : Update
    {
        Properties::$parameters['newPassword'] = $newPassword;

        return $this;
    }

    /**
     * Password Again
     * 
     * @param string $passwordAgain
     * 
     * @return Update
     */
    public function passwordAgain(String $passwordAgain) : Update
    {
        Properties::$parameters['passwordAgain'] = $passwordAgain;

        return $this;
    }

    /**
     * Do Update
     * 
     * @param string $old      = NULL
     * @param string $new      = NULL
     * @param string $newAgain = NULL
     * @param array  $data     = []
     * 
     * @return bool
     */
    public function do(String $old = NULL, String $new = NULL, String $newAgain = NULL, Array $data = []) : Bool
    {
        if( (new Login)->is() )
        {
            $old      = Properties::$parameters['oldPassword']   ?? $old;
            $new      = Properties::$parameters['newPassword']   ?? $new;
            $newAgain = Properties::$parameters['passwordAgain'] ?? $newAgain;
            $data     = Properties::$parameters['column']        ?? $data;

            Properties::$parameters = [];

            if( empty($newAgain) )
            {
                $newAgain = $new;
            }

            $getColumns = $this->getConfig['matching']['columns'];
            $getJoining = $this->getConfig['joining'];
            $joinTables = $getJoining['tables'];
            $jc         = $getJoining['column'];
            $pc         = $getColumns['password'];
            $uc         = $getColumns['username'];
            $tn         = $this->getConfig['matching']['table'];
            $encodeType = $this->getConfig['encode'];

            $oldPassword      = ! empty($encodeType) ? Encode\Type::create($old, $encodeType)      : $old;
            $newPassword      = ! empty($encodeType) ? Encode\Type::create($new, $encodeType)      : $new;
            $newPasswordAgain = ! empty($encodeType) ? Encode\Type::create($newAgain, $encodeType) : $newAgain;

            if( ! empty($joinTables) )
            {
                $joinData = $data;
                $data     = $data[$tn] ?? [$tn];
            }

            $getUserData = (new Data)->get($tn);
            $username    = $getUserData->$uc;
            $password    = $getUserData->$pc;

            if( $oldPassword != $password )
            {
                return ! Properties::$error = $this->getLang['oldPasswordError'];
            }
            elseif( $newPassword != $newPasswordAgain )
            {
                return ! Properties::$error = $this->getLang['passwordNotMatchError'];
            }
            else
            {
                $data[$pc] = $newPassword;
                $data[$uc] = $username;

                if( ! empty($joinTables) )
                {
                    $joinCol = $this->dbClass->where($uc, $username)->get($tn)->row()->$jc;

                    foreach( $joinTables as $table => $joinColumn )
                    {
                        if( isset($joinData[$table]) )
                        {
                            $this->dbClass->where($joinColumn, $joinCol)->update($table, $joinData[$table]);
                        }
                    }
                }
                else
                {
                    if( ! $this->dbClass->where($uc, $username)->update($tn, $data) )
                    {
                        return ! Properties::$error = $this->getLang['registerUnknownError'];
                    }
                }

                return Properties::$success = $this->getLang['updateProcessSuccess'];
            }
        }
        else
        {
            return false;
        }
    }
}
