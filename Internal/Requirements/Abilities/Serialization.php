<?php trait SerializationAbility
{
    //--------------------------------------------------------------------------------------------------------
    // Serialization -> 5.4.5
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
    //---------------------------------------------------------------------------------------------------------
    public function __call($method, $parameters)
    {
        $lower   = strtolower($method);
        $class   = self::serialization['class'];
        $process = (self::serialization['process'] ?? 'serial') === 'serial' ? 'data' : 'return'; 

        if( $lower === self::serialization['start'] )
        {
            $this->data = $parameters[0];
        }
        elseif( $lower === self::serialization['end'] )
        {
            return $this->$process;
        }
        else
        {
            $this->$process = $class::$method($this->data, ...$parameters);
        }

        return $this;
    }
}
