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

use ZN\Hypertext\Exception\InvalidArgumentException;
use ZN\DataTypes\Arrays;
use ZN\Singleton;
use ZN\Base;

class Form
{
    use ViewCommonTrait;

    /**
     * Keeps form input objects.
     * 
     * @var array
     */
    protected $elements =
    [
        'input' =>
        [
            'button', 'reset' , 'submit'  , 'radio', 'checkbox',
            'date'  , 'time'  , 'datetime', 'week' , 'month'   ,
            'text'  , 'search', 'password', 'email', 'tel'     ,
            'number', 'url'   , 'range'   , 'image', 'color'
        ]
    ];

    /**
     * Keeps validation rules.
     * 
     * @var array
     */
    protected $validate = [];

    /**
     * Keeps method type.
     * 
     * @var string
     */
    protected $method;

    /**
     * Open form tag.
     * 
     * @param string $name        = NULL
     * @param array  $_attributes = []
     * 
     * Available Enctype Options
     * 
     * 1. multipart   => multipart/form-data
     * 2. application => application/x-www-form-urlencoded
     * 3. text        => text/plain
     * 
     * @return string
     */
    public function open(String $name = NULL, Array $_attributes = []) : String
    {
        $name = $this->settings['attr']['name'] ?? $name;
  
        $_attributes['name'] = $name;

        if( isset($_attributes['enctype']) )
        {
            $enctype = $_attributes['enctype'];

            if( isset($this->enctypes[$enctype]) )
            {
                $_attributes['enctype'] = $this->enctypes[$enctype];
            }
        }
       
        if( isset($this->settings['where']) )
        {
            $this->settings['getrow'] = Singleton::class('ZN\Database\DB')->get($name)->row();
        }
        
        if( $query = ($this->settings['query'] ?? NULL) )
        {
            $this->settings['getrow'] = Singleton::class('ZN\Database\DB')->query($query)->row();
        }
        
        $this->method = ($_attributes['method'] = $_attributes['method'] ?? $this->settings['attr']['method'] ?? 'post');
        
        $return  = '<form'.$this->attributes($_attributes).'>'.EOL;

        # 5.4.2[added]
        $return .= $this->_process($name, $this->method);

        if( isset($this->settings['token']) )
        {
            $return .= CSRFInput();
        }

        $this->_unsetopen();

        return $return;
    }

    /**
     * Validate error message.
     * 
     * @param void
     * 
     * @return string
     */
    public function validateErrorMessage()
    {
        return Singleton::class('ZN\Validation\Data')->error('string');
    }

    /**
     * Validate error array.
     * 
     * @param void
     * 
     * @return array
     */
    public function validateErrorArray()
    {
        return Singleton::class('ZN\Validation\Data')->error('array');
    }

    /**
     * Closes form object.
     * 
     * @param void
     * 
     * @return string
     */
    public function close() : String
    {
        unset($this->settings['getrow']);

        return '</form>'.EOL;
    }

    /**
     * datetime-local form object.
     * 
     * @param string $name        = NULL
     * @param string $value       = NULL
     * @param array  $_attributes = []
     * 
     * @return string
     */
    public function datetimeLocal(String $name = NULL, String $value = NULL, Array $_attributes = []) : String
    {
        return $this->_input($name, $value, $_attributes, 'datetime-local');
    }

    /**
     * textarea form object.
     * 
     * @param string $name        = NULL
     * @param string $value       = NULL
     * @param array  $_attributes = []
     * 
     * @return string
     */
    public function textarea(String $name = NULL, String $value = NULL, Array $_attributes = []) : String
    {
        if( ! isset($this->settings['attr']['name']) && ! empty($name) )
        {
            $this->settings['attr']['name'] = $name;
        }

        $value = $this->settings['attr']['value'] ?? $value;

        if( ! empty($this->settings['attr']['name']) )
        {
            $this->_postback($this->settings['attr']['name'], $value);

            // 5.4.2[added]
            $this->_validate($this->settings['attr']['name'], $this->settings['attr']['name']);
            
            // 5.4.2[added]|5.4.5|5.4.6[edited]
            $value = $this->_getrow('textarea', $value, $this->settings['attr']);
        }

        $perm   = $this->settings['attr']['perm'] ?? NULL;

        $return = '<textarea'.$this->attributes($_attributes).'>'.$value.'</textarea>'.EOL;

        return $this->_perm($perm, $return);
    }

