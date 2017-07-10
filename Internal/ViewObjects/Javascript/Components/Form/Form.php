<?php namespace ZN\ViewObjects\Javascript\Components;

use Buffer, Html, Form as Forms;

class Form extends ComponentsExtends
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    public function design(Callable $form)
    {
        echo $form(new Forms, new Html);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Generate
    //--------------------------------------------------------------------------------------------------------
    //
    // @param callable $form
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate(Callable $form) : String
    {
        $attr['contents']  = Buffer::function($form, [$this]);
        $attr['form']      = $form;
        $attr['action']    = $this->action             ?? NULL;
        $attr['class']     = $this->class              ?? NULL;
        $attr['name']      = $this->name               ?? 'form';
        $attr['method']    = $this->method             ?? NULL;
        $attr['multipart'] = $this->multipart          ?? NULL;

        return $this->prop($attr);
    }
}
