<?php namespace ZN\Database;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\IndividualStructures\Support;
use ZN\DataTypes\Strings;

class DBForge extends Connection
{
    //--------------------------------------------------------------------------------------------------------
    // Extras
    //--------------------------------------------------------------------------------------------------------
    //
    // @var mixed
    //
    //--------------------------------------------------------------------------------------------------------
    protected $extras;

    //--------------------------------------------------------------------------------------------------------
    // Forge
    //--------------------------------------------------------------------------------------------------------
    //
    // @var object
    //
    //--------------------------------------------------------------------------------------------------------
    protected $forge;

    //--------------------------------------------------------------------------------------------------------
    // Magic Call
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $method
    // @param array  $parameters
    //
    //--------------------------------------------------------------------------------------------------------
    public function __call($method, $parameters)
    {
        $split  = Strings\Split::upperCase($originMethodName = $method);
        $table  = $split[0];
        $method = $split[1] ?? NULL;

        switch($method)
        {
            case 'Create'  : $method = 'createTable';
            case 'Drop'    : $method = 'dropTable'  ;
            case 'Alter'   : $method = 'alterTable' ;
            case 'Rename'  : $method = 'renameTable';
            case 'Truncate': $method = 'truncate'   ;
            default        : Support::classMethod(get_called_class(), $originMethodName);
        }

        return $this->$method($table, ...$parameters);
    }

    //--------------------------------------------------------------------------------------------------------
    // Construct
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct($settings = [])
    {
        parent::__construct($settings);

        $this->forge = $this->_drvlib('Forge', $settings);
    }

    //--------------------------------------------------------------------------------------------------------
    // Extras
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $extras
    //
    //--------------------------------------------------------------------------------------------------------
    public function extras($extras) : DBForge
    {
        $this->extras = $extras;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Create Database
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $dbname
    // @param mixed  $extras
    //
    //--------------------------------------------------------------------------------------------------------
    public function createDatabase(String $dbname, $extras = NULL)
    {
        $query = $this->forge->createDatabase($dbname, $this->_p($extras, 'extras'));

        return $this->_runExecQuery($query);
    }

    //--------------------------------------------------------------------------------------------------------
    // Drop Database
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $dbname
    //
    //--------------------------------------------------------------------------------------------------------
    public function dropDatabase(String $dbname)
    {
        $query = $this->forge->dropDatabase($dbname);

        return $this->_runExecQuery($query);
    }

    //--------------------------------------------------------------------------------------------------------
    // Create Table
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $table
    // @param mixed $colums
    // @param mixed $extras
    //
    //--------------------------------------------------------------------------------------------------------
    public function createTable(String $table = NULL, Array $colums = NULL, $extras = NULL)
    {
        $query = $this->forge->createTable($this->_p($table), $this->_p($colums, 'column'), $extras);

        return $this->_runExecQuery($query);
    }

    //--------------------------------------------------------------------------------------------------------
    // Drop Table
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $table
    //
    //--------------------------------------------------------------------------------------------------------
    public function dropTable(String $table = NULL)
    {
        $query = $this->forge->dropTable($this->_p($table));

        return $this->_runExecQuery($query);
    }

    //--------------------------------------------------------------------------------------------------------
    // Alter Table -> 5.3.35[edited]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $table
    // @param mixed $condition
    //
    //--------------------------------------------------------------------------------------------------------
    public function alterTable(String $table = NULL, Array $condition = NULL)
    {
        $table = $this->_p($table);
        $key   = key($condition);

        return $this->$key($table, $condition[$key]);
    }

    //--------------------------------------------------------------------------------------------------------
    // Rename Table
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $newName
    //
    //--------------------------------------------------------------------------------------------------------
    public function renameTable(String $name, String $newName)
    {
        $query = $this->forge->renameTable($this->_p($name, 'prefix'), $this->_p($newName, 'prefix'));

        return $this->_runExecQuery($query);
    }

    //--------------------------------------------------------------------------------------------------------
    // Truncate
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    //
    //--------------------------------------------------------------------------------------------------------
    public function truncate(String $table = NULL)
    {
        $query = $this->forge->truncate($this->_p($table));

        return $this->_runExecQuery($query);
    }

    //--------------------------------------------------------------------------------------------------------
    // Add Column
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param array  $condition
    //
    //--------------------------------------------------------------------------------------------------------
    public function addColumn(String $table = NULL, Array $columns = NULL)
    {
        $query = $this->forge->addColumn($this->_p($table), $this->_p($columns, 'column'));

        return $this->_runExecQuery($query);
    }

    //--------------------------------------------------------------------------------------------------------
    // Drop Column
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param mixed  $column
    //
    //--------------------------------------------------------------------------------------------------------
    public function dropColumn(String $table = NULL, $columns = NULL)
    {
        $columns = $this->_p($columns, 'column');

        if( ! is_array($columns) )
        {
            $query = $this->forge->dropColumn($this->_p($table), $columns);

            return $this->_runExecQuery($query);
        }
        else
        {
            foreach( $columns as $key => $col )
            {
                if( ! is_numeric($key) )
                {
                    $col = $key;
                }

                $query = $this->forge->dropColumn($this->_p($table), $col);

                $this->_runExecQuery($query);
            }

            return ! (bool) $this->error();
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Modify Column
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param mixed  $columns
    //
    //--------------------------------------------------------------------------------------------------------
    public function modifyColumn(String $table = NULL, Array $columns = NULL)
    {
        $query = $this->forge->modifyColumn($this->_p($table), $this->_p($columns, 'column'));

        return $this->_runExecQuery($query);
    }

    //--------------------------------------------------------------------------------------------------------
    // Rename Column
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    // @param mixed  $columns
    //
    //--------------------------------------------------------------------------------------------------------
    public function renameColumn(String $table = NULL , Array $columns = NULL)
    {
        $query = $this->forge->renameColumn($this->_p($table), $this->_p($columns, 'column'));

        return $this->_runExecQuery($query);
    }
}
