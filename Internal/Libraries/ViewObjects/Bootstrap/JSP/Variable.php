<?php namespace ZN\ViewObjects\Bootstrap\JSP;

use Arrays, Buffer, JS, JQ;

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

    //--------------------------------------------------------------------------------------------------------
    // Magic Call
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $function
    // @param array  $parameters
    //
    //--------------------------------------------------------------------------------------------------------
    public function __call($function, $parameters = [])
    {
        $propertyFunction = NULL;

        if( ! empty($parameters) )
        {
            $propertyFunction = '(' . $this->_parameters($parameters) . ')';
        }

        $query = $this->uservarQuery . '.' . $function . $propertyFunction;

        if( $this->return === false)
        {
            echo suffix($query, ';');
        }
        else
        {
            return '+' . $query;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Varprop
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $variable
    // @param bool   $return = true
    //
    //--------------------------------------------------------------------------------------------------------
    public function varprop(String $variable, Bool $return = true) : Variable
    {
        $this->return       = $return;
        $this->uservarQuery = $variable;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Array
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $variable
    // @param string $value
    //
    //--------------------------------------------------------------------------------------------------------
    public function array(...$parameters) : String
    {
        return '+[' .  $this->_parameters($parameters) . ']';
    }

    //--------------------------------------------------------------------------------------------------------
    // Var
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $variable
    // @param string $value
    //
    //--------------------------------------------------------------------------------------------------------
    public function var(String $variable, String $value = NULL)
    {
        echo JS::var($variable, $value, true);
    }

    //--------------------------------------------------------------------------------------------------------
    // Varch
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $variable
    // @param string $value
    //
    //--------------------------------------------------------------------------------------------------------
    public function varch(String $variable, String $value = NULL)
    {
        echo JS::varch($variable, $value);
    }

    //--------------------------------------------------------------------------------------------------------
    // Vardec
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $variable
    // @param int    $decrement = 1
    //
    //--------------------------------------------------------------------------------------------------------
    public function vardec(String $variable, Int $decrement = 1)
    {
        echo JQ::vardec($variable, $decrement);
    }

    //--------------------------------------------------------------------------------------------------------
    // Varinc
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $variable
    // @param int    $increment = 1
    //
    //--------------------------------------------------------------------------------------------------------
    public function varinc(String $variable, Int $decrement = 1)
    {
        echo JQ::varinc($variable, $decrement);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Parameters
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed ...$parameters
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _parameters($parameters = [])
    {
        $params = NULL;

        foreach( $parameters as $param )
        {
            if( is_callable($param) )
            {
                $param = JQ::function('', Buffer::callback($param));
            }

            $params .= JQ::stringControl($param).', ';
        }

        return $params = rtrim($params, ', ');
    }
}
