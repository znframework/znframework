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

use ZN\Lang;
use ZN\Config;
use ZN\Singleton;

class UserExtends
{
    /**
     * Get user config
     * 
     * @var array
     */
    protected $getConfig;

    /**
     * Magic constructor
     * 
     * @param void
     * 
     * @return void
     */
    public function __construct()
    {
        $this->getConfig    = Config::default(new AuthenticationDefaultConfiguration)::get('Authentication');
        $this->getLang      = Lang::default(new AuthenticationDefaultLanguage)::select('Authentication');
        $this->dbClass      = Singleton::class('ZN\Database\DB');
        $this->sessionClass = Singleton::class('ZN\Storage\Session');
        $this->cookieClass  = Singleton::class('ZN\Storage\Cookie');
    }

    /**
     * Set column 
     * 
     * @param string $column
     * @param mixed  $value
     * 
     * @return UserExtends
     */
    public function column(String $column, $value) : UserExtends
    {
        Properties::$parameters['column'][$column] = $value;

        return $this;
    }

    /**
     * Return link
     * 
     * @param string $returnLink
     * 
     * @return UserExtends
     */
    public function returnLink(String $returnLink) : UserExtends
    {
        Properties::$parameters['returnLink'] = $returnLink;

        return $this;
    }

    /**
     * protected multi username columns
     * 
     * @param string $value
     * 
     * @return void
     */
    protected function _multiUsernameColumns($value)
    {
        $usernameColumns = $this->getConfig['matching']['columns']['otherLogin'];

        if( ! empty($usernameColumns) )
        {
            foreach( $usernameColumns as $column )
            {
                $this->dbClass->where($column, $value, 'or');
            }
        }
    }
}
