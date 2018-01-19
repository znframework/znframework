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

class DriverUser
{
    /**
     * Option Variables
     * 
     * @var string
     */
    protected $name           = NULL;
    protected $host           = NULL;
    protected $identified     = NULL;
    protected $required       = NULL;
    protected $encode         = NULL;
    protected $with           = NULL;
    protected $lock           = NULL;
    protected $resource       = NULL;
    protected $passwordExpire = NULL;
    protected $type           = NULL;
    protected $select         = NULL;
    protected $grantOption    = NULL;

    /**
     * Keeps Resources
     * 
     * @var array
     */
    protected $resources =
    [
        'query'      => 'MAX_QUERIES_PER_HOUR',
        'update'     => 'MAX_UPDATES_PER_HOUR',
        'connection' => 'MAX_CONNECTIONS_PER_HOUR',
        'user'       => 'MAX_USER_CONNECTIONS'
    ];

    /**
     * Keeps Parameters
     * 
     * @var array
     */
    protected $parameters = [];

    /**
     * Sets name
     * 
     * @param string $name
     */
    public function name($name)
    {
        $this->name = $this->_stringQuote($name);
    }

    /**
     * Sets host
     * 
     * @param string $host
     */
    public function host($host)
    {
        $this->host = '@'.$this->_stringQuote($host);
    }

    /**
     * Sets Auth Password
     * 
     * @param string $authString
     */
    public function password($authString)
    {
        $this->identifiedBy($authString);
    }

    /**
     * Sets Identified By
     * 
     * @param string $authString
     */
    public function identifiedBy($authString)
    {
        $this->identified = ' IDENTIFIED BY '.$this->_stringQuote($authString);
    }

    /**
     * Sets Identified By Passowrd
     * 
     * @param string $hashString
     */
    public function identifiedByPassword($hashString)
    {
        $this->identified = ' IDENTIFIED BY PASSWORD '.$this->_stringQuote($hashString);
    }

    /**
     * Protected Identified With Type
     * 
     * @param string $authPlugin
     * @param string $authString
     * @param string $type = 'BY'
     */
    protected function _identifiedWithType($authPlugin, $authString, $type = 'BY')
    {
        $this->identified = ' IDENTIFIED WITH '.$authPlugin.' '.$this->_stringQuote($authString);
    }

    /**
     * Identified With
     * 
     * @param string $authPlugin
     * @param string $type
     * @param string $authString 
     */
    public function identifiedWith($authPlugin, $type, $authString)
    {
        $this->_identifiedWithType($authPlugin, $authString, $type);
    }

    /**
     * Identified With By
     * 
     * @param string $authPlugin
     * @param string $authString 
     */
    public function identifiedWithBy($authPlugin, $authString)
    {
        $this->_identifiedWithType($authPlugin, $authString, 'BY');
    }

    /**
     * Identified With As
     * 
     * @param string $hashPlugin
     * @param string $hashString 
     */
    public function identifiedWithAs($hashPlugin, $hashString)
    {
        $this->_identifiedWithType($hashPlugin, $hashString, 'AS');
    }

    /**
     * Required
     */
    public function required()
    {
        $this->required = ' REQUIRE ';
    }

    /**
     * With
     */
    public function with()
    {
        $this->with = ' WITH ';
    }

    /**
     * Option
     * 
     * @param string $option
     * @param string $value
     */
    public function option($option, $value)
    {
        return false;
    }

    /**
     * Encode
     * 
     * @param string $type      - options[SSL|X509|CIPHER value|ISSUER value|SUBJECT value]
     * @param string $string    
     * @param string $condition - [and|or]
     */
    public function encode($type, $string, $condition)
    {
        $this->encode = ' '.$type.' '.$this->_stringQuote($string).' '.$condition.' ';
    }

    /**
     * Resource
     * 
     * @param string $resource - option[query|update|connection|user]
     * @param string $count    
     */
    public function resource($resource, $count)
    {
        if( isset($this->resources[$resource]) )
        {
            $resource  = $this->resources[$resource];
        }

        $this->resource = ' '.$resource.' '.$count.' ';
    }

    /**
     * Password Expire
     * 
     * @param string $type - option[empty|DEFAULT|NEVER|INTERVAL]
     * @param int    $n
     */
    public function passwordExpire($type, $n)
    {
        if( strtolower($type) === 'interval' )
        {
            $type = 'INTERVAL '.$n.' DAY ';
        }

        $this->passwordExpire = ' PASSWORD EXPIRE '.$type.' ';
    }

    /**
     * Lock
     * 
     * @param string $type - [lock|unlock]
     */
    public function lock($type)
    {
        $this->lock = $this->_lock($type);
    }

