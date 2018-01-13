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

use ZN\Singleton;
use ZN\Hypertext\HtmlHelpersAbstract;

class Table extends HtmlHelpersAbstract
{
    /**
     * Keeps attributes
     * 
     * @var array
     */
    protected $attr = [];

    /**
     * Magic Call
     * 
     * @param string $method
     * @param array  $parameters
     * 
     * @return Table
     */
    public function __call($method, $parameters)
    {
        $method = strtolower($method);

        $this->attr[$method] = $parameters[0] ?? NULL;

        return $this;
    }

    /**
     * Magic Constructor
     */
    public function __construct()
    {
        $this->html = Singleton::class('ZN\Hypertext\Html');
    }

    /**
     * Sets attributes
     * 
     * @param array $attributes
     * 
     * @return Table
     */
    public function attr(Array $attributes) : Table
    {
        foreach( $attributes as $att => $val )
        {
            $this->attr[$att] = $val;
        }

        return $this;
    }

    /**
     * Sets table cell
     * 
     * @param int $spacing
     * @param int $padding
     * 
     * @return Table
     */
    public function cell(Int $spacing, Int $padding) : Table
    {
        $this->attr['cellspacing'] = $spacing;
        $this->attr['cellpadding'] = $padding;

        return $this;
    }

    /**
     * Sets table border
     * 
     * @param int $border
     * @param string $color = NULL
     * 
     * @return Table
     */
    public function border(Int $border, String $color = NULL) : Table
    {
        $this->attr['border'] = $border;

        if( ! empty($color) )
        {
            $this->attr['bordercolor'] = $color;
        }

        return $this;
    }

    /**
     * Sets table size
     * 
     * @param int $width
     * @param int $height
     * 
     * @return Table
     */
    public function size(Int $width, Int $height) : Table
    {
        $this->attr['width']  = $width;
        $this->attr['height'] = $height;

        return $this;
    }

    /**
     * Sets table style attribute
     * 
     * @param array $attributes
     * 
     * @return Table
     */
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

    /**
     * Creates table
     * 
     * @param string ...$elements
     * 
     * @return string
     */
    public function create(...$elements) : String
    {
        $table  = '<table'.$this->html->attributes($this->attr).'>';
        $table .= $this->_content(...$elements);
        $table .= '</table>';

        if( ! empty($this->table)) $this->table = NULL;
        if( ! empty($this->attr))  $this->attr = [];

        return $table;
    }

    /**
     * Protected Content
     */
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
                    $attr = $this->html->attributes($v);
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
