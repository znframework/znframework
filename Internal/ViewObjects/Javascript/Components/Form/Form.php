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
        return $this->prop
        ([
            'contents'  => Buffer::function($form, [$this]),
            'form'      => $form,
            'action'    => $this->action    ?? NULL,
            'class'     => $this->class     ?? NULL,
            'name'      => $this->name      ?? 'form',
            'method'    => $this->method    ?? NULL,
            'multipart' => $this->multipart ?? NULL
        ]);
    }
}
