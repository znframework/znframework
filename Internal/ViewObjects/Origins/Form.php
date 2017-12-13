<?php namespace ZN\ViewObjects;

use ZN\ViewObjects\Exception\InvalidArgumentException;
use ZN\DataTypes\Arrays;

class Form
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

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

    //--------------------------------------------------------------------------------------------------------
    // $settings
    //--------------------------------------------------------------------------------------------------------
    //
    // Ayarları tutmak için
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $validate = [];

    //--------------------------------------------------------------------------------------------------------
    // $method
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $method;

    //--------------------------------------------------------------------------------------------------------
    // Common
    //--------------------------------------------------------------------------------------------------------
    //
    // attributes()
    // _input()
    //
    //--------------------------------------------------------------------------------------------------------
    use ViewCommonTrait;

    //--------------------------------------------------------------------------------------------------------
    // Open
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param array  $attributes
    //
    // Usable 3 Parameter For Enctype
    // 1. multipart     => multipart/form-data
    // 2. application   => application/x-www-form-urlencoded
    // 3. text          => text/plain
    //
    //--------------------------------------------------------------------------------------------------------
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
            $this->settings['getrow'] = \DB::get($name)->row();
        }
        
        if( $query = ($this->settings['query'] ?? NULL) )
        {
            $this->settings['getrow'] = \DB::query($query)->row();
        }
        
        $this->method = ($_attributes['method'] = $_attributes['method'] ?? $this->settings['attr']['method'] ?? 'post');
        
        $return  = '<form'.$this->attributes($_attributes).'>'.EOL;

        // 5.4.2[added]
        $return .= $this->_process($name, $this->method);

        if( isset($this->settings['token']) )
        {
            $return .= CSRFInput();
        }

        $this->_unsetopen();

        return $return;
    }

    //--------------------------------------------------------------------------------------------------------
    // Validate Error Message
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function validateErrorMessage()
    {
        return \Validation::error('string');
    }

    //--------------------------------------------------------------------------------------------------------
    // Validate Error Array
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function validateErrorArray()
    {
        return \Validation::error('array');
    }

    //--------------------------------------------------------------------------------------------------------
    // Open
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function close() : String
    {
        unset($this->settings['getrow']);

        return '</form>'.EOL;
    }

    //--------------------------------------------------------------------------------------------------------
    // Date Time Local
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $value
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function datetimeLocal(String $name = NULL, String $value = NULL, Array $_attributes = []) : String
    {
        return $this->_input($name, $value, $_attributes, 'datetime-local');
    }

    //--------------------------------------------------------------------------------------------------------
    // Textarea
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $value
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------------
    // Select
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param array  $options
    // @param scalar $selected
    // @param array  $attributes
    // @param bool   $multiple
    //
    //--------------------------------------------------------------------------------------------------------
    public function select(String $name = NULL, Array $options = [], $selected = NULL, Array $_attributes = [], Bool $multiple = false) : String
    {
        if( ! empty($this->settings['table']) || ! empty($this->settings['query']) )
        {
            $key     = key($options);
            $current = current($options);
            
            array_shift($options);

            if( ! empty($this->settings['table']) )
            {
                $table = $this->settings['table'];

                if( strstr($table, ':') )
                {
                    $tableEx = explode(':', $tableEx);
                    $table   = $tableEx[1];
                    $db      = $tableEx[0];

                    $db = \DB::differentConnection($db);
                    $result = $db->select($current, $key)->get($table)->result();
                }
                else
                {
                    $result = \DB::select($current, $key)->get($table)->result();
                }
            }
            else
            {
                $result = \DB::query($this->settings['query'])->result();
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

            // 5.4.2[added]
            $this->_validate($_attributes['name'], $_attributes['name']);
            
            // 5.4.2[added]|5.4.5|5.4.6[edited]
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

    //--------------------------------------------------------------------------------------------------------
    // Multi Select
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param array  $options
    // @param scalar $selected
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function multiselect(String $name = NULL, Array $options = [], $selected = NULL, Array $_attributes = []) : String
    {
        return $this->select($name, $options, $selected, $_attributes, true);
    }

    //--------------------------------------------------------------------------------------------------------
    // Hidden
    //----------------------------------------------------------------------------------- ---------------------
    //
    // @param string $name
    // @param string $value
    //
    //--------------------------------------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------------
    // File
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param bool   $multiple
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
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
            $name = suffix($name, '[]');
        }

        return $this->_input($name, '', $_attributes, 'file');
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Process
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _process($name, $method)
    {
        if( $process = ($this->settings['process'] ?? NULL) )
        {
            if( $method::FormProcessValue() )
            {
                if( \Validation::check() )
                {
                    if( $process === 'update' )
                    {
                        \DB::where
                        (
                            $whereColumn = $this->settings['whereColumn'], 
                            $whereValue  = $this->settings['whereValue']
                        )
                        ->update(strtolower($method).':'.$name);       

                        $this->settings['getrow'] = \DB::where($whereColumn, $whereValue)->get($name)->row();
                    }
                    elseif( $process === 'insert' )
                    {
                        \DB::insert(strtolower($method).':'.$name); 
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

    //--------------------------------------------------------------------------------------------------------
    // Protected Unset Select Data
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------------
    // Protected Unset Select Data
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
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
