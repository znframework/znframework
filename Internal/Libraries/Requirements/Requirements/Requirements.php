<?php namespace ZN\Requirements;

class Requirements extends CallController implements RequirementsInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    use ConfigTrait, LangTrait, StatusTrait;

    //--------------------------------------------------------------------------------------------------------
    // Initialize
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    public function initialize($types)
    {
        if( is_string($types) )
        {
            $this->$types();
        }
        elseif( is_array($types) )
        {
            foreach( $types as $key => $type )
            {
                if( is_numeric($key) )
                {
                    $this->$type();
                }
                else
                {
                    $const = 'REQUIREMENT_'.strtoupper($key);
                   
                    if( ! defined($const) )
                    {
                        define($const, $type);
                    }

                    $this->$key($type);
                }
            }
        }
    }
}

class_alias('ZN\Requirements\Requirements', 'Requirements');