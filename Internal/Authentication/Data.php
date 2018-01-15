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

class Data extends UserExtends
{
    /**
     * Get Data
     * 
     * @param string $tbl = NULL
     * 
     * @return object
     */
    public function get(String $tbl = NULL)
    {
        $usernameColumn  = $this->getConfig['matching']['columns']['username'];
        $passwordColumn  = $this->getConfig['matching']['columns']['password'];

        $sessionUserName = $this->sessionClass->select($usernameColumn) ?: $this->cookieClass->select($usernameColumn);
        $sessionPassword = $this->sessionClass->select($passwordColumn) ?: $this->cookieClass->select($passwordColumn);

        if( ! empty($sessionUserName) )
        {
            $joinTables      = $this->getConfig['joining']['tables'];
            $usernameColumn  = $this->getConfig['matching']['columns']['username'];
            $joinColumn      = $this->getConfig['joining']['column'];
            $tableName       = $this->getConfig['matching']['table'];

            $this->_multiUsernameColumns($sessionUserName);

            $r[$tbl] = $this->dbClass->where($usernameColumn, $sessionUserName, 'and')
                         ->where($passwordColumn, $sessionPassword)
                         ->get($tableName)
                         ->row();

            if( ! empty($joinTables) )
            {
                $this->_multiUsernameColumns($sessionUserName);

                $joinCol = $this->dbClass->where($usernameColumn, $sessionUserName, 'and')
                             ->where($passwordColumn, $sessionPassword)
                             ->get($tableName)
                             ->row()
                             ->$joinColumn;

                foreach( $joinTables as $table => $joinColumn )
                {
                    $r[$table] = $this->dbClass->where($joinColumn, $joinCol)
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

    /**
     * Active Count
     * 
     * @param string $type = 'active'
     * 
     * @return int
     */
    public function activeCount($type = 'active') : Int
    {
        $column    = $this->getConfig['matching']['columns'][$type];
        $tableName = $this->getConfig['matching']['table'];

        return $this->dbClass->where($column, 1)->get($tableName)->totalRows();
    }

    /**
     * Banned Count
     * 
     * @param void
     * 
     * @return int
     */
    public function bannedCount() : Int
    {
        return $this->activeCount('banned');
    }

    /**
     * Count
     * 
     * @param void
     * 
     * @return int
     */
    public function count() : Int
    {
        $tableName = $this->getConfig['matching']['table'];

        return $this->dbClass->get($tableName)->totalRows();
    }
}
