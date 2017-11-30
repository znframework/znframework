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

        return $this->prop
        ([
            'id'        => $id,
            'title'     => $this->title   ?? 'Modal Title',
            'content'   => $this->content ?? 'Modal Content',
            'process'   => $this->process ?? NULL,
            'button'    => $this->button  ?? NULL,
            'modal'     =>
            [
                'size'  => $this->size    ?? 'normal',
                'close' => $this->close   ?? true
            ]
        ]);
    }
}
