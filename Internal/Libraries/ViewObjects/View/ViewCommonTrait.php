<?php namespace ZN\ViewObjects\View;

trait ViewCommonTrait
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
    // FormElementsTrait
    //--------------------------------------------------------------------------------------------------------
    //
    // elements ...
    //
    //--------------------------------------------------------------------------------------------------------
    use FormElementsTrait;

    //--------------------------------------------------------------------------------------------------------
    // HTMLElementsTrait
    //--------------------------------------------------------------------------------------------------------
    //
    // elements ...
    //
    //--------------------------------------------------------------------------------------------------------
    use HTMLElementsTrait;

    //--------------------------------------------------------------------------------------------------------
    // $settings
    //--------------------------------------------------------------------------------------------------------
    //
    // Ayarları tutmak için
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $settings = [];

    //--------------------------------------------------------------------------------------------------------
    // $useElements
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $useElements =
    [
        'addclass' => 'class'
    ];

    //--------------------------------------------------------------------------------------------------------
    // Magic Call
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $method
    // @param array  $parameters
    //
    //--------------------------------------------------------------------------------------------------------
    public function __call($method, $parameters)
    {
        $realMethod = $method;
        $method     = strtolower($method);

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

        //----------------------------------------------------------------------------------------------------
        // 4.6.1 -> convert exampleData to example-data
        //----------------------------------------------------------------------------------------------------
        if( ! ctype_lower($realMethod) )
        {
            $newMethod = NULL;

            for( $i = 0; $i < strlen($realMethod); $i++ )
            {
                if( ctype_upper($realMethod[$i]) )
                {
                    $newMethod .= '-' . strtolower($realMethod[$i]);
                }
                else
                {
                    $newMethod .= $realMethod[$i];
                }
            }

            $method = $newMethod;
        }
        //----------------------------------------------------------------------------------------------------

        $this->_element($method, ...$parameters);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Attributes
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function attributes(Array $attributes) : String
    {
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

    //--------------------------------------------------------------------------------------------------------
    // Type
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type
    // @param string $name
    // @param string $value
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------------
    // Protected Attributes
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $value
    // @param array  $attributes
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _input($name = "", $value = "", $attributes = [], $type = '')
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
            if( isset($this->postback['bool']) && $this->postback['bool'] === true )
            {
                $method = ! empty($this->method) ? $this->method : $this->postback['type'];

                $attributes['value'] = \Validation::postBack($attributes['name'], $method);

                $this->postback = [];
            }
        }

        return '<input type="'.$type.'"'.$this->attributes($attributes).'>'.EOL;
    }

    //--------------------------------------------------------------------------------------------------------
    // protected _element()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $function
    // @param string $element
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _element($function, $element)
    {
        $this->settings['attr'][strtolower($function)] = $element;
    }
}
