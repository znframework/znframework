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

class DBTrigger extends Connection
{
    /**
     * Database Trigger Driver
     * 
     * @var object
     */
    protected $trigger;

    /**
     * Magic Constructor
     * 
     * @param array $settings
     */
    public function __construct($settings = [])
    {
        parent::__construct($settings);

        $this->trigger = $this->_drvlib('Trigger', $settings);
    }

    /**
     * User 
     * 
     * @param string $user = 'CURRENT_USER'
     * 
     * @return DBTrigger
     */
    public function user(String $user) : DBTrigger
    {
        $this->trigger->user($user);

        return $this;
    }

    /**
     * When
     * 
     * @param string $type - option[BEFORE|AFTER]
     * 
     * @return DBTrigger
     */
    public function when(String $type) : DBTrigger
    {
        $this->trigger->when($type);

        return $this;
    }

    /**
     * Event
     * 
     * @param string $type - [INSERT|UPDATE|DELETE]
     * 
     * @return DBTrigger
     */
    public function event(String $type) : DBTrigger
    {
        $this->trigger->event($type);

        return $this;
    }

    /**
     * Order
     * 
     * @param string $type - option[FOLLOWS|PRECEDES]
     * @param string $name
     * 
     * @return DBTrigger
     */
    public function order(String $type, String $name) : DBTrigger
    {
        $this->trigger->order($type, $name);

        return $this;
    }

    /**
     * Body
     * 
     * @param string ...$args 
     * 
     * BEGIN $arg1; $arg2; .... $arg3; END;
     * 
     * @return DBTrigger
     */
    public function body(...$args) : DBTrigger
    {
        $this->trigger->body(...$args);

        return $this;
    }

    /**
     * Create Trigger
     * 
     * @param string $name
     * 
     * @return bool
     */
    public function createTrigger(String $name)
    {
        $query = $this->trigger->createTrigger($name);

        return $this->_runQuery($query);
    }

    /**
     * Create Trigger
     * 
     * @param string $name
     * 
     * @return bool
     */
    public function create(String $name)
    {
        return $this->createTrigger($name);
    }

    /**
     * Drop Trigger
     * 
     * @param string $name
     * 
     * @return bool
     */
    public function dropTrigger(String $name)
    {
        $query = $this->trigger->dropTrigger($name);

        return $this->_runQuery($query);
    }

    /**
     * Drop Trigger
     * 
     * @param string $name
     * 
     * @return bool
     */
    public function drop(String $name)
    {
        return $this->dropTrigger($name);
    }

    /**
     * Trigger List
     * 
     * @param string $name = NULL
     * 
     * @return array
     */
    public function list(String $name = NULL)
    {
        $query = $this->trigger->list($name);

        $this->_runQuery($query);

        if( $name === NULL )
        {
            return $this->db->result();
        }
        else
        {
            return $this->db->row();
        }
    }

    /**
     * Trigger Exists
     * 
     * @param string $name
     * 
     * @return bool
     */
    public function exists(String $name)
    {
        $query = $this->trigger->exists($name);

        $this->_runQuery($query);

        return (bool) $this->db->numRows();
    }
}
