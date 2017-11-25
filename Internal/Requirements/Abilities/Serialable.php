<?php trait SerialableAbility
{
    //--------------------------------------------------------------------------------------------------------
    // Serialable -> 5.4.5
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
        $class   = self::serialable['class'];
        $process = (self::serialable['process'] ?? 'serial') === 'serial' ? 'data' : 'return'; 

        if( $lower === self::serialable['start'] )
        {
            $this->data = $parameters[0];
        }
        elseif( $lower === self::serialable['end'] )
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
