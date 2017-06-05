<?php namespace ZN\ViewObjects\Javascript\Components;

class Modal extends ComponentsExtends implements ModalInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    protected $button = NULL;

    public function button(String $name, String $value, Array $attr = [])
    {
        $this->button =
        [
            'name'       => $name,
            'value'      => $value,
            'attributes' => $attr,
            'class'      => $this->class ?? 'btn-info'
        ];

        $this->class  = NULL;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Generate
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string   $id   = 'myModal'
    // @param callable $modalboxs
    // @param array    $attr = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate(String $id = 'myModal', Callable $modalboxs, Array $attr = NULL) : String
    {
        $modalboxs($this);

        $attr['id']        = $id;
        $attr['title']     = $this->title;
        $attr['content']   = $this->content;
        $attr['process']   = $this->process;
        $attr['button']    = $this->button;
        $attr['modal']     = ['size' => $this->size ?? 'normal', 'close' => $this->close ?? true];

        $this->defaultVariables();

        return $this->load('Modal/View', $attr);
    }
}
