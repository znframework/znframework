<?php namespace ZN\ViewObjects\Javascript\Components;

class Modal extends ComponentsExtends
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
    // Generate
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string   $id   = 'myModal'
    // @param callable $modalboxs
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate(String $id = 'myModal', Callable $modalboxs) : String
    {
        $modalboxs($this);

        $attr['id']      = $id;
        $attr['title']   = $this->title   ?? 'Modal Title';
        $attr['content'] = $this->content ?? 'Modal Content';
        $attr['process'] = $this->process ?? NULL;
        $attr['button']  = $this->button  ?? NULL;
        $attr['modal']   =
        [
            'size'  => $this->size  ?? 'normal',
            'close' => $this->close ?? true
        ];

        return $this->prop($attr);
    }
}
