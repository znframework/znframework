<?php namespace ZN\Requirements;

trait ConfigTrait
{
    //--------------------------------------------------------------------------------------------------------
    // Config                                                                       
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array                        
    //                                                                                           
    //--------------------------------------------------------------------------------------------------------
    protected $config = [];

    //--------------------------------------------------------------------------------------------------------
    // config()                                                                       
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  array  $settings: empty                   
    //                                                                                           
    //--------------------------------------------------------------------------------------------------------
    public function config(Array $settings = NULL)
    {
        return $this;
    }
}

class_alias('ZN\Requirements\ConfigTrait', 'ConfigTrait');