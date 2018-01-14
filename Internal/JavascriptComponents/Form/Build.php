<?php namespace ZN\JavascriptComponents\Form;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Hypertext\Html;
use ZN\Hypertext\Form;
use ZN\Buffering;
use ZN\JavascriptComponents\ComponentsExtends;

class Build extends ComponentsExtends
{
    /**
     * Design
     * 
     * @param callable $form
     * 
     * @return self
     */
    public function design(Callable $form)
    {
        echo $form(new Form, new Html);

        return $this;
    }

    /**
     * Generate Form
     * 
     * @param callable $form
     * 
     * @return string
     */
    public function generate(Callable $form) : String
    {
        return $this->prop
        ([
            'contents'  => Buffering\Callback::do($form, [$this]),
            'form'      => $form,
            'action'    => $this->action    ?? NULL,
            'class'     => $this->class     ?? NULL,
            'name'      => $this->name      ?? 'form',
            'method'    => $this->method    ?? NULL,
            'multipart' => $this->multipart ?? NULL
        ]);
    }
}
