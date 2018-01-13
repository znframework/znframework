<?php namespace ZN\ViewObjects\Javascript\Components;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Modal extends ComponentsExtends
{
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
