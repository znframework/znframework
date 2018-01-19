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

class DBUser extends Connection
{
    /**
     * Database User Driver
     */
    protected $user;

    /**
     * Magic Constructor
     * 
     * @param array $settings
     */
    public function __construct($settings = [])
    {
        parent::__construct($settings);

        $this->user = $this->_drvlib('User', $settings);
    }

    /**
     * Sets name
     * 
     * @param string $name
     * 
     * @return DBUser
     */
    public function name(String $name) : DBUser
    {
        $this->user->name($name);

        return $this;
    }

    /**
     * Sets host
     * 
     * @param string $host
     * 
     * @return DBUser
     */
    public function host(String $host) : DBUser
    {
        $this->user->host($host);

        return $this;
    }

    /**
     * Sets Auth Password
     * 
     * @param string $authString
     * 
     * @return DBUser
     */
    public function password(String $authString) : DBUser
    {
        $this->user->password($authString);

        return $this;
    }

    /**
     * Sets Identified By
     * 
     * @param string $authString
     * 
     * @return DBUser
     */
    public function identifiedBy(String $authString) : DBUser
    {
        $this->user->identifiedBy($authString);

        return $this;
    }

    /**
     * Sets Identified By Passowrd
     * 
     * @param string $hashString
     * 
     * @return DBUser
     */
    public function identifiedByPassword(String $hashString) : DBUser
    {
        $this->user->identifiedByPassword($hashString);

        return $this;
    }

     /**
     * Identified With
     * 
     * @param string $authPlugin
     * @param string $type
     * @param string $authString 
     * 
     * @return DBUser
     */
    public function identifiedWith(String $authPlugin, String $type, String $authString) : DBUser
    {
        $this->user->identifiedWith($authPlugin, $type, $authString);

        return $this;
    }

    /**
     * Identified With By
     * 
     * @param string $authPlugin
     * @param string $authString 
     * 
     * @return DBUser
     */
    public function identifiedWithBy(String $authPlugin, String $authString) : DBUser
    {
        $this->user->identifiedWithBy($authPlugin, $authString);

        return $this;
    }

    /**
     * Identified With As
     * 
     * @param string $hashPlugin
     * @param string $hashString 
     *
     * @return DBUser
     */
    public function identifiedWithAs(String $hashPlugin, String $hashString) : DBUser
    {
        $this->user->identifiedWithAs($hashPlugin, $hashString);

        return $this;
    }

    /**
     * Required
     * 
     * @return DBUser
     */
    public function required() : DBUser
    {
        $this->user->required();

        return $this;
    }

    /**
     * With
     * 
     * @return DBUser
     */
    public function with() : DBUser
    {
        $this->user->with();

        return $this;
    }

    /**
     * Option
     * 
     * @param string $option
     * @param string $value
     * 
     * @return DBUser
     */
    public function option(String $name, String $value) : DBUser
    {
        $this->user->option($name, $value);

        return $this;
    }

    /**
     * Encode
     * 
     * @param string $type      - options[SSL|X509|CIPHER value|ISSUER value|SUBJECT value]
     * @param string $string    
     * @param string $condition - [and|or]
     * 
     * @return DBUser
     */
    public function encode(String $type, String $string, String $condition = NULL) : DBUser
    {
        $this->user->encode($type, $string, $condition);

        return $this;
    }

    /**
     * Resource
     * 
     * @param string $resource - option[query|update|connection|user]
     * @param string $count    
     * 
     * @return DBUser
     */
    public function resource(String $resource, $count = 0) : DBUser
    {
        $this->user->resource($resource, $count);

        return $this;
    }

    /**
     * Password Expire
     * 
     * @param string $type - option[empty|DEFAULT|NEVER|INTERVAL]
     * @param int    $n
     * 
     * @return DBUser
     */
    public function passwordExpire(String $type = NULL, $n = 0) : DBUser
    {
        $this->user->passwordExpire($type, $n);

        return $this;
    }

    /**
     * Lock
     * 
     * @param string $type - [lock|unlock]
     * 
     * @return DBUser
     */
    public function lock(String $type = 'lock') : DBUser
    {
        $this->user->lock($type);

        return $this;
    }

    /**
     * Unlock
     * 
     * @param string $type - [lock|unlock]
     * 
     * @return DBUser
     */
    public function unlock(String $type = 'unlock') : DBUser
    {
        $this->user->unlock($type);

        return $this;
    }

     /**
     * Type
     * 
     * @param string $type - [TABLE|FUNCTION|PROCEDURE]
     * 
     * @return DBUser
     */
    public function type(String $type = 'TABLE') : DBUser
    {
        $this->user->type($type);

        return $this;
    }

    /**
     * Select
     * 
     * @param string $select = *.*
     * 
     * @return DBUser
     */
    public function select(String $select = '*.*') : DBUser
    {
        $this->user->select($select);

        return $this;
    }

    /**
     * Grant Option
     * 
     * @return DBUser
     */
    public function grantOption() : DBUser
    {
        $this->user->grantOption();

        return $this;
    }

    /**
     * Alter 
     * 
     * @param string $name
     * 
     * @return bool
     */
    public function alter(String $name = NULL)
    {
        $query = $this->user->alter($name ?? 'USER()');

        return $this->_runQuery($query);
    }

    /**
     * Create 
     * 
     * @param string $name
     * 
     * @return bool
     */
    public function create(String $name = NULL)
    {
        $query = $this->user->create($name ?? 'USER()');

        return $this->_runQuery($query);
    }

    /**
     * Drop 
     * 
     * @param string $name
     * 
     * @return bool
     */
    public function drop(String $name = NULL)
    {
        $query = $this->user->drop($name ?? 'USER()');

        return $this->_runQuery($query);
    }

    /**
     * Grant
     * 
     * @param string $name 
     * @param string $type
     * @param string $select
     * 
     * @return bool
     */
    public function grant(String $name = 'ALL', String $type = NULL, String $select = '*.*')
    {
        $query = $this->user->grant($name, $type, $select);

        return $this->_runQuery($query);
    }

    /**
     * Revoke
     * 
     * @param string $name 
     * @param string $type
     * @param string $select
     * 
     * @return bool
     */
    public function revoke(String $name = 'ALL', String $type = NULL, String $select = '*.*')
    {
        $query = $this->user->revoke($name, $type, $select);

        return $this->_runQuery($query);
    }

    /**
     * Rename
     * 
     * @param string $oldName
     * @param string $newName
     * 
     * @return bool
     */
    public function rename(String $oldName, String $newName)
    {
        $query = $this->user->rename($oldName, $newName);

        return $this->_runQuery($query);
    }

    /**
     * Set Password
     * 
     * @param string $user
     * @param string $pass
     * 
     * @return bool
     */
    public function setPassword(String $user = NULL, String $pass = NULL)
    {
        $query = $this->user->setPassword($user, $pass);

        return $this->_runQuery($query);
    }
}
