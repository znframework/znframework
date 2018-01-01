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

class Data extends UserExtends
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

        $sessionUserName = \Session::select($usernameColumn) ? \Session::select($usernameColumn) : \Cookie::select($usernameColumn);
        $sessionPassword = \Session::select($passwordColumn) ? \Session::select($passwordColumn) : \Cookie::select($passwordColumn);

        if( ! empty($sessionUserName) )
        {
            $joinTables      = INDIVIDUALSTRUCTURES_USER_CONFIG['joining']['tables'];
            $usernameColumn  = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['columns']['username'];
            $joinColumn      = INDIVIDUALSTRUCTURES_USER_CONFIG['joining']['column'];
            $tableName       = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['table'];

            $this->_multiUsernameColumns($sessionUserName);

            $r[$tbl] = \DB::where($usernameColumn, $sessionUserName, 'and')
                         ->where($passwordColumn, $sessionPassword)
                         ->get($tableName)
                         ->row();

            if( ! empty($joinTables) )
            {
                $this->_multiUsernameColumns($sessionUserName);

                $joinCol = \DB::where($usernameColumn, $sessionUserName, 'and')
                             ->where($passwordColumn, $sessionPassword)
                             ->get($tableName)
                             ->row()
                             ->$joinColumn;

                foreach( $joinTables as $table => $joinColumn )
                {
                    $r[$table] = \DB::where($joinColumn, $joinCol)
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
    public function activeCount($type = 'active') : Int
    {
        $column    = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['columns'][$type];
        $tableName = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['table'];

        return \DB::where($column, 1)->get($tableName)->totalRows();
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
        return $this->activeCount('banned');
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

        return \DB::get($tableName)->totalRows();
    }
}
