<?php trait ExclusionAbility
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
    // Construct
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    // @param string $message
    // @param mixed  $changed
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct(string $file, string $message = NULL, $changed = NULL)
    {
        if( $data = lang($file, $message, $changed) )
        {
            $message = $data;
        }
        else
        {
            $message = $file;
        }

        parent::__construct($message);
    }

    //--------------------------------------------------------------------------------------------------------
    // Continue
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $msg
    // @param string $file
    // @param string $line
    //
    //--------------------------------------------------------------------------------------------------------
    public function continue() : void
    {
        echo \Exceptions::continue($this->getMessage(), $this->getFile(), $this->getLine());
    }
}
