<?php namespace ZN\Database;

class InternalDBForge extends Connection implements InternalDBForgeInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

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
    public function extras($extras) : InternalDBForge
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
    // Alter Table
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $table
    // @param mixed $condition
    //
    //--------------------------------------------------------------------------------------------------------
    public function alterTable(String $table = NULL, Array $condition = NULL)
    {
        $table = $this->_p($table);

        if( key($condition) === 'renameTable' )
        {
            return $this->renameTable($table, $condition['renameTable']);
        }
        elseif( key($condition) === 'addColumn' )
        {
            return $this->addColumn($table, $condition['addColumn']);
        }
        elseif( key($condition) === 'dropColumn' )
        {
            return $this->dropColumn($table, $condition['dropColumn']);
        }
        elseif( key($condition) === 'modifyColumn' )
        {
            return $this->modifyColumn($table, $condition['modifyColumn']);
        }
        elseif( key($condition) === 'renameColumn' )
        {
            return $this->renameColumn($table, $condition['renameColumn']);
        }
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

            return true;
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
