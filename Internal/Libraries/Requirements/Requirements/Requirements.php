<?php namespace ZN\Requirements;

class Requirements extends \CallController implements RequirementsInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Lang                                                                       
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array                        
    //                                                                                           
    //--------------------------------------------------------------------------------------------------------
    protected $lang = [];

    use ConfigTrait, StatusTrait;
}

class_alias('ZN\Requirements\Requirements', 'Requirements');