<?php namespace ZN\ViewObjects\Javascript\Components;

use Arrays, Buffer, Html, Form as Forms;

class Form extends ComponentsExtends implements FormInterface
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
        $contents = Buffer::function($form, [$this]);

        $attr['contents']           = $contents;
        $attr['form']               = $form;
        $attr['autoloadExtensions'] = $this->autoloadExtensions ?? false;
        $attr['action']             = $this->action             ?? NULL;
        $attr['class']              = $this->class              ?? NULL;
        $attr['name']               = $this->name               ?? 'form';
        $attr['method']             = $this->method             ?? NULL;
        $attr['multipart']          = $this->multipart          ?? NULL;
        $attr['extensions']         = $this->extensions         ?? [];
        $attr['attributes']         = $this->attributes         ?? [];
        $attr['attributes']         = $this->attributes         ?? [];
        $attr['properties']         = $this->properties         ?? $this->prop($attr);

        $this->defaultVariable();

        return $this->load('Form/View', $attr);
    }
}
