<?php trait FunctionalizationAbility
{
    //--------------------------------------------------------------------------------------------------------
    // Functionalization -> 5.4.5
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //-------------------------------------------------------------------------------------------------------

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
        $lower = strtolower($method);
               
        if( $standart = (static::functionalization[$lower] ?? NULL) )
        {
            return $standart(...$parameters);
        }

        if( method_exists(get_parent_class(), '__call'))
        {
            return parent::__call($method, $parameters);
        }
    }
}
