<?php namespace ZN\ViewObjects\HTML\Helpers;

use ZN\ViewObjects\Abstracts\HTMLHelpersAbstract;

class Table extends HTMLHelpersAbstract
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
    // Attr
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $attr = [];

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
        $method = strtolower($method);

        $this->attr[$method] = $parameters[0] ?? NULL;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Attr
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function attr(Array $attributes) : Table
    {
        foreach( $attributes as $att => $val )
        {
            $this->attr[$att] = $val;
        }

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Cell
    //--------------------------------------------------------------------------------------------------------
    //
    // @param numeric $spacing
    // @param numeric $padding
    //
    //--------------------------------------------------------------------------------------------------------
    public function cell(Int $spacing, Int $padding) : Table
    {
        $this->attr['cellspacing'] = $spacing;
        $this->attr['cellpadding'] = $padding;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Border
    //--------------------------------------------------------------------------------------------------------
    //
    // @param numeric $border
    // @param string  $color
    //
    //--------------------------------------------------------------------------------------------------------
    public function border(Int $border, String $color = NULL) : Table
    {
        $this->attr['border'] = $border;

        if( ! empty($color) )
        {
            $this->attr['bordercolor'] = $color;
        }

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Size
    //--------------------------------------------------------------------------------------------------------
    //
    // @param numeric $width
    // @param numeric $height
    //
    //--------------------------------------------------------------------------------------------------------
    public function size(Int $width, Int $height) : Table
    {
        $this->attr['width']  = $width;
        $this->attr['height'] = $height;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Style
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function style(Array $attributes) : Table
    {
        $attribute = '';

        foreach( $attributes as $key => $values )
        {
            if( is_numeric($key) )
            {
                $key = $values;
            }

            $attribute .= ' '.$key.':'.$values.';';
        }

        $this->attr['style'] = $attribute;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Create
    //--------------------------------------------------------------------------------------------------------
    //
    // @param variadic $elements
    //
    //--------------------------------------------------------------------------------------------------------
    public function create(...$elements) : String
    {
        $table  = '<table'.\Html::attributes($this->attr).'>';
        $table .= $this->_content(...$elements);
        $table .= '</table>';

        if( ! empty($this->table)) $this->table = NULL;
        if( ! empty($this->attr))  $this->attr = [];

        return $table;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Content
    //--------------------------------------------------------------------------------------------------------
    //
    // @param variadic $elements
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _content(...$elements)
    {
        $colNo = 1;
        $rowNo = 1;
        $table = '';
        $eol   = EOL;

        if( isset($elements[0][0]) && is_array($elements[0][0]))
        {
            $elements = $elements[0];
        }

        foreach( $elements as $key => $element )
        {
            $table .= $eol."\t".'<tr>'.$eol;

            if(is_array($element))foreach($element as $k => $v)
            {
                $val = $v;
                $attr = "";

                if(is_array($v))
                {
                    $attr = \Html::attributes($v);
                    $val  = $k;
                }

                if( strpos($val, 'th:') === 0 )
                {
                    $rowType = 'th';
                    $val = substr($val, 3);
                }
                else
                {
                    $rowType = 'td';
                }

                $table .= "\t\t".'<'.$rowType.$attr.'>'.$val.'</'.$rowType.'>'.$eol;
                $colNo++;
            }

            $table .= "\t".'</tr>'.$eol;
            $rowNo++;
        }

        return $table;
    }
}
