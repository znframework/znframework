<?php namespace ZN\ViewObjects\View\BS;

use Html, Form, Buffer;

class Button implements ButtonInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    protected $buttonGroup = false;

    //--------------------------------------------------------------------------------------------------------
    // Button Group
    //--------------------------------------------------------------------------------------------------------
    //
    // @param callable $group
    //
    //--------------------------------------------------------------------------------------------------------
    public function buttonGroup(Callable $group) : String
    {
        $this->buttonGroup = true;

        $return  = '<div class="btn-group'.(Properties::$type ? ' btn-group-'.Properties::$type : NULL).'">';
        $return .= Buffer::callback($group, [new \BS]);
        $return .= '</div>';

        Properties::$type  = NULL;
        $this->buttonGroup = false;

        return $return;
    }

    //--------------------------------------------------------------------------------------------------------
    // Button Link
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $url   = NULL
    // @param string $value = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function buttonLink(String $url = NULL, String $value = NULL)
    {
        $return = Html::role('button')->class('btn'. (Properties::$type ? ' btn-'.Properties::$type : NULL))->anchor($url, $value);

        Properties::$type = NULL;

        if( $this->buttonGroup === false )
        {
            return $return;
        }

        echo $return;
    }

    //--------------------------------------------------------------------------------------------------------
    // Button
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name  = NULL
    // @param string $value = NULL
    // @param array  $attr  = []
    //
    //--------------------------------------------------------------------------------------------------------
    public function button(String $name = NULL, String $value = NULL, Array $attr = [])
    {
        $return = Form::attr($attr)->class('btn'. (Properties::$type ? ' btn-'.Properties::$type : NULL))->button($name, $value);

        Properties::$type = NULL;

        if( $this->buttonGroup === false )
        {
            return $return;
        }

        echo $return;
    }

    //--------------------------------------------------------------------------------------------------------
    // Submit
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name  = NULL
    // @param string $value = NULL
    // @param array  $attr  = []
    //
    //--------------------------------------------------------------------------------------------------------
    public function submit(String $name = NULL, String $value = NULL, Array $attr = [])
    {
        $return = Form::attr($attr)->class('btn'. (Properties::$type ? ' btn-'.Properties::$type : NULL))->submit($name, $value);

        Properties::$type = NULL;

        if( $this->buttonGroup === false )
        {
            return $return;
        }

        echo $return;
    }
}