    /**
     * select form object.
     * 
     * @param string $name        = NULL
     * @param string $optios      = []
     * @param mixed  $selected    = NULL
     * @param array  $_attributes = []
     * @param bool   $multiple    = false
     * 
     * @return string
     */
    public function select(String $name = NULL, Array $options = [], $selected = NULL, Array $_attributes = [], Bool $multiple = false) : String
    {
        if( ! empty($this->settings['table']) || ! empty($this->settings['query']) )
        {
            $key     = key($options);
            $current = current($options);
            
            array_shift($options);

            $dbClass = Singleton::class('ZN\Database\DB');

            if( ! empty($this->settings['table']) )
            {
                $table = $this->settings['table'];

                if( strstr($table, ':') )
                {
                    $tableEx = explode(':', $tableEx);
                    $table   = $tableEx[1];
                    $db      = $tableEx[0];

                    $db     = $dbClass->differentConnection($db);
                    $result = $db->select($current, $key)->get($table)->result();
                }
                else
                {
                    $result = $dbClass->select($current, $key)->get($table)->result();
                }
            }
            else
            {
                $result = $dbClass->query($this->settings['query'])->result();
            }

            foreach( $result as $row )
            {
                $options[$row->$key] = $row->$current;
            }
        }

        $options = $this->settings['option'] ?? $options;

        if( isset($this->settings['exclude']) )
        {
            $options = Arrays\Excluding::use($options, $this->settings['exclude']);
        }

        if( isset($this->settings['include']) )
        {
            $options = Arrays\Including::use($options, $this->settings['include']);
        }

        if( isset($this->settings['order']['type']) )
        {
            $options = Arrays\Sort::order($options, $this->settings['order']['type'], $this->settings['order']['flags']);
        }

        $selected = $this->settings['selectedKey'] ?? $selected;

        if( isset($this->settings['selectedValue']) )
        {
            $flip     = array_flip($options);
            $selected = $flip[$this->settings['selectedValue']];
        }

        if( $multiple === true )
        {
            $_attributes['multiple'] ="multiple";
        }

        if( $name !== '' )
        {
            $_attributes['name'] = $name;
        }

        if( ! empty($_attributes['name']) )
        {
            $this->_postback($_attributes['name'], $selected);

            # 5.4.2[added]
            $this->_validate($_attributes['name'], $_attributes['name']);
            
            # 5.4.2[added]|5.4.5|5.4.6[edited]
            $selected = $this->_getrow('select', $selected, $_attributes);
        }

        $perm      = $this->settings['attr']['perm'] ?? NULL;

        $selectbox = '<select'.$this->attributes($_attributes).'>';

        if( is_array($options) ) foreach( $options as $key => $value )
        {
            if( is_array($selected) )
            {
                if( in_array($key, $selected) )
                {
                    $select = ' selected="selected"';
                }
                else
                {
                    $select = "";
                }
            }
            else
            {
                if( $selected == $key )
                {
                    $select = ' selected="selected"';
                }
                else
                {
                    $select = "";
                }
            }

            $selectbox .= '<option value="'.$key.'"'.$select.'>'.$value.'</option>'.EOL;
        }

        $selectbox .= '</select>'.EOL;

        $this->_unsetselect();

        return $this->_perm($perm, $selectbox);
    }

    /**
     * select type multiselect form object.
     * 
     * @param string $name        = NULL
     * @param string $optios      = []
     * @param mixed  $selected    = NULL
     * @param array  $_attributes = []
     * 
     * @return string
     */
    public function multiselect(String $name = NULL, Array $options = [], $selected = NULL, Array $_attributes = []) : String
    {
        return $this->select($name, $options, $selected, $_attributes, true);
    }

    /**
     * hidden form object.
     * 
     * @param string $name        = NULL
     * @param string $value       = NULL
     * 
     * @return string
     */
    public function hidden(String $name = NULL, String $value = NULL) : String
    {
        $name  = $this->settings['attr']['name' ] ?? $name ;
        $value = $this->settings['attr']['value'] ?? $value;

        $this->settings['attr'] = [];

        $hiddens = NULL;
        $value   = ! empty($value) ? 'value="'.$value.'"' : '';

        if( is_array($name) ) foreach( $name as $key => $val )
        {
            $hiddens .= '<input type="hidden" name="'.$key.'" id="'.$key.'" value="'.$val.'">'.EOL;
        }
        else
        {
            $hiddens =  '<input type="hidden" name="'.$name.'" id="'.$name.'" '.$value.'>'.EOL;
        }

        return $hiddens;
    }

    /**
     * file form object.
     * 
     * @param string $name        = NULL
     * @param string $value       = NULL
     * @param array  $_attributes = []
     * 
     * @return string
     */
    public function file(String $name = NULL, Bool $multiple = false, Array $_attributes = []) : String
    {
        if( ! empty($this->settings['attr']['multiple']) )
        {
            $multiple = true;
        }

        $name = $this->settings['attr']['name'] ?? $name;

        if( $multiple === true )
        {
            $this->settings['attr']['multiple'] = 'multiple';
            $name = Base::suffix($name, '[]');
        }

        return $this->_input($name, '', $_attributes, 'file');
    }

    /**
     * protected process
     * 
     * @param string $name
     * @param string $method
     * 
     * @return mixed
     */
    protected function _process($name, $method)
    {
        if( $process = ($this->settings['process'] ?? NULL) )
        {
            if( $method::FormProcessValue() )
            {
                if( Singleton::class('ZN\Validation\Data')->check() )
                {
                    $dbClass = Singleton::class('ZN\Database\DB');

                    if( $process === 'update' )
                    {
                        $dbClass->where
                        (
                            $whereColumn = $this->settings['whereColumn'], 
                            $whereValue  = $this->settings['whereValue']
                        )
                        ->update(strtolower($method).':'.$name);       

                        $this->settings['getrow'] = $dbClass->where($whereColumn, $whereValue)->get($name)->row();
                    }
                    elseif( $process === 'insert' )
                    {
                        $dbClass->insert(strtolower($method).':'.$name); 
                    }
                    else
                    {
                        throw new InvalidArgumentException('[Form::process()] method can take one of the values [update or insert].');
                    }
                }
            }

            return $this->hidden('FormProcessValue', 'FormProcessValue');
        }
    }

    /**
     * protected unset select variables
     * 
     * @param void
     * 
     * @return void
     */
    protected function _unsetselect()
    {
        unset($this->settings['table']);
        unset($this->settings['query']);
        unset($this->settings['option']);
        unset($this->settings['exclude']);
        unset($this->settings['include']);
        unset($this->settings['order']);
        unset($this->settings['selectedKey']);
        unset($this->settings['selectedValue']);
    }

    /**
     * protected unset open variables
     * 
     * @param void
     * 
     * @return void
     */
    protected function _unsetopen()
    {
        unset($this->settings['where']);
        unset($this->settings['whereValue']);
        unset($this->settings['whereColumn']);
        unset($this->settings['query']);
        unset($this->settings['token']);
        unset($this->settings['process']);
    }
}
