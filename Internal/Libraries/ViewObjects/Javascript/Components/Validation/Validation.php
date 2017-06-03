<?php namespace ZN\ViewObjects\Javascript\Components;

class Validation extends ComponentsExtends implements ValidationInterface
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
    // @param callable $form
    // @param array    $attr = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate(Callable $form, Array $attr = NULL) : String
    {
        $attr['form'] = $form;

        return $this->load('Validation/View', $attr);
    }
}
