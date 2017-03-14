<?php namespace ZN\ViewObjects\Bootstrap\JSP;

use JS;

class Variable
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------
    
    public function var($variable, $value = NULL)
    {
        echo JS::define($variable, $value) . EOL;
    }

    public function varch($variable, $value = NULL)
    {
        echo $this->_equalControl($variable) . ' ' . $value . ';' . EOL;
    }

    public function vardec($variable, $decrement = 1)
    {
        echo $variable . ' = ' . $variable . ' - ' . $decrement . ';' . EOL;
    }

    public function varinc($variable, $decrement = 1)
    {
        echo $variable . ' = ' . $variable . ' + ' . $decrement . ';' . EOL;
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
