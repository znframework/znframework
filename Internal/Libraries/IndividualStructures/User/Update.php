<?php namespace ZN\IndividualStructures\User;

use Encode;

class Update extends UserExtends
{
    //--------------------------------------------------------------------------------------------------------
    // Old Password
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $oldPassword
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function oldPassword(String $oldPassword) : Update
    {
        Properties::$parameters['oldPassword'] = $oldPassword;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // New Password
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $Password
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function newPassword(String $newPassword) : Update
    {
        Properties::$parameters['newPassword'] = $newPassword;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Password Again
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $passwordAgain
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function passwordAgain(String $passwordAgain) : Update
    {
        Properties::$parameters['passwordAgain'] = $passwordAgain;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Update
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $old
    // @param  string $new
    // @param  string $newAgain
    // @param  array  $data
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function do(String $old = NULL, String $new = NULL, String $newAgain = NULL, Array $data = []) : Bool
    {
        if( Factory::class('Login')->is() )
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

            $getColumns = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['columns'];
            $getJoining = INDIVIDUALSTRUCTURES_USER_CONFIG['joining'];
            $joinTables = $getJoining['tables'];
            $jc         = $getJoining['column'];
            $pc         = $getColumns['password'];
            $uc         = $getColumns['username'];
            $tn         = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['table'];
            $encodeType = INDIVIDUALSTRUCTURES_USER_CONFIG['encode'];

            $oldPassword      = ! empty($encodeType) ? Encode::type($old, $encodeType)      : $old;
            $newPassword      = ! empty($encodeType) ? Encode::type($new, $encodeType)      : $new;
            $newPasswordAgain = ! empty($encodeType) ? Encode::type($newAgain, $encodeType) : $newAgain;

            if( ! empty($joinTables) )
            {
                $joinData = $data;
                $data     = $data[$tn] ?? [$tn];
            }

            $getUserData = Factory::class('Data')->get($tn);
            $username    = $getUserData->$uc;
            $password    = $getUserData->$pc;

            if( $oldPassword != $password )
            {
                return ! Properties::$error = lang('IndividualStructures', 'user:oldPasswordError');
            }
            elseif( $newPassword != $newPasswordAgain )
            {
                return ! Properties::$error = lang('IndividualStructures', 'user:passwordNotMatchError');
            }
            else
            {
                $data[$pc] = $newPassword;
                $data[$uc] = $username;

                if( ! empty($joinTables) )
                {
                    $joinCol = $this->staticConnection->where($uc, $username)->get($tn)->row()->$jc;

                    foreach( $joinTables as $table => $joinColumn )
                    {
                        if( isset($joinData[$table]) )
                        {
                            $this->staticConnection->where($joinColumn, $joinCol)->update($table, $joinData[$table]);
                        }
                    }
                }
                else
                {
                    if( ! $this->staticConnection->where($uc, $username)->update($tn, $data) )
                    {
                        return ! Properties::$error = lang('IndividualStructures', 'user:registerUnknownError');
                    }
                }

                return Properties::$success = lang('IndividualStructures', 'user:updateProcessSuccess');
            }
        }
        else
        {
            return false;
        }
    }
}
