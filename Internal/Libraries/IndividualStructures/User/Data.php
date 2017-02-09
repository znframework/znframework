<?php namespace ZN\IndividualStructures\User;

use Session, Cookie;

class Data extends UserExtends implements DataInterface
{
    //--------------------------------------------------------------------------------------------------------
    // Data
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $tbl
    // @return object
    //
    //--------------------------------------------------------------------------------------------------------
    public function get(String $tbl = NULL)
    {
        $usernameColumn  = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['columns']['username'];
        $passwordColumn  = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['columns']['password'];

        $sessionUserName = Session::select($usernameColumn) ? Session::select($usernameColumn) : Cookie::select($usernameColumn);
        $sessionPassword = Session::select($passwordColumn) ? Session::select($passwordColumn) : Cookie::select($passwordColumn);

        if( ! empty($sessionUserName) )
        {
            $joinTables      = INDIVIDUALSTRUCTURES_USER_CONFIG['joining']['tables'];
            $usernameColumn  = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['columns']['username'];
            $joinColumn      = INDIVIDUALSTRUCTURES_USER_CONFIG['joining']['column'];
            $tableName       = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['table'];

            $r[$tbl] = Properties::$connection->where($usernameColumn, $sessionUserName, 'and')
                         ->where($passwordColumn, $sessionPassword)
                         ->get($tableName)
                         ->row();

            if( ! empty($joinTables) )
            {
                $joinCol = Properties::$connection->where($usernameColumn, $sessionUserName, 'and')
                             ->where($passwordColumn, $sessionPassword)
                             ->get($tableName)
                             ->row()
                             ->$joinColumn;

                foreach( $joinTables as $table => $joinColumn )
                {
                    $r[$table] = Properties::$connection->where($joinColumn, $joinCol)
                                   ->get($table)
                                   ->row();
                }
            }

            if( empty($joinTables) )
            {
                return (object) $r[$tbl];
            }
            else
            {
                if( ! empty($tbl) )
                {
                    return (object) $r[$tbl];
                }
                else
                {
                    return (object) $r;
                }
            }
        }
        else
        {
            return false;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Active Count
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return numeric
    //
    //--------------------------------------------------------------------------------------------------------
    public function activeCount() : Int
    {
        $activeColumn = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['columns']['active'];
        $tableName    = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['table'];

        if( ! empty($activeColumn) )
        {
            $totalRows = Properties::$connection->where($activeColumn, 1)
                           ->get($tableName)
                           ->totalRows();

            if( ! empty($totalRows) )
            {
                return $totalRows;
            }
            else
            {
                return 0;
            }
        }

        return 0;
    }

    //--------------------------------------------------------------------------------------------------------
    // Banned Count
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return numeric
    //
    //--------------------------------------------------------------------------------------------------------
    public function bannedCount() : Int
    {
        $bannedColumn = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['columns']['banned'];
        $tableName    = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['table'];

        if( ! empty($bannedColumn) )
        {
            $totalRows = Properties::$connection->where($bannedColumn, 1)
                           ->get($tableName)
                           ->totalRows();

            if( ! empty($totalRows) )
            {
                return $totalRows;
            }
            else
            {
                return 0;
            }
        }

        return 0;
    }

    //--------------------------------------------------------------------------------------------------------
    // Count
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return numeric
    //
    //--------------------------------------------------------------------------------------------------------
    public function count() : Int
    {
        $tableName = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['table'];

        $totalRows = Properties::$connection->get($tableName)->totalRows();

        if( ! empty($totalRows) )
        {
            return $totalRows;
        }
        else
        {
            return 0;
        }
    }
}
