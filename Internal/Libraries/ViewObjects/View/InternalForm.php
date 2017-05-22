<?php namespace ZN\ViewObjects\View;

use Validation, Arrays, DB, Session;

class InternalForm implements InternalFormInterface, ViewCommonInterface
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
    //--------------------------------------------------------------------------------------------------------
    public function open(String $name = NULL, Array $_attributes = []) : String
    {
        if( isset($this->settings['attr']['name']) )
        {
            $name = $this->settings['attr']['name'];
        }

        $_attributes['name'] = $name;

        // Usable 3 Parameter For Enctype
        // 1. multipart     => multipart/form-data
        // 2. application   => application/x-www-form-urlencoded
        // 3. text          => text/plain
        if( isset($_attributes['enctype']) )
        {
            $enctype = $_attributes['enctype'];

            if( isset($this->enctypes[$enctype]) )
            {
                $_attributes['enctype'] = $this->enctypes[$enctype];
            }
        }

        if( ! isset($_attributes['method']) )
        {
            $_attributes['method'] = 'post';
        }

        $this->method = $_attributes['method'];

        $return = '<form'.$this->attributes($_attributes).'>'.EOL;

        if( isset($this->settings['token']) )
        {
            $return .= CSRFInput();
        }

        $this->settings['token'] = NULL;

        return $return;
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
        return '</form>'.EOL;
    }

    //--------------------------------------------------------------------------------------------------------
    // Button
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $value
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function button(String $name = NULL, String $value = NULL, Array $_attributes = []) : String
    {
        return $this->_input($name, $value, $_attributes, __FUNCTION__);
    }

    //--------------------------------------------------------------------------------------------------------
    // Reset
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $value
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function reset(String $name = NULL, String $value = NULL, Array $_attributes = []) : String
    {
        return $this->_input($name, $value, $_attributes, __FUNCTION__);
    }

    //--------------------------------------------------------------------------------------------------------
    // Submit
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $value
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function submit(String $name = NULL, String $value = NULL, Array $_attributes = []) : String
    {
        return $this->_input($name, $value, $_attributes, __FUNCTION__);
    }

    //--------------------------------------------------------------------------------------------------------
    // Radio
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $value
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function radio(String $name = NULL, String $value = NULL, Array $_attributes = []) : String
    {
        return $this->_input($name, $value, $_attributes, __FUNCTION__);
    }

    //--------------------------------------------------------------------------------------------------------
    // Checkbox
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $value
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function checkbox(String $name = NULL, String $value = NULL, Array $_attributes = []) : String
    {
        return $this->_input($name, $value, $_attributes, __FUNCTION__);
    }

    //--------------------------------------------------------------------------------------------------------
    // Date
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $value
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function date(String $name = NULL, String $value = NULL, Array $_attributes = []) : String
    {
        return $this->_input($name, $value, $_attributes, __FUNCTION__);
    }

    ///--------------------------------------------------------------------------------------------------------
    // Time
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $value
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function time(String $name = NULL, String $value = NULL, Array $_attributes = []) : String
    {
        return $this->_input($name, $value, $_attributes, __FUNCTION__);
    }

    //--------------------------------------------------------------------------------------------------------
    // Date Time
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $value
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function datetime(String $name = NULL, String $value = NULL, Array $_attributes = []) : String
    {
        return $this->_input($name, $value, $_attributes, __FUNCTION__);
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
    // Week
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $value
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function week(String $name = NULL, String $value = NULL, Array $_attributes = []) : String
    {
        return $this->_input($name, $value, $_attributes, __FUNCTION__);
    }

    //--------------------------------------------------------------------------------------------------------
    // Month
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $value
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function month(String $name = NULL, String $value = NULL, Array $_attributes = []) : String
    {
        return $this->_input($name, $value, $_attributes, __FUNCTION__);
    }

    //--------------------------------------------------------------------------------------------------------
    // Text
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $value
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function text(String $name = NULL, String $value = NULL, Array $_attributes = []) : String
    {
        return $this->_input($name, $value, $_attributes, __FUNCTION__);
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

        if( isset($this->settings['attr']['value']) )
        {
            $value = $this->settings['attr']['value'];
        }

        if( ! empty($this->settings['attr']['name']) )
        {
            if( isset($this->postback['bool']) && $this->postback['bool'] === true )
            {
                $method = ! empty($this->method) ? $this->method : $this->postback['type'];
                $value  = Validation::postBack($this->settings['attr']['name'], $method);

                $this->postback = [];
            }
        }

        return '<textarea'.$this->attributes($_attributes).'>'.$value.'</textarea>'.EOL;
    }

    //--------------------------------------------------------------------------------------------------------
    // Search
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $value
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function search(String $name = NULL, String $value = NULL, Array $_attributes = []) : String
    {
        return $this->_input($name, $value, $_attributes, __FUNCTION__);
    }

    //--------------------------------------------------------------------------------------------------------
    // Passoword
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $value
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function password(String $name = NULL, String $value = NULL, Array $_attributes = []) : String
    {
        return $this->_input($name, $value, $_attributes, __FUNCTION__);
    }

    //--------------------------------------------------------------------------------------------------------
    // Email
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $value
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function email(String $name = NULL, String $value = NULL, Array $_attributes = []) : String
    {
        return $this->_input($name, $value, $_attributes, __FUNCTION__);
    }

    //--------------------------------------------------------------------------------------------------------
    // Tel
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $value
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function tel(String $name = NULL, String $value = NULL, Array $_attributes = []) : String
    {
        return $this->_input($name, $value, $_attributes, __FUNCTION__);
    }

    //--------------------------------------------------------------------------------------------------------
    // Number
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $value
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function number(String $name = NULL, String $value = NULL, Array $_attributes = []) : String
    {
        return $this->_input($name, $value, $_attributes, __FUNCTION__);
    }

    //--------------------------------------------------------------------------------------------------------
    // Url
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $value
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function url(String $name = NULL, String $value = NULL, Array $_attributes = []) : String
    {
        return $this->_input($name, $value, $_attributes, __FUNCTION__);
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

            $options = Arrays::removeFirst($options);

            if( ! empty($this->settings['table']) )
            {
                $table = $this->settings['table'];

                if( strstr($table, ':') )
                {
                    $tableEx = explode(':', $tableEx);
                    $table   = $tableEx[1];
                    $db      = $tableEx[0];

                    $db = DB::differentConnection($db);
                    $result = $db->select($current, $key)->get($table)->result();
                }
                else
                {
                    $result = DB::select($current, $key)->get($table)->result();
                }
            }
            else
            {
                $result = DB::query($this->settings['query'])->result();
            }

            foreach( $result as $row )
            {
                $options[$row->$key] = $row->$current;
            }
        }

        if( isset($this->settings['option']) )
        {
            $options = $this->settings['option'];
        }

        if( isset($this->settings['exclude']) )
        {
            $options = Arrays::excluding($options, $this->settings['exclude']);
        }

        if( isset($this->settings['include']) )
        {
            $options = Arrays::including($options, $this->settings['include']);
        }

        if( isset($this->settings['order']['type']) )
        {
            $options = Arrays::order($options, $this->settings['order']['type'], $this->settings['order']['flags']);
        }

        if( isset($this->settings['selectedKey']) )
        {
            $selected = $this->settings['selectedKey'];
        }

        if( isset($this->settings['selectedValue']) )
        {
            $flip     = array_flip($options);
            $selected = $flip[$this->settings['selectedValue']];
        }

        // Son parametrenin durumuna multiple olması belirleniyor.
        // Ancak bu parametrenin kullanımı gerekmez.
        // Bunun için multiple() yöntemi oluşturulmuştur.
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
            if( isset($this->postback['bool']) && $this->postback['bool'] === true )
            {
                $method   = ! empty($this->method) ? $this->method : $this->postback['type'];
                $selected = Validation::postBack($_attributes['name'], $method);

                $this->postback = [];
            }
        }

        $selectbox = '<select'.$this->attributes($_attributes).'>';

        if( is_array($options) ) foreach( $options as $key => $value )
        {
            if( is_array($selected) )
            {
                if( in_array($key, $selected) )
                {
                    $select = 'selected="selected"';
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
                    $select = 'selected="selected"';
                }
                else
                {
                    $select = "";
                }
            }

            $selectbox .= '<option value="'.$key.'" '.$select.'>'.$value.'</option>'.EOL;
        }

        $selectbox .= '</select>'.EOL;

        $this->settings = [];

        return $selectbox;
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
    // Range
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $value
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function range(String $name = NULL, String $value = NULL, Array $_attributes = []) : String
    {
        return $this->_input($name, $value, $_attributes, __FUNCTION__);
    }

    //--------------------------------------------------------------------------------------------------------
    // Image
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $value
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function image(String $name = NULL, String $value = NULL, Array $_attributes = []) : String
    {
        return $this->_input($name, $value, $_attributes, __FUNCTION__);
    }

    //--------------------------------------------------------------------------------------------------------
    // Hidden
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $value
    //
    //--------------------------------------------------------------------------------------------------------
    public function hidden(String $name = NULL, String $value = NULL) : String
    {
        if( isset($this->settings['attr']['name']) )
        {
            $name = $this->settings['attr']['name'];
        }

        if( isset($this->settings['attr']['value']) )
        {
            $value = $this->settings['attr']['value'];
        }

        $this->settings = [];

        $hiddens = NULL;

        $value = ( ! empty($value) )
                 ? 'value="'.$value.'"'
                 : "";

        // 1. parametre dizi ise
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

        if( ! empty($this->settings['attr']['name']) )
        {
            $name = $this->settings['attr']['name'];
        }

        if( $multiple === true )
        {
            $this->settings['attr']['multiple'] = 'multiple';
            $name = suffix($name, '[]');
        }

        return $this->_input($name, '', $_attributes, 'file');
    }

    //--------------------------------------------------------------------------------------------------------
    // Color
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $value
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function color(String $name = NULL, String $value = NULL, Array $_attributes = []) : String
    {
        return $this->_input($name, $value, $_attributes, __FUNCTION__);
    }
}