    /**
     * Unlock
     * 
     * @param string $type - [lock|unlock]
     */
    public function unlock($type)
    {
        $this->lock = $this->_lock($type);
    }

    /**
     * Type
     * 
     * @param string $type - [TABLE|FUNCTION|PROCEDURE]
     */
    public function type($type)
    {
        $this->type = $type;
    }

    /**
     * Select
     * 
     * @param string $select = *.*
     */
    public function select($select)
    {
        $this->select = $select;
    }

    /**
     * Grant Option
     */
    public function grantOption()
    {
        $this->grantOption = ' GRANT OPTION ';
    }

    /**
     * Alter 
     * 
     * @param string $name
     */
    public function alter($name)
    {
        return $this->_process($name, 'ALTER USER');
    }

    /**
     * Create 
     * 
     * @param string $name
     */
    public function create($name)
    {
        return $this->_process($name, 'CREATE USER');
    }

    /**
     * Drop 
     * 
     * @param string $name
     */
    public function drop($name)
    {
        return $this->_process($name, 'DROP USER');
    }

    /**
     * Grant
     * 
     * @param string $name 
     * @param string $type
     * @param string $select
     */
    public function grant($name, $type, $select)
    {
        return $this->_process($name, 'GRANT', $type, $select);
    }

    /**
     * Revoke
     * 
     * @param string $name 
     * @param string $type
     * @param string $select
     */
    public function revoke($name, $type, $select)
    {
        return $this->_process($name, 'REVOKE', $type, $select);
    }

    /**
     * Rename
     * 
     * @param string $oldName
     * @param string $newName
     */
    public function rename($oldName, $newName)
    {
        $query = ' RENAME USER '.$this->_stringQuote($oldName).' TO '.$this->_stringQuote($newName);

        return $query;
    }

    /**
     * Set Password
     * 
     * @param string $user
     * @param string $pass
     */
    public function setPassword($user, $pass)
    {
        if( empty($this->name) )
        {
            $this->name($user);
        }

        if( ! empty($this->name) )
        {
            $this->name = 'FOR '.$this->name;
        }

        if( $pass === 'old:')
        {
            $pass = 'OLD_PASSWORD(\''.$pass.'\')';
        }
        elseif( $pass === 'new:' )
        {
            $pass = 'PASSWORD(\''.$pass.'\')';
        }
        else
        {
            $pass = $this->_stringQuote($pass);
        }

        $query = ' SET PASSWORD '.$this->name.' = '.$pass;

        $this->_resetQuery();

        return $query;
    }

    /**
     * Protected String Quote
     */
    protected function _stringQuote($string)
    {
        if( ! empty($string) )
        {
            if( ! preg_match('/^\w+\(.*?\)/xi', $string) )
            {
                $string = str_replace('@', '\'@\'', $string);

                return ' \''.$string.'\' ';
            }

            return ' '.$string.' ';
        }

        return false;
    }

    /**
     * Protected Lock
     */
    protected function _lock($type)
    {
        $this->lock = ' ACCOUNT '.$type.' ';
    }

    /**
     * Protected Process
     */
    protected function _process($name = NULL, $type = NULL, $grantType = NULL, $grantSelect = NULL)
    {
        $grant = '';

        if( $type === 'GRANT' || $type === 'REVOKE' )
        {
            if( ! empty($this->type) )
            {
                $grantType = $this->type;
            }

            if( ! empty($this->select) )
            {
                $grantSelect = $this->select;
            }

            $toFrom = ( $type === 'REVOKE' ) ? ' FROM ' : ' TO ';

            $grant = ' '.$name.' ON '.$grantType.' '.$grantSelect.$toFrom;

            $name = '';
        }

        if( empty($this->name) )
        {
            $this->name($name);
        }

        $query = $type.' '.
                 $grant.
                 $this->name.
                 $this->host.
                 $this->identified.
                 $this->required.
                 $this->encode.
                 $this->with.
                 $this->grantOption.
                 $this->resource.
                 $this->passwordExpire;
                 $this->lock;

        $this->_resetQuery();

        return $query;
    }

    /**
     * Protected Name
     */
    protected function _name($name)
    {
        if( ! empty($this->name) )
        {
            return $this->name;
        }

        return $name;
    }

    /**
     * Reset Query
     */
    protected function _resetQuery()
    {
        $this->name             = NULL;
        $this->lock             = NULL;
        $this->parameters       = [];
        $this->host             = NULL;
        $this->identified       = NULL;
        $this->required         = NULL;
        $this->encode           = NULL;
        $this->with             = NULL;
        $this->resource         = NULL;
        $this->passwordExpire   = NULL;
        $this->type             = NULL;
        $this->select           = NULL;
        $this->grantOption      = NULL;
    }
}
