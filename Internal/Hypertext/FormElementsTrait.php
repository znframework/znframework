<?php namespace ZN\Hypertext;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\IS;
use ZN\Request;
use ZN\Singleton;
use ZN\Protection\Json;

trait FormElementsTrait
{
    /**
     * Keeps Enctypes
     * 
     * @var array
     */
    protected $enctypes =
    [
        'multipart'     => 'multipart/form-data',
        'application'   => 'application/x-www-form-urlencoded',
        'text'          => 'text/plain'
    ];

    /**
     * Keeps Postback Data
     * 
     * @var array
     */
    protected $postback = [];

    /**
     * Keeps Validate Rules
     * 
     * @var array
     */
    protected $validate = [];

    /**
     * Defines validate rules.
     * 
     * @param mixed ...$validate
     * 
     * @return self
     */
    public function validate(...$validate)
    {
        $this->validate = $validate;

        return $this;
    }

    /**
     * Sets postback
     * 
     * @param bool   $postback = true
     * @param string $type     = 'post' - options[post|get]
     * 
     * @return self
     */
    public function postBack(Bool $postback = true, String $type = 'post')
    {
        $this->postback['bool'] = $postback;
        $this->postback['type'] = $type;

        return $this;
    }

    /**
     * Controls CSRF
     * 
     * @return self
     */
    public function csrf()
    {
        $this->settings['token'] = true;

        return $this;
    }

    /**
     * Exluding data
     * 
     * @param mixed $exclude
     * 
     * @return self
     */
    public function excluding($exclude)
    {
        if( is_scalar($exclude) )
        {
            $exclude[] = $exclude;
        }

        $this->settings['exclude'] = $exclude;

        return $this;
    }

    /**
     * Including data
     * 
     * @param mixed $include
     * 
     * @return self
     */
    public function including($include)
    {
        if( is_scalar($include) )
        {
            $include[] = $include;
        }

        $this->settings['include'] = $include;

        return $this;
    }

    /**
     * Sets process type.
     * 
     * @param string $type - [insert|update]
     * 
     * @return self
     */
    public function process(String $type)
    {
        $this->settings['process'] = $type;

        return $this;
    }

    /**
     * Database Where Clause
     * 
     * @param mixed  $column
     * @param string $value   = NULL
     * @param string $logical = 'and'
     * 
     * @return self
     */
    public function where($column, String $value = NULL, String $logical = 'and')
    {
        $this->settings['where']       = true;
        $this->settings['whereValue']  = $value;
        $this->settings['whereColumn'] = $column;

        Singleton::class('ZN\Database\DB')->where($column, $value, $logical);

        return $this;
    }

    /**
     * Defines SQL Query
     * 
     * @param string $query
     * 
     * @return self
     */
    public function query(String $query)
    {
        $this->settings['query'] = $query;

        return $this;
    }

    /**
     * Sets table
     * 
     * @param string $table
     * 
     * @return self
     */
    public function table(String $table)
    {
        $this->settings['table'] = $table;

        return $this;
    }

    /**
     * Order 
     * 
     * @param string $type  = 'desc'
     * @param string $flags = 'regular'
     * 
     * @return self
     */
    public function order(String $type = 'desc', String $flags = 'regular')
    {
        $this->settings['order']['type']  = $type;
        $this->settings['order']['flags'] = $flags;

        return $this;
    }

    /**
     * Sets attributes
     * 
     * @param array $attr = []
     * 
     * @return self
     */
    public function attr(Array $attr = [])
    {
        if( isset($this->settings['attr']) && is_array($this->settings['attr']) )
        {
            $settings = $this->settings['attr'];
        }
        else
        {
            $settings = [];
        }

        $this->settings['attr'] = array_merge($settings, $attr);

        return $this;
    }

    /**
     * Sets Form Action
     * 
     * @param string $url = NULL
     * 
     * @return self
     */
    public function action(String $url = NULL)
    {
        $this->settings['attr']['action'] = IS::url($url) ? $url : Request::getSiteURL($url);

        return $this;
    }

    /**
     * Sets Form Enctype
     * 
     * @param string $enctype
     * 
     * @return self
     */
    public function enctype(String $enctype)
    {
        if( isset($this->enctypes[$enctype]) )
        {
            $enctype = $this->enctypes[$enctype];
        }

        $this->_element(__FUNCTION__, $enctype);

        return $this;
    }

    /**
     * Sets select options
     * 
     * @param mixed  $key
     * @param string $value = NULL
     * 
     * @return self
     */
    public function option($key, String $value = NULL)
    {
        if( is_array($key) )
        {
            $this->settings['option'] = $key;
        }
        else
        {
            $this->settings['option'][$key] = $value;
        }

        return $this;
    }

    /**
     * Protected Postback
     */
    protected function _postback($name, &$default, $type = NULL)
    {
        if( isset($this->postback['bool']) && $this->postback['bool'] === true )
        {
            $method = ! empty($this->method) ? $this->method : $this->postback['type'];
    
            $this->postback = [];

            if( $type === 'checkbox' || $type === 'radio' )
            {
                if( $method::$name() === $default )
                {
                    $this->checked();
                }    
            }
            else
            {
                $default = Singleton::class('ZN\Validation\Data')->postBack($name, $method);
            }   
        }
    }

    /**
     * Protected Validate
     */
    protected function _validate($name, $attrName)
    {
        if( ! empty($this->validate) )
        {
            $validate[$name]           = $this->validate;
            $validate[$name]['value']  = $this->settings['attr']['alias'] ?? $attrName;

            $session = Singleton::class('ZN\Storage\Session');

            $session->insert('FormValidationMethod', $this->method);
            $session->insert('FormValidationRules' , array_merge($session->select('FormValidationRules') ?: $validate, $validate));
 
            $this->validate = [];
        }
    } 

    /**
     * Protected Get Row
     */
    protected function _getrow($type, $value, &$attributes)
    {
        if( $row = ($this->settings['getrow'] ?? NULL) )
        {
            $rowval = $row->{$attributes['name']} ?? NULL;

            if( $type === 'textarea' || $type === 'select' )
            {
                return $value ?: $rowval;
            }

            $attributes['value'] = $value ?: $rowval;
            
            // For radio
            if( $type === 'radio' && $value == $rowval )
            {
                $attributes['checked'] = 'checked';
            }

            // For checkbox
            if( $type === 'checkbox' )
            {
                if( Json::check($rowval) )
                {
                    $rowval = json_decode($rowval, true);

                    if( in_array($value, $rowval) )
                    {
                        $attributes['checked'] = 'checked';
                    }
                }
                else
                {
                    $attributes['checked'] = 'checked';
                }
            }
        }

        return $value;
    } 
}
