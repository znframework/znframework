<?php namespace ZN\ViewObjects\Bootstrap\JSP;

use JS, JQ;

class Variable implements VariableInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    public function var(String $variable, String $value = NULL)
    {
        echo 'var ' . $this->_var($variable, $value);
    }

    public function varch(String $variable, String $value = NULL)
    {
        echo $this->_var($variable, $value);
    }

    public function vardec(String $variable, Int $decrement = 1)
    {
        echo $variable . ' = ' . $variable . ' - ' . $decrement . ';' . EOL;
    }

    public function varinc(String $variable, Int $decrement = 1)
    {
        echo $variable . ' = ' . $variable . ' + ' . $decrement . ';' . EOL;
    }

    protected function _var($variable, $value)
    {
        return $this->_equalControl($variable) . ' ' . JQ::stringControl($value) . ';' . EOL;
    }

    protected function _equalControl($column)
    {
        $control = trim($column);

        if( strstr($column, '.') )
        {
            $control = str_replace('.', '', $control);
        }

        if( preg_match('/^\w+$/', $control) )
        {
            $column .= ' = ';
        }

        return $column;
    }
}
