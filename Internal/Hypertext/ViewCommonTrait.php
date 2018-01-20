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

use ZN\Classes;
use ZN\Datatype;
use ZN\DataTypes\Arrays;
use ZN\Authorization\Permission;
use ZN\Hypertext\Exception\PermissionRoleIdException;

trait ViewCommonTrait
{
    use FormElementsTrait, HtmlElementsTrait;

    /**
     * Keeps settings
     * 
     * @var array
     */
    protected $settings = [];

    /**
     * Keeps use elements
     * 
     * @var array
     */
    protected $useElements =
    [
        'addclass' => 'class'
    ];

    /**
     * Magic Call
     * 
     * @param string $method
     * @param array  $parameters
     * 
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        $realMethod = $method;
        $method     = strtolower($method);
        $className  = Classes::onlyName(__CLASS__);

        if( $className === 'Html')
        {
            $multiElement = $this->elements['multiElement'];

            # Multiple Element
            if( array_key_exists($method, $multiElement) )
            {
                $realMethod = $multiElement[$method];

                return $this->_multiElement($realMethod, ...$parameters);
            }
            elseif( in_array($method, $multiElement) )
            {
                return $this->_multiElement($realMethod, ...$parameters);
            }

            # Single Element
            elseif( in_array($method, $this->elements['singleElement']) )
            {
                return $this->_singleElement($realMethod, ...$parameters);
            }

            # Media Content
            elseif( in_array($method, $this->elements['mediaContent']) )
            {
                return $this->_mediaContent($parameters[0], $parameters[1] ?? NULL, $parameters[2] ?? [], $realMethod);
            }

            # Media
            elseif( in_array($method, $this->elements['media']) )
            {
                return $this->_media($parameters[0], $parameters[1] ?? [], $realMethod);
            }

            # Content Attribute
            elseif( in_array($method, $this->elements['contentAttribute']) )
            {
                return $this->_contentAttribute($parameters[0], $parameters[1] ?? [], $realMethod);
            }

            # Content
            elseif( in_array($method, $this->elements['content']) )
            {
                return $this->_content($parameters[0], $realMethod);
            }
        }
        elseif( $className === 'Form' )
        {
            if( in_array($method, $this->elements['input']) )
            {
                return $this->_input($parameters[0], $parameters[1] ?? NULL, $parameters[2] ?? [], $realMethod);
            }
        }

        if( empty($parameters) )
        {
            $parameters[0] = $method;
        }
        else
        {
            if( $parameters[0] === false )
            {
                return $this;
            }

            if( $parameters[0] === true )
            {
                $parameters[0] = $method;
            }
        }

        if( isset($this->useElements[$method]) )
        {
            $method = $this->useElements[$method];
        }

        # Convert exampleData to example-data [4.6.1]
        if( ! ctype_lower($realMethod) )
        {
            $newMethod = NULL;
            $split     = Datatype::splitUpperCase($realMethod);
            $method    = implode('-', Arrays\Casing::lower($split));
        }

        $this->_element($method, ...$parameters);

        return $this;
    }

    /**
     * Sets attributes
     * 
     * @param array $attributes
     * 
     * @return string
     */
    public function attributes(Array $attributes) : String
    {
        unset($this->settings['attr']['perm']);

        $attribute = '';

        if( ! empty($this->settings['attr']) )
        {
            $attributes = array_merge($attributes, $this->settings['attr']);

            $this->settings['attr'] = [];
        }

        foreach( $attributes as $key => $values )
        {
            if( is_numeric($key) )
            {
                $attribute .= ' '.$values;
            }
            else
            {
                if( ! empty($key) )
                {
                    $attribute .= ' '.$key.'="'.$values.'"';
                }
            }
        }

        return $attribute;
    }

    /**
     * Get input 
     * 
     * @param string $type       = NULL
     * @param string $name       = NULL
     * @param string $value      = NULL
     * @param array  $attributes = []
     * 
     * @return string
     */
    public function input(String $type = NULL, String $name = NULL, String $value = NULL, Array $attributes = []) : String
    {
        if( isset($this->settings['attr']['type']) )
        {
            $type = $this->settings['attr']['type'];

            unset($this->settings['attr']['type']);
        }

        $this->settings['attr'] = [];

        return $this->_input($name, $value, $attributes, $type);
    }

    /**
     * Protected Input
     */
    protected function _input($name = '', $value = '', $attributes = [], $type = '')
    {
        if( $name !== '' )
        {
            $attributes['name'] = $name;
        }

        if( $value !== '' )
        {
            $attributes['value'] = $value;
        }

        if( ! empty($attributes['name']) )
        {
            $this->_postback($attributes['name'], $attributes['value'], $type);

            # 5.4.2[added]
            $this->_validate($attributes['name'], $attributes['name']);

            # 5.4.2[added]
            $this->_getrow($type, $value, $attributes);
        }

        $perm   = $this->settings['attr']['perm'] ?? NULL;
        
        $return = '<input type="'.$type.'"'.$this->attributes($attributes).'>'.EOL;

        return $this->_perm($perm, $return);
    }

    /**
     * Protected Perm [5.4.5]
     */
    protected function _perm($perm, $return)
    {
        if( $perm !== NULL )
        {
            if( Permission\PermissionExtends::$roleId === NULL )
            {
                throw new PermissionRoleIdException();
            }

            return Permission\Process::use($perm, $return);
        }

        return $return;
    }

    /**
     * Protected Element
     */
    protected function _element($function, $element)
    {
        $this->settings['attr'][strtolower($function)] = $element;
    }
}
