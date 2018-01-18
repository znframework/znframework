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

class DriverTrigger
{
    /**
     * Option Variables
     * 
     * @var string
     */
    protected $when = '';
    protected $event = '';
    protected $order = '';
    protected $body = '';
    protected $user = '';

    /**
     * User 
     * 
     * @param string $user = 'CURRENT_USER'
     */
    public function user($user = 'CURRENT_USER')
    {
        $this->user = 'DEFINER = '.$user;
    }

    /**
     * When
     * 
     * @param string $type - option[BEFORE|AFTER]
     */
    public function when($type)
    {
        $this->when = $type;
    }

    /**
     * Event
     * 
     * @param string $type - [INSERT|UPDATE|DELETE]
     */
    public function event($type)
    {
        $this->event = $type;
    }

    /**
     * Order
     * 
     * @param string $type - option[FOLLOWS|PRECEDES]
     * @param string $name
     */
    public function order($type, $name)
    {
        $this->order = $type.' '.$name;
    }

    /**
     * Body
     * 
     * @param string ...$args 
     * 
     * BEGIN $arg1; $arg2; .... $arg3; END;
     */
    public function body(...$args)
    {
        if( is_array($args[0]) )
        {
            $args = $args[0];
        }

        $this->body = 'BEGIN '.implode('; ', $args).';'.' END;';
    }

    /**
     * Create Trigger
     * 
     * @param string $name
     * 
     * @return string
     */
    public function createTrigger($name)
    {
        $query = 'CREATE'.
                 ' '.$this->user.
                 ' TRIGGER '.$name.
                 ' '.$this->when.
                 ' '.$this->event.
                 ' ON'.
                 ' '.Properties::$table.
                 ' FOR EACH ROW'.
                 ' '.$this->order.
                 ' '.$this->body;

        $this->_triggerResetQuery();

        return $query;
    }

    /**
     * Drop Trigger
     * 
     * @param string $name
     * 
     * @return string
     */
    public function dropTrigger($name)
    {
        return 'DROP TRIGGER '.$name;
    }

    /**
     * Trigger List
     * 
     * @param string $name = NULL
     * 
     * @return string
     */
    public function list(String $name = NULL)
    {
        return 'SELECT * FROM information_schema.triggers' . ( $name !== NULL ? ' WHERE TRIGGER_NAME = "'.$name.'"' : NULL );
    }

    /**
     * Trigger Exists
     * 
     * @param string $name
     * 
     * @return array
     */
    public function exists(String $name)
    {
        return $this->list($name);
    }

    /**
     * Protected Trigger Reset Query
     */
    protected function _triggerResetQuery()
    {
        Properties::$table = NULL;
        $this->when        = NULL;
        $this->event       = NULL;
        $this->order       = NULL;
        $this->body        = NULL;
    }
}
