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

use Html, Form as Forms;
use ZN\IndividualStructures\Buffer;

class Form extends ComponentsExtends
{
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
            'contents'  => Buffer\Callback::do($form, [$this]),
            'form'      => $form,
            'action'    => $this->action    ?? NULL,
            'class'     => $this->class     ?? NULL,
            'name'      => $this->name      ?? 'form',
            'method'    => $this->method    ?? NULL,
            'multipart' => $this->multipart ?? NULL
        ]);
    }
}
