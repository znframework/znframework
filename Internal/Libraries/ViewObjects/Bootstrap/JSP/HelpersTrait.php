<?php namespace ZN\ViewObjects\Bootstrap\JSP;

use Jquery, Classes;

trait HelperTrait
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    public function create($callback)
    {
        $class    = strtolower(Classes::onlyName(__CLASS__));
        $function = 'create';

        if( $class === 'ajax' )
        {
            $function = 'send';
        }

        $class = Jquery::$class();

        echo $callback($class) . EOL;
        echo $class->$function();
    }
}
